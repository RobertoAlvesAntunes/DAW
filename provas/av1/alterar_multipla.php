<?php
$IDpergunta = "";
$pergunta = "";

$IDresposta1 = ""; $resposta1 = ""; $certa1 = "";
$IDresposta2 = ""; $resposta2 = ""; $certa2 = "";
$IDresposta3 = ""; $resposta3 = ""; $certa3 = "";
$IDresposta4 = ""; $resposta4 = ""; $certa4 = "";

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

        $contador = 0;

        $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqRESPOSTA);

        while (!feof($arqRESPOSTA)) {
            $linha = fgets($arqRESPOSTA);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[1] == $IDpergunta) {
                    $contador = $contador + 1;

                    if ($contador == 1) {
                        $IDresposta1 = $coluna[0];
                        $resposta1 = $coluna[2];
                        $certa1 = $coluna[3];
                    }
                    if ($contador == 2) {
                        $IDresposta2 = $coluna[0];
                        $resposta2 = $coluna[2];
                        $certa2 = $coluna[3];
                    }
                    if ($contador == 3) {
                        $IDresposta3 = $coluna[0];
                        $resposta3 = $coluna[2];
                        $certa3 = $coluna[3];
                    }
                    if ($contador == 4) {
                        $IDresposta4 = $coluna[0];
                        $resposta4 = $coluna[2];
                        $certa4 = $coluna[3];
                    }
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

        $IDresposta1 = $_POST["IDresposta1"];
        $resposta1 = $_POST["resposta1"];
        $certa1 = $_POST["certa1"];

        $IDresposta2 = $_POST["IDresposta2"];
        $resposta2 = $_POST["resposta2"];
        $certa2 = $_POST["certa2"];

        $IDresposta3 = $_POST["IDresposta3"];
        $resposta3 = $_POST["resposta3"];
        $certa3 = $_POST["certa3"];

        $IDresposta4 = $_POST["IDresposta4"];
        $resposta4 = $_POST["resposta4"];
        $certa4 = $_POST["certa4"];

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
                $IDatual = $coluna[0];

                if ($IDatual == $IDresposta1) {
                    $linha = $IDresposta1 . ";" . $IDpergunta . ";" . $resposta1 . ";" . $certa1 . "\n";
                }
                if ($IDatual == $IDresposta2) {
                    $linha = $IDresposta2 . ";" . $IDpergunta . ";" . $resposta2 . ";" . $certa2 . "\n";
                }
                if ($IDatual == $IDresposta3) {
                    $linha = $IDresposta3 . ";" . $IDpergunta . ";" . $resposta3 . ";" . $certa3 . "\n";
                }
                if ($IDatual == $IDresposta4) {
                    $linha = $IDresposta4 . ";" . $IDpergunta . ";" . $resposta4 . ";" . $certa4 . "\n";
                }

                fwrite($arqRESPOSTANovo, $linha);
            }
        }
        fclose($arqRESPOSTA);
        fclose($arqRESPOSTANovo);
        rename("respostaNovo.txt", "resposta.txt");

        $msg = "Pergunta e respostas alteradas com sucesso!!!";
        $encontrou = "nao";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Pergunta Multipla</title>
</head>
<body>

<h1>Alterar Pergunta (Múltipla Escolha)</h1>

<form action="alterar_multipla.php" method="POST">
    <input type="hidden" name="acao" value="buscar">
    IDpergunta a alterar: <input type="text" name="IDpergunta">
    <br><br>
    <input type="submit" value="Buscar">
</form>

<br>

<?php
if ($encontrou == "sim") {

    echo "<h2>Editar Pergunta</h2>";

    echo "<form action='alterar_multipla.php' method='POST'>";
    echo "<input type='hidden' name='acao' value='salvar'>";
    echo "<input type='hidden' name='IDpergunta' value='" . $IDpergunta . "'>";

    echo "Pergunta: <input type='text' name='pergunta' value='" . $pergunta . "'>";
    echo "<br><br>";

    echo "<h3>Alternativas (certa: 1 para a correta, 0 para as demais)</h3>";

    echo "<input type='hidden' name='IDresposta1' value='" . $IDresposta1 . "'>";
    echo "Resposta 1: <input type='text' name='resposta1' value='" . $resposta1 . "'>";
    echo " Certa: <input type='text' name='certa1' value='" . $certa1 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta2' value='" . $IDresposta2 . "'>";
    echo "Resposta 2: <input type='text' name='resposta2' value='" . $resposta2 . "'>";
    echo " Certa: <input type='text' name='certa2' value='" . $certa2 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta3' value='" . $IDresposta3 . "'>";
    echo "Resposta 3: <input type='text' name='resposta3' value='" . $resposta3 . "'>";
    echo " Certa: <input type='text' name='certa3' value='" . $certa3 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta4' value='" . $IDresposta4 . "'>";
    echo "Resposta 4: <input type='text' name='resposta4' value='" . $resposta4 . "'>";
    echo " Certa: <input type='text' name='certa4' value='" . $certa4 . "'>";
    echo "<br><br>";

    echo "<input type='submit' value='Salvar Alteração'>";
    echo "</form>";
}

echo "<p>" . $msg . "</p>";
?>

</body>
</html>