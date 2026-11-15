<?php

$IDpergunta = $_GET["IDpergunta"];

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

        if($coluna[0] != $IDpergunta)
        {
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

while(!feof($arqRESPOSTA))
{
    $linha = fgets($arqRESPOSTA);

    if($linha != "")
    {
        $coluna = explode(";", $linha);

        if($coluna[1] != $IDpergunta)
        {
            fwrite($arqRESPOSTANovo, $linha);
        }
    }
}
fclose($arqRESPOSTA);
fclose($arqRESPOSTANovo);
rename("respostaNovo.txt", "resposta.txt");

echo "Pergunta e respostas excluídas com sucesso!!!";

?>