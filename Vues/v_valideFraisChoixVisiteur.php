    <body>  
        <div id="contenu">
            <h2>Validation d'une fiche de frais visiteur</h2>
            <br />
            <form name="frmChoixVisiteurMoisFiche" id="frmChoixVisiteurMoisFiche" method="post" action="choisirVisiteurMoisFiche">
                <?php echo ListeVisiteursDepuisRecordset(getListeVisiteurs()) ?>
                <label for="txtMoisFiche">Mois : </label>
                <input type="text" name="txtMoisFiche" id="txtMoisFiche" readonly="readonly" />
                <input type="submit" id="btnOk" name="btnOk" value="Ok" tabindex ="20" />
            </form>
        </div>
    </body>

    