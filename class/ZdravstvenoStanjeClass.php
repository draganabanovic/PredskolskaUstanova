<?php
class ZdravstvenoStanje_class
{
    public $konekcija;
    public $nazivZdravstvenogStanja;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiZdravstvenoStanje($nazivZdravstvenogStanja)
    {
        $sqlUpit="INSERT INTO `zdravstveno_stanje` (`ID_ZDRAVSTVENOG_STANJA`, `NAZIV_STANJA`) VALUES (NULL, '$nazivZdravstvenogStanja');";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }

    public function preuzmiZdravstvenaStanja()
    {
        $sqlUpit="SELECT * FROM `zdravstveno_stanje`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function obrisiZdravstvenoStanje($idZdravstvenogStanja)
    {
        $sqlUpit="DELETE FROM `zdravstveno_stanje` WHERE `ID_ZDRAVSTVENOG_STANJA` = $idZdravstvenogStanja";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }

    public function prikazSaIDStanja($idZdravstvenogStanja)
    {
        $sqlUpit=" SELECT * FROM `zdravstveno_stanje` WHERE `ID_ZDRAVSTVENOG_STANJA` = $idZdravstvenogStanja";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }
    //iz tabele ustanovljeno se uzimaju sva zdravstvena stanja koja su sa tim jmbgom deteta, služi za izveštaj o detetu koje bolesti ima ako ima
    public function prikazZdravstvenoStanjeDeteta($jmbg)
    {
        $sqlUpit=" SELECT `zdravstveno_stanje`.`NAZIV_STANJA` FROM `ustanovljeno` 
        INNER JOIN `zdravstveno_stanje`
        ON `ustanovljeno`.ID_ZDRAVSTVENOG_STANJA=`zdravstveno_stanje`.ID_ZDRAVSTVENOG_STANJA
        WHERE `JMBG_DETETA`=$jmbg";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function izmeniZdravstvenoStanje($idZdravstvenogStanja,$nazivZdravstvenogStanja)
    {
        $sqlUpit="UPDATE `zdravstveno_stanje` SET `NAZIV_STANJA`='$nazivZdravstvenogStanja' WHERE `ID_ZDRAVSTVENOG_STANJA`= $idZdravstvenogStanja";
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