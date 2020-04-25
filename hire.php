<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$ac = $_GET["aktor"];
$name = $_GET["imie"];
$surname = $_GET["nazwisko"];
$spec = $_GET["spek"];

$sql = "insert into kontrakt(spektakl_FK, aktor_FK) values(:spec, :ac)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':spec', $spec);
oci_bind_by_name($compiled, ':ac', $ac);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Blad przy próbie zatrudnienia aktora.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Zatrudniono aktora.";
    print "<h2>" . $txt1 . "</h2>";
}
echo '    <a href="performances_hire.php?aktor=';
echo $ac;
echo '&imie=' . $name;
echo '&nazwisko=' . $surname;
echo '">Powrót</a>';
echo "<br>";
echo '<a href="boss.php">Menu główne admina</a>';

 ?>
