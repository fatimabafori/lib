<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرؤية والرسالة</title>
    <style>
        /* تصميم الجسم */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #A7C7E7; /* درجة الأزرق اللبني الفاتح */
            color: #333;
            text-align: right;
            direction: rtl;
            margin: 0;
            padding: 0;
        }

        /* تنسيق الفضاء العام للصفحة */
        .content-container {
            width: 80%;
            margin: 40px auto;
            text-align: center;
            background-color: #f1faff; /* خلفية فاتحة لزيادة التباين */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* تنسيق العناوين والنصوص */
        h1, h2 {
            color: #2e4c67; /* لون أزرق داكن للرؤية والرسالة */
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            color: #6e4a3b; /* لون دافئ لبني */
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* تنسيق النموذج */
        .form-container {
            background-color: #A7C7E7; /* لون لبني وسط */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* تنسيق زر العودة للصفحة الرئيسية */
        input[type="submit"] {
            background-color: #A7C7E7; /* الأزرق اللبني الفاتح */
            border: none;
            padding: 12px 25px;
            font-size: 18px;
            color: #2e4c67;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #6ca0dc; /* لون لبني أغمق عند التمرير */
        }

        input[type="submit"]:focus {
            outline: none;
        }
    </style>
</head>
<body>

    <div class="content-container">
        <div class="form-container">
            <h1>الرؤية</h1>
            <p>أن تكون مكتبة متميزة بتقديم خدمات ومعلومات للمستفيدين والباحثين من أجل الوصول إلى مجتمع متميز.</p>
            <p>وأن تكون مكتبة متطورة دوماً وخلق جو معرفي لأعضاء هيئة التدريس والطلبة والمجتمع المحلي.</p>

            <h2>الرسالة</h2>
            <p>دعم العملية التعليمية ومساندة البحث العلمي من خلال بناء مجموعات متكاملة من المصادر الورقية والإلكترونية.</p>
            <p>وتقديم خدمات المعلومات وإتاحتها للطلبة والباحثين وتسهيل الوصول إليها بأسرع السبل.</p>

            <!-- زر العودة إلى الصفحة الرئيسية -->
            <form action="main.php" method="get">
                <input type="submit" value="العودة إلى الصفحة الرئيسية">
            </form>
        </div>
    </div>

</body>
</html>
