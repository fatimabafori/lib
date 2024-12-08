<!DOCTYPE html>
<html lang="ar" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>الصفحة الرئيسية</title>
<style type="text/css">
    /* تنسيق الخلفية */
    body {
        background-color: #a3c8f0; /* لون أزرق لبني */
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* تنسيق الصورة */
    img {
        display: block;
        margin-top: -50px; /* رفع الصورة للأعلى */
        margin-bottom: 30px; /* المسافة أسفل الصورة */
        width: 600px; /* زيادة عرض الصورة */
        height: 350px; /* زيادة طول الصورة */
        border-radius: 8px; /* إضافة زوايا دائرية للصورة */
    }

    /* تنسيق الزر */
    #alertButton {
        position: fixed;
        top: 20px; /* وضع الزر في أعلى الصفحة */
        right: 20px; /* وضع الزر في الجهة اليمنى */
        background-color: red; /* اللون الأحمر */
        color: white;
        padding: 15px 30px;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    /* تأثير التمرير على الزر */
    #alertButton:hover {
        background-color: darkred;
    }

    /* تأثير الضغط على الزر */
    #alertButton:active {
        transform: scale(0.95);
    }

    /* تنسيق القوائم المنسدلة */
    .MenuBarHorizontal {
        list-style-type: none;
        padding: 0;
        margin: 0;
        text-align: center;
        background-color: #337ab7; /* لون خلفية القوائم */
        border-radius: 8px;
        display: inline-block;
        width: 600px; /* جعل القوائم بنفس عرض الصورة */
        margin-top: 100px; /* زيادة المسافة بين القوائم والصورة */
    }

    .MenuBarHorizontal li {
        display: inline-block;
        position: relative;
    }

    .MenuBarHorizontal li a {
        display: block;
        padding: 15px 30px; /* تكبير طول القوائم بزيادة padding */
        text-decoration: none;
        color: white;
        font-size: 20px; /* تكبير الخط داخل القوائم */
        background-color: #337ab7; /* نفس لون الخلفية */
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.3s ease; /* إضافة تأثير التغيير عند الضغط */
    }

    .MenuBarHorizontal li a:hover {
        background-color: #5bc0de; /* تغيير اللون عند التمرير */
    }

    /* تأثير الحركة عند الضغط */
    .MenuBarHorizontal li a:active {
        transform: scale(0.95); /* تصغير الزر عند الضغط */
    }

    /* تنسيق القائمة المنسدلة */
    .MenuBarHorizontal li .MenuBarItemSubmenu ul {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #337ab7;
        padding: 0;
        margin: 0;
        border-radius: 8px;
    }

    .MenuBarHorizontal li:hover .MenuBarItemSubmenu ul {
        display: block;
    }

    .MenuBarHorizontal li .MenuBarItemSubmenu ul li {
        display: block;
    }

    .MenuBarHorizontal li .MenuBarItemSubmenu ul li a {
        padding: 15px 30px; /* تكبير طول القوائم المنسدلة بزيادة padding */
    }

    .MenuBarHorizontal li .MenuBarItemSubmenu ul li a:hover {
        background-color: #5bc0de; /* تغيير اللون عند التمرير داخل القوائم الفرعية */
    }
</style>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
</head>

<body>

    <div align="right">
      <!-- الصورة في المركز -->
      <img src="emg/img lib.jpg" alt="book" />
      
      <!-- الزر الذي ينقلك إلى صفحة metrep.php -->
      <input type="button" id="alertButton" value="تنبيه" onclick="window.location.href='metrep.php';">
      
      <!-- القوائم المنسدلة في وسط الصفحة -->
      <ul id="MenuBar1" class="MenuBarHorizontal">
        <li><a href="metaphor.php">الاستعارة</a></li>
        <li><a href="mem.php">الاعضاء</a></li>
        <li><a href="eeeee.php">الكتب </a></li>
        <li><a href="emp.php">الموظفين</a></li>
        <li><a href="rep.php" class="MenuBarItemSubmenu">التقارير</a>
          <ul>
            <li><a href="rep.php">الاعضاء</a></li>
            <li><a href="emprp.php"> موظفين </a></li>
            <li><a href="bookrep.php">الكتب</a></li>
            <li><a href="metrep.php">الاستعارة</a></li>
            <li><a href="qq.php">الاستفسارات</a> </li>
          </ul>
        </li>
      </ul>
    </div>

    <script type="text/javascript">
        var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
    </script>
</body>
</html>
