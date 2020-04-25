<?php

$nr = $_GET["nr"];
$pes = $_GET["klient"];
$stan = $_GET["stan"];

if ($stan == 'Oplacone') {
    header("Location: customer.php");
}
else {
    $conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
    $sql = "delete from zamowienie where id_zam = '$nr'";

    $compiled = oci_parse($conn, $sql);

    $r = $exec = oci_execute($compiled);
    if(!$r) {
        $txt = "Błąd przy próbie usunięcia zamówienia.";
        print "<h2>" . $txt . "</h2>";
        $e = oci_error($compiled);
        print htmlentities($e['message']);
        print "\n<pre>\n";
        print htmlentities($e['sqltext']);
        printf("\n%".($e['offset']+1)."s", "^");
        print  "\n</pre>\n";
    } else {
        $txt1 = "Usunięto zamówienie.";
        print "<h2>" . $txt1 . "</h2>";
    }

    echo '    <td><a href="zamowienie.php?klient=';
    echo $pes;
    echo '">Powrót</a></td>';
}

 ?>
