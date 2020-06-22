<?php

require_once 'DBClass.php';

$db = new DB;

exit;
try{
$save_parcel_info = $db->prepare("INSERT INTO parcel_info
                sender_name,  sender_id,  parcel_origin,  parcel_description,  sender_mobile,   recipient_name, destination,  cost_of_delivery,  is_payed_for 
                VALUES(
                    :sender_name, 
                    :sender_id, 
                    :parcel_origin, 
                    :parcel_description, 
                    :sender_mobile, 
                    :recipient_name,
                    :recipient_mobile, 
                    :destination, 
                    :cost_of_delivery, 
                    :is_payed_for
                )
             ");

             $save_parcel_info->execute(
                 [
                    ":sender_name" => "sender_name", 
                    ":sender_id" => 12121212, 
                    ":parcel_origin" => "parcel_origin", 
                    ":parcel_description" => "parcel_description", 
                    ":sender_mobile" =>"13132323", 
                    ":recipient_name" => "recipient_name",
                    ":recipient_mobile" => 121212121, 
                    ":destination" => "destination", 
                    ":cost_of_delivery" => 12, 
                    ":is_payed_for" => 0
                ]);

                echo 'Success';
                 }
                 catch(PDOException $e){
                     echo $e->getMessage();
                 }
               
// "sender_name" => '',
// "parcel_origin" => '',
// "sender_mobile" => '',
// "sender_id" => '',
// "parcel_description" => '',
// "recipient_name" => '',
// "recipient_location" => '',
// "recipient_mobile" => '',
// "parcel_cost" => ''

$tables = "CREATE TABLE parcel_info(
    parcel_id int not null AUTO_INCREMENT,
    sender_name varchar(100) not null,
    sender_id varchar(15) not null,
    parcel_origin varchar(50) not null,
    parcel_description varchar(255) not null,
    sender_mobile varchar(15) not null,
    recipient_name varchar(100) not null,
    recipient_id varchar(15) not null,
    recipient_mobile varchar(15) not null,
    destination varchar(50) not null,
    cost_of_delivery double not null,
    mpesa_code varchar(20) default null,
    is_collected int default 0,
    is_payed_for int default 0
    PRIMARY KEY(parcel_id),
)";

$table .= "";