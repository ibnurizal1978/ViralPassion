<?php


function youtube_video_statistics($video_id) {
	$base_url = "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" . $video_id . "&key=".env('YOUTUBE_API_KEY');
        $json = file_get_contents($base_url);

    	insertLog('youtube_video_statistics',$base_url,$json,"");
        return $json;
    }
function youtube_channel_statistics($video_id) {
		$base_url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&id=" . $video_id . "&key=".env('YOUTUBE_API_KEY');
        $json = file_get_contents($base_url);

    	insertLog('youtube_channel_statistics',$base_url,$json,"");
        return $json;
    }

function tiktok($link,$tipe)
    {
        $api = new \Sovit\TikTok\Api();

        if($tipe == "getUser")
        {
            $result = $api->getUser($link);
        }else
        {            
            $result = $api->getVideoByUrl($link);
        }

        // return $result;
    	insertLog('tiktok',json_encode(array('link' => $link, 'tipe' => $tipe)),json_encode($result),"");

        return json_encode($result);
    }

function smmCekKoneksi()
{
	$apiKey = env('SMM_API_KEY');
	$secretKey = env('SMM_SECRET_KEY');

	$client = new GuzzleHttp\Client;
	$base_url = "https://smartmedia.co.id/api/profile";

	$response = $client->request('POST', $base_url, ['query' => [
	    'api_key' => $apiKey, 
	    'secret_key' => $secretKey,
	]]);

	// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

	$statusCode = $response->getStatusCode();
    insertLog('smmOrder',json_encode([
	    'api_key' => $apiKey, 
	    'secret_key' => $secretKey,
	]),$response->getBody(),$base_url);

	$smmProfile = json_decode($response->getBody(), true);

	return $statusCode;
}

function smmOrder(array $arrData)
{
	$apiKey = env('SMM_API_KEY');
	$secretKey = env('SMM_SECRET_KEY');


	$curl = curl_init();
	$base_url = "https://smartmedia.co.id/api/order";

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $base_url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => array('api_key' => $apiKey,'secret_key' => $secretKey,'service' => $arrData['service_id'],'target' => $arrData['target'],'quantity' => $arrData['quantity']),
	));

	$response = curl_exec($curl);
    
    insertLog('smmOrder',json_encode($arrData),$response,$base_url);

	$data = json_decode($response, true);
	return $data;
}

function insertLog($api_name, $log_request, $log_response, $base_url = "")
{
	 DB::table('t_log_api')->insert([  
                    'log_date'     => date('Y-m-d H:i:s'),
                    'api_name'   => $api_name,
                    'log_request'           => $log_request,
                    'log_response'           => $log_response,
                    'api_url'			=> $base_url
                ]);
}


function filter_param($text,$html=true){
	$e_s=array('\\','\'','"','select','drop','delete','insert','update','from','union','script');
	$d_s=array('','','','','','','','','','','');
	$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
	$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
	$text = preg_replace( '/<!--.+?-->/', '', $text );
	$text = preg_replace( '/{.+?}/', '', $text );
	$text = preg_replace( '/&nbsp;/', ' ', $text );
	$text = preg_replace( '/&amp;/', '', $text );
	$text = str_replace( $e_s, $d_s, $text );
	$text = strip_tags( $text );
	$text = preg_replace("/\r\n\r\n\r\n+/", " ", $text);
	$text = $html ? htmlspecialchars( $text ) : $text;
	return $text;
}
