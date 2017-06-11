<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="images/SimpleBlog.css" type="text/css" />
        <title>ITEH</title>
        <script type="text/javascript" src="script.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript">
            google.load('visualization', '1', {'packages': ['corechart']});
            google.setOnLoadCallback(drawChart);
        </script>
    </head>
    <body>
        <div id="wrap">
            <div id="header">
                <h1 id="logo">Web aplikacije za <span class="gray">NEKRETNINE</span></h1>          
            </div>
            <div id="menu">
                <ul>
                    <?php session_start(); ?>
                    <li><a href="#" onclick="ucitavanje_liste_nekretnina()">Nekretnine</a></li>
                    <?php if (isset($_SESSION['username'])): ?>                            
                        <?php if ($_SESSION['tip_korisnik'] == 'administrator') : ?>
                            <li><a href="#" onclick="ucitavanje_liste_grad()">Gradovi</a></li>
                            <li><a href="#" onclick="ucitavanje_liste_namena_nekretnine()">Namene</a></li>
                            <li><a href="#" onclick="ucitavanje_liste_tip_nekretnine()">Tipovi</a></li>
                        <?php endif; ?>
                        <li><a href="server.php?operacija=odjava" >Odjava</a></li>
                    <?php else: ?>
                        <li><a href="#" onclick="otvori_prijava()">Prijava</a></li>
                        <li><a href="#" onclick="otvori_registracija()">Registracija</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div id="content-wrap">
                <div id="sidebar">
                    <h1>Meni</h1>
                    <ul class="sidemenu">
                        <li><a href="#" onclick="ucitavanje_liste_nekretnina()">Nekretnine</a></li>
                        <?php if (isset($_SESSION['username'])): ?>                            
                            <?php if ($_SESSION['tip_korisnik'] == 'administrator') : ?>
                                <li><a href="#" onclick="ucitavanje_liste_grad()">Gradovi</a></li>
                                <li><a href="#" onclick="ucitavanje_liste_namena_nekretnine()">Namene</a></li>
                                <li><a href="#" onclick="ucitavanje_liste_tip_nekretnine()">Tipovi</a></li>
                            <?php endif; ?>
                            <li><a href="server.php?operacija=odjava" >Odjava</a></li>
                        <?php else: ?>
                            <li><a href="#" onclick="otvori_prijava()">Prijava</a></li>
                            <li><a href="#" onclick="otvori_registracija()">Registracija</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div id="main">
                    <div id="content"></div>
                </div>
            </div>

        </div>
    </body>
</html>
