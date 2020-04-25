<?php

$txt1 = "Aktualnie grane spektakle: ";
print "<h2>" . $txt1 . "</h2>";
$pes = $_GET["klient"];
$ord = $_GET["nr"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select * from spektakl";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

echo "<table border='1'>\n";
echo "<tr><th>id_spek</th><th>data</th><th>tytul</th><th>cena</th><th>nr_sali</th><th>gatunek</th><th>teatr_FK</th><th></th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="buy_ticket.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&klient=' . $pes;
    echo '&cena=' .$row1["CENA"];
    echo '">Kup</a></td>';
    echo '    <td><a href="cast.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&klient=' . $pes;
    echo '&nazwa=' .$row1["TYTUL"];
    echo '">Obsada</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '    <td><a href="show_order.php?nr=';
echo $ord;
echo '&klient=' . $pes;
echo '">Powrót</a></td>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
