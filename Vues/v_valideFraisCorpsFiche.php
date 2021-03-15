<<<<<<< HEAD
<body>  
    <div id="contenu">
        <h2>Validation d'une fiche de frais visiteur</h2>
        <br />
        <form name="frmChoixVisiteurMoisFiche" id="frmChoixVisiteurMoisFiche" method="post" action="index.php">
            <?php echo $pdo->ListeVisiteursDepuisRecordset(isset($_REQUEST["lstVisiteur"]) ? $_REQUEST["lstVisiteur"] : NULL); ?>
            <label for="txtMoisFiche">Mois : </label>
            <input type="text" name="txtMoisFiche" id="txtMoisFiche" value="<?= affichageMois()?>" readonly="readonly" />
            <input type="submit" id="btnOk" name="btnOk" value="Ok" tabindex ="20" />
            <input type="hidden" name="uc" value="validerFicheFrais" />
            <input type="hidden" name="action" value="afficherFicheFraisSelectionnee" />
        </form>
    </div>
    <?php
    include("vues/v_valideFrais/v_valideFraisEtatFicheFrais.php");
    include("vues/v_valideFrais/v_valideFraisForfait.php");
    include("vues/v_valideFrais/v_valideFraisValider.php");
    ?>
</body>
=======
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include("Vues/v_valideFrais/v_valideFraisEtatsFicheFrais");
        include("Vues/v_valideFrais/v_valideFraisForfait");
        include("Vues/v_valideFrais/v_valideFraisValider");
        ?>
    </body>
</html>
>>>>>>> 909c08d4d86378a2283115fc8c4c928a3de76750
