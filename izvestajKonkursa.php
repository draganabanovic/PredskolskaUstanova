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

    $idKonkursa=$_POST['konkursa'];
    $nazivKonkursa="";

    require_once 'class/KonkursClass.php';
    $konkurs = new Konkurs_class();
    $svePrijave = $konkurs->prikazSaIDKonkursom($idKonkursa); //uzimanje naslova konkursa
    
    while($red = mysqli_fetch_array($svePrijave)){
      $nazivKonkursa=$red['NAZIV_KONKURSA'];
    }

    echo "<h4 align='center' class='mt-5'>Konkurs: $nazivKonkursa</h4>";

    require_once 'class/PrijavaClass.php';
    $prijava = new Prijava_class();
    $svePrijave = $prijava->prikaziPrekoIDKonkursa($idKonkursa); //uzima podatke o deci (iz tabele dete), bodove i kad su se prijavili za taj konkurs (to uzima iz tabele prijave)
   echo' <div class="container">'; 
    if (mysqli_num_rows($svePrijave)==0) 
		{
			echo "U bazi podataka nema prijava za izabrani kokurs!";
			echo "<br/>";
		}
    echo "<table class=' table mt-5' >
            <thead>
            <tr>
              <th scope='col'>JMBG</th>
              <th scope='col'>Ime</th>
              <th scope='col'>Prezime</th>
              <th scope='col'>Pol</th>
              <th scope='col'>Datum rođenja</th>
              <th scope='col'>Adresa</th>
              <th scope='col'>Državljanstvo</th>
              <th scope='col'>Datum prijave</th>
              <th scope='col'>Bodovi</th>
            </tr>
          </thead>
          <tbody>";
    while($red = mysqli_fetch_array($svePrijave))
				{
					echo "
                <tr align=left>
                  <td>" . $red['JMBG_DETETA'] . "</td>
                  <td>" . $red['IME_DETETA'] . "</td>
                  <td>" . $red['PREZIME_DETETA'] . "</td>
                  <td>" . $red['POL_DETETA'] . "</td>
                  <td>" . date("d.m.Y",strtotime($red['DATUM_RODJENJA_DETETA'])) . "</td>
                  <td>" . $red['ULICA_I_BROJ_PREBIVALISTA_DETETA'] . "</td>
                  <td>" . $red['DRZAVLJANSTVO'] . "</td>
                  <td>" .date("d.m.Y",strtotime($red['DATUM_PODNOSENJA_PRIJAVE'])) . "</td>
                  <td>" . $red['BODOVI'] . "</td>
                </tr>

                ";
				}// end while
				echo "</tbody>
              </table><br/><br/>
              </div>";
    ?>

 
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/script.js"></script>

 
</body>

</html>