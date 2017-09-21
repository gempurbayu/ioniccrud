<?php
   header('Access-Control-Allow-Origin: *');

   // Define database connection parameters
   $host      = 'localhost';
   $username      = 'root';
   $password     = '';
   $database      = 'biodata';
   $charset      = 'utf8';

   // Set up the PDO parameters
   $dest  = "mysql:host=" . $host . ";port=3306;dbname=" . $database . ";charset=" . $charset;
   $option  = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo  = new PDO($dest, $username, $password, $option);
   $data = array();


   // Attempt to query database table and retrieve data
   try {
      $statement   = $pdo->query('SELECT idBiodata, namaDepan, namaBelakang, jenisKelamin, alamat, noTelp, email  FROM biodata ORDER BY namaDepan ASC');
      while($row  = $statement->fetch(PDO::FETCH_OBJ))
      {
         // Assign each row of data to associative array
         $data[] = $row;
      }

      // Return data as JSON
      echo json_encode($data);
   }
   catch(PDOException $e)
   {
      echo $e->getMessage();
   }


?>