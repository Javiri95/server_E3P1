<?php

/* El resto de clases heredan de esta clase
   Realiza la conexion con mysqli y singleton */

require_once "login_data.php";

class Conexion
{
    private static $_singleton = null;
    private $dbh;
    private $errno;
    private $num_rows;

    public static function getInstance()
    {
        if (is_null(self::$_singleton))
        {
            self::$_singleton = new self();
        }
        return self::$_singleton;
    }

    private function __clone()
    {
        trigger_error('La clonacion de este objeto no esta permitida', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error("No puede deserializar una instancia de " . get_class($this) . " class.", E_USER_ERROR);
    }

    private function __construct()
    {
        global $cfg;

        $db     = $cfg['nombre_bd'];
        $host   = $cfg['servidor'];
        $user   = $cfg['usuario'];
        $pass   = $cfg['password'];

        $this->dbh = new mysqli($host, $user, $pass, $db);
        if ($this->dbh->connect_error)
        {
            die ("Fatal error en la conexion con la BD");
        }
        //else
            //OJO: Descomentar para pruebas. Acordarse de quitar cuando se hagan peticiones desde cliente.
            //echo "Connection OKI <br>";

    }

    public function getConnection()
    {
        return self::$_singleton;
    }
    
    public function cerrar()
    {
        self::$_singleton->close();
    }
    
    protected function query($sql)
    {
        $result = $this->dbh->query($sql);

        if(!$result)
        {
            //echo "Error: " . $sql . "<br>" . $this->dbh->error;
            die ("Fatal error al ejecutar query");
        }

        return $result;
    }
}

?>