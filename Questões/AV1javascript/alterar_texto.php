<?php

$acao = $_GET["acao"];
$IDpergunta = $_GET["IDpergunta"];

$pergunta = "";
$IDresposta = "";
$resposta = "";

if($acao == "buscar")
{
    $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqPERGUNTA);

    while(!feof($arqPERGUNTA))
    {
        $linha = fgets($arqPERGUNTA);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] == $IDpergunta)
            {
                $pergunta = $coluna[1];
            }
        }
    }
    fclose($arqPERGUNTA);

    $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqRESPOSTA);

    while(!feof($arqRESPOSTA))
    {
        $linha = fgets($arqRESPOSTA);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[1] == $IDpergunta)
            {
                $IDresposta = $coluna[0];
                $resposta = $coluna[2];
            }
        }
    }
    fclose($arqRESPOSTA);

    echo "<h2>Editar Pergunta</h2>";

    echo "<input type='hidden' name='IDresposta' id='IDresposta' value='" . $IDresposta . "'>";

    echo "Pergunta: <input type='text' name='pergunta' id='pergunta' value='" . $pergunta . "'>";
    echo "<br><br>";

    echo "Resposta correta: <input type='text' name='resposta' id='resposta' value='" . $resposta . "'>";
    echo "<br><br>";

    echo "<input type='button' value='Salvar Alteração' onclick='Salvar()'>";
}
else if($acao == "salvar")
{
    $novaPergunta = $_GET["pergunta"];
    $IDresposta = $_GET["IDresposta"];
    $novaResposta = $_GET["resposta"];

    $arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
    $arqPERGUNTANovo = fopen("perguntaNovo.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqPERGUNTA);
    fwrite($arqPERGUNTANovo, $linha);

    while(!feof($arqPERGUNTA))
    {
        $linha = fgets($arqPERGUNTA);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] == $IDpergunta)
            {
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

    while(!feof($arqRESPOSTA))
    {
        $linha = fgets($arqRESPOSTA);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] == $IDresposta)
            {
                $linha = $IDresposta . ";" . $IDpergunta . ";" . $novaResposta . ";" . "1" . "\n";
            }

            fwrite($arqRESPOSTANovo, $linha);
        }
    }
    fclose($arqRESPOSTA);
    fclose($arqRESPOSTANovo);
    rename("respostaNovo.txt", "resposta.txt");

    echo "<h2>Pergunta de texto alterada com sucesso!!!</h2>";
}

?>