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

// إجراء الحذف عند الضغط على الزر
if ((isset($_GET['user'])) && ($_GET['user'] != "")) {
    $deleteSQL = sprintf("DELETE FROM queries WHERE `user`=%s",
                         GetSQLValueString($_GET['user'], "text"));

    mysql_select_db($database_coon, $coon);
    $Result1 = mysql_query($deleteSQL, $coon) or die(mysql_error());

    // رسالة تأكيد تم الحذف
    echo "<script>alert('تم الحذف بنجاح');</script>";

    // إعادة تحميل الصفحة بعد الحذف
    echo "<script>window.location.href = 'qq.php';</script>";
}

// استعلام لجلب البيانات
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
    $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_coon, $coon);
$query_Recordset1 = "SELECT * FROM queries";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $coon) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
    $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
    $all_Recordset1 = mysql_query($query_Recordset1);
    $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Delete Query Records</title>
    <style>
        body {
            background-color: #add8e6; /* اللون الأزرق اللبني */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            color: #333;
            padding-top: 20px;
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #5ca8e0;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input[type="submit"] {
            background-color: #f44336; /* لون أحمر */
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #e53935;
        }
        input[type="button"] {
            background-color: #4CAF50; /* لون أخضر */
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }
        input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<h1>الملاحظات والاستفسارات</h1>
<table>
    <tr>
            <th>حذف</th>
            <th>المستخدم</th>
            <th>الملاحظات</th>
        </tr>
        <?php do { ?>
            <tr>
                <td>
                    <form id="form1" name="form1" method="get" action="">
                        <input type="submit" name="delete" value="حذف" onclick="return confirm('هل أنت متأكد أنك تريد حذف هذا السجل؟');" />
                        <input type="hidden" name="user" value="<?php echo $row_Recordset1['user']; ?>" />
                    </form>
                </td>
                <td><?php echo $row_Recordset1['user']; ?></td>
                <td><?php echo $row_Recordset1['nots']; ?></td>
            </tr>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
<form name="form2" method="post" action="">
  <input type="button" name="back" id="back" value="عودة" onclick="window.location.href='admen.php';" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
