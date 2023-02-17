<?php
class Nalog_class
{
    public $konekcija;
    public $email;
    public $sifra;


    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiNalog($email, $sifra)
    {
        $hash = password_hash($sifra, PASSWORD_DEFAULT);
        $sqlUpit=" INSERT INTO `korisnicki_nalog`(`EMAIL_KORISNIKA`, `SIFRA_KORISNIKA`, `ULOGA`) VALUES ('$email', '$hash', 'korisnik')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }

    public function preuzmiNalog()
    {
        $sqlUpit="SELECT `EMAIL_KORISNIKA` FROM `korisnicki_nalog`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function prijava($email, $sifra)
    {
        $sqlUpit="SELECT korisnicki_nalog.EMAIL_KORISNIKA, korisnicki_nalog.ULOGA, korisnicki_nalog.SIFRA_KORISNIKA, roditelj_staratelj.JMBG_RODITELJA_STARATELJA 
                FROM `korisnicki_nalog` 
                LEFT JOIN roditelj_staratelj ON korisnicki_nalog.EMAIL_KORISNIKA=roditelj_staratelj.EMAIL_KORISNIKA
                WHERE korisnicki_nalog.EMAIL_KORISNIKA= '$email'";
//left join uzeće sve iz tabele korisnik i iz roditelja ako ga ima, može da ga nema a treba da uzme iz tabele korisnik zbog admina
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if(mysqli_num_rows($rezultat)==0){
            echo("<script>location.href = 'index.php?message=Mejl ne postoji&greska=1';</script>");
            exit();
        }
        
        while($row = mysqli_fetch_assoc($rezultat))
            {
                if(!password_verify($sifra, $row['SIFRA_KORISNIKA'])){
                echo("<script>location.href = 'index.php?message=Nije uneta dobra šifra&greska=1';</script>");
                //<script>location.href - zato što je header već postavljen
                exit();
                } else if (password_verify($sifra, $row['SIFRA_KORISNIKA'])){
                    
                    //ako je roditelj dodaje mu jmbg roditelja sesiji
                if(isset($row['JMBG_RODITELJA_STARATELJA'])){
                    $_SESSION['jmbg'] = $row['JMBG_RODITELJA_STARATELJA'];
                }
                //dodavanje podataka sesiji
                $_SESSION['uloga'] = $row['ULOGA'];
                $_SESSION['email'] = $row['EMAIL_KORISNIKA'];
                echo("<script>location.href = 'index.php?message=Uspešno prijavljeni';</script>");
                exit();
                }
            }   
        return $rezultat; 
    }
// proverava da li uneti email postoji već u bazi
    public function slobodanEmail($email)
    {
        $sqlUpit="SELECT * FROM `korisnicki_nalog` WHERE `EMAIL_KORISNIKA`= '$email'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if(mysqli_num_rows($rezultat)==0)return true;
        return false; 
    }
    //nije korišćena metoda

    public function obrisiNalog($email)
    {
        $sqlUpit=" DELETE FROM `korisnicki_nalog` WHERE `EMAIL_KORISNIKA`= '$email'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }
    
     //menjanje i šifre i emaila
    public function izmeniNalogSaSifrom($stariEmail,$noviEmail,$sifra)
    {
        $hash = password_hash($sifra, PASSWORD_DEFAULT);
        $sqlUpit=" UPDATE `korisnicki_nalog` SET `EMAIL_KORISNIKA`='$noviEmail' ,`SIFRA_KORISNIKA`='$hash' WHERE `EMAIL_KORISNIKA`='$stariEmail'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false; 
    }
   //menjanje samo email-a
    public function izmeniNalog($stariEmail,$noviEmail)
    {
        $sqlUpit=" UPDATE `korisnicki_nalog` SET `EMAIL_KORISNIKA`='$noviEmail' WHERE `EMAIL_KORISNIKA`='$stariEmail'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false; 
    }

    function __destruct() 
    {
        unset($this->konekcija);
    }

}
?>