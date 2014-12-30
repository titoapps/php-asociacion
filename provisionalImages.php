<?php
/**
 * File to initialize the basic web images.
 * User: albertoperezperez
 * Date: 30/12/14
 * Time: 19:07
 */

require_once 'modules/home/DataObject.class.php';
require_once 'modules/galery/model.php';

$fp=fopen('images/galery/callefloranes.jpg','rb');
$size = filesize('images/galery/callefloranes.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(1,$imagenBinaria);
fclose($fp);
$size = null;
$imagenBinaria = null;

$fp=fopen('images/galery/escaparatefruteria.jpg','rb');
$size = filesize('images/galery/escaparatefruteria.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(2,$imagenBinaria);
fclose($fp);
$size = null;
$imagenBinaria = null;


$fp=fopen('images/galery/escaparatemodels.jpg','rb');
$size = filesize('images/galery/escaparatemodels.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(3,$imagenBinaria);
fclose($fp);

$fp=fopen('images/members/carnicerialogo.jpg','rb');
$size = filesize('images/members/carnicerialogo.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(4,$imagenBinaria);
fclose($fp);

$fp=fopen('images/members/fruteriafloraneslogo.jpg','rb');
$size = filesize('images/members/fruteriafloraneslogo.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(5,$imagenBinaria);
fclose($fp);

$fp=fopen('images/members/tascalogo.jpg','rb');
$size = filesize('images/members/tascalogo.jpg');
$imagenBinaria = fread($fp,$size);
Image::updateImage(6,$imagenBinaria);
fclose($fp);