
<h2>Frais au forfait</h2>
<form name="frmFraisForfait" id="frmFraisForfait" method="post" action="index.php"
      onsubmit="return confirm('Voulez-vous réellement enregistrer les modifications apportées aux frais forfaitisés ?');">
    <input type="hidden" name="uc" value="validerFicheFrais">
    <input type="hidden" name="action" value="enregModifFF">
    <table>
        <tr>
            <th>Forfait<br />étape</th>
            <th>Frais<br />kilométriques</th>
            <th>Nuitée<br />hôtel</th>
            <th>Repas<br />restaurant</th>
            <th></th>
        </tr>
        <tr>
            <td><input class="inFF" type="text" size="3" name="txtEtape" id="txtEtape" tabindex="30" value="<?=$etp | 0?>"/></td>
            <td><input class="inFF" type="text" size="3" name="txtKm" id="txtKm" tabindex="35" value="<?=$km | 0?>"/></td>
            <td><input class="inFF" type="text" size="3" name="txtNuitee" id="txtNuitee" tabindex="40" value="<?=$nui | 0?>" /></td>
            <td><input class="inFF" type="text" size="3" name="txtRepas" id="txtRepas" tabindex="45" value="<?=$rep | 0?>"/></td>
            <td>
                <input class="toHide" type="submit" id="btnEnregistrerFF" name="btnEnregistrerFF" value="Enregistrer" tabindex="60" />&nbsp;
                <input type="reset" id="btnReinitialiserFF" name="btnReinitialiserFF" value="Réinitialiser" tabindex="70" />
            </td>
        </tr>
    </table>
</form>