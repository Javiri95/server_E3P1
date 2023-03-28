<?php

require_once "ModelBase.php";

class Card extends ModelBase
{
    function __construct()
    {
        //inicializamos el nombre de la tabla
        $this->table_name = 'kartak';

        //llamamos al constructorde la clase ModelBase
        parent::__construct();
    }
}

?>