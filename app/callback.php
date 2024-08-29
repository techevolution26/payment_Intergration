<?php
header ('Content-Type: application/json');

$stkCallbackResponse =file_get_contents('php://input');
$logFile = "Mpesastkresponse.json";
$log =fopen($logFile, 'a');
fwrite($log,$stkCallbackResponse);
fclose($log);

$jsonResponse = json_decode($stkCallbackResponse, true);

$MerchantRequestID = $jsonResponse-> Body->stkCallback->MerchantRequstID;
$checkoutRequestID = $jsonResponse['Body']['stkCallback']['CheckoutRequestID'];
$responseCode = $jsonResponse['Body']['stkCallback']['ResponseCode'];

    $transactionType = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Name'];
    $transactionId = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
    $amount = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][2]['Value'];
    $mpesaReceiptNumber = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
    $balance = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
    $transactionDate = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][5]['Value'];
    $phoneNumber = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][6]['Value'];
    $customerMessage = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][7]['Value'];
    $checkoutRequestID = $jsonResponse['Body']['stkCallback']['CallbackMetadata'];


if ($responseCode == 0){
    
    $responseDescription = "Payment was successful";
    $status = "Completed";
}