<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 29/06/14
 * Time: 17:25
 */

namespace Configuration;

/**
 * Class Configuration
 * Contains information about the site shared among all classes
 * @package Configuration
 */
class Configuration {

    /**
     * @var Singleton configuration instance
     */
    private static $instance;

    /**
     * @var The menu options array
     */
    private $menuOptions;

    /**
     * @var int maximum image width
     */
    private $maxImageWidth = 500;

    /**
     * @var int maximum image height
     */
    private $maxImageHeight = 200;

    /**
     * @var string Images temporal folder
     */
    private $imagesfolder;

    /**
     * @var array Allowed file types
     */
    private $allowedFileTypes;

    /**
     * @var array The image mime types allowed
     */
    private $allowedMimeTypes;

//    //La anchura m�xima de las miniaturas generadas.
//    private $maxwidththumb = 60;
//
//    //La altura m�xima de las miniaturas generadas.
//    private $maxheightthumb = 60;

    //Ubicaci�n para almacenar las im�genes.


//        //Ubicaci�n para almacenar las miniaturas.
//    private $thumbsfolder = "images/thumbs";



//        //N�mero de im�genes por fila de navegaci�n.
//    private $maxperrow = 7;

    /**
     * Class Constructor
     */
    public function __construct() {

        //TODO:Separate into enumerate or something. define doesnt work
        $this->menuOptions = array(0 => 'inicio',
                                   1 => 'noticias',
                                   2 => 'asociacion',
                                   3 => 'ofertas',
                                   4 => 'agenda',
                                   5 => 'asociate',
                                   6 => 'galeria',
                                   7 => 'contacto');

        $this->menuModules = array(0 => 'home',
                                   1 => 'news',
                                   2 => 'asociation',
                                   3 => 'jobOffers',
                                   4 => 'agenda',
                                   5 => 'asociate',
                                   6 => 'galery',
                                   7 => 'contact',
                                   8 => 'search',
                                   9 => 'profile',
                                   10 => 'profileEdition');

//        $this->$imagesfolder = "images/tmp";
//        $this->$allowedMimeTypes = array ("image/jpeg","image/jpg","image/png","image/gif");
//        $this->$allowedFileTypes = array ("jpg","jpeg","gif","png");

        //set_include_path('/Applications/XAMPP/xamppfiles/htdocs/asociacionComerciantes/php-asociacion/modules/');


    }

    /**
     * Singleton implementation. Returns the shared configuration instance
     *
     * @return configuration instance
     */
    public static function sharedInstance () {

        if (Configuration::$instance == null) {

             Configuration::$instance = new Configuration();

        }

        return Configuration::$instance;

    }

    /**
     * Returns the menu options array
     *
     * @return array with the menu options
     */
    public function getMenuOptions() {

        return $this->menuOptions;

    }

    /**
     * Returns the menu modules array
     *
     * @return array with the modules for the menu options
     */
    public function getMenuModules() {

        return $this->menuModules;

    }

    /**
     * Returns the max image width
     * @return int the max image width
     */
    public function getImageMaxWidth() {

//        return $this->$maxImageWidth;
return 500;
    }

    /**
     * Returns the max image height
     * @return int the max image height
     */
    public function getImageMaxHeight() {

//        return $this->$maxImageHeight;
        return 200;

    }

    /**
     * Returns the images folder
     * @return string the images folder
     */
    public function getImagesFolder() {

//        return $this-> $imagesfolder;

        return "images/tmp";
    }

    /**
     * Returns the allowed file types array
     *
     * @return array with the allowed file types
     */
    public function getAllowedFileTypes () {

//        return $this->$allowedFileTypes;
return array ("jpg","jpeg","png","gif");
    }

    /**
     * Returns the allowed mime types array
     *
     * @return array with the allowed mime types
     */
    public function getAllowedMimeTypes () {

//        return $this->$allowedMimeTypes;

        return array ("image/jpeg","image/jpg","image/png","image/gif");
    }


}


