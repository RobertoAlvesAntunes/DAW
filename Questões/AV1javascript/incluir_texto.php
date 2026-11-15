<?php

$acao = $_GET["acao"];

if($acao == "incluirPergunta")
{
    $IDpergunta = $_GET["IDpergunta"];
    $pergunta = $_GET["pergunta"];

    if(!file_exists("pergunta.txt"))
    {
        $arqPERGUNTA = fopen("pergunta.txt", "w") or die("Erro ao criar arquivo");
        fwrite($arqPERGUNTA, "IDpergunta;pergunta\n");
        fclose($arqPERGUNTA);
    }

    $arqPERGUNTA = fopen("pergunta.txt", "a") or die("Erro ao abrir arquivo");
    fwrite($arqPERGUNTA, $IDpergunta . ";" . $pergunta . "\n");
    fclose($arqPERGUNTA);

    echo "Pergunta incluída com sucesso!!!";
}
else if($acao == "incluirResposta")
{
    $IDresposta = $_GET["IDresposta"];
    $IDpergunta = $_GET["IDpergunta"];
    $resposta = $_GET["resposta"];

    if(!file_exists("resposta.txt"))
    {
        $arqRESPOSTA = fopen("resposta.txt", "w") or die("Erro ao criar arquivo");
        fwrite($arqRESPOSTA, "IDresposta;IDpergunta;resposta;certa\n");
        fclose($arqRESPOSTA);
    }

    $arqRESPOSTA = fopen("resposta.txt", "a") or die("Erro ao abrir arquivo");
    fwrite($arqRESPOSTA, $IDresposta . ";" . $IDpergunta . ";" . $resposta . ";" . "1" . "\n");
    fclose($arqRESPOSTA);

    echo "Resposta incluída com sucesso!!!";
}

?>