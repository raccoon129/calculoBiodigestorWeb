<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Biodigestor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-1">
        <h2>Calcular Biodigestor</h2>
        <form id="formCalcular">
            <div class="accordion" id="accordionExample">
                <!-- Acordeón para Datos de Entrada -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInputs" aria-expanded="true" aria-controls="collapseInputs">
                            Ingresar Datos
                        </button>
                    </h2>
                    <div id="collapseInputs" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <!-- Sección 1: Datos de Excretas -->
                            <div class="mb-3">
                                <h5>Datos de Excretas</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="numeroCerdos" class="form-label">Número de Cerdos</label>
                                        <input type="number" class="form-control" id="numeroCerdos" name="numeroCerdos" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numeroExcreta" class="form-label">Excreta por Cerdo (kg/día)</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroExcreta" name="numeroExcreta" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 2: Datos de la Mezcla y Digestor -->
                            <div class="mb-3">
                                <h5>Datos de la Mezcla y Digestor</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="numeroRelacion" class="form-label">Relación Estiércol/Agua</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroRelacion" name="numeroRelacion" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numeroTResidencia" class="form-label">Tiempo de Residencia (días)</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroTResidencia" name="numeroTResidencia" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Sección 3: Datos de la Cúpula y Bolsa -->
                            <div class="mb-3">
                                <h5>Datos de la Cúpula y Bolsa</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="alturaCilindro" class="form-label">Altura del Cilindro (m)</label>
                                        <input type="number" step="0.01" class="form-control" id="alturaCilindro" name="alturaCilindro" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="paredBolsa" class="form-label">Altura de la Pared de la Bolsa (m)</label>
                                        <input type="number" step="0.01" class="form-control" id="paredBolsa" name="paredBolsa" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Calcular</button>
                        </div>
                    </div>
                </div>

                <!-- Acordeón para Resultados de Cálculo -->
                <!-- lOS RESULTADOS SE INYECTAN CON JS -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResults" aria-expanded="false" aria-controls="collapseResults">
                            Resultados de Cálculo
                        </button>
                    </h2>
                    <div id="collapseResults" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body" id="resultadosBody">
                            <div class="alert alert-info" role="alert">
                                Ingresa datos antes para ver el resultado.
                            </div> <!-- Mensaje por defecto -->
                        </div>
                    </div>
                </div>

            </div>


        </form>
    </div>

    <script>
        document.getElementById("formCalcular").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch("../includes/calculosBiodigestor.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.text())
                .then(text => {
                    console.log("Response Text:", text);
                    const data = JSON.parse(text);

                    // Actualizar contenido del acordeón de resultados
                    const resultadosBody = document.getElementById("resultadosBody");
                    resultadosBody.innerHTML = `
                <div class="mb-3">
                    <h5>Resultados de Excretas y Mezcla</h5>
                    <ul>
                        <li>Excretas Totales: ${data.excretasTotales} kg/día</li>
                        <li>Volumen de la Mezcla: ${data.volumenMezcla} m³</li>
                    </ul>
                </div>
                <div class="mb-3">
                    <h5>Resultados del Digestor</h5>
                    <ul>
                        <li>Volumen del Digestor: ${data.volumenDigestor} m³</li>
                        <li>Volumen de Gas: ${data.volumenGas} m³</li>
                        <li>Volumen de la Cúpula: ${data.volumenCupula} m³</li>
                    </ul>
                </div>
                <div class="mb-3">
                    <h5>Dimensiones del Biodigestor</h5>
                    <ul>
                        <li>Radio del Digestor: ${data.radio} m</li>
                        <li>Diámetro del Digestor: ${data.diametro} m</li>
                        <li>Altura de la Cúpula: ${data.alturaCupula} m</li>
                        <li>Volumen Final del Biodigestor: ${data.volumenFinal} m³</li>
                    </ul>
                </div>
                <div class="mb-3">
                    <h5>Dimensiones de la Bolsa</h5>
                    <ul>
                        <li>Altura de la Pared de la Bolsa: ${data.alturaParedBolsa} m</li>
                        <li>Ancho de la Bolsa: ${data.anchoBolsa} m</li>
                        <li>Largo de la Bolsa: ${data.largoBolsa} m</li>
                    </ul>
                </div>
            `;

                    // Cerrar el acordeón de entradas
                    const collapseInputs = new bootstrap.Collapse(document.getElementById('collapseInputs'), {
                        toggle: false
                    });
                    collapseInputs.hide();

                    // Mostrar el acordeón de resultados
                    const collapseResults = new bootstrap.Collapse(document.getElementById('collapseResults'), {
                        toggle: false
                    });
                    collapseResults.show();
                })
                .catch(error => console.error("Error:", error));
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>