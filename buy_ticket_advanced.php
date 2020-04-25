<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$nr = $_GET["nr"];
$spek = $_GET["spek"];
$pes = $_GET["klient"];
$price = $_GET["cena"];

$sql = "insert into bilet(cena, zamowienie_FK, spektakl_FK) values(:price, :nr, :spek)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':price', $price);
oci_bind_by_name($compiled, ':nr', $nr);
oci_bind_by_name($compiled, ':spek', $spek);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Blad przy probie kupienia biletu.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Kupiono bilet.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="show_order.php?nr=';
echo $nr;
echo '&klient=' . $pes;
echo '">Powrót do zamówienia</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
