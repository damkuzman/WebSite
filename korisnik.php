<?php

class korisnik {

    function registracija($username, $password, $ime, $prezime, $sifra_grad, $ulica) {
        $upit = "INSERT INTO korisnik (username, password, ime, prezime, sifra_grad, ulica) VALUES ('$username','$password', '$ime', '$prezime', '$sifra_grad', '$ulica')";
        mysql_query($upit);
    }

    function prijava($username, $password) {
        $upit = "SELECT * FROM korisnik WHERE username='$username' AND password='$password'";
        $rez = mysql_query($upit);
        $korisnik = mysql_fetch_array($rez);
        return $korisnik;
    }

}
