<?php
// التعامل مع استعلامات قاعدة البيانات
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
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

// الاتصال بقاعدة البيانات
$host = "localhost"; // اسم المضيف
$username = "root"; // اسم المستخدم
$password = ""; // كلمة المرور
$dbname = "libdatabase"; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// تعريف مصفوفة مع أسماء الأعمدة باللغة العربية
$columnNames = array(
    "registering_no" => "رقم القيد",  
    "dept_no" => "رقم القسم",
    "book_title" => "عنوان الكتاب",
    "author" => "المؤلف",
    "publisher" => "الناشر",
    "year" => "السنة",
    "edition" => "الطبعة", 
    "isbn" => "رقم الكتاب الدولي",  
    "price" => "السعر",  
    "pages" => "عدد الصفحات",  // تم تغيير اسم الحقل هنا
    "classification_no" => "رقم التصنيف",  // تم تغيير اسم الحقل هنا
    "bookaddress" => "عنوان الكتاب",  
    "authorname" => "اسم المؤلف",  
    "publication_address" => "مكان النشر",  
    "pages_numbers" => "عدد الصفحات",  // تم تغيير اسم الحقل هنا
    "size" => "الحجم",  
    "date" => "تاريخ النشر",  
    "img" => "صورة"  // تم تغيير اسم الحقل هنا
);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بحث عن كتاب</title>
    <style type="text/css">
        /* إعدادات الصفحة */
        body {
            background-color: #ADD8E6; 
            color: #000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #333;
            text-align: center;
            padding: 20px;
            background-color: #004080; 
            color: white;
        }
        h3 {
            color: #333;
            margin-top: 20px;
            text-align: center;
        }
        form {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            width: 50%;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            text-align: center; 
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="text"] {
            width: 80%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #003366; 
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #004080;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .form-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>بحث عن كتاب باستخدام رقم القيد أو رقم القسم</h2>

<!-- نموذج البحث برقم القيد -->
<form method="POST" action="">
    <label for="registering_no">أدخل رقم القيد:</label>
    <input type="text" id="registering_no" name="registering_no" required>
    <button type="submit">كتاب معين</button>
</form>

<!-- نموذج البحث برقم القسم -->
<form method="POST" action="">
    <label for="dept_no">أدخل رقم القسم:</label>
    <input type="text" id="dept_no" name="dept_no" required>
    <button type="submit">قسم معين</button>
</form>

<!-- زر عرض جميع الكتب -->
<div class="form-container">
    <form method="POST" action="">
        <button type="submit" name="show_books">عرض الكتب</button>
    </form>
</div>

<?php
// البحث عن الكتاب باستخدام رقم القيد
if (isset($_POST['registering_no'])) {
    $registering_no = $_POST['registering_no'];

    $sql = "SELECT * FROM books_info WHERE registering_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $registering_no); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>النتائج:</h3>";
        echo '<div class="form-container">';
        echo "<table>";
        echo "<tr>";

        // عرض أسماء الأعمدة باللغة العربية
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $columnName = $field->name;
            if (isset($columnNames[$columnName])) {
                echo "<th>" . htmlspecialchars($columnNames[$columnName], ENT_QUOTES, 'UTF-8') . "</th>";
            } else {
                echo "<th>" . htmlspecialchars($columnName, ENT_QUOTES, 'UTF-8') . "</th>";
            }
        }
        echo "</tr>";

        // عرض بيانات الكتاب
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $column_value) {
                echo "<td>" . htmlspecialchars($column_value, ENT_QUOTES, 'UTF-8') . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo "<p>لم يتم العثور على كتب بهذا الرقم.</p>";
    }
}

// البحث عن الكتب باستخدام رقم القسم
if (isset($_POST['dept_no'])) {
    $dept_no = $_POST['dept_no'];

    $sql = "SELECT * FROM books_info WHERE dept_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dept_no); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>النتائج حسب القسم:</h3>";
        echo '<div class="form-container">';
        echo "<table>";
        echo "<tr>";

        // عرض أسماء الأعمدة باللغة العربية
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $columnName = $field->name;
            if (isset($columnNames[$columnName])) {
                echo "<th>" . htmlspecialchars($columnNames[$columnName], ENT_QUOTES, 'UTF-8') . "</th>";
            } else {
                echo "<th>" . htmlspecialchars($columnName, ENT_QUOTES, 'UTF-8') . "</th>";
            }
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $column_value) {
                echo "<td>" . htmlspecialchars($column_value, ENT_QUOTES, 'UTF-8') . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo "<p>لم يتم العثور على كتب بهذا القسم.</p>";
    }
}

// عرض جميع الكتب
if (isset($_POST['show_books'])) {
    $sql = "SELECT * FROM books_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>جميع الكتب:</h3>";
        echo '<div class="form-container">';
        echo "<table>";
        echo "<tr>";

        // عرض أسماء الأعمدة باللغة العربية
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $columnName = $field->name;
            if (isset($columnNames[$columnName])) {
                echo "<th>" . htmlspecialchars($columnNames[$columnName], ENT_QUOTES, 'UTF-8') . "</th>";
            } else {
                echo "<th>" . htmlspecialchars($columnName, ENT_QUOTES, 'UTF-8') . "</th>";
            }
        }
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $column_value) {
                echo "<td>" . htmlspecialchars($column_value, ENT_QUOTES, 'UTF-8') . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo '</div>';
    } else {
        echo "<p>لا توجد كتب لعرضها.</p>";
    }
}
?>

</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
