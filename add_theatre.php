<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$name = $_POST["nazwa"];
$city = $_POST["miasto"];
$halls = $_POST["sale"];

$sql = "insert into teatr values('$name', '$city', '$halls')";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':name', $name);
oci_bind_by_name($compiled, ':city', $city);
oci_bind_by_name($compiled, ':halls', $halls);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Blad przy probie dodania teatru.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dodano teatr.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="boss.php">Menu główne admina</a>';
echo "<br>";
echo '<a href="theatres.php">Powrót</a>';

 ?>
