<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Social Network</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images\icons\favicon.ico">
    <link rel="stylesheet" type="text/css" href="vendor\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts\font-awesome-4.7.0\css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor\animate\animate.css">
    <link rel="stylesheet" type="text/css" href="vendor\css-hamburgers\hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor\select2\select2.min.css">
    <link rel="stylesheet" type="text/css" href="css\util.css">
    <link rel="stylesheet" type="text/css" href="css\main1.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
   
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt="">
                    <img src="images\img-01.png" alt="IMG">
                </div>
                <form class="login100-form validate-form" id="login">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="Login" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div>
                    <div class="login100-pic js-tilt" data-tilt="">
                        <img src="images\banner.png" alt="IMG" style="margin-top:15px; margin-left:10px;">
                    </div>
                    <div style="margin-top:10px; margin-left:25%;">
                        <a class="txt2" href="register.php">
                            Create your Account
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login').on('submit', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#login").serialize();

                $.ajax({
                    type: "POST",
                    url: 'inc/login.php',
                    data: dataf,
                    success: function(data) {
                        if (data == 'success')
                            window.location.replace("index.php");
                        else swal("You have a few errors!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>



    <script src="vendor\jquery\jquery-3.2.1.min.js" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script src="vendor\bootstrap\js\popper.js" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script src="vendor\bootstrap\js\bootstrap.min.js" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script src="vendor\select2\select2.min.js" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script src="vendor\tilt\tilt.jquery.min.js" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script type="523c39f69da99e896527e4e7-text/javascript">
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="523c39f69da99e896527e4e7-text/javascript"></script>
    <script type="523c39f69da99e896527e4e7-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>

    <script src="js\main.js" type="523c39f69da99e896527e4e7-text/javascript"></script>

    <script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="523c39f69da99e896527e4e7-|49" defer=""></script>
</body>

</html>