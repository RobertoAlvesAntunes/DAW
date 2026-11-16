<?php
$IDusuario = "";
$nome = "";
$email = "";
$senha = "";

$msg = "";
$encontrou = "nao";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $acao = $_POST["acao"];

    if ($acao == "incluir") {

        $IDusuario = $_POST["IDusuario"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        if (!file_exists("usuario.txt")) {
            $arqUSUARIO = fopen("usuario.txt", "w") or die("Erro ao criar arquivo");
            fwrite($arqUSUARIO, "IDusuario;nome;email;senha\n");
            fclose($arqUSUARIO);
        }

        $arqUSUARIO = fopen("usuario.txt", "a") or die("Erro ao abrir arquivo");
        fwrite($arqUSUARIO, $IDusuario . ";" . $nome . ";" . $email . ";" . $senha . "\n");
        fclose($arqUSUARIO);

        $msg = "Usuário incluído com sucesso!!!";

        $IDusuario = "";
        $nome = "";
        $email = "";
        $senha = "";
    }

    if ($acao == "buscar") {

        $IDusuario = $_POST["IDusuario"];

        $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
        $linha = fgets($arqUSUARIO);

        while (!feof($arqUSUARIO)) {
            $linha = fgets($arqUSUARIO);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] == $IDusuario) {
                    $nome = $coluna[1];
                    $email = $coluna[2];
                    $senha = $coluna[3];
                    $encontrou = "sim";
                }
            }
        }
        fclose($arqUSUARIO);

        if ($encontrou == "sim") {
            $msg = "Usuário encontrado!";
        } else {
            $msg = "Usuário não encontrado.";
        }
    }

    if ($acao == "salvar") {

        $IDusuario = $_POST["IDusuario"];
        $novoNome = $_POST["nome"];
        $novoEmail = $_POST["email"];
        $novaSenha = $_POST["senha"];

        $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
        $arqUSUARIONovo = fopen("usuarioNovo.txt", "w") or die("Erro ao criar arquivo");

        $linha = fgets($arqUSUARIO);
        fwrite($arqUSUARIONovo, $linha);

        while (!feof($arqUSUARIO)) {
            $linha = fgets($arqUSUARIO);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] == $IDusuario) {
                    $linha = $IDusuario . ";" . $novoNome . ";" . $novoEmail . ";" . $novaSenha . "\n";
                }

                fwrite($arqUSUARIONovo, $linha);
            }
        }
        fclose($arqUSUARIO);
        fclose($arqUSUARIONovo);
        rename("usuarioNovo.txt", "usuario.txt");

        $msg = "Usuário alterado com sucesso!!!";
        $encontrou = "nao";
    }

    if ($acao == "excluir") {

        $IDusuario = $_POST["IDusuario"];

        $arqUSUARIO = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
        $arqUSUARIONovo = fopen("usuarioNovo.txt", "w") or die("Erro ao criar arquivo");

        $linha = fgets($arqUSUARIO);
        fwrite($arqUSUARIONovo, $linha);

        while (!feof($arqUSUARIO)) {
            $linha = fgets($arqUSUARIO);

            if ($linha != "") {
                $coluna = explode(";", $linha);

                if ($coluna[0] != $IDusuario) {
                    fwrite($arqUSUARIONovo, $linha);
                }
            }
        }
        fclose($arqUSUARIO);
        fclose($arqUSUARIONovo);
        rename("usuarioNovo.txt", "usuario.txt");

        $msg = "Usuário excluído com sucesso!!!";
        $IDusuario = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuario</title>
</head>
<body>
    <h1>CRUD Usuario</h1>

    <p><?php echo $msg ?></p>

    <h2>Incluir Usuario</h2>
    <form action="crud_usuario.php" method="POST">
        <input type="hidden" name="acao" value="incluir">
        IDusuario: <input type="text" name="IDusuario">
        <br><br>
        Nome: <input type="text" name="nome">
        <br><br>
        Email: <input type="text" name="email">
        <br><br>
        Senha: <input type="text" name="senha">
        <br><br>
        <input type="submit" value="Incluir">
    </form>

    <br>

    <h2>Buscar Usuario para Alterar</h2>
    <form action="crud_usuario.php" method="POST">
        <input type="hidden" name="acao" value="buscar">
        IDusuario: <input type="text" name="IDusuario">
        <br><br>
        <input type="submit" value="Buscar">
    </form>

<?php
if ($encontrou == "sim") {

    echo "<h3>Editar Usuario</h3>";

    echo "<form action='crud_usuario.php' method='POST'>";
    echo "<input type='hidden' name='acao' value='salvar'>";
    echo "<input type='hidden' name='IDusuario' value='" . $IDusuario . "'>";

    echo "Nome: <input type='text' name='nome' value='" . $nome . "'>";
    echo "<br><br>";

    echo "Email: <input type='text' name='email' value='" . $email . "'>";
    echo "<br><br>";

    echo "Senha: <input type='text' name='senha' value='" . $senha . "'>";
    echo "<br><br>";

    echo "<input type='submit' value='Salvar Alteração'>";
    echo "</form>";
}
?>

    <br>

    <h2>Excluir Usuario</h2>
    <form action="crud_usuario.php" method="POST">
        <input type="hidden" name="acao" value="excluir">
        IDusuario: <input type="text" name="IDusuario">
        <br><br>
        <input type="submit" value="Excluir">
    </form>

    <br>

    <h2>Listar Usuarios</h2>
    <table border="1">
        <tr>
            <th>IDusuario</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha</th>
        </tr>

<?php
if (file_exists("usuario.txt")) {

    $arqListar = fopen("usuario.txt", "r") or die("Erro ao abrir arquivo");
    $linha = fgets($arqListar);

    while (!feof($arqListar)) {
        $linha = fgets($arqListar);

        if ($linha != "") {
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
?>

    </table>

</body>
</html>