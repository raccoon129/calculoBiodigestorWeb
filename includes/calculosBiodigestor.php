<?php
header('Content-Type: application/json');

// Recibir datos del formulario
$numeroAnimales = $_POST['numAnimales'];
$cantidadExcreta = $_POST['excretaDiaria'];
$tiempoResidencia = $_POST['tiempoResidencia'];
$relacionEstiercolAgua = $_POST['relacionEstiercolAgua'];
$alturaCilindro = $_POST['alturaCilindro'];
$alturaPared = $_POST['alturaPared'];

// Realizar cálculos
$excretasTotales = $numeroAnimales * $cantidadExcreta;
$volumenMezcla = (($excretasTotales * $relacionEstiercolAgua) + $excretasTotales) / 1000;
$volumenCilindro = $volumenMezcla * $tiempoResidencia;
$volumenGas = $excretasTotales * 0.035;
$volumenCupula = $volumenCilindro * 0.45;
$radio = sqrt($volumenCilindro / (pi() * $alturaCilindro));
$diametro = $radio * 2;
$alturaCupula = $radio / 3;
$volumenFinal = $volumenCilindro + $volumenCupula;

// Dimensiones de la pared
$alturaParedFinal = 1.5 * $alturaPared;
$anchoPared = 6.4 * $alturaPared;
$largoPared = 10 * $alturaPared;

// Devolver resultados en formato JSON
//$imagen_url = "../includes/generarImagenDimensiones.php?radio=$radio&diametro=$diametro&alturaCupula=$alturaCupula";
$rutaImagen = generarImagenDimensiones($radio, $diametro, $alturaCupula, $alturaCilindro);

function generarImagenDimensiones($radio, $diametro, $alturaCupula, $alturaCilindro) {
    // Ruta de la imagen base
    $imagenBase = '../img/biodigestorLateralGenerar.jpg';

    // Verificar si el archivo existe
    if (!file_exists($imagenBase)) {
        return 'https://placehold.co/600x400'; // URL de marcador de posición si no existe la imagen
    }

    // Crear la imagen desde el archivo (corregido para JPG)
    $imagen = @imagecreatefromjpeg($imagenBase);
    if (!$imagen) {
        return 'no se puede generar la imagen'; // Manejar error si no se puede crear la imagen
    }

    // Color del texto (negro en este caso)
    $colorTexto = imagecolorallocate($imagen, 0, 0, 0);

    // Ruta de la fuente TTF para escribir el texto
    $fuente = '../fonts/TimesNewerRoman-Regular.otf';

    // Verificar si la fuente existe
    if (!file_exists($fuente)) {
        return 'https://placehold.co/600x400'; // URL de marcador de posición si la fuente no existe
    }

    // Redondear los valores a dos decimales
    $radio = number_format($radio, 2);
    $diametro = number_format($diametro, 2);
    $alturaCupula = number_format($alturaCupula, 2);

    // Escribir el texto en la imagen con los valores redondeados
    imagettftext($imagen, 16, 0, 50, 50, $colorTexto, $fuente, "Radio: $radio m");
    imagettftext($imagen, 16, 0, 50, 100, $colorTexto, $fuente, "Diámetro: $diametro m");
    imagettftext($imagen, 16, 0, 50, 150, $colorTexto, $fuente, "Altura Cúpula: $alturaCupula m");

    imagettftext($imagen, 16, 0, 50, 200, $colorTexto, $fuente, "Altura del Cilindro: $alturaCilindro m");

    //Colocar supuerpuesto al esquema
    // - - Horizontal Vertical
    imagettftext($imagen, 30, 0, 650, 500, $colorTexto, $fuente, "$radio m"); //YA está en medio
    imagettftext($imagen, 30, 0, 580, 990, $colorTexto, $fuente, "$diametro m"); //YA está abajo
    imagettftext($imagen, 30, 0, 940, 270, $colorTexto, $fuente, "$alturaCupula m"); //YA está arriba

    imagettftext($imagen, 30, 0, 180, 600, $colorTexto, $fuente, "$alturaCilindro m"); //YA está en medio


    
    //Acá falta otro valor para la medida de la izquierda

    // Guardar la imagen generada
    $rutaImagenGenerada = '../tmp/temporalDimensionesBiodigestorGeneradasPlano.png';
    imagepng($imagen, $rutaImagenGenerada);

    // Liberar memoria
    imagedestroy($imagen);

    return $rutaImagenGenerada;
}





echo json_encode(array(
    "excretasTotales" => number_format($excretasTotales, 2),
    "volumenMezcla" => number_format($volumenMezcla, 2),
    "volumenCilindro" => number_format($volumenCilindro, 2),
    "volumenGas" => number_format($volumenGas, 2),
    "volumenCupula" => number_format($volumenCupula, 2),
    "radio" => number_format($radio, 2),
    "diametro" => number_format($diametro, 2),
    "alturaCupula" => number_format($alturaCupula, 2),
    "volumenFinal" => number_format($volumenFinal, 2),
    "alturaPared" => number_format($alturaParedFinal, 2),
    "anchoPared" => number_format($anchoPared, 2),
    "largoPared" => number_format($largoPared, 2),
    "imagen_url" => $rutaImagen
));

?>
