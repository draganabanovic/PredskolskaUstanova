<?php
class Dete_class
{
    public $konekcija;
    public $jmbg;
    public $ime;
    public $prezime;
    public $pol;
    public $darumRodjenja;
    public $drazvljanstvo;
    
    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiDete($jmbg, $ime, $prezime, $pol, $darumRodjenja, $adresa, $drazvljanstvo, $idDrustveneGrupe, $idMesta)
    {
        $sqlUpit=" INSERT INTO `dete`(`JMBG_DETETA`, `ID_DRUSTVENE_GRUPE`, `ID_MESTA`, `IME_DETETA`, `PREZIME_DETETA`, `POL_DETETA`, `DATUM_RODJENJA_DETETA`, `ULICA_I_BROJ_PREBIVALISTA_DETETA`, `DRZAVLJANSTVO`) VALUES ('$jmbg','$idDrustveneGrupe','$idMesta','$ime','$prezime','$pol','$darumRodjenja','$adresa','$drazvljanstvo')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false; 
    }
    //upisuje se u veznu tabelu između roditelja i deteta
    public function poveziSaRoditeljem($jmbgDeteta,$jmbgRoditelja,$emailRoditelja)
    {
        $sqlUpit="INSERT INTO `ima`(`JMBG_DETETA`, `EMAIL_KORISNIKA`, `JMBG_RODITELJA_STARATELJA`) VALUES ('$jmbgDeteta','$emailRoditelja','$jmbgRoditelja')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }
    //upisuje u veznu tabelu između zdravstvenog stanja i deteta
    public function poveziSaZdravstveniStanjima($jmbgDeteta,$idZdravstvenihStanja)
    {
        //zato što može da postoji više zdravstvenih stanja i on to šalje kao niz id-ova (foreach za prolaženje kroz niz)
        foreach ($idZdravstvenihStanja as &$idStanja) {
            
            $sqlUpit="INSERT INTO `ustanovljeno`(`JMBG_DETETA`, `ID_ZDRAVSTVENOG_STANJA`) VALUES ('$jmbgDeteta','$idStanja')";
            $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        }

        return $rezultat; 
    }
    //nije korišćena metoda
    public function prikaziDecu()
    {
        $sqlUpit="SELECT * FROM `dete`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }
//korišćeno za štampanje izveštaja o detetu
    public function prikaziPrekoJMBGDeteta($jmbg)
    {
        $sqlUpit="SELECT * FROM `dete` WHERE `JMBG_DETETA`= $jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }
//INNER JOIN spajanje tabela deteta, društ grupe  preko zajedničkih podataka
    public function prikaziPodatkeZaIzvestajDeteta($jmbg)
    {
        $sqlUpit="SELECT `dete`.*, drustvena_grupa.NAZIV_DRUSTVENO_OSETLJIVE_GRUPE FROM `dete`
        INNER JOIN drustvena_grupa on dete.ID_DRUSTVENE_GRUPE = drustvena_grupa.ID_DRUSTVENE_GRUPE WHERE `dete`.`JMBG_DETETA`= $jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function obrisiDete($jmbg)
    {
        $sqlUpit=" DELETE FROM `dete` WHERE `JMBG_DETETA`= $jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }
    //prilikom unosa novog deteta proverava se da li postoji jmbg već u bazi podataka
    public function proveriJMBG($jmbg)
    {
        $sqlUpit="SELECT * FROM `dete` WHERE `JMBG_DETETA`= '$jmbg'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if(mysqli_num_rows($rezultat)==0)return true;
        return false; 
    }

    function __destruct() 
    {
        unset($this->konekcija);
    }

}
?>