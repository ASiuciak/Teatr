<?php

$txt1 = "Zamówienia osoby o PESELu: ";
$pes = $_GET["klient"];
print "<h2>" . $txt1 . $pes . "</h2>";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select id_zam, max(stan), max(widz_FK), sum(cena) from zamowienie left join bilet on id_zam = zamowienie_FK where widz_FK = '$pes' group by id_zam";

$compiled = oci_parse($conn, $sql);

//oci_bind_by_name($compiled, ':pes', $pes);

$r = oci_execute($compiled);
if(!$r) {
    $txt = "Blad przy probie dodania zam.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

echo "<table border='1'>\n";
echo "<tr><th>id_zam</th><th>Stan</th><th>Widz</th><th>Cena</th><th></th><th></th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="show_order.php?nr=';
    echo $row1["ID_ZAM"];
    echo '&klient=' . $pes;
    echo '">Pokaż</a></td>';
    echo '    <td><a href="pay.php?nr=';
    echo $row1["ID_ZAM"];
    echo '&klient=' . $pes;
    echo '">Opłać</a></td>';
    echo '    <td><a href="delete_order.php?nr=';
    echo $row1["ID_ZAM"];
    echo '&klient=' . $pes;
    echo '&stan=' . $row1["MAX(STAN)"];
    echo '">Usuń</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '<a href="add_order.php?klient=';
echo $pes;
echo '">Dodaj zamówienie</a>';
echo "<br>";
echo '<a href="pay_all.php?klient=';
echo $pes;
echo '">Opłać wszystkie</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';
 ?>
