<?php

require_once (__DIR__."/../db/Conexion.php");

class ModelBase extends Conexion
{
    protected $conexion;
    protected $table_name;
    protected $table_name2;



    function __construct()
    {
        $this->conexion = parent::getInstance();
    }


    //obtiene todos los elementos de la tabla
    function getAll()
    {
        $query = $this->selectDB($this->table_name);
        //echo $query;
        //echo "Table gmail: " . $this->pasahitza;
        $result = $this->conexion->query($query);
        // echo $result;
        //creamos el array asociativo para devolver los datos
        $array = $this->createArray($result);
        // echo $array;

        $result->close();
        return $array;
        
    }

    //obtiene todos los elementos de la tabla cartas con join de categorias
    function getAllWithCategories($category)
    {
        $query = $this->selectDBWithJoin($this->table_name, $category);
        //echo $query;
        //echo "Table name: " . $this->table_name;
        $result = $this->conexion->query($query);
        // echo $result;
        //creamos el array asociativo para devolver los datos
        $array = $this->createArray($result);
        // echo $array;

        $result->close();
        return $array;
        
    }




    //obtiene todos los elementos en la tabla, filtrados por un valor de una columna
    function getAllByColumn($search_name, $search_value)
    {
        $query = $this->selectDB($this->table_name, "*", $search_name, $search_value);
        $result = $this->conexion->query($query);

        //creamos el array asociativo para devolver los datos
        $array = $this->createArray($result);

        $result->close();
        return $array;
    }

    
    //Función que añade un elemento nuevo en la tabla
    function addNew($array)
    {
        $query = $this->insertDB($this->table_name, $array);

        $result = $this->conexion->query($query);

        return $result;
        
    }

    protected function createArray($data)
    {
        //creamos el array asociativo para devolver los datos
        while ($row = $data->fetch_array(MYSQLI_ASSOC))
        {
            //Añadimos la siguiente fila
            $array[] = $row;

            //echo "entra";
            
        }

        return $array;

    }

    //Devuelve un query de la forma "SELECT * FROM table WHERE author='Jane Austen'"ç
    //Parametros:  
    //$table: Nombre de la tabla(FROM)
    //$columns: Columnas a extraer (SELECT). 

    protected function selectDB($table, $columns = "*", $name = "", $value = "")
    {
        ////////////////////////////
        $query = "SELECT $columns FROM $table";

        ////////////////////////////
        if ($name != "" && $value != "")
            $query .= " WHERE $name = '$value'"; 
        
        //echo $query;
        return $query;
    }


    protected function selectDBWithJoin($table, $category, $columns = "*")
    {
        ////////////////////////////
        $query = "SELECT $columns FROM $table JOIN $category->table_name ON $table.id_k = $category->table_name.id_k";

        ///////////////////////////
        
        //echo $query;
        return $query;
        //echo $query;
    }






    protected function insertDB($table, $array)
    {
        foreach ($array as $name => $value)
        {
            $insert_name[] = $name;
            $insert_value[] = $value;
        }

        $query = "INSERT INTO $table(";

        $num_elem = count($insert_name);
        for ($i = 0; $i < $num_elem; ++$i)
        {
            $query .= "$insert_name[$i]";
            if ($i != $num_elem - 1)
                $query .= ", ";
            else
                $query .= ") ";

        }

        $query .= "VALUES(";
        for ($i = 0; $i < $num_elem; ++$i)
        {
            $query .= "'$insert_value[$i]'";
            if ($i != $num_elem - 1)
                $query .= ", ";
            else
                $query .= ") ";
        }

        return $query;
    }

    
    function getAllBy2Columns($search_name1, $search_value1, $search_name2, $search_value2)
    {
        $query = $this->selectDBMultiple($this->table_name,"*",$search_name1, $search_value1, $search_name2, $search_value2);
        $result = $this->conexion->query($query);

        //Creamos el array asociativo para devolver los datos
        $array = $this->createArray($result);

        $result->close();
        return $array;
    }

    protected function selectDBMultiple($table, $columns = "*", $name1 = "", $value1 = "", $name2 = "", $value2 = "")
    {
        $query = "SELECT $columns FROM $table";
        if ($name1 != "" && $value1 != "")
            $query .= " WHERE $name1 = '$value1'";
        if ($name2 != "" && $value2 != "")
            $query .= " AND $name2 = '$value2'";

        //echo $query;
        return $query;
    }

























}

?>
