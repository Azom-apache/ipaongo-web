<?php
$domain='bagma.net';
$to = "drmkhaleque@gmail.com, Digital marketing solution";
$name = $_POST['name'];
$msg = $_POST['message'];

$subject = "digital marketing solution from $name";

$message = "
<html>
<head>
<title>Digital marketing solution</title>
</head>
<body>

<table align='left'>
<tr>
<th>Name:".$name."</th>
</tr>
<tr>
<th>Email:".$_POST['email']."</th>
</tr>
<tr>
<th>Phone:".$_POST['ccode']."</th>
</tr>
<tr>
<th>Massage:".$msg."</th>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= "From:Digital marketing<no-replay@$domain>" . "\r\n";
$mail = mail($to,$subject,$message,$headers);
if($mail==true){
    echo '<meta http-equiv="Refresh" content="0; url=thank.html" />';
}else{
    echo '<meta http-equiv="Refresh" content="0; url=index.html" />';
}
?> 