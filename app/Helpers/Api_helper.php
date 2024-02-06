<?php 

	 function GetToken($account)
	 {
	 	$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://gateway.telkomuniversity.ac.id/issueauth',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>$account,
		));

		$response = curl_exec($curl);

		  curl_close($curl);
	    $data=json_decode($response);
		   return $data;
	   
	 }


	 function GetProfile($token)
	 {
			 	$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://gateway.telkomuniversity.ac.id/issueprofile',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Bearer '.$token
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
	    $data=json_decode($response);
	    return $data;
	 }

	 function GetPosition($nik, $token)
	 {

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://gateway.telkomuniversity.ac.id/daf6c8ac3bb58fdea98628d505cf94cc/'.$nik,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Bearer '.$token
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
      $data=json_decode($response);
      return $data;
	 }


	 function GetContact($nik, $token)
	 {

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://gateway.telkomuniversity.ac.id/8386c04d4c9a631ead065bf69e16227f/'.$nik,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'GET',
			  CURLOPT_HTTPHEADER => array(
			    'Authorization: Bearer '.$token
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
      $data=json_decode($response);
      return $data->Data;
	 }

	 function NotifReqWa($data){
	 	$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://pedia.ypt.or.id/send-message',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_POSTFIELDS =>json_encode($data),
		  CURLOPT_HTTPHEADER => array(
		    'Content-Type: application/json'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$data=json_decode($response);
		return $data->status;
	 }


 ?>