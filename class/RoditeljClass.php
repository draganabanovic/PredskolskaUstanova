<?php
class Roditelj_class
{
    public $konekcija;
    public $email;
    public $jmbg;
    public $ime;
    public $prezime;
    public $telefon;
    public $zanimanje;
    public $radnaOrganizacija;
    public $stepenSpreme;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiRoditelja($email,$jmbg, $ime, $prezime, $telefon, $zanimanje, $radnaOrganizacija, $stepenSpreme)
    {
        $sqlUpit=" INSERT INTO `roditelj_staratelj`(`EMAIL_KORISNIKA`, `JMBG_RODITELJA_STARATELJA`, `IME_RODITELJA_STARATELJA`, `PREZIME_RODITELJA_STARATELJA`, `KONTAKT_TELEFON`, `ZANIMANJE`, `RADNA_ORGANIZACIJA`, `STEPEN_STRUCNE_SPREME`) VALUES ('$email','$jmbg','$ime','$prezime','$telefon','$zanimanje','$radnaOrganizacija','$stepenSpreme')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false; 
    }

    public function prikaziRoditelje()
    {
        $sqlUpit="SELECT * FROM `roditelj_staratelj`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function prikaziPrekoJMBGRoditelja($jmbg)
    {
        $sqlUpit="SELECT * FROM `roditelj_staratelj` WHERE `JMBG_RODITELJA_STARATELJA`= $jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function proveriJMBG($jmbg)
    {
        $sqlUpit="SELECT * FROM `roditelj_staratelj` WHERE `JMBG_RODITELJA_STARATELJA`= '$jmbg'";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if(mysqli_num_rows($rezultat)==0)return true;
        return false; 
    }

    public function obrisiRoditelja($jmbg)
    {
        $sqlUpit=" DELETE FROM `roditelj_staratelj` WHERE `JMBG_RODITELJA_STARATELJA`= $jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }

    function __destruct() 
    {
        unset($this->konekcija);
    }

}
?>