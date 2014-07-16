<?php
    require_once('php/visuals/commonsHTML.php');

    include_once('php/visuals/headHTML.php');


    echo ' <body> ';
    echo '<div id="container">';

    //header
    //TODO: need to insert the current displayed option
    include_once('php/visuals/mainMenu.php');

    echo ' <div id="content">';

    //Left menu
    //TODO: need to implement options according to current user
    drawLeftMenu();

    //Cabecera central Buscador y Sugerencia de Visita
    echo'<div id="main">';

    //cabecera central
    drawMainHeader();

    //contenedor central
    drawMainContent();

    echo '</div>'; // main div

    //Colaboradores: Ayuntamiento, diputación
    include_once('php/visuals/partners.php');
    //<!-- Footer -->
    include_once('php/visuals/footer.php');

	echo '</div><!--Content div-->

</div><!--container div-->
</body>
</html>';

?>




    

        

