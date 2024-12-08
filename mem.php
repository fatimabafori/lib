<?php 
require_once('Connections/coon.php'); 

// تحديث الاتصال بقاعدة البيانات libdatabase
mysql_select_db('libdatabase', $coon); // تغيير قاعدة البيانات إلى libdatabase

// استعلام البحث إذا تم إرسال نموذج البحث
if (isset($_POST['search_member'])) {
    $search_memberno = mysql_real_escape_string($_POST['search_memberno']);
    $query = "SELECT * FROM mem WHERE memberno = '$search_memberno'";
} else {
    // إذا لم يتم إرسال استعلام بحث
    $query = "SELECT * FROM mem";
}

// تنفيذ عملية الحذف إذا تم إرسال رقم العضو عبر POST
if (isset($_POST['delete_memberno'])) {
    $delete_memberno = mysql_real_escape_string($_POST['delete_memberno']);
    $delete_query = "DELETE FROM mem WHERE memberno = '$delete_memberno'";
    mysql_query($delete_query, $coon) or die(mysql_error());
    echo "تم حذف العضو بنجاح!";
}

// تنفيذ استعلام العرض
$result = mysql_query($query, $coon) or die(mysql_error());

// إذا تم إرسال النموذج عبر POST، نقوم بإضافة البيانات إلى قاعدة البيانات
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['MM_insert'])) {
    // استخراج البيانات من النموذج
    $memberno = mysql_real_escape_string($_POST['memberno']);
    $name = mysql_real_escape_string($_POST['name']);
    $college = mysql_real_escape_string($_POST['college']);
    $telephone = mysql_real_escape_string($_POST['telephone']);
    $address = mysql_real_escape_string($_POST['address']);
    $degree = mysql_real_escape_string($_POST['degree']); // أخذ الدرجة من القائمة المنسدلة

    // استعلام لإدخال البيانات الجديدة
    $insert_query = "INSERT INTO mem (memberno, name, college, telephone, address, degree) 
                     VALUES ('$memberno', '$name', '$college', '$telephone', '$address', '$degree')";
    $insert_result = mysql_query($insert_query, $coon) or die(mysql_error());

    if ($insert_result) {
        echo "تم إضافة العضو بنجاح!";
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>عرض الأعضاء</title>
<style>
    body {
        background-color: #87CEEB; /* خلفية باللون الأزرق الفاتح */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        color: #333;
        direction: rtl; /* الاتجاه من اليمين لليسار */
    }

    h2 {
        text-align: center;
        color: #2E3B4E;
        margin-top: 30px;
    }

    /* تخصيص الجدول ليتناسب مع المساحة بشكل متناسق */
    table {
        width: 95%; /* جعل الجدول يأخذ مساحة أكبر قليلاً */
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

    .form-container input[type="text"], .form-container select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-container input[type="submit"] {
        background-color: #007BFF; /* اللون الأزرق */
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 4px;
        display: block;
        margin: 20px auto;
    }

    .form-container input[type="submit"]:hover {
        background-color: #0056b3; /* اللون الأزرق الداكن عند المرور */
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

    .search-btn:focus {
        outline: none;
    }

    .no-results {
        color: #dc3545;
        text-align: center;
        font-size: 16px;
        margin-top: 20px;
    }

    /* تخصيص زر العودة ليظهر في أسفل الصفحة */
    .back-btn {
        background-color: #007BFF; /* اللون الأزرق */
        position: relative;
        padding: 10px 20px;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        display: block;
        margin: 20px auto 0; /* مسافة بين الزر والاستمارة */
    }

    .back-btn:hover {
        background-color: #0056b3; /* اللون الأزرق الداكن عند المرور */
    }
</style>
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

    <!-- عرض نتائج البحث إذا كانت موجودة -->
    <?php if (isset($search_memberno)) { 
        if (mysql_num_rows($result) == 0) { ?>
            <div class="no-results">لا توجد نتائج تطابق رقم العضو المدخل.</div>
        <?php } else { ?>
            <!-- جدول الأعضاء يظهر فقط إذا كان هناك نتائج -->
            <table id="mem" border="1" cellpadding="5" cellspacing="0" align="center">
                <thead>
                    <tr>
                        <th>رقم العضو</th>
                        <th>الاسم</th>
                        <th>الكلية</th>
                        <th>التلفون</th>
                        <th>العنوان</th>
                        <th>الدرجة العلمية</th>
                        <th>العملية</th> <!-- عمود جديد للعمليات مثل الحذف -->
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
                        <td>
                            <!-- زر الحذف -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="display:inline;">
                                <input type="hidden" name="delete_memberno" value="<?php echo $row['memberno']; ?>" />
                                <input type="submit" value="حذف" style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; cursor: pointer;" />
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } 
    } ?>

    <!-- استمارة إضافة عضو جديد -->
    <h2>إضافة عضو جديد</h2>
    <div class="form-container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="memberno" placeholder="رقم العضو" required />
            <input type="text" name="name" placeholder="اسم العضو" required />
            <input type="text" name="college" placeholder="الكلية" required />
            <input type="text" name="telephone" placeholder="رقم التلفون" required />
            <input type="text" name="address" placeholder="العنوان" required />

            <!-- القائمة المنسدلة للدرجة العلمية -->
            <select name="degree" required>
                <option value="" disabled selected>اختر الدرجة العلمية</option>
                <option value="بكالوريوس">بكالوريوس</option>
                <option value="ماجستير">ماجستير</option>
                <option value="دكتوراه">دكتوراه</option>
            </select>

            <input type="submit" name="MM_insert" value="إضافة عضو" />
        </form>
    </div>

    <!-- زر العودة إلى الصفحة الرئيسية -->
    <button class="back-btn" onclick="window.location.href='admen.php';">العودة إلى الصفحة الرئيسية</button>
</body>
</html>
