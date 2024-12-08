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

$error_message = '';  // المتغير الخاص برسالة الخطأ

if (isset($_POST['id'])) {
    $loginUsername = $_POST['id'];
    $password = $_POST['password'];
    $MM_fldUserAuthorization = "";
    $MM_redirectLoginSuccess = "main.php";
    $MM_redirectLoginFailed = "a.php";
    $MM_redirecttoReferrer = false;
    mysql_select_db($database_coon, $coon);
    
    $LoginRS__query = sprintf(
        "SELECT id, password FROM lo WHERE id=%s AND password=%s",
        GetSQLValueString($loginUsername, "int"), 
        GetSQLValueString($password, "text")
    );

    $LoginRS = mysql_query($LoginRS__query, $coon) or die(mysql_error());
    $loginFoundUser = mysql_num_rows($LoginRS);
    
    if ($loginFoundUser) {
        $loginStrGroup = "";
        
        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(true);
        } else {
            session_regenerate_id();
        }

        // declare two session variables and assign them
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;

        if (isset($_SESSION['PrevUrl']) && false) {
            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
        }
        
        header("Location: " . $MM_redirectLoginSuccess );
    } else {
        $error_message = "حاول مرة أخرى: اسم المستخدم أو كلمة المرور خاطئة.";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- لجعل الصفحة متوافقة مع الأجهزة المحمولة -->
    <title>تسجيل الدخول</title>
    <!-- تضمين Font Awesome عبر CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* تحسين مظهر الصفحة */
        body {
            font-family: Arial, sans-serif;
            background-color: #e1efff; /* لون خلفية أزرق فاتح */
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* تنسيق النموذج */
        form {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            margin: 10vh auto; /* نستخدم vh لتحسين العرض على الشاشات المختلفة */
            padding: 50px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            color: #0077b6;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* تنسيق الحقول */
        .input-container {
            position: relative;
            margin-bottom: 25px;
        }

        .input-container input {
            width: 100%;
            padding: 12px 30px;
            border: 1px solid #0077b6;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f1f9ff;
        }

        .input-container i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #0077b6;
        }

        /* تنسيق زر الدخول */
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #0077b6;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005f89;
        }

        /* تنسيق الصورة */
        img {
            width: 300px;
            margin-bottom: 40px;
        }

        /* تنسيق رسالة الخطأ */
        .error-message {
            color: #d9534f;
            font-size: 16px;
            margin-top: 20px;
            padding: 10px;
            background-color: #f2dede;
            border: 1px solid #d9534f;
            border-radius: 5px;
        }

        /* استعلامات الإعلام لتصميم متجاوب */
        @media (max-width: 768px) {
            form {
                padding: 30px;
            }

            form h2 {
                font-size: 20px;
            }

            .input-container input {
                font-size: 14px;
            }

            input[type="submit"] {
                font-size: 14px;
            }

            img {
                width: 50px;
            }
        }
    </style>
</head>

<body>

<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
    <h2>تسجيل الدخول</h2>
    <img src="pic/png-clipart-computer-icons-user-icon-design-numerous-miscellaneous-logo.png" alt="User Icon" />
    
    <!-- حقل اسم المستخدم مع أيقونة مستخدم -->
    <div class="input-container">
        <i class="fas fa-user"></i>
        <input type="text" name="id" id="id" placeholder="اسم المستخدم" required />
    </div>
    
    <!-- حقل كلمة المرور مع أيقونة قفل -->
    <div class="input-container">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password3" placeholder="كلمة المرور" required />
    </div>
    
    <div>
        <input type="submit" name="y7" id="y7" value="دخول" />
    </div>
    
    <?php if ($error_message != ''): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
</form>

</body>
</html>
