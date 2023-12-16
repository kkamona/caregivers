
<?php  include('server.php');

        if (isset($_GET['edit'])) {
                $user_id = $_GET['edit'];
                $edit_state = true;

                $rec = mysqli_query($db, "SELECT * FROM USER WHERE user_id=$user_id");
                $record = mysqli_fetch_array($rec);
                $email= $record["email"];
                $given_name = $record['given_name'];
                $surname= $record['surname'];
                $city= $record['city'];
                $phone_number = $record['phone_number'];
                $profile_description = $record['profile_description'];
                $password = $record['password'];
                $user_id= $record['user_id'];
                }
?>

<!DOCTYPE html>
<html>

<head>
        <title>CRUD: CReate, Update, Delete PHP MySQL</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
        <?php if (isset($_SESSION['msg'])): ?>
                <div class="msg">
                        <?php 
                                echo $_SESSION['msg']; 
                                unset($_SESSION['msg']);
                        ?>
                </div>
        <?php endif ?>

<table>
        <thead>
                <tr>
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>City</th>
                        <th>Phone number</th>
                        <th>Profile description</th>
                        <th>Password</th>
                        <th colspan="2">Action</th>
                </tr>
        </thead>

        <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                        
                        <tr> 
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['given_name']; ?></td>
                                <td><?php echo $row['surname']; ?></td>
                                <td><?php echo $row['city']; ?></td>
                                <td><?php echo $row['phone_number']; ?></td>
                                <td><?php echo $row['profile_description']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                                <td> 
                                        <a class="edit_btn" href="register_user.php?edit=<?php echo $row['user_id']; ?>">Edit</a>
                                </td>
                                <td>
                                        <a class="del_btn" href="server.php?del=<?php echo $row['user_id']; ?>">Delete</a>
                                </td>
                        </tr>
               
                <?php } ?>
        </tbody>
</table>


<form method="post" action="server.php" >
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <div class="input-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="input-group">
                        <label>Name</label>
                        <input type="text" name="given_name" value="<?php echo $given_name; ?>">
                </div>
                <div class="input-group">
                        <label>Surname</label>
                        <input type="text" name="surname" value="<?php echo $surname; ?>">
                </div>
                <div class="input-group">
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo $city; ?>">
                </div>
                <div class="input-group">
                        <label>Phone number</label>
                        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
                </div>
                <div class="input-group">
                        <label>Profile description</label>
                        <input type="text" name="profile_description" value="<?php echo $profile_description; ?>">
                </div>
                <div class="input-group">
                        <label>Password</label>
                        <input type="text" name="password" value="<?php echo $password; ?>">
                </div>
                <div class="input-group">
                        <?php if ($edit_state==false):?>
                                <button type="submit" name="save" class="btn">Save</button>
                        <?php else: ?>
                                <button type="submit" name="update" class="btn">Update</button>
                        <?php endif ?>
                </div>
        </form>

</body>

<div class="center-container-user">
        <button class="btn secondary-button" onclick="location.href='register_member.php'">Register further as a Member</button>
        <button class="btn secondary-button" onclick="location.href='register_caregiver.php'">Register further as a Caregiver</button>
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
</div>

</html>