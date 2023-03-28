<?php

require_once "ModelBase.php";

class Category extends ModelBase
{
    function __construct()
    {
        //inicializamos el nombre de la tabla
        $this->table_name = 'kategoriak';

        //llamamos al constructorde la clase ModelBase
        parent::__construct();
    }
}

?>