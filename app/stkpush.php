<?php

include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
$processrequstUrl ='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = '';
$passKey ='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$BusinessShortCode = '174379';
$timestamp = date('YmdHis');

//ECRYPT Data to get PASSWORD
$password = base64_encode($BusinessShortCode, $passKey, $timestamp);
$phone = '254745880757';
$money = '1';
$transactionType = 'CustomerPayBillOnline';
$PartyA = $phone;
$partyB = '254708374149';
$accountReference = 'ChurchManagement App';
$transactionDescription = 'STK TEST';
$Amount = $money;
$stkpusherheader = ['Content-Type:application/json', 'Authorization:Bearer' . $access_token];

// INITIATING CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequstUrl );
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpusherheader );  //setting HTTP custom headers

$curl_post_data = array (
    // Requst parameters with default values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => $transactionType,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $partyB,
    'phoneNumber' => $PartyA,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $accountReference,
    'TransactionDescription' => $transactionDescription
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);