<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $numeroCerdos = (int) $_POST['numeroCerdos'];
    $numeroExcreta = (float) $_POST['numeroExcreta'];
    $numeroRelacion = (float) $_POST['numeroRelacion'];
    $numeroTResidencia = (float) $_POST['numeroTResidencia'];
    $hCil = (float) $_POST['alturaCilindro'];
    $paredBolsa = (float) $_POST['paredBolsa'];

    // Cálculos
    $excretasTotales = $numeroCerdos * $numeroExcreta;
    $volumenMezcla = round((($excretasTotales * $numeroRelacion) + $excretasTotales) / 1000, 2);
    $volumenDigestor = round($volumenMezcla * $numeroTResidencia, 2);
    $volumenGas = round($excretasTotales * 0.035, 2);
    $volumenCupula = round($volumenDigestor * 0.45, 2);
    $radio = round(sqrt($volumenDigestor / (M_PI * $hCil)), 2);
    $diametro = round($radio * 2, 2);
    $alturaCupula = round($radio / 3, 2);
    $volumenFinal = round($volumenDigestor + $volumenCupula, 2);
    $alturaParedBolsa = round(1.5 * $paredBolsa, 2);
    $anchoBolsa = round(6.4 * $paredBolsa, 2);
    $largoBolsa = round(10 * $paredBolsa, 2);

    // Devolver los resultados como JSON
    echo json_encode([
        "excretasTotales" => $excretasTotales,
        "volumenMezcla" => $volumenMezcla,
        "volumenDigestor" => $volumenDigestor,
        "volumenGas" => $volumenGas,
        "volumenCupula" => $volumenCupula,
        "radio" => $radio,
        "diametro" => $diametro,
        "alturaCupula" => $alturaCupula,
        "volumenFinal" => $volumenFinal,
        "alturaParedBolsa" => $alturaParedBolsa,
        "anchoBolsa" => $anchoBolsa,
        "largoBolsa" => $largoBolsa
    ]);
}
?>
