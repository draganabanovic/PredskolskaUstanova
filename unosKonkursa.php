<?php
session_start();
if(!isset($_SESSION['uloga'])){
  header("Location: index.php?message=Ulogujte se&greska=1");
}
if($_SESSION['uloga']!="admin"){
  header("Location: index.php?message=Doznoljen pristup samo admin nalogu&greska=1");
}
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

<body class="sub_page">

  <?php

    require 'class/KonkursClass.php';
    $konkurs = new Konkurs_class();

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

    $nazivH="";
    $rokH="";
    $opisH="";
    $idH="";
    if(isset($_GET['id'])){
      $konkurss = $konkurs->prikazSaIDKonkursom($_GET['id']);
      while($red=mysqli_fetch_array($konkurss))
        {
          $nazivH=$red['NAZIV_KONKURSA'];
          $rokH=$red['ROK_ZA_PRIJAVU'];
          $opisH=$red['OPIS'];
          $idH=$red['ID_KONKURSA'];
        }
    }
    if(isset($_POST['sacuvaj'])) 
          {
            $naziv=$_POST['naziv'];
            $opis=$_POST['opis'];
            $rok=$_POST['rok'];
     

            if(isset($_GET['id'])){
              $rezultat = $konkurs->izmeniKonkurs($_GET['id'],$naziv,$opis,$rok);
              if($rezultat){
                header("Location: pretragaKonkursa.php?message=Uspešno izmenjen konkurs");
              }
              else{
                  header("Location: pretragaKonkursa.php?message=Nije izmenjen konkurs&greska=1");
              }
            }else{
              $rezultat = $konkurs->snimiKonkurs($naziv,$opis,$rok);
              if($rezultat){
                header("Location: unosKonkursa.php?message=Uspešno sačuvan konkurs");
              }
              else{
                  header("Location: unosKonkursa.php?message=Nije sačuvan konkurs&greska=1");
              }
            }
            
          }
  ?>

  <div class="top_container ">
    <header class="header_section">
      <div class="container">
       <?php require "meni/gornjiMeni.php"; ?>
      </div>
    </header>
  </div>

  <section class="contact_section min-visina">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="d-flex justify-content-center d-md-block">
            <h2>
              Konkursi
            </h2>
          </div>
          <form role="form" method='POST' action="" onsubmit="return proveraOpisaKonkursa()">
            <div class="contact_form-container">
                <div>
                  <input type="text" name="naziv" placeholder="Naziv" 
                  value="<?php if(isset($_GET['id'])) echo $nazivH;?>" required>
                </div>

                <div class="mt-2">
                  <input type="date" name="rok" placeholder="Rok" min=<?php echo date('Y-m-d');?> 
                  value="<?php if(isset($_GET['id'])) echo $rokH;?>" required>
                </div>

                <div class="mt-2">
                    <label for="name" class="col-md-2 pl-0 col-form-label ">Opis:</label>
                    <textarea class="form-control md-textarea" style="width:90%" type="text" id="opis" name="opis" rows="4" >
                    <?php if(isset($_GET['id'])) echo $opisH;?>
                    </textarea>
                </div>

                <div class="mt-4 ">
                  <button name="sacuvaj" type="submit">
                  <?php if(isset($_GET['id'])) echo "izmeni"; 
                        else echo "snimi";?>
                  </button>
                </div>
              </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="images/konkurs.png" alt="">
          </div>
        </div>
      </div>
     
    </div>
  </section>
  <?php include "meni/donjiMeni.php"; ?>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea', height : 300 });</script>

</body>

</html>