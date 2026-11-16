<?php
$IDpergunta = "";
$pergunta = "";
$msg = "";
$encontrou = "nao";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $IDpergunta = $_POST["IDpergunta"];

    $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqPERGUNTA);

    while (!feof($arqPERGUNTA)) {
        $linha = fgets($arqPERGUNTA);

        if ($linha != "") {
            $coluna = explode(";", $linha);

            if ($coluna[0] == $IDpergunta) {
                $pergunta = $coluna[1];
                $encontrou = "sim";
            }
        }
    }
    fclose($arqPERGUNTA);

    if ($encontrou == "nao") {
        $msg = "Pergunta não encontrada.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Uma Pergunta</title>
</head>
<body>
    <h1>Listar Uma Pergunta</h1>

    <form action="listar_uma_pergunta.php" method="POST">
        IDpergunta: <input type="text" name="IDpergunta">
        <br><br>
        <input type="submit" value="Buscar">
    </form>

<?php
if ($encontrou == "sim") {

    echo "<h3>" . $pergunta . "</h3>";
    echo "<p>IDpergunta: " . $IDpergunta . "</p>";
    echo "<ul>";

    $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
    $linhaResp = fgets($arqRESPOSTA);

    while (!feof($arqRESPOSTA)) {
        $linhaResp = fgets($arqRESPOSTA);

        if ($linhaResp != "") {
            $colunaResp = explode(";", $linhaResp);

            if ($colunaResp[1] == $IDpergunta) {
                $resposta = $colunaResp[2];
                $certa = $colunaResp[3];

                echo "<li>" . $resposta . " (certa: " . $certa . ")</li>";
            }
        }
    }
    fclose($arqRESPOSTA);

    echo "</ul>";
}

echo "<p>" . $msg . "</p>";
?>

</body>
</html>