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
     $pes = $_GET["klient"];
     $ord = $_GET["nr"];
     ?>
    <form action="add_ticket_advanced.php?klient=<?php echo $pes ?>&nr=<?php echo $ord ?>" method="post">
    Miasto: <input type="text" name="miasto" />
    <br/>
    Min. cena: <input type="number" name="min_cena" min="10" max="200">
    <br/>
    Maks. cena: <input type="number" name="max_cena" min="10" max="200">
    <br/>
    Gatunek: <input type="text" name="gatunek" />
    <br/>
    <button type="submit">Filtruj</button>
    </form>
</body>
</html>
