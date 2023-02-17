<?php
class Konkurs_class
{
   public $konekcija;
   public $nazivKonkursa;
   public $opis;
   public $rokZaPrijavu;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiKonkurs($nazivKonkursa, $opis, $rokZaPrijavu)
    //mysqli_real_escape_string kada naiđe na specijalni karakter string
    {
        $_opis = mysqli_real_escape_string($this->konekcija,$opis);
        $sqlUpit=" INSERT INTO `konkurs` (`ID_KONKURSA`, `NAZIV_KONKURSA`, `OPIS`, `ROK_ZA_PRIJAVU`) VALUES (NULL, '$nazivKonkursa', '$_opis', '$rokZaPrijavu')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }

    public function prikazSvihKonkursa()
    {
        $sqlUpit=" SELECT * FROM `konkurs`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function prikazAktivnihKonkursa()
    {
        $sqlUpit=" SELECT * FROM `konkurs` WHERE `ROK_ZA_PRIJAVU` > NOW()";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function prikazSaIDKonkursom($idKonkursa)
    {
        $sqlUpit=" SELECT * FROM `konkurs` WHERE `ID_KONKURSA` = $idKonkursa";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function obrisiKonkurs($idKonkursa)
    {
        $sqlUpit=" DELETE FROM `konkurs` WHERE `ID_KONKURSA`= $idKonkursa";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }

    public function izmeniKonkurs($idKonkursa,$nazivKonkursa, $opis, $rokZaPrijavu)
    {
        $_opis = mysqli_real_escape_string($this->konekcija,$opis);
        $sqlUpit=" UPDATE `konkurs` SET `NAZIV_KONKURSA`='$nazivKonkursa',`OPIS`='$_opis',`ROK_ZA_PRIJAVU`='$rokZaPrijavu' WHERE `ID_KONKURSA`=$idKonkursa ";
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