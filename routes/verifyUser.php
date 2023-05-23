<?php
   require_once (__DIR__."/../functions.php");
   require_once (__DIR__."/../controller/Controller.php");
   
  //  $_POST['gmail']    = 'javier.irigoyen@ikasle.aeg.eus';
  //  $_POST['pasahitza'] = '1234qwer';

   // Verificamos que se hayan enviado las variables 'gmail' y 'pasahitza' a través del formulario
   if (isset($_POST['gmail']) && isset($_POST['pasahitza']))
   {
      $gmail     = sanitizeString($_POST['gmail']);
      $pasahitza = sanitizeString($_POST['pasahitza']);

      $userSend = array(
         'gmail'    => "",
         'pasahitza' => "",
         'rola'     => "",
         'error'    => ""
      );
      
      if ($gmail == "" || $pasahitza == "")
      {
         // Error. No se han insertado todos los campos
         $userSend['error'] = "Not all fields were entered";
      }
      else
      {
         // Buscamos el elemento en la tabla de erabiltzailea
         $resultArray = $erabiltzailea->getAllByColumn("gmail", $gmail);
                                               
         if ($resultArray == null)
         {
            // Usuario no encontrado en la base de datos
            $userSend['error'] = "Invalid login attempt";
         }
         else
         {
            // Verificar la contraseña
            $storedPassword = $resultArray[0]['pasahitza'];
            
            if (password_verify($pasahitza, $storedPassword))
            {
               // Contraseña válida
               $userSend['gmail']     = $gmail;
               $userSend['pasahitza'] = $storedPassword;
               $userSend['rola']      = $resultArray[0]['rola'];
            }
            else
            {
               // Contraseña incorrecta
               $userSend['error'] = "Invalid login attempt";
            }
         }
      }

      // Devolvemos el usuario
      echo json_encode($userSend);
   }
   else
   {
      die("Forbidden");
   }
?>