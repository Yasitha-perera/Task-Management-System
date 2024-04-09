<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
        // Check if the file already exists
        if (file_exists($target_file)) {
            echo 
            "<script type='text/javascript'>
                                alert('Sorry, a file with the same name already exists.');
                                window.location.href ='admin.php'; // Redirect to admin page after successful upload
                              </script>";
        } else {
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is allowed (you can modify this to allow specific file types)
            $allowed_types = array("jpg", "jpeg", "png", "docx", "pdf");
            if (!in_array($file_type, $allowed_types)) {
                echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
            } else {
                // Retrieve selected user and task from the form
                $selected_user = $_POST['user'];
                $selected_task = $_POST['task'];

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    // File upload success, now store information in the database
                    $filename = $_FILES["file"]["name"];
                    $filetype = $_FILES["file"]["type"];
                    $username = $_SESSION['username'];

                    // Database connection
                    include('./database.php');

                    // Insert the file information into the database along with user and task
                    $sql = "INSERT INTO files (filename, filetype, susername, task, username) VALUES ('$filename', '$filetype', '$selected_user', '$selected_task', '$username')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script type='text/javascript'>
                                alert('File uploaded successfully.');
                                window.location.href ='admin.php'; // Redirect to admin page after successful upload
                              </script>";
                    } else {
                        echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                    }

                    $conn->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
