<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
	include("connects.php");
	
	$keyboardName = $_POST['KeyboardName'];

	$sql = "SELECT MAX(KeyboardNo) AS max FROM Keyboard";
    $result = mysqli_fetch_object($db->query($sql));
    $max_number = $result->max;
    $max_number = $max_number+1;
    //get the new question's number.

	if ($_FILES['file0']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file0']['tmp_name'];
	  $a1_ext = end(explode('.', $_FILES['file0']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A1.'.$a1_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file1']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file1']['tmp_name'];
	  $a2_ext = end(explode('.', $_FILES['file1']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A2.'.$a2_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file2']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file2']['tmp_name'];
	  $a3_ext = end(explode('.', $_FILES['file2']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A3.'.$a3_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file3']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file3']['tmp_name'];
	  $a4_ext = end(explode('.', $_FILES['file3']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A4.'.$a4_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file4']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file4']['tmp_name'];
	  $a5_ext = end(explode('.', $_FILES['file4']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A5.'.$a5_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file5']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file5']['tmp_name'];
	  $a6_ext = end(explode('.', $_FILES['file5']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A6.'.$a6_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file6']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file6']['tmp_name'];
	  $a7_ext = end(explode('.', $_FILES['file6']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A7.'.$a7_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}

	if ($_FILES['file7']['error'] === UPLOAD_ERR_OK){
	  $file = $_FILES['file7']['tmp_name'];
	  $a8_ext = end(explode('.', $_FILES['file7']['name']));
	  $dest = 'upload/K'.(string)$max_number.'A8.'.$a8_ext;
	   move_uploaded_file($file, $dest);
	  }
	else {
	}


	$ext = $a1_ext.'-'.$a2_ext.'-'.$a3_ext.'-'.$a4_ext.'-'.$a5_ext.'-'.$a6_ext.'-'.$a7_ext.'-'.$a8_ext;


	$sql2 = "INSERT INTO Keyboard (KeyboardNo, KeyboardName, A1_ext, A2_ext, A3_ext, A4_ext, A5_ext, A6_ext, A7_ext, A8_ext, ext) VALUES ('$max_number', '$keyboardName', '$a1_ext', '$a2_ext', '$a3_ext', '$a4_ext', '$a5_ext', '$a6_ext',	'$a7_ext', '$a8_ext', '$ext')";
	$db->query($sql2);







	$db->close();

	echo "<script>alert('出題成功'); location.href = 'KeyboardSite.php';</script>"  ;
?>
