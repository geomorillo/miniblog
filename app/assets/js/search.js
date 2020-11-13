$(document).ready(function() {
    $("#otro_cliente").autocomplete({
        minLength: 2,
        source: "/search",
        select: function(event, ui) {
            alert("Seleccionaste: " + ui.item);
        }
    });
});
