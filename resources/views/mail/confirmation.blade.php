<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hospital Central Management System Account Confirmation</title>
</head>
<body>
    <h1>Hospital Central Management System Account Confirmation</h1>
    <hr>
    <div class="content">
        <h4>Please verify your email and activate your account by following provided confirmation link</h4>
        <h5><a href={{url('user/confirmation', ['confirmation_code' => $emailData['confirmation_code']])}}>[Link]</a></h5>
    </div>
</body>
</html>
