

<?php  include('server.php');

        if (isset($_GET['edit1'])) {
                $caregiver_user_id = $_GET['edit1'];
                $edit_state1 = true;

                $rec1 = mysqli_query($db, "SELECT * FROM CAREGIVER WHERE caregiver_user_id=$caregiver_user_id");
                $record1 = mysqli_fetch_array($rec1);
                $photo= $record1["photo"];
                $gender = $record1['gender'];
                $caregiving_type= $record1['caregiving_type'];
                $hourly_rate= $record1['hourly_rate'];
                $caregiver_user_id= $record1['caregiver_user_id'];
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
                        <th>Caregiver ID</th>
                        <th>Photo</th>
                        <th>Gender</th>
                        <th>Caregiving type</th>
                        <th>Hourly rate</th>
                        <th colspan="2">Action</th>
                </tr>
        </thead>
    <tbody>
                <?php while ($row = mysqli_fetch_array($results1)) { ?>
                        
                        <tr> 
                                <td><?php echo $row['caregiver_user_id']; ?></td>
                                <td> <img src="<?php echo $row['photo']; ?>" alt="Photo" style="max-width: 100px; max-height: 100px;"></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['caregiving_type']; ?></td>
                                <td><?php echo $row['hourly_rate']; ?></td>
                                <td> 
                                        <a class="edit_btn" href="register_caregiver.php?edit1=<?php echo $row['caregiver_user_id']; ?>">Edit</a>
                                </td>
                                <td>
                                        <a class="del_btn" href="server.php?del1=<?php echo $row['caregiver_user_id']; ?>">Delete</a>
                                </td>
                        </tr>
               
                <?php } ?>
        </tbody>
   </table>

<form method="post" action="server.php">
        
                <div class="input-group">
                        <label>Caregiver User ID</label>
                        <input type="text" name="caregiver_user_id" value="<?php echo $caregiver_user_id; ?>">
                </div>
                <div class="input-group">
                        <label>Photo</label>
                        <input type="text" name="photo" value="<?php echo $photo; ?>">
                </div>
                <div class="input-group">
                <label>Gender</label>
                <select name="gender">
                        <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                        <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
                </div>

                <div class="input-group">
                <label>Caregiving type</label>
                <select name="caregiving_type">
                        <option value="Babysitter" <?php echo ($caregiving_type == 'Babysitter') ? 'selected' : ''; ?>>Babysitter</option>
                        <option value="Elderly Caregiver" <?php echo ($caregiving_type == 'Elderly Caregiver') ? 'selected' : ''; ?>>Elderly Caregiver</option>
                        <option value="Playmate" <?php echo ($caregiving_type == 'Playmate') ? 'selected' : ''; ?>>Playmate</option>
                </select>
                </div>
                <div class="input-group">
                        <label>Hourly rate</label>
                        <input type="number" name="hourly_rate" step="0.01" value="<?php echo $hourly_rate; ?>">
                </div>
                <div class="input-group">
                        <?php if ($edit_state1==false):?>
                                <button type="submit" name="save1" class="btn">Save</button>
                        <?php else: ?>
                                <button type="submit" name="update1" class="btn">Update</button>
                        <?php endif ?>
                </div>
</form>

<div class="center-container-user">
        <button class="btn secondary-button" onclick="location.href='create_job_application.php'">Apply for a job</button>
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
</div>

</body>

</html>