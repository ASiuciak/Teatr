<?php

$txt1 = "Aktualnie grane spektakle: ";
print "<h2>" . $txt1 . "</h2>";
$pes = $_GET["klient"];
$ord = $_GET["nr"];

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select distinct id_spek, data, tytul, cena, nr_sali, gatunek, teatr_FK from spektakl s, widz w where s.cena <= w.max_cena and w.PESEL = :pes";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':pes', $pes);

$r = oci_execute($compiled);

if(!$r) {
    $txt = "Blad przy próbie znalezienia spektakli.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
}

echo "<table border='1'>\n";
echo "<tr><th>id_spek</th><th>data</th><th>tytul</th><th>cena</th><th>nr_sali</th><th>gatunek</th><th>teatr_FK</th><th></th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="buy_ticket_pr.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&klient=' . $pes;
    echo '&cena=' .$row1["CENA"];
    echo '">Kup</a></td>';
    echo '    <td><a href="cast_pr.php?nr=';
    echo $ord;
    echo '&spek=' . $row1["ID_SPEK"];
    echo '&nazwa=' .$row1["TYTUL"];
    echo '&klient=' . $pes;
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
