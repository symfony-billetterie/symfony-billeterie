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

    var $textSidebar = $('#text-sidebar');
    var $content = $('.content');
    var $navbar = $('.navbar');

    $('#sidebar-collapsed').click(function () {

        if ($content.css('margin-left') == '80px') {
            $navbar.animate({'width': '150px'}, 1);
            $content.animate({'margin-left': '180px'}, 50);
            $textSidebar.fadeIn(50);
        }
        if ($content.css('margin-left') == '180px') {
            $textSidebar.fadeOut(50, function () {
                $navbar.animateAuto('width', 1);
                $content.animate({'margin-left': '80px'}, 50);
                console.log('test');
            });
        }
    });
});

