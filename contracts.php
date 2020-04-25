<?php


$txt1 = "Spektakle, w których gra ";
$ac = $_GET["aktor"];
$name = $_GET["imie"];
$surname = $_GET["nazwisko"];
print "<h2>" . $txt1 . $name . " " . $surname . "</h2>";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select distinct id_spek, data, tytul, cena, nr_sali, gatunek from spektakl s, kontrakt k where s.id_spek = k.spektakl_FK and k.aktor_FK = '$ac'";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

echo "<table border='1'>\n";
echo "<tr><th>Id_spek</th><th>Data</th><th>Tytuł</th><th>Cena</th><th>Nr_sali</th><th>Gatunek</th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
echo '    <a href="performances_hire.php?aktor=';
echo $ac;
echo '&imie=' . $name;
echo '&nazwisko=' . $surname;
echo '">Zatrudnij aktora</a>';
echo "<br>";
echo '<a href="boss.php">Menu główne admina</a>';
echo "<br>";
echo '<a href="actors.php">Powrót</a>';

 ?>
