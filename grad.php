<?php

class grad {

    function unos_grad($naziv_grad, $ptt_grad) {
        $upit = "INSERT INTO grad (naziv_grad, ptt_grad) VALUES ('$naziv_grad','$ptt_grad')";
        mysql_query($upit);
    }

    function izmena_grad($sifra_grad, $naziv_grad, $ptt_grad) {
        $upit = "UPDATE grad SET naziv_grad='$naziv_grad', ptt_grad='$ptt_grad' WHERE sifra_grad='$sifra_grad'";
        mysql_query($upit);
    }

    function brisanje_grad($sifra_grad) {
        $upit = "DELETE FROM grad WHERE sifra_grad='$sifra_grad'";
        mysql_query($upit);
    }

    function ucitavanje_grad($sifra_grad) {
        $upit = "SELECT * FROM grad WHERE sifra_grad='$sifra_grad'";
        $rez = mysql_query($upit);
        $grad = mysql_fetch_array($rez);
        return $grad;
    }

    function ucitavanje_liste_grad() {
        $upit = "SELECT * FROM grad";
        $rez = mysql_query($upit);
        $lista_grad = array();
        while ($grad = mysql_fetch_array($rez)) {
            array_push($lista_grad, $grad);
        }
        return $lista_grad;
    }

}
