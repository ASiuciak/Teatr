<?php

$txt1 = "Aktualnie grane spektakle: ";
print "<h2>" . $txt1 . "</h2>";
$ord = $_GET["nr"];
$pes = $_GET["klient"];


$city = $_POST["miasto"];
$min = $_POST["min_cena"];
$max = $_POST["max_cena"];
$kind = $_POST["gatunek"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select id_spek, data, tytul, cena, nr_sali, gatunek, nazwa from spektakl s, teatr t where s.teatr_FK = t.nazwa";

if(!$city) {}
else {
    $a1 = " and t.miasto = '$city'";
    $sql = $sql.$a1;
}

if(!$min) {}
else {
    $a2 = " and s.cena >= '$min'";
    $sql = $sql.$a2;
}

if(!$max) {}
else {
    $a3 = " and s.cena <= '$max'";
    $sql = $sql.$a3;
}

if(!$kind) {}
else {
    $a4 = " and s.gatunek = '$kind'";
    $sql = $sql.$a4;
}

$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);

if(!$r) {
    $txt = "Blad przy probie kupienia biletu.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

echo "<table border='1'>\n";
echo "<tr><th>id_spek</th><th>data</th><th>tytul</th><th>cena</th><th>nr_sali</th><th>gatunek</th><th>teatr_FK</th><th></th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="buy_ticket_advanced.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&klient=' . $pes;
    echo '&cena=' .$row1["CENA"];
    echo '">Kup</a></td>';
    echo '    <td><a href="cast_advanced.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&klient=' . $pes;
    echo '&nazwa=' .$row1["TYTUL"];
    echo '">Obsada</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '    <td><a href="show_order.php?nr=';
echo $ord;
echo '&klient=' . $pes;
echo '">Powrót do zamówienia</a></td>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
