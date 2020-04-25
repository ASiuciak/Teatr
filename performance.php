<?php


$txt1 = "Spektakle grane w: ";
$th = $_GET["teatr"];
print "<h2>" . $txt1 . $th . "</h2>";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select * from spektakl where teatr_FK = '$th'";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

echo "<table border='1'>\n";
echo "<tr><th>Id_spek</th><th>Data</th><th>Tytuł</th><th>Cena</th><th>Nr_sali</th><th>Gatunek</th><th>Teatr_FK</th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="delete_performance.php?teatr=';
    echo $th;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '">Usuń</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '<a href="add_performance_form.php?teatr=';
echo $th;
echo '">Dodaj spektakl</a>';
echo "<br>";
echo '<a href="boss.php">Menu glowne admina</a>';
echo "<br>";
echo '<a href="theatres.php">Powrót</a>';

 ?>
