<?php

global $wpdb;

/** Directories */
define('SEM_USAEPAY_DIR', dirname(__FILE__)."/");
define('SEM_USAEPAY_RELATIVE_DIR', "/wp-content/plugins/sem-usaepay/");
define('SEM_USAEPAY_CALLBACK_DIR', get_option("siteurl").SEM_USAEPAY_RELATIVE_DIR);
define('SEM_USAEPAY_CSS', SEM_USAEPAY_CALLBACK_DIR."sem-usaepay.css");

/** Logfile */
define('LOGFILE', SEM_USAEPAY_DIR.'SEM_USAEPAY.log');
/** WordPress Script Debug Flag */
define('SCRIPT_DEBUG', true );

/** Version */
$sem_usaepay_version = "0.5";
$sem_usaepay_key = "";
$sem_usaepay_testmode = "0";

/** Scripts */
require_once(SEM_USAEPAY_DIR.'functions.php');

?>
