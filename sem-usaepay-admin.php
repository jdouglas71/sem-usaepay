<?php 

   	//Vicinity Config File
   	require_once(dirname(__FILE__)."/config.php");

	global $sem_usaepay_key;
	global $sem_usaepay_testmode;

	if($_POST['sem_usaepay_hidden'] == 'Y') 
	{
		//Form data sent
		$sem_usaepay_key = $_POST['sem_usaepay_key'];
		$sem_usaepay_testmode = $_POST['sem_usaepay_testmode'];
		logToFile( "testmode: " . $sem_usaepay_testmode . "\n" );
		update_option('sem_usaepay_key', $sem_usaepay_key);
		update_option('sem_usaepay_testmode', $sem_usaepay_testmode);
		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	} 
	else 
	{
		//Normal page display
		$sem_usaepay_key = get_option('sem_usaepay_key');
		$sem_usaepay_testmode = get_option('sem_usaepay_testmode');
	}
?>

<div class="wrap">
	<?php    echo "<h2>" . __( 'SEM USA ePay Options', 'sem_usaepay_trdom' ) . "</h2>"; ?>
	
	<form name="sem_usaepay_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="sem_usaepay_hidden" value="Y">
		<p><?php _e("USA ePay Key: " ); ?><input type="text" name="sem_usaepay_key" value="<?php echo $sem_usaepay_key; ?>" size="50"></p>
		<p><?php _e("USA ePay TestMode: " ); ?><input type="checkbox" name="sem_usaepay_testmode" value="1" <?php if($sem_usaepay_testmode == '1') echo 'checked'; ?> ></p>
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'sem_usaepay_trdom' ) ?>" />
		</p>
	</form>
</div>