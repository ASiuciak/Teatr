<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$txt1 = "Aktorzy:";
print "<h2>" . $txt1 . "</h2>";
$stid = oci_parse($conn, 'select id_akt, imie, nazwisko from aktor');
oci_execute($stid);

echo "<table border='1'>\n";
echo "<tr><th>Id_akt</th><th>Imię</th><th>Nazwisko</th><th></th><th></th></tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="contracts.php?aktor=';
    echo $row["ID_AKT"];
    echo '&imie=' . $row["IMIE"];
    echo '&nazwisko=' . $row["NAZWISKO"];
    echo '">Spektakle z udziałem</a></td>';
    echo '    <td><a href="actor_delete.php?aktor=';
    echo $row["ID_AKT"];
    echo '">Usun</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '<a href="add_actor_form.php">Dodaj aktora</a>';
echo "<br>";
echo '<a href="boss.php">Menu główne admina</a>';
 ?>
