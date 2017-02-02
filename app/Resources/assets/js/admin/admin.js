$(document).ready(function () {

    var $textSidebar = $('#text-sidebar');
    var $content = $('.content');

    $('#sidebar-collapsed').click(function () {
        $textSidebar.fadeToggle();

        if ($content.css('margin-left') == '180px') {
            $content.animate({'margin-left': '80px'}, 700);
        }
        if ($content.css('margin-left') == '80px') {
            $content.animate({'margin-left': '180px'}, 700);
        }
    });
});
