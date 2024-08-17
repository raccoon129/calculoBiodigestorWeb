<?php
// Archivo: calculosBiodigestor.php

// Función para calcular el volumen del biodigestor
function calcularVolumen($excretaDiaria, $tipoResidencia, $relacionEstiercolAgua, $alturaCilindro, $alturaPared) {
    // Fórmula simple de ejemplo: este cálculo puede cambiar dependiendo de la lógica real.
    // La idea aquí es ilustrar cómo recibir y usar los parámetros.
    $volumen = ($excretaDiaria + $tipoResidencia + $relacionEstiercolAgua) * ($alturaCilindro + $alturaPared);
    return round($volumen, 2); // Redondeamos a dos decimales
}

// Función para calcular el área del biodigestor
function calcularArea($alturaCilindro, $alturaPared) {
    // Otra fórmula de ejemplo para el área
    $area = ($alturaCilindro * $alturaPared) * 3.14; // Ejemplo usando π (pi)
    return round($area, 2);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $excretaDiaria = $_POST['excretaDiaria'];
    $tipoResidencia = $_POST['tipoResidencia'];
    $relacionEstiercolAgua = $_POST['relacionEstiercolAgua'];
    $alturaCilindro = $_POST['alturaCilindro'];
    $alturaPared = $_POST['alturaPared'];

    // Realizar cálculos llamando a las funciones
    $volumen = calcularVolumen($excretaDiaria, $tipoResidencia, $relacionEstiercolAgua, $alturaCilindro, $alturaPared);
    $area = calcularArea($alturaCilindro, $alturaPared);

    // Devolver los resultados como JSON
    echo json_encode([
        'volumen' => $volumen,
        'area' => $area
    ]);
}
?>
