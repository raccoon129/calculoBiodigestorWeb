<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular Biodigestor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            Ingresa datos a continuación:
        </div>
        <div class="accordion" id="accordionInputs">
            <!-- Acordeón para los campos de entrada -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingInputs">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInputs" aria-expanded="true" aria-controls="collapseInputs">
                        Ingresar Datos
                    </button>
                </h2>
                <div id="collapseInputs" class="accordion-collapse collapse show" aria-labelledby="headingInputs" data-bs-parent="#accordionInputs">
                    <div class="accordion-body">
                        <form id="formCalcular" method="POST">
                            <div class="row">
                                <!-- Primera columna de inputs -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numeroCerdos" class="form-label">Número de cerdos:</label>
                                        <input type="number" step="1" class="form-control" id="numeroCerdos" name="numeroCerdos" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numeroExcreta" class="form-label">Excreta diaria por cerdo (Kg/día):</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroExcreta" name="numeroExcreta" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numeroRelacion" class="form-label">Relación estiércol/agua:</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroRelacion" name="numeroRelacion" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="numeroTResidencia" class="form-label">Tiempo de residencia (días):</label>
                                        <input type="number" step="0.01" class="form-control" id="numeroTResidencia" name="numeroTResidencia" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alturaCilindro" class="form-label">Altura cilindro (Hcil) en metros:</label>
                                        <input type="number" step="0.01" class="form-control" id="alturaCilindro" name="alturaCilindro" required>
                                    </div>
                                </div>
                                <!-- Segunda columna de inputs -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="paredBolsa" class="form-label">Altura de la pared de bolsa (m):</label>
                                        <input type="number" step="0.01" class="form-control" id="paredBolsa" name="paredBolsa" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="hCil" class="form-label">Altura de la pared de cilindro (HP) en metros:</label>
                                        <input type="number" step="0.01" class="form-control" id="hCil" name="hCil" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4">Calcular</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acordeón para los resultados -->
        <div class="accordion mt-5" id="accordionResults" style="display:none;">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingResults">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResults" aria-expanded="false" aria-controls="collapseResults">
                        Resultados del Cálculo
                    </button>
                </h2>
                <div id="collapseResults" class="accordion-collapse collapse" aria-labelledby="headingResults" data-bs-parent="#accordionResults">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Excretas Totales (kg):</strong> <span id="excretasTotales"></span></p>
                                <p><strong>Volumen de la Mezcla (m³):</strong> <span id="volumenMezcla"></span></p>
                                <p><strong>Volumen del Digestor (m³):</strong> <span id="volumenDigestor"></span></p>
                                <p><strong>Volumen de Gas (m³):</strong> <span id="volumenGas"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Volumen de la Cúpula (m³):</strong> <span id="volumenCupula"></span></p>
                                <p><strong>Radio (m):</strong> <span id="radio"></span></p>
                                <p><strong>Diámetro (m):</strong> <span id="diametro"></span></p>
                                <p><strong>Altura de la Cúpula (m):</strong> <span id="alturaCupula"></span></p>
                                <p><strong>Volumen Final Biodigestor (m³):</strong> <span id="volumenFinal"></span></p>
                                <p><strong>Altura de la Pared de Bolsa (m):</strong> <span id="alturaParedBolsa"></span></p>
                                <p><strong>Ancho de la Bolsa (m):</strong> <span id="anchoBolsa"></span></p>
                                <p><strong>Largo de la Bolsa (m):</strong> <span id="largoBolsa"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para manejar los acordeones y mostrar resultados -->
    <script>
        document.getElementById("formCalcular").addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            fetch("../includes/calculosBiodigestor.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Mostrar los resultados en el acordeón
                    document.getElementById("excretasTotales").textContent = data.excretasTotales;
                    document.getElementById("volumenMezcla").textContent = data.volumenMezcla;
                    document.getElementById("volumenDigestor").textContent = data.volumenDigestor;
                    document.getElementById("volumenGas").textContent = data.volumenGas;
                    document.getElementById("volumenCupula").textContent = data.volumenCupula;
                    document.getElementById("radio").textContent = data.radio;
                    document.getElementById("diametro").textContent = data.diametro;
                    document.getElementById("alturaCupula").textContent = data.alturaCupula;
                    document.getElementById("volumenFinal").textContent = data.volumenFinal;
                    document.getElementById("alturaParedBolsa").textContent = data.alturaParedBolsa;
                    document.getElementById("anchoBolsa").textContent = data.anchoBolsa;
                    document.getElementById("largoBolsa").textContent = data.largoBolsa;

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

                    document.getElementById("accordionResults").style.display = "block";
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
</body>

</html>