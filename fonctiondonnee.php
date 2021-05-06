<?php
include('Connexion_bdd.php');
function test_tout_est_remplie($val){
    $cestRemplie = true;
    foreach($val as $key => $v){
        if(empty($v)){
            $cestRemplie = false;
        }
    }
    return $cestRemplie;
}
function numerique($number){
    return str_replace('e', 'a', $number);
}

function rendre_le_prix_float($prix) {
str_replace(',', '.', $prix);
$prix = trim($prix);
$prix = floatval($prix);
$prix = round($prix, 2);
}
function modifierBDD($bdd, $nomtable, $id, $tableauAChanger, $champautre, $champteeshirt){
    $champsBdd = $bdd->prepare("SELECT * FROM ".$nomtable." WHERE ".$champteeshirt." = ?");
    $champsBdd ->execute(array($id));
    $ancien_resultat = array();
    while($reponse = $champsBdd ->fetch()){
        $ancien_resultat[] = $reponse[$champautre];
    }
    $tableau_ajouter = array_diff($tableauAChanger, $ancien_resultat); // si tableau_diff a une valeur cela veut dire qu'il faut ajouter
    $tableau_supprimer = array_diff($ancien_resultat, $tableauAChanger); // si tableau_diff a une valeur cela veut dire qu'il faut supprimer
    if($tableau_supprimer){
        foreach($tableau_supprimer as $val){
            $supprimer = $bdd->prepare("DELETE FROM ".$nomtable." WHERE ".$champautre." = ? AND ".$champteeshirt." = ?");
            $supprimer -> execute(array($val, $id));
        }
    }
    if($tableau_ajouter){
        foreach($tableau_ajouter as $val){
            $ajouter = $bdd->prepare("INSERT INTO ".$nomtable." (".$champautre.", ".$champteeshirt.") VALUES (?,?)");
            $ajouter -> execute(array($val, $id));
        }
    }
}
function imagetest($image){
    $target_dir = "../uploads2/";
    $target_file = $target_dir . basename($image["name"]);
    $uploadOk = 1;
    $retour = 0;
    if(file_exists($target_file)){
        $uploadOk = 0;
    }
    if($image["size"] > 10485760){
        $uploadOk = 0;
    }
    //Check if image file is a actual image or fake image
    $check = getimagesize($image["tmp_name"]);
    if($check === 0) {
        $uploadOk = 0;
    }
    if($uploadOk === 1){
        move_uploaded_file($image["tmp_name"], $target_file);
        $retour = [1, $target_file];
        return $retour;
    }else {
        return $retour;
    }

}
function maximumBDD ($bdd, $nomtable){
    $max = $bdd -> query("SELECT max(ID) FROM ".$nomtable);
    $max = $max ->fetch();
    return $max[0];
}
function VerifEmail ($email){
}