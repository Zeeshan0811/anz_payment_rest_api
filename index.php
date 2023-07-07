<?php

$API_PASSWORD = "ca2415de588eb30cedfc87e22461bcbd";
$API_USERNAME = "merchant.TESTAWLLEADE";
$API_MARCHANT = "TESTAWLLEADE";
// $API_USERNAME = "merchant.AWLLEADE";
// $API_MARCHANT = "AWLLEADE";
$API_OPERATION = "PURCHASE";
$API_MARCHANT_NAME = "LEADERSHIP COLLEGE AUSTRALIA LTD";
$ORDER_ID =  rand(100000, 999999);
$AMOUNT =  100;
$CURRENCY =  "AUD";
$DESCRIPTION =  "Hello World";


$POSTFIELDS = 'apiOperation=INITIATE_CHECKOUT&apiPassword=' . $API_PASSWORD . '&apiUsername=' . $API_USERNAME . '&merchant=' . $API_MARCHANT . '&interaction.operation=' . $API_OPERATION . '&interaction.merchant.name=' . $API_MARCHANT_NAME . '&order.id=' . $ORDER_ID . '&order.amount=' . $AMOUNT . '&order.currency=' . $CURRENCY . '&order.description=' . $DESCRIPTION;

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://anzworldline.gateway.mastercard.com/api/nvp/version/72',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $POSTFIELDS,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded'
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

echo '</br>';
echo '</br>';
$res = array();
parse_str($response, $res);
echo ($res['session_id']);


?>

<html>

<head>
    <script src="https://anzworldline.gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback" data-cancel="cancelCallback"></script>
    <script type="text/javascript">
        function errorCallback(error) {
            console.log(JSON.stringify(error));
            alert('An Error has occured. Please try again later');
        }

        function cancelCallback() {
            console.log('Payment cancelled');
            alert('Payment Cancelled');
        }
        Checkout.configure({
            session: {
                id: '<?php echo $res['session_id']; ?>'
            }
        });
    </script>
</head>

<body>
    <div id="embed-target"> </div>
    <input type="button" value="Pay with Embedded Page" onclick="Checkout.showEmbeddedPage('#embed-target');" />
    <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
</body>

</html>