<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Vrtić</title>



  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- progress barstle -->
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,600&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />




  <link rel="stylesheet" href="css/css-circular-prog-bar.css">


</head>

<body>

  <?php
  //get za preuzimanje iz url-a, obaveštenja o greški ili nečemu
    if(isset($_GET['message'])){
      $boja='alert-success';
      if(isset($_GET['greska'])){
          $boja='alert-danger';
      }
      $msg = $_GET['message'];
      echo '<div class="alert '.$boja.' alert-dismissible fade show mb-0" role="alert">
      '.$msg.'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>';
    }
  ?>
  <div class="top_container">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
      <?php include "meni/gornjiMeni.php"; ?>
      </div>
    </header>
    <section class="hero_section">
      <div class="hero-container container">
        <div class="hero_detail-box">
          <h1>
            Prijava za novu generaciju polaznika
          </h1>
          <p>
         
Proces upisa dece  biće realizovan isključivo ELEKTRONSKIM putem. Nepotpuni, netačno popunjeni i neblagovremeni zahtevi neće biti prihvaćeni.

          </p>
          <div class="hero_btn-continer">
            <a href="prijavaDeteta.php" class="call_to-btn btn_white-border">
              Prijava deteta
            </a>
          </div>
        </div>
        <div class="hero_img-container">
          <div>
            <img src="images/hero.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end header section -->

  <div class="common_style">

    <!-- about section -->
    <section class="about_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="about_img-container">
              <img src="images/about.png" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="about_detail-box">
              <h3>
               O nama
              </h3>
              <p>
              Predškolska ustanova “Pupinolino” osnovana je 2017. godine.
 Predškolska ustanova realizuje program celodnevnog i poludnevnog oblika rada u svim njegovim segmentima, podrazumevajući time i realizaciju vaspitno-obrazovnog rada, programa socijalnog rada i programa preventivne zdravstvene zaštite. 
Osnove programa se realizuju kroz dva modela – A i B. Izbor između ova dva modela vrši se na nivou svake vaspitne grupe na osnovu slobodnog opredeljivanja vaspitača.
Radno vreme ustanove od 7 do 17h.

              </p>
             
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- end about section -->

    <!-- admission section -->
    <section class="admission_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="admission_detail-box">
              <h3>
                Misija i vizija
              </h3>
              <p>
              Misija Predškolske ustanove „Pupinolino“ je da stvori bezbednu, stimulativnu i povoljnu fizičku i socijalno-emotivnu sredinu za psiho-fizički razvoj i napredovanje dece zajedno sa roditeljima kao aktivnim partnerima u obrazovanju i vaspitanju, a otvoreni za saradnju sa ustanovama lokalne zajednice. 
              </p>
              <p>
              Vizija Predškolske ustanove „Pupinolino“ jeste da postane jedna od vodećih obdaništa  na teritoriji grada Zrenjanina u kom deca uz pomoć stručnog osoblja odrastaju i provode vreme u igri i obrazovanju. 
  </p>
             
            </div>
          </div>
          <div class="col-md-6">
            <div class="admission_img-container">
              <img src="images/admission.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- end admission section -->

   

  </div>




  <!-- end client section -->


    <!-- contact section -->




      <!-- end contact section -->
      <?php include "meni/donjiMeni.php"; ?>



  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

 
</body>

</html>