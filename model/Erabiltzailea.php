<?php

require_once "ModelBase.php";

class Erabiltzailea extends ModelBase
{
    function __construct()
    {
        //Inicializamos el nombre de la tabla
        $this->table_name = 'erabiltzailea';

        //Llamamos al constructor de la clase ModelBase
        parent::__construct();
    }
}

?>