<?php
// الاتصال بقاعدة البيانات باستخدام mysql (إذا كنت تستخدم PHP 5.x أو الإصدارات القديمة)
require_once('Connections/coon.php');

// دالة لحماية القيم المدخلة
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        // التأكد من نوع النسخة في PHP
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        // التخلص من العلامات الخاصة لمنع SQL Injection
        $theValue = mysql_real_escape_string($theValue);

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
}

// إضافة موظف
$editFormAction = $_SERVER['PHP_SELF'];
$message = '';  // رسالة فارغة في البداية

if (isset($_POST["MM_insert"]) && $_POST["MM_insert"] == "form1") {
    // التحقق من الحقول المدخلة
    if (empty($_POST['emp_id']) || empty($_POST['firstname']) || empty($_POST['secondname']) || empty($_POST['telephone']) || empty($_POST['address']) || empty($_POST['degree']) || empty($_POST['birthdate']) || empty($_POST['employment']) || empty($_POST['academicqualification'])) {
        $message = "لم تتم عملية الإضافة. تأكد من ملء جميع بيانات الموظف.";
    } else {
        // التحضير لإضافة بيانات الموظف في قاعدة البيانات
        $insertSQL = sprintf(
            "INSERT INTO employee (emp_id, firstname, secondname, telephone, address, degree, birthdate, employment, academicqualification) 
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
            GetSQLValueString($_POST['emp_id'], "int"),
            GetSQLValueString($_POST['firstname'], "text"),
            GetSQLValueString($_POST['secondname'], "text"),
            GetSQLValueString($_POST['telephone'], "int"),
            GetSQLValueString($_POST['address'], "text"),
            GetSQLValueString($_POST['degree'], "text"),
            GetSQLValueString($_POST['birthdate'], "date"),
            GetSQLValueString($_POST['employment'], "date"),
            GetSQLValueString($_POST['academicqualification'], "text")
        );

        // تنفيذ عملية الإدخال في قاعدة البيانات
        mysql_select_db($database_coon, $coon);
        $Result1 = mysql_query($insertSQL, $coon) or die(mysql_error());

        // رسالة تأكيد إضافة الموظف
        $message = "تم إضافة الموظف بنجاح.";
    }
}

// معالجة البحث
$searchQuery = "";
$emp = null;
if (isset($_POST['search']) && $_POST['search'] != '') {
    $searchQuery = "WHERE emp_id = " . GetSQLValueString($_POST['search'], "int");
    mysql_select_db($database_coon, $coon);
    $query_emp = "SELECT * FROM employee $searchQuery";
    $emp = mysql_query($query_emp, $coon) or die(mysql_error());

    // إذا كانت هناك نتائج، عرض التفاصيل
    if (mysql_num_rows($emp) == 0) {
        $message = "لا يوجد موظف بهذا الرقم.";
    }
}

// حذف الموظف بناءً على رقم الموظف
if (isset($_POST['delete_emp_id']) && $_POST['delete_emp_id'] != '') {
    $deleteSQL = sprintf("DELETE FROM employee WHERE emp_id = %s", GetSQLValueString($_POST['delete_emp_id'], "int"));
    mysql_query($deleteSQL, $coon) or die(mysql_error());
    $message = "تم حذف الموظف بنجاح.";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>بيانات الموظفين</title>
<style type="text/css">
/* تقليص حجم الحقول والنموذج */
body {
    background-color: #d0e7f5; 
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    direction: rtl;
}

.container {
    width: 50%; /* تقليص العرض */
    margin: 0 auto;
    padding: 10px;
    background-color: #ffffff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 30px;
}

h2 {
    text-align: center;
    color: #4A90E2;
    font-size: 20px; /* تصغير الخط */
}

table {
    width: 100%;
    margin: 5px 0;
    padding: 5px;
    border-collapse: collapse;
}

td {
    padding: 5px;
    text-align: right;
    font-size: 12px; /* تقليص حجم الخط */
}

input[type="text"], input[type="submit"], button {
    width: 100%;
    padding: 6px;
    margin: 6px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 12px; /* تقليص حجم الخط */
}

input[type="submit"], button {
    background-color: #4A90E2;
    color: white;
    cursor: pointer;
    border: none;
}

input[type="submit"]:hover, button:hover {
    background-color: #357ab7;
}

form {
    width: 100%;
}

form input[readonly] {
    background-color: #f2f2f2;
    border: 2px solid #70a9d8;
}

.form-section {
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 6px;
    background-color: #f9f9f9;
    border: 2px solid #70a9d8;
}

form .form-section:last-child {
    margin-bottom: 0;
}

button[type="submit"] {
    width: auto;
    padding: 8px 15px;
}

/* تعديل الرسائل */
.message {
    text-align: center;
    color: #fff;
    background-color: #4CAF50;
    padding: 8px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.error {
    background-color: #f44336;
}
</style>

<script type="text/javascript">
    // دالة لتأكيد عملية الحذف
    function confirmDelete() {
        var confirmAction = confirm("هل أنت متأكد من أنك تريد حذف الموظف؟");
        return confirmAction; // إذا اختار المستخدم "موافق"، يتم إرسال النموذج
    }
</script>

</head>
<body>

<div class="container">
    <h2>بيانات الموظفين</h2>

    <!-- الرسالة الخاصة بالاضافة أو الحذف -->
    <?php if ($message): ?>
        <div class="message <?php echo (strpos($message, 'لم تتم') !== false) ? 'error' : ''; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <!-- نموذج البحث عن موظف -->
    <div class="form-section">
        <form method="post" action="">
            <input type="text" name="search" placeholder="ابحث عن الموظف بواسطة رقم الموظف" />
            <input type="submit" value="بحث" />
        </form>
    </div>

    <!-- عرض تفاصيل الموظف إذا تم العثور عليه -->
    <?php if ($emp && mysql_num_rows($emp) > 0): ?>
        <h3>تفاصيل الموظف:</h3>
        <table>
            <tr>
                <th>رقم الموظف</th>
                <th>الاسم الأول</th>
                <th>الاسم الثاني</th>
                <th>رقم الهاتف</th>
                <th>العنوان</th>
                <th>المؤهل الدراسي</th>
                <th>تاريخ الميلاد</th>
                <th>تاريخ التعيين</th>
                <th>المؤهل الأكاديمي</th>
            </tr>
            <?php while ($row = mysql_fetch_assoc($emp)): ?>
                <tr>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['secondname']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['degree']; ?></td>
                    <td><?php echo $row['birthdate']; ?></td>
                    <td><?php echo $row['employment']; ?></td>
                    <td><?php echo $row['academicqualification']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- نموذج حذف الموظف -->
        <form method="post" action="" onsubmit="return confirmDelete();">
            <input type="hidden" name="delete_emp_id" value="<?php echo $row['emp_id']; ?>" />
            <input type="submit" value="حذف الموظف" />
        </form>
    <?php endif; ?>

    <!-- نموذج إضافة موظف -->
    <h3>إضافة موظف جديد</h3>
    <div class="form-section">
        <form method="POST" action="">
            <input type="hidden" name="MM_insert" value="form1" />
            <input type="text" name="emp_id" placeholder="رقم الموظف" />
            <input type="text" name="firstname" placeholder="الاسم الأول" />
            <input type="text" name="secondname" placeholder="الاسم الثاني" />
            <input type="text" name="telephone" placeholder="رقم الهاتف" />
            <input type="text" name="address" placeholder="العنوان" />
            <input type="text" name="degree" placeholder="المؤهل الدراسي" />
            <input type="text" name="birthdate" placeholder="تاريخ الميلاد" />
            <input type="text" name="employment" placeholder="تاريخ التعيين" />
            <input type="text" name="academicqualification" placeholder="المؤهل الأكاديمي" />
            <input type="submit" value="إضافة" />
        </form>
    </div>

    <!-- زر العودة إلى صفحة admen.php -->
    <div class="form-section">
        <button onclick="window.location.href='admen.php';">العودة إلى الصفحة الرئيسية</button>
    </div>
</div>

</body>
</html>
