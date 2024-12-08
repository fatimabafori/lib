<?php require_once('Connections/coon.php'); ?>

<?php
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

// إضافة كتاب
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    // التحقق إذا كان حقل الصورة فارغًا
    $img = empty($_POST['img']) ? NULL : GetSQLValueString($_POST['img'], "text");

    $insertSQL = sprintf(
        "INSERT INTO books_info (registering_no, classification_no, bookaddress, authorname, edition, publication_address, publisher, `date`, pages_numbers, `size`, dept_no, img) 
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
        GetSQLValueString($_POST['dept_no'], "int"),
        $img // إضافة حقل الصورة
    );

    mysql_select_db($database_coon, $coon);
    $Result1 = mysql_query($insertSQL, $coon) or die(mysql_error());
}

// حذف كتاب بناءً على رقم القيد
if ((isset($_POST["MM_delete"])) && ($_POST["MM_delete"] == "form2")) {
    $deleteSQL = sprintf("DELETE FROM books_info WHERE registering_no = %s",
                         GetSQLValueString($_POST['registering_no_delete'], "int"));

    mysql_select_db($database_coon, $coon);
    $Result2 = mysql_query($deleteSQL, $coon) or die(mysql_error());
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>إضافة وحذف كتاب</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #e0f7fa; /* اللون اللبني */
        color: #00796b; /* اللون الأخضر الداكن */
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #00796b;
        margin-top: 20px;
    }

    .form-container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        width: 80%; /* زيادة العرض ليكون عريض */
        margin: 20px auto;
    }

    table {
        width: 100%;
        margin-top: 20px;
    }

    td {
        padding: 8px;
        text-align: right; /* النصوص تكون على الجهة اليمنى */
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #00796b;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #2196f3; /* اللون الأزرق */
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 20px;
    }

    input[type="submit"]:hover {
        background-color: #1976d2; /* ظل داكن عند التمرير */
    }

    .delete-form {
        margin-top: 30px;
        text-align: center;
    }

    h2 {
        color: #00796b;
    }
</style>
</head>
<body>

<h1>نموذج إدارة الكتب</h1>

<div class="form-container">
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table>
            <tr valign="baseline">
                <td width="34%" nowrap="nowrap"><p align="center">رقم القيد :</p>                </td>
                <td width="66%"><input type="text" name="registering_no" value="" size="32" />    </td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">رقم التصنيف:</p>                </td>
                <td><input type="text" name="classification_no" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">اسم الكتاب:</p>                </td>
                <td><input type="text" name="bookaddress" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">المؤلف:</p>                </td>
                <td><input type="text" name="authorname" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">الطبعة:</p>                </td>
                <td><input type="text" name="edition" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">مكان النشر :</p>                </td>
                <td><input type="text" name="publication_address" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">الناشر:</p>                </td>
                <td><input type="text" name="publisher" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">التاريخ:</p>                </td>
                <td><input type="text" name="date" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">عدد الصفحات:</p>                </td>
                <td><input type="text" name="pages_numbers" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">الحجم:</p>                </td>
                <td><input type="text" name="size" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">رقم القسم</p>                </td>
                <td><input type="text" name="dept_no" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap"><p align="center">الصورة (اختياري):</p>                </td>
                <td><input type="text" name="img" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap">&nbsp;</td>
                <td><input type="submit" value="إضافة كتاب" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
  </form>
</div>

<!-- نموذج حذف الكتاب -->
<div class="delete-form form-container">
    <h2>حذف كتاب</h2>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
        <table>
            <tr valign="baseline">
                <td nowrap="nowrap">رقم القيد لحذف الكتاب :</td>
                <td><input type="text" name="registering_no_delete" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap">&nbsp;</td>
                <td><input type="submit" value="حذف كتاب" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_delete" value="form2" />
    </form>
</div>

</body>
</html>
