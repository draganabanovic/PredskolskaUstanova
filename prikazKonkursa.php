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
     $nazivKonkursa="";
     $rokKonkursa="";
     $opisKonkursa="";
     $idH="";
     if(isset($_GET['id'])){
      $konkurss = $konkurs->prikazSaIDKonkursom($_GET['id']);
      while($red=mysqli_fetch_array($konkurss))
        {
          $nazivKonkursa=$red['NAZIV_KONKURSA'];
          $rokKonkursa=$red['ROK_ZA_PRIJAVU'];
          $opisKonkursa=$red['OPIS'];
          $idH=$red['ID_KONKURSA'];
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
       <div class="container my-5">
         <div class="row bg-white rounded border justify-content-center p-5 shadow">

            <div class="col-3 text-center  mb-3 ">
            <select  class="form-control"  onchange="location = 'prikazKonkursa.php?id='+this.value">
                    <option value="" >Konkursi</option>
                    <?php
                        $sviKonkursi = $konkurs->prikazSvihKonkursa();
                        if($sviKonkursi){
                        while($row=mysqli_fetch_assoc($sviKonkursi)){
                          $id = $row['ID_KONKURSA'];
                          $name = $row['NAZIV_KONKURSA'];
                          ?>
                          <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                            
                          <?php
                          }}
                          ?>
              </select>
            </div>
            <?php 
            if(isset($_GET['id'])){
              echo '
              <div class="col-12 text-center  mb-3 ">
                  <h3 class="font-weight-bold ">'.$nazivKonkursa.'</h3>
              </div>';
              if($rokKonkursa<date("Y-m-d"))
              echo '
              <div class="col-12 text-center pb-3">
              <h5>Istekao</h5>
              </div>';
              echo '
              <div class="col-12 text-center pb-3 border-bottom">
                <h5>Rok za prijavu: '. date("d.m.Y",strtotime($rokKonkursa)).'</h5>
              </div>
                
              <div class="row justify-content-center">
                <div class="col-10 ">
                  <p>'.$opisKonkursa.'</p>
                </div>
              </div> ';
            }
            
            ?>

            
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