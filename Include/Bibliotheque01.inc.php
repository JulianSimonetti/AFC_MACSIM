<?php

require_once 'SourceDonnees.inc.php';

function formSelectDepuisRecordset($ld_label, $ld_nom, $ld_id, $recordset, $valeuropt, $tabindex) {
    $code = '<label for="' . $ld_id . '">' . $ld_label . '</label>' . "\n"
            . '    <select name="' . $ld_nom . '" id="' . $ld_id . '" class="titre" tabindex="' . $tabindex . '">' . "\n";

    $recordset->setFetchMode(PDO::FETCH_NUM);
    $ligne = $recordset->fetch();
//    if ($valeuropt != null) {
//        while ($ligne != false) {
//            $code .= '        <option ';
//            if ($ligne[0] == $valeuropt) {
//                $code .= 'selected="selected" ';
//            }
//            $code .= 'value="' . $ligne[0] . '">' . $ligne[1] . '</option>' . "\n";
//            $ligne = $recordset->fetch();
//        }
//    }
//    else
//    {
//        while ($ligne != false) {
//            $code .= '        <option value="' . $ligne[0] . '">' . $ligne[1] . '</option>' . "\n";
//            $ligne = $recordset->fetch();
//        }
//    }
    while ($ligne != false) {
        $code .= '        <option ';
        if ($ligne[0] == $valeuropt) {
            $code .= 'selected="selected" ';
        }
        $code .= 'value="' . $ligne[0] . '">' . $ligne[1] . '</option>' . "\n";
        $ligne = $recordset->fetch();
    }
    $code .= '</select>';
    return $code;
}

function formInputText($label, $name, $id, $value, $size, $maxlength, $tabindex, $required = false, $readonly = false) {
    $code = '<label class="titre" for="' . $id . '">' . $label . ' :</label><input type="text" name="' . $name . '" id="' . $id . '" size="' . $size . '" maxlength="' . $maxlength . '" tabindex="' . $tabindex . '"';
    if ($readonly) {
        $code .= ' readonly="readonly"';
    }
    if ($required) {
        $code .= ' required="required"';
    }
    $code .= ' class="zone" value="' . $value . '" />';

    return $code;
}

function formInputPassword($label, $name, $id, $value, $size, $maxlength, $tabindex, $required = false) {
    $code = '<label class="titre" for="' . $id . '">' . $label . ' :</label><input type="password" name="' . $name . '" id="' . $id . '" size="' . $size . '" maxlength="' . $maxlength . '" tabindex="' . $tabindex . '"';
    if ($required) {
        $code .= ' required="required"';
    }
    $code .= ' class="zone" value="' . $value . '" />';

    return $code;
}

function formInputHidden($name, $id, $value) {
    return '<input type="hidden" name="' . $name . '" id="' . $id . '" value="' . $value . '" />';
}

function formBoutonSubmit($name, $id, $value, $tabindex) {
    return '<input type="submit" name="' . $name . '" id="' . $id . '" value="' . $value . '" tabindex="' . $tabindex . '" />';
}

function formTextArea($label, $name, $id, $value, $cols, $rows, $maxlength, $tabindex, $readonly = false) {
    return '<label for="' . $id . '">' . $label . ' :</label><br />' . "\n"
            . '<textarea id="' . $id . '" name="' . $name . '" cols="' . $cols . '" rows="' . $rows . '" '
            . 'maxlength="' . $maxlength . '" tabindex="' . $tabindex . '" ' . ($readonly ? 'readonly="readonly"' : '') . '>'
            . $value . '</textarea>';
}

function getInfosPraticien($pratnum) {
    $cx = SGBDConnect();
    $requete = 'SELECT PRA_NOM, PRA_PRENOM, PRA_CP, PRA_ADRESSE, PRA_VILLE, PRA_COEF, TYP_LIBELLE '
            . 'FROM PRATICIEN INNER JOIN TYPE_PRATICIEN ON PRA_TYPE = TYP_CODE '
            . 'WHERE PRA_NUM = ' . $pratnum;
    $infos = $cx->query($requete)->fetch(PDO::FETCH_ASSOC);
    return formInputText("NOM", "PRA_NOM", "PRA_NOM", $infos['PRA_NOM'], 50, 50, 20, false, true) . "<br />\n"
            . formInputText("PRENOM", "PRA_PRENOM", "PRA_PRENOM", $infos['PRA_PRENOM'], 50, 50, 30, false, true) . "<br />\n"
            . formInputText("ADRESSE", "PRA_ADRESSE", "PRA_ADRESSE", $infos['PRA_ADRESSE'], 50, 50, 40, false, true) . "<br />\n"
            . formInputText("VILLE", "PRA_VILLE", "PRA_VILLE", $infos['PRA_CP'] . ' ' . $infos['PRA_VILLE'], 50, 50, 50, false, true) . "<br />\n"
            . formInputText("COEFF NOTORIÉTÉ", "PRA_COEF", "PRA_COEF", $infos['PRA_COEF'], 50, 50, 60, false, true) . "<br />\n"
            . formInputText("TYPE", "PRA_TYPE", "PRA_TYPE", $infos['TYP_LIBELLE'], 50, 50, 70, false, true) . "<br />\n";
}

