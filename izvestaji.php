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

<body>
  <?php
  // stranica gde se bira koji ću izveštaj 


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
            <h3 class="font-weight-bold">Izveštaj o konkursu</h3>
           
            <div class="col-8 my-4 pb-3 border-bottom border-dark">
                <form action="izvestajKonkursa.php" method="POST">
                    <select  class="form-control" name="konkursa">
                        <option value="" >Konkursi</option>
                        <?php
                        //prikazuju se svi konkursi za dodavanje opcija u select elementu
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

                    <div class="my-4 d-flex justify-content-center">
                        <button style="width: 100%;" class="btn btn-secondary" name="sacuvaj" type="submit">
                            Generiši izveštaj o konkursu
                        </button>
                    </div>
              </form>
            </div>


            <h3 class="font-weight-bold">Izveštaj o detetu</h3>
           
           <div class="col-8 my-4 ">
           <form action="izvestajDeteta.php" method="POST" onsubmit="return proveraJMBGIzvestaj()">

           <div class="form-group">
                <input type="number" class="mb-1 form-control" name="jmbg" id="jmbgIzvestaj" placeholder="JMBG deteta" required> 
                <p class="font-error bg-transparent" style="display: none" id="jmbgIzvestajError">Uneti JMBG od 13 karaktera*</p>
            </div>
               <div class="mt-4 d-flex justify-content-center">
                   <button style="width: 100%;" class="btn btn-secondary" name="sacuvaj" type="submit">
                       Generiši izveštaj o detetu
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