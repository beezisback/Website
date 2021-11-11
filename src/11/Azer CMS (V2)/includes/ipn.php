<?php include("../global/config/config.php");
$connect = mysql_connect("$host", "$user", "$pass") or die("Connection Error: ". mysql_error());
mysql_select_db("$db_s", $connect) or die("Database Error: ". mysql_error());
//Set Date
date_default_timezone_set('US/Pacific');
$date = date("l F d, Y @ g:i A");
// PHP 4.1

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

// assign posted variables to local variables
                        $transaction_id = $_POST['txn_id'];
                        $payer_email    = $_POST['payer_email'];
                        $item_name = $_POST['item_name'];
                        $item_number = $_POST['item_number'];
                        $payment_status = $_POST['payment_status'];
                        $payment_amount = $_POST['mc_gross'];
                        $payment_currency = $_POST['mc_currency'];
                        $txn_id = $_POST['txn_id'];
                        $receiver_email = $_POST['receiver_email'];
                        $username = $_POST['custom'];

if (!$fp) {
$log_file = "log.txt";
$copen = fopen($log_file, 'w') or die("Can't open the log.");
$log = "Payment failed @ {$date}. Details:

Transaction Id: {$transaction_id}
Payer Email: {$payer_email}
Item Name: {$item_name}
Item Number: {$item_number}
Payment Status: {$payment_status}
Payment Amount: {$payment_amount}
Payment Currency: {$payment_currency}
Txn Id: {$txn_id}
Receiver Email: {$receiver_email}
User: {$username}";
fwrite($copen, $log);
fclose($copen);
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {
$sql = mysql_query("SELECT dp FROM $db_a.account WHERE username='$username'");
while($get = mysql_fetch_array($sql)){
$old_dp = $get['dp'];
$new_dp = $old_dp + $payment_amount;
mysql_query("UPDATE $db_a.account set dp='$new_dp' WHERE username='$username'");
mysql_query("INSERT INTO vip_log (type, user, email, cost, status) VALUES ('Donation', '$username', '$payer_email', '$payment_amount', 'Successful')");
}}
else if (strcmp ($res, "INVALID") == 0) {
mysql_query("INSERT INTO vip_log (type, user, email, cost, status) VALUES ('Donation', '$username', '$payer_email', '$payment_amount', 'UnSuccessful')");
}
}
fclose ($fp);
}
?>