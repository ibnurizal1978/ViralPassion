<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Crypt;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\DecryptException;
use Phpfastcache\Helper\Psr16Adapter;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Order extends Controller
{
   
   public function indexs($id)
   {
        $instagram = new \InstagramScraper\Instagram();

        // set RapidApi key to use https://rapidapi.com/restyler/api/instagram40
        $instagram->setRapidApiKey(env('RAPID_API_KEY'));

        // For getting information about account you don't need to auth:
        $account = $instagram->getAccount('taufan.wae');

       var_dump($account); 

   }
  
    public function index($id)
    {
        $product_id = "";
        $id  = filter_param($id);

        try {
           $product_id = Crypt::decrypt($id);
        } catch (DecryptException  $e) {
            $product_id = "0";
        }
      

        $site   = DB::table('konfigurasi')->first();
          $faq = DB::table('t_faq')
            ->where('active_status','=','1')
            ->orderBy('faq_id','ASC')
            ->get();

        $product = DB::table('t_produk')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where('t_produk.product_id','=',$product_id)
            ->select('*')
            ->first();

            $placeholder = "Your ".$product->services_name." username";
            $action = "checkout";

            if($product->service_id == "2" && $product->tipe_id == "4")
            {
                $placeholder = "example Link : https://www.youtube.com/channel/UCeGXh1DcMur96zNDZSJbiGXzpg";
            }else if($product->service_id == "2" && $product->tipe_id != "4")
            {
                $placeholder = "example Link : https://www.youtube.com/watch?v=92lmPnse123GnxRc";
            }else if($product->service_id == "3" && $product->tipe_id == "1")
            {
                $placeholder = $placeholder.", example username: xyz (without @)";
            }else if($product->service_id == "3" && $product->tipe_id != "1")
            {
                $placeholder = "example link : https://www.tiktok.com/@ramssyeoddxn/video/70341539510449179930";
            }


            if($product->service_id == "1" && $product->tipe_id != "1")
            {
                $action = "select-media";
            }


		$data = array(  'site'		=> $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'product'   => $product,
                        'id'        => $id,
                        'action'    => $action,
                        'placeholder'        => $placeholder,
                        'content'	=> 'order/index'
                    );
        return view('layout/wrapper',$data);
    }

    //public function

    public function checkout(Request $r)
    {

        $link           = filter_param($r->username);
        $email          = filter_param($r->email_Address);
        $id             = filter_param($r->product_id);
        $product_id     = Crypt::decrypt($id);
        $session_id     = Session::getId();
        $site           = DB::table('konfigurasi')->first();
        $linkIg          = isset($r->chk_box) ? $r->chk_box[0] : "";

        
        $product = DB::table('t_produk')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where('t_produk.product_id','=',$product_id)
            ->select('*')
            ->first();

        $dataScrap  = array();
        $scrap      = "";
        $img        = "";
        $count      = "";
        $display_error = "";
        $content    = 'order/checkout';

        if($product->service_id == "2" && ($product->tipe_id == "2" || $product->tipe_id == "3")) //youtube
        {
            $exp = explode('=', $link);
            $scrap = youtube_video_statistics($exp[1]);


            $res = json_decode($scrap);

            if(count($res->items) > 0)
            {
                $dataScrap = $res->items[0]->statistics;
                $img = "https://img.youtube.com/vi/".$exp[1]."/hqdefault.jpg";

                if($product->tipe_id == "2")
                {
                    $count = " : ".number_format($dataScrap->likeCount,0,',','.');
                }else
                {
                    $count = " : ".number_format($dataScrap->viewCount,0,',','.');
                }
            }else
            {
                $display_error = "Invalid Link";
            }

        }else if($product->service_id == "2" && $product->tipe_id == "4")  // youtube
        {
            $exp = explode('/', $link);
            $scrap = youtube_channel_statistics($exp[4]);

            // echo $scrap; die;
            $res = json_decode($scrap);

            // var_dump($res->items[0]->statistics->subscriberCount); die;

            if(count($res->items) > 0)
            {
                $channelImage = file_get_contents("https://www.googleapis.com/youtube/v3/channels?part=snippet&fields=items%2Fsnippet%2Fthumbnails%2Fdefault&id=".$exp[4]."&key=".env('YOUTUBE_API_KEY'));

                $jsonchannelImage = json_decode($channelImage);
                $img = $jsonchannelImage->items[0]->snippet->thumbnails->default->url;
                $dataScrap = $res->items[0]->statistics;
                $count = " : ".number_format($res->items[0]->statistics->subscriberCount,0,',','.');
            }else
            {
                $display_error = "Invalid Link";
            }
        }else if($product->service_id == "3" && $product->tipe_id == "1") // tiktok follower
        {
                $scrap = tiktok($link,'getUser');

                    // var_dump($scrap); die;

                if($scrap != "{}")
                {
                    $res = json_decode($scrap);
                    $img = $res->user->avatarLarger;
                    $dataScrap = $res->stats;
                    $count = " : ".number_format($dataScrap->followerCount,0,',','.');
                }else
                {
                    $display_error = "Invalid Username";
                }


        }else if($product->service_id == "3" && ($product->tipe_id == "2" || $product->tipe_id == "3")) // tiktok video
        {
            
                $scrap = tiktok($link,'getVideo');


                if($scrap != "{}")
                {
                    $res = json_decode($scrap);
                // print_r($res->items[0]); die;
                    $img = $res->items[0]->video->cover;

                    $dataScrap = $res->items[0]->stats;
                    if($product->tipe_id == "2") // likes
                    {
                        $count = " : ".number_format($dataScrap->diggCount,0,',','.');
                    }else // else = views
                    {
                        $count = " : ".number_format($dataScrap->playCount,0,',','.');
                    }
                }else
                {
                    $display_error = "Invalid Username";
                }

                
        }else if($product->service_id == "1" && $product->tipe_id == "1") // IG followers
        {


            $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
            $instagram->setRapidApiKey(env('RAPID_API_KEY'));

            $account = $instagram->getAccount($link);

            var_dump($account); die;


            

                 //$dt = getMediaByUsername($link,1);
                 if($account != "404")
                 {
                     $img = 'data:image/jpg;base64,'.base64_encode(file_get_contents($account->getProfilePicUrl()));
                     $count = " : ".number_format(trim($account->getFollowedByCount()),0,',','.');
                 }else
                 {
                    $display_error = "Invalid Username";
                 }

        }else if($product->service_id == "1" && $product->tipe_id != "1") // IG Like - Views
        {


            $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
            $instagram->setRapidApiKey(env('RAPID_API_KEY'));
            $link  =$linkIg; 
            $account = $instagram->getMediaByUrl($link);
            // print_r($account); die;
            // print_r($account); die;
                 if($account != "404")
                  {
                     $img = 'data:image/jpg;base64,'.base64_encode(file_get_contents($account->getImageLowResolutionUrl()));
                     $count = "";
                 }else
                 {
                    $display_error = "Invalid Username";
                 }

        }


        
            $cekData = DB::table('t_customers')
                                ->where(['customer_email' => $email, 
                                    'customer_link' => $link])
                                ->count();

            if($cekData > 0)
            {
                DB::table('t_customers')->where(['customer_email' => $email, 
                                        'customer_link' => $link])
                                    ->delete();
            }
             DB::table('t_customers')->insert([  
                    'customer_link'    => $link, 
                    'customer_email'     => $email,
                    'customer_product_id' => $product_id,
                    'session_id'           => $session_id,
                    'customer_created_dt' => date('Y-m-d H:i:s')
                ]);



        
        $data = array(  'site'      => $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'img_review'   => $img,
                        'dataScrap'    => $dataScrap,
                        'product'      => $product,
                        'product_id'   => $id,
                        'img'           => $img,
                        'id'                => $id,
                        'session_id'    => Crypt::encrypt($session_id),
                        'display_error'  => $display_error,
                        'count'           => $count,
                        'content'      => $content
                    );
        return view('layout/wrapper',$data);

    }


    public function selectMedia(Request $r)
    {
        $link           = filter_param($r->username);
        $email          = filter_param($r->email_Address);
        $id                = $r->id;
        $product_id     = Crypt::decrypt($id);
        $session_id     = Session::getId();
        $site   = DB::table('konfigurasi')->first();

        
        

        $product = DB::table('t_produk')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where('t_produk.product_id','=',$product_id)
            ->select('*')
            ->first();

        $dataScrap  = array();
        $scrap      = "";
        $img        = "";
        $count      = ""; 
        $valid = true;

      if($product->service_id == "1" && $product->tipe_id != "1")   // likes - views
        {
 
                $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
                $instagram->setRapidApiKey(env('RAPID_API_KEY'));
                
                $media = $instagram->getAccountInfo($link);
                     
                if($media != "404")
                {
                    // $res = json_decode($media);
                    // $img = 'data:image/jpg;base64,'.base64_encode(file_get_contents($res->user_info->profilepic));
                    // $count = " : ".number_format(trim($res->user_info->followers),0,',','.');
                    // $dataScrap = $res->user_media;

                     // $nonPrivateAccountMedias = $instagram->getMedias('taufan.wae',20);
                    $scrap = $instagram->getMedias($link, 8); 
                    // $media = $medias[0];

                    foreach ($scrap as $key) {
                        $d['link']  = $key->getLink();
                        $d['original'] = $key->getImageHighResolutionUrl();

                        array_push($dataScrap, $d);
                    }

                } 

                // print_r($dataScrap); die;
                 

        }

        $data = array(  'site'      => $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'img_review'   => $img,
                        'dataScrap'    => $dataScrap,
                        'product'      => $product,
                        'product_id'   => $id,
                        'email'   => $email,
                        'username'   => $link,
                        'img'           => $img,
                        'count'           => $count,
                        'content'      => 'order/media_ig'
                    );
        return view('layout/wrapper',$data);

    }

     public function ig_load_more(Request $r)
    {
        $link           = filter_param($r->username); 
        $next_page_for_img_load           = filter_param($r->next_page_for_img_load); 
        $product_id     = Crypt::decrypt(filter_param($r->product_id)); 


        
        $product = DB::table('t_produk')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where('t_produk.product_id','=',$product_id)
            ->select('*')
            ->first();

        $dataScrap  = array();
        $scrap      = "";
        $img        = "";
        $count      = ""; 

     
        $max = $next_page_for_img_load+8;

          $instagram = new \InstagramScraper\Instagram(new \GuzzleHttp\Client());
            $instagram->setRapidApiKey(env('RAPID_API_KEY'));
            $scrap = $instagram->getMedias($link, $max); 
                    // $media = $medias[0];
            foreach ($scrap as $key) {
                $d['link']  = $key->getLink();
                $d['original'] = $key->getImageHighResolutionUrl();
                array_push($dataScrap, $d);
            }

            if(count($scrap) <= $max)
            {
                $max = count($scrap);
            }

        
        $html = "";


        if(count($scrap) > 0)
        {
            for($i = $next_page_for_img_load; $i < $max; $i++)
            {
                $html .= '<div class="img_box" style=" width: 125px;height: 125px;float: left; margin-bottom: 50px;">
                             <label class="img_checkbox_holder text-center">                        
                                <div class="set_images" style="margin-top:0px;" id="img">
                                   <img src="data:image/jpg;base64,'.base64_encode(file_get_contents($dataScrap[$i]['original'])).'" style="height:130px; width:120px;border: 1px solid #bbb;">
                                   <input type="checkbox" class="check" style="width:20px;" name="chk_box" value="'.$dataScrap[$i]['link'].'" id="'.$dataScrap[$i]['link'].'">
                                </div>
                             </label>
                          </div>';
            }
        }

        echo $html;
 
    }

 

    public function paymentCreate(Request $request)
    {
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();

        $data = json_decode($request->getContent(), true);
        $id             = filter_param($data['product_id']);
        $session_id     = filter_param($data['session_id']);
        $payment_channel     = filter_param($data['payment_channel']);

        $session_id     = Crypt::decrypt($session_id);
        $product_id     = Crypt::decrypt($id); 
        $site           = DB::table('konfigurasi')->first(); 

        if(!isset($id) || $id == "" || $session_id == "" || !isset($session_id))
        {
            return redirect('order/'.$id);
        }

        
        $product = DB::table('t_customers')
            ->join('t_produk','t_produk.product_id','t_customers.customer_product_id')
            ->join('t_services','t_services.services_id','t_produk.service_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where([
                    't_customers.session_id' => $session_id,
                    't_customers.customer_product_id' => $product_id
                    ])
            ->select('*')
            ->first();



            $amount =  $product->product_price;
            $tax = "0.00";
            $shipping = "Jakarta - Indonesia";
            $handling_fee = "0.00";
            $description = $product->product_name;


           $provider->setCurrency($site->currency_name);

           $token = $provider->getAccessToken();


           $provider->setAccessToken($token);           
            $data = json_decode('{
                "intent": "CAPTURE",
                "purchase_units": [
                  {
                    "amount": {
                      "currency_code": "'.$site->currency_name.'",
                      "value": "'.$amount.'"
                    }
                  }
                ]
            }', true);

            $order = $provider->createOrder($data);
            insertLog('paypalCreateOrder',json_encode($data),json_encode($order));

      
            DB::table('t_orders')->insert([  
                    'customer_id'    => $product->customer_id, 
                    'order_date'     => date('Y-m-d H:i:s'),
                    'services_id'   => $product->service_id,
                    'product_id'           => $product_id,
                    'no_invoice'           => $order['id'],
                    'order_amount'           => $product->product_price,
                    'order_status'           => "pending",
                    'payment_channel'           => $payment_channel
                ]);

            

        return response()->json($order);
    }

    public function paymentCapture(Request $request)
    {

        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token); 

        $data = json_decode($request->getContent(), true);
        $orderId = filter_param($data['orderId']);

        $result = $provider->capturePaymentOrder($orderId);
            insertLog('capturePaymentOrder',$orderId,json_encode($result));


        DB::table('t_orders')
            ->where(['no_invoice' => $orderId])
            ->update([                      
                    'payment_date_time'     => date('Y-m-d H:i:s'),
                    'order_status'           =>  'COMPLETED' //$result['status']
                ]);


        if($result['status'] == "COMPLETED")
        {
           
                $res = smmCekKoneksi();
            if($res == 200)
            {

                $orderData  =  DB::table('t_orders')
                                ->join('t_customers','t_customers.customer_id','t_orders.customer_id')
                                ->join('t_produk','t_produk.product_id','t_orders.product_id')
                                ->where(['no_invoice' => $orderId])->first();

                
                $data = array('service_id' => $orderData->product_id_smm,
                    'target' => $orderData->customer_link,
                    'quantity' => $orderData->product_qty
                );

                $resOrder = smmOrder($data);
                if($resOrder['result'])
                {
                    $result = $resOrder['result'];
                    if($resOrder['result'])
                    {
                        $result = "COMPLETED";
                    }

                     DB::table('t_orders')
                        ->where(['no_invoice' => $orderId])
                        ->update([                      
                            'response_service'     => $result
                            ]);

                }else
                {
                    DB::table('t_orders')
                        ->where(['no_invoice' => $orderId])
                        ->update([                      
                            'response_service'     => $resOrder['data']['msg']
                            ]);
                }

            }else
            {
                  DB::table('t_orders')
                    ->where(['no_invoice' => $orderId])
                    ->update([                      
                            'response_service'     => "FALIED"
                        ]);
            }

            $mail = $this->sendMailConfirmOrder($orderId);
            insertLog('sendMailConfirmOrder',$orderId,$mail);

            return response()->json($result);
        }
    }

    public function paymentSuccess()
    {
            
        $site   = DB::table('konfigurasi')->first();


        $data = array(  'site'      => $site,
                        'title'     => $site->namaweb.' - '.$site->tagline,
                        'deskripsi' => $site->namaweb.' - '.$site->tagline,
                        'keywords'  => $site->namaweb.' - '.$site->tagline,
                        'content'   => 'order/paymentSuccess'
                    );
        return view('layout/wrapper',$data);
    }

    private function sendMailConfirmOrder($orderId)
    {

        $site   = DB::table('konfigurasi')->first(); 
        $order  =  DB::table('t_orders')
            ->join('t_customers','t_customers.customer_id','t_orders.customer_id')
            ->join('t_services','t_services.services_id','t_orders.services_id')
            ->join('t_produk','t_produk.product_id','t_orders.product_id')
            ->join('t_tipe_produk','t_tipe_produk.tipe_id','t_produk.tipe_id')
            ->where(['no_invoice' => $orderId])->first();

        $mail = new PHPMailer(true);

                //Server settings
                $mail->SMTPDebug = true;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $site->smtp_host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $site->smtp_user;                     //SMTP username
                $mail->Password   = $site->smtp_pass;                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = $site->smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Order Information');    //Add a recipient
                $mail->addAddress($order->customer_email);               //Name is optional

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Order Confirmation '.$site->namaweb;
                $mail->Body    = '<!DOCTYPE html>
                                    <html>

                                    <head>
                                        <title></title>
                                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                        <meta name="viewport" content="width=device-width, initial-scale=1">
                                        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                                        <style type="text/css">
                                            body,
                                            table,
                                            td,
                                            a {
                                                -webkit-text-size-adjust: 100%;
                                                -ms-text-size-adjust: 100%;
                                            }

                                            table,
                                            td {
                                                mso-table-lspace: 0pt;
                                                mso-table-rspace: 0pt;
                                            }

                                            img {
                                                -ms-interpolation-mode: bicubic;
                                            }

                                            img {
                                                border: 0;
                                                height: auto;
                                                line-height: 100%;
                                                outline: none;
                                                text-decoration: none;
                                            }

                                            table {
                                                border-collapse: collapse !important;
                                            }

                                            body {
                                                height: 100% !important;
                                                margin: 0 !important;
                                                padding: 0 !important;
                                                width: 100% !important;
                                            }

                                            a[x-apple-data-detectors] {
                                                color: inherit !important;
                                                text-decoration: none !important;
                                                font-size: inherit !important;
                                                font-family: inherit !important;
                                                font-weight: inherit !important;
                                                line-height: inherit !important;
                                            }

                                            @media screen and (max-width: 480px) {
                                                .mobile-hide {
                                                    display: none !important;
                                                }

                                                .mobile-center {
                                                    text-align: center !important;
                                                }
                                            }

                                            div[style*="margin: 16px 0;"] {
                                                margin: 0 !important;
                                            }
                                        </style>

                                    <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" bgcolor="#eeeeee">
                                     
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                      
                                                        <tr>
                                                            <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                                                    <tr>
                                                                        <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;"> <img src="https://img.icons8.com/carbon-copy/100/000000/checked-checkbox.png" width="125" height="120" style="display: block; border: 0px;" /><br>
                                                                            <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0;"> Thank You For Your Order! </h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" style="padding-top: 20px;">
                                                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                <tr>
                                                                                    <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> Order Confirmation # </td>
                                                                                    <td width="25%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;"> #'.$orderId.' </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> Purchased Item (1) </td>
                                                                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;"> '.$site->currency.$order->order_amount.' </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> Handling </td>
                                                                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> $0.00 </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> Sales Tax </td>
                                                                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;"> $0.00 </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left" style="padding-top: 20px;">
                                                                            <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                                <tr>
                                                                                    <td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> TOTAL </td>
                                                                                    <td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;"> '.$site->currency.$order->order_amount.' </td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                      
                                                      
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </body>

                                    </html>';

                if($mail->send())
                {
                    echo "Success sent";
                }else
                {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }


    }




   

}
