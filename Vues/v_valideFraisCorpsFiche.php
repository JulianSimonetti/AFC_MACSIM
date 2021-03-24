<body>
    <script src="./JavaScript/controleForm.js"></script>
    <div id="contenu">
        <?php 
        if (isset($resMAJ)) {
            ?>
        <table id="<?= ($resMAJ == true ? "messageSucces" : "messageErreur") ?>">
            <tr>
                <th>
                    <?= ($resMAJ != true ? $resMAJ : "Modifications appliquées avec succès.") ?>
                </th>
            </tr>
        </table>
        <?php
        }
        ?>
        <h2>Validation d'une fiche de frais visiteur</h2>
        <br />
        <form name="frmChoixVisiteurMoisFiche" id="frmChoixVisiteurMoisFiche" method="post" action="index.php">
            <?php echo $pdo->ListeVisiteursDepuisRecordset(isset($_REQUEST["lstVisiteur"]) ? $_REQUEST["lstVisiteur"] : NULL); ?>
            <label for="txtMoisFiche">Mois : </label>
            <input type="text" name="txtMoisFiche" id="txtMoisFiche" value="<?= affichageMois() ?>" />
            <input type="submit" id="btnOk" name="btnOk" value="Ok" tabindex ="20" />
            <input type="hidden" name="uc" value="validerFicheFrais" />
            <input type="hidden" name="action" value="afficherFicheFraisSelectionnee" />
        </form>
        <?php
        include("vues/v_valideFrais/v_valideFraisEtatFicheFrais.php");
        include("vues/v_valideFrais/v_valideFraisForfait.php");
        include("vues/v_valideFrais/v_valideFraisHorsForfait.php");
        include("vues/v_valideFrais/v_valideFraisValider.php");
        ?>
    </div>
</body> 