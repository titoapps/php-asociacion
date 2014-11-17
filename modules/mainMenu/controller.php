<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 05/08/14
 * Time: 21:24
 */


$configuration = \Configuration\Configuration::sharedInstance();
$menuOptions = $configuration->getMenuOptions();
$menuModules = $configuration->getMenuModules();

$menuReferences = array('index.php',
                        'index.php?option='.$menuModules[1],
                        'index.php?option='.$menuModules[2],
                        'index.php?option='.$menuModules[3],
                        'index.php?option='.$menuModules[4],
                        'index.php?option='.$menuModules[5],
                        'index.php?option='.$menuModules[6],
                        'index.php?option='.$menuModules[7]);

if(isset($_GET['option'])){

    $menuOption = $_GET['option'];

} else {

    $menuOption = 'home';

}

include_once ('tmpl.php');