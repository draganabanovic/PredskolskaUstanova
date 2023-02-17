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
            require '../class/ZdravstvenoStanjeClass.php';
            $stanje = new ZdravstvenoStanje_class();
            $rezultat = $stanje->obrisiZdravstvenoStanje($_GET['id']);
            if($rezultat>0){
                header("Location: ../pretragaZdravstvenogStanja.php?message=Uspešno obrisano zdravstveno stanje"); 
                exit();
            }else{
                header("Location: ../pretragaZdravstvenogStanja.php?message=Zdravstveno stanje nije obrisan&greska=1"); 
            }
        }else{
            header("Location: ../index.php?message=Nisu vam dozvoljene admin opcije&greska=1");
        }
    }
}