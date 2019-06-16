<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Register - Social Network</title>

    <!-- Icons font CSS-->
    <link href="vendor\mdi-font\css\material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor\font-awesome-4.7\css\font-awesome.min.css" rel="stylesheet" media="all">
    <link rel="icon" type="image/png" href="images\icons\favicon.ico">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor\select2\select2.min.css" rel="stylesheet" media="all">
    <link href="vendor\datepicker\daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css\main.css" rel="stylesheet" media="all">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login').on('submit', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#login").serialize();

                $.ajax({
                    type: "POST",
                    url: 'inc/register.php',
                    data: dataf,
                    success: function(data) {
                        if (data == 'success')
                            swal("Done","You have successfully registered!","success");
                        else swal("You have a few errors!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Create A New Account</h2>
                    <form id="login">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">first name</label>
                                    <input class="input--style-4" type="text" name="first_name" required="" minlength="2" maxlength="12">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">last name</label>
                                    <input class="input--style-4" type="text" name="last_name" required="" minlength="2" maxlength="12">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="birthday" required="">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="p-t-10">
                                        <label class="radio-container m-r-45">Male
                                            <input type="radio" checked="checked" name="gender" required="">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio-container">Female
                                            <input type="radio" name="gender" required="">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group" data-validate="Valid email is required: ex@abc.xyz">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email" required="" >
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="phone" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password" required="" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" title="Please include at least 1 uppercase character, 1 lowercase character, and 1 number.">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Country</label>
                                    <select class="input--style-4" type="text" name="country" required="" style="height:50px; width:260px; border-style:hidden;">
                                    <option value = "Egypt" selected>Egypt</option>
                                    <option value = "United Kindom">United Kindom</option>
                                    <option value = "United Stats">United Stats</option>
                                 </select>
                                </div>
                            </div>
                        </div>
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" name="signup" type="submit">Submit</button>
                        </div>
                    </form>
                    <div class="col-2">
                        <a class="label" href="login.php" style="text-decoration:none; font-size:13px; padding-top:15px;">
                            Already Have Account ?
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- Jquery JS-->
    <script src="vendor\jquery\jquery.min.js" type="9962aac65d1260dc149b44c6-text/javascript"></script>
    <!-- Vendor JS-->
    <script src="vendor\select2\select2.min.js" type="9962aac65d1260dc149b44c6-text/javascript"></script>
    <script src="vendor\datepicker\moment.min.js" type="9962aac65d1260dc149b44c6-text/javascript"></script>
    <script src="vendor\datepicker\daterangepicker.js" type="9962aac65d1260dc149b44c6-text/javascript"></script>

    <!-- Main JS-->
    <script src="js\global.js" type="9962aac65d1260dc149b44c6-text/javascript"></script>

<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="9962aac65d1260dc149b44c6-text/javascript"></script>
<script type="9962aac65d1260dc149b44c6-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="9962aac65d1260dc149b44c6-|49" defer=""></script></body>

</html>
