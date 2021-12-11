<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;
use \Crypt;
use Session;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Contacts extends Controller
{
    // Main page
    public function index()
    {
    	

		$produk = DB::table('t_contacts')->orderBy('contact_id','desc')->paginate(20);

		$data = array(  'title'				=> 'Contact From User',
						'produk'			=> $produk,
                        'content'			=> 'admin/contacts/index'
                    );
        return view('admin/layout/wrapper',$data);
    }


    public function reply($contact_id)
    {
        $contact_id = Crypt::decrypt(filter_param($contact_id));
        $contact = DB::table('t_contacts')
            ->select('*')
            ->where('contact_id',$contact_id)
            ->first();

        $data = array(  'title'             => 'Detail Message from '.$contact->contact_name.' at '.$contact->contact_date,
                        'contact'            => $contact, 
                        'content'           => 'admin/contacts/edit'
                    );
        return view('admin/layout/wrapper',$data);
    }


    // edit
    public function reply_process(Request $request)
    {
       
        $contact_id = Crypt::decrypt(filter_param($request->contact_id));
        $contact_subject = filter_param($request->contact_subject);
        request()->validate([
                            'text_reply'   => 'required'
                            ]);
        
        $user_id = Session::get('id_user');;
            DB::table('t_contacts')->where('contact_id',$contact_id)->update([ 
                    'text_reply'    => $request->text_reply,  
                    'read_status'     => "1",
                    'user_id'   => $user_id
                ]);

        $this->replyMail($contact_subject,$request->text_reply,$request->contact_message,$request->contact_email);
        
        return redirect('admin/contacts')->with(['sukses' => 'Success Reply Message']);

    }

     private function replyMail($subject, $message,$old_message,$contact_email)
    {

        $site   = DB::table('konfigurasi')->first(); 
        
        $mail = new PHPMailer(true);

                //Server settings
                $mail->SMTPDebug = false;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $site->smtp_host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $site->smtp_user;                     //SMTP username
                $mail->Password   = $site->smtp_pass;                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = $site->smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', $site->namaweb);    //Add a recipient
                $mail->addAddress($contact_email);               //Name is optional

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Reply Message '.$subject;
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
                                                       <tr><td>'.$message.'</td></tr></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">                                                      
                                                       <tr><td><hr><br/>'.$old_message.'</td></tr></table>
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
