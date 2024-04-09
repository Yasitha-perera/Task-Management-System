<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        form {
            border: 1.5px solid white; /* Border color */
                padding: 20px; /* Padding around the container */
                width: 400px; /* Max width of the container */
                border-radius: 10px; /* Rounded corners */
                margin-top: 20px; 
                margin-top: -35px;
        }
        .form-group {
            margin-bottom: 10px; /* Reduce margin bottom for compactness */
        }
        .form-control {
            font-size: 14px; /* Reduce font size for form elements */
        }
        ::placeholder {
            font-size: 12px; /* Reduce font size of placeholders */
        }
        .form-group label {
            color: white;
            font-weight: normal;
        }input[type="submit"] {
            background-color: rgb(20, 123, 119); 
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            height: fit-content;
        }

        input[type="submit"]:hover {
            background-color: rgb(9, 87, 84);
        }
    </style>
</head>
<body>
    <div class="form">

        <div class="col-md-6">

            <form action="" method="post" onsubmit="return validateForm()">
            <div class="form-group">
            <h3 style="color:#fff;" >Apply For Project Time Extending</h3><br>

                <select class="form-control" name="selectedUser">
                    <option value="-1" style="display:none;">-Select Admin-</option>
                    <?php
                    include('./database.php');
                    $query = "SELECT id, username FROM users WHERE usertype = 'admin'";
                    $query_run = mysqli_query($conn, $query);
                    if (mysqli_num_rows($query_run)) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <option value="<?php echo $row['username']; ?>"><?php echo $row['username']; ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" rows="5" cols="50" name="message" placeholder="Type Message" required></textarea>
                </div>
                <input type="submit" name="submit_request" value="Submit">

            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var subject = document.forms[0]["subject"].value;
            var message = document.forms[0]["message"].value;

            if (subject.trim() == "" || message.trim() == "") {
                alert("Please fill out all fields.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
