<?php
   header('Access-Control-Allow-Origin: *');

   // Define database connection parameters
   $host      = 'localhost';
   $username      = 'root';
   $password     = '';
   $database      = 'biodata';
   $charset     = 'utf8';

   // Set up the PDO parameters
   $dest  = "mysql:host=" . $host . ";port=3306;dbname=" . $database . ";charset=" . $charset;
   $option  = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_EMULATE_PREPARES   => false,
                       );
   // Create a PDO instance (connect to the database)
   $pdo  = new PDO($dest, $username, $password, $option);

   // Retrieve specific parameter from supplied URL
   $key  = strip_tags($_REQUEST['key']);
   $data    = array();

switch($key)
   {

      // Add a new record to the technologies table
      case "insert":

         // Sanitise URL supplied values
         $namaDepan       = filter_var($_REQUEST['namaDepan'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $namaBelakang      = filter_var($_REQUEST['namaBelakang'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $jenisKelamin       = filter_var($_REQUEST['jenisKelamin'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $alamat      = filter_var($_REQUEST['alamat'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $noTelp      = filter_var($_REQUEST['noTelp'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $email       = filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

         // Attempt to run PDO prepared statement
         try {
            $sql  = "INSERT INTO biodata(namaDepan, namaBelakang, jenisKelamin, alamat, noTelp, email) VALUES(:namaDepan, :namaBelakang, :jenisKelamin, :alamat, :noTelp, :email)";
            $statement    = $pdo->prepare($sql);
            $statement->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
            $statement->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
            $statement->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
            $statement->bindParam(':alamat', $alamat, PDO::PARAM_STR);
            $statement->bindParam(':noTelp', $noTelp, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();

            echo json_encode(array('message' => 'Biodata dengan nama ' . $namaDepan . ' telah disimpan'));
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break; 

            // Add a new record to the technologies table
      case "update":

         // Sanitise URL supplied values
         $namaDepan       = filter_var($_REQUEST['namaDepan'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $namaBelakang      = filter_var($_REQUEST['namaBelakang'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $jenisKelamin       = filter_var($_REQUEST['jenisKelamin'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $alamat      = filter_var($_REQUEST['alamat'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $noTelp      = filter_var($_REQUEST['noTelp'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $email       = filter_var($_REQUEST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
         $idBiodata       = filter_var($_REQUEST['idBiodata'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);

         // Attempt to run PDO prepared statement
         try {
            $sql  = "UPDATE biodata SET namaDepan = :namaDepan, namaBelakang = :namaBelakang, jenisKelamin = :jenisKelamin, alamat = :alamat, noTelp = :noTelp, email = :email WHERE idBiodata = :idBiodata";
            $statement    = $pdo->prepare($sql);
            $statement->bindParam(':namaDepan', $namaDepan, PDO::PARAM_STR);
            $statement->bindParam(':namaBelakang', $namaBelakang, PDO::PARAM_STR);
            $statement->bindParam(':jenisKelamin', $jenisKelamin, PDO::PARAM_STR);
            $statement->bindParam(':alamat', $alamat, PDO::PARAM_STR);
            $statement->bindParam(':noTelp', $noTelp, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':idBiodata', $idBiodata, PDO::PARAM_STR);
            $statement->execute();

            echo json_encode(array('message' => 'Biodata dengan nama ' . $namaDepan . ' telah dirubah'));
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break; 

      case "hapus":

         // Sanitise supplied record ID for matching to table record
         $idBiodata   =  filter_var($_REQUEST['idBiodata'], FILTER_SANITIZE_NUMBER_INT);

         // Attempt to run PDO prepared statement
         try {
            $pdo  = new PDO($dsn, $un, $pwd);
            $sql  = "DELETE FROM idBiodata WHERE id = :idBiodata";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':idBiodata', $idBiodata, PDO::PARAM_INT);
            $statement->execute();

            echo json_encode('Congratulations the record ' . $namaDepan . ' was removed');
         }
         // Catch any errors in running the prepared statement
         catch(PDOException $e)
         {
            echo $e->getMessage();
         }

      break;
   }

?>