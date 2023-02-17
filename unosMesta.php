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

    require 'class/MestoClass.php';
    

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

    
    if(isset($_GET['id'])){
        $mesta = new Mesto_class();
        $imzenaMesta = $mesta->prikazSaIDMesta($_GET['id']);
        while($red=mysqli_fetch_array($imzenaMesta))
        {
          $mestoIzmena=$red['NAZIV_MESTA'];
          $opstinaIzmena=$red['NAZIV_OPSTINE'];
          $drzavaIzmena=$red['DRZAVA'];
          $idIzmena=$red['ID_MESTA'];
        }

    }

    if(isset($_POST['sacuvaj'])) 
          {
            $naziv=$_POST['naziv'];
            $opstina=$_POST['opstina'];
            $drzava=$_POST['drzava'];

            $mesta = new Mesto_class();

            if(isset($_GET['id'])){
              $rezultat = $mesta->izmeniMesto($_GET['id'],$naziv,$opstina,$drzava);
              if($rezultat){
                header("Location: pretragaMesta.php?message=Uspešno izmenjeno mesto");
              }
              else{
                  header("Location: pretragaMesta.php?message=Nije izmenjeno mesto&greska=1");
              }
            }else{
              $rezultat = $mesta->snimiMesto($naziv,$opstina,$drzava);
              if($rezultat){
                header("Location: unosMesta.php?message=Uspešno sačuvano mesto");
              }
              else{
                  header("Location: unosMesta.php?message=Nije sačuvano &greska=1");
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
              Mesta
            </h2>
          </div>
          <form role="form" method='POST' action="">
            <div class="contact_form-container">
                <div>
                  <input type="text" name="naziv" placeholder="Mesto" 
                  value="<?php if(isset($_GET['id'])) echo $mestoIzmena;?>" required>
                </div>
                <div class="mt-2">
                  <input type="text" name="opstina" placeholder="Opština" value="<?php if(isset($_GET['id'])) echo $opstinaIzmena;?>" required>
                </div>
                <div class="mt-2">
                  <input type="text" name="drzava" placeholder="Država" value="<?php if(isset($_GET['id'])) echo $drzavaIzmena;?>" required>
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
            <img src="images/mapa.png" alt="">
          </div>
        </div>
      </div>
 
    </div>
  </section>
  <?php include "meni/donjiMeni.php"; ?>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

  <script>


  </script>

</body>

</html>