    <?php
    include('./database.php');

    if (isset($_GET['id'])) {
        $taskId = $_GET['id'];

        // Display confirmation message and handle deletion
        echo "<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Delete Task Confirmation</title>
                </head>
                <body>
                    <script>
                        var confirmDelete = confirm('Are you sure you want to delete this task?');

                        if (confirmDelete) {
                            // User confirmed, proceed with deletion
                            window.location.href ='delete_task.php?id_confirm=$taskId';
                        } else {
                            // User canceled, redirect back to admin.php
                            window.location.href ='admin.php';
                        }
                    </script>
                </body>
                </html>";
    }

    // Check for confirmation ID and perform deletion
    if (isset($_GET['id_confirm'])) {
        $taskIdToDelete = $_GET['id_confirm'];

        $query = "DELETE FROM tasks WHERE tid = $taskIdToDelete";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            echo "<script type='text/javascript'>
                    alert('Task Deleted Successfully..');
                    window.location.href ='admin.php';
                </script>";
        } else {
            echo "<script type='text/javascript'>
                    alert('Error... Please try again');
                    window.location.href ='admin.php';
                </script>";
        }
    }
    ?>
