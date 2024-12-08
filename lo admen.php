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

$error_message = ''; // لتخزين رسالة الخطأ

if (isset($_POST['admen'])) {
  $loginUsername = $_POST['admen'];
  $password = $_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "admen.php";
  $MM_redirectLoginFailed = "a.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_coon, $coon);
  
  $LoginRS__query = sprintf("SELECT id, password FROM admen WHERE id=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "int")); 
   
  $LoginRS = mysql_query($LoginRS__query, $coon) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    if (PHP_VERSION >= 5.1) { session_regenerate_id(true); } else { session_regenerate_id(); }
    
    // declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	  

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  } else {
    $error_message = "اسم المستخدم أو كلمة المرور غير صحيحة!";
  }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
<style type="text/css">
/* تنسيق الصفحة */
body {
  background: linear-gradient(to bottom, #a0c8e2, #bce2f0); /* درجات اللون اللبني */
  font-family: Arial, sans-serif;
  color: #333;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  text-align: center;
}

h1 {
  font-size: 36px;
  color: #333;
  margin-bottom: 20px;
}

/* تنسيق الصورة */
img {
  width: 250px;
  height: 250px;
  margin-bottom: 20px;
  border-radius: 50%;
}

/* تنسيق النموذج */
form {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  width: 100%;
  max-width: 400px;
}

input[type="text"], input[type="password"] {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  background-color: #fff;
}

input[type="submit"] {
  width: 100%;
  padding: 15px;
  background-color: #a0c8e2;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s;
}

input[type="submit"]:hover {
  background-color: #8bbad9;
}

/* تنسيق الجدول */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

td {
  padding: 15px;
  color: #333;
}

td input {
  background-color: #f0f0f0;
  color: #333;
  border: 1px solid #ccc;
}

/* إضافة تأثيرات */
a {
  color: #333;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* رسالة الخطأ */
.error-message {
  color: red;
  font-size: 16px;
  margin-top: 10px;
}
</style>
</head>

<body>
  <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
    <h1><strong>Admin Login</strong></h1>
    <img src="pic/5700c04197ee9a4372a35ef16eb78f4e.jpg" alt="Admin Login Image" />
    
    <?php if ($error_message): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    
    <table>
      <tr>
        <td><input type="text" name="admen" id="admen" placeholder="اسم المستخدم" required /></td>
      </tr>
      <tr>
        <td><input type="password" name="password" id="password" placeholder="كلمة المرور" required /></td>
      </tr>
      <tr>
        <td><input type="submit" name="button" id="button" value="دخول" /></td>
      </tr>
    </table>
  </form>
</body>
</html>
