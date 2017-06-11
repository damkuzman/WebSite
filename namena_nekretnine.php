<?php

class namena_nekretnine {

    function unos_namena_nekretnine($naziv_namena_nekretnine) {
        $upit = "INSERT INTO namena_nekretnine (naziv_namena_nekretnine) VALUES ('$naziv_namena_nekretnine')";
        mysql_query($upit);
    }

    function izmena_namena_nekretnine($sifra_namena_nekretnine, $naziv_namena_nekretnine) {
        $upit = "UPDATE namena_nekretnine SET naziv_namena_nekretnine='$naziv_namena_nekretnine' WHERE sifra_namena_nekretnine='$sifra_namena_nekretnine'";
        mysql_query($upit);
    }

    function brisanje_namena_nekretnine($sifra_namena_nekretnine) {
        $upit = "DELETE FROM namena_nekretnine WHERE sifra_namena_nekretnine='$sifra_namena_nekretnine'";
        mysql_query($upit);
    }

    function ucitavanje_namena_nekretnine($sifra_namena_nekretnine) {
        $upit = "SELECT * FROM namena_nekretnine WHERE sifra_namena_nekretnine='$sifra_namena_nekretnine'";
        $rez = mysql_query($upit);
        $namena_nekretnine = mysql_fetch_array($rez);
        return $namena_nekretnine;
    }

    function ucitavanje_liste_namena_nekretnine() {
        $upit = "SELECT * FROM namena_nekretnine";
        $rez = mysql_query($upit);
        $lista_namena_nekretnine = array();
        while ($namena_nekretnine = mysql_fetch_array($rez)) {
            array_push($lista_namena_nekretnine, $namena_nekretnine);
        }
        return $lista_namena_nekretnine;
    }

}
