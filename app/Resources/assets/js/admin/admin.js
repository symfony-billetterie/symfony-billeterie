/**
 * Fonction qui permet de passer le paramètre 'auto' pour une animation (Trouver sur internet)
 * @param prop
 * @param speed
 * @param callback
 * @returns {*}
 */
jQuery.fn.animateAuto = function (prop, speed, callback) {
    var elem, height, width;
    return this.each(function (i, el) {
        el = jQuery(el), elem = el.clone().css({"height": "auto", "width": "auto"}).appendTo("body");
        height = elem.css("height"),
            width = elem.css("width"),
            elem.remove();

        if (prop === "height")
            el.animate({"height": height}, speed, callback);
        else if (prop === "width")
            el.animate({"width": width}, speed, callback);
        else if (prop === "both")
            el.animate({"width": width, "height": height}, speed, callback);
    });
};

$(document).ready(function () {

    /** Définition des variables */
    var $textSidebar = $('.text-sidebar');
    var $content = $('.content');
    var $navbar = $('.navbar');

    /** Si on clique sur l'icone 'bar' du header*/
    $('#sidebar-collapsed').click(function () {

        /**Décalage de la navbar à droite, Décalage à droite du contenu, Apparition du texte de la sidebar */
        if ($content.css('margin-left') == '80px') {
            $navbar.animate({'width': '150px'}, 1);
            $content.animate({'margin-left': '180px'}, 50);
            $textSidebar.fadeIn(50);
        }
        /** Disparition du texte de la sidebar, décalage à droite de la navbar, décalage à droite du contenu */
        if ($content.css('margin-left') == '180px') {
            $textSidebar.fadeOut(50).promise().done(function () {
                $navbar.animateAuto('width', 1);
                $content.animate({'margin-left': '80px'}, 50);
            });
        }
    });
});

