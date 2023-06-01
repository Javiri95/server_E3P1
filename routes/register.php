<?php
    $gmail = $_POST["gmail"];
    $pasahitza = $_POST["pasahitza"];
    $name_e = $_POST["name_e"];
    $jaiotze_data = $_POST["jaiotze_data"];

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "uzon8oip1qtq6";
    $password = "javi@gmail.com";
    $dbname = "dbnxzlvzbxoynz";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificación de la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Hash the password
    $hashedPassword = password_hash($pasahitza, PASSWORD_DEFAULT);
    
    // Inserción de datos en la tabla
    $sql = "INSERT INTO erabiltzailea (gmail, pasahitza, name_e, jaiotze_data) VALUES ('$gmail', '$hashedPassword', '$name_e', '$jaiotze_data')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro realizado correctamente";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
    
    // Cierre de la conexión
    $conn->close();
?>