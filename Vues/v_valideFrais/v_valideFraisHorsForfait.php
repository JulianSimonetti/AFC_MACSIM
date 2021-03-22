<h2>Frais au forfait</h2>
<?php
if ($lesFHF) {
    foreach ($lesFHF as &$unFHF) {
        ?>
        <form name="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" id="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" method="post" action="index.php"
              onsubmit="return confirm('Voulez-vous réellement enregistrer les modifications apportées au frais hors forfait numéro <?= $unFHF['NUM'] ?> ?');">
        </form>
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="uc" value="validerFicheFrais" />
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>"type="hidden" name="action" value="enregModifFHF" />
        <input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="hidden" name="numFHF" value="<?= $unFHF['NUM'] ?>" />
    <?php } ?>
    <table>
        <tr>
            <th>Libelle</th>
            <th>Date</th>
            <th>Montant</th>
            <th>Action</th>
            <th></th>
        </tr>
        <?php foreach ($lesFHF as &$unFHF) { ?>
            <tr>
                <td><textarea form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="txtLibelle<?= $unFHF['NUM'] ?>" id="txtLibelle<?= $unFHF['NUM'] ?>"><?= $unFHF['LIB'] ?></textarea></td>
                <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" type="date" name="txtDate<?= $unFHF['NUM'] ?>" id="txtDate<?= $unFHF['NUM'] ?>" value="<?= $unFHF['DATE'] ?>" /></td>
                <td><input form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" size="7" type="text" name="txtMontant<?= $unFHF['NUM'] ?>" id="txtMontant<?= $unFHF['NUM'] ?>" value="<?= $unFHF['MONTANT'] ?>"/></td>
                <td><select form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="txtMontant<?= $unFHF['NUM'] ?>" id="txtMontant<?= $unFHF['NUM'] ?>">
                        <option value="O" <?= ($unFHF['ACTION'] == "O" ? "selected" : "") ?>>O</option>
                        <option value="R" <?= ($unFHF['ACTION'] == "R" ? "selected" : "") ?>>R</option>
                        <option value="S" <?= ($unFHF['ACTION'] == "S" ? "selected" : "") ?>>S</option>
                    </select></td>
                <td>
                    <input type="submit" id="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnEnregistrerFHF<?= $unFHF['NUM'] ?>" value="Enregistrer" />&nbsp;
                    <input type="reset" id="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" form="frmFraisHorsForfait<?= $unFHF['NUM'] ?>" name="btnReinitialiserFHF<?= $unFHF['NUM'] ?>" value="Réinitialiser" />
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php } else {
    ?>
    <p>Pas de frais hors forfait pour cette fiche.</p>
<?php } ?>
