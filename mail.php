<?php
function mailer($email){

$to = $email;
$subject = "Reference Questionnaire";

$message = "test email";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <bernardgwatura19@gmail.com>' . "\r\n";
$headers .= 'Cc: phionahchikwene@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);


}

if(mailer("bernardgwatura19@gmail.com")){
    echo "Email sent";
}else{
    echo "Mail error";
}

?>