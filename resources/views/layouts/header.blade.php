<?php 
$con=mysqli_connect('localhost','root','','restaurant');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}"/>
<!--===============================================================================================-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/themify/themify-icons.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/lightbox2/css/lightbox.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body class="animsition">

    

    @if(Session::has('name'))
	    <div id="modal-user" class="modal fade" aria-hidden="true;">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-body">
	                    <form method="POST" action="update" class="form-horizontal">
	                        <div class="row">
	                            <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Change Password</h3><br>
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                        <div class="form-group"><label class="col-sm-4 control-label"> Name </label>

	                                            <div class="col-sm-12"><input type="text" name="name" value="{{ Session::get('name') }}" class="form-control" required>
	                                            </div>
	                                            {{ csrf_field() }}
	                                        </div>
	                                        <div class="form-group"><label class="col-sm-4 control-label"> Old Password </label>

	                                            <div class="col-sm-12"><input type="password" name="pass"class="form-control" required>
	                                            </div>
	                                        </div>
	                                        <div class="form-group"><label class="col-sm-4 control-label"> New Password </label>

	                                            <div class="col-sm-12"><input type="password" name="pass_new"class="form-control" required>
	                                            </div>
	                                        </div>
	                                    </div> <!--End of  First colum section -->
	                                </div>
	                            </div>
	                        </div> <!--First Row ends here -->

	                        <!-- Save Button  -->
	                        <div class="button">
	                            <div class="row">
	                            	<div class="col-sm-12">
	                                    <div class="button text-center">
	                                        <div class="form-group">
	                                            <button class="btn btn-white" data-dismiss="modal" type="submit">Cancel</button>
	                                            <button type="submit" class="btn btn-primary">Change Password</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div id="modal-cart" class="modal fade" aria-hidden="true;">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-body">
	                    <form method="POST" action="order" class="form-horizontal">
	                        <div class="row">
	                            <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Cart</h3><br>
	                                <div class="row">
	                                    <div class="col-sm-12">
	                                        <div class="form-group"><label class="col-sm-4  control-label"> <strong>Item Name</strong> </label><label class="col-sm-4 pull-right control-label"> <strong>Price (BDT)</strong> </label></div>

	                                        <?php
	                                        $uid=Session::get('uid');
	                                        $result=mysqli_query($con,"SELECT * FROM cart WHERE uid='".$uid."'");
	                                        $total=0;
	                                        $foods="";
	                                        while ($row=mysqli_fetch_assoc($result)) {
	                                        	$res=mysqli_query($con,"SELECT * FROM foods WHERE fid='".$row['fid']."'");
	                                        	$row_food=mysqli_fetch_assoc($res);
	                                        	$f_name=$row_food['name'];
	                                        	$price=$row_food['price'];
	                                        	$total+=$price;
	                                        	$foods=$foods.$row['fid'].',';
	                                        
	                                        ?>
	                                        <div class="form-group"><label class="col-sm-4  control-label"> <a href="cart/remove/{{$row['cid']}}">{{$f_name}}</a> </label><label class="col-sm-4 pull-right control-label"> {{$price}} </label></div>
	                                        <?php
		                                    }
		                                    ?>

		                                    <div class="form-group"><label class="col-sm-4  control-label"> <strong>Total</strong> </label><label class="col-sm-4 pull-right control-label"> <strong>{{$total}}</strong> </label></div>


	                                        <div class="form-group"><label class="col-sm-4 control-label"> Table Number </label><input type="Number" name="table_no" class="col-sm-4 control-label pull-right" required>
                                        	</div>

	                                    </div> <!--End of  First colum section -->
	                                </div>
	                            </div>
	                        </div> <!--First Row ends here -->

	                        <!-- Save Button  -->
	                        <div class="button">
	                        	<div class="row">
	                                <div class="col-sm-12">
	                                    <div class="button text-center">
	                                        <div class="form-group">
	                                            <p><b>Note:</b> <font color="red">You can't cancel order once you have submitted! <br>Click on the Item to remove.</font></p>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            {{ csrf_field() }}
	                            <input type="hidden" name="uid" value="{{ Session::get('uid') }}">
	                            <input type="hidden" name="items" value="{{$foods}}">
	                            <input type="hidden" name="price" value="{{$total}}">
	                            <div class="row">
	                            	<div class="col-sm-12">
	                                    <div class="button text-center">
	                                        <div class="form-group">
	                                            <button class="btn btn-white" data-dismiss="modal" type="submit">Cancel</button>
	                                            <button type="submit" class="btn btn-primary">Confirm Order</button>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	@endif
    

    <div id="modal-login" class="modal fade" aria-hidden="true;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="login" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Log In</h3><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-4 control-label"> Email </label>

                                            <div class="col-sm-12"><input type="text" name="email" class="form-control" required>
                                            	{{ csrf_field() }}
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label"> Password </label>

                                            <div class="col-sm-12"><input type="password" name="pass" class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!--End of  First colum section -->
                                </div>
                            </div>
                        </div> <!--First Row ends here -->

                        <!-- Save Button  -->
                        <div class="button">
                        	<div class="row">
                                <div class="col-sm-12">
                                    <div class="button text-center">
                                        <div class="form-group">
                                            <p><b>Note:</b> <font color="green">If you don't have any account, please <a href="#modal-signup" data-toggle="modal">Signup</a></font></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="button text-center">
                                        <div class="form-group">
                                            <button class="btn btn-white" data-dismiss="modal" type="submit">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-signup" class="modal fade" aria-hidden="true;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST" action="signup" class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-12"><h3 class="m-t-none m-b navbar-static-top">Sign Up</h3><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group"><label class="col-sm-4 control-label"> Name </label>

                                            <div class="col-sm-12"><input type="text" name="name" class="form-control" required>
                                            </div>
                                             {{ csrf_field() }}
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label"> Phone </label>

                                            <div class="col-sm-12"><input type="text" name="phone" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label"> Email </label>

                                            <div class="col-sm-12"><input type="text" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label"> Password </label>

                                            <div class="col-sm-12"><input type="password" name="pass" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-4 control-label"> Address </label>

                                            <div class="col-sm-12"><input type="text" name="address" class="form-control" required>
                                            </div>
                                        </div>
                                    </div> <!--End of  First colum section -->
                                </div>
                            </div>
                        </div> <!--First Row ends here -->

                        <!-- Save Button  -->
                        <div class="button">
                            <div class="row">
                            	<div class="col-sm-12">
                                    <div class="button text-center">
                                        <div class="form-group">
                                            <button class="btn btn-white" data-dismiss="modal" type="submit">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Signup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="wrap-menu-header gradient1 trans-0-4">
			<div class="container h-full">
				<div class="wrap_header trans-0-3">
					<!-- Logo -->
					<div class="logo">
						<a href="{{route('index')}}">
							<img src="{{ asset('images/icons/logo.png') }}" alt="IMG-LOGO" data-logofixed="{{ asset('images/icons/logo2.png') }}">
						</a>
					</div>

					<!-- Menu -->
					<div class="wrap_menu p-l-45 p-l-0-xl">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="{{route('index')}}">Home</a>
								</li>

								<li>
									<a href="{{route('menu')}}">Menu</a>
								</li>

								<li>
									<a href="{{route('book')}}">Reservation</a>
								</li>						

								<li>
									<a href="{{route('about')}}">About</a>
								</li>

								<li>
									<a href="{{route('contact')}}">Contact</a>
								</li>
							</ul>
						</nav>
					</div>

					<!-- Social -->
					<div class="social flex-w flex-l-m p-r-20">
						<a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-facebook m-l-21" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-twitter m-l-21" aria-hidden="true"></i></a>

						<button class="btn-show-sidebar m-l-33 trans-0-4"></button>
					</div>
				</div>
			</div>
		</div>
	</header>



		<!-- Sidebar -->
	<aside class="sidebar trans-0-4">

		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>
		<!-- - -->
		<ul class="menu-sidebar p-t-95 p-b-70">
			<li class="t-center m-b-33">
				<a href="#modal-user" data-toggle="modal" class="txt19">
					@if(Session::has('name'))
					    Welcome {{ Session::get('name') }}
					@else
						Welcome Guest
					@endif
				</a>
			</li>
			<li class="t-center m-b-13">
				<a href="{{route('index')}}" class="txt19">Home</a>
			</li>

			<li class="t-center m-b-13">
				<a href="{{route('menu')}}" class="txt19">Menu</a>
			</li>
			<li class="t-center m-b-13">
				<a href="{{route('book')}}" class="txt19">Reservation</a>
			</li>

			<li class="t-center m-b-13">
				<a href="{{route('about')}}" class="txt19">About</a>
			</li>

			<li class="t-center m-b-33">
				<a href="{{route('contact')}}" class="txt19">Contact</a>
			</li>

			<li class="t-center">
				<!-- Button3 -->
				<a href="@if(Session::has('name'))
						    #modal-cart
						@else
							#modal-login
						@endif" data-toggle="modal" class="btn3 flex-c-m size13 m-b-33 txt11 trans-0-4 m-l-r-auto btn-primary btn-sm">
					Cart
				</a>
			</li>
			<li class="t-center">
				<!-- Button3 -->
				<a href="@if(Session::has('name'))
						    logout"
						@else
							#modal-login" data-toggle="modal"
						@endif  class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto btn-primary btn-sm">
					@if(Session::has('name'))
					    Logout
					@else
						Login
					@endif
				</a>
			</li>
		</ul>

		<!-- - -->
		<div class="gallery-sidebar t-center p-l-60 p-r-60 p-b-40">
			<!-- - -->
			<h4 class="txt20 m-b-33">
				Gallery
			</h4>

			<!-- Gallery -->
			<div class="wrap-gallery-sidebar flex-w">

				<?php
					$result=mysqli_query($con,"SELECT * FROM foods");
					while ($row=mysqli_fetch_assoc($result)) {
						?>
						<a class="item-gallery-sidebar wrap-pic-w" href="{{ $row['image_location'] }}" data-lightbox="gallery-footer">
							<img src="{{ $row['image_location'] }}" alt="GALLERY">
						</a>

				<?php

					}

				?>
			</div>
		</div>

	</aside>



@yield('body')

	<!-- Footer -->
	<footer class="bg1">
		<div class="container p-t-40 p-b-70">
			<div class="row">
				<div class="col-sm-6 col-md-6 p-t-50">
					<!-- - -->
					<h4 class="txt13 m-b-33">
						Contact Us
					</h4>

					<ul class="m-b-70">
						<li class="txt14 m-b-14">
							<i class="fa fa-map-marker fs-16 dis-inline-block size19" aria-hidden="true"></i>
							8th floor, 379 Hudson St, New York, NY 10018
						</li>

						<li class="txt14 m-b-14">
							<i class="fa fa-phone fs-16 dis-inline-block size19" aria-hidden="true"></i>
							(+1) 96 716 6879
						</li>

						<li class="txt14 m-b-14">
							<i class="fa fa-envelope fs-13 dis-inline-block size19" aria-hidden="true"></i>
							contact@site.com
						</li>
					</ul>

					<!-- - -->
					<h4 class="txt13 m-b-32">
						Opening Times
					</h4>

					<ul>
						<li class="txt14">
							09:30 AM – 11:00 PM
						</li>

						<li class="txt14">
							Every Day
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-md-6 p-t-50">
					<!-- - -->
					<h4 class="txt13 m-b-38">
						Gallery
					</h4>

					<!-- Gallery footer -->
					<div class="wrap-gallery-footer flex-w">
						<?php
						$result=mysqli_query($con,"SELECT * FROM foods");
						while ($row=mysqli_fetch_assoc($result)) {
							?>
							<a class="item-gallery-footer wrap-pic-w" href="{{ $row['image_location'] }}" data-lightbox="gallery-footer">
								<img src="{{ $row['image_location'] }}" alt="GALLERY">
							</a>

							<?php

						}

						?>
					</div>

				</div>
			</div>
		</div>

		<div class="end-footer bg2">
			<div class="container">
				<div class="flex-sb-m flex-w p-t-22 p-b-22">
					<div class="p-t-5 p-b-5">
						<a href="#" class="fs-15 c-white"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
						<a href="#" class="fs-15 c-white"><i class="fa fa-facebook m-l-18" aria-hidden="true"></i></a>
						<a href="#" class="fs-15 c-white"><i class="fa fa-twitter m-l-18" aria-hidden="true"></i></a>
					</div>

					<div class="txt17 p-r-20 p-t-5 p-b-5">
						Copyright &copy; 2019 All rights reserved  |  <i class="fa fa-heart"></i> by <a href="https://facebook.com/amims71" target="_blank">Amimul</a>
					</div>
				</div>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div>

	<!-- Container Selection1 -->
	<div id="dropDownSelect1"></div>

	<!-- Modal Video 01-->
	<div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">

		<div class="modal-dialog" role="document" data-dismiss="modal">
			<div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

			<div class="wrap-video-mo-01">
				<div class="w-full wrap-pic-w op-0-0"><img src="{{ asset('images/icons/video-16-9.jpg') }}" alt="IMG"></div>
				<div class="video-mo-01">
					<iframe src="https://www.youtube.com/embed/5k1hSu2gdKE?rel=0&amp;showinfo=0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>



<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/slick/slick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
	<script type="text/javascript">
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="{{ asset('vendor/lightbox2/js/lightbox.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
