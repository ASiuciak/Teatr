<?php

$bilet = $_GET["bilet"];
$pes = $_GET["klient"];
$ord = $_GET["nr"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "delete from bilet where id_bil = '$bilet'";

$compiled = oci_parse($conn, $sql);

$r = $exec = oci_execute($compiled);
if(!$r) {
    $txt = "Blad przy probie usuniecia biletu.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Usunięto bilet.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '    <td><a href="show_order.php?nr=';
echo $ord;
echo '&klient=' . $pes;
echo '">Powrót</a></td>';

 ?>
