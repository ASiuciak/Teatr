<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login tutorial</title>
</head>
<body>
    <form action="add.php" method="post">
    *PESEL <input type="number" name="pesel" />
    <br/>
    *Imie: <input type="text" name="imie" />
    <br/>
    *Nazwisko: <input type="text" name="nazwisko" />
    <br/>
    Ulubiony gatunek: <input type="radio" name="ulub"
    <?php if (isset($ulub) && $ulub=="komedia") echo "checked";?>
     value="komedia">komedia
    <input type="radio" name="ulub"
    <?php if (isset($ulub) && $ulub=="dramat") echo "checked";?>
    value="dramat">dramat
    <input type="radio" name="ulub"
    <?php if (isset($ulub) && $ulub=="musical") echo "checked";?>
    value="musical">musical
    <input type="radio" name="ulub"
    <?php if (isset($ulub) && $ulub=="balet") echo "checked";?>
    value="balet">balet
    <br/>
    Maksymalna dopuszczalna cena: <input type="number" name="cena" min="10" max="200">
    <br/>
    <button type="submit">Dodaj</button>
    </form>
</body>
</html>
