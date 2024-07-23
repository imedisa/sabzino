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
    <link
      href="./assets/css/boxicons.min.css"
      rel="stylesheet"
    />

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
              <a href="./user_page.php" class="nav__link">صفحه اصلی</a>
            </li>
            <!-- <li class="nav__item">
              <a href="./user_status.php" class="nav__link active-link"
                >وضعیت من</a
              >
            </li> -->

            <li><i class="bx bx-moon change-theme" id="theme-button"></i></li>
          </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
          <i class="bx bx-menu"></i>
        </div>
        <div class="flex items-center">
          <a href="#" class="nav__logo lg:mr-5">سبزینو</a>
        </div>
      </nav>
    </header>

    <main class="l-main">
      <!--========== SERVICES ==========-->
      <section
        class="services section bd-container services__container services__content"
        id="services"
      >
        <span class="section-subtitle mb-8"> BMI و درصد چربی بدن شما</span>
        <!--========== BMI FORM ==========-->

        <div>
          <div action="" class="border border-green-600 p-4 rounded-lg">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
              <div
                class="border p-3 border-green-600 flex items-center justify-center rounded-lg"
              >
                <div class="p-3">BMI شما :</div>
                <?php echo isset($_SESSION['user_bmi']) ? htmlspecialchars($_SESSION['user_bmi']) : 'Guest'; ?>
              </div>

              <div
                class="border p-3 border-green-600 flex items-center justify-center rounded-lg"
              >
                <div class="p-3">درصد چربی شما :</div>
                <?php echo isset($_SESSION['user_fat']) ? htmlspecialchars($_SESSION['user_fat']) : 'Guest'; ?>
              </div>

              <div
                class="border p-3 border-green-600 flex items-center justify-center rounded-lg"
              >
                <div class="p-3">وضعیت :</div>
                <?php echo isset($_SESSION['user_status']) ? htmlspecialchars($_SESSION['user_status']) : 'Guest'; ?>
              </div>

              
            </div>
          </div>
        </div>
      </section>
      <!--========== DIAGRAM ==========-->
      <span class="section-subtitle mb-8">نمودار BMI شما در سه ماه گذشته:</span>
      <div class="chart-container" style="height: 40vh; width: 95vw;">
        <canvas id="myChart"></canvas>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        <?php 
        require("config.php");
        $sql="select * from user_records where user_id=".$_SESSION["user_id"]." ORDER by record_date DESC;";
        $result=mysqli_query($connect,$sql);
        $x=0;
        $bmi1;
        $bmi2;
        $bmi4;
        $label= "";
        $label2 = "";
        $label3 =  "";
        while($row=mysqli_fetch_array($result)){
          if($x==1){
            $label1= $row["record_date"];
            $bmi1= $row["user_bmi"];
          }
          elseif($x==2){
            $label2= $row["record_date"];
            $bmi2=$row["user_bmi"];
          }
          else{
            $label3= $row["record_date"];
            $bmi3=$row["user_bmi"];
          }
          $x++;
        }
        ?>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chartData = {
        labels: ['<?php echo $label1;?>', '<?php echo $label2;?>', '<?php echo $label3;?>'],
        datasets: [{
            label: 'My Data',
            data: [<?php echo $bmi1; ?>, <?php echo $bmi2; ?>, <?php echo $bmi3; ?>], // Y-axis values
            borderColor: 'blue',
            fill: false
        }]
        };
        var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
        });
</script>


      <!-- <div class="flex justify-center w-4/5"><img src="./assets/img/IMG_1954.JPG" alt="" /></div> -->
      <!--========== MENU ==========-->
      <section class="menu section bd-container" id="menu">
        <h2 class="section-subtitle">چه غذاهایی برای من مناسب است؟</h2>
        
        <a href="food.php" class="button flex justify-center !items-center"
                >مشاهده غذاهای مناسب شما
              </a>
        <!-- <div class="menu__container bd-grid">
          <div class="menu__content">
            <img src="assets/img/plate1.png" alt="" class="menu__img" />
            <h3 class="menu__name"></h3>
            <span class="menu__detail"></span>
            <span class="menu__preci">کالری :
               
            </span>
            <a href="#" class="button menu__button"
              ><i class="bx bx-plus"></i
            ></a>
          </div>

          <div class="menu__content">
            <img src="assets/img/plate2.png" alt="" class="menu__img" />
            <h3 class="menu__name">سالاد سالمون</h3>
            <span class="menu__detail">ماهی سالمون، کام پیچ، قارچ...بیشتر</span>
            <span class="menu__preci">کالری : 230</span>
            <a href="#" class="button menu__button"
              ><i class="bx bx-plus"></i
            ></a>
          </div>

          <div class="menu__content">
            <img src="assets/img/plate3.png" alt="" class="menu__img" />
            <h3 class="menu__name">سالاد اسپانیایی</h3>
            <span class="menu__detail"
              >قارچ گریل شده، سس سویا، پیاز...بیشتر</span
            >
            <span class="menu__preci">کالری : 250</span>
            <a href="#" class="button menu__button"
              ><i class="bx bx-plus"></i
            ></a>
          </div> -->
        </div>
      </section>
    </main>

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
