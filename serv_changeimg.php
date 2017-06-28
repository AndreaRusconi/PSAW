<?php
session_start();
    echo "ale doria";
    
    echo "ale doria";
    $user_email = $_SESSION['username'];

    $target_dir = "../profile_images/";
    echo $target_dir ;

    $imageFileType = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);

    $target_file = $target_dir . sha1($user_email) . "." . $imageFileType;

    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG & PNG  files are allowed.";
        $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        exit();
    // if everything is ok, try to upload file
    } else {
        if (file_exists($target_file))
            unlink($target_file);

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            header("Location: generalProfile.php?var=$user_email");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    
   /* 

    $sql = "UPDATE user SET photo='{$target_file}' WHERE email='{$user_email}'";
    $stmt = mysqli_prepare($conn,$sql);
    if( ! mysqli_stmt_execute($stmt) )
        echo mysqli_error($conn);
    else {
        echo "<br>Wait...Redirecting to profile page.";
        header("refresh:2;url=logged.php");
    }*/
?>