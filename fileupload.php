<?php
$target_dir = "uploads/";
$msg = "";
$target_file = $target_dir . basename($_FILES["passport"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["MM_insert"])) {
    $check = getimagesize($_FILES["passport"]["tmp_name"]);
    if($check !== false) {
        $msg = "<div class=\"alert alert-success text-center info\">"."File is an image - " . $check["mime"] . "."."</div>";
        $uploadOk = 1;
	}else {
        $msg = "<div class=\"alert alert-info text-center warning\">"."File is not an image."."</div>";;
        $uploadOk = 0;

		// Check if file already exists
		if (file_exists($target_file)) {
			$msg = "<div class=\"alert alert-warning text-center warning\">"."Sorry, file already exists."."</div>";
			$uploadOk = 0;
		}else{
			// Check file size
			if ($_FILES["passport"]["size"] > 500000) {
				$msg = "<div class=\"alert alert-warning text-center warning\">"."Sorry, your file must not be larger than 5mb."."</div>";
				$uploadOk = 0;
			}else{
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					$msg = "<div class=\"alert alert-warning text-center warning\">"."Sorry, only JPG, JPEG, PNG & GIF files are allowed."."</div>";
					$uploadOk = 0;
				}
			}
			
		}
    } 
}else{
	$uploadOk = 1;
	}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$msg = "<div class=\"alert alert-warning text-center danger\">"."Sorry, your file was not uploaded."."</div>";
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file)) {
		$msg = "<div class=\"alert alert-warning text-center success\">"."The file ". basename( $_FILES["passport"]["name"]). " has been uploaded."."</div>";
	} else {
		$msg = "<div class=\"alert alert-warning text-center danger\">"."Sorry, there was an error uploading your file."."</div>";
	}
}

if(!empty($msg)){
	echo $msg;
}

?>