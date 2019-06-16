<?php
session_start();
if ($_SESSION["User"] === null) {
    header("location: login.php");
    return;
}
require_once('inc/config.php');
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?php echo $title ?> - VW Social Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" type="text/css" href="css\animate.css">
    <link rel="stylesheet" type="text/css" href="css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css\line-awesome.css">
    <link rel="stylesheet" type="text/css" href="css\line-awesome-font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css\jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="lib\slick\slick.css">
    <link rel="stylesheet" type="text/css" href="lib\slick\slick-theme.css">
    <link rel="stylesheet" type="text/css" href="css\style.css">
    <link rel="stylesheet" type="text/css" href="css\responsive.css">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
</head>


<body>


    <div class="wrapper">



        <header>
            <div class="container">
                <div class="header-data">
                    <div class="logo">
                        <a href="index.php" title=""><img src="images\logo.png" alt=""></a>
                    </div>
                    <!--logo end-->
                    <div class="search-bar">
                        <form>
                            <input type="text" name="search" placeholder="Search...">
                            <button type="submit"><i class="la la-search"></i></button>
                        </form>
                    </div>
                    <!--search-bar end-->
                    <nav>
                        <ul>
                            <li>
                                <a href="index.php" title="">
                                    <span><img src="images\icon1.png" alt=""></span> Home
                                </a>
                            </li>
                            <li>
                                <a href="profile.php" title="">
                                    <span><img src="images\icon4.png" alt=""></span> Profile
                                </a>
                            </li>
                            <li>
                                <a href="#" title="" class="not-box-open">
                                    <span><img src="images\icon7.png" alt=""></span> Friend Requests
                                </a>
                                <div class="notification-box">
                                    <div class="nt-title">
                                        <h4>Top 5 Notifications are shown.</h4>
                                    </div>
                                    <div class="nott-list">
                                        <?php
                                        $sql = "SELECT * from notifications WHERE OwnerId='" . $_SESSION['User'] . "' ORDER BY Date DESC";
                                        $count = 0;
                                        if ($stmt = $link->prepare($sql)) {
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                                <div class="notfication-details">
                                                    <div class="noty-user-img">
                                                        <img src="<?php echo $row['Pic'] ?>" alt="">
                                                    </div>
                                                    <div class="notification-info">
                                                        <h3><a href="<?php echo $row['Link'] ?>" title=""><?php echo $row['Name'] ?></a> <?php echo $row['Message'] ?>.</h3>
                                                    </div>
                                                    <!--notification-info -->
                                                </div>
                                                <?php
                                                $count++;
                                            }
                                            if ($count == 0) {
                                                ?>
                                                <div class="view-all-nots">
                                                    <a href="#" title="">No Notifications Found</a>
                                                </div>
                                            <?php
                                        }
                                    }
                                    ?>


                                    </div>
                                    <!--nott-list end-->
                                </div>
                                <!--notification-box end-->
                            </li>
                            <li>
                                <a href="Settings.php" title="">
                                    <span><img src="images\icon3.png" alt=""></span> Settings
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!--nav end-->
                    <div class="menu-btn">
                        <a href="#" title=""><i class="fa fa-bars"></i></a>
                    </div>
                    <!--menu-btn end-->
                    <div class="user-account">
                        <div class="user-info">
                            <img src="<? echo $_SESSION['Pic'] ?>" height="30px" width="30px" alt="">
                            <a href="#" title="">
                                <?php echo substr($_SESSION['Name'], 0, 4) ?>
                            </a>
                            <i class="la la-sort-down"></i>
                        </div>
                        <div class="user-account-settingss">
                            <ul class="us-links">
                                <li><a href="friends.php" title="">Friends</a></li>
                                <li><a href="profile.php" title="">Profile</a></li>
                                <li><a href="Settings.php" title="">Settings</a></li>
                            </ul>
                            <h3 class="tc"><a href="inc/logout.php" title="">Logout</a></h3>
                        </div>
                        <!--user-account-settingss end-->
                    </div>
                </div>
                <!--header-data end-->
            </div>
        </header>
        <!--header end-->

        <?php echo $content ?>




        <div class="post-popup pst-pj">
            <div class="post-project">
                <h3>Post a project</h3>
                <div class="post-project-fields">
                    <form>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="title" placeholder="Title">
                            </div>
                            <div class="col-lg-12">
                                <div class="inp-field">
                                    <select>
                                        <option>Category</option>
                                        <option>Category 1</option>
                                        <option>Category 2</option>
                                        <option>Category 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="text" name="skills" placeholder="Skills">
                            </div>
                            <div class="col-lg-12">
                                <div class="price-sec">
                                    <div class="price-br">
                                        <input type="text" name="price1" placeholder="Price">
                                        <i class="la la-dollar"></i>
                                    </div>
                                    <span>To</span>
                                    <div class="price-br">
                                        <input type="text" name="price1" placeholder="Price">
                                        <i class="la la-dollar"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="description" placeholder="Description"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <li><button class="active" type="submit" value="post">Post</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <!--post-project-fields end-->
                <a href="#" title=""><i class="la la-times-circle-o"></i></a>
            </div>
            <!--post-project end-->
        </div>
        <!--post-project-popup end-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#newpost').on('submit', function(e) {
                    //Stop the form from submitting itself to the server.
                    e.preventDefault();
                    var dataf = $("#newpost").serialize();

                    $.ajax({
                        type: "POST",
                        url: 'inc/newpost.php',
                        data: dataf,
                        success: function(data) {
                            if (data == 'Posted'){
                                swal("Done", "You have posted!", "success");
                            window.setTimeout(function() {
                                window.location.href = 'index.php';
                            }, 2000);
                        }
                        else alert(data);

                            //alert(data);

                        }
                    });
                });
            });
        </script>
        <div class="post-popup job_post">
            <div class="post-project">
                <h3>New Post</h3>
                <div class="post-project-fields">
                    <form id="newpost">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inp-field">
                                    <select name="post_type">
                                        <option value="1">Public</option>
                                        <option value="0">Private</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <textarea name="caption" placeholder="Caption"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <ul>
                                    <li><button class="active" type="submit" value="post">Post</button></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <!--post-project-fields end-->
                <a href="#" title=""><i class="la la-times-circle-o"></i></a>
            </div>
            <!--post-project end-->
        </div>
        <!--post-project-popup end-->


    </div>
    <!--theme-layout end-->



    <script type="text/javascript" src="js\jquery.min.js"></script>
    <script type="text/javascript" src="js\popper.js"></script>
    <script type="text/javascript" src="js\bootstrap.min.js"></script>
    <script type="text/javascript" src="js\jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="lib\slick\slick.min.js"></script>
    <script type="text/javascript" src="js\scrollbar.js"></script>
    <script type="text/javascript" src="js\script.js"></script>


</body>

</html>