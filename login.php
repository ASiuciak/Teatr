<?php

session_start();

if ($_POST["login"] == 'admin' && $_POST["haslo"] == 'admin') {
    header("Location: boss.php");
} else if ($_POST["login"] == 'gosc' && $_POST["haslo"] == 'gosc') {
    header("Location: customer.php");
} else {
    print("Nieprawdiłowy login lub hasło");
}

 ?>
