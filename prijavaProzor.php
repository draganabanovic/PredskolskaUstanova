<?php
  if(isset($_POST['prijava'])) {
    $email=$_POST['email'];
    $sifra=$_POST['sifra'];
    require 'class/NalogClass.php';
    $nalog = new Nalog_class();
    $rezultat = $nalog->prijava($email,$sifra);
  }
?>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="prijavaModel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-title text-center mb-2">
          <div class="row mt-2">
            <h4 class="col-6 offset-3">Prijava korisnika</h4>
            <button type="button" class="close col-2  offset-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <div class="d-flex flex-column text-center">
          <form role="form" method='POST' action="">
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="sifra" placeholder="Šifra" required>
            </div>
            <button name="prijava" type="submit" type="button" class="btn btn-info btn-block btn-round">Prijava</button>
          </form>
        </div>
      </div>
        <div class="modal-footer d-flex justify-content-center">
          <div class="signup-section">
            Nemate nalog? <a class="nav-link" href="#" data-toggle="modal" data-target="#registracioniModel">Registracija</a>
          </div>
        </div>
    </div>
  </div>
</div>  
