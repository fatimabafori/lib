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
  $insertSQL = sprintf("INSERT INTO books_info (registering_no, classification_no, bookaddress, authorname, edition, publication_address, publisher, `date`, pages_numbers, `size`, dept_no) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
                       GetSQLValueString($_POST['dept_no'], "int"));

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
$query_Recordset1 = "SELECT * FROM admen";
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

mysql_select_db($database_coon, $coon);
$query_Recordset2 = "SELECT * FROM books_info";
$Recordset2 = mysql_query($query_Recordset2, $coon) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
SELECT
    b.registering_no,
    b.classification_no,
    b.bookaddress,
    b.authorname,
    b.edition,
    b.publication_address,
    b.publisher,
    b.date AS publication_date,
    b.pages_numbers,
    b.size,
    d.deptname AS department_name
FROM
    book_info b
JOIN
    dept d
ON
    b.dept_no = d.dept_noPrimary
ORDER BY
    d.deptname, b.authorname, b.title;

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>بحث عن كتاب</title>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Registering_no:</td>
      <td><input type="text" name="registering_no" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Classification_no:</td>
      <td><input type="text" name="classification_no" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Bookaddress:</td>
      <td><input type="text" name="bookaddress" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Authorname:</td>
      <td><input type="text" name="authorname" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Edition:</td>
      <td><input type="text" name="edition" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Publication_address:</td>
      <td><input type="text" name="publication_address" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Publisher:</td>
      <td><input type="text" name="publisher" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Date:</td>
      <td><input type="text" name="date" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Pages_numbers:</td>
      <td><input type="text" name="pages_numbers" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Size:</td>
      <td><input type="text" name="size" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Dept_no:</td>
      <td><input type="text" name="dept_no" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
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
      <td>dept_no</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset2['registering_no']; ?></td>
        <td><?php echo $row_Recordset2['classification_no']; ?></td>
        <td><?php echo $row_Recordset2['bookaddress']; ?></td>
        <td><?php echo $row_Recordset2['authorname']; ?></td>
        <td><?php echo $row_Recordset2['edition']; ?></td>
        <td><?php echo $row_Recordset2['publication_address']; ?></td>
        <td><?php echo $row_Recordset2['publisher']; ?></td>
        <td><?php echo $row_Recordset2['date']; ?></td>
        <td><?php echo $row_Recordset2['pages_numbers']; ?></td>
        <td><?php echo $row_Recordset2['size']; ?></td>
        <td><?php echo $row_Recordset2['dept_no']; ?></td>
      </tr>
      <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
  </table>
<input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</head>
<body>
<h2>بحث عن كتاب باستخدام رقم التسجيل</h2>

    <!-- نموذج البحث -->
<form method="POST" action="search_book.php">
        <label for="registering_no">أدخل رقم التسجيل:</label>
        <input type="text" id="registering_no" name="registering_no" required>
        <button type="submit">بحث</button>
    </form>

    <?php
    if (isset($_POST['registering_no'])) {
        $registering_no = $_POST['registering_no'];

        // الاتصال بقاعدة البيانات
        $host = "localhost"; // اسم المضيف
        $username = "root"; // اسم المستخدم
        $password = ""; // كلمة المرور
        $dbname = "libdatabase"; // اسم قاعدة البيانات

        // إنشاء اتصال
        $conn = new mysqli($host, $username, $password, $dbname);

        // التحقق من الاتصال
        if ($conn->connect_error) {
            die("فشل الاتصال: " . $conn->connect_error);
        }

        // الاستعلام عن الكتاب باستخدام رقم التسجيل
        $sql = "SELECT * FROM books_info WHERE registering_no = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $registering_no);  // "s" يعني أن الرقم هو نص (String)
        $stmt->execute();
        $result = $stmt->get_result();

        // عرض النتائج
        if ($result->num_rows > 0) {
            echo "<h3>النتائج:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "<p><strong>اسم الكتاب:</strong> " . $row['book_title'] . "<br>";
                echo "<strong>المؤلف:</strong> " . $row['author'] . "<br>";
                echo "<strong>رقم التسجيل:</strong> " . $row['registering_no'] . "</p>";
            }
        } else {
            echo "<p>لم يتم العثور على كتاب بهذا الرقم.</p>";
        }

        // غلق الاتصال
        $conn->close();
    }
    ?>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
</body>
</html>