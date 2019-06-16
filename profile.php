<?
include('inc/config.php');
session_start();
$title = 'Profile';

if (empty($_GET['id'])) {
    header('location: profile.php?id=' . $_SESSION['User']);
    return;
}
$myprofile = false;
$is_friends = false;
$is_requested = false;
$can_accept = false;

$id = $_GET['id'];
if ($id == $_SESSION['User']) {
    $pic = $_SESSION['Pic'];
    $name = $_SESSION['Name'];
    $about = $_SESSION['AboutMe'];
    $myprofile = true;
} else {
    // Load data of Profile with Id = $id
    if ($stmt = $link->prepare('SELECT * FROM users WHERE UserId = ?')) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $name = $row['FirstName'] . ' ' . $row['LastName'];
            if ($row['HasPic'] == '1') {
                $pic = 'users/' . $id . '.jpg';
            } else if ($row['Gender'] == 'M') {
                $pic = 'users/default_m.jpg';
            } else if ($row['Gender'] == 'F') {
                $pic['Pic'] = 'users/default_f.jpg';
            }
            $about = $row['AboutMe'];
        } else {
            $content = '<main>
           <div class="main-section">
               <div class="container"><div class="alert alert-danger" role="alert">
           <h4 class="alert-heading">Are you lost?</h4>
           <p>Sorry, but we cannot find the profile your are searching for.</p>
           <hr>
           <p class="mb-0">Go back to your <a href="profile.php">profile</a>.</p>
         </div></div></div></main>';
            include_once('inc/layout.php');
            return;
        }
    }

    // Check if they are both friends.
    if ($stmt = $link->prepare('SELECT * FROM friends WHERE OwnerId = ? AND FriendId = ?')) {
        $stmt->bind_param('ss', $_SESSION['User'], $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $is_friends = true;
        }
    }

    // Check if a friend request was sent.
    if (!$is_friends) {
        if ($stmt = $link->prepare('SELECT * FROM requests WHERE OwnerId = ? AND RequesteeId = ?')) {
            $stmt->bind_param('ss', $_SESSION['User'], $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $is_requested = true;
            }
        }
    }
}
$result = $link->query("SELECT COUNT(*) FROM friends WHERE OwnerId = '" . $id . "'");
$row = $result->fetch_row();
$friends_count = $row[0];

if ($stmt = $link->prepare('SELECT * FROM requests WHERE RequesteeId = ? AND OwnerId = ?')) {
    $stmt->bind_param('ss', $_SESSION['User'], $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $can_accept = true;
    }
}

$content = '


<section class="cover-sec">
<img src="images\resources\cover-img.jpeg" alt="">
</section>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
        $(document).ready(function() {
            $(\'#request\').on(\'submit\', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#request").serialize();

                $.ajax({
                    type: "POST",
                    url: \'inc/sendrequest.php\',
                    data: dataf,
                    success: function(data) {
                        if (data == \'success\'){
                            swal("Friend Request Sent");
                            document.getElementById(\'request\').style = "display:none";
                            document.getElementById(\'deleterequest\').style = "display:block";
                        }
                        else swal("Error!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(\'#deleterequest\').on(\'submit\', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#deleterequest").serialize();

                $.ajax({
                    type: "POST",
                    url: \'inc/deleterequest.php\',
                    data: dataf,
                    success: function(data) {
                        if (data == \'success\'){
                            swal("Friend Request Cancelled");
                            document.getElementById(\'request\').style = "display:block";
                            document.getElementById(\'deleterequest\').style = "display:none";
                        }
                        else swal("Error!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(\'#acceptrequest\').on(\'submit\', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#acceptrequest").serialize();

                $.ajax({
                    type: "POST",
                    url: \'inc/acceptrequest.php\',
                    data: dataf,
                    success: function(data) {
                        if (data == \'12success\'){
                            swal("Friend Request Accepted");
                            document.getElementById(\'acceptrequest\').style = "display:none";
                            document.getElementById(\'deletefriend\').style = "display:block";

                        }
                        else swal("Error!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(\'#deletefriend\').on(\'submit\', function(e) {
                //Stop the form from submitting itself to the server.
                e.preventDefault();
                var dataf = $("#deletefriend").serialize();

                $.ajax({
                    type: "POST",
                    url: \'inc/deletefriend.php\',
                    data: dataf,
                    success: function(data) {
                        if (data == \'1success\'){
                            swal("Friend Deleted");
                            document.getElementById(\'deletefriend\').style = "display:none";
                            document.getElementById(\'request\').style = "display:block";
                        }
                        else swal("Error!", data, "error");
                        //alert(data);

                    }
                });
            });
        });
    </script>

<main>
<div class="main-section">
    <div class="container">
        <div class="main-section-data">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-left-sidebar">
                        <div class="user_profile">
                            <div class="user-pro-img">
                                <img src="' . $pic . '" height="170px" width="170px" alt="">
                            </div><!--user-pro-img end-->
                            <div class="user_pro_status">
                                <ul class="flw-hr">
                                    ';
if (!$myprofile) {
    if ($is_friends === false) {
        if ($can_accept === true) {
            $request = $delete = $delete_friend = "none";
            $accept = "block";
        } else if ($is_requested === false) {
            $request = "block";
            $delete = $accept =  $delete_friend = "none";
        } else {
            $request = $accept =  $delete_friend =  "none";
            $delete = "block";
        }
        // not friends and friend request not was sent.

    } else {
        $request = $delete = $accept = "none";
        $delete_friend = "block";
    }
    $content = $content . '<form id="request" style="display:' . $request . '"> 
        <input type="hidden" name="requester" value="' . $_SESSION['User'] . '">
        <input type="hidden" name="requestee" value="' . $id . '">
        <li><a href="#" title="" class="hre"><input type="submit" value="Add Friend" style=" border:none; background:none; color:#ffffff;"></a></li>
        </form>';

    $content = $content . '<form id="deleterequest" style="display:' . $delete . '"> 
            <input type="hidden" name="requester" value="' . $_SESSION['User'] . '">
            <input type="hidden" name="requestee" value="' . $id . '">
            <li><a href="#" title="" class="hre"><input type="submit" value="Cancel Friend Request" style=" border:none; background:none; color:#ffffff;"></a></li>
            </form>';
    $content = $content . '<form id="acceptrequest" style="display:' . $accept . '"> 
            <input type="hidden" name="requester" value="' . $_SESSION['User'] . '">
            <input type="hidden" name="requestee" value="' . $id . '">
            <li><a href="#" title="" class="hre"><input type="submit" value="Accept Friend Request" style=" border:none; background:none; color:#ffffff;"></a></li>
            </form>';
    $content = $content . '<form id="deletefriend" style="display:' . $delete_friend . '"> 
    <input type="hidden" name="requester" value="' . $_SESSION['User'] . '">
    <input type="hidden" name="requestee" value="' . $id . '">
    <li><a href="#" title="" class="hre"><input type="submit" value="Delete Friend" style=" border:none; background:none; color:#ffffff;"></a></li>
    </form>';
}


$content = $content . '</ul>
                                <ul class="flw-status">
                                    <li>
                                        <span>Friends</span>
                                        <b>' . $friends_count . '</b>
                                    </li>
                                   
                                </ul>
                            </div><!--user_pro_status end-->
                            <ul class="social_links">
                                <li><a href="friends.php" title=""><i class="fa fa-user"></i> Show friends</a></li>
                            </ul>
                        </div><!--user_profile end-->
                        
                    </div><!--main-left-sidebar end-->
                </div>
                <div class="col-lg-6">
                    <div class="main-ws-sec">
                        <div class="user-tab-sec">
                            <h3>' . $name . '</h3>
                            <div class="star-descp">
                                <span>' . $about . '</span>
                               </div><!--star-descp end-->
                        </div><!--user-tab-sec end-->
                        <div class="product-feed-tab current" id="feed-dd">
                            <div class="posts-section">';
$sql = "SELECT * from posts p, users u WHERE p.UserId= '" . $id . "' AND p.UserId = u.UserId ORDER BY PostTime DESC";
$count = 0;
if ($stmt = $link->prepare($sql)) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        if ($row['HasPic'] == '1') {
            $pic = 'users/' . $row['UserId'] . '.jpg';
        } else if ($row['Gender'] == 'M') {
            $pic = 'users/default_m.jpg';
        } else if ($row['Gender'] == 'F') {
            $pic['Pic'] = 'users/default_f.jpg';
        }
        $is_public = $row['IsPublic'] == 1;
        if (!$is_public && !$is_friends && $id != $_SESSION['User'])
            continue;
        if ($is_public)
            $perm = 'Public';
        else $perm = 'Private';
        $count++;

        $content = $content . '<div class="post-bar">
                            <div class="post_topbar">
                                <div class="usy-dt">
                                    <img src="' . $pic . '" height="50px" width="50px" alt="">
                                    <div class="usy-name">
                                        <h3>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h3>
                                        <span><img src="images\clock.png" alt="">' . $row['PostTime'] . '</span>
                                        <span>Permission: ' . $perm . '</span>
                                    </div>
                                </div>';
        if ($id == $_SESSION['User'])

            $content = $content . '<div class="ed-opts">
                                <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                <ul class="ed-options">
                                    <li><a href="#" title="">Delete</a></li>
                                </ul>
                                </div>';

        $content = $content . '</div>
                           
                            <div class="job_descp">
                                <p>' . $row['Caption'] . '</p>
                            </div>
                            
                        </div>
                        <!--post-bar end-->';
    }
}
if ($count == 0)
    $content = $content . '<div class="main-section">
    <div class="container"><div class="alert alert-danger" role="alert">
<h4 class="alert-heading">No posts found</h4>
<p>This user has not posted anything yet.</p>
</div></div></div></main>';


$content = $content . '</div><!--posts-section end-->
                        </div><!--product-feed-tab end-->
                        
                    </div><!--main-ws-sec end-->
                </div>
            </div>
        </div><!-- main-section-data end-->
    </div> 
</div>
</main>

';

include_once('inc/layout.php');
