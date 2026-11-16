<?php
$IDpergunta = "";
$pergunta = "";
$IDresposta = "";
$resposta = "";

$msg = "";
$encontrou = "nao";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $acao = $_POST["acao"];

    if ($acao == "buscar") {

        $IDpergunta = $_POST["IDpergunta"];

        $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqPERGUNTA);

        while (!feof($arqPERGUNTA)) {
            $linha = fgets($arqPERGUNTA);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] == $IDpergunta) {
                    $pergunta = $coluna[1];
                }
            }
        }
        fclose($arqPERGUNTA);

        $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqRESPOSTA);

        while (!feof($arqRESPOSTA)) {
            $linha = fgets($arqRESPOSTA);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[1] == $IDpergunta) {
                    $IDresposta = $coluna[0];
                    $resposta = $coluna[2];
                }
            }
        }
        fclose($arqRESPOSTA);

        $encontrou = "sim";
        $msg = "Pergunta encontrada!";
    }

    if ($acao == "salvar") {

        $IDpergunta = $_POST["IDpergunta"];
        $novaPergunta = $_POST["pergunta"];
        $IDresposta = $_POST["IDresposta"];
        $novaResposta = $_POST["resposta"];

        $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
        $arqPERGUNTANovo = fopen("perguntaNovo.txt", "w") or die("Erro ao criar arquivo");

        $linha = fgets($arqPERGUNTA);
        fwrite($arqPERGUNTANovo, $linha);

        while (!feof($arqPERGUNTA)) {
            $linha = fgets($arqPERGUNTA);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] == $IDpergunta) {
                    $linha = $IDpergunta . ";" . $novaPergunta . "\n";
                }

                fwrite($arqPERGUNTANovo, $linha);
            }
        }
        fclose($arqPERGUNTA);
        fclose($arqPERGUNTANovo);
        rename("perguntaNovo.txt", "pergunta.txt");

        $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
        $arqRESPOSTANovo = fopen("respostaNovo.txt", "w") or die("Erro ao criar arquivo");

        $linha = fgets($arqRESPOSTA);
        fwrite($arqRESPOSTANovo, $linha);

        while (!feof($arqRESPOSTA)) {
            $linha = fgets($arqRESPOSTA);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] == $IDresposta) {
                    $linha = $IDresposta . ";" . $IDpergunta . ";" . $novaResposta . ";" . "1" . "\n";
                }

                fwrite($arqRESPOSTANovo, $linha);
            }
        }
        fclose($arqRESPOSTA);
        fclose($arqRESPOSTANovo);
        rename("respostaNovo.txt", "resposta.txt");

        $msg = "Pergunta de texto alterada com sucesso!!!";
        $encontrou = "nao";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pergunta de Texto</title>
</head>
<body>

<h1>Alterar Pergunta de Texto</h1>

<form action="alterar_texto.php" method="POST">
    <input type="hidden" name="acao" value="buscar">
    IDpergunta a alterar: <input type="text" name="IDpergunta">
    <br><br>
    <input type="submit" value="Buscar">
</form>

<br>

<?php
if ($encontrou == "sim") {

    echo "<h2>Editar Pergunta</h2>";

    echo "<form action='alterar_texto.php' method='POST'>";
    echo "<input type='hidden' name='acao' value='salvar'>";
    echo "<input type='hidden' name='IDpergunta' value='" . $IDpergunta . "'>";
    echo "<input type='hidden' name='IDresposta' value='" . $IDresposta . "'>";

    echo "Pergunta: <input type='text' name='pergunta' value='" . $pergunta . "'>";
    echo "<br><br>";

    echo "Resposta correta: <input type='text' name='resposta' value='" . $resposta . "'>";
    echo "<br><br>";

    echo "<input type='submit' value='Salvar Alteração'>";
    echo "</form>";
}

echo "<p>" . $msg . "</p>";
?>

</body>
</html>