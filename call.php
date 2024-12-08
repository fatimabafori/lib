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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO queries (`user`, nots) VALUES (%s, %s)",
                       GetSQLValueString($_POST['user'], "text"),
                       GetSQLValueString($_POST['nots'], "text"));

  mysql_select_db($database_coon, $coon);
  $Result1 = mysql_query($insertSQL, $coon) or die(mysql_error());
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحسين الصفحة</title>
    <style>
        body {
            background-color: #ADD8E6; /* لون أزرق لبني */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            direction: rtl; /* جعل اتجاه النص من اليمين لليسار */
        }
        table {
            margin-top: 50px;
            background-color: #fff;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 20px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        td {
            padding: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4682B4; /* لون أزرق */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
        }
        input[type="submit"]:hover {
            background-color: #5A9BD5;
        }
        .back-btn {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            background-color: #4682B4;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #5A9BD5;
        }
        /* تنسيق المحاذاة للحقول */
        td:first-child {
            text-align: right; /* محاذاة النصوص إلى اليمين */
        }
        td:last-child {
            text-align: left; /* محاذاة الحقول إلى اليسار */
        }
    </style>
    <script>
        function validateForm() {
            var user = document.forms["form1"]["user"].value;
            var nots = document.forms["form1"]["nots"].value;
            if (user == "" || nots == "") {
                alert("من فضلك، قم بملء جميع الحقول.");
                return false;
            }
        }
    </script>
</head>
<body>

    <form method="post" name="form1" action="<?php echo $editFormAction; ?>" onsubmit="return validateForm()">
        <table align="center">
            <tr valign="baseline">
                <td nowrap align="right">اسم المستخدم:</td>
                <td><input type="text" name="user" value="" size="32"></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right" valign="top">الملاحظات</td>
                <td><textarea name="nots" cols="50" rows="5"></textarea></td>
            </tr>
            <tr valign="baseline">
                <td nowrap align="right">&nbsp;</td>
                <td><input type="submit" value="ارسال"></td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p>
            <input type="hidden" name="MM_insert" value="form1">
        </p>
    </form>

    <a href="main.php" class="back-btn">العودة إلى الصفحة الرئيسية</a>

</body>
</html>
