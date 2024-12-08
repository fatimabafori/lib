<!DOCTYPE html>
<html lang="ar">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>طب أسنان</title>
<style type="text/css">
/* الخلفية العامة */
body {
    background-color: #B0C4DE; /* أزرق فاتح */
    font-family: Arial, sans-serif;
    color: #FFF;
    margin: 0;
    padding: 0;
}

/* تنسيق العنوان */
h1 {
    text-align: center;
    font-size: 36px;
    color: #2F4F4F; /* بني داكن */
    margin-top: 50px;
}

/* تنسيق الحاوية التي تحتوي على الصور */
.container {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    margin: 30px auto;
    width: 80%;
}

/* تنسيق الإطارات التي تحتوي على الصور */
.frame {
    border: 5px solid #4682B4; /* حدود الإطار باللون الأزرق الداكن */
    border-radius: 10px;
    overflow: hidden;
    width: 300px; /* عرض ثابت للإطار */
    height: 550px; /* ارتفاع أكبر للإطار */
    display: flex;
    flex-direction: column; /* ترتيب الصور والأزرار عموديًا */
    justify-content: center;
    align-items: center;
    background-color: #FFF;
    padding: 10px;
}

/* تنسيق الصور بداخل الإطارات */
.frame img {
    width: 100%;
    height: 70%; /* تغيير الحجم ليترك مكانًا للأزرار */
    object-fit: cover; /* الحفاظ على نسبة العرض والطول للصور */
    border-radius: 5px;
}

/* تنسيق الأزرار */
button {
    background-color: #4682B4; /* الأزرق الداكن */
    color: white;
    font-size: 16px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

/* تأثير التمرير على الزر */
button:hover {
    background-color: #5F9EA0; /* أزرق فاتح عند التمرير */
}

/* تأثير التكبير والتظليل عند التمرير على الصورة */
.frame img:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
}
</style>
</head>

<body>

<h1>طب أسنان</h1>

<div class="container">
    <!-- الإطار الأول -->
    <div class="frame">
        <a href="https://noor-book.com/fnp6wo" target="_blank">
            <img src="pic/KK.jpg" alt="صورة 1">
        </a>
        <button onclick="window.location.href='pic/KK.jpg'">تحميل</button>
    </div>

    <!-- الإطار الثاني -->
    <div class="frame">
        <a href="https://books.google.gg/books?id=Qs-JCgAAQBAJ&printsec=copyright#v=onepage&q&f=false" target="_blank">
            <img src="pic/II (2).jpg" alt="صورة 2">
        </a>
        <button onclick="window.location.href='pic/II (2).jpg'">تحميل</button>
    </div>

    <!-- الإطار الثالث -->
    <div class="frame">
        <a href="https://books-library.net/free-348026109-download" target="_blank">
            <img src="pic/OO (2).jpg" alt="صورة 3">
        </a>
        <button onclick="window.location.href='pic/OO (2).jpg'">تحميل</button>
    </div>
</div>

</body>
</html>
