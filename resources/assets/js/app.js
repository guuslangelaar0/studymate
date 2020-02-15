require('./bootstrap');
require('./vue/main');

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#app").toggleClass("toggled");
});
