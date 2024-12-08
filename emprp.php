<?php
// الاتصال بقاعدة البيانات باستخدام mysql
require_once('Connections/coon.php');

// تعيين الترميز إلى UTF-8 قبل بدء الاستعلامات
mysql_query("SET NAMES 'utf8'") or die(mysql_error());

// تغيير قاعدة البيانات إلى libdatabase2023-09-13
mysql_select_db('libdatabase', $coon) or die(mysql_error());

// استعلام لاسترجاع كافة الموظفين
$query_emp = "SELECT * FROM employee";
$emp = mysql_query($query_emp) or die(mysql_error());

// إذا تم إرسال طلب البحث
$search_result = "";
$search_output = "";
$search_data = "";

// إذا تم الضغط على زر "عرض كافة الموظفين"
if (isset($_POST['show_all'])) {
    $emp_filtered = mysql_query($query_emp) or die(mysql_error());
} elseif (isset($_POST['search'])) { // إذا تم البحث
    $search_query = mysql_real_escape_string($_POST['search_query']); // اسم الموظف
    $search_field = mysql_real_escape_string($_POST['search_field']); // الحقل الذي سيتم البحث فيه

    // بناء استعلام البحث باستخدام اسم الموظف والحقل المختار
    $query_search = "SELECT * FROM employee WHERE firstname LIKE '%$search_query%' OR secondname LIKE '%$search_query%'";
    $search_result = "نتائج البحث:";
    $search_output = "";
    $emp_search = mysql_query($query_search) or die(mysql_error());

    if (mysql_num_rows($emp_search) > 0) {
        while ($row = mysql_fetch_assoc($emp_search)) {
            // عرض اسم الموظف مع الحقل الذي تم اختياره (مثل رقم الهاتف أو العنوان)
            $search_output .= "الاسم: " . $row['firstname'] . " " . $row['secondname'] . "<br>";
            $search_output .= ucfirst($search_field) . ": " . $row[$search_field] . "<br><br>";
        }
    } else {
        $search_output = "لا توجد نتائج للبحث.";
    }
} else {
    $emp_filtered = mysql_query($query_emp) or die(mysql_error()); // استرجاع كافة الموظفين عند عدم وجود بحث أو عرض محدد
}

// إذا تم تحديد مؤهل أكاديمي
$qualification_filter = "";
if (isset($_POST['qualification'])) {
    $qualification = mysql_real_escape_string($_POST['qualification']); // المؤهل الأكاديمي
    if ($qualification != "") {
        $qualification_filter = " WHERE academicqualification = '$qualification'";
    }
}

// استعلام لاسترجاع الموظفين حسب المؤهل الأكاديمي
$query_emp_filtered = "SELECT * FROM employee" . $qualification_filter;
$emp_filtered = mysql_query($query_emp_filtered) or die(mysql_error());
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>بيانات الموظفين</title>
    <style type="text/css">
        /* تحسين الشكل */
        body {
            background-color: #d0e7f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            margin: 10px 0;
            padding: 5px;
            border-collapse: collapse;
        }

        td, th {
            padding: 8px;
            text-align: right;
            font-size: 14px;
        }

        form {
            width: 100%;
            margin-bottom: 20px;
        }

        button[type="submit"] {
            width: auto;
            padding: 10px 20px;
        }

        select, input[type="text"] {
            padding: 10px;
            width: 100%;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        /* تنسيق الرسائل */
        .message {
            text-align: center;
            color: #fff;
            background-color: #4CAF50;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error {
            background-color: #f44336;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>بيانات الموظفين</h2>

    <!-- استمارة البحث عن الموظف -->
    <form method="POST" action="">
        <label for="search_query">ابحث عن الموظف:</label>
        <input type="text" name="search_query" id="search_query" placeholder="أدخل اسم الموظف فقط...">

        <label for="search_field">ابحث في:</label>
        <select name="search_field" id="search_field">
            <option value="telephone">رقم الهاتف</option>
            <option value="address">العنوان</option>
            <option value="employment">تاريخ التعيين</option>
        </select>
        <button type="submit" name="search">بحث</button>
    </form>

    <!-- استمارة اختيار المؤهل الأكاديمي -->
    <form method="POST" action="">
        <label for="qualification">اختر المؤهل الأكاديمي:</label>
        <select name="qualification" id="qualification">
            <option value="">جميع المؤهلات</option>
            <option value="ثانوي">ثانوي</option>
            <option value="جامعي">جامعي</option>
        </select>
        <button type="submit">عرض</button>
    </form>

    <!-- زر عرض كافة الموظفين -->
    <form method="POST" action="">
        <button type="submit" name="show_all">عرض كافة الموظفين</button>
    </form>

    <!-- عرض نتيجة البحث -->
    <?php if ($search_result): ?>
        <div class="message">
            <h3><?php echo $search_result; ?></h3>
            <p><?php echo $search_output; ?></p>
        </div>
    <?php endif; ?>

    <!-- عرض تفاصيل الموظفين في جدول -->
    <?php if (!isset($_POST['search'])): ?>
        <h3>قائمة الموظفين:</h3>
        <table>
            <tr>
                <th>رقم الموظف</th>
                <th>الاسم الأول</th>
                <th>الاسم الثاني</th>
                <th>رقم الهاتف</th>
                <th>العنوان</th>
                <th>المؤهل الدراسي</th>
                <th>تاريخ الميلاد</th>
                <th>تاريخ التعيين</th>
                <th>المؤهل الأكاديمي</th>
            </tr>
            <?php if (mysql_num_rows($emp_filtered) > 0): ?>
                <?php while ($row = mysql_fetch_assoc($emp_filtered)): ?>
                <tr>
                    <td><?php echo $row['emp_id']; ?></td>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['secondname']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['degree']; ?></td>
                    <td><?php echo $row['birthdate']; ?></td>
                    <td><?php echo $row['employment']; ?></td>
                    <td><?php echo $row['academicqualification']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">لا توجد نتائج للبحث.</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// إغلاق الاتصال بقاعدة البيانات
mysql_close($coon);
?>
