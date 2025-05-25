<?php
include_once(dirname(__DIR__).'/includes/reportes_model.php');

if (isset($_POST['contarUsuarios'])) {
    $reporte = new Reportes();

    
    $result = $reporte->ContarUsuarios();

    
    $response = array(
        "TotalUsuarios" => $result['total_usuarios']
    );

    
    echo json_encode($response);
}



if (isset($_POST['contarPublicaciones'])) {
    $reporte = new Reportes();

    $result = $reporte->ContarPublicaciones();

    $response = array(
        "TotalPublicaciones" => $result['total_publicaciones']
    );

    echo json_encode($response);
}

if (isset($_POST['contarPublicacionesPorNombre'])) {
    $nombre = $_POST['nombreUsuario']; 

    $reporte = new Reportes();
    $result = $reporte->ContarPublicacionesPorNombre($nombre);

    $response = array(
        "TotalPublicaciones" => $result['total_publicaciones']
    );

    echo json_encode($response);
}





?>