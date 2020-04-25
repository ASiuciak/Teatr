<?php

$pes = $_GET["klient"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "delete from widz where PESEL = '$pes'";

$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);

if(!$r) {
    $txt = "Blad przy probie usuniecia widza.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Usunieto widza.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="customer.php">Powrót</a>';

 ?>
