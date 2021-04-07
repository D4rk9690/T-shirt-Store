<?php 
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ConnexionAdmin.php");
    }
    include("Head.php");
    include("AdminHeader.html");
    $table = "teeshirts";
    require 'fonctiondonnee.php';
    if(empty($_GET["id"])){
        header('Location: AdminGestionT-shirt.php');
        exit;
    }elseif($_GET["id"] > maximumBDD($bdd, $table)){
        header('Location: AdminGestionT-shirt.php?success=ko');  
        exit;
    }
    $supprimer = $bdd->prepare("UPDATE teeshirts SET
                                Date_supp = NOW()
                                  WHERE ID = ?
                                  ");
    $supprimer -> execute(array($_GET["id"]));
    header('Location: AdminGestionT-shirt.php?success=ok');