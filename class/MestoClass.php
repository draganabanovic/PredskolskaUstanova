<?php
class Mesto_class
{
    public $konekcija;
    public $naziv;
    public $opstina;
    public $drzava;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiMesto($naziv,$opstina,$drzava)
    {
        $sqlUpit=" INSERT INTO `mesto` (`ID_MESTA`, `NAZIV_MESTA`, `NAZIV_OPSTINE`, `DRZAVA`) VALUES (NULL, '$naziv', '$opstina', '$drzava')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }

    public function preuzmiMesta()
    {
        $sqlUpit="SELECT * FROM `mesto`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    //$this->konekcija->affected_rows  vraca koliko je redova obuhvaceno naredbom
    public function obrisiMesto($idMesta)
    {
        $sqlUpit=" DELETE FROM `mesto` WHERE `ID_MESTA`= $idMesta";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }

    public function prikazSaIDMesta($idMesta)
    {
        $sqlUpit=" SELECT * FROM `mesto` WHERE `ID_MESTA` = $idMesta";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function izmeniMesto($idMesta,$naziv,$opstina,$drzava)
    {
        $sqlUpit=" UPDATE `mesto` SET `NAZIV_MESTA`='$naziv',`NAZIV_OPSTINE`='$opstina',`DRZAVA`='$drzava' WHERE `ID_MESTA`=$idMesta";
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