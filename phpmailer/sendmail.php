<?
require("phpmailer/class.phpmailer.php"); // path to the PHPMailer class.
mysql_connect("localhost","Tracking01","bastom08");
mysql_select_db("sp_60_TrackingForAg");
$email=$_REQUEST["email"];
$query=mysql_query("select * from user_account where email='$email'");
$row=mysql_fetch_array($query);
$email1=$row["email"]; 
$pass=$row["pass"];
echo"$email1";
echo"$pass";
$mail = new PHPMailer();
$mail->CharSet = "utf-8"; 
$mail->IsSMTP();
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;
/* --------------------------------------------------------------------------------------------- */
/* ตั้งค่าการส่งอีเมล์ โดยใช้ SMTP ของ Gmail */
$is_gmail = true;

if($is_gmail)
        {
            $mail->SMTPSecure = 'tls'; 
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;  
			$mail->Username   = "qwertyfarmer123@gmail.com";  // GMAIL username
			$mail->Password   = "basbas13";            // GMAIL password
        }
        else
        {
            $mail->Host = 'smtp.mail.google.com';
			$mail->Username   = "qwertyfarmer123@gmail.com";  // GMAIL username
			$mail->Password   = "basbas13";            // GMAIL password
		}
/* --------------------------------------------------------------------------------------------- */
$mail->From = "wanithr@gmail.com";
$mail->FromName = "TrackingCenter";
$mail->AddAddress($email1);
$mail->isHTML(true);
$mail->Subject = "กู้รหัสผ่าน";
$mail->Body     = "<i>นี่คือรหัสผ่านของคุณ:</i>".$pass;
$mail->WordWrap = 50;  
//
if(!$mail->Send()) {
echo "<meta name='language' content='TH'>";
echo "<meta http-equiv='Content-Type' content='tet/html; charset=utf-8'>";
echo 'Message was not sent.';
echo 'Could not send email at this time' . $mail->ErrorInfo;
exit;
} else {
echo "<meta name='language' content='TH'>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo 'Email Sent Success';
}
?>
