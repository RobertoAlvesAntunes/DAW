<?php

$acao = $_GET["acao"];

if($acao == "incluir")
{
    $IDusuario = $_GET["IDusuario"];
    $nome = $_GET["nome"];
    $email = $_GET["email"];
    $senha = $_GET["senha"];

    if(!file_exists("usuario.txt"))
    {
        $arqUSUARIO = fopen("usuario.txt", "w") or die("Erro ao criar arquivo");
        fwrite($arqUSUARIO, "IDusuario;nome;email;senha\n");
        fclose($arqUSUARIO);
    }

    $arqUSUARIO = fopen("usuario.txt", "a") or die("Erro ao abrir arquivo");
    fwrite($arqUSUARIO, $IDusuario . ";" . $nome . ";" . $email . ";" . $senha . "\n");
    fclose($arqUSUARIO);

    echo "<p>Usuário incluído com sucesso!!!</p>";
}
else if($acao == "buscar")
{
    $IDusuario = $_GET["IDusuario"];

    $nome = "";
    $email = "";
    $senha = "";
    $encontrou = "nao";

    $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqUSUARIO);

    while(!feof($arqUSUARIO))
    {
        $linha = fgets($arqUSUARIO);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] == $IDusuario)
            {
                $nome = $coluna[1];
                $email = $coluna[2];
                $senha = $coluna[3];
                $encontrou = "sim";
            }
        }
    }
    fclose($arqUSUARIO);

    if($encontrou == "sim")
    {
        echo "<p>Usuário encontrado!</p>";

        echo "<h3>Editar Usuario</h3>";

        echo "<input type='hidden' name='IDusuarioEditar' id='IDusuarioEditar' value='" . $IDusuario . "'>";

        echo "Nome: <input type='text' name='nomeEditar' id='nomeEditar' value='" . $nome . "'>";
        echo "<br><br>";

        echo "Email: <input type='text' name='emailEditar' id='emailEditar' value='" . $email . "'>";
        echo "<br><br>";

        echo "Senha: <input type='text' name='senhaEditar' id='senhaEditar' value='" . $senha . "'>";
        echo "<br><br>";

        echo "<input type='button' value='Salvar Alteração' onclick='Salvar()'>";
    }
    else
    {
        echo "<p>Usuário não encontrado.</p>";
    }
}
else if($acao == "salvar")
{
    $IDusuario = $_GET["IDusuario"];
    $novoNome = $_GET["nome"];
    $novoEmail = $_GET["email"];
    $novaSenha = $_GET["senha"];

    $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
    $arqUSUARIONovo = fopen("usuarioNovo.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqUSUARIO);
    fwrite($arqUSUARIONovo, $linha);

    while(!feof($arqUSUARIO))
    {
        $linha = fgets($arqUSUARIO);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] == $IDusuario)
            {
                $linha = $IDusuario . ";" . $novoNome . ";" . $novoEmail . ";" . $novaSenha . "\n";
            }

            fwrite($arqUSUARIONovo, $linha);
        }
    }
    fclose($arqUSUARIO);
    fclose($arqUSUARIONovo);
    rename("usuarioNovo.txt", "usuario.txt");

    echo "<p>Usuário alterado com sucesso!!!</p>";
}
else if($acao == "excluir")
{
    $IDusuario = $_GET["IDusuario"];

    $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
    $arqUSUARIONovo = fopen("usuarioNovo.txt", "w") or die("Erro ao criar arquivo");

    $linha = fgets($arqUSUARIO);
    fwrite($arqUSUARIONovo, $linha);

    while(!feof($arqUSUARIO))
    {
        $linha = fgets($arqUSUARIO);

        if($linha != "")
        {
            $coluna = explode(";", $linha);

            if($coluna[0] != $IDusuario)
            {
                fwrite($arqUSUARIONovo, $linha);
            }
        }
    }
    fclose($arqUSUARIO);
    fclose($arqUSUARIONovo);
    rename("usuarioNovo.txt", "usuario.txt");

    echo "<p>Usuário excluído com sucesso!!!</p>";
}
else if($acao == "listar")
{
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>IDusuario</th>";
    echo "<th>Nome</th>";
    echo "<th>Email</th>";
    echo "<th>Senha</th>";
    echo "</tr>";

    if(file_exists("usuario.txt"))
    {
        $arqListar = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqListar);

        while(!feof($arqListar))
        {
            $linha = fgets($arqListar);

            if($linha != "")
            {
                $coluna = explode(";", $linha);

                echo "<tr>";
                echo "<td>" . $coluna[0] . "</td>";
                echo "<td>" . $coluna[1] . "</td>";
                echo "<td>" . $coluna[2] . "</td>";
                echo "<td>" . $coluna[3] . "</td>";
                echo "</tr>";
            }
        }
        fclose($arqListar);
    }

    echo "</table>";
}

?>