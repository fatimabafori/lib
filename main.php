<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>الصفحة الرئيسية</title>
    <style type="text/css">
        /* Reset default margins and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* خلفية الصفحة باللون اللبني */
        body {
            background: linear-gradient(to bottom, #c2e0f4, #6ca0dc); /* تدرج بين الأزرق اللبني الفاتح والداكن */
            color: #333; /* نص داكن لتحسين القراءة */
            font-family: 'Arial', sans-serif;
            font-size: 18px;
            text-align: right;
            direction: rtl;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #ffffff; /* لون العناوين أبيض */
        }

        /* إضافة تأثيرات على الصور */
        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.1); /* تأثير تكبير عند التمرير على الصورة */
        }

        /* تصميم القائمة */
        #MenuBar2 {
            list-style: none;
            padding: 0;
            background: #4682b4; /* اللون الأزرق الداكن للقائمة */
            margin-top: 20px;
            border-radius: 10px;
        }

        #MenuBar2 li {
            display: inline-block;
            position: relative;
        }

        #MenuBar2 li a {
            display: block;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            background: #4682b4; /* اللون الأزرق الداكن */
            font-size: 16px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        #MenuBar2 li a:hover {
            background-color: #315f84; /* لون أزرق أغمق عند التمرير */
            transform: scale(1.05); /* تأثير تكبير */
        }

        #MenuBar2 li a img {
            vertical-align: middle;
            margin-left: 10px;
        }

        /* تصميم القائمة المنسدلة */
        #MenuBar2 li ul {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #6ca0dc; /* الأزرق اللبني الفاتح للقائمة المنسدلة */
            border-radius: 10px;
            min-width: 200px;
            list-style: none;
            padding: 0;
        }

        #MenuBar2 li:hover ul {
            display: block;
        }

        #MenuBar2 li ul li a {
            padding: 12px 20px;
            font-size: 14px;
            background-color: #6ca0dc; /* الأزرق اللبني */
        }

        #MenuBar2 li ul li a:hover {
            background-color: #4682b4; /* الأزرق الداكن عند التمرير */
        }

        /* تصميم الشريط العلوي */
        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-section p {
            font-size: 20px;
            color: #ffffff; /* لون النص أبيض */
        }

        .header-section img {
            width: 250px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        /* تنسيق النصوص */
        p {
            line-height: 1.6;
            color: #333; /* نص داكن للقراءة */
        }

        .س {
            font-size: 18px;
            color: #666; /* نص رمادي فاتح */
        }

        .main-content {
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #888;
        }

        /* إضافة تنسيق لزر تسجيل الخروج أسفل الصفحة وعلى اليسار */
        #logoutButton {
            position: fixed; /* تثبيت الزر أسفل الصفحة */
            bottom: 20px; /* المسافة من أسفل الصفحة */
            left: 20px; /* المسافة من الجهة اليسرى */
            background-color: red; /* اللون الأحمر */
            color: white; /* اللون الأبيض للنص */
            padding: 15px 25px; /* حشو الزر */
            font-size: 16px;
            border-radius: 5px; /* الحواف الدائرية */
            text-decoration: none;
        }

        #logoutButton:hover {
            background-color: darkred; /* تغيير اللون عند التمرير */
        }
    </style>
</head>
<body>

    <div class="header-section">
        <h1>جامعة البحر الأحمر</h1>
        <h2>مكتبة كلية الطب والعلوم الصحية</h2>
        <img src="pic/medicine_logo-1.png" alt="University Logo" />
    </div>

    <div class="main-content">
        <ul id="MenuBar2" class="MenuBarHorizontal">
            <li><a href="home.php">الصفحة الرئيسية <img src="pic/25694.png" width="45" height="30" /></a></li>
            <li><a href="#" onclick="toggleReferences()">المراجع</a>
              <ul id="referencesMenu">
                <li><a href="#" onclick="toggleElectronic()">الكترونية </a>
                  <ul id="electronicReferences" style="display:none;">
                    <li><a href="dent.php">طب الاسنان</a></li>
                    <li><a href="jraha.php">الجراحة</a></li>
                    <li><a href="baby path.php">الاطفال</a></li>
                    <li><a href="#">عيون</a></li>
                    <li><a href="#">أدوية</a></li>
                    <li><a href="#">فسيولوجيا</a></li>
                    <li><a href="#">تشريح</a></li>
                  </ul>
                </li>
                <li><a href="#" onclick="togglePaper()">الورقية</a>
                  <ul id="paperReferences" style="display:none;">
                    <li><a href="dentor.php">طب الاسنان</a></li>
                    <li><a href="jrahaor.php">الجراحة</a></li>
                    <li><a href="babyor.php">الاطفال</a></li>
                    <li><a href="#">عيون</a></li>
                    <li><a href="#">أدوية</a></li>
                    <li><a href="#">فسيولوجيا</a></li>
                    <li><a href="#">تشريح</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="us.php">من نحن</a></li>
            <li><a href="vision.php">الرؤية والرسالة</a></li>
            <li><a href="call.php">اتصل بنا <img src="pic/call-13.png" width="45" height="30" /></a></li>
        </ul>
    </div>

    <div class="footer">
        <p>&copy; 2024 جامعة البحر الأحمر. جميع الحقوق محفوظة.</p>
    </div>

    <!-- زر تسجيل الخروج أسفل الصفحة -->
    <a href="louser.php" id="logoutButton">تسجيل خروج</a>

    <script type="text/javascript">
        function toggleReferences() {
            var referencesMenu = document.getElementById("referencesMenu");
            if (referencesMenu.style.display === "none") {
                referencesMenu.style.display = "block";
            } else {
                referencesMenu.style.display = "none";
            }
        }

        function toggleElectronic() {
            var electronicReferences = document.getElementById("electronicReferences");
            var paperReferences = document.getElementById("paperReferences");
            if (electronicReferences.style.display === "none") {
                electronicReferences.style.display = "block";
                paperReferences.style.display = "none";
            } else {
                electronicReferences.style.display = "none";
            }
        }

        function togglePaper() {
            var paperReferences = document.getElementById("paperReferences");
            var electronicReferences = document.getElementById("electronicReferences");
            if (paperReferences.style.display === "none") {
                paperReferences.style.display = "block";
                electronicReferences.style.display = "none";
            } else {
                paperReferences.style.display = "none";
            }
        }
    </script>

</body>
</html>
