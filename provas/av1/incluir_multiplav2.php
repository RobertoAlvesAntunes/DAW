<?php

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tipo = $_POST["tipo"];

    if ($tipo == "pergunta") {
        $IDpergunta = $_POST["IDpergunta"];
        $pergunta = $_POST["pergunta"];

        if (!file_exists("pergunta.txt")) {
            $arqPERGUNTA = fopen("pergunta.txt", "w") or die("Erro ao criar arquivo");
            fwrite($arqPERGUNTA, "IDpergunta;pergunta\n");
            fclose($arqPERGUNTA);
        }

        $arqPERGUNTA = fopen("pergunta.txt", "a") or die("Erro ao abrir arquivo");
        fwrite($arqPERGUNTA, $IDpergunta . ";" . $pergunta . "\n");
        fclose($arqPERGUNTA);

        $msg = "Pergunta incluída com sucesso!!!";
    }

    if ($tipo == "resposta") {
        $IDresposta = $_POST["IDresposta"];
        $IDpergunta = $_POST["IDpergunta"];
        $resposta = $_POST["resposta"];
        $certa = $_POST["certa"];

        if (!file_exists("resposta.txt")) {
            $arqRESPOSTA = fopen("resposta.txt", "w") or die("Erro ao criar arquivo");
            fwrite($arqRESPOSTA, "IDresposta;IDpergunta;resposta;certa\n");
            fclose($arqRESPOSTA);
        }

        $arqRESPOSTA = fopen("resposta.txt", "a") or die("Erro ao abrir arquivo");
        fwrite($arqRESPOSTA, $IDresposta . ";" . $IDpergunta . ";" . $resposta . ";" . $certa . "\n");
        fclose($arqRESPOSTA);

        $msg = "Resposta incluída com sucesso!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Multiplas (corrigido)</title>
</head>
<body>
    <h1>Perguntas Multiplas</h1>

    <form action="incluir_multipla.php" method="POST">
        <input type="hidden" name="tipo" value="pergunta">
        IDpergunta: <input type="text" name="IDpergunta">
        <br><br>
        Pergunta: <input type="text" name="pergunta">
        <br><br>
        <input type="submit" value="incluir pergunta">
    </form>

    <br>

    <form action="incluir_multipla.php" method="POST">
        <input type="hidden" name="tipo" value="resposta">
        IDresposta: <input type="text" name="IDresposta">
        <br><br>
        IDpergunta: <input type="text" name="IDpergunta">
        <br><br>
        Resposta: <input type="text" name="resposta">
        <br><br>
        Certa (1 = sim, 0 = não): <input type="text" name="certa">
        <br><br>
        <input type="submit" value="incluir resposta">
    </form>

    <p><?php echo $msg ?></p>

</body>
</html>