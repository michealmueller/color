<!--
/**
 * Created by PhpStorm.
 * Company: MuellerTek
 * User: Micheal Mueller
 * Date: 3/1/2018
 * Time: 11:42 AM
 */
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KOSMO - Multi Purpose Bootstrap 4 Admin Template</title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/pages/auth.min.css">
</head>
<body>

<div class="ks-page">

    <div class="ks-body">
        <div class="ks-logo"><img src="https://colormarketing.org/wp-content/uploads/2017/05/CMG-Logo_Horiz-01.png" width="253" height="109" alt=""/></div>

        <div class="card panel panel-default light ks-panel ks-confirm">
            <div class="card-block">
                <div class="ks-header">Hi {{ $data['user']->firstname }} Thank you for becoming a Member of The Color Marketing Group®</div>
                <div class="ks-description">
                    W have sent you an email with an activation link to your email address. In order to complete the registration process, please click the activation link.</div>
                <div class="ks-resend">
                    If you did not recieve the activation email, please check your spam folder first or  <a href="https://members.colormarketing.org/verify/resend">Resend Email</a>
                </div>
            </div>
        </div>


    </div>

</div>

<script src="libs/jquery/jquery.min.js"></script>
<script src="libs/tether/js/tether.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>