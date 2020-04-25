<?php

$th = $_GET["teatr"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "delete from teatr where nazwa = '$th'";
$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);

if(!$r) {
    $txt = "Błąd przy próbie usunięcia teatru.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Usunięto teatr.";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="boss.php">Menu glowne admina</a>';
echo "<br>";
echo '<a href="theatres.php">Powrót</a>';

 ?>
