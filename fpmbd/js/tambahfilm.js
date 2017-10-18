function toggleProduser (e) {
    var produser = $('#produser');
    produser.slideToggle ();
    produser.prop ("disabled", !produser.prop ("disabled"));

    var baru = $('#produserbaru');
    baru.slideToggle ();
    baru.prop ("disabled", !baru.prop ("disabled"));

    e.preventDefault ();
}