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