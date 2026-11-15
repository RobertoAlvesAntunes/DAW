<?php

$acao = $_GET["acao"];
$IDpergunta = $_GET["IDpergunta"];

$pergunta = "";

$IDresposta1 = ""; $resposta1 = ""; $certa1 = "";
$IDresposta2 = ""; $resposta2 = ""; $certa2 = "";
$IDresposta3 = ""; $resposta3 = ""; $certa3 = "";
$IDresposta4 = ""; $resposta4 = ""; $certa4 = "";

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

    $contador = 0;

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
                $contador = $contador + 1;

                if($contador == 1)
                {
                    $IDresposta1 = $coluna[0];
                    $resposta1 = $coluna[2];
                    $certa1 = $coluna[3];
                }
                if($contador == 2)
                {
                    $IDresposta2 = $coluna[0];
                    $resposta2 = $coluna[2];
                    $certa2 = $coluna[3];
                }
                if($contador == 3)
                {
                    $IDresposta3 = $coluna[0];
                    $resposta3 = $coluna[2];
                    $certa3 = $coluna[3];
                }
                if($contador == 4)
                {
                    $IDresposta4 = $coluna[0];
                    $resposta4 = $coluna[2];
                    $certa4 = $coluna[3];
                }
            }
        }
    }
    fclose($arqRESPOSTA);

    echo "<h2>Editar Pergunta</h2>";

    echo "Pergunta: <input type='text' name='pergunta' id='pergunta' value='" . $pergunta . "'>";
    echo "<br><br>";

    echo "<h3>Alternativas (certa: 1 para a correta, 0 para as demais)</h3>";

    echo "<input type='hidden' name='IDresposta1' id='IDresposta1' value='" . $IDresposta1 . "'>";
    echo "Resposta 1: <input type='text' name='resposta1' id='resposta1' value='" . $resposta1 . "'>";
    echo " Certa: <input type='text' name='certa1' id='certa1' value='" . $certa1 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta2' id='IDresposta2' value='" . $IDresposta2 . "'>";
    echo "Resposta 2: <input type='text' name='resposta2' id='resposta2' value='" . $resposta2 . "'>";
    echo " Certa: <input type='text' name='certa2' id='certa2' value='" . $certa2 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta3' id='IDresposta3' value='" . $IDresposta3 . "'>";
    echo "Resposta 3: <input type='text' name='resposta3' id='resposta3' value='" . $resposta3 . "'>";
    echo " Certa: <input type='text' name='certa3' id='certa3' value='" . $certa3 . "'>";
    echo "<br><br>";

    echo "<input type='hidden' name='IDresposta4' id='IDresposta4' value='" . $IDresposta4 . "'>";
    echo "Resposta 4: <input type='text' name='resposta4' id='resposta4' value='" . $resposta4 . "'>";
    echo " Certa: <input type='text' name='certa4' id='certa4' value='" . $certa4 . "'>";
    echo "<br><br>";

    echo "<input type='button' value='Salvar Alteração' onclick='Salvar()'>";
}
else if($acao == "salvar")
{
    $novaPergunta = $_GET["pergunta"];

    $IDresposta1 = $_GET["IDresposta1"];
    $resposta1 = $_GET["resposta1"];
    $certa1 = $_GET["certa1"];

    $IDresposta2 = $_GET["IDresposta2"];
    $resposta2 = $_GET["resposta2"];
    $certa2 = $_GET["certa2"];

    $IDresposta3 = $_GET["IDresposta3"];
    $resposta3 = $_GET["resposta3"];
    $certa3 = $_GET["certa3"];

    $IDresposta4 = $_GET["IDresposta4"];
    $resposta4 = $_GET["resposta4"];
    $certa4 = $_GET["certa4"];

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
            $IDatual = $coluna[0];

            if($IDatual == $IDresposta1)
            {
                $linha = $IDresposta1 . ";" . $IDpergunta . ";" . $resposta1 . ";" . $certa1 . "\n";
            }
            if($IDatual == $IDresposta2)
            {
                $linha = $IDresposta2 . ";" . $IDpergunta . ";" . $resposta2 . ";" . $certa2 . "\n";
            }
            if($IDatual == $IDresposta3)
            {
                $linha = $IDresposta3 . ";" . $IDpergunta . ";" . $resposta3 . ";" . $certa3 . "\n";
            }
            if($IDatual == $IDresposta4)
            {
                $linha = $IDresposta4 . ";" . $IDpergunta . ";" . $resposta4 . ";" . $certa4 . "\n";
            }

            fwrite($arqRESPOSTANovo, $linha);
        }
    }
    fclose($arqRESPOSTA);
    fclose($arqRESPOSTANovo);
    rename("respostaNovo.txt", "resposta.txt");

    echo "<h2>Pergunta e respostas alteradas com sucesso!!!</h2>";
}

?>