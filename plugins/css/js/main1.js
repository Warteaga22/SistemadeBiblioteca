jQuery (función ($) {

    // Menú desplegable
    $ (". sidebar-dropdown> a"). click (function () {
        $ (". sidebar-submenu"). slideUp (200);
        if ($ (esto) .parent (). hasClass ("activo")) {
            $ (". sidebar-dropdown"). removeClass ("activo");
            $ (esto) .parent (). removeClass ("activo");
        } demás {
            $ (". sidebar-dropdown"). removeClass ("activo");
            $ (esto) .next (". sidebar-submenu"). slideDown (200);
            $ (esto) .parent (). addClass ("activo");
        }

    });

    // alternar barra lateral
    $ ("# toggle-sidebar"). haga clic en (función () {
        $ (". envoltorio de página"). toggleClass ("toggled");
    });
    // Pin de la barra lateral
    $ ("# pin-sidebar"). haga clic en (función () {
        if ($ (". page-wrapper"). hasClass ("anclado")) {
            // desanclar la barra lateral cuando se desplaza
            $ (". envoltorio de página"). removeClass ("anclado");
            $ ("# barra lateral"). unbind ("hover");
        } demás {
            $ (". envoltorio de página"). addClass ("anclado");
            $ ("# barra lateral"). hover (
                function () {
                    console.log ("mouseenter");
                    $ (". envoltorio de página"). addClass ("barra lateral flotante");
                },
                function () {
                    console.log ("mouseout");
                    $ (". envoltorio de página"). removeClass ("barra lateral flotante");
                }
            )

        }
    });


    // alternar la superposición de la barra lateral
    $ ("# superposición"). haga clic en (función () {
        $ (". envoltorio de página"). toggleClass ("toggled");
    });

    // cambiar entre temas 
    var themes = "tema-predeterminado tema-heredado tema-enfriador-tema-hielo-tema-fresco-tema-luz-tema";
    $ ('[data-theme]'). click (function () {
        $ ('[tema de datos]'). removeClass ("seleccionado");
        $ (esto) .addClass ("seleccionado");
        $ ('. page-wrapper'). removeClass (temas);
        $ ('. envoltorio de página'). addClass ($ (esto) .attr ('tema de datos'));
    });

    // cambiar entre imágenes de fondo
    var bgs = "bg1 bg2 bg3 bg4";
    $ ('[data-bg]'). click (function () {
        $ ('[data-bg]'). removeClass ("seleccionado");
        $ (esto) .addClass ("seleccionado");
        $ ('. envoltorio de página'). removeClass (bgs);
        $ ('. envoltorio de página'). addClass ($ (esto) .attr ('data-bg'));
    });

    // alternar imagen de fondo
    $ ("# toggle-bg"). change (function (e) {
        e.preventDefault ();
        $ ('. page-wrapper'). toggleClass ("sidebar-bg");
    });

    // alternar el radio del borde
    $ ("# toggle-border-radius"). change (function (e) {
        e.preventDefault ();
        $ ('. page-wrapper'). toggleClass ("límite-radio-activado");
    });

    // la barra de desplazamiento personalizada solo se usa en el escritorio
    if (! / Android | webOS | iPhone | iPad | iPod | BlackBerry | IEMobile | Opera Mini / i.test (navigator.userAgent)) {
        $ (". sidebar-content"). mCustomScrollbar ({
            eje: "y",
            autoHideScrollbar: verdadero,
            scrollInercia: 300
        });
        $ (". sidebar-content"). addClass ("escritorio");

    }
});