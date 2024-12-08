<?php
// هنا تقوم بتضمين الاتصال بقاعدة البيانات، تأكد من أن هذا الكود يعمل بشكل صحيح.
require_once('Connections/coon.php');

// التأكد من الاتصال بقاعدة البيانات
$coon = new mysqli($hostname_coon, $username_coon, $password_coon, $database_coon);
if ($coon->connect_error) {
    die("Connection failed: " . $coon->connect_error);
}

// معاملة الحذف إذا كان النموذج قد تم إرساله
if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "form_delete")) {
    $registering_no = $_POST['registering_no'];

    // التأكد من أن رقم القيد ليس فارغاً
    if (!empty($registering_no)) {
        // الاستعلام لحذف الكتاب بناءً على رقم القيد
        $deleteSQL = "DELETE FROM books_info WHERE registering_no = ?";
        
        // استخدام prepare و execute لتجنب مشاكل الـ SQL Injection
        if ($stmt = $coon->prepare($deleteSQL)) {
            $stmt->bind_param("i", $registering_no);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('تم حذف الكتاب بنجاح!');</script>";
        } else {
            echo "<script>alert('حدث خطأ أثناء الحذف.');</script>";
        }
    } else {
        echo "<script>alert('الرجاء إدخال رقم القيد.');</script>";
    }
}

// معاملة إضافة الكتاب إذا كان النموذج قد تم إرساله
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO books_info (registering_no, classification_no, bookaddress, authorname, edition, publication_address, publisher, `date`, pages_numbers, `size`, dept_no) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
        GetSQLValueString($_POST['registering_no'], "int"),
        GetSQLValueString($_POST['classification_no'], "double"),
        GetSQLValueString($_POST['bookaddress'], "text"),
        GetSQLValueString($_POST['authorname'], "text"),
        GetSQLValueString($_POST['edition'], "text"),
        GetSQLValueString($_POST['publication_address'], "text"),
        GetSQLValueString($_POST['publisher'], "text"),
        GetSQLValueString($_POST['date'], "date"),
        GetSQLValueString($_POST['pages_numbers'], "int"),
        GetSQLValueString($_POST['size'], "double"),
        GetSQLValueString($_POST['dept_no'], "int"));

    // استخدام prepare و execute لتجنب مشاكل الـ SQL Injection
    if ($stmt = $coon->prepare($insertSQL)) {
        $stmt->execute();
        $stmt->close();
        echo "<script>alert('تم إضافة الكتاب بنجاح!');</script>";
    } else {
        echo "<script>alert('حدث خطأ أثناء إضافة الكتاب.');</script>";
    }
}

// دالة لحماية القيم المدخلة في استعلام SQL
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
    global $coon; // التأكد من أن الاتصال موجود كـ mysqli

    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = $coon->real_escape_string($theValue);

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long":
        case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
    }
    return $theValue;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة أو حذف كتاب</title>

    <!-- تضمين التنسيقات داخل رأس الصفحة -->
    <style>
        body {
			.back-btn {
        background-color: #007BFF; /* اللون الأزرق */
        position: relative;
        padding: 10px 20px;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        display: block;
        margin: 20px auto 0; /* مسافة بين الزر والاستمارة */
    }

    .back-btn:hover {
        background-color: #0056b3; /* اللون الأزرق الداكن عند المرور */
    }
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            direction: rtl; /* لعرض النصوص من اليمين لليسار */
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        td, th {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 5px;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: auto;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- النموذج لإضافة كتاب -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2" id="form2">
        <table align="center">
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">رقم القيد:</td>
                <td><input type="text" name="registering_no" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">رقم التصنيف:</td>
                <td><input type="text" name="classification_no" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">عنوان الكتاب:</td>
                <td><input type="text" name="bookaddress" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">المؤلف</td>
                <td><input type="text" name="authorname" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">الطبعة:</td>
                <td><input type="text" name="edition" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">دار النشر:</td>
                <td><input type="text" name="publication_address" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">الناشر:</td>
                <td><input type="text" name="publisher" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">التاريخ:</td>
                <td><input type="date" name="date" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">عدد الصفحات:</td>
                <td><input type="text" name="pages_numbers" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">الحجم:</td>
                <td><input type="text" name="size" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">رقم القسم:</td>
                <td><input type="text" name="dept_no" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">&nbsp;</td>
                <td><input type="submit" value="اضافة كتاب" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form2" />
    </form>

    <!-- النموذج لحذف كتاب -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form_delete" id="form_delete" onsubmit="return confirmDelete()">
        <table align="center">
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">حذف الكتاب:</td>
                <td><input type="text" name="registering_no" value="" size="32" required /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="right">&nbsp;</td>
                <td><input type="submit" value="حذف كتاب" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_delete" value="form_delete" />
        
        <button class="back-btn" onclick="window.location.href='admen.php';">العودة إلى الصفحة الرئيسية</button>

    </form>
</body>
</html>
