<?php

$ac = $_GET["aktor"];
$name = $_GET["imie"];
$surname = $_GET["nazwisko"];

$txt = "Oferty pracy dla: ";
print "<h2>" . $txt . $name . " " . $surname . "</h2>";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select * from spektakl";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

echo "<table border='1'>\n";
echo "<tr><th>Id_spek</th><th>Data</th><th>Tytuł</th><th>Cena</th><th>Nr_sali</th><th>Gatunek</th><th>Teatr_FK</th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="hire.php?aktor=';
    echo $ac;
    echo '&imie=' . $name;
    echo '&nazwisko=' . $surname;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '">Zatrudnij</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '    <a href="contracts.php?aktor=';
echo $ac;
echo '&imie=' . $name;
echo '&nazwisko=' . $surname;
echo '">Powrót</a>';
echo "<br>";
echo '<a href="boss.php">Menu główne admina</a>';

 ?>
