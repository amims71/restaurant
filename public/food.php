<?php

$con=mysqli_connect('localhost','root','','restaurant');
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(isset($_POST['name'])&&isset($_POST['type'])&&isset($_POST['details'])&&isset($_POST['price'])){
	if (!empty($_POST['name'])&&!empty($_POST['price'])&&!empty($_POST['details'])) {
		$target_dir = "uploads/";
		$imgName=basename($_FILES["image_location"]["name"]);
		$target_file = $target_dir . $imgName;
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["image_location"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["image_location"]["size"] > 10000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		} else {
		    if (move_uploaded_file($_FILES["image_location"]["tmp_name"], $target_file)) {
		    	echo "Success";
			} else{
				echo "not uploaded";
			}
		}

		$type=test_input($_POST['type']);
		echo $image_location="uploads/".$imgName;
		if ($image_location=="uploads/") {
			$image_location='';
		}
		$price=test_input($_POST['price']);
		$detail=test_input($_POST['details']);
		$name=test_input($_POST['name']);

		$query="INSERT INTO foods VALUES('','$name','$detail','$image_location','$type','$price')";
		if (mysqli_query($con,$query)) {
			header("Location: admin/foods");
		} else{
			header("Location: admin/foods");
		}
	} else{
		// header("Location: admin/foods");
	}
} else{
	// header("Location: admin/foods");
}



// header("Location: admin/foods");

?>