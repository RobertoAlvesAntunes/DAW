<?php
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $IDpergunta = $_POST["IDpergunta"];

    $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
    $arqPERGUNTANovo = fopen("perguntaNovo.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqPERGUNTA);
    fwrite($arqPERGUNTANovo, $linha);

    while (!feof($arqPERGUNTA)) {
        $linha = fgets($arqPERGUNTA);

        if ($linha != "") {
            $coluna = explode(";", $linha);

            if ($coluna[0] != $IDpergunta) {
                fwrite($arqPERGUNTANovo, $linha);
            }
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

            if ($coluna[1] != $IDpergunta) {
                fwrite($arqRESPOSTANovo, $linha);
            }
        }
    }
    fclose($arqRESPOSTA);
    fclose($arqRESPOSTANovo);
    rename("respostaNovo.txt", "resposta.txt");

    $msg = "Pergunta e respostas excluídas com sucesso!!!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pergunta</title>
</head>
<body>
    <h1>Excluir Pergunta</h1>

    <form action="excluir_pergunta.php" method="POST">
        IDpergunta a excluir: <input type="text" name="IDpergunta">
        <br><br>
        <input type="submit" value="Excluir">
    </form>

    <p><?php echo $msg ?></p>

</body>
</html>