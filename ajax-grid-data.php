<?php

 include "conn.php";

/* Database connection end */
/*
nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento,
paisResidencia, estadoReside, municipio, localidad, idExterno, email, fechaRegistroExterno,
registrado, direccion*/


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
	// datatable column index  => database column name
	0 => 'id',
    1 => 'nombres',
    2 => 'apellidoPaterno',
    3 => 'imagen',
	4 => 'telefono',
    5 => 'direccion',
    6 => 'registrado'  
);

// getting total number records without any search
$sql = "SELECT id, nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento, paisResidencia, estadoReside, municipio, localidad, email, registrado, direccion, telefono, imagen ";
$sql.=" FROM clientes";
$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT id, nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento, paisResidencia, estadoReside, municipio, localidad, email, registrado, direccion, telefono, imagen ";
	$sql.=" FROM clientes";
	$sql.=" WHERE nombres LIKE '".$requestData['search']['value']."%' ";
	$sql.=" WHERE apellidoPaterno LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR telefono LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR direccion LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR registrado LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO"); // again run query with limit
	
} else {	

	$sql = "SELECT id, nombres, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, nacionalidad, lugarNacimiento, paisResidencia, estadoReside, municipio, localidad, email, registrado, direccion, telefono, imagen ";
	$sql.=" FROM clientes";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("ajax-grid-data.php: get PO");
	
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData = array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["nombres"];
    $nestedData[] = $row["apellidoPaterno"];
    $nestedData[] = '<img class="img-responsive" src="' . $row["imagen"] . '" />';
	$nestedData[] = $row["telefono"];
    $nestedData[] = $row["direccion"];
    $nestedData[] = date("d/m/Y", strtotime($row["registrado"]));
    $nestedData[] = '<td><center>
                     <a href="editar.php?id='.$row['id'].'"  data-toggle="tooltip" title="Editar datos" class="btn btn-sm btn-info"> <i class="menu-icon icon-pencil"></i> </a>
                     <a href="index.php?action=delete&id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"> <i class="menu-icon icon-trash"></i> </a>
				     </center></td>';		
	
	$data[] = $nestedData;
    
}

$json_data = array(
	"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval( $totalData ),  // total number of records
	"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>