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
  $insertSQL = sprintf("INSERT INTO books_info (registering_no, classification_no, bookaddress, authorname, edition, publication_address, publisher, `date`, pages_numbers, `size`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['registering_no'], "int"),
                       GetSQLValueString($_POST['classification_no'], "double"),
                       GetSQLValueString($_POST['bookaddress'], "text"),
                       GetSQLValueString($_POST['authorname'], "text"),
                       GetSQLValueString($_POST['edition'], "text"),
                       GetSQLValueString($_POST['publication_address'], "text"),
                       GetSQLValueString($_POST['publisher'], "text"),
                       GetSQLValueString($_POST['date'], "date"),
                       GetSQLValueString($_POST['pages_numbers'], "int"),
                       GetSQLValueString($_POST['size'], "double"));

  mysql_select_db($database_coon, $coon);
  $Result1 = mysql_query($insertSQL, $coon) or die(mysql_error());
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_coon, $coon);
$query_Recordset1 = "SELECT * FROM books_info";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Registering_no:</td>
      <td><input type="text" name="registering_no" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Classification_no:</td>
      <td><input type="text" name="classification_no" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bookaddress:</td>
      <td><input type="text" name="bookaddress" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Authorname:</td>
      <td><input type="text" name="authorname" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Edition:</td>
      <td><input type="text" name="edition" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Publication_address:</td>
      <td><input type="text" name="publication_address" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Publisher:</td>
      <td><input type="text" name="publisher" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date:</td>
      <td><input type="text" name="date" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pages_numbers:</td>
      <td><input type="text" name="pages_numbers" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Size:</td>
      <td><input type="text" name="size" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <table border="1" cellpadding="10" cellspacing="3">
    <tr>
      <td>registering_no</td>
      <td>classification_no</td>
      <td>bookaddress</td>
      <td>authorname</td>
      <td>edition</td>
      <td>publication_address</td>
      <td>publisher</td>
      <td>date</td>
      <td>pages_numbers</td>
      <td>size</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['registering_no']; ?></td>
        <td><?php echo $row_Recordset1['classification_no']; ?></td>
        <td><?php echo $row_Recordset1['bookaddress']; ?></td>
        <td><?php echo $row_Recordset1['authorname']; ?></td>
        <td><?php echo $row_Recordset1['edition']; ?></td>
        <td><?php echo $row_Recordset1['publication_address']; ?></td>
        <td><?php echo $row_Recordset1['publisher']; ?></td>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['pages_numbers']; ?></td>
        <td><?php echo $row_Recordset1['size']; ?></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
<input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
