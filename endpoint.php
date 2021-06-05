<?
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if( $method == "OPTIONS" ) {
    
    die();
}
include "conn.php";
/*
nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento,
paisResidencia, estadoReside, municipio, localidad, idExterno, email, fechaRegistroExterno,
registrado, direccion
*/

$nombres = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['nombres'], ENT_QUOTES ) ) );
$apellidoPaterno = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['apellidoPaterno'], ENT_QUOTES ) ) );
$apellidoMaterno = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['apellidoPaterno'], ENT_QUOTES ) ) );
$sexo = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['sexo'], ENT_QUOTES ) ) );
$fechaNacimiento = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['fechaNacimiento'], ENT_QUOTES ) ) );
$nacionalidad = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['nacionalidad'], ENT_QUOTES ) ) );
$lugarNacimiento = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['lugarNacimiento'], ENT_QUOTES ) ) );
$paisResidencia = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['paisResidencia'], ENT_QUOTES ) ) );
$estadoReside = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['estadoReside'], ENT_QUOTES ) ) );
$municipio = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['municipio'], ENT_QUOTES ) ) );
$localidad = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['localidad'], ENT_QUOTES ) ) );
$idExterno = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['idExterno'], ENT_QUOTES ) ) );
$email = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['email'], ENT_QUOTES ) ) );
$fechaRegistroExterno = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['fechaRegistroExterno'], ENT_QUOTES ) ) );
$registrado = date( "Y-m-d H:i:s" );
$direccion = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['direccion'], ENT_QUOTES ) ) );
$imagen = mysqli_real_escape_string( $conn, ( strip_tags( $_POST['imagen'], ENT_QUOTES ) ) );

$insert = mysqli_query( $conn, "INSERT INTO clientes
	( nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento, paisResidencia, 
	estadoReside, municipio, telefono, localidad, idExterno, email, fechaRegistroExterno, direccion, registrado, imagen )
	VALUES( '$nombres', '$apellidoPaterno', '$apellidoMaterno', '$sexo', '$fechaNacimiento', '$nacionalidad', '$lugarNacimiento', '$paisResidencia', 
	'$estadoReside', '$municipio', '$telefono', '$localidad', '$idExterno', '$email', '$fechaRegistroExterno', '$direccion', '$registrado', '$imagen')" ) or die ( mysqli_error() );

if( $insert ){

	echo json_encode( array( "result" => 1 ) );
}
else{

	echo json_encode( array( "result" => 2 ) );
}
?>