<?php
//izmena naloga
session_start();
if(!isset($_SESSION['email'])){
  header("Location: index.php?message=Ulogujte se&greska=1");
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

<body>

  <?php

     require 'class/NalogClass.php';
     $nalog = new Nalog_class();
 
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

     if(isset($_POST['izmena'])) {

        $email=$_POST['email'];
        $sifra=$_POST['sifra'];

        if($sifra == ""){

            if($nalog->izmeniNalog($_SESSION['email'],$email)){
                $_SESSION['email']=$email; //odmah updatuje sesiju sa novim email-om u slučaju da je promenjena
                header("Location: nalog.php?message=Uspešno izmenjen nalog");
            }else {
                header("Location: nalog.php?message=Nije izmenjen nalog&greska=1");
            }

        }else{
            if($nalog->izmeniNalogSaSifrom($_SESSION['email'],$email,$sifra)){
                $_SESSION['email']=$email;
                header("Location: nalog.php?message=Uspešno izmenjen nalog");
            }else {
                header("Location: nalog.php?message=Nije izmenjen nalog&greska=1");
            }

        }
     
    }
 
  ?>
  <div class="top_container">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
      <?php include "meni/gornjiMeni.php"; ?>
      </div>
    </header>
    <section class="hero_section ">
       <div class="container my-5 d-flex justify-content-center">
         <div class="izvestaj col-6 row justify-content-center p-5 shadow">
            <h3 class="font-weight-bold">Izmena naloga</h3>
           
            <div class="col-8 my-4  ">
                <form role="form" method="POST">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" value=<?php echo $_SESSION['email']?> required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="sifra" placeholder="Nova šifra" >
                </div>

                    <div class="my-4 d-flex justify-content-center">
                        <button style="width: 100%;" class="btn btn-secondary" name="izmena" type="submit">
                            Izmeni
                        </button>
                    </div>
              </form>
            </div>
            
            
        </div>
        </div>
    </section>
  </div>



    <?php include "meni/donjiMeni.php"; ?>



  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

 
</body>

</html>