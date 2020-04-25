<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login tutorial</title>
</head>
<body>

    <?php

    $conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');
    $txt1 = "Widzowie:";
    print "<h2>" . $txt1 . "</h2>";
    $stid = oci_parse($conn, 'select * from widz');
    oci_execute($stid);

    echo "<table border='1'>\n";
    echo "<tr><th>PESEL</th><th>Imię</th><th>Nazwisko</th><th>Ulubiony_gatunek</th><th>Max_cena</th><th>Zamówienia</th><th></th></tr>\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo '    <td><a href="zamowienie.php?klient=';
        echo $row["PESEL"];
        echo '">Moje zamówienia</a></td>';
        echo '    <td><a href="delete.php?klient=';
        echo $row["PESEL"];
        echo '">Usuń</a></td>';
        echo "</tr>\n";
    }
    echo "</table>\n";
    echo '<a href="add_form.php">Dodaj widza</a>';

     ?>

</body>
</html>
