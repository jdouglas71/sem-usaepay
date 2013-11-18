<?php

//User functions
//require_once(ABSPATH . WPINC . '/registration.php');

/**
 * Form SEM_USAEPAY
 */
function sem_usaepay_form($width="100%")
{
	global $sem_usaepay_key;
	global $sem_usaepay_testmode;

    $retval = "";

	$retval .= "<h2 style='color:#c57f20;'>Make a Donation</h2>";
	$retval .= "<p>Your contribution will help fund Making Headway's services to traumatically brain injured individuals and families;";
	$retval .= "and our prevention education program in local schools.</p>";

    $retval .= '<form action="https://www.usaepay.com/interface/epayform/">';
	$retval .= '<input type="hidden" name="UMkey" value="'.$sem_usaepay_key.'">';
	$retval .= '<input type="hidden" name="UMcommand" value="sale">';
	//$retval .= '<label for="UMinvoice">Invoice Number</label>';
	//$retval .= '<input type="text" class="sem_usaepay_input"  name="UMinvoice" value="" autofocus><br />';
	$retval .= "<h2 style='color:#c57f20;'>Amount</h2>";
	$retval .= '<input type="text" class="sem_usaepay_input" name="UMamount" value=""><br />';
	$retval .= '<input type="hidden" name="UMhash" value="[hash]">';
	$retval .= '<input type="hidden" name="UMtestmode" value="'.$sem_usaepay_testmode.'">';
	$retval .= '<input type="submit" class="sem_usaepay_submit" value="Continue to Payment Form">';
	$retval .= '</form>';

    return $retval;
}

/**
 * Logging to file.                                       
 */
function logToFile($msg)
{ 
    // open file
    $fd = fopen(LOGFILE, "a");
    // append date/time to message
    $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg; 
    // write string
    fwrite($fd, $str . "\n");
    // close file
    fclose($fd);
}

function varDumpStr($var)
{
	ob_start();
	var_dump( $var );
	$out = ob_get_clean();
	return $out;
}





