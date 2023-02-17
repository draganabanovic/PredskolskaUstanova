<?php
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
  
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,600&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <!-- Chosen plagin za jQuery -->
  <link href='js/chosen/chosen.min.css' rel='stylesheet' type='text/css'>
  



</head>

<body class="sub_page">


  <?php
    
    require_once 'class/DeteClass.php';
    $dete = new Dete_class();

    require_once 'class/MestoClass.php';
    $mesta = new Mesto_class();
    $svaMesta = $mesta->preuzmiMesta();

    require_once 'class/ZdravstvenoStanjeClass.php';
    $zdravstvenoStanje = new ZdravstvenoStanje_class();
    $svaZdravstvenaStanja = $zdravstvenoStanje->preuzmiZdravstvenaStanja();

    require_once 'class/DrustvenaGrupaClass.php';
    $drustvenaGrupa = new DrustvenaGrupa_class();
    $sveDrustveneGrupe = $drustvenaGrupa->preuzmiDrustveneGrupe();

    require_once 'class/KonkursClass.php';
    $konkurs = new Konkurs_class();
    $sviKonkursi = $konkurs->prikazAktivnihKonkursa();

    require_once 'class/RoditeljClass.php';
    $roditelj = new Roditelj_class();

    require_once 'class/PrijavaClass.php';
    $prijava = new Prijava_class();

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

    if(isset($_POST['sacuvaj'])) 
      {
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $jmbg=$_POST['jmbg'];
        $pol=$_POST['pol'];
        $datumRodjenja=$_POST['datumRodjenja'];
        $mesto=$_POST['mesto'];
        $adresa=$_POST['adresa'];
        $drzavljansrvo=$_POST['drzavljansrvo'];
        $zdravstvenaStanja=$_POST['zdravstvenaStanja'];
        $drustvenaGrupa=$_POST['drustvenaGrupa'];
        $idKonkura=$_POST['konkurs'];
        
       
        if(!$roditelj->proveriJMBG($jmbg)){
          echo("<script>location.href = 'prijavaDeteta.php?message=JMBG već korišćenn&greska=1';</script>");
          exit();
        }
        if(!$dete->proveriJMBG($jmbg)){
          echo("<script>location.href = 'prijavaDeteta.php?message=JMBG već korišćen&greska=1';</script>");
          exit();
        }

        $snimljenDete= $dete->snimiDete($jmbg,$ime,$prezime,$pol,$datumRodjenja,$adresa,$drzavljansrvo,$drustvenaGrupa,$mesto);
        if(!$snimljenDete){
          echo("<script>location.href = 'prijavaDeteta.php?message=Došlo je do greške, dete nije snimljen&greska=1';</script>");
          exit();
        }

        $deteRoditelj = $dete->poveziSaRoditeljem($jmbg,$_SESSION['jmbg'],$_SESSION['email']);
        if(!$deteRoditelj){
          echo("<script>location.href = 'prijavaDeteta.php?message=Došlo je do greške, dete-roditelj nije poveznao&greska=1';</script>");
          exit();
        }

        $deteZdravstvenoStanje = $dete->poveziSaZdravstveniStanjima($jmbg,$zdravstvenaStanja);
        if(!$deteZdravstvenoStanje){
          echo("<script>location.href = 'prijavaDeteta.php?message=Došlo je do greške, zdravstvena stanja nisu upisana&greska=1';</script>");
          exit();
        }

        $prijavaNaKonkurs = $prijava->snimiPrijavu($jmbg, $idKonkura);
        if(!$deteRoditelj){
          echo("<script>location.href = 'prijavaDeteta.php?message=Došlo je do greške, dete-konkurs nije poveznao&greska=1';</script>");
          exit();
        }

        echo("<script>location.href = 'prijavaDeteta.php?message=Uspešno ste prijavili dete';</script>");

      }
  ?>

  <div class="top_container ">
    <header class="header_section">
      <div class="container">
       <?php require_once "meni/gornjiMeni.php"; ?>
      </div>
    </header>
  </div>

  <section class="contact_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="d-flex justify-content-center d-md-block">
            <h2>
              Prijava deteta
            </h2>
          </div>
          <form role="form" method='POST' onsubmit="return proveraForme()">
            <div class="contact_form-container">
              <div>
                <div>
                  <input type="text"  name="ime" id="imePrijava" placeholder="Ime" class="mb-1">
                  <p class="font-error" style="display: none" id="imePrijavaError">Uneti ime*</p> 
                </div>

                <div class="mt-2">
                  <input type="text" name="prezime" id="prezimePrijava" placeholder="Prezime" class="mb-1"> 
                  <p class="font-error" style="display: none" id="prezimePrijavaError">Uneti prezime*</p> 
                </div>

                <div class="mt-2">
                  <input type="number" name="jmbg" id="jmbgPrijava" placeholder="JMBG" class="mb-1"> 
                  <p class="font-error" style="display: none" id="jmbgPrijavaError">Uneti JMBG od 13 cifara*</p> 
                </div>

                <div class="pl-2 row">
                  <div class="col-3 mx-1">
                    <input class="col-3" type="radio" name="pol" checked  id="polMPrijava" value="muško">
                    <label class="col-3" for="radio1">Muško</label>
                  </div>
                  <div class="col-3 mx-1">
                    <input class="col-3" type="radio" name="pol" id="polZPrijava"  value="žensko">
                    <label class="col-3" for="radio2">Žensko</label>
                  </div>
                </div>

                <div class="mt-2">
                  <label  for="datumRodjenja" class="mb-0">Darum rođenja:</label>
                  <input class="mx-4 mb-1" style="width:auto" type="date" id="datumPrijava" name="datumRodjenja" placeholder="datumRodjenja" max=<?php echo date('Y-m-d');?>>
                  <p class="font-error" style="display: none" id="datumPrijavaError" >Uneti datum*</p> 
                </div>

                <div class="mt-4">       
                  <select data-placeholder="Mesto (opština)" id="mestoPrijava"  class="chosen-select mb-1" name="mesto" >
                      <option value=""></option>
                      <?php 
                        $brredova = mysqli_num_rows($svaMesta);
                        if ($brredova>0)
                            {
                              while($red=mysqli_fetch_array($svaMesta))
                              {
                      ?>
                                <option value=<?php echo $red['ID_MESTA']?> ><?php echo $red['NAZIV_MESTA']?> (<?php echo $red['NAZIV_OPSTINE']?>)</option>
                      <?php
                              }
                            }
                      ?>
                      
                  </select>
                  <p class="font-error" style="display: none" id="mestoPrijavaError">Odabrati mesto*</p> 
                </div>

                <div class="mt-2">
                  <input type="text" class="mb-1" name="adresa" id="adresaPrijava" placeholder="Ulica i broj prebivališta" >
                  <p class="font-error" style="display: none" id="adresaPrijavaError">Uneti adresu*</p> 
                </div>

                <div class="mt-2">
                  <input type="text" class="mb-1" name="drzavljansrvo" id="drzavljansrvoPrijava" placeholder="Drzavljansrvo" > 
                  <p class="font-error" style="display: none" id="drzavljansrvoPrijavaError">Uneti državljanstvo*</p>
                </div>

                
                <div class="mt-3"> 
                  <div class="row">
                    <input type="checkbox" class="col-1 ml-2" id="drustvenaGrupaCheckBox">
                    <label class="col m-0 p-0" >Ne pripada društveno ugroženoj grupi</label>
                  </div>
                  <div id="drustvenaGrupaPrijavaDiv">
                  <select  data-placeholder="Društveno osetljiva grupa" class="chosen-select" id="drustvenaGrupaPrijava" name="drustvenaGrupa">
                  <option value=""></option>
                      <?php 
                        $brredova = mysqli_num_rows($sveDrustveneGrupe);
                        if ($brredova>0)
                            {
                              while($red=mysqli_fetch_array($sveDrustveneGrupe))
                              {
                                if($red['ID_DRUSTVENE_GRUPE']==1)
                                {
                                  echo "<option style='display: none' value=". $red['ID_DRUSTVENE_GRUPE']. ">" .$red['NAZIV_DRUSTVENO_OSETLJIVE_GRUPE']. "</option>";
                                }else{
                                  echo "<option value=". $red['ID_DRUSTVENE_GRUPE']. ">" .$red['NAZIV_DRUSTVENO_OSETLJIVE_GRUPE']. "</option>";
                                }

                              }
                            }
                      ?>
                  </select>
                  </div>
                  <p class="font-error" style="display: none" id="drustvenaGrupaPrijavaError">Odabrati društvenu grupu*</p>
                </div>

              
                <div class="mt-2">
                  <div class="row">
                    <input type="checkbox" class="col-1 ml-2" id="zdravstvenaStanjeCheckBox">
                    <label class="col m-0 p-0" >Dobrog zdravstvenog stanja</label>
                  </div> 
                  <div id="zdravstvenaStanjaPrijavaDiv">
                    <select data-placeholder="Zdravstveno stanje deteta" multiple class="chosen-select" id="zdravstvenaStanjaPrijava" name="zdravstvenaStanja[]">
               
                        <?php 
                          $brredova = mysqli_num_rows($svaZdravstvenaStanja);
                          if ($brredova>0)
                              {
                                while($red=mysqli_fetch_array($svaZdravstvenaStanja))
                                {
                                  if($red['ID_ZDRAVSTVENOG_STANJA']==1)
                                  {
                                    echo"
                                    <option style='display: none' value=" .$red['ID_ZDRAVSTVENOG_STANJA']. ">" .$red['NAZIV_STANJA']. "</option>";
                                  }else{
                                    echo"
                                    <option value=" .$red['ID_ZDRAVSTVENOG_STANJA']. ">" .$red['NAZIV_STANJA']. "</option>";
                                  }
                                }
                              }
                        ?>
                    </select>
                  </div>
                  <p class="font-error" style="display: none" id="zdravstvenaStanjaPrijavaError">Odabrati zdravstvena stanja*</p>
                </div>


                <div class="mt-4"> 
                  <select data-placeholder="Konkurs" class="chosen-select" id="konkursPrijava" name="konkurs">
                      <option value=""></option>
                      <?php 
                        $brredova = mysqli_num_rows($sviKonkursi);
                        if ($brredova>0)
                            {
                              while($red=mysqli_fetch_array($sviKonkursi))
                              {
                                ?>
                                <option value=<?php echo $red['ID_KONKURSA']?>><?php echo $red['NAZIV_KONKURSA'] ?></option>
                                <?php
                              }
                            }
                      ?>
                  </select>
                  <p class="font-error" style="display: none" id="konkursPrijavaError">Odabrati konkurs*</p>
                </div>

                <?php
                if($_SESSION['uloga']=="korisnik"){
                  echo '<div class="mt-4 ">
                          <button name="sacuvaj" type="submit">Prijava</button>
                        </div>';
                }
                else{
                  echo '<p class="mt-4 ">Samo korisnici sa roditeljskim nalogom mogu da vrše prijavu.</p>';
                }
                ?>
                
              </div>

            </div>

          </form>
        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="images/prijava.png" alt="">
          </div>
        </div>
      </div>
     
  </section>
  <?php include "meni/donjiMeni.php"; ?>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script src='js/chosen/chosen.jquery.min.js' type='text/javascript'></script>
  <script type="text/javascript" src="js/script.js"></script>

  

  <script>
    $(document).ready(function(){
      //Select forma koriscenjem Chosen plagina za jQuery
      $('.chosen-select').chosen({ width:'90%'});
      $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});

      $("#drustvenaGrupaCheckBox").change(function() {
          if($(this).prop('checked')) {
            $('#drustvenaGrupaPrijava').val("1").trigger('chosen:updated');
            $("#drustvenaGrupaPrijavaDiv").hide();
          } else {
            $('#drustvenaGrupaPrijava').val("").trigger('chosen:updated');
            $("#drustvenaGrupaPrijavaDiv").show();
          }
      });
 
      $("#zdravstvenaStanjeCheckBox").change(function() {
          if($(this).prop('checked')) {
            $('#zdravstvenaStanjaPrijava').val("1").trigger('chosen:updated');
            $("#zdravstvenaStanjaPrijavaDiv").hide();
          } else {
            $('#zdravstvenaStanjaPrijava').val("").trigger('chosen:updated');
            $("#zdravstvenaStanjaPrijavaDiv").show();
          }
      });
    });
  </script>
 
</body>

</html>