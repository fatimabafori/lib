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
  $insertSQL = sprintf("INSERT INTO metaphor (registering_no, name, cardno, collage, bookname, loandate, returndate, signature, libsymbol, violation, day) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['registering_no'], "int"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['cardno'], "int"),
                       GetSQLValueString($_POST['collage'], "text"),
                       GetSQLValueString($_POST['bookname'], "text"),
                       GetSQLValueString($_POST['loandate'], "date"),
                       GetSQLValueString($_POST['returndate'], "date"),
                       GetSQLValueString($_POST['signature'], "text"),
                       GetSQLValueString($_POST['libsymbol'], "text"),
                       GetSQLValueString($_POST['violation'], "text"),
                       GetSQLValueString($_POST['day'], "date"));

  mysql_select_db($database_coon, $coon);
  $Result1 = mysql_query($insertSQL, $coon) or die(mysql_error());

  $insertGoTo = "metaphor.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_coon, $coon);
$query_Recordset1 = "SELECT registering_no FROM metaphor";
$Recordset1 = mysql_query($query_Recordset1, $coon) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8">
<title>استمارة الاستعارة</title>
<style type="text/css">
    /* الإعدادات السابقة نفسها */
</style>
</head>

<body>

<div class="container">
    <h1>استمارة الاستعارة</h1>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table class="form-table">
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">رقم القيد</td>
                <td align="left"><input type="text" name="registering_no" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">الاسم</td>
                <td align="left"><input type="text" name="name" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">رقم البطاقة</td>
                <td align="left"><input type="text" name="cardno" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">الكلية</td>
                <td align="left"><input type="text" name="collage" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">اسم الكتاب</td>
                <td align="left"><input type="text" name="bookname" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">تاريخ الاستعارة</td>
                <td align="left"><input type="text" name="loandate" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">تاريخ الاسترجاع</td>
                <td align="left"><input type="text" name="returndate" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">التوقيع</td>
                <td align="left"><input type="text" name="signature" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">رمز المكتبة</td>
                <td align="left"><input type="text" name="libsymbol" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">الانتهاك</td>
                <td align="left"><input type="text" name="violation" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td align="right" nowrap="nowrap">اليوم</td>
                <td align="left"><input type="text" name="day" value="" size="32" /></td>
            </tr>
            <tr valign="baseline">
                <td nowrap="nowrap" align="left">&nbsp;</td>
                <td><input type="submit" value="اضافة" /></td>
            </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
    </form>
</div>

<button class="back-btn" onclick="window.location.href='admen.php';">العودة إلى الصفحة الرئيسية</button>

</body>
</html>

<?php
mysql_free_result($Recordset1);
?>
