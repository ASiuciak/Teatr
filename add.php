<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$pesel = $_POST["pesel"];
$name = $_POST["imie"];
$surname = $_POST["nazwisko"];
$favourite = $_POST["ulub"];
$price = $_POST["cena"];

$sql = "insert into widz values(:pes, :nam, :sur, :fav, :pr)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':pes', $pesel);
oci_bind_by_name($compiled, ':nam', $name);
oci_bind_by_name($compiled, ':sur', $surname);
oci_bind_by_name($compiled, ':fav', $favourite);
oci_bind_by_name($compiled, ':pr', $price);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Blad przy probie dodania widza.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dodano widza.";
    print "<h2>" . $txt1 . "</h2>";
}


echo '<a href="customer.php">Menu glowne klienta</a>';

 ?>
