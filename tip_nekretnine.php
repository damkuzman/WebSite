<?php

class tip_nekretnine {

    function unos_tip_nekretnine($naziv_tip_nekretnine) {
        $upit = "INSERT INTO tip_nekretnine (naziv_tip_nekretnine) VALUES ('$naziv_tip_nekretnine')";
        mysql_query($upit);
    }

    function izmena_tip_nekretnine($sifra_tip_nekretnine, $naziv_tip_nekretnine) {
        $upit = "UPDATE tip_nekretnine SET naziv_tip_nekretnine='$naziv_tip_nekretnine' WHERE sifra_tip_nekretnine='$sifra_tip_nekretnine'";
        mysql_query($upit);
    }

    function brisanje_tip_nekretnine($sifra_tip_nekretnine) {
        $upit = "DELETE FROM tip_nekretnine WHERE sifra_tip_nekretnine='$sifra_tip_nekretnine'";
        mysql_query($upit);
    }

    function ucitavanje_tip_nekretnine($sifra_tip_nekretnine) {
        $upit = "SELECT * FROM tip_nekretnine WHERE sifra_tip_nekretnine='$sifra_tip_nekretnine'";
        $rez = mysql_query($upit);
        $tip_nekretnine = mysql_fetch_array($rez);
        return $tip_nekretnine;
    }

    function ucitavanje_liste_tip_nekretnine() {
        $upit = "SELECT * FROM tip_nekretnine";
        $rez = mysql_query($upit);
        $lista_tip_nekretnine = array();
        while ($tip_nekretnine = mysql_fetch_array($rez)) {
            array_push($lista_tip_nekretnine, $tip_nekretnine);
        }
        return $lista_tip_nekretnine;
    }

}
