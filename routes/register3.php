<?php
// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "uzon8oip1qtq6";
$password = "javi@gmail.com";
$dbname = "dbnxzlvzbxoynz";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// Recuperar los valores de la solicitud
$gmail = $_POST["gmail"];


// Buscar el usuario en la tabla erabiltzailea
$sql = "SELECT * FROM erabiltzailea WHERE gmail = '$gmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Actualizar la contraseña del usuario

  // $sql = " erabiltzailea SET name_e = '$name_e' , rola = '$rola' , jaiotze_data = '$jaiotze_data' WHERE gmail = '$gmail'";

   $sql =  " DELETE FROM erabiltzailea WHERE gmail = '$gmail' ";

  if ($conn->query($sql) === TRUE) {
    // Devolver una respuesta exitosa
    $response = array("success" => true);
    echo json_encode($response);
  } else {
    // Devolver una respuesta con un error de actualización de la base de datos
    $response = array("success" => false, "message" => "Error updating record: " . $conn->error);
    echo json_encode($response);
  }
} else {
  // Devolver una respuesta con un error de usuario no encontrado
  $response = array("success" => false, "message" => "User not found");
  echo json_encode($response);
}

// Cerrar la conexión con la base de datos
$conn->close();
?>




