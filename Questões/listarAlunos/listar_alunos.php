<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h1>Listar Alunos</h1>

<table>
    <tr>
        <th>Matricula</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

<?php

$arqAlun = fopen("aluno.txt","r") or die("erro ao abrir arquivo");

$linha = fgets($arqAlun);

while(!feof($arqAlun)) {
    $linha = fgets($arqAlun);
    $colunaDados = explode(";", $linha);

    echo "<tr><td>" . $colunaDados[2] . "</td>" .
        "<td>" . $colunaDados[0] . "</td>" .
        "<td>" . $colunaDados[1] . "</td>" .
        "<td>" .
        "<form action='alterar_aluno.php' method='POST'>" .
        "<input type='hidden' name='matricula' value='" . $colunaDados[2] . "'>" .
        "<input type='submit' value='Alterar'>" .
        "</form>" .
        "<form action='excluir_aluno.php' method='POST'>" .
        "<input type='hidden' name='matricula' value='" . $colunaDados[2] . "'>" .
        "<input type='submit' value='Excluir'>" .
        "</form>" .
        "</td></tr>";
}

fclose($arqAlun);

?>

</table>

<br>

</body>
</html>