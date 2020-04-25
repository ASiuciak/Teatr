<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$txt1 = "Teatry:";
print "<h2>" . $txt1 . "</h2>";
$stid = oci_parse($conn, 'select * from teatr');
oci_execute($stid);

echo "<table border='1'>\n";
echo "<tr><th>nazwa</th><th>miasto</th><th>liczba_sal</th><th>Spektakle</th><th>Usun</th></tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="performance.php?teatr=';
    echo urlencode($row["NAZWA"]);
    echo '">Spektakle</a></td>';
    echo '    <td><a href="theatre_delete.php?teatr=';
    echo urlencode($row["NAZWA"]);
    echo '">Usun</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '<a href="add_theatre_form.php">Dodaj teatr</a>';
echo "<br>";
echo '<a href="boss.php">Menu glowne admina</a>';
 ?>
