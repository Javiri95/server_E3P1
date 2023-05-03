<?php




    $gmail = $_POST["gmail"];
    $pasahitza = $_POST["pasahitza"];
    
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e3p1";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificación de la conexión
    if ($conn->connect_error) {
      die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Inserción de datos en la tabla
    $sql = "INSERT INTO erabiltzailea (gmail, pasahitza) VALUES ('$gmail', '$pasahitza')";
    if ($conn->query($sql) === TRUE) {
      echo "Registro realizado correctamente";
    } else {
      echo "Error al registrar el usuario: " . $conn->error;
    }
    
    // Cierre de la conexión
    $conn->close();
    



?>