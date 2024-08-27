<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Biodigestores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .two-columns {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .column {
            flex: 1;
            min-width: 300px;
        }

        .tooltip-inner {
            max-width: 350px;
            white-space: normal;
        }

        .results-table {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="accordion" id="accordionExample">
            <!-- Acordeón para Ingresar Datos -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Ingresar Datos
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form id="formularioCalculo">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Cantidad de animales</h5>
                                    <div class="mb-3">
                                        <label for="numAnimales" class="form-label">Número Vacas (Q):</label>
                                        <input type="number" class="form-control" id="numAnimales" name="numAnimales" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="excretaDiaria" class="form-label">Cantidad de excreta diaria (Kg/día):</label>
                                        <input type="number" class="form-control" id="excretaDiaria" name="excretaDiaria" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tiempoResidencia" class="form-label">Tiempo de residencia (días):</label>
                                        <input type="number" class="form-control" id="tiempoResidencia" name="tiempoResidencia" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Datos del Biodigestor</h5>
                                    <div class="mb-3">
                                        <label for="relacionEstiercolAgua" class="form-label">Relación estiércol/agua:</label>
                                        <input type="number" class="form-control" id="relacionEstiercolAgua" name="relacionEstiercolAgua" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alturaCilindro" class="form-label">Altura del cilindro/Hongo (Hcil) m:</label>
                                        <input type="number" class="form-control" id="alturaCilindro" name="alturaCilindro" required>
                                    </div>
                                    <div class="mb-3">
                                        <!-- Ya no se usará este, cambiar los cálculos -->
                                        <label for="alturaPared" class="form-label">Altura pared/Bolsa (HP) m:</label>
                                        <input type="number" class="form-control" id="alturaPared" name="alturaPared" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="btnCalcular">Calcular</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Resultados de Cálculo -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Resultados de Cálculo
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="two-columns">
                            <!-- Columna de Resultados -->
                            <div class="column">
                                <h5>Resultados del Biodigestor</h5>
                                <table class="table results-table">
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Cantidad total de excretas producidas por los animales en la granja">
                                                Excretas totales en la granja:
                                            </span>
                                        </td>
                                        <td id="resultado-excretas"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Volumen de la mezcla entre estiércol y agua, considerando la relación ingresada">
                                                Volumen de la mezcla (m³):
                                            </span>
                                        </td>
                                        <td id="resultado-mezcla"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Volumen del cilindro del biodigestor que almacenará la mezcla">
                                                Volumen del cilindro (m³):
                                            </span>
                                        </td>
                                        <td id="resultado-digestor"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Volumen de gas producido en el biodigestor">
                                                Volumen de Gas (m³):
                                            </span>
                                        </td>
                                        <td id="resultado-gas"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Volumen de la cúpula superior del biodigestor, generalmente donde se almacena el gas">
                                                Volumen de la Cúpula (m³):
                                            </span>
                                        </td>
                                        <td id="resultado-cupula"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Radio del cilindro del biodigestor, calculado a partir del volumen del cilindro y su altura">
                                                Radio (r) m:
                                            </span>
                                        </td>
                                        <td id="resultado-radio"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Diámetro del cilindro del biodigestor, calculado como el doble del radio">
                                                Diámetro (D) m:
                                            </span>
                                        </td>
                                        <td id="resultado-diametro"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Altura de la cúpula del biodigestor, calculada a partir del radio">
                                                Altura de la Cúpula (Hcup) m:
                                            </span>
                                        </td>
                                        <td id="resultado-altura-cupula"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span data-bs-toggle="tooltip" title="Volumen total del biodigestor, sumando el volumen del cilindro y la cúpula">
                                                Volumen Final del Biodigestor (m³):
                                            </span>
                                        </td>
                                        <td id="resultado-volumen-final"></td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Columna de Imagen -->
                            <div class="column">
                                <h5>Dimensiones del Biodigestor</h5>
                                <h6>Esquema:</h6>
                                <div class="alert alert-info" role="alert">
                                    Estas dimensiones son meramente ilustrativas.
                                </div>
                                <img id="imagen-biodigestor" src="" alt="Imagen del Biodigestor con Dimensiones" style="max-width: 100%; height: auto;">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('btnCalcular').addEventListener('click', function(event) {
            event.preventDefault(); // Evitar el envío tradicional del formulario

            // Obtener los datos del formulario
            let formData = new FormData(document.getElementById('formularioCalculo'));

            // Enviar datos a calculosBiodigestor.php mediante AJAX
            fetch('../includes/calculosBiodigestor.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Actualizar los resultados en el acordeón
                    document.getElementById('resultado-excretas').innerText = data.excretasTotales + ' Kg';
                    document.getElementById('resultado-mezcla').innerText = data.volumenMezcla + ' m³';
                    document.getElementById('resultado-digestor').innerText = data.volumenCilindro + ' m³';
                    document.getElementById('resultado-gas').innerText = data.volumenGas + ' m³';
                    document.getElementById('resultado-cupula').innerText = data.volumenCupula + ' m³';
                    document.getElementById('resultado-radio').innerText = data.radio + ' m';
                    document.getElementById('resultado-diametro').innerText = data.diametro + ' m';
                    document.getElementById('resultado-altura-cupula').innerText = data.alturaCupula + ' m';
                    document.getElementById('resultado-volumen-final').innerText = data.volumenFinal + ' m³';

                    // Mostrar la imagen correspondiente
                    document.getElementById('imagen-biodigestor').src = data.imagen_url;

                    // Mostrar el acordeón de resultados y ocultar el de datos
                    let collapseOne = new bootstrap.Collapse(document.getElementById('collapseOne'), {
                        toggle: false
                    });
                    let collapseTwo = new bootstrap.Collapse(document.getElementById('collapseTwo'), {
                        toggle: true
                    });
                    collapseOne.hide();
                    collapseTwo.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>