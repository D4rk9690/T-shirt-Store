<?php
    session_start();
    if((!empty($_POST)) AND (!empty($_GET)) AND (is_numeric($_GET["idArticle"]))){
        $valeurKey = NULL;
        if(empty($_SESSION["idArticle"])){
            $_SESSION["nombreArticle"] = 0;
            $_SESSION["idArticle"][] = $_GET["idArticle"];
            $_SESSION["taille"][] = $_POST["taille"];
            $_SESSION["modele"][] = $_POST["modele"];
            $_SESSION["quantite"][] = $_POST["quantite"];
            echo $_POST["quantite"];
            $_SESSION["nombreArticle"]++;
            header('Location: index.php');
        }else{
            foreach($_SESSION["idArticle"] as $key => $value){
                if($value == $_GET["idArticle"]){
                    $valeurKey = $key;
                }
            }
            if($valeurKey === NULL){
                $_SESSION["idArticle"][] = $_GET["idArticle"];
                $_SESSION["taille"][] = $_POST["taille"];
                $_SESSION["modele"][] = $_POST["modele"];
                $_SESSION["quantite"][] = $_POST["quantite"];
                $_SESSION["nombreArticle"]++;
                header('Location: index.php');
            }else{
                if(($_SESSION["modele"][$valeurKey] === $_POST["modele"]) AND ($_SESSION["taille"][$valeurKey] === $_POST["taille"])){
                    if(4 >= $_POST["quantite"]+ $_SESSION["quantite"][$valeurKey]){
                        $_SESSION["quantite"][$valeurKey] = $_SESSION["quantite"][$valeurKey] + $_POST["quantite"];
                        header('Location: index.php');
                    }else{
                        header("Location: pageArticle.php?idArticle=".$_GET["idArticle"]."&quantite=5");
                    }
                }else{
                    $_SESSION["idArticle"][] = $_GET["idArticle"];
                    $_SESSION["taille"][] = $_POST["taille"];
                    $_SESSION["modele"][] = $_POST["modele"];
                    $_SESSION["quantite"][] = $_POST["quantite"];
                    header('Location: index.php');
                }
            }
        }
    }
?>