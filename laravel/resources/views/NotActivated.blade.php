
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Marketing Group</title>

    <meta http-equiv="X-UA-Compatible" content=="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/fonts/open-sans/styles.css">
    <link rel="stylesheet" type="text/css" href="/libs/tether/css/tether.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/common.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/styles/pages/auth.min.css">
</head>
<body>

<div class="ks-page">
    <div class="ks-header">

    </div>
    <div class="ks-body">
        <div class="ks-logo">Color Marketing Group</div>

        <div class="card panel panel-default light ks-panel ks-confirm">
            <div class="card-block">
                <div class="ks-header">You are not activated.</div>
                <div class="ks-description">
                    if you would like to post status updates, and other features of the site, you must verify the email address provided upon registration,
                    to do this check your email for an activation link from <br> no-reply@colormarketinggroup.org
                </div>
                <div class="ks-resend">
                    Haven't received yet? <a href="verify/resend">Resend</a>
                </div>
            </div>
        </div>

        <div class="ks-panel-extra">
            Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </div>
    <div class="ks-footer">
        <span class="ks-copyright">&copy; 2017 Color Marketing Group</span>
        <ul>
            <li>
                <a href="#">Privacy Policy</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </div>
</div>

<script src="/libs/jquery/jquery.min.js"></script>
<script src="/libs/tether/js/tether.min.js"></script>
<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>