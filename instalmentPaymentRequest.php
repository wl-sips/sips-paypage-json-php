<?php
/*This file generates the payment request and sends it to the Sips server.
For more information on this use case, please refer to the following documentation:
https://documentation.sips.worldline.com/en/WLSIPS.004-GD-Functionality-set-up-guide.html */

session_start();

include('Common/paymentRequest.php');

//PAYMENT REQUEST

//You can change the values in session according to your needs and architecture
$_SESSION['secretKey'] = "002001000000002_KEY1";
$_SESSION['sealAlgorithm'] = "HMAC-SHA-256";
$_SESSION['normalReturnUrl'] = "http://localhost/code-samples/Sips-Paypage-JSON-PHP5/Common/getWebPaymentResponse.php";
$_SESSION["urlForPaymentInitialisation"] = "https://payment-webinit.simu.sips-atos.com/rs-services/v2/paymentInit/";

$requestData = array(
   "normalReturnUrl" => $_SESSION['normalReturnUrl'],
   "merchantId" => "002001000000002",
   "transactionReference" => "N835",
   "amount" => "2500",             //Note that the amount entered in the "amount" field is in cents
   "orderChannel" => "INTERNET",
   "currencyCode" => "978",
   "interfaceVersion" => "IR_WS_2.20",
   
   "paymentPattern" => "INSTALMENT",
   "instalmentData" => array(
      "number" => "3",
      "amountsList" => array('1000','1000','500'),   //The sum of these amounts must be equal to the content of the amount field
      "datesList" => array('20200805','20200806','20200807'),  //Change the dates according to the time of the test of this use case
      "transactionReferencesList" => array('N835','N935','N735'),   //The first reference must be equal to the one contained in the transactionReference field
   ),
);

$requestTable = generate_the_payment_request($requestData);

send_payment_request($requestTable, $_SESSION["urlForPaymentInitialisation"]);

?>
