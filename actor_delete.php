<?php

$act = $_GET["aktor"];


$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "delete from aktor where id_akt = :act";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':act', $act);

$r = oci_execute($compiled);
if(!$r) {
    $txt = "Błąd przy próbie usunięcia aktora.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
        $txt1 = "Usunięto aktora.";
        print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="boss.php">Menu główne admina</a>';
echo "<br>";
echo '<a href="actors.php">Powrót</a>';

 ?>
