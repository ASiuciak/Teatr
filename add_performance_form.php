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
     $th = $_GET["teatr"];
     ?>
    <form action="add_performance.php?teatr=<?php echo $th ?>" method="post">
    *Data <input type="date" name="data" />
    <br/>
    *Tytul: <input type="text" name="tytul" />
    <br/>
    *Cena: <input type="number" name="cena" min="10" max="200" />
    <br/>
    Sala: <input type="number" name="sala" max="20" />
    <br/>
    Gatunek: <input type="text" name="gatunek" />
    <br/>
    <button type="submit">Dodaj</button>
    </form>
</body>
</html>
