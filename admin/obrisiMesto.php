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
            require '../class/MestoClass.php';
            $zdravstvenoStanje = new Mesto_class();
            $rezultat = $zdravstvenoStanje->obrisiMesto($_GET['id']);
           
            if($rezultat>0){
                header("Location: ../pretragaMesta.php?message=Uspešno obrisano mesto"); 
                exit();
            }else{
                header("Location: ../pretragaMesta.php?message=Mesto nije obrisano&greska=1"); 
            }
        }else{
            header("Location: ../index.php?message=Nisu vam dozvoljene admin opcije&greska=1");
        }
    }
}