modifications = [];

window.onload = function() {
    $(".inFHF").change(function() {
        modifications.push($(this).attr("id"));
    });
    
    document.getElementById("frmValiderFicheFrais").onsubmit = function() {
        if (modifications.length > 0) {
            alert("Attention : vous n'avez pas enregistré certaines modifications !");
            modifications.forEach(function(input) {
                $("#"+input).css('background-color', '#ffb896');
            });
            return false;
        } else {
            return confirm("Voulez vous vraiment valider cette fiche de frais ?");
        }
    };
};