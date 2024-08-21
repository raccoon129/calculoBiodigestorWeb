<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $numeroCerdos = (int) $_POST['numeroCerdos'];
    $numeroExcreta = (float) $_POST['numeroExcreta'];
    $numeroRelacion = (float) $_POST['numeroRelacion'];
    $numeroTResidencia = (float) $_POST['numeroTResidencia'];
    $hCil = (float) $_POST['alturaCilindro'];
    $paredBolsa = (float) $_POST['paredBolsa'];

    // Cálculos basados en las fórmulas proporcionadas
    $excretasTotales = $numeroCerdos * $numeroExcreta;
    $volumenMezcla = $excretasTotales * $numeroRelacion;
    $volumenDigestor = $volumenMezcla * $numeroTResidencia;
    $volumenGas = $volumenDigestor * 0.6;
    $volumenCupula = $volumenGas * 0.6;

    $radio = sqrt($volumenDigestor / (pi() * $hCil));
    $diametro = 2 * $radio;
    $alturaCupula = $diametro / 4;
    $volumenFinal = $volumenCupula + $volumenDigestor;

    $alturaParedBolsa = ($volumenFinal - $volumenDigestor) / ($diametro * $hCil);
    $anchoBolsa = $diametro;
    $largoBolsa = $volumenFinal / ($anchoBolsa * $alturaParedBolsa);

    // Crear un array con los resultados
    $resultados = [
        'excretasTotales' => $excretasTotales,
        'volumenMezcla' => $volumenMezcla,
        'volumenDigestor' => $volumenDigestor,
        'volumenGas' => $volumenGas,
        'volumenCupula' => $volumenCupula,
        'radio' => $radio,
        'diametro' => $diametro,
        'alturaCupula' => $alturaCupula,
        'volumenFinal' => $volumenFinal,
        'alturaParedBolsa' => $alturaParedBolsa,
        'anchoBolsa' => $anchoBolsa,
        'largoBolsa' => $largoBolsa
    ];

    // Devolver el resultado en formato JSON
    header('Content-Type: application/json');
    echo json_encode($resultados);
}
