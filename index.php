<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 8/6/16
 * Time: 10:07 AM
 */
//include "database.php";
include "user.php";
include "product.php";
include "Validation.php";
$product = new product();
$phet = array(
    'product_name' => "Phuckiu",
    'product_price' => 40000,
    'product_description' => "Phuckiua asdhgasd ahsdg asdgjkas gd",
    'link_image' => "http://nghiatv.github.io"
);

//var_dump($phet);exit;

echo "<pre>";
var_dump(Validation::isValidInput("nghiadp"));
echo "</pre>";
exit;


//echo "<pre>";var_dump($updateUser);echo "</pre>"; exit;


//$user = $test->getItemById('products',3);
//$user = $test->deleteById('products',300);


//echo "<pre>";var_dump($user);echo "</pre>"; exit;
