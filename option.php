<div class="form-group">
                    <label>Select User:</label>
                    <select class="form-control" name="selectedUser">
                    <option value="-1" style="display:none;">-Select-</option>
                        <?php
                        include('./database.php');
                        $query = "SELECT id, username FROM users WHERE usertype = 'user'";

                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run)) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <option value="<?php echo $row['username']; ?>">
                                    <?php echo $row['username']; ?>
                                </option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </div>