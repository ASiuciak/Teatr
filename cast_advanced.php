<?php


$txt1 = "Aktorzy grający w: ";
$name = $_GET["nazwa"];
$ord = $_GET["nr"];
$pes = $_GET["klient"];
$spek = $_GET["spek"];
print "<h2>" . $txt1 . " " . $name . "</h2>";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select distinct imie, nazwisko from aktor a, kontrakt k where k.aktor_FK = a.id_akt and k.spektakl_FK = '$spek'";

$compiled = oci_parse($conn, $sql);

$r = oci_execute($compiled);

if(!$r) {
    $txt = "Błąd przy próbie znalezienia aktorów.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

echo "<table border='1'>\n";
echo "<tr><th>Imię</th><th>Nazwisko</th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
echo '<a href="show_order.php?nr=';
echo $ord;
echo '&klient=' . $pes;
echo '">Powrót do zamówienia</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
