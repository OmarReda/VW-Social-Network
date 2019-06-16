<?php
session_start();
include_once('inc/config.php');
$title = 'Friends';



$content = ' <section class="companies-info">
    <div class="container">
        <div class="companies-list">
            <div class="row">';
if ($stmt = $link->prepare("SELECT * from friends f, Users U WHERE OwnerId= '" . $_SESSION['User'] . "' AND U.UserId=f.FriendId")) {
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
        $content = $content . '<div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="company_profile_info">
                        <div class="company-up-info">
                            <img src="'. $pic.'" height="91px" width="91px" alt="">
                            <h3>' . $row['FirstName'] . ' ' . $row['LastName'] . '</h3>
                            <h4>' . $row['AboutMe'] . '</h4>
                        </div>
                        <a href="profile.php?id=' . $row['UserId'] .  '" title=" " class=" view - more - pro ">View Profile</a>
                    </div>
                    <!--company_profile_info end-->
                </div>';
    }
}
$content = $content . '</div>
        </div>
        <!--companies-list end-->

    </div>
</section>
';
include_once('inc/layout.php');
