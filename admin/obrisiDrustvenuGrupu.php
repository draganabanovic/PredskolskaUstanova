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
            require '../class/DrustvenaGrupaClass.php';
            $grupa = new DrustvenaGrupa_class();
            $rezultat = $grupa->obrisiDrustvenuGrupu($_GET['id']);
            if($rezultat>0){
                header("Location: ../pretragaDrustveneGrupe.php?message=Uspešno obrisana društvena grupa"); 
                exit();
            }else{
                header("Location: ../pretragaDrustveneGrupe.php?message=Društvena grupa nije obrisan&greska=1"); 
            }
        }else{
            header("Location: ../index.php?message=Nisu vam dozvoljene admin opcije&greska=1");
        }
    }
}