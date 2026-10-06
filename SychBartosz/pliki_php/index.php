<?php

if (!file_exists("dokumenty")) {
    mkdir("dokumenty");
}

$pliki = scandir("dokumenty");

if (isset($_POST["nazwa"])) {
    $nazwa = trim($_POST["nazwa"]);

    if ($nazwa != "") {
        if (file_exists("dokumenty/$nazwa")) {
            $komunikat = "Taki katalog już istnieje.";
        } else {
            mkdir("dokumenty/$nazwa");
            $komunikat = "Katalog został utworzony.";
        }
    } else {
        $komunikat = "Podaj nazwę katalogu.";
    }

    $pliki = scandir("dokumenty");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>MOJE PLIKI</h1>

<p>Aktualny katalog:</p>

<p>
    <?php echo getcwd(); ?>
</p>

<h2>ZAWARTOŚĆ KATALOGU</h2>

<table>
    <tr>
        <th>Nazwa</th>
        <th>Typ</th>
        <th>Rozmiar</th>
    </tr>

    <?php

    foreach ($pliki as $plik) {

        if ($plik != "." && $plik != "..") {

            $sciezka = "dokumenty/" . $plik;

            echo "<tr>";

            echo "<td>$plik</td>";

            if (is_file($sciezka)) {
                echo "<td>PLIK</td>";
                echo "<td>" . filesize($sciezka) . " B</td>";
            }

            if (is_dir($sciezka)) {
                echo "<td>KATALOG</td>";
                echo "<td>-</td>";
            }

            echo "</tr>";
        }
    }

    ?>

</table>

<h2>Utwórz katalog</h2>

<form method="post">

    <input type="text" name="nazwa">

    <button type="submit">Utwórz</button>

</form>

<?php

if (isset($komunikat)) {
    echo "<p>$komunikat</p>";
}

?>

</body>
</html>
