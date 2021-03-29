<body>
    <div class="info">
        Attention : <br />
        <?= $message ?>
    </div>
    <form name="frmChoix" id="frmChoix" action="index.php" method="post">
        <label for="mois">Indiquer le mois :</label>
        <input type="number" min="200001" max="209912" value="<?= affichageMois() ?>" id="mois" name="mois" required />
        <input type="hidden" name="uc" value="cloturerSaisieFichesFrais" />
        <input type="hidden" name="uc" value="traiterReponseClotureFiches" />
        <input type="submit" name="btnOUI" value="OUI" />
        <a href="index.php"><input type="button" name="btnNON" value="NON" /></a>
    </form>
</body>