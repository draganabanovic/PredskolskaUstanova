<?php
session_start();
if(!isset($_GET['id'])){
    header("Location: ../index.php");
    exit();
}else{
    if(!isset($_SESSION['uloga'])){
        header("Location: ../index.php?message=Ulogujte se");
    }else{
        if($_SESSION['uloga']=="admin"){
            require '../class/KonkursClass.php';
            $konkurs = new Konkurs_class();
            $rezultat = $konkurs->obrisiKonkurs($_GET['id']);
            if($rezultat>0){
                header("Location: ../pretragaKonkursa.php?message=Uspešno obrisan konkurs"); 
                exit();
            }else{
                header("Location: ../pretragaKonkursa.php?message=Konkurs nije obrisan&greska=1"); 
            }
        }else{
            header("Location: ../index.php?message=Nisu vam dozvoljene admin opcije&greska=1");
        }
    }
}