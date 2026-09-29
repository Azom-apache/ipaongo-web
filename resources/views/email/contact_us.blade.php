!<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
</head>
<body>
Dear Sir,
You have a mail form {{ $data['name'] }}, <br>
Email: {{ $data['email'] }},<br>
Subject: {{ $data['subject'] }} <br>

Message: {{ $data['message'] }}
</body>
</html>