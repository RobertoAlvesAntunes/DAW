
<?php

$v1 = $_GET["a"];
$v2 = $_GET["b"];
$op = $_GET["op"];

if($op == "+")
{
    $result = $v1 + $v2;
}
else if($op == "-")
{
    $result = $v1 - $v2;
}
else if($op == "*")
{
    $result = $v1 * $v2;
}
else if($op == "/")
{
    $result = $v1 / $v2;
}
else
{
    $result = "Operador inválido!";
}

?>

<h1>Resultado: <?php echo $result; ?></h1>
