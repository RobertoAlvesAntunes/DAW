<?php
$msg = " ";
if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $nome = $_POST["nome"];
        $matricula_busca = $_POST["matricula_busca"];        
        $cpf = $_POST["cpf"];
        $endereço = $_POST["endereço"];

        $arqdisc = fopen("professor.txt", "r") or die ("erro ao abrir o arquivo");
        $arqdiscnovo = fopen("professornovo.txt", "w") or die ("erro ao abrir o arquivo");
        $linha = fgets($arqdisc);
        fwrite($arqdiscnovo, $linha);

        while(!feof($arqdisc))
            {
                $linha = fgets($arqdisc);
                if($linha != " "){
                    $coluna = explode(";", $linha);
                    if($coluna [2] == $matricula_busca){
                        $linha = $nome.";".$matricula_busca.";".$cpf.";".$endereço."\n";
                    }

                    fwrite($arqdiscnovo, $linha);
                }

            }
            fclose($arqdisc);
            fclose($arqdiscnovo);

            rename("professornovo.txt", "professor.txt");

            $msg = "Deu tudo Ok!";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alterar Disc</h1>
    <form action="alterar.php" method="POST">
        Matricula do Professor que deseja alterar : <input type="text" name="matricula_busca">
        <br></br>
        Novo Nome: <input type="text" name="nome">
        <br></br>
        Novo Cpf : <input type="text" name="cpf">
        <br></br>
        Novo Endereço : <input type="text" name="endereço">
        <br></br>
        <input type="submit" value="alterarProfessor">
    </form>

    <h1><?php echo $msg ?></h1>
</body>
</html>


    