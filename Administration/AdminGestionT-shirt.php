<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../ConnexionAdmin.php");
    }
    include("AdminHead.php");
    include("AdminHeader.html");
?>
<body>
    <?php
        $tshirt = $bdd->query('SELECT t.numero_de_reference, t.nom, t.URL, t.Image FROM teeshirts AS t 
        WHERE t.date_supp IS NULL
        ');
        echo "<div class=\"container d-flex flex-column\">";
        while($list = $tshirt -> fetch()){
            echo "<div class=\"d-flex justify-content-around mb-2 background align-items-center rounded\">
                    <div class=\"w-75 d-flex justify-content-between\">
                        <div class=\"pl-2 py-2 color-light w-50\">
                            <span class=\"align-top\">".$list["numero_de_reference"]."</span>
                        </div>
                        <div class=\"pr-2 py-2 color-light w-50\">
                            <span class=\"align-middle\">".$list["nom"]."</span>
                        </div>
                    </div>
                    <div class=\"w-25 d-flex justify-content-end\">
                        <a class=\"px-2 color-light\" href=\"#\">Modifier</a>
                        <a class=\"px-2 color-light\"href=\"#\">Supprimer</a>
                    </div>
            </div>";
        }
        echo "<a class=\"color-light background py-1 px-2 rounded align-self-end\" href=\"CreationTshirt.php\">Ajouter un nouveau t-shirt</a></div>";
    ?>
    
</body>