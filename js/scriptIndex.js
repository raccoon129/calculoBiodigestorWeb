$(document).ready(function() {
    $("#slideshow").vegas({
        firstTransition: 'zoomOut',
        transition: [ 'fade', 'zoomOut', 'slideDown'],
        animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ],
        slides: [
            { src: "img/0.jpg" },
            { src: "img/1.jpg" },
            { src: "img/2.jpg" },
            { src: "img/3.jpg" }
        ]
    });
});
document.addEventListener("DOMContentLoaded", function() {
    const iframe = document.getElementById("calculadoraIframe");

    // Escuchar los mensajes de la calculadora
    window.addEventListener("message", function(event) {
        if (event.data.type === "resize") {
            iframe.style.height = event.data.height + "px";
        }
    });
});
window.addEventListener('message', function(event) {
    var iframe = document.querySelector('iframe');
    if (iframe && event.data) {
        iframe.style.height = event.data + 'px';
    }
});

function ajustarAlturaIframe() {
    var iframe = document.getElementById('calculadoraIframe');
    iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
}

// el iframe se ajusta después de cargar
document.getElementById('calculadoraIframe').onload = function() {
    ajustarAlturaIframe();
};

// Ajustar de forma progresiva cuando se cambia el tamaño de la ventana
window.addEventListener('resize', function() {
    ajustarAlturaIframe();
});