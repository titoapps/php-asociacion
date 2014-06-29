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
                                   6 => 'contacto');

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


}


