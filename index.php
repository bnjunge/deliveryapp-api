<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Origin: http://localhost:8100');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

header('Content-Type: application/json');

require_once 'baseClass.php';
$base = new API;

$user_request = file_get_contents("php://input");
$user_request_ = json_decode($user_request, true);

$endpoint = $user_request_['request'];

switch($endpoint){
    case 'collect_parcel':
        
        $save = $base->parcel_info($user_request_['body']);
        echo l($save);
    break;

    case 'parcel_info':
        $parcel_info = $base->get_parcel_info($user_request_['body']['id']);
        echo l($parcel_info);
    break;

    case 'collection_point':

        $sms = $base->parcel_at_collection_point($user_request_['body']['id']);
        echo l($sms);
    break;

    default:
        echo l(['request' => $endpoint, 'message' => 'Request was not understood']);

}

function l($payload){
    return json_encode($payload);
}