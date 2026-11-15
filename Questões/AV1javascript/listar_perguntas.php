<?php

$arqPERGUNTA = fopen("pergunta.txt", "r") or die("Erro ao abrir arquivo");
$linha = fgets($arqPERGUNTA);

while(!feof($arqPERGUNTA))
{
    $linha = fgets($arqPERGUNTA);

    if($linha != "")
    {
        $coluna = explode(";", $linha);
        $IDpergunta = $coluna[0];
        $pergunta = $coluna[1];

        echo "<h3>" . $pergunta . "</h3>";
        echo "<p>IDpergunta: " . $IDpergunta . "</p>";
        echo "<ul>";

        $arqRESPOSTA = fopen("resposta.txt", "r") or die("Erro ao abrir arquivo");
        $linhaResp = fgets($arqRESPOSTA);

        while(!feof($arqRESPOSTA))
        {
            $linhaResp = fgets($arqRESPOSTA);

            if($linhaResp != "")
            {
                $colunaResp = explode(";", $linhaResp);

                if($colunaResp[1] == $IDpergunta)
                {
                    $resposta = $colunaResp[2];
                    $certa = $colunaResp[3];

                    echo "<li>" . $resposta . " (certa: " . $certa . ")</li>";
                }
            }
        }
        fclose($arqRESPOSTA);

        echo "</ul>";
        echo "<hr>";
    }
}
fclose($arqPERGUNTA);

?>