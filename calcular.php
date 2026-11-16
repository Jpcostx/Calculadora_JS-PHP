<?php
header('Content-Type: application/json; charset=utf-8');

$jsonRecebido = file_get_contents('php://input');
$dados = json_decode($jsonRecebido, true);

if (!isset($dados['num1'], $dados['num2'], $dados['operacao']) || 
    !is_numeric($dados['num1']) || !is_numeric($dados['num2'])) {
    echo json_encode(['erro' => 'Preencha ambos os campos com números válidos.']);
    exit;
}

$num1 = (float) $dados['num1'];
$num2 = (float) $dados['num2'];
$operacao = $dados['operacao'];
$resultado = 0;

switch ($operacao) {
    case 'soma':
        $resultado = $num1 + $num2;
        break;
    case 'subtracao':
        $resultado = $num1 - $num2;
        break;
    case 'multiplicacao':
        $resultado = $num1 * $num2;
        break;
    case 'divisao':
        if ($num2 == 0) {
            echo json_encode(['erro' => 'Divisão por zero não é permitida.']);
            exit;
        }
        $resultado = $num1 / $num2;
        break;
    default:
        echo json_encode(['erro' => 'Operação inválida.']);
        exit;
}

echo json_encode(['resultado' => $resultado]);