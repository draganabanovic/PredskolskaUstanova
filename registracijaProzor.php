<?php

require_once 'class/RoditeljClass.php';
  $roditelj = new Roditelj_class();

  require_once 'class/NalogClass.php';
  $nalog = new Nalog_class();
  
  if(isset($_POST['registracija'])) {
    $email=$_POST['email'];
    $sifra=$_POST['sifra'];
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $jmbg=$_POST['jmbg'];
    $telefon= $_POST['telefon'];
    $zanimanje=$_POST['zanimanje'];
    $radnaOrganizacija=$_POST['radnaOrganizacija'];
    $strucnaSprema=$_POST['strucnaSprema'];

    if(!$nalog->slobodanEmail($email)){
      //Mora ovako jer je pre ovog koda ispisan HTML iz drugog fajla
      //prvo se cuva nalog pa se onda kreira roditelj sa tim podacima
      echo("<script>location.href = 'index.php?message=Uneti email je zauzet&greska=1';</script>");
      exit();
    }

    if(!$roditelj->proveriJMBG($jmbg)){
      echo("<script>location.href = 'index.php?message=Uneti JMBG već postoji u bazi&greska=1';</script>");
      exit();
    }

    $snimljenNalog=$nalog->snimiNalog($email,$sifra);
    if(!$snimljenNalog){
        echo("<script>location.href = 'index.php?message=Došlo je do greške, nalog nije snimljen&greska=1';</script>");
        exit();
    }
    
    $snimljenRoditelj=$roditelj->snimiRoditelja($email,$jmbg,$ime,$prezime,$telefon,$zanimanje,$radnaOrganizacija,$strucnaSprema);
    if(!$snimljenRoditelj){
      $nalog->obrisiNalog($email);
      echo("<script>location.href = 'index.php?message=Došlo je do greške, roditelj nije snimljen&greska=1';</script>");
      exit();
    }

    $nalog->prijava($email,$sifra);
  }
?>


<div class="modal fade" id="registracioniModel" tabindex="-1" role="dialog" aria-labelledby="registracijaModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <div class="form-title text-center border-bottom">
            <div class="row mt-2">
              <h4 class="col-4 offset-4">Registracija</h4>
              <button type="button" class="close col-2 offset-2" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
          </div>
          <div class="d-flex flex-column text-center">
            <form role="form" method='POST' onsubmit="return proveraJMBG()">
              <div class="text-center mt-4">
                <h5>Nalog</h5>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email"placeholder="Email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="sifra" placeholder="Šifra" required>
              </div>
            
              <div class="text-center">
                <h5>Podaci roditelja</h5>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="ime" placeholder="Ime" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="prezime" placeholder="Prezime" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" name="jmbg" id="jmbg" placeholder="JMBG" required>
                <p class="font-error" style="display: none" id="jmbgError">JMBG treba da sadrži 13 cifara*</p>
              </div>
              <div class="form-group">
                <input type="tel" class="form-control" name="telefon" placeholder="Telefon">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="zanimanje" placeholder="Zanimanje"required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="radnaOrganizacija" placeholder="Radna organizacija">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="strucnaSprema" placeholder="Stepen strucne spreme"required>
              </div>

              <button type="submit" name="registracija" class="btn btn-info btn-block btn-round">Registruj nalog</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="js/script.js"></script>