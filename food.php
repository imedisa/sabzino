<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="" href="./assets/img/favicon.png" />
    <!--========== TAILWIND CONNECTION ==========-->

    <script src="./assets/js/tailwind.js"></script>

    <!--========== BOX ICONS ==========-->
    <link href="./assets/css/boxicons.min.css" rel="stylesheet" />

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="assets/css/styles.css" />

    <title>Health Bank</title>
  </head>
  <body>
    <!--========== SCROLL TOP ==========-->
    <a href="#" class="scrolltop" id="scroll-top">
      <i class="bx bx-chevron-up scrolltop__icon"></i>
    </a>

    <!--========== HEADER ==========-->
    <header class="l-header" id="header">
      <nav class="nav bd-container">
        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <li class="nav__item">
              <a href="./index.html" class="nav__link ">صفحه اصلی</a>
            </li>
            <li class="nav__item">
              <a href="./user_status.php" class="nav__link">وضعیت من</a>
            </li>
            

            <li><i class="bx bx-moon change-theme" id="theme-button"></i></li>
          </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
          <i class="bx bx-menu"></i>
        </div>
        <<div class="flex items-center">
        <p>خوش امدید <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Guest'; ?></p>
        </div>
      </nav>
    </header>

    <main class="l-main">
    <div class="menu__container bd-grid">
<?php
require("config.php");
if($_SESSION["user_status"]=="کمبود وزن"){
    $health="under";
}
elseif($_SESSION["user_status"]== "وزن نرمال"){
 $health= "normal";
}
else{
 $health= "over";
}

$sql="select * from foods where food_health='".$health."'";
$result=mysqli_query($connect,$sql);
while($row=mysqli_fetch_array($result)){
    echo '
    <div class="menu__content">
            <img src="assets/img/'.$row['food_img'].'" alt="" class="menu__img" />
            <h3 class="menu__name">'.$row["food_name"].'</h3>
            <span class="menu__detail">'.$row["discription"].'</span>
            <span class="menu__preci">کالری : '.$row["callories"].'</span>
            <a href="#" class="button menu__button"
              ><i class="bx bx-plus"></i
            ></a>
          </div>
    
    
    ';
}
?>
</div>
<!--========== FOOTER ==========-->
<footer class="footer section bd-container">
      <div class="footer__container bd-grid">
        <div class="footer__content">
          <a href="#" class="footer__logo">سبزینو</a>
          <span class="footer__description">پروژه پایانی</span>
          <div>
            <a href="#" class="footer__social"
              ><i class="bx bxl-facebook"></i
            ></a>
            <a href="#" class="footer__social"
              ><i class="bx bxl-instagram"></i
            ></a>
            <a href="#" class="footer__social"
              ><i class="bx bxl-twitter"></i
            ></a>
          </div>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">سرویس ها</h3>
          <ul>
            <li><a href="#" class="footer__link">نظرات</a></li>
            <li><a href="#" class="footer__link">کالری ها</a></li>
            <li><a href="#" class="footer__link">غذاهای مضر</a></li>
            <li><a href="#" class="footer__link">شخصی سازی پیشرفته</a></li>
          </ul>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">اطلاعات</h3>
          <ul>
            <li><a href="#" class="footer__link">رویداد ها</a></li>
            <li><a href="#" class="footer__link">درباره ما</a></li>
            <li><a href="#" class="footer__link">اعتماد و امنیت</a></li>
            <li><a href="#" class="footer__link">همکاری با ما</a></li>
          </ul>
        </div>

        <div class="footer__content">
          <h3 class="footer__title">آدرس</h3>
          <ul>
            <li>ایران، تهران</li>
            <li>خانی آباد، دانشگاه شریعتی</li>
            <li>999 - 888 - 777</li>
            <li>Shariaty@gmail.com</li>
          </ul>
        </div>
      </div>

      <p class="footer__copy">&#169; ساخته شده توسط مدیسا حمزه و تینا حافظی</p>
    </footer>

    <!--========== SCROLL REVEAL ==========-->
    <script src="./assets/js/scrollreveal.js"></script>

    <!--========== MAIN JS ==========-->
    <script src="assets/js/main.js"></script>
</body>
</html>

