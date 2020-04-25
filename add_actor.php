<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$name = $_POST["imie"];
$surname = $_POST["nazwisko"];


$sql = "insert into aktor(imie, nazwisko) values(:nam, :sur)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':nam', $name);
oci_bind_by_name($compiled, ':sur', $surname);


$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Błąd przy próbie dodania aktora.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dodano aktora.";
    print "<h2>" . $txt1 . "</h2>";
}


echo '<a href="boss.php">Menu główne admina</a>';
echo "<br>";
echo '<a href="actors.php">Powrót</a>';

 ?>
