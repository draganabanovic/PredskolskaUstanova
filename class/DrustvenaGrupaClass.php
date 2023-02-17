<?php
class DrustvenaGrupa_class
{
    public $konekcija;
    public $nazivDrustvenoOsetljiveGrupe;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
       
    }
   
    public function snimiDrustvenuGrupu($nazivDrustvenoOsetljiveGrupe)
    {
        $sqlUpit=" INSERT INTO `drustvena_grupa`(`ID_DRUSTVENE_GRUPE`, `NAZIV_DRUSTVENO_OSETLJIVE_GRUPE`)  VALUES (NULL, '$nazivDrustvenoOsetljiveGrupe')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }
//prikaz svih društvenih grupa
    public function preuzmiDrustveneGrupe()
    {
        $sqlUpit="SELECT * FROM `drustvena_grupa`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function obrisiDrustvenuGrupu($idDrustveneGrupe)
    {
        $sqlUpit=" DELETE FROM `drustvena_grupa` WHERE `ID_DRUSTVENE_GRUPE`= $idDrustveneGrupe";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }
//preuzimanje podataka za društvenu grupu sa datim id-om koji je pušten
    public function prikazSaIDGrupe($idDrustveneGrupe)
    {
        $sqlUpit=" SELECT * FROM `drustvena_grupa` WHERE `ID_DRUSTVENE_GRUPE` = $idDrustveneGrupe";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function izmeniDrustvenuGrupu($idDrustveneGrupe,$nazivDrustvenoOsetljiveGrupe)
    {
        $sqlUpit=" UPDATE `drustvena_grupa` SET `NAZIV_DRUSTVENO_OSETLJIVE_GRUPE`='$nazivDrustvenoOsetljiveGrupe' WHERE `ID_DRUSTVENE_GRUPE`=$idDrustveneGrupe";
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