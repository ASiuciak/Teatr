<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$pes = $_GET["klient"];
$ord = $_GET["nr"];

$sql = "update zamowienie set stan = 'Oplacone' where stan = 'Oczekujace' and id_zam = '$ord'";

$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Błąd przy próbie opłacenia zamówienia.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Opłacono zamówienie.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="zamowienie.php?klient=';
echo $pes;
echo '">Powrót</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
