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

if ((isset($_GET['registering_no'])) && ($_GET['registering_no'] != "")) {
  $deleteSQL = sprintf("DELETE FROM books_info WHERE registering_no=%s",
                       GetSQLValueString($_GET['registering_no'], "int"));

  mysql_select_db($database_coon, $coon);
  $Result1 = mysql_query($deleteSQL, $coon) or die(mysql_error());

  $deleteGoTo = "xxxx.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_POST['registering_no'])) && ($_POST['registering_no'] != "")) {
  $deleteSQL = sprintf("DELETE FROM books_info WHERE registering_no=%s",
                       GetSQLValueString($_POST['registering_no'], "int"));

  mysql_select_db($database_coon, $coon);
  $Result1 = mysql_query($deleteSQL, $coon) or die(mysql_error());

  $deleteGoTo = "xxxx.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

mysql_select_db($database_coon, $coon);
$query_Recordset1 = "SELECT * FROM books_info";
$Recordset1 = mysql_query($query_Recordset1, $coon) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ASMO-708" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
