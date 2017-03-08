<?php
	$idMatricula = $_POST['id'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "autoescuela";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Conexion fallida: " . $conn->connect_error);
	}
	$sqlComprueba = "SELECT * FROM matriculas WHERE PRACTICO_APROBADO=1 AND ID_MATRICULA = ".$idMatricula;
	if ($conn->query($sqlComprueba)->num_rows == 0) {
		$sql = 'UPDATE matriculas SET PRACTICO_APROBADO=1 WHERE ID_MATRICULA = "'.$idMatricula.'"';
		if ($conn->query($sql) === TRUE) {
		    $resultado =  "Práctico aprobado correctamente";
		    $error = FALSE;
		} else {
		    $resultado = "Error: " . $sql . "<br>" . $conn->error;
		    $error = TRUE;
		}
	}else{
		$resultado = "Esa matrícula ya tiene el examen Práctico aprobado";
		$error = TRUE;
	}


			
	
	// Creo un "objeto" php creando un array asociativo
	$objeto_salida = array ( "mensaje" => "Practico aprobado" , "resultado" => $resultado, "error" => $error );
	$json_salida = json_encode($objeto_salida);
	echo $json_salida;
	$conn->close();
?>