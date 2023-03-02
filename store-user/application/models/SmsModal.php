<?php

class SmsModal extends CI_Model {

	
	function get_sms_token() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.servetel.in/v1/auth/login",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS  => '{"email":"Info@factsuite.com","password":"Quinpro@123 demo"}',
			CURLOPT_HTTPHEADER => array(
				'accept: application/json',
				'content-type: application/json'
			),
		)); 
		$response = curl_exec($curl);
		$data = json_decode($response);
		// return $_SESSION['servtel_sms_token'] = $data->access_token;
		return $data->access_token;
	}

	function send_sms($sms_receiver_moboile_number,$sms_message,$servtel_sms_token) {
		$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.servetel.in/v1/send_sms",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS  => '{"customer_number":'.$sms_receiver_moboile_number.',"message":"'.$sms_message.'","type":"text"}',
            CURLOPT_HTTPHEADER => array(
                'accept: application/json',
                 'authorization:'.$servlet_sms_token,
                'content-type: application/json'
            ),
        )); 
        return $response = curl_exec($curl);
        // $curl_response_data = json_decode($response);
	}
}