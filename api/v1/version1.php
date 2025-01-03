<?php

$_method = $_SERVER['REQUEST_METHOD'];
$_host = $_SERVER['HTTP_HOST'];
$_uri = $_SERVER['REQUEST_URI'];
$_partes = explode('/', $_uri);

// echo 'partes: ';
// var_dump($_partes);
$_parametros = explode('?',$_partes[count($_partes)-1])[1];
$_parametroID = explode('id=', $_parametros)[1];
// echo $_parametros;
// echo $_parametroID;

//configuración de headers
header("Access-Control-Allow-Origin: *"); // restriccion de acceso desde otros servidores
header("Access-Control-ALlow-Methods: GET, POST, PATCH, DELETE"); // metodos permitidos: GET: para obtener y POST para agregar uno nuevo
// header("Allow: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

//Configuración de Authorization
$_authorization = null;
try {
    if (isset(getallheaders()['Authorization'])) {
        $_authorization = getallheaders()['Authorization'];
        // echo 'tenemos una autorizacion';
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'No tiene autorizacion']);
    }
} catch (Exception $e) {
    echo 'error';
}

$_token_get = 'Bearer ipssGet';
$_token_post = 'Bearer ipssPost';
$_token_patch = 'Bearer ipssPatch';
$_token_disable = 'Bearer ipssDisable';
$_token_put = 'Bearer ipssPut';