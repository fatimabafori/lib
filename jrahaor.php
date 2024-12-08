<?php
// فتح الاتصال بقاعدة البيانات
require_once('Connections/coon.php');

// تعيين الترميز إلى utf8
mysql_select_db($database_coon, $coon);
mysql_set_charset('utf8', $coon);  // تعيين الترميز إلى UTF-8

// استعلام لعرض الكتب التي تحتوي على dept_no يساوي 7
$query_Recordset2 = "SELECT * FROM books_info WHERE dept_no = 7";
$Recordset2 = mysql_query($query_Recordset2, $coon) or die(mysql_error());
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">  <!-- تأكد من تعيين الترميز إلى UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الكتب</title>
    <style>
        body {
            background-color: #A2C8E0; /* لون أزرق لبني */
            font-family: Arial, sans-serif; /* نوع الخط */
            color: #333; /* لون النص */
            direction: rtl; /* تحديد اتجاه النص من اليمين لليسار */
        }

        table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            background-color: #f9f9f9;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #5C9DAD; /* لون خلفية العناوين */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e6f1f7; /* تلوين الصفوف الزوجية */
        }

        tr:hover {
            background-color: #cfe0e9; /* تلوين الصف عند التمرير عليه */
        }

        /* نمط الصورة عند التكبير */
        .large-image {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .large-image img {
            max-width: 90%;
            max-height: 90%;
        }

        /* زر إغلاق الصورة */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 30px;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- عرض جميع الكتب في جدول -->
<table>
    <tr>
        <th>رقم القيد</th>
        <th>اسم الكتاب</th>
        <th>المؤلف</th>
        <th>عدد الصفحات</th>
        <th>رقم القسم</th>
        <th>الفهرس</th>
    </tr>
    <?php while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)) { ?>
    <tr>
        <td><?php echo $row_Recordset2['registering_no']; ?></td>
        <td><?php echo $row_Recordset2['bookaddress']; ?></td>
        <td><?php echo $row_Recordset2['authorname']; ?></td>
        <td><?php echo $row_Recordset2['pages_numbers']; ?></td>
        <td><?php echo $row_Recordset2['dept_no']; ?></td>
        <td>
            <p><img src="pic/II (2).jpg" width="209" height="148" alt="cc" onclick="showImage(this.src)"></p>
            <button onclick="showImage('pic/II (2).jpg')">عرض الصورة بحجم أكبر</button>
        </td>
    </tr>
    <?php } ?>
</table>

<!-- نافذة عرض الصورة بحجم أكبر -->
<div id="largeImageModal" class="large-image">
    <span class="close-btn" onclick="closeImage()">×</span>
    <img id="largeImage" src="" alt="صورة كبيرة">
</div>

<?php
// تحرير نتيجة الاستعلام
mysql_free_result($Recordset2);
?>

<script>
    // عرض الصورة بحجم أكبر عند الضغط على الصورة
    function showImage(src) {
        var modal = document.getElementById('largeImageModal');
        var img = document.getElementById('largeImage');
        img.src = src;
        modal.style.display = "flex";
    }

    // إغلاق الصورة الكبيرة
    function closeImage() {
        var modal = document.getElementById('largeImageModal');
        modal.style.display = "none";
    }

    // إغلاق الصورة إذا تم النقر خارج الصورة
    window.onclick = function(event) {
        var modal = document.getElementById('largeImageModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
