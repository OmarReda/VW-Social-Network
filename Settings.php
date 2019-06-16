<?
include('inc/config.php');
session_start();
$title = 'Settings';

if (empty($_GET['id'])) {
    header('location: Settings.php?id=' . $_SESSION['User']);
    return;
}
include_once('inc/layout.php');
?>
<html>

<head>
<meta charset="UTF-8">
<title>Settings</title>
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
<link href="css\main.css" rel="stylesheet" media="all">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script></head>


<body>
	

	<div class="wrapper">

		<section class="profile-account-setting">
			<div class="container">
				<div class="account-tabs-setting">
					<div class="row">
						<div class="col-lg-3">
							<div class="acc-leftbar">
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
								    <a class="nav-item nav-link active" id="nav-acc-tab" data-toggle="tab" href="#nav-acc" role="tab" aria-controls="nav-acc" aria-selected="true"><i class="la la-cogs"></i>Edit Profile</a>
								    <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><i class="fa fa-lock"></i>Change Password</a>
								    <a class="nav-item nav-link" id="nav-requests-tab" data-toggle="tab" href="#nav-requests" role="tab" aria-controls="nav-requests" aria-selected="false"><i class="fa fa-group"></i>Requests</a>
								    <a class="nav-item nav-link" id="nav-deactivate-tab" data-toggle="tab" href="#nav-deactivate" role="tab" aria-controls="nav-deactivate" aria-selected="false"><i class="fa fa-random"></i>Deactivate Account</a>
								  </div>
							</div><!--acc-leftbar end-->
						</div>
						<div class="col-lg-9">
							<div class="tab-content" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-acc" role="tabpanel" aria-labelledby="nav-acc-tab">
									<div class="acc-setting">
										<h3>Edit Profile</h3>
										<form id="Edit_Profile">
											<div class="notbar">
												<label style="margin-bottom:15px;">Edit Your About Me</label>
												<input class="input--style-4" type="text" name="About_Me" maxlength="30">
											</div><!--notbar end-->
											<div class="notbar">
												<h4>Edit Your Name</h4>
												 <div class="row row-space">
						                                <div class="input-group">
						                                    <label class="label" style="padding:10px; margin-top:10px;">First name</label>
						                                    <input class="input--style-4" type="text" name="first_name" style="width:250px; margin-top:10px; margin-left:10px;" maxlength="30">
						                            	</div>
						                                <div class="input-group">
						                                    <label class="label" style="padding:10px;">Last name</label>
						                                    <input class="input--style-4" type="text" name="last_name" style="width:250px; margin-left:10px;" maxlength="30">
						                            	</div>
						                        	</div>
											</div><!--notbar end-->
											<div class="notbar">
												<h4>Edit Your Friends</h4>
												<a href="friends.php" title="" ><i class="fa fa-user" style="padding:15px;"></i> Show friends</a>
											</div><!--notbar end-->
											<div class="save-stngs">
												<ul>
													<li><button type="submit">Save</button></li>
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
								</div>
							  	<div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
							  		<div class="acc-setting">
										<h3>Account Setting</h3>
										<form>
											<div class="cp-field">
												<h5>Old Password</h5>
												<div class="cpp-fiel">
													<input type="text" name="old-password" placeholder="Old Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>New Password</h5>
												<div class="cpp-fiel">
													<input type="text" name="new-password" placeholder="New Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Repeat Password</h5>
												<div class="cpp-fiel">
													<input type="text" name="repeat-password" placeholder="Repeat Password">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="save-stngs pd2">
												<ul>
													<li><button type="submit">Save</button></li>
												</ul>
											</div><!--save-stngs end-->
										</form>
									</div><!--acc-setting end-->
							  	</div>
							  	<div class="tab-pane fade" id="nav-requests" role="tabpanel" aria-labelledby="nav-requests-tab">
							  		<div class="acc-setting">
							  			<h3>Requests</h3>
							  			<div class="requests-list">
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
							  					</div>
							  			</div>
							  	</div>
							  	<div class="tab-pane fade" id="nav-deactivate" role="tabpanel" aria-labelledby="nav-deactivate-tab">
							  		<div class="acc-setting">
										<h3>Deactivate Account</h3>
										<form>
											<div class="cp-field">
												<h5>Email</h5>
												<div class="cpp-fiel">
													<input type="text" name="Email" placeholder="Email" required="">
													<i class="fa fa-envelope"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Password</h5>
												<div class="cpp-fiel">
													<input type="password" name="Password" placeholder="Password" required="">
													<i class="fa fa-lock"></i>
												</div>
											</div>
											<div class="cp-field">
												<h5>Please Explain Further</h5>
												<textarea></textarea>
											</div>
											<div class="cp-field">
												<p>Be Careful as you can't undo this action.</p>
											</div>
											<div class="save-stngs pd3">
												<ul>
													<li><button type="submit" name="submit">Save</button></li>
												</ul>
											</div><!--save-stngs end-->
										</form>                                      
									</div><!--acc-setting end-->
							  	</div>
							</div>
						</div>
					</div>
				</div><!--account-tabs-setting end-->
			</div>
		</section>



		<footer>
			<div class="footy-sec mn no-margin">
				<div class="container">
					<ul>
						<li><a href="index.php" title="" style="padding-left:400px;"> Home</a></li>
						<li><a href="profile.php" title="" >Profile</a></li>
						<li><a href="Settings.php" title="" >Settings</a></li>
						<li> <a alt="" style="margin-left:250px;">VW-Social Network</a></li>
					</ul>
					<p><img src="images\copy-icon2.png" alt="">Copyright 2019</p>
				</div>
			</div>
		</footer>

	</div><!--theme-layout end-->



<script type="text/javascript" src="js\jquery.min.js"></script>
<script type="text/javascript" src="js\popper.js"></script>
<script type="text/javascript" src="js\bootstrap.min.js"></script>
<script type="text/javascript" src="js\jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib\slick\slick.min.js"></script>
<script type="text/javascript" src="js\script.js"></script>



</body></html>

