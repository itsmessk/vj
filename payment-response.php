<?php
include_once('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $encData = $_POST['EncData'];
    $secureHash = $_POST['SecureHash'];
    logTransaction(json_encode($_POST));
    // Decrypt the EncData
    $decryptedData = openssl_decrypt($encData, 'AES-256-CBC', ENCRYPTION_KEY, 0, 'IV_VALUE');
    $response = json_decode($decryptedData, true);

    // Validate the SecureHash
    $hashString = SECURE_HASH_SECRET . $response['TxnRefNo'] . $response['Amount'];
    $calculatedHash = hash('sha256', $hashString);

    if ($secureHash === $calculatedHash) {
        // Update the Orders table
        $status = $response['ResponseCode'] === '00' ? 'Success' : 'Failed';
        $orderNumber = $response['OrderInfo'];
        $txnRefNo = $response['TxnRefNo'];

        $query = "UPDATE Orders SET PaymentStatus='$status', TxnRefNo='$txnRefNo', PaymentGatewayResponse='" . json_encode($response) . "' WHERE OrderNumber='$orderNumber'";
        mysqli_query($con, $query);
    } else {
        echo "Invalid secure hash!";
    }
}


function logTransaction($message) {
    file_put_contents('logs/transactions.log', date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

?>
