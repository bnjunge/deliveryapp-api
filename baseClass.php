<?php
use AfricasTalking\SDK\AfricasTalking;
require_once 'DBClass.php';
require_once 'vendor/autoload.php';

class API extends DB{
    
    public $at;
    public $st_sms;
    public function __construct(){
        parent::__construct();

        $this->at = new AfricasTalking('at-username', 'at-api-key');
        $this->at_sms = $this->at->sms();
    }

    // collecting parcel details
    /**
     * Sender Name, Parcel Description, Sender Mobile, Sender ID number, Town
     *  Receipient Name, Mobile Number, Names, Town/Destination, cost
     */

     // sender info
     /**
      * $payload = [
            "sender_name" => '',
            "parcel_origin" => '',
            "sender_mobile" => '',
            "sender_id" => '',
            "parcel_description" => '',
            "recipient_name" => '',
            "recipient_location" => '',
            "recipient_mobile" => '',
            "parcel_cost" => ''
         ];
      */
     public function parcel_info($payload){
         try{
             $save_parcel_info = $this->con->prepare("INSERT INTO parcel_info(
                sender_name, 
                sender_id, 
                parcel_origin, 
                parcel_description, 
                sender_mobile, 
                recipient_name,
                recipient_mobile, 
                destination, 
                cost_of_delivery, 
                is_payed_for) 
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
                    )"
                );

             $save_parcel_info->execute(
                 [
                    ":sender_name" => $payload['sender_name'], 
                    ":sender_id" => $payload['sender_id'], 
                    ":parcel_origin" => $payload['parcel_origin'], 
                    ":parcel_description" => $payload['parcel_description'], 
                    ":sender_mobile" =>$payload['sender_mobile'], 
                    ":recipient_name" => $payload['recipient_name'],
                    ":recipient_mobile" => $payload['recipient_mobile'], 
                    ":destination" => $payload['destination'], 
                    ":cost_of_delivery" => $payload['cost_of_delivery'], 
                    ":is_payed_for" => $payload['is_payed_for']
                ]);

                // return ['code' =>1];
            
            if($this->con->lastInsertId() !== null){
                $sms = $this->send_parcel_sms_template($payload['sender_name'], $payload['recipient_name'], $payload['parcel_origin'], $payload['destination'],  $this->con->lastInsertId() );
                $send_sms = $this->at_sms->send([
                    'to' => $payload['recipient_mobile'],
                    'message' => $sms
                ]);
                return ['code' => 1, 'at_response' => $send_sms, 'message' => "Insert was success record id ". $this->con->lastInsertId(), 'sms' => $sms];
            } else {
                return ['code' => 0];
            }
         } catch(PDOException $e){
             return ['code' => 0, 'message' => $e->getMessage()];
         }
     }


     // message 
     public function send_parcel_sms_template($sender, $recipient, $origin, $destination, $parcelID){
        return "Hello {$recipient}, {$sender} has dispatched a parcel ID {$parcelID} from {$origin} to {$destination}. We will inform you when parcel is already at our collection point. \nSURVTECH";
     }

     // template for parcel at collection point
     public function parcel_at_collection_sms($recipient, $parcelID, $destination){
        return "Hello {$recipient}, parcel ID {$parcelID} has been received at our {$destination} offices. Please collect it as soon as possible and carry your original ID. \nSURVTECH";
     }


     // informing the recipient that parcel is at a collection  point, $parcelID
     public function parcel_at_collection_point($id){
         $parcel_info = $this->get_parcel_info($id);

         $msg = $this->parcel_at_collection_sms($parcel_info[0]['recipient_name'], $id, $parcel_info[0]['destination']);
        //  return $msg;
        $sms = $this->at_sms->send([
            'to' => $parcel_info[0]['recipient_mobile'],
            'message' => $msg
        ]);

        return $sms;
     }

     // lets get parcel info
     public function get_parcel_info($id){
         try{
            $parcel = $this->con->prepare("SELECT * FROM parcel_info WHERE parcel_id = :parcel_id");
            $parcel->execute([':parcel_id' => $id]);
            $parcel_data = $parcel->fetchAll(PDO::FETCH_ASSOC);
            
            if(empty(array_filter($parcel_data)))
                return ['code' => 0, 'message' => 'Nothing found'];
                
            return $parcel_data;
         } catch(PDOException $e){
             return $e->getMessage();
         }
     }

     // collect the parcel
     public function collect_parcel($payload){

     }


     // payment,
     // amount, phone number
     public function payments($payload){
        
     }


     public function send_sms(){
         
     }

}