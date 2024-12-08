<?php
require_once('Connections/coon.php'); 

// تغيير الاتصال ليتم باستخدام mysqli وفتح الاتصال مع تحديد الترميز UTF-8
$coon = mysqli_connect($hostname_coon, $username_coon, $password_coon, $database_coon);
if (!$coon) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// تعيين الترميز إلى UTF-8 بعد الاتصال
mysqli_set_charset($coon, 'utf8');

// التحقق مما إذا كان قد تم إرسال رقم البطاقة
$cardno = isset($_POST['cardno']) ? $_POST['cardno'] : ''; // التحقق من إرسال رقم البطاقة
$filterViolation = isset($_POST['filter_violation']) ? $_POST['filter_violation'] : false; // التحقق من فلاتر المخالفات

// تعديل الاستعلام بناءً على وجود رقم البطاقة أو الفلتر
$query_Recordset1 = "SELECT * FROM metaphor";
if ($cardno != '') {
    $query_Recordset1 .= " WHERE cardno = '" . mysqli_real_escape_string($coon, $cardno) . "'";
} elseif ($filterViolation) {
    $query_Recordset1 .= " WHERE violation >= 500"; // إضافة شرط المخالفة
}

$Recordset1 = mysqli_query($coon, $query_Recordset1);
if (!$Recordset1) {
    die("فشل الاستعلام: " . mysqli_error($coon));
}

// التحقق من وجود بيانات لتعديلها عبر AJAX
if (isset($_POST['update'])) {
    $registering_no = $_POST['registering_no'];
    $name = $_POST['name'];
    $cardno = $_POST['cardno'];
    $collage = $_POST['collage'];
    $bookname = $_POST['bookname'];
    $loandate = $_POST['loandate'];
    $returndate = $_POST['returndate'];
    $signature = $_POST['signature'];
    $libsymbol = $_POST['libsymbol'];
    $violation = $_POST['violation'];
    $day = $_POST['day'];

    $updateQuery = "UPDATE metaphor SET name = '$name', cardno = '$cardno', collage = '$collage', bookname = '$bookname', loandate = '$loandate', returndate = '$returndate', signature = '$signature', libsymbol = '$libsymbol', violation = '$violation', day = '$day' WHERE registering_no = '$registering_no'";

    if (mysqli_query($coon, $updateQuery)) {
        echo json_encode(['status' => 'success', 'message' => 'تم تحديث البيانات بنجاح']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'فشل التحديث']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>عرض بيانات الاستعارة</title>
    <style type="text/css">
        body {
            font-family: 'Arial', sans-serif;
            background-color: #A3C9E2;
            color: #333;
            margin: 0;
            padding: 0;
            direction: rtl;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4A90E2;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: right;
            font-size: 16px;
        }

        th {
            background-color: #4A90E2;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .search-form {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-form input[type="text"] {
            padding: 8px;
            font-size: 14px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form input[type="submit"] {
            padding: 8px 16px;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form input[type="submit"]:hover {
            background-color: #357ABD;
        }

        button {
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #357ABD;
        }

        .save-button {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .save-button:hover {
            background-color: #218838;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function editRow(registering_no) {
            // إظهار الحقول المعدلة وإخفاء البيانات
            $("#editRow_" + registering_no).show();
            $("#dataRow_" + registering_no).hide();
        }

        // إضافة وظيفة AJAX لتحديث البيانات
        function saveUpdate(registering_no) {
            var formData = {
                'registering_no': $("#editRow_" + registering_no + " input[name='registering_no']").val(),
                'name': $("#editRow_" + registering_no + " input[name='name']").val(),
                'cardno': $("#editRow_" + registering_no + " input[name='cardno']").val(),
                'collage': $("#editRow_" + registering_no + " input[name='collage']").val(),
                'bookname': $("#editRow_" + registering_no + " input[name='bookname']").val(),
                'loandate': $("#editRow_" + registering_no + " input[name='loandate']").val(),
                'returndate': $("#editRow_" + registering_no + " input[name='returndate']").val(),
                'signature': $("#editRow_" + registering_no + " input[name='signature']").val(),
                'libsymbol': $("#editRow_" + registering_no + " input[name='libsymbol']").val(),
                'violation': $("#editRow_" + registering_no + " input[name='violation']").val(),
                'day': $("#editRow_" + registering_no + " input[name='day']").val(),
                'update': true
            };

            $.ajax({
                type: "POST",
                url: "", // ارسال البيانات الى نفس الصفحة
                data: formData,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status == 'success') {
                        alert(result.message);
                        location.reload(); // إعادة تحميل الصفحة لتحديث البيانات
                    } else {
                        alert(result.message);
                    }
                }
            });
        }
    </script>
</head>

<body>

<div class="container">
    <h1>عرض بيانات المستعيرين</h1>

    <div class="search-form">
        <form method="POST" action="">
            <label for="cardno">مستعير معين :</label>
            <input type="text" id="cardno" name="cardno" placeholder="أدخل رقم البطاقة" value="<?php echo htmlspecialchars($cardno, ENT_QUOTES, 'UTF-8'); ?>" />
            <input type="submit" value="بحث" />
        </form>
    </div>

    <div class="search-form">
        <form method="POST" action="">
            <input type="hidden" name="filter_violation" value="true" />
            <input type="submit" value="المستعيرين المخالفين" />
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>رقم القيد</th>
                <th>الاسم</th>
                <th>رقم البطاقة</th>
                <th>الكلية</th>
                <th>اسم الكتاب</th>
                <th>تاريخ الاستعارة</th>
                <th>تاريخ الاسترجاع</th>
                <th>التوقيع</th>
                <th>رمز المكتبة</th>
                <th>المخالفة</th>
                <th>اليوم</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($Recordset1)) { ?>
                <tr id="dataRow_<?php echo $row['registering_no']; ?>">
                    <td><?php echo htmlspecialchars($row['registering_no'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['cardno'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['collage'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['bookname'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['loandate'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['returndate'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['signature'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['libsymbol'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['violation'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['day'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><button onclick="editRow(<?php echo $row['registering_no']; ?>)">تعديل</button></td>
                </tr>

                <tr id="editRow_<?php echo $row['registering_no']; ?>" style="display:none;">
                    <td><input type="text" name="registering_no" value="<?php echo htmlspecialchars($row['registering_no'], ENT_QUOTES, 'UTF-8'); ?>" readonly /></td>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="cardno" value="<?php echo htmlspecialchars($row['cardno'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="collage" value="<?php echo htmlspecialchars($row['collage'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="bookname" value="<?php echo htmlspecialchars($row['bookname'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="loandate" value="<?php echo htmlspecialchars($row['loandate'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="returndate" value="<?php echo htmlspecialchars($row['returndate'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="signature" value="<?php echo htmlspecialchars($row['signature'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="libsymbol" value="<?php echo htmlspecialchars($row['libsymbol'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="violation" value="<?php echo htmlspecialchars($row['violation'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><input type="text" name="day" value="<?php echo htmlspecialchars($row['day'], ENT_QUOTES, 'UTF-8'); ?>" /></td>
                    <td><button class="save-button" onclick="saveUpdate(<?php echo $row['registering_no']; ?>)">حفظ التعديلات</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
