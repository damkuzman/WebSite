<?php

session_start();

define('SERVER', '127.0.0.1');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'nekretnine');

$konekcija = mysql_connect(SERVER, USER, PASSWORD);
mysql_select_db(DATABASE, $konekcija);

include 'grad.php';
include 'namena_nekretnine.php';
include 'tip_nekretnine.php';
include 'nekretnina.php';
include 'korisnik.php';

switch ($_REQUEST['operacija']) {

    case 'otvori_registracija':otvori_registracija();
        break;
    case 'registracija': registracija();
        break;
    case 'otvori_prijava':otvori_prijava();
        break;
    case 'prijava': prijava();
        break;
    case 'odjava' : odjava();
        break;

    case 'ucitavanje_liste_grad' :ucitavanje_liste_grad();
        break;
    case 'ucitavanje_grad': ucitavanje_grad();
        break;
    case 'kreiraj_grad': kreiraj_grad();
        break;
    case 'unos_grad' : unos_grad();
        break;
    case 'izmena_grad': izmena_grad();
        break;
    case 'brisanje_grad' : brisanje_grad();
        break;

    case 'ucitavanje_liste_namena_nekretnine' :ucitavanje_liste_namena_nekretnine();
        break;
    case 'ucitavanje_namena_nekretnine': ucitavanje_namena_nekretnine();
        break;
    case 'kreiraj_namena_nekretnine': kreiraj_namena_nekretnine();
        break;
    case 'unos_namena_nekretnine' : unos_namena_nekretnine();
        break;
    case 'izmena_namena_nekretnine': izmena_namena_nekretnine();
        break;
    case 'brisanje_namena_nekretnine' : brisanje_namena_nekretnine();
        break;

    case 'ucitavanje_liste_tip_nekretnine' :ucitavanje_liste_tip_nekretnine();
        break;
    case 'ucitavanje_tip_nekretnine': ucitavanje_tip_nekretnine();
        break;
    case 'kreiraj_tip_nekretnine': kreiraj_tip_nekretnine();
        break;
    case 'unos_tip_nekretnine' : unos_tip_nekretnine();
        break;
    case 'izmena_tip_nekretnine': izmena_tip_nekretnine();
        break;
    case 'brisanje_tip_nekretnine' : brisanje_tip_nekretnine();
        break;

    case 'ucitavanje_liste_nekretnina' :ucitavanje_liste_nekretnina();
        break;
    case 'otvori_nekretnina': otvori_nekretnina();
        break;
    case 'ucitavanje_nekretnina': ucitavanje_nekretnina();
        break;
    case 'kreiraj_nekretnina': kreiraj_nekretnina();
        break;
    case 'unos_nekretnina' : unos_nekretnina();
        break;
    case 'izmena_nekretnina': izmena_nekretnina();
        break;
    case 'brisanje_nekretnina' : brisanje_nekretnina();
        break;

    case 'grafikon': grafikon();
        break;
}

function otvori_registracija() {

    $grad = new grad();
    $lista_grad = $grad->ucitavanje_liste_grad();
    $select_grad = "<select name='sifra_grad'><option value='0'>--</option>";
    foreach ($lista_grad as $grad) {
        $select_grad.= "<option value='$grad[sifra_grad]'>$grad[naziv_grad]</option>";
    }
    $select_grad.="</select>";

    echo
    "<form action='server.php?operacija=registracija' method='post'>
        <table>
            <tr>
                <td>Username</td>
                <td><input name='username'/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type='password' name='password'/></td>
            </tr>
            <tr>
                <td>Ime</td>
                <td><input name='ime'/></td>
            </tr>
            <tr>
                <td>Prezime</td>
                <td><input name='prezime'/></td>
            </tr>
            <tr>
                <td>Grad</td>
                <td>$select_grad</td>
            </tr>
            <tr>
                <td>Ulica</td>
                <td><input name='ulica'/></td>
            </tr>
            <tr>
                <td></td>
                <td><button type='submit'>Registracija</button></td>
            </tr>
        </table>
    </form>";
}

function registracija() {
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $ime = mysql_real_escape_string($_POST['ime']);
    $prezime = mysql_real_escape_string($_POST['prezime']);
    $sifra_grad = mysql_real_escape_string($_POST['sifra_grad']);
    $ulica = mysql_real_escape_string($_POST['ulica']);
    $korisnik = new korisnik();
    $korisnik = $korisnik->registracija($username, $password, $ime, $prezime, $sifra_grad, $ulica);
    header('Location: http://localhost/seminarski/index.php');
}

function otvori_prijava() {
    echo
    "<form action='server.php?operacija=prijava' method='post'>
        <table>
            <tr>
                <td>Username</td>
                <td><input name='username'/></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type='password' name='password'/></td>
            </tr>
            <tr>
                <td></td>
                <td><button type='submit'>Prijava</button></td>
            </tr>
        </table>
    </form>";
}

function prijava() {
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $korisnik = new korisnik();
    $korisnik = $korisnik->prijava($username, $password);
    if (isset($korisnik['username'])) {
        $_SESSION['sifra_korisnik'] = $korisnik['sifra_korisnik'];
        $_SESSION['username'] = $korisnik['username'];
        $_SESSION['tip_korisnik'] = $korisnik['tip_korisnik'];
    }
    header('Location: http://localhost/seminarski/index.php');
}

function odjava() {
    session_destroy();
    header('Location: http://localhost/seminarski/index.php');
}

function ucitavanje_liste_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $tip_nekretnine = new tip_nekretnine();
    $lista_tip_nekretnine = $tip_nekretnine->ucitavanje_liste_tip_nekretnine();

    echo
    "<table><tr><td><button onclick='kreiraj_tip_nekretnine()'>Kreiraj</button></td></tr></table>
        <table>
            <tr>
                <th>ID</th>
                <th>Naziv</th>                           
                <th></th>
                <th></th>
            </tr>";
    foreach ($lista_tip_nekretnine as $tip_nekretnine) {
        echo
        "<tr>
            <td>$tip_nekretnine[sifra_tip_nekretnine]</td>
            <td>$tip_nekretnine[naziv_tip_nekretnine]</td>
            <td><button onclick=\"ucitavanje_tip_nekretnine($tip_nekretnine[sifra_tip_nekretnine])\">Ucitaj</button></td>
            <td><button onclick=\"brisanje_tip_nekretnine($tip_nekretnine[sifra_tip_nekretnine])\">Obrisi</button></td>
        </tr>";
    }
    echo "</table>";
}

function ucitavanje_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_tip_nekretnine = mysql_real_escape_string($_GET['sifra_tip_nekretnine']);

    $tip_nekretnine = new tip_nekretnine();
    $tip_nekretnine = $tip_nekretnine->ucitavanje_tip_nekretnine($sifra_tip_nekretnine);

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_tip_nekretnine()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_tip_nekretnine' value='$tip_nekretnine[naziv_tip_nekretnine]'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"izmena_tip_nekretnine($tip_nekretnine[sifra_tip_nekretnine], document.getElementById('naziv_tip_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function kreiraj_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    echo
    "<table><tr><td><button onclick='ucitavanje_liste_tip_nekretnine()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_tip_nekretnine'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"unos_tip_nekretnine(document.getElementById('naziv_tip_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function unos_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $naziv_tip_nekretnine = mysql_real_escape_string($_POST['naziv_tip_nekretnine']);
    $tip_nekretnine = new tip_nekretnine();
    $tip_nekretnine->unos_tip_nekretnine($naziv_tip_nekretnine);
    ucitavanje_liste_tip_nekretnine();
}

function izmena_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_tip_nekretnine = mysql_real_escape_string($_POST['sifra_tip_nekretnine']);
    $naziv_tip_nekretnine = mysql_real_escape_string($_POST['naziv_tip_nekretnine']);
    $tip_nekretnine = new tip_nekretnine();
    $tip_nekretnine->izmena_tip_nekretnine($sifra_tip_nekretnine, $naziv_tip_nekretnine);
    ucitavanje_liste_tip_nekretnine();
}

function brisanje_tip_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_tip_nekretnine = mysql_real_escape_string($_POST['sifra_tip_nekretnine']);
    $tip_nekretnine = new tip_nekretnine();
    $tip_nekretnine->brisanje_tip_nekretnine($sifra_tip_nekretnine);
    ucitavanje_liste_tip_nekretnine();
}

function ucitavanje_liste_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $namena_nekretnine = new namena_nekretnine();
    $lista_namena_nekretnine = $namena_nekretnine->ucitavanje_liste_namena_nekretnine();

    echo
    "<table><tr><td><button onclick='kreiraj_namena_nekretnine()'>Kreiraj</button></td></tr></table>
        <table>
            <tr>
                <th>ID</th>
                <th>Naziv</th>                           
                <th></th>
                <th></th>
            </tr>";
    foreach ($lista_namena_nekretnine as $namena_nekretnine) {
        echo
        "<tr>
            <td>$namena_nekretnine[sifra_namena_nekretnine]</td>
            <td>$namena_nekretnine[naziv_namena_nekretnine]</td>
            <td><button onclick=\"ucitavanje_namena_nekretnine($namena_nekretnine[sifra_namena_nekretnine])\">Ucitaj</button></td>
            <td><button onclick=\"brisanje_namena_nekretnine($namena_nekretnine[sifra_namena_nekretnine])\">Obrisi</button></td>
        </tr>";
    }
    echo "</table>";
}

function ucitavanje_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_namena_nekretnine = mysql_real_escape_string($_GET['sifra_namena_nekretnine']);

    $namena_nekretnine = new namena_nekretnine();
    $namena_nekretnine = $namena_nekretnine->ucitavanje_namena_nekretnine($sifra_namena_nekretnine);

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_namena_nekretnine()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_namena_nekretnine' value='$namena_nekretnine[naziv_namena_nekretnine]'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"izmena_namena_nekretnine($namena_nekretnine[sifra_namena_nekretnine], document.getElementById('naziv_namena_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function kreiraj_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    echo
    "<table><tr><td><button onclick='ucitavanje_liste_namena_nekretnine()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_namena_nekretnine'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"unos_namena_nekretnine(document.getElementById('naziv_namena_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function unos_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $naziv_namena_nekretnine = mysql_real_escape_string($_POST['naziv_namena_nekretnine']);
    $namena_nekretnine = new namena_nekretnine();
    $namena_nekretnine->unos_namena_nekretnine($naziv_namena_nekretnine);
    ucitavanje_liste_namena_nekretnine();
}

function izmena_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_namena_nekretnine = mysql_real_escape_string($_POST['sifra_namena_nekretnine']);
    $naziv_namena_nekretnine = mysql_real_escape_string($_POST['naziv_namena_nekretnine']);
    $namena_nekretnine = new namena_nekretnine();
    $namena_nekretnine->izmena_namena_nekretnine($sifra_namena_nekretnine, $naziv_namena_nekretnine);
    ucitavanje_liste_namena_nekretnine();
}

function brisanje_namena_nekretnine() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_namena_nekretnine = mysql_real_escape_string($_POST['sifra_namena_nekretnine']);
    $namena_nekretnine = new namena_nekretnine();
    $namena_nekretnine->brisanje_namena_nekretnine($sifra_namena_nekretnine);
    ucitavanje_liste_namena_nekretnine();
}

function ucitavanje_liste_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $grad = new grad();
    $lista_grad = $grad->ucitavanje_liste_grad();

    echo
    "<table><tr><td><button onclick='kreiraj_grad()'>Kreiraj</button></td></tr></table>
        <table>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>PTT</th>  
                <th></th>
                <th></th>
            </tr>";
    foreach ($lista_grad as $grad) {
        echo
        "<tr>
            <td>$grad[sifra_grad]</td>
            <td>$grad[naziv_grad]</td>
            <td>$grad[ptt_grad]</td>
            <td><button onclick=\"ucitavanje_grad($grad[sifra_grad])\">Ucitaj</button></td>
            <td><button onclick=\"brisanje_grad($grad[sifra_grad])\">Obrisi</button></td>
        </tr>";
    }
    echo "</table>";
}

function ucitavanje_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_grad = mysql_real_escape_string($_GET['sifra_grad']);

    $grad = new grad();
    $grad = $grad->ucitavanje_grad($sifra_grad);

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_grad()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_grad' value='$grad[naziv_grad]'/></td>
        </tr>
        <tr>
            <td>PTT</td>
            <td><input id='ptt_grad' value='$grad[ptt_grad]'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"izmena_grad($grad[sifra_grad], document.getElementById('naziv_grad').value, document.getElementById('ptt_grad').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function kreiraj_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    echo
    "<table><tr><td><button onclick='ucitavanje_liste_grad()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Naziv</td>
            <td><input id='naziv_grad'/></td>
        </tr>
        <tr>
            <td>PTT</td>
            <td><input id='ptt_grad'/></td>
        </tr>
        <tr>
            <td></td>
            <td><button onclick=\"unos_grad(document.getElementById('naziv_grad').value, document.getElementById('ptt_grad').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function unos_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $naziv_grad = mysql_real_escape_string($_POST['naziv_grad']);
    $ptt_grad = mysql_real_escape_string($_POST['ptt_grad']);
    $grad = new grad();
    $grad->unos_grad($naziv_grad, $ptt_grad);
    ucitavanje_liste_grad();
}

function izmena_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_grad = mysql_real_escape_string($_POST['sifra_grad']);
    $naziv_grad = mysql_real_escape_string($_POST['naziv_grad']);
    $ptt_grad = mysql_real_escape_string($_POST['ptt_grad']);
    $grad = new grad();

    $grad->izmena_grad($sifra_grad, $naziv_grad, $ptt_grad);
    ucitavanje_liste_grad();
}

function brisanje_grad() {
    if ($_SESSION['tip_korisnik'] != 'administrator') {
        echo 'Nemate prava pristupa';
        return;
    }
    $sifra_grad = mysql_real_escape_string($_POST['sifra_grad']);
    $grad = new grad();
    $grad->brisanje_grad($sifra_grad);
    ucitavanje_liste_grad();
}

function ucitavanje_liste_nekretnina() {

    $where = array();
    if (isset($_GET['oglas'])) {
        $oglas = mysql_real_escape_string($_GET['oglas']);
        $where[] = "nekretnina.oglas LIKE '%$oglas%'";
    }
    if (isset($_GET['broj_kvadrata_od'])) {
        $broj_kvadrata_od = mysql_real_escape_string($_GET['broj_kvadrata_od']);
        if (intval($broj_kvadrata_od)) {
            $where[] = "nekretnina.broj_kvadrata >= $broj_kvadrata_od";
        }
    }
    if (isset($_GET['broj_kvadrata_do'])) {
        $broj_kvadrata_do = mysql_real_escape_string($_GET['broj_kvadrata_do']);
        if (intval($broj_kvadrata_do)) {
            $where[] = "nekretnina.broj_kvadrata <= $broj_kvadrata_do";
        }
    }
    if (isset($_GET['cena_od'])) {
        $cena_od = mysql_real_escape_string($_GET['cena_od']);
        if (intval($cena_od)) {
            $where[] = "nekretnina.cena >= $cena_od";
        }
    }
    if (isset($_GET['cena_do'])) {
        $cena_do = mysql_real_escape_string($_GET['cena_do']);
        if (intval($cena_do)) {
            $where[] = "nekretnina.cena <= $cena_do";
        }
    }
    if (isset($_GET['sifra_grad'])) {
        $sifra_grad = mysql_real_escape_string($_GET['sifra_grad']);
        if (intval($sifra_grad) != 0) {
            $where[] = "nekretnina.sifra_grad = $sifra_grad";
        }
    }
    if (isset($_GET['sifra_namena_nekretnine'])) {
        $sifra_namena_nekretnine = mysql_real_escape_string($_GET['sifra_namena_nekretnine']);
        if (intval($sifra_namena_nekretnine) != 0) {
            $where[] = "nekretnina.sifra_namena_nekretnine = $sifra_namena_nekretnine";
        }
    }
    if (isset($_GET['sifra_tip_nekretnine'])) {
        $sifra_tip_nekretnine = mysql_real_escape_string($_GET['sifra_tip_nekretnine']);
        if (intval($sifra_tip_nekretnine) != 0) {
            $where[] = "nekretnina.sifra_tip_nekretnine = $sifra_tip_nekretnine";
        }
    }
    if (count($where) != 0) {
        $where = 'WHERE ' . implode(" AND ", $where);
    } else {
        $where = '';
    }

    $order = '';
    if (isset($_GET['order'])) {
        $order = mysql_real_escape_string($_GET['order']);
        switch ($order) {
            case '0': $order = "ORDER BY nekretnina.sifra_nekretnina";
                break;
            case '1': $order = "ORDER BY nekretnina.oglas";
                break;
            case '2': $order = "ORDER BY nekretnina.broj_kvadrata";
                break;
            case '3': $order = "ORDER BY nekretnina.cena";
                break;
        }
    }

    $nekretnina = new nekretnina();
    $lista_nekretnina = $nekretnina->ucitavanje_liste_nekretnina($where, $order);

    $grad = new grad();
    $lista_grad = $grad->ucitavanje_liste_grad();
    $select_grad = "<select id='sifra_grad'><option value='0'>--</option>";
    foreach ($lista_grad as $grad) {
        $select_grad.= "<option value='$grad[sifra_grad]'>$grad[naziv_grad]</option>";
    }
    $select_grad.="</select>";

    $namena_nekretnine = new namena_nekretnine();
    $lista_namena_nekretnine = $namena_nekretnine->ucitavanje_liste_namena_nekretnine();
    $select_namena_nekretnine = "<select id='sifra_namena_nekretnine'><option value='0'>--</option>";
    foreach ($lista_namena_nekretnine as $namena_nekretnine) {
        $select_namena_nekretnine.= "<option value='$namena_nekretnine[sifra_namena_nekretnine]'>$namena_nekretnine[naziv_namena_nekretnine]</option>";
    }
    $select_namena_nekretnine.="</select>";

    $tip_nekretnine = new tip_nekretnine();
    $lista_tip_nekretnine = $tip_nekretnine->ucitavanje_liste_tip_nekretnine();
    $select_tip_nekretnine = "<select id='sifra_tip_nekretnine'><option value='0'>--</option>";
    foreach ($lista_tip_nekretnine as $tip_nekretnine) {
        $select_tip_nekretnine.= "<option value='$tip_nekretnine[sifra_tip_nekretnine]'>$tip_nekretnine[naziv_tip_nekretnine]</option>";
    }
    $select_tip_nekretnine.="</select>";

    if (isset($_SESSION['sifra_korisnik'])) {
        echo "<table>
                <tr>
                    <td><button onclick='kreiraj_nekretnina()'>Kreiraj</button></td>
                </tr>
            </table>";
    }
    echo
    "
    <table>
        <tr>
            <td>oglas</td>
            <td><input id='oglas'/></td>
        </tr>
        <tr>
            <td>Broj kvadrata od</td>
            <td><input id='broj_kvadrata_od'/></td>
        </tr>
        <tr>        
            <td>Broj kvadrata do</td>
            <td><input id='broj_kvadrata_do'/></td>
        </tr>
        <tr>        
            <td>cena od</td>
            <td><input id='cena_od'/></td>
        </tr>
        <tr>        
            <td>cena do</td>
            <td><input id='cena_do'/></td>
        </tr>
        <tr>      
            <td>
                Grad
            </td>
            <td>
                $select_grad
            </td>
        </tr>
        <tr>        
            <td>
                Namena
            </td>
            <td>
                $select_namena_nekretnine
            </td>
        </tr>
        <tr>        
            <td>
                Tip
            </td>
            <td>
                $select_tip_nekretnine
            </td>
        </tr>
        <tr>        
            <td>Sortiraj po</td>
            <td>
                <select id='order'>
                    <option value='0'>ID</option>
                    <option value='1'>Oglas</option>
                    <option value='2'>Broj kvadrata</option>
                    <option value='3'>Cena</option>
                </select>
            </td>
        </tr>
        <tr>               
            <td><button onclick=\"pretraga_lista_nekretnina(document.getElementById('oglas').value, document.getElementById('broj_kvadrata_od').value, document.getElementById('broj_kvadrata_do').value, document.getElementById('cena_od').value, document.getElementById('cena_do').value, document.getElementById('sifra_grad').value, document.getElementById('sifra_namena_nekretnine').value, document.getElementById('sifra_tip_nekretnine').value, document.getElementById('order').value)\">Pretraga</button></td>
            <td><button onclick=\"grafikon(document.getElementById('oglas').value, document.getElementById('broj_kvadrata_od').value, document.getElementById('broj_kvadrata_do').value, document.getElementById('cena_od').value, document.getElementById('cena_do').value, document.getElementById('sifra_grad').value, document.getElementById('sifra_namena_nekretnine').value, document.getElementById('sifra_tip_nekretnine').value, document.getElementById('order').value)\">Grafikon</button></td>           
        </tr>
    </table>
    <table>
        <tr>
            <th>ID</th>
            <th>Oglas</th>
            <th>Broj kvadrata</th>
            <th>Cena</th>
            <th>Grad</th>
            <th>Ulica</th>
            <th>Namena nekretnine</th>
            <th>Tip nekretnine</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>";
    foreach ($lista_nekretnina as $nekretnina) {
        echo
        "<tr>
            <td>$nekretnina[sifra_nekretnina]</td>
            <td>$nekretnina[oglas]</td>
            <td>$nekretnina[broj_kvadrata]</td>
            <td>$nekretnina[cena]</td>
            <td>$nekretnina[naziv_grad]</td>
            <td>$nekretnina[ulica]</td>
            <td>$nekretnina[naziv_namena_nekretnine]</td>
            <td>$nekretnina[naziv_tip_nekretnine]</td>
            <td><button onclick=\"otvori_nekretnina($nekretnina[sifra_nekretnina])\">Otvori</button></td>";
        if (isset($_SESSION['sifra_korisnik'])) {
            if ($_SESSION['sifra_korisnik'] == $nekretnina['sifra_korisnik'] || $_SESSION['tip_korisnik'] == 'administrator') {
                echo "<td><button onclick=\"ucitavanje_nekretnina($nekretnina[sifra_nekretnina])\">Ucitaj</button></td>";
                echo "<td><button onclick=\"brisanje_nekretnina($nekretnina[sifra_nekretnina])\">Obrisi</button></td>";
            }
        } else {
            echo "<td></td><td></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
}

function ucitavanje_nekretnina() {
    if (!isset($_SESSION['sifra_korisnik'])) {
        echo 'Nemate prava pristupa';
        return;
    }

    $sifra_nekretnina = mysql_real_escape_string($_GET['sifra_nekretnina']);

    $nekretnina = new nekretnina();
    $nekretnina = $nekretnina->ucitavanje_nekretnina($sifra_nekretnina);

    if (isset($_SESSION['sifra_korisnik'])) {
        if ($_SESSION['sifra_korisnik'] != $nekretnina['sifra_korisnik'] && $_SESSION['tip_korisnik'] != 'administrator') {
            echo $_SESSION['tip_korisnik'];
            echo 'Nemate prava pristupa';
            return;
        }
    }


    $grad = new grad();
    $lista_grad = $grad->ucitavanje_liste_grad();
    $select_grad = "<select id='sifra_grad'>";
    foreach ($lista_grad as $grad) {
        if ($grad['sifra_grad'] == $nekretnina['sifra_grad']) {
            $select_grad.= "<option selected value='$grad[sifra_grad]'>$grad[naziv_grad]</option>";
        } else {
            $select_grad.= "<option value='$grad[sifra_grad]'>$grad[naziv_grad]</option>";
        }
    }
    $select_grad.="</select>";

    $namena_nekretnine = new namena_nekretnine();
    $lista_namena_nekretnine = $namena_nekretnine->ucitavanje_liste_namena_nekretnine();
    $select_namena_nekretnine = "<select id='sifra_namena_nekretnine'>";
    foreach ($lista_namena_nekretnine as $namena_nekretnine) {
        if ($namena_nekretnine['sifra_namena_nekretnine'] == $nekretnina['sifra_namena_nekretnine']) {
            $select_namena_nekretnine.= "<option selected value='$namena_nekretnine[sifra_namena_nekretnine]'>$namena_nekretnine[naziv_namena_nekretnine]</option>";
        } else {
            $select_namena_nekretnine.= "<option value='$namena_nekretnine[sifra_namena_nekretnine]'>$namena_nekretnine[naziv_namena_nekretnine]</option>";
        }
    }
    $select_namena_nekretnine.="</select>";

    $tip_nekretnine = new tip_nekretnine();
    $lista_tip_nekretnine = $tip_nekretnine->ucitavanje_liste_tip_nekretnine();
    $select_tip_nekretnine = "<select id='sifra_tip_nekretnine'>";
    foreach ($lista_tip_nekretnine as $tip_nekretnine) {
        if ($tip_nekretnine['sifra_tip_nekretnine'] == $nekretnina['sifra_tip_nekretnine']) {
            $select_tip_nekretnine.= "<option selected value='$tip_nekretnine[sifra_tip_nekretnine]'>$tip_nekretnine[naziv_tip_nekretnine]</option>";
        } else {
            $select_tip_nekretnine.= "<option value='$tip_nekretnine[sifra_tip_nekretnine]'>$tip_nekretnine[naziv_tip_nekretnine]</option>";
        }
    }
    $select_tip_nekretnine.="</select>";

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_nekretnina()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Oglas</td>
            <td><input id='oglas' value='$nekretnina[oglas]'/></td>
        </tr>
        <tr>
            <td>Broj kvadrata</td>
            <td><input id='broj_kvadrata' value='$nekretnina[broj_kvadrata]'/></td>
        </tr>
        <tr>
            <td>Cena</td>
            <td><input id='cena' value='$nekretnina[cena]'/></td>
        </tr>
        <tr>
            <td>Grad</td>
            <td>$select_grad</td>
        </tr>
        <tr>
            <td>Ulica</td>
            <td><input id='ulica' value='$nekretnina[ulica]'/></td>
        </tr>
        <tr>
            <td>Namena nekretnine</td>
            <td>$select_namena_nekretnine</td>
        </tr>
        <tr>
            <td>Tip nekretnine</td>
            <td>$select_tip_nekretnine</td>
        </tr>       
        <tr>
            <td></td>
            <td><button onclick=\"izmena_nekretnina($nekretnina[sifra_nekretnina], document.getElementById('oglas').value, document.getElementById('broj_kvadrata').value, document.getElementById('cena').value, document.getElementById('sifra_grad').value, document.getElementById('ulica').value, document.getElementById('sifra_namena_nekretnine').value, document.getElementById('sifra_tip_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function otvori_nekretnina() {
    $sifra_nekretnina = mysql_real_escape_string($_GET['sifra_nekretnina']);

    $nekretnina = new nekretnina();
    $nekretnina = $nekretnina->ucitavanje_nekretnina($sifra_nekretnina);

    try {
        $json = (array) json_decode(@file_get_contents("http://rate-exchange.appspot.com/currency?from=EUR&to=USD&q=$nekretnina[cena]"));
    } catch (Exception $e) {
        
    }
    $cena = '';
    if (isset($json['v'])) {
        $cena = $json['v'];
    }

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_nekretnina()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Oglas</td>
            <td>$nekretnina[oglas]</td>
        </tr>
        <tr>
            <td>Broj kvadrata</td>
            <td>$nekretnina[broj_kvadrata]</td>
        </tr>
        <tr>
            <td>Cena EUR</td>
            <td>$nekretnina[cena]</td>
        </tr>
        <tr>
            <td>Cena USD</td>
            <td>$cena</td>
        </tr>
        <tr>
            <td>Grad</td>
            <td>$nekretnina[naziv_grad]</td>
        </tr>
        <tr>
            <td>Ulica</td>
            <td>$nekretnina[ulica]</td>
        </tr>
        <tr>
            <td>Namena nekretnine</td>
            <td>$nekretnina[naziv_namena_nekretnine]</td>
        </tr>
        <tr>
            <td>Tip nekretnine</td>
            <td>$nekretnina[naziv_tip_nekretnine]</td>
        </tr>
    </table>";
}

function kreiraj_nekretnina() {

    if (!isset($_SESSION['sifra_korisnik'])) {
        echo 'Nemate prava pristupa';
        return;
    }

    $grad = new grad();
    $lista_grad = $grad->ucitavanje_liste_grad();
    $select_grad = "<select id='sifra_grad'>";
    foreach ($lista_grad as $grad) {
        $select_grad.= "<option value='$grad[sifra_grad]'>$grad[naziv_grad]</option>";
    }
    $select_grad.="</select>";

    $namena_nekretnine = new namena_nekretnine();
    $lista_namena_nekretnine = $namena_nekretnine->ucitavanje_liste_namena_nekretnine();
    $select_namena_nekretnine = "<select id='sifra_namena_nekretnine'>";
    foreach ($lista_namena_nekretnine as $namena_nekretnine) {
        $select_namena_nekretnine.= "<option value='$namena_nekretnine[sifra_namena_nekretnine]'>$namena_nekretnine[naziv_namena_nekretnine]</option>";
    }
    $select_namena_nekretnine.="</select>";

    $tip_nekretnine = new tip_nekretnine();
    $lista_tip_nekretnine = $tip_nekretnine->ucitavanje_liste_tip_nekretnine();
    $select_tip_nekretnine = "<select id='sifra_tip_nekretnine'>";
    foreach ($lista_tip_nekretnine as $tip_nekretnine) {
        $select_tip_nekretnine.= "<option value='$tip_nekretnine[sifra_tip_nekretnine]'>$tip_nekretnine[naziv_tip_nekretnine]</option>";
    }
    $select_tip_nekretnine.="</select>";

    echo
    "<table><tr><td><button onclick='ucitavanje_liste_nekretnina()'>Nazad</button></td></tr></table>
    <table>
        <tr>
            <td>Oglas</td>
            <td><input id='oglas'/></td>
        </tr>
        <tr>
            <td>Broj kvadrata</td>
            <td><input id='broj_kvadrata'/></td>
        </tr>
        <tr>
            <td>Cena</td>
            <td><input id='cena'/></td>
        </tr>
        <tr>
            <td>Grad</td>
            <td>$select_grad</td>
        </tr>
        <tr>
            <td>Ulica</td>
            <td><input id='ulica'/></td>
        </tr>
        <tr>
            <td>Namena nekretnine</td>
            <td>$select_namena_nekretnine</td>
        </tr>
        <tr>
            <td>Tip nekretnine</td>
            <td>$select_tip_nekretnine</td>
        </tr>       
        <tr>
            <td></td>
            <td><button onclick=\"unos_nekretnina(document.getElementById('oglas').value, document.getElementById('broj_kvadrata').value, document.getElementById('cena').value, document.getElementById('sifra_grad').value, document.getElementById('ulica').value, document.getElementById('sifra_namena_nekretnine').value, document.getElementById('sifra_tip_nekretnine').value)\">Sacuvaj</button></td>
        </tr>
    </table>";
}

function unos_nekretnina() {

    if (!isset($_SESSION['sifra_korisnik'])) {
        echo 'Nemate prava pristupa';
        return;
    }

    $oglas = mysql_real_escape_string($_POST['oglas']);
    $broj_kvadrata = mysql_real_escape_string($_POST['broj_kvadrata']);
    $cena = mysql_real_escape_string($_POST['cena']);
    $sifra_grad = mysql_real_escape_string($_POST['sifra_grad']);
    $ulica = mysql_real_escape_string($_POST['ulica']);
    $sifra_namena_nekretnine = mysql_real_escape_string($_POST['sifra_namena_nekretnine']);
    $sifra_tip_nekretnine = mysql_real_escape_string($_POST['sifra_tip_nekretnine']);
    $sifra_korisnik = $_SESSION['sifra_korisnik'];
    $nekretnina = new nekretnina();
    $nekretnina->unos_nekretnina($oglas, $broj_kvadrata, $cena, $sifra_grad, $ulica, $sifra_namena_nekretnine, $sifra_tip_nekretnine, $sifra_korisnik);
    ucitavanje_liste_nekretnina();
}

function izmena_nekretnina() {

    if (!isset($_SESSION['sifra_korisnik'])) {
        echo 'Nemate prava pristupa';
        return;
    }

    $sifra_nekretnina = mysql_real_escape_string($_POST['sifra_nekretnina']);
    $oglas = mysql_real_escape_string($_POST['oglas']);
    $broj_kvadrata = mysql_real_escape_string($_POST['broj_kvadrata']);
    $cena = mysql_real_escape_string($_POST['cena']);
    $sifra_grad = mysql_real_escape_string($_POST['sifra_grad']);
    $ulica = mysql_real_escape_string($_POST['ulica']);
    $sifra_namena_nekretnine = mysql_real_escape_string($_POST['sifra_namena_nekretnine']);
    $sifra_tip_nekretnine = mysql_real_escape_string($_POST['sifra_tip_nekretnine']);
    $nekretnina = new nekretnina();
    $nekretnina->izmena_nekretnina($sifra_nekretnina, $oglas, $broj_kvadrata, $cena, $sifra_grad, $ulica, $sifra_namena_nekretnine, $sifra_tip_nekretnine);
    ucitavanje_liste_nekretnina();
}

function brisanje_nekretnina() {

    if (!isset($_SESSION['sifra_korisnik'])) {
        echo 'Nemate prava pristupa';
        return;
    }

    $sifra_nekretnina = mysql_real_escape_string($_POST['sifra_nekretnina']);
    $nekretnina = new nekretnina();
    $nekretnina->brisanje_nekretnina($sifra_nekretnina);
    ucitavanje_liste_nekretnina();
}

function grafikon() {

    $where = array();
    if (isset($_GET['oglas'])) {
        $oglas = mysql_real_escape_string($_GET['oglas']);
        $where[] = "nekretnina.oglas LIKE '%$oglas%'";
    }
    if (isset($_GET['broj_kvadrata_od'])) {
        $broj_kvadrata_od = mysql_real_escape_string($_GET['broj_kvadrata_od']);
        if (intval($broj_kvadrata_od)) {
            $where[] = "nekretnina.broj_kvadrata >= $broj_kvadrata_od";
        }
    }
    if (isset($_GET['broj_kvadrata_do'])) {
        $broj_kvadrata_do = mysql_real_escape_string($_GET['broj_kvadrata_do']);
        if (intval($broj_kvadrata_do)) {
            $where[] = "nekretnina.broj_kvadrata <= $broj_kvadrata_do";
        }
    }
    if (isset($_GET['cena_od'])) {
        $cena_od = mysql_real_escape_string($_GET['cena_od']);
        if (intval($cena_od)) {
            $where[] = "nekretnina.cena >= $cena_od";
        }
    }
    if (isset($_GET['cena_do'])) {
        $cena_do = mysql_real_escape_string($_GET['cena_do']);
        if (intval($cena_do)) {
            $where[] = "nekretnina.cena <= $cena_do";
        }
    }
    if (isset($_GET['sifra_grad'])) {
        $sifra_grad = mysql_real_escape_string($_GET['sifra_grad']);
        if (intval($sifra_grad) != 0) {
            $where[] = "nekretnina.sifra_grad = $sifra_grad";
        }
    }
    if (isset($_GET['sifra_namena_nekretnine'])) {
        $sifra_namena_nekretnine = mysql_real_escape_string($_GET['sifra_namena_nekretnine']);
        if (intval($sifra_namena_nekretnine) != 0) {
            $where[] = "nekretnina.sifra_namena_nekretnine = $sifra_namena_nekretnine";
        }
    }
    if (isset($_GET['sifra_tip_nekretnine'])) {
        $sifra_tip_nekretnine = mysql_real_escape_string($_GET['sifra_tip_nekretnine']);
        if (intval($sifra_tip_nekretnine) != 0) {
            $where[] = "nekretnina.sifra_tip_nekretnine = $sifra_tip_nekretnine";
        }
    }
    if (count($where) != 0) {
        $where = 'WHERE ' . implode(" AND ", $where);
    } else {
        $where = '';
    }

    $order = '';
    if (isset($_GET['order'])) {
        $order = mysql_real_escape_string($_GET['order']);
        switch ($order) {
            case '0': $order = "ORDER BY nekretnina.sifra_nekretnina";
                break;
            case '1': $order = "ORDER BY nekretnina.oglas";
                break;
            case '2': $order = "ORDER BY nekretnina.broj_kvadrata";
                break;
            case '3': $order = "ORDER BY nekretnina.cena";
                break;
        }
    }

    $nekretnina = new nekretnina();
    $lista_nekretnina = $nekretnina->ucitavanje_liste_nekretnina($where, $order);
    $cols = array();
    $cols[] = array('label' => 'Naziv', 'type' => 'string');
    $cols[] = array('label' => 'cena', 'type' => 'number');
    $rows = array();
    foreach ($lista_nekretnina as $nekretnina) {
        $temp = array();
        $temp[] = array('v' => $nekretnina['oglas']);
        $temp[] = array('v' => (double) $nekretnina['cena']);
        $rows[] = array('c' => $temp);
    }
    echo json_encode(array('cols' => $cols, 'rows' => $rows));
}
