document.getElementById('btnCalcular').addEventListener('click', function(event) {
    event.preventDefault();

    let formData = new FormData(document.getElementById('formularioCalculo'));

    fetch('../includes/calculosBiodigestor.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            // Ocultar el mensaje por defecto
            document.getElementById('defaultMessage').style.display = 'none';

            // Mostrar los resultados
            document.getElementById('resultsContent').style.display = 'block';

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
            showDefaultMessage();
        });
});

function showDefaultMessage() {
    document.getElementById('defaultMessage').style.display = 'block';
    document.getElementById('resultsContent').style.display = 'none';
}

// Mostrar el mensaje por defecto al abrir el acordeón si no hay resultados
document.getElementById('collapseTwo').addEventListener('show.bs.collapse', function() {
    if (document.getElementById('resultsContent').style.display === 'none') {
        showDefaultMessage();
    }
});

// Inicialización: asegurarse de que el mensaje por defecto se muestre si no hay resultados
document.addEventListener('DOMContentLoaded', function() {
    const collapseTwo = document.getElementById('collapseTwo');
    if (collapseTwo.classList.contains('show') && document.getElementById('resultsContent').style.display === 'none') {
        showDefaultMessage();
    }
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

document.addEventListener('DOMContentLoaded', function() {
    const numAnimalesInput = document.getElementById('numAnimales');
    const btnCalcular = document.getElementById('btnCalcular');

    // Función para habilitar o deshabilitar el botón según el input
    numAnimalesInput.addEventListener('input', function() {
        if (numAnimalesInput.value.trim() !== '' && parseInt(numAnimalesInput.value) > 0) {
            btnCalcular.disabled = false;
        } else {
            btnCalcular.disabled = true;
        }
    });
});