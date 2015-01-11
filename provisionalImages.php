<?php
/**
 * File to initialize the basic web images.
 * User: albertoperezperez
 * Date: 30/12/14
 * Time: 19:07
 */

require_once 'modules/home/DataObject.class.php';
require_once 'modules/galery/model.php';

$path = 'images/personaDefectoG.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(1,$imagenBinaria,'jpg');
fclose($fp);
$size = null;
$imagenBinaria = null;

$path = 'images/galery/callefloranes.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(2,$imagenBinaria,'jpg');
fclose($fp);
$size = null;
$imagenBinaria = null;

$path = 'images/galery/escaparatefruteria.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(3,$imagenBinaria,'jpg');
fclose($fp);
$size = null;
$imagenBinaria = null;

$path = 'images/galery/escaparatemodels.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(4,$imagenBinaria,'jpg');
fclose($fp);

$path = 'images/members/carnicerialogo.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(5,$imagenBinaria,'jpg');
fclose($fp);

$path = 'images/members/fruteriafloraneslogo.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(6,$imagenBinaria,'jpg');
fclose($fp);

$path = 'images/members/tascalogo.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(7,$imagenBinaria,'jpg');
fclose($fp);

$path = 'images/galery/floranes1.png';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(8,$imagenBinaria,'png');
fclose($fp);

$path = 'images/galery/floranes2.png';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(9,$imagenBinaria,'png');
fclose($fp);

$path = 'images/galery/floranes3.jpg';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(10,$imagenBinaria,'jpg');
fclose($fp);

$path = 'images/galery/floranes4.png';
$fp=fopen($path,'rb');
$size = filesize($path);
$imagenBinaria = fread($fp,$size);
Image::updateImage(11,$imagenBinaria,'png');
fclose($fp);

