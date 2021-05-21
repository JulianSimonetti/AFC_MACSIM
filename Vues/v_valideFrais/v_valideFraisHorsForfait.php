<h2>Frais hors forfait</h2>
<?php
if ($lesFHF) {
    ?>
    <form name="lesFraisHorsForfait" id="frmLesFraisFHF" method="post" action="index.php"
          onsubmit="return confirm('Voulez-vous réellement enregistrer les modifications apportées aux frais hors forfait ?');">
    </form>
    <input form="frmLesFraisFHF" type="hidden" name="uc" value="validerFicheFrais" />
    <input form="frmLesFraisFHF" type="hidden" name="action" value="enregModifFHF" />
    <?php
    $nbFHF = count($lesFHF);
    foreach ($lesFHF as &$unFHF) {
        ?>
        <input type="hidden" name="countFHF" value="<?= $nbFHF ?>"/>
        <input form="frmLesFraisFHF" type="hidden" name="numFHF_N<?= $unFHF['NUM'] ?>" value="<?= $unFHF['NUM'] ?>" />
    <?php } ?>
    <table>
        <tr>
            <th>Date</th>
            <th>Libelle</th>
            <th>Montant</th>
            <th>Ok</th>
            <th>Reporter</th>
            <th>Supprimer</th>
        </tr>
        <?php foreach ($lesFHF as &$unFHF) { ?>
            <tr>
                <td><input class="inFHF" form="frmLesFraisFHF" type="date" name="txtDate_N<?= $unFHF['NUM'] ?>" id="txtDate<?= $unFHF['NUM'] ?>" value="<?= $unFHF['DATE'] ?>" /></td>
                <td><textarea class="inFHF" form="frmLesFraisFHF" name="txtLibelle_N<?= $unFHF['NUM'] ?>" id="txtLibelle<?= $unFHF['NUM'] ?>" readonly><?= $unFHF['LIB'] ?></textarea></td>
                <td><input class="inFHF" form="frmLesFraisFHF" size="7" type="text" name="txtMontant_N<?= $unFHF['NUM'] ?>" id="txtMontant<?= $unFHF['NUM'] ?>" value="<?= $unFHF['MONTANT'] ?>"/></td>
                <td><input class="toHide" form="frmLesFraisFHF" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="O" checked/></td>
                <td><input class="toHide" form="frmLesFraisFHF" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="R" /></td>
                <td><input class="toHide" form="frmLesFraisFHF" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="S" /></td>
            </tr>
        <?php } ?>
    </table>
    <p>
        Nombre de justificatifs :<input type="text" size="5" id="txtNbJustificatifs" name="txtNbJustificatifs" value="<?= $nbJustificatifs ?>"/>
    </p>
    <p>
        <input type="submit" class="toHide" id="btnEnregistrerFHF" form="frmLesFraisFHF" name="btnEnregistrerFHF" value="Enregistrer les modifs des frais hors forfait" />
        <input type="reset" class="toHide" id="btnReinitialiserFHF" form="frmLesFraisFHF" name="btnReinitialiserFHF" value="Réinitialiser" />
    </p>
<?php } else {
    ?>
    <p>Pas de frais hors forfait pour cette fiche.</p>
<?php } ?>
