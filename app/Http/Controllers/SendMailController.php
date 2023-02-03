<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class SendMailController extends Controller
{
    public function function_alert() {

        echo "<script>alert('Email sent successfully!');</script>";
    }



    public function sendmail(Request $request){
        try {

            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
            error_reporting(E_ALL);

            $mail = new PHPMailer(true);
            //Server settings
            //$mail->SMTPDebug = false;               //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vrlokidevteam@gmail.com';                     //SMTP username
            $mail->Password   = 'zorqvcnriekrjwss';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('vrlokidevteam@gmail.com',$request->name);
            $mail->addAddress('vrlokidevteam@gmail.com');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Loki Dev. Team email contact';
            $mail->Body    = $request->message;

            //$mail->send();
            //return redirect()->route('postsent');

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }

            else {
                return redirect()->back()->with('alert','Email sent successfully!');
            }


        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
