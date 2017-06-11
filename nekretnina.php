<?php

class nekretnina {

    function unos_nekretnina($oglas, $broj_kvadrata, $cena, $sifra_grad, $ulica, $sifra_namena_nekretnine, $sifra_tip_nekretnine, $sifra_korisnik) {
        $upit = "INSERT INTO nekretnina (oglas, broj_kvadrata, cena, sifra_grad, ulica, sifra_namena_nekretnine, sifra_tip_nekretnine, sifra_korisnik) VALUES ('$oglas','$broj_kvadrata','$cena','$sifra_grad', '$ulica','$sifra_namena_nekretnine','$sifra_tip_nekretnine', '$sifra_korisnik')";
        mysql_query($upit);
    }

    function izmena_nekretnina($sifra_nekretnina, $oglas, $broj_kvadrata, $cena, $sifra_grad, $ulica, $sifra_namena_nekretnine, $sifra_tip_nekretnine) {
        $upit = "UPDATE nekretnina SET oglas='$oglas', broj_kvadrata='$broj_kvadrata', cena='$cena', sifra_grad='$sifra_grad', ulica='$ulica', sifra_namena_nekretnine='$sifra_namena_nekretnine', sifra_tip_nekretnine='$sifra_tip_nekretnine' WHERE sifra_nekretnina='$sifra_nekretnina'";
        mysql_query($upit);
    }

    function brisanje_nekretnina($sifra_nekretnina) {
        $upit = "DELETE FROM nekretnina WHERE sifra_nekretnina='$sifra_nekretnina'";
        mysql_query($upit);
    }

    function ucitavanje_nekretnina($sifra_nekretnina) {
        $upit = "SELECT * FROM (((nekretnina INNER JOIN grad ON (nekretnina.sifra_grad = grad.sifra_grad)) INNER JOIN namena_nekretnine ON (nekretnina.sifra_namena_nekretnine = namena_nekretnine.sifra_namena_nekretnine)) INNER JOIN tip_nekretnine ON (nekretnina.sifra_tip_nekretnine = tip_nekretnine.sifra_tip_nekretnine)) WHERE sifra_nekretnina='$sifra_nekretnina'";
        $rez = mysql_query($upit);
        $nekretnina = mysql_fetch_array($rez);
        return $nekretnina;
    }

    function ucitavanje_liste_nekretnina($where, $order) {
        $upit = "SELECT * FROM (((nekretnina INNER JOIN grad ON (nekretnina.sifra_grad = grad.sifra_grad)) INNER JOIN namena_nekretnine ON (nekretnina.sifra_namena_nekretnine = namena_nekretnine.sifra_namena_nekretnine)) INNER JOIN tip_nekretnine ON (nekretnina.sifra_tip_nekretnine = tip_nekretnine.sifra_tip_nekretnine)) " . $where . ' ' . $order;
        $rez = mysql_query($upit);
        $lista_nekretnina = array();
        while ($nekretnina = mysql_fetch_array($rez)) {
            array_push($lista_nekretnina, $nekretnina);
        }
        return $lista_nekretnina;
    }

}
