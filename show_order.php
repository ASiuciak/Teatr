<?php

$txt1 = "Zamówienie nr: ";
print "<h2>" . $txt1;
$ord = $_GET["nr"];
$pes = $_GET["klient"];
print $ord . "</h2>";
print "\n";

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
$sql = "select distinct b.id_bil, b.zamowienie_FK, s.id_spek, s.tytul from spektakl s, bilet b where b.zamowienie_FK = '$ord' and s.id_spek = b.spektakl_FK";

$compiled = oci_parse($conn, $sql);

oci_execute($compiled);

echo "<table border='1'>\n";
echo "<tr><th>id biletu</th><th>zamowienie</th><th>id spektaklu</th><th>tytul</th><th></th></tr>\n";
while ($row1 = oci_fetch_array($compiled, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row1 as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo '    <td><a href="delete_ticket.php?bilet=';
    echo $row1["ID_BIL"];
    echo '&klient=' . $pes;
    echo '&nr=' . $ord;
    echo '">Usun</a></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo '    <td><a href="add_ticket_all.php?klient=';
echo $pes;
echo '&nr=' . $ord;
echo '">Kup bilet na dowolny spektakl</a></td>';
echo "<br>";
echo "</table>\n";
echo '    <td><a href="add_ticket_fav.php?klient=';
echo $pes;
echo '&nr=' . $ord;
echo '">Kup bilet na spektakl Twojego gatunku</a></td>';
echo "<br>";
echo '    <td><a href="add_ticket_pr.php?klient=';
echo $pes;
echo '&nr=' . $ord;
echo '">Kup bilet na spektakl o odpowiedniej cenie</a></td>';
echo "<br>";
echo '    <td><a href="add_ticket_advanced_form.php?klient=';
echo $pes;
echo '&nr=' . $ord;
echo '">Kup bilet (wyszukiwanie zaawansowane)</a></td>';
echo "<br>";
echo '<a href="zamowienie.php?klient=';
echo $pes;
echo '">Powrót</a>';
echo "<br>";
echo '<a href="customer.php">Menu główne klienta</a>';

 ?>
