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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['id'])) {
  $loginUsername=$_POST['id'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "main.php";
  $MM_redirectLoginFailed = "a.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_coon, $coon);
  
  $LoginRS__query=sprintf("SELECT id, password FROM lo WHERE id=%s AND password=%s",
    GetSQLValueString($loginUsername, "int"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $coon) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body {
	background-color: #999;
}
body,td,th {
	font-size: 24px;
}
</style>
</head>

<body>
<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
  <p>
  <label for="password">
    <div align="center">
    <div align="right">
      <p align="center">user<br />
      </p>
      <p align="center"><img src="pic/png-clipart-computer-icons-user-icon-design-numerous-miscellaneous-logo.png" width="693" height="232" /><br />
        <br />
      </p>
  </div>
  </label>
  <div align="right"></div>
  <table width="327" height="166" border="0">
  <tr>
    <td width="317" bgcolor="#999999"><input type="text" name="id" id="id" />      
      اسم المستخدم</td>
  </tr>
  <tr>
    <td bgcolor="#999999"><label for="id"></label>
      <label for="password3"></label>
      <input type="password" name="password" id="password3" />
كلمة المرور</td>
  </tr>
  <tr>
    <td height="104" bgcolor="#999999"><p><a href="lo admen.php"></a>
        <input type="submit" name="y7" id="y7" value="دخول" />
    </p>
      <p align="center">&nbsp;</p>
      <p>&nbsp; </p></td>
  </tr>
</table>
  <p>&nbsp;</p>
<p>
    <label for="t6"></label>
</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
</body>
</html>