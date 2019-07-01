<?php 

    // if (!isset($_SESSION['user_role'])){
    //     header("location: ../index.php");
    // } elseif ($_SESSION['user_role'] == "subscriber") {
    //      header("location: ../index.php");
    // }

    
?>




            <?php 

                       if (isset($_GET['delete'])){
                        $user_id=$_GET['delete'];


                        $query = "DELETE FROM users WHERE user_id = $user_id";



                       $delete_user_query = mysqli_query($connection, $query);

                        confirm($delete_user_query);

                       header("Location: users.php");

                       }

                       ?>

                        <?php 

                        if (isset($_GET['change_to_admin'])){ 
                        $user_id = $_GET['change_to_admin'];
                        $query = "UPDATE users set user_role = 'Admin' WHERE user_id = $user_id";
                        $_SESSION['user_role'] = 'Admin';
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                         header("Location: users.php");
                       }


                       if (isset($_GET['change_to_sub'])){ 
                        $user_id = $_GET['change_to_sub'];
                        $query = "UPDATE users set user_role = 'Subscriber' WHERE user_id = $user_id";
                        $_SESSION['user_role'] = 'Subscriber';
                        $update_status_query = mysqli_query($connection, $query);
                        confirm($update_status_query);
                         header("Location: users.php");
                       }

                       ?>









<table class="table table-bordered table-hover">
                        <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Rol</th>
                                    

                                </tr>


                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM users";
                            $select_comments = mysqli_query($connection, $query); 
                            while($row = mysqli_fetch_assoc($select_comments)) {
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_role = $row['user_role'];

                            echo "<tr>";
                            echo "<td>$user_id</td>";
                            echo "<td>$username</td>";
                            echo "<td>$user_firstname</td>";
                            echo "<td>$user_lastname</td>";
                            echo "<td>$user_email</td>";
                            echo "<td>$user_image</td>";
                            echo "<td>$user_role</td>";
                            echo "<td><a href='users.php?change_to_admin=$user_id'>Change to Admin</a></td>";
                            echo "<td><a href='users.php?change_to_sub=$user_id'>Change to Sub</a></td>";
                            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
                            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
                            echo "</tr>";

                        }
                             ?>
                        </tbody>


                       </table>

                       
