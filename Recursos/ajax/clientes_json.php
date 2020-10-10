<?php
// conexion a la bd
include("../../Conexion/consulSQL.php");	

$search = strip_tags(trim($_GET['cliente'])); 
// Se hace la consulta de los clientes
$query = ejecutarSQL::consultar("SELECT * FROM cliente WHERE nombre_completo REGEXP '$search' OR nit REGEXP '$search'");        

$list = array();
while ($list=mysqli_fetch_array($query)){
	$data[] = array('id' => $list['id'], 'text' => $list['nombre_completo'],'doc_id' => $list['nit'],'telefono' => $list['telefono'],'email' => $list['email']);
}
// Se retorna el resultado con JSON
echo json_encode($data);
?>