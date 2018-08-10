<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// Application credentials - change to yours (found in QB Dashboard)
DEFINE('APPLICATION_ID', '51212'); // Enter your application ID
DEFINE('AUTH_KEY', "s7tXtLa-Pyuzz2F"); // Enter yur auth key
DEFINE('AUTH_SECRET', "YVWX4X8GAvEbP37"); // Enter your secret key

// User credentials
DEFINE('USER_LOGIN', "jeet.ghosh"); // Your Username
DEFINE('USER_PASSWORD', "admin#123"); // Your Password

// Quickblox endpoints
DEFINE('QB_API_ENDPOINT', "https://api.quickblox.com/"); // API Endpoints URL
DEFINE('QB_PATH_SESSION', "session.json");


	function pr($array,$die=true)
	{
		echo '<pre>';
		print_r($array);
		if($die)
			die;
	}

	function quickAuth() 
	{
		$nonce = rand();
		$timestamp = time();
		$signature_string = "application_id=" . APPLICATION_ID . "&auth_key=" . AUTH_KEY . "&nonce=" . $nonce . "&timestamp=" . $timestamp . "&user[login]=" . USER_LOGIN . "&user[password]=" . USER_PASSWORD;

		$signature = hash_hmac('sha1', $signature_string, AUTH_SECRET);

		// Build post body
		$post_body = http_build_query(array(
		    'application_id' => APPLICATION_ID,
		    'auth_key' => AUTH_KEY,
		    'timestamp' => $timestamp,
		    'nonce' => $nonce,
		    'signature' => $signature,
		    'user[login]' => USER_LOGIN,
		    'user[password]' => USER_PASSWORD
		));

		// Configure cURL
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION);
		curl_setopt($curl, CURLOPT_POST, true); // Use POST
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Receive server response
		// Execute request and read response
		$response = curl_exec($curl);
		// Close connection
		curl_close($curl);
		// Check errors
		if ($response) {
		        return json_decode($response);
		        //pr($data->session->token);
		} else {
		        return false;
		}
	}

	function quickAuthbyUser($USER_LOGIN="",$USER_PASSWORD="") 
	{
		$nonce = rand();
		$timestamp = time();
		$signature_string = "application_id=" . APPLICATION_ID . "&auth_key=" . AUTH_KEY . "&nonce=" . $nonce . "&timestamp=" . $timestamp . "&user[login]=" . $USER_LOGIN . "&user[password]=" . $USER_PASSWORD;

		$signature = hash_hmac('sha1', $signature_string, AUTH_SECRET);

		// Build post body
		$post_body = http_build_query(array(
		    'application_id' => APPLICATION_ID,
		    'auth_key' => AUTH_KEY,
		    'timestamp' => $timestamp,
		    'nonce' => $nonce,
		    'signature' => $signature,
		    'user[login]' => $USER_LOGIN,
		    'user[password]' => $USER_PASSWORD
		));

		// Configure cURL
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT . '/' . QB_PATH_SESSION);
		curl_setopt($curl, CURLOPT_POST, true); // Use POST
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body); // Setup post body
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Receive server response
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Receive server response
		// Execute request and read response
		$response = curl_exec($curl);
		// Close connection
		curl_close($curl);
		// Check errors
		if ($response) {
		        return json_decode($response);
		        //pr($data->session->token);
		} else {
		        return false;
		}
	}

	function quickAddUsers($token,$post_array=array()) 
	{

		$post_body = http_build_query($post_array);

		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users.json');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Accept: application/json',
		    'Content-Type: application/x-www-form-urlencoded',
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		
		$response = curl_exec($curl);
		
		if ($response) 
		{
		        return json_decode($response);
		} 
		else 
		{
		        return false;
		}
		
		curl_close($curl);
	}

	function quickAddBlob($token,$post_array=array()) 
	{
		//print_r($post_array);exit;

		$post_body = http_build_query($post_array);



		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'blobs.json');
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Accept: application/json',
		    'Content-Type: application/x-www-form-urlencoded',
		    'Content-Type: multipart/form-data',
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		
		$response = curl_exec($curl);
		
		if ($response) 
		{
		        return json_decode($response);
		} 
		else 
		{
		        return false;
		}
		
		curl_close($curl);
	}

	function quickGetUsers($token,$username) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users/by_login.json?login='.$username);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		//pr(json_decode($response));
		//exit;
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickGetUsersbyEmail($token,$email) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users/by_email.json?email='.$email);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		//pr(json_decode($response));
		//exit;
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickGetBlobs($token) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'blobs.json');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		//pr(json_decode($response));
		//exit;
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickGetUserbyId($token,$user_id) {

		//echo $user_id;
// echo 'users/'.$user_id.'.json';
		//exit;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users/'.$user_id.'.json');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		//pr(json_decode($response));
		//exit;
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickUpdateUserbyId($token,$user_id,$post_array=array()) {

		//echo $user_id;
//echo 'users/'.$user_id.'.json';
		//exit;

		//print_r($upd_body);exit;

		$post_body = http_build_query($post_array);

		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users/'.$user_id.'.json');
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Accept: application/json',
		    'Content-Type:multipart/form-data',
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		
		$response = curl_exec($curl);
		
		if ($response) 
		{
		        return json_decode($response);
		} 
		else 
		{
		        return false;
		}
		
		curl_close($curl);
	}

	function quickUpdateBlobSize($token,$blob_id,$post_array=array()) {

		//echo $user_id;
//echo 'users/'.$user_id.'.json';
		//exit;

		//print_r($upd_body);exit;

		$post_body = http_build_query($post_array);

		$curl = curl_init();
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'blobs/'.$blob_id.'/complete.json');
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_body);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Accept: application/json',
		    'Content-Type:multipart/form-data',
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		
		$response = curl_exec($curl);
		
		if ($response) 
		{
		        return json_decode($response);
		} 
		else 
		{
		        return false;
		}
		
		curl_close($curl);
	}

	function quickResetPassword($token,$email) 
	{

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'users/password/reset.json?email='.$email);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		//pr(json_decode($response));
		//exit;
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickGetDialog($token) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'chat/Dialog.json');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);
		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}

	function quickGetMessage($token, $dialogId) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, QB_API_ENDPOINT.'chat/Message.json?chat_dialog_id=' . $dialogId);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'QuickBlox-REST-API-Version: 0.1.0',
		    'QB-Token: ' . $token
		));
		$response = curl_exec($curl);

		if ($response) {
		        return json_decode($response);
		} else {
		        echo false;
		}
		curl_close($curl);
	}


	function distance($lat1, $lon1, $lat2, $lon2, $unit) {

		$lat1=(double)$lat1;
		$lon1=(double)$lon1;
		$lat2=(double)$lat2;
		$lon2=(double)$lon2;

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
	    return (round(($miles * 1.609344),2));
	  } else if ($unit == "N") {
	      return ($miles * 0.8684);
	    } else {
	        return $miles;
	      }
	}

function getCategoryName($category_id='') {
    
    $CI = &get_instance();
    
    $CI->load->model('admin/trend_model');
    
    $result= $CI->trend_model->GetCatName($category_id);

    return $result;
}

function getSubCategoryName($subCategory_id='') {
    
    $CI = & get_instance();
    
    $CI->load->model('admin/trend_model');
    
    $result= $CI->trend_model->GetSubCatName($subCategory_id);

    return $result;
}

function getProductName($product_id='') {
    
    $CI = & get_instance();
    
    $CI->load->model('admin/product_model');
    
    $result= $CI->product_model->GetProductName($product_id);

    return $result;
}

function getUserName($user_id='') {
    
    $CI = & get_instance();
    
    $CI->load->model('admin/product_model');
    
    $result= $CI->product_model->getUserName($user_id);

    return $result;
}

?>
