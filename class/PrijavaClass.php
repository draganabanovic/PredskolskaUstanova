<?php
class Prijava_class
{
    public $konekcija;
    public $idKonkursa;
    public $jmbgDeteta;

    function __construct() 
    {
        include_once "KonekcijaDbClass.php";
        $kon = new KonekcijaDb_class();
        $this->konekcija = $kon->otvoriKonekciju();
    }
   
    public function snimiPrijavu($jmbgDeteta, $idKonkursa)

    {
        //pozivanje funkcije za izračunavanje bodova i prosleđuje se jmbg
        $poeni = $this->izracunajBodove($jmbgDeteta);
        $datum=date("Y-m-d");
        $sqlUpit=" INSERT INTO `prijava`( `JMBG_DETETA`, `ID_KONKURSA`, `DATUM_PODNOSENJA_PRIJAVE`, `BODOVI`) VALUES ('$jmbgDeteta', '$idKonkursa','$datum',' $poeni')";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        if($rezultat)return true;
        return false;  
    }

    public function prikaziPrijave()
    {
        $sqlUpit="SELECT * FROM `prijava`";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function prikaziPrekoIDPrijave($id)
    {
        $sqlUpit="SELECT * FROM `prijava` WHERE `ID_PRIJAVE`= $id";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }
//izveštaj prijava za konkurs sa bodovima
    public function prikaziPrekoIDKonkursa($idKonkursa)
    {
        $sqlUpit="SELECT dete.*, prijava.BODOVI, prijava.DATUM_PODNOSENJA_PRIJAVE FROM prijava 
                    INNER JOIN dete on prijava.JMBG_DETETA = dete.JMBG_DETETA
                    WHERE prijava.ID_KONKURSA = '$idKonkursa'
                    ORDER BY prijava.BODOVI DESC";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $rezultat; 
    }

    public function obrisiPrijavu($id)
    {
        $sqlUpit=" DELETE FROM `prijava` WHERE `ID_PRIJAVE`= $id";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        return $this->konekcija->affected_rows; 
    }
    //izračunavanje bodova: za svako zdravstveno stanje čiji je id različiti od 1 daje po jedan bod isto i ukoliko pripada nekoj ugroženoj grupi dobija po bod

    private function izracunajBodove($jmbgDeteta){
        $brojZdravstvenihStanja=0;
        $drustvenaGrupa=0;
        
        $sqlUpit="SELECT `JMBG_DETETA` FROM `ustanovljeno` WHERE `JMBG_DETETA` = $jmbgDeteta";
        $rezultatt = mysqli_query($this->konekcija, $sqlUpit);
        while($red=mysqli_fetch_array($rezultatt)){
            $brojZdravstvenihStanja++;
        }

        $sqlUpit="SELECT `JMBG_DETETA` FROM `dete` WHERE `JMBG_DETETA`= $jmbgDeteta AND `ID_DRUSTVENE_GRUPE`!=1";
        $rezultat = mysqli_query($this->konekcija, $sqlUpit);
        while($red=mysqli_fetch_array($rezultat)){
            $drustvenaGrupa++;
        }
       
        return $brojZdravstvenihStanja + $drustvenaGrupa;
    }

    function __destruct() 
    {
        unset($this->konekcija);
    }

}
?>