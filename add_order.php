<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$pes = $_GET["klient"];
$st = "Oczekujace";

$sql = "insert into zamowienie(stan, widz_FK) values(:st, :pes)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':st', $st);
oci_bind_by_name($compiled, ':pes', $pes);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Błąd przy próbie dodania zamówienia.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dodano zamówienie.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="zamowienie.php?klient=';
echo $pes;
echo '">Powrót</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
