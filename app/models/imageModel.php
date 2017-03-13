<?php

	function uploadPic($data, $id) {
		$filename = $data["pic"]["name"];
		$file_exploded = explode('.', $filename[0]);
		$file_ext = strtolower($file_exploded[count($file_exploded)-1]);
		// $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
		// $file_ext = substr($filename, strripos($filename, '.')); // get file name
		// die($file_basename);
		$filesize = $data["pic"]["size"][0];
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif');	
		echo $file_ext;

			$newfilename = "user_" .$id. "." .$file_ext;
		if (in_array($file_ext,$allowed_file_types) && ($filesize < 20000000)) {	
			if(move_uploaded_file($data["pic"]["tmp_name"][0], "images/profile/" . $newfilename)) {
				updatePic(array($newfilename, $id));
			}
			else {
				die($data['pic']['error'][0]);
			}
		}
		elseif ($filesize > 20000000) {
			// file size error
			header('Location: /practicumhub/home/' .$id. '?errmsg=filetoolarge');
		}
		else {
			// file type error
			unlink($data["pic"]["tmp_name"]);
			header('Location: /practicumhub/home/' .$id. '?errmsg=unsupportedformat');
		}
	}

	function updatePic($data) {
		$conn = dbconn();
		$sql = "UPDATE user_account SET image = ? WHERE acct_no = ?";
		$pdo = $conn->prepare($sql);
		$update = $pdo->execute($data);
		$conn = null;
		if($update) {
			header('Location: /practicumhub/home');
		}
		else {
			header('Location: /practicumhub/home/' .$id. '?errmsg=errorchangingpic');
		}
	}

	function uploadLogoSchool($data, $id) {
		$filename = $data["pic"]["name"];
		$file_exploded = explode('.', $filename[0]);
		$file_ext = strtolower($file_exploded[count($file_exploded)-1]);
		// $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
		// $file_ext = substr($filename, strripos($filename, '.')); // get file name
		// die($file_basename);
		$filesize = $data["pic"]["size"][0];
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif');	
		echo $file_ext;

			$newfilename = "school_" .$id. "." .$file_ext;
		if (in_array($file_ext,$allowed_file_types) && ($filesize < 20000000)) {	
			if(move_uploaded_file($data["pic"]["tmp_name"][0], "images/school/" . $newfilename)) {
				updateLogoSchool(array($newfilename, $id));
			}
			else {
				die($data['pic']['error'][0]);
			}
		}
		elseif ($filesize > 20000000) {
			// file size error
			header('Location: /practicumhub/home/manageschool?errmsg=filetoolarge');
		}
		else {
			// file type error
			unlink($data["pic"]["tmp_name"]);
			header('Location: /practicumhub/home/manageschool?errmsg=unsupportedformat');
		}
	}

	function updateLogoSchool($data) {
		$conn = dbconn();
		$sql = "UPDATE schools SET school_image = ? WHERE school_id = ?";
		$pdo = $conn->prepare($sql);
		$update = $pdo->execute($data);
		$conn = null;
		if($update) {
			header('Location: /practicumhub/home/manageschool');
		}
		else {
			header('Location: /practicumhub/home/manageschool?errmsg=errorchangingpic');
		}
	}

	function uploadLogoCompany($data, $id) {
		$filename = $data["pic"]["name"];
		$file_exploded = explode('.', $filename[0]);
		$file_ext = strtolower($file_exploded[count($file_exploded)-1]);
		// $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
		// $file_ext = substr($filename, strripos($filename, '.')); // get file name
		// die($file_basename);
		$filesize = $data["pic"]["size"][0];
		$allowed_file_types = array('jpg', 'jpeg', 'png', 'gif');	
		echo $file_ext;

			$newfilename = "company_" .$id. "." .$file_ext;
		if (in_array($file_ext,$allowed_file_types) && ($filesize < 20000000)) {	
			if(move_uploaded_file($data["pic"]["tmp_name"][0], "images/company/" . $newfilename)) {
				updateLogoCompany(array($newfilename, $id));
			}
			else {
				die($data['pic']['error'][0]);
			}
		}
		elseif ($filesize > 20000000) {
			// file size error
			header('Location: /practicumhub/home/viewcompany?errmsg=filetoolarge');
		}
		else {
			// file type error
			unlink($data["pic"]["tmp_name"]);
			header('Location: /practicumhub/home/viewcompany?errmsg=unsupportedformat');
		}
	}

	function updateLogoCompany($data) {
		$conn = dbconn();
		$sql = "UPDATE companies SET image = ? WHERE company_id = ?";
		$pdo = $conn->prepare($sql);
		$update = $pdo->execute($data);
		$conn = null;
		if($update) {
			header('Location: /practicumhub/home/viewcompany');
		}
		else {
			header('Location: /practicumhub/home/viewcompany?errmsg=errorchangingpic');
		}
	}

?>