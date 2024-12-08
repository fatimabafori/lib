<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>من نحن</title>
    <style type="text/css">
        /* تنسيق عام للصفحة */
        body {
            background-color: #b3d9f2; /* الأزرق اللبني الفاتح */
            color: #333; /* لون النص */
            font-family: Arial, sans-serif;
            font-size: 18px;
            text-align: center; /* توسيط النصوص بشكل عام */
            margin: 0;
            padding: 0;
        }

        /* تنسيق العنوان داخل الإطار */
        .content h1 {
            color: #1a4d73; /* اللون الغامق لكلمة "من نحن" */
            font-size: 40px; /* تكبير حجم الخط */
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center; /* توسيط العنوان داخل الإطار */
        }

        /* تنسيق النصوص داخل الإطار */
        .content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            text-align: right; /* محاذاة النصوص إلى اليمين */
            border: 2px solid #1a4d73;
            word-spacing: 2px; /* تباعد الكلمات بشكل مناسب */
            line-height: 1.8; /* تباعد الأسطر */
            font-size: 20px; /* زيادة حجم الخط داخل الإطار */
        }

        /* تنسيق الفقرات */
        p {
            margin-bottom: 20px;
        }

        /* تنسيق للزر */
        input[type="submit"] {
            background-color: #1a4d73; /* اللون الغامق */
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        /* تغيير اللون عند المرور على الزر */
        input[type="submit"]:hover {
            background-color: #133c54;
        }
    </style>
</head>

<body>
    <div class="content">
        <!-- العنوان داخل الإطار -->
        <h1>:من نحن</h1>

        <!-- المحتوى داخل الإطار -->
        <p>تمثل المكتبة قلب العملية التعليمية في البيئة الجامعية وتعدد مصادر المعلومات بها يخدم أغراض وأهداف المؤسسة التعليمية.</p>
        <p>لقد عنيت هذه الجامعة منذ نشأتها بموجب القرار الجمهوري رقم (76) في مارس 1994، والذي نتج عنه تقسيم جامعة الشرق إلى ثلاث جامعات مستقلة: جامعة كسلا، البحر الأحمر، القضارف. وبموجب القرار ضمت الكثير من الكليات والمعاهد.</p>
        <p>فاقتضت الضرورة للجوء إلى نظام المكتبات المتعددة بحيث تكون بكل كلية أو معهد مكتبة.</p>
        <p>تم إنشاء مكتبة طب والعلوم الصحية عام 2001 وهي تحتوي على الكتب والمراجع في مجال التخصصات الطبية المختلفة مثل التشريح، وظائف الأعضاء، الجراحة، علم الأطفال، والولادة، وغيرها من التخصصات الطبية الأخرى.</p>
    </div>

    <form action="main.php" method="get"> <!-- رابط للصفحة الرئيسية main.php -->
        <input type="submit" name="s" value="الصفحة الرئيسية" />
    </form>
</body>
</html>
