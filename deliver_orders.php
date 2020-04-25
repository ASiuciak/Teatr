<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$pes = $_GET["klient"];

$sql = "update zamowienie set stan = 'Dostarczone' where stan = 'Oplacone'";

$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Blad przy probie dostarczenia zamówień.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dostarczono zamówienia.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="boss.php">Menu glowne admina</a>';

 ?>
