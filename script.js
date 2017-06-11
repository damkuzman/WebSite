function otvori_registracija() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=otvori_registracija", true);
    xmlhttp.send();
}

function otvori_prijava() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=otvori_prijava", true);
    xmlhttp.send();
}

function ucitavanje_liste_nekretnina() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_liste_nekretnina", true);
    xmlhttp.send();
}

function pretraga_lista_nekretnina(oglas, broj_kvadrata_od, broj_kvadrata_do, cena_od, cena_do, sifra_grad, sifra_namena_nekretnine, sifra_tip_nekretnine, order) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_liste_nekretnina&oglas=" + oglas + "&broj_kvadrata_od=" + broj_kvadrata_od + "&broj_kvadrata_do=" + broj_kvadrata_do + "&cena_od=" + cena_od + "&cena_do=" + cena_do + "&sifra_grad=" + sifra_grad + "&sifra_namena_nekretnine=" + sifra_namena_nekretnine + "&sifra_tip_nekretnine=" + sifra_tip_nekretnine + "&order=" + order, true);
    xmlhttp.send();
}

function grafikon(oglas, broj_kvadrata_od, broj_kvadrata_do, cena_od, cena_do, sifra_grad, sifra_namena_nekretnine, sifra_tip_nekretnine, order) {
    document.getElementById('content').innerHTML = "";
    var jsonData = $.ajax({
        url: "server.php?operacija=grafikon&oglas=" + oglas + "&broj_kvadrata_od=" + broj_kvadrata_od + "&broj_kvadrata_do=" + broj_kvadrata_do + "&cena_od=" + cena_od + "&cena_do=" + cena_do + "&sifra_grad=" + sifra_grad + "&sifra_namena_nekretnine=" + sifra_namena_nekretnine + "&sifra_tip_nekretnine=" + sifra_tip_nekretnine + "&order=" + order,
        dataType: "json",
        async: false
    }).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var chart = new google.visualization.PieChart(document.getElementById('content'));
    chart.draw(data, {width: 800, height: 600});
}

function ucitavanje_nekretnina(sifra_nekretnina) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_nekretnina&sifra_nekretnina=" + sifra_nekretnina, true);
    xmlhttp.send();
}

function otvori_nekretnina(sifra_nekretnina) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=otvori_nekretnina&sifra_nekretnina=" + sifra_nekretnina, true);
    xmlhttp.send();
}

function kreiraj_nekretnina() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=kreiraj_nekretnina", true);
    xmlhttp.send();
}

function unos_nekretnina(oglas, broj_kvadrata, cena, sifra_grad, ulica, sifra_namena_nekretnine, sifra_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=unos_nekretnina", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("oglas=" + oglas + "&broj_kvadrata=" + broj_kvadrata + "&cena=" + cena + "&sifra_grad=" + sifra_grad + "&ulica=" + ulica + "&sifra_namena_nekretnine=" + sifra_namena_nekretnine + "&sifra_tip_nekretnine=" + sifra_tip_nekretnine);
}

function izmena_nekretnina(sifra_nekretnina, oglas, broj_kvadrata, cena, sifra_grad, ulica, sifra_namena_nekretnine, sifra_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=izmena_nekretnina", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_nekretnina=" + sifra_nekretnina + "&oglas=" + oglas + "&broj_kvadrata=" + broj_kvadrata + "&cena=" + cena + "&sifra_grad=" + sifra_grad + "&ulica=" + ulica + "&sifra_namena_nekretnine=" + sifra_namena_nekretnine + "&sifra_tip_nekretnine=" + sifra_tip_nekretnine);
}

function brisanje_nekretnina(sifra_nekretnina) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=brisanje_nekretnina", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_nekretnina=" + sifra_nekretnina);
}


function ucitavanje_liste_grad() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_liste_grad", true);
    xmlhttp.send();
}

function ucitavanje_grad(sifra_grad) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_grad&sifra_grad=" + sifra_grad, true);
    xmlhttp.send();
}

function kreiraj_grad() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=kreiraj_grad", true);
    xmlhttp.send();
}

function unos_grad(naziv_grad, ptt_grad) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=unos_grad", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("naziv_grad=" + naziv_grad + "&ptt_grad=" + ptt_grad);
}

function izmena_grad(sifra_grad, naziv_grad, ptt_grad) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=izmena_grad", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_grad=" + sifra_grad + "&naziv_grad=" + naziv_grad + "&ptt_grad=" + ptt_grad);
}

function brisanje_grad(sifra_grad) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=brisanje_grad", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_grad=" + sifra_grad);
}


function ucitavanje_liste_namena_nekretnine() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_liste_namena_nekretnine", true);
    xmlhttp.send();
}

function ucitavanje_namena_nekretnine(sifra_namena_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_namena_nekretnine&sifra_namena_nekretnine=" + sifra_namena_nekretnine, true);
    xmlhttp.send();
}

function kreiraj_namena_nekretnine() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=kreiraj_namena_nekretnine", true);
    xmlhttp.send();
}

function unos_namena_nekretnine(naziv_namena_nekretnine, adresa_namena_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=unos_namena_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("naziv_namena_nekretnine=" + naziv_namena_nekretnine + "&adresa_namena_nekretnine=" + adresa_namena_nekretnine);
}

function izmena_namena_nekretnine(sifra_namena_nekretnine, naziv_namena_nekretnine, adresa_namena_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=izmena_namena_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_namena_nekretnine=" + sifra_namena_nekretnine + "&naziv_namena_nekretnine=" + naziv_namena_nekretnine + "&adresa_namena_nekretnine=" + adresa_namena_nekretnine);
}

function brisanje_namena_nekretnine(sifra_namena_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=brisanje_namena_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_namena_nekretnine=" + sifra_namena_nekretnine);
}


function ucitavanje_liste_tip_nekretnine() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_liste_tip_nekretnine", true);
    xmlhttp.send();
}

function ucitavanje_tip_nekretnine(sifra_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=ucitavanje_tip_nekretnine&sifra_tip_nekretnine=" + sifra_tip_nekretnine, true);
    xmlhttp.send();
}


function kreiraj_tip_nekretnine() {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "server.php?operacija=kreiraj_tip_nekretnine", true);
    xmlhttp.send();
}

function unos_tip_nekretnine(naziv_tip_nekretnine, adresa_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=unos_tip_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("naziv_tip_nekretnine=" + naziv_tip_nekretnine + "&adresa_tip_nekretnine=" + adresa_tip_nekretnine);
}

function izmena_tip_nekretnine(sifra_tip_nekretnine, naziv_tip_nekretnine, adresa_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=izmena_tip_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_tip_nekretnine=" + sifra_tip_nekretnine + "&naziv_tip_nekretnine=" + naziv_tip_nekretnine + "&adresa_tip_nekretnine=" + adresa_tip_nekretnine);
}

function brisanje_tip_nekretnine(sifra_tip_nekretnine) {
    document.getElementById('content').innerHTML = "";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "server.php?operacija=brisanje_tip_nekretnine", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("sifra_tip_nekretnine=" + sifra_tip_nekretnine);
}


