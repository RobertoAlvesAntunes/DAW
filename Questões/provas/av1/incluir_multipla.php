<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pergunta = $_POST ["pergunta"];
    $IDpergunta = $_POST ["IDpergunta"];
    $IDresposta = $_POST ["IDresposta"];
    $resposta = $_POST ["resposta"];
    $certa = $_POST ["certa"];

    if (!file_exists("pergunta.txt")){
        $arqPERGUNTA = fopen ("pergunta.txt", "w") or die ("Erro ao criar arquivo");
        $linha = "IDpergunta;pergunta\n";
        fwrite ($arqPERGUNTA, $linha);
        fclose($arqPERGUNTA);
    }

    if (!file_exists("resposta.txt")){
        $arqRESPOSTA = fopen ("resposta.txt", "w") or die ("Erro ao criar arquivo");
        $linha1 = "IDresposta;IDpergunta;resposta;certa\n";
        fwrite ($arqRESPOSTA, $linha1);
        fclose ($arqRESPOSTA);
    }

    $arqPERGUNTA = fopen ("pergunta.txt", "a") or die ("Erro ao criar arquivo");
    $linha = $IDpergunta . ";" . $pergunta . "\n";

    $arqRESPOSTA = fopen ("resposta.txt", "a") or die ("Erro ao criar arquivo");
    $linha1 = $IDresposta . ";" . $IDpergunta . ";" . $resposta . ";" . $certa . "\n";

    fwrite ($arqPERGUNTA, $linha);
    fclose($arqPERGUNTA);

    fwrite ($arqRESPOSTA, $linha1);
    fclose($arqRESPOSTA);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Multiplas</title>
</head>
<body>
    <h1>Perguntas Multiplas</h1>

    <form action = "pergunta_multipla.php" method = "POST">
        IDpergunta: <input type = "text" name = "IDpergunta">
        <br><br>
        pergunta: <input type = "text" name = "pergunta">
        <br><br>
        <input type = "submit" value = "incluir">                
    </form>

    <form action = "pergunta_multipla.php" method = "POST">
        IDresposta: <input type = "text" name = "IDresposta">
        <br><br>
        IDpergunta: <input type = "text" name = "IDpergunta">
        <br><br>
        resposta <input type = "text" name = "resposta">
        <br><br>
        certa: <input type = "text" name = "certa">
        <br><br>
        <input type = "submit" value = "incluir">                
    </form>
</body>
</html>