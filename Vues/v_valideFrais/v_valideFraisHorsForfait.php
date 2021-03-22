<h2>Frais au forfait</h2>
<?php
if ($lesFHF) {
    foreach ($lesFHF as &$unFHF) {
        ?>
        <form name="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" id="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" method="post" action="index.php"
              onsubmit="return confirm('Voulez-vous réellement enregistrer les modifications apportées au frais hors forfait numéro <?= $unFHF['NUM'] ?> ?');">
        </form>
    <?php } ?>
    <table>
        <tr>
            <th>Numéro</th>
            <th>Libelle</th>
            <th>Date</th>
            <th>Montant</th>
            <th></th>
        </tr>
    <?php foreach ($lesFHF as &$unFHF) { ?>
            <tr>
            <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="uc" value="validerFicheFrais" />
            <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>"type="hidden" name="action" value="enregModifFHF" />
            <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="numFHF" value="<?= $unFHF['NUM'] ?>" />
            <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="text" size="3" name="txtNum<?= $unFHF['NUM'] ?>" id="txtNum<?= $unFHF['NUM'] ?>" value="<?= $etp | 0 ?>" readonly/></td>
            <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="text" size="3" name="txtLibelle<?= $unFHF['NUM'] ?>" id="txtLibelle<?= $unFHF['NUM'] ?>" value="<?= $km | 0 ?>"/></td>
            <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="date" name="txtDate<?= $unFHF['NUM'] ?>" id="txtDate<?= $unFHF['NUM'] ?>" value="<?= $nui | 0 ?>" /></td>
            <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="text" size="5" name="txtMontant<?= $unFHF['NUM'] ?>" id="txtMontant<?= $unFHF['NUM'] ?>" value="<?= $rep | 0 ?>"/></td>
            <td>
                <input type="submit" id="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" value="Enregistrer" />&nbsp;
                <input type="reset" id="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" value="Réinitialiser" />
            </td>
        </tr>
    <?php } ?>
    </table>
<?php
} else { ?>
<p>Pas de frais hors forfait pour cette fiche.</p>
<?php } ?>
