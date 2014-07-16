<?php

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2011-2014 BitPay
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
 
require './auth.php';	
require $xcart_dir.'/modules/Bitpay/bp_lib.php';

$module_params = func_get_pm_params('ps_bitpay.php');
$api_key = $module_params['param01'];
$transaction_speed = $module_params['param02'];

if (!isset($_POST['paymentid'])) { // POST from bitpay's server
	
	$invoice = bpVerifyNotification($api_key);
	if (is_string($invoice)) { 
		bpLog($invoice); // log the error
	}
	else	
	{
		// fetch session
		$skey = $orderids = $invoice['posData'];
		$bill_output['sessid'] = func_query_first_cell("SELECT sessid FROM $sql_tbl[cc_pp3_data] WHERE ref='".$orderids."'");

		// APC system responder
		foreach ($_POST as $k => $v) {
			$advinfo[] = "$k: $v";
		}
			
		// update order status
		if ($invoice['status'] == 'confirmed' or $invoice['status'] == 'complete')
		{
			$bill_output['sessid'] = func_query_first_cell("SELECT sessid FROM $sql_tbl[cc_pp3_data] WHERE ref='".$orderids."'");
				
			$bill_output['code'] = 1;			
			$bill_output['billmsg'] = 'Order paid for';
			require($xcart_dir.'/payment/payment_ccend.php');
    
		}
		#elseif (invoice['status'] == 'expired')
			#$bill_output['code'] = 2;
			#$bill_output['billmes'] = 'expired';
			#require($xcart_dir.'/payment/payment_ccend.php');

	}
	
} 
else { // POST from customer placing the order

    if (!defined('XCART_START')) { header("Location: ../"); die("Access denied"); }	
	
	// associate order id with session
	$_orderids = join("-",$secure_oid);
    if (!$duplicate)
        db_query("REPLACE INTO $sql_tbl[cc_pp3_data] (ref,sessid,trstat) VALUES ('".$_orderids."','".$XCARTSESSID."','GO|".implode('|',$secure_oid)."')");
	
	// create invoice
	$options = array(
		//'currency' => $currency,
		'currency' => $module_params['param03'],
		'notificationURL' => $current_location.'/payment/ps_bitpay.php',
		'redirectURL' => $current_location.'/order.php?orderid='.$_orderids,
		'transactionSpeed' => $transaction_speed,
		'apiKey' => $api_key,
		'buyerName' => $bill_firstname . ' ' . $bill_lastname,
		'buyerAddress1' => $userinfo['s_address'],
		'buyerCity' => $userinfo['s_city'],
		'buyerState' => $userinfo['s_statename'],
		'buyerZip' => $userinfo['s_zipcode'],
		'buyerCountry' => $userinfo['s_country'],
		'buyerEmail' => $userinfo['email']
		);
	$invoice = bpCreateInvoice($_orderids, $cart['total_cost'], $_orderids, $options);
	
	if (isset($invoice['error']))
	{
		bpLog($invoice['error']);
	}
	else
	{
		// headers already sent by xcart, so use JS
		print "<script> window.location = '$invoice[url]'; </script>"; 
		exit;
	}
}
