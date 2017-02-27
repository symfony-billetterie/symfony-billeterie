$(document).ready(function () {

    /** Définition des variables */
    var $navBrand = $('.block-nav-brand');
    var $nav = $('.block-nav');

    /** Si on clique sur l'icone 'bar' du header*/
    $navBrand.click(function () {
        console.log($nav.css('display'));
        $nav.fadeToggle();
    });
});

