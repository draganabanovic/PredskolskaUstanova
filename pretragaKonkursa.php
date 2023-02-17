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
  <!-- progress barstle
  <link rel="stylesheet" href="css/css-circular-prog-bar.css"> -->
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

   ?>

  <div class="top_container ">
    <header class="header_section">
      <div class="container">
       <?php include_once "meni/gornjiMeni.php"; ?>
      </div>
    </header>
  </div>

  <section class="contact_section min-visina">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="d-flex justify-content-center ">
            <h2>
              Pretraga konkursa
            </h2>
          </div>
          <form role="form" method='POST' action="">
            <div class="contact_form-container">
              <div class="d-flex justify-content-center ">
              
                  <input type="text" id="pretraga" placeholder="Pretraga...">
              
              </div>

            </div>

          </form>
        </div>
        
      </div>
      <div class="row justify-content-center mt-4">
  
      <button  id="dugmeZaTeblu" class="btn mt-2 text-white" style="background-color: #6bd1bd;">Prikaz svih konkursa <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
        <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
        </svg>
      </button>
      </div>
  <form action="unosMesta.php" id="myform" method="POST">
  <table id="tabela" class="table text-center mt-5" style="display:none">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Naziv</th>
                    <th>Rok za prijavu</th>						
                    <th>Opcije</th>
                </tr>
            </thead>
            <tbody id="myTable">
      <?php

        $rezultat = $konkurs->prikazSvihKonkursa();
        $brredova = mysqli_num_rows($rezultat);
        if ($brredova>0)
            {
              $i=0;
              
              while($red=mysqli_fetch_array($rezultat))
              {
                $i++;
                $naziv=$red['NAZIV_KONKURSA'];
                $rok=$red['ROK_ZA_PRIJAVU'];
                $id=$red['ID_KONKURSA'];
                ?>
                    <tr>
                        <td class="align-middle"><?php echo $i ?></td> 
                        <td  class="align-middle"><?php echo $naziv ?></td>                    
                        <td class="align-middle"><?php echo date("d.m.Y",strtotime($rok))  ?></td>
                        <td class="align-middle pl-3">
                            <!-- IZMENA -->
                            <a href="unosKonkursa.php?id=<?php echo $id;?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" fill="currentColor" class="bi bi-pencil-square mx-1" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                            </a>
                            <!-- BRISANJE -->
                            <a onclick="return confirm('Da li želite da obrišete?');" href="admin/obrisiKokurs.php?id=<?php echo $id;?>" class="align-middle text-danger" title="Delete" data-toggle="tooltip">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-trash " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                            </a>
                        </td>
                    <tr>
                <?php
              
              } 
            }
          
      ?>
      </tbody">
    </table>
    </form>
    </div>
  </section>
  <?php include "meni/donjiMeni.php"; ?>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/pretraga.js"></script>


</body>

</html>