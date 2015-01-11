<?php

    set_include_path('.:/Applications/XAMPP/xamppfiles/htdocs/asociacion/modules/:/Applications/XAMPP/xamppfiles/lib/php/HTML/:/Applications/XAMPP/xamppfiles/lib/php/');

    include 'framework.php';

    include_once('php/visuals/headHTML.php');

    echo ' <body> ';
    echo '<div id="container">';

    //header
    include('modules/mainMenu/controller.php');

    echo ' <div id="content">';

    //Left menu
    drawLeftMenu();

    //Cabecera central Buscador y Sugerencia de Visita
    echo'<div id="main">';

    echo cargador::contenido($componente);

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




    

        

