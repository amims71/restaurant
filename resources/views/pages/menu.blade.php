@extends('layouts.header')

@section('title')
    Menu
@endsection

@section('body')

<?php 
$con=mysqli_connect('localhost','root','','restaurant');
?>



	<!-- Lunch -->
	<section class="section-lunch bgwhite">
		<div class="header-lunch parallax0 parallax100" style="background-image: url(images/header-menu-01.jpg);">
			<div class="bg1-overlay t-center p-t-170 p-b-165">
				<h2 class="tit4 t-center">
					Lunch
				</h2>
			</div>
		</div>

		<div class="container">
			<div class="row p-t-108 p-b-70">
				<div class="col-md-4 col-lg-6 m-l-r-auto">
					<!-- Block3 -->
					<?php
					$result=mysqli_query($con,"SELECT * FROM foods WHERE type='Lunch'");
					while ($row=mysqli_fetch_assoc($result)) {
						?>
						<div class="blo3 flex-w flex-col-l-sm m-b-30">
							<div class="pic-blo3 size20 bo-rad-10 hov-img-zoom m-r-28">
								<a href="cart/{{$row['fid']}}"><img src="{{$row['image_location']}}" alt="IMG-MENU"></a>
							</div>

							<div class="text-blo3 size21 flex-col-l-m">
								<a href="cart/{{$row['fid']}}" class="txt21 m-b-3">
									{{$row['name']}}
								</a>

								<span class="txt23">
									<pre>{{$row['details']}}</pre>
								</span>

								<span class="txt22 m-t-20">
									{{$row['price']}} BDT
								</span>
							</div>
						</div>

						<?php

					}

					?>
				</div>

				
			</div>
		</div>
	</section>


	<!-- Dinner -->
	<section class="section-dinner bgwhite">
		<div class="header-dinner parallax0 parallax100" style="background-image: url(images/header-menu-02.jpg);">
			<div class="bg1-overlay t-center p-t-170 p-b-165">
				<h2 class="tit4 t-center">
					Dinner
				</h2>
			</div>
		</div>

		<div class="container">
			<div class="row p-t-108 p-b-70">
				<div class="col-md-8 col-lg-6 m-l-r-auto">
					<!-- Block3 -->
					<?php
					$result=mysqli_query($con,"SELECT * FROM foods WHERE type='Dinner'");
					while ($row=mysqli_fetch_assoc($result)) {
						?>
						<div class="blo3 flex-w flex-col-l-sm m-b-30">
							<div class="pic-blo3 size20 bo-rad-10 hov-img-zoom m-r-28">
								<a href="cart/{{$row['fid']}}"><img src="{{$row['image_location']}}" alt="IMG-MENU"></a>
							</div>

							<div class="text-blo3 size21 flex-col-l-m">
								<a href="cart/{{$row['fid']}}" class="txt21 m-b-3">
									{{$row['name']}}
								</a>

								<span class="txt23">
									<pre>{{$row['details']}}</pre>
								</span>

								<span class="txt22 m-t-20">
									{{$row['price']}} BDT
								</span>
							</div>
						</div>

						<?php

					}

					?>
				</div>
			</div>
		</div>
	</section>


	<!-- Sign up -->
	<div class="section-signup bg1-pattern p-t-85 p-b-85">
		<form class="flex-c-m flex-w flex-col-c-m-lg p-l-5 p-r-5">
			<span class="txt5 m-10">
				Specials Sign up
			</span>

			<div class="wrap-input-signup size17 bo2 bo-rad-10 bgwhite pos-relative txt10 m-10">
				<input class="bo-rad-10 sizefull txt10 p-l-20" type="text" name="email-address" placeholder="Email Adrress">
				<i class="fa fa-envelope ab-r-m m-r-18" aria-hidden="true"></i>
			</div>

			<!-- Button3 -->
			<button type="submit" class="btn3 flex-c-m size18 txt11 trans-0-4 m-10">
				Sign-up
			</button>
		</form>
	</div>
@endsection