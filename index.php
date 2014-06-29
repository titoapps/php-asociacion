<?php
    require_once('php/visuals/HTMLCommons.php');

    drawCommonHeaderAndDocType();

    echo ' <body> ';
    echo '<div id="container">';

    //header
    //TODO: need to insert the current displayed option
    drawMenuHeader(0);

    echo ' <div id="content">';

    //Left menu
    //TODO: need to implement options according to current user
    drawLeftMenu();

    //Cabecera central Buscador y Sugerencia de Visita
    echo'<div id="main">';

    //cabecera central
    drawMainHeader();

    //contenerdor central
    drawMainContent();

    echo '</div>';

    //Colaboradores: Ayuntamiento, diputación
    drawPartners();
    //<!-- Footer -->
    drawFooter();
	echo '</div>

</div>
</body>
</html>';

?>


    

        

