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
                                        <select class="form-control" id="excretaDiaria" name="excretaDiaria" required>
                                            <option value="25">25 Kg/día</option>
                                            <option value="30">30 Kg/día</option>
                                            <option value="35">35 Kg/día</option>
                                            <option value="40">40 Kg/día</option>
                                            <option value="45">45 Kg/día</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tiempoResidencia" class="form-label">Tiempo de residencia (días):</label>
                                        <select class="form-control" id="tiempoResidencia" name="tiempoResidencia" required>
                                            <option value="20">20 días</option>
                                            <option value="30">30 días</option>
                                            <option value="40">40 días</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Datos del Biodigestor</h5>
                                    <div class="mb-3">
                                        <label for="relacionEstiercolAgua" class="form-label">Relación estiércol/agua:</label>
                                        <select class="form-control" id="relacionEstiercolAgua" name="relacionEstiercolAgua" required>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="alturaCilindro" class="form-label">Altura del cilindro/Hongo (Hcil) m:</label>
                                        <select class="form-control" id="alturaCilindro" name="alturaCilindro" required>
                                            <option value="1.2">1.2 m</option>
                                            <option value="1.5">1.5 m</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Deshabilitar inicialmente el botón Calcular -->
                            <button type="button" class="btn btn-primary" id="btnCalcular" disabled>Calcular</button>
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
                        <div id="defaultMessage" class="alert alert-info" role="alert">
                            Da clic antes en Calcular para ver los resultados
                        </div>
                        <div id="resultsContent" style="display: none;">
                            <div class="two-columns">
                                <!-- Columna de Resultados -->
                                <div class="column">
                                    <h5>Resultados del Biodigestor</h5>
                                    <table class="table results-table">
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Cantidad total de excretas producidas por los animales en la granja, utilizada para calcular el tamaño del biodigestor y la producción de gas.">
                                                    Excretas totales en la granja:
                                                </span>
                                            </td>
                                            <td id="resultado-excretas"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Volumen resultante de la mezcla de estiércol y agua que será procesada en el biodigestor, calculado según la proporción ingresada.">
                                                    Volumen de la mezcla (m³):
                                                </span>
                                            </td>
                                            <td id="resultado-mezcla"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Volumen del cilindro donde se almacena la mezcla de estiércol y agua durante el proceso de digestión. Este volumen afecta directamente la capacidad del biodigestor.">
                                                    Volumen del cilindro (m³):
                                                </span>
                                            </td>
                                            <td id="resultado-digestor"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Cantidad de biogás producido por el biodigestor, en función de la cantidad de excretas ingresadas. Este gas puede ser utilizado como fuente de energía.">
                                                    Volumen de Gas (m³):
                                                </span>
                                            </td>
                                            <td id="resultado-gas"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Volumen de la cúpula superior del biodigestor, donde generalmente se almacena el gas antes de ser utilizado o extraído.">
                                                    Volumen de la Cúpula (m³):
                                                </span>
                                            </td>
                                            <td id="resultado-cupula"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Radio del cilindro del biodigestor, calculado en base al volumen y la altura del cilindro. Es un parámetro clave para definir las dimensiones del biodigestor.">
                                                    Radio (r) m:
                                                </span>
                                            </td>
                                            <td id="resultado-radio"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Diámetro del cilindro del biodigestor, calculado como el doble del radio. Es una medida importante para conocer el tamaño total del biodigestor.">
                                                    Diámetro (D) m:
                                                </span>
                                            </td>
                                            <td id="resultado-diametro"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Altura de la cúpula del biodigestor, que determina la capacidad del espacio donde se almacena el biogás. Se calcula a partir del radio del biodigestor.">
                                                    Altura de la Cúpula (Hcup) m:
                                                </span>
                                            </td>
                                            <td id="resultado-altura-cupula"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span data-bs-toggle="tooltip" title="Volumen total del biodigestor, que resulta de sumar el volumen del cilindro y el volumen de la cúpula. Este valor define la capacidad máxima del biodigestor.">
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
                                    <div class="mt-3">
                                        <a href="../tmp/temporalDimensionesBiodigestorGeneradasPlano.png" download="esquemaBiodigestorMedidas.jpg" class="btn btn-success">
                                            Descargar Imagen
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/scriptCalculadora.js"></script>
</body>

</html>