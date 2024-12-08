<?php 
require_once('Connections/coon.php'); 

// تحديد الاتصال بقاعدة البيانات
mysql_select_db('libdatabase', $coon); 

// استعلام البحث إذا تم إرسال نموذج البحث
if (isset($_POST['search_member'])) {
    $search_memberno = mysql_real_escape_string($_POST['search_memberno']);
    $query = "SELECT * FROM mem WHERE memberno = '$search_memberno'"; // استعلام للبحث عن العضو حسب الرقم
} else {
    // إذا لم يكن هناك بحث، استعلام لجلب جميع الأعضاء
    $query = "SELECT * FROM mem";
}


// استعلام لإظهار الأعضاء بنفس الدرجة العلمية عند الضغط على الزر
if (isset($_POST['search_degree'])) {
    $degree = mysql_real_escape_string($_POST['degree']);
    $query = "SELECT * FROM mem WHERE degree = '$degree'"; // استعلام لجلب الأعضاء بنفس الدرجة العلمية
}

$result = mysql_query($query, $coon) or die(mysql_error()); // تنفيذ الاستعلام والتحقق من الأخطاء

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>عرض الأعضاء</title>
<style>
    body {
        background-color: #87CEEB;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        direction: rtl;
    }

    h2 {
        text-align: center;
        color: #2E3B4E;
        margin-top: 30px;
    }

    table {
        width: 95%;
        margin: 30px auto;
        border-collapse: collapse;
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #007BFF;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #e9f3fb;
    }

    .form-container {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-container input[type="text"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container input[type="submit"] {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        display: block;
        margin: 20px auto;
    }

    .form-container input[type="submit"]:hover {
        background-color: #218838;
    }

    .button-container {
        text-align: center;
        margin: 20px 0;
    }

    .search-btn {
        background-color: #17a2b8;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        margin: 10px;
    }

    .search-btn:hover {
        background-color: #138496;
    }

</style>
<script>
    // دالة لإظهار الجدول عند الضغط على زر "عرض الأعضاء"
    function showMembers() {
        document.getElementById('mem').style.display = 'block';
    }
</script>
</head>

<body>
    <h2>عرض الأعضاء في الجدول</h2>

    <!-- نموذج بحث حسب رقم العضو -->
    <div class="button-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="search_memberno" placeholder="أدخل رقم العضو للبحث" required />
            <input type="submit" name="search_member" value="بحث" class="search-btn"/>
        </form>
    </div>

    <!-- زر لإظهار الأعضاء بنفس الدرجة العلمية -->
    <div class="button-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" name="degree" placeholder="أدخل الدرجة العلمية" required />
            <input type="submit" name="search_degree" value="إظهار الأعضاء بنفس الدرجة العلمية" class="search-btn"/>
        </form>
    </div>

    <!-- جدول الأعضاء -->
    <?php if (mysql_num_rows($result) > 0) { ?>
        <table id="mem" border="1" cellpadding="5" cellspacing="0" align="center">
            <thead>
                <tr>
                    <th>رقم العضو</th>
                    <th>الاسم</th>
                    <th>الكلية</th>
                    <th>التلفون</th>
                    <th>العنوان</th>
                    <th>الدرجة العلمية</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysql_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['memberno']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['college']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['degree']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p style="text-align: center; color: red;">لا توجد نتائج لرقم العضو المدخل أو الدرجة العلمية!</p>
    <?php } ?>

    <!-- نموذج إضافة عضو جديد -->
</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات بعد عرض الأعضاء
mysql_close($coon);
?>
