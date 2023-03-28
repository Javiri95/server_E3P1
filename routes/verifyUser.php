<?php

   require_once (__DIR__."/../functions.php");
   require_once (__DIR__."/../controller/Controller.php");
   
  //  $_POST['gmail']    = 'javier.irigoyen@ikasle.aeg.eus';
  //   $_POST['pasahitza']     = '1234qwer';

   //Verificamos que se hayan enviado las variables 'gmail' y 'pasahitza' a traves del formulario
   if (isset($_POST['gmail']) && isset($_POST['pasahitza']))
   {
      $gmail      = sanitizeString($_POST['gmail']);
      $pasahitza  = sanitizeString($_POST['pasahitza']);

      $userSend['gmail']      = "";
      $userSend['pasahitza']      = "";
      $userSend['error']      = "";
      
      if($gmail == "" || $pasahitza == "" )
      {
        //Error. No se han insertado todos los campos
        $userSend['error'] = "Not all the fields were entered";
      }
      else
      {
        //Buscamos el elemento en la tabla de erabiltzailea
        $resultArray = $erabiltzailea->getAllBy2Columns("gmail", $gmail, "pasahitza", $pasahitza);

        if ($resultArray == null)
        {
            //Usuario no encontrado en la Base de Datos
            $userSend['error'] = "Invalid login attempt";
        }
        else
        {
            //Si el usuario está en la base de datos lo guardamos
            $userSend['gmail']        = $gmail;
            $userSend['pasahitza']    = $pasahitza;
        }

      }

      //Devolvemos el usuario
      echo json_encode($userSend);
      
   }
   else
   {
       die ("Forbidden");
   }


   ?>