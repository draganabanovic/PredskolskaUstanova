<nav class="navbar navbar-expand-lg custom_nav-container ">
    <a class="navbar-brand" href="index.php">
      <span>
        Vrtić 
      </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex ml-auto flex-column flex-lg-row align-items-center ">
        <ul class="navbar-nav  ">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Početna<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
              <a class="nav-link" href="prijavaDeteta.php">Prijava deteta</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="prikazKonkursa.php">Pregled konkursa</a>
            </li>
          
          <?php 
          if(isset($_SESSION['uloga'])){
            if($_SESSION['uloga']=='admin'){
              echo '
              <li class="nav-item active">
                <a class="nav-link" href="izvestaji.php">Izveštaji</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#">Osnovni podaci</a>
                <ul>
                  <li><a href="unosMesta.php">Mesta</a></li>
                  <li><a href="unosDrustveneGrupe.php">Društvene grupe</a></li>
                  <li><a href="unosZdravstvenogStanja.php">Zdravstvena stanja</a></li>
                  <li><a href="unosKonkursa.php">Konkursi</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pretraga</a>
                <ul>
                  <li><a href="pretragaMesta.php">Mesta</a></li>
                  <li><a href="pretragaDrustveneGrupe.php">Društvene grupe</a></li>
                  <li><a href="pretragaZdravstvenogStanja.php">Zdravstvena stanja</a></li>
                  <li><a href="pretragaKonkursa.php">Konkursi</a></li>
                </ul>
              </li>';

            }
            echo '
                  <li class="nav-item active">
                    <a class="nav-link" href="nalog.php">Nalog</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link bg-warning shadow-sm rounded mx-2" href="odjavaNaloga.php">Odjava</a>
                  </li>
                  ';
          }else{echo'
                  <li class="nav-item">
                    <a  class="nav-link bg-warning shadow-sm rounded mx-2 mb-2" href="#" data-toggle="modal" data-target="#loginModal">Prijava</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link bg-warning shadow-sm rounded mx-2" href="#" data-toggle="modal" data-target="#registracioniModel" > Registracija</a>
                  </li>
                  ';
          }
          ?>
        </ul>
      </div>
  </nav>

  <?php include "prijavaProzor.php"; ?>
  <?php include "registracijaProzor.php"; ?>