<h2>Frais hors forfait</h2>
<?php
if ($lesFHF) {
    foreach ($lesFHF as &$unFHF) {
        ?>
        <form name="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" id="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" method="post" action="index.php"
              onsubmit="return confirm('Voulez-vous réellement enregistrer les modifications apportées au frais hors forfait numéro <?= $unFHF['NUM'] ?> ?');">
        </form>
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="uc" value="validerFicheFrais" />
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="action" value="enregModifFHF" />
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="numFHF" value="<?= $unFHF['NUM'] ?>" />
    <?php } ?>
    <table>
        <tr>
            <th>Libelle</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Ok</th>
            <th>Reporter</th>
            <th>Supprimer</th>

            <th></th>
        </tr>
        <?php foreach ($lesFHF as &$unFHF) { ?>
            <tr>
                <td><textarea class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="txtLibelle" id="txtLibelle<?= $unFHF['NUM'] ?>" readonly><?= $unFHF['LIB'] ?></textarea></td>
                <td><input class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="date" name="txtDate" id="txtDate<?= $unFHF['NUM'] ?>" value="<?= $unFHF['DATE'] ?>" /></td>
                <td><input class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" size="7" type="text" name="txtMontant" id="txtMontant<?= $unFHF['NUM'] ?>" value="<?= $unFHF['MONTANT'] ?>"/></td>
                <td><input class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="O" checked/></td>
                <td><input class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="R" /></td>
                <td><input class="inFHF" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="radio" name="Choix<?= $unFHF['NUM'] ?>" value="S" /></td>
                <td>
                    <input class="toHide" type="submit" id="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" value="Enregistrer" />&nbsp;
                    <input type="reset" id="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" value="Réinitialiser" />
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else {
    ?>
    <p>Pas de frais hors forfait pour cette fiche.</p>
<?php } ?>
