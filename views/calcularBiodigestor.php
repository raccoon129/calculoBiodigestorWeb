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
        <h2>Calcular Parámetros del Biodigestor</h2>
        <div class="accordion" id="accordionInputs">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingInputs">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInputs" aria-expanded="true" aria-controls="collapseInputs">
                        Ingresar Datos
                    </button>
                </h2>
                <div id="collapseInputs" class="accordion-collapse collapse show" aria-labelledby="headingInputs" data-bs-parent="#accordionInputs">
                    <div class="accordion-body">
                        <form id="formCalcular" method="POST">
                            <div class="mb-3">
                                <label for="excretaDiaria" class="form-label">Cantidad de excreta diaria (Kg/día):</label>
                                <input type="number" step="0.01" class="form-control" id="excretaDiaria" name="excretaDiaria" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipoResidencia" class="form-label">Tipo de residencia (tr):</label>
                                <input type="number" step="0.01" class="form-control" id="tipoResidencia" name="tipoResidencia" required>
                            </div>
                            <div class="mb-3">
                                <label for="relacionEstiercolAgua" class="form-label">Relación estiércol/agua:</label>
                                <input type="number" step="0.01" class="form-control" id="relacionEstiercolAgua" name="relacionEstiercolAgua" required>
                            </div>
                            <div class="mb-3">
                                <label for="alturaCilindro" class="form-label">Altura cilindro / Hongo (Hcil) en metros:</label>
                                <input type="number" step="0.01" class="form-control" id="alturaCilindro" name="alturaCilindro" required>
                            </div>
                            <div class="mb-3">
                                <label for="alturaPared" class="form-label">Altura pared / Bolsa (HP) en metros:</label>
                                <input type="number" step="0.01" class="form-control" id="alturaPared" name="alturaPared" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular</button>
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
                        <p><strong>Volumen del Biodigestor:</strong> <span id="volumen"></span> m³</p>
                        <p><strong>Área del Biodigestor:</strong> <span id="area"></span> m²</p>
                        <!-- Puedes agregar más campos aquí -->
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para enviar datos y mostrar el acordeón con los resultados -->
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
                    document.getElementById("volumen").textContent = data.volumen;
                    document.getElementById("area").textContent = data.area;
                    // Aquí puedes agregar más resultados si es necesario

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

                    // Mostrar el acordeón de resultados
                    document.getElementById("accordionResults").style.display = "block";
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
</body>

</html>