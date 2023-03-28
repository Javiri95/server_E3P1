<?php
    require_once (__DIR__."/../controller/Controller.php");
    //get de cards
    //$result =  $card->getAll();

    //get de cards join categories
    $result = $card->getAllWithCategories($category);

    //Devolvemos el resultado de la BD como JSON
    echo json_encode($result);


// echo __DIR__;



?>



