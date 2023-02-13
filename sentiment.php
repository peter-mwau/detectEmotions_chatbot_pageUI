<?php
// $message = $_POST['message'];
# access JSON data from Ajax request
$data = json_decode(file_get_contents('php://input'), true);
# access message property of JSON data
$message = $data['message'];

$url = "https://elitecode-detect-emotions.hf.space/run/predict";


#array to hold data with message as json object

$data = array(
    'data' => array(
        $message
    )
);
if(isset($message)){
    $options = array(
  'http' => array(
    'method'  => 'POST',
    'content' => json_encode( $data ),
    'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
    )
);

$context  = stream_context_create( $options );
$result = file_get_contents( $url, false, $context );
$response = json_decode( $result );

# print each stdClass object in response
#convert stdClass object to array
$response = (array) $response;
print_r($response[0]);


# loop through each stdClass object in response
foreach($response['data'] as $obj){
  echo $obj->label;
}


}
?>
