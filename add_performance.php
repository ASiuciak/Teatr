<?php

$conn = oci_connect('as406346', 'Wisielec3719', 'LABS') or die ('Blad bazy.');

$th = $_GET["teatr"];

$date = $_POST["data"];
$title = $_POST["tytul"];
$price = $_POST["cena"];
$hall = $_POST["sala"];
$kind = $_POST["gatunek"];

$sql = "insert into spektakl(data, tytul, cena, nr_sali, gatunek, teatr_FK) values(TO_DATE(:dat, 'yyyy-mm-dd'), :title, :price, :hall, :kind, :th)";

$compiled = oci_parse($conn, $sql);

oci_bind_by_name($compiled, ':dat', $date);
oci_bind_by_name($compiled, ':title', $title);
oci_bind_by_name($compiled, ':price', $price);
oci_bind_by_name($compiled, ':hall', $hall);
oci_bind_by_name($compiled, ':kind', $kind);
oci_bind_by_name($compiled, ':th', $th);

$r = oci_execute($compiled);
oci_commit($conn);

if(!$r) {
    $txt = "Błąd przy próbie dodania spektaklu.";
    print "<h2>" . $txt . "</h2>";
    $e = oci_error($compiled);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%".($e['offset']+1)."s", "^");
    print  "\n</pre>\n";
} else {
    $txt1 = "Dodano spektakl";
    print "<h2>" . $txt1 . "</h2>";
}

echo '<a href="performance.php?teatr=';
echo $th;
echo '">Powrót</a>';
print "\n";
echo '<a href="boss.php">Menu główne admina</a>';

 ?>
