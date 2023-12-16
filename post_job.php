
<?php  include('server.php');

        
        
        if (isset($_GET['edit4'])) {
                $job_id = $_GET['edit4'];
                $edit_state4 = true;

                $rec4= mysqli_query($db, "SELECT * FROM JOB WHERE job_id=$job_id");
                $record4 = mysqli_fetch_array($rec4);
                $member_user_id= $record4['member_user_id'];
                $required_caregiving_type= $record4['required_caregiving_type'];
                $other_requirements= $record4['other_requirements'];
                $date_posted= $record4['date_posted'];
                $person_age= $record4['person_age'];
                $preferred_time_intervals= $record4['preferred_time_intervals'];
                $caregiving_frequency= $record4['caregiving_frequency'];
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
                <th>Job ID</th>
                <th>Member User ID</th>
                <th>Required Caregiving Type</th>
                <th>Other Requirements</th>
                <th>Date Posted</th>
                <th>Person Age</th>
                <th>Preferred Time Intervals</th>
                <th>Caregiving Frequency</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($results4)) { ?>

                <tr>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['member_user_id']; ?></td>
                    <td><?php echo $row['required_caregiving_type']; ?></td>
                    <td><?php echo $row['other_requirements']; ?></td>
                    <td><?php echo $row['date_posted']; ?></td>
                    <td><?php echo $row['person_age']; ?></td>
                    <td><?php echo $row['preferred_time_intervals']; ?></td>
                    <td><?php echo $row['caregiving_frequency']; ?></td>
                    <td>
                        <a class="edit_btn" href="post_job.php?edit4=<?php echo $row['job_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del4=<?php echo $row['job_id']; ?>">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">
        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
        <div class="input-group">
            <label>Member User ID</label>
            <input type="text" name="member_user_id" value="<?php echo $member_user_id; ?>">
        </div>
        <div class="input-group">
            <label>Required Caregiving Type</label>
            <select name="required_caregiving_type">
                <option value="Babysitter" <?php echo ($required_caregiving_type == 'Babysitter') ? 'selected' : ''; ?>>Babysitter</option>
                <option value="Elderly Caregiver" <?php echo ($required_caregiving_type== 'Elderly Caregiver') ? 'selected' : ''; ?>>Elderly Caregiver</option>
                <option value="Playmate" <?php echo ($required_caregiving_type == 'Playmate') ? 'selected' : ''; ?>>Playmate</option>
            </select>
        </div>
        <div class="input-group">
            <label>Other Requirements</label>
            <textarea name="other_requirements"><?php echo $other_requirements; ?></textarea>
        </div>
        <div class="input-group">
            <label>Date Posted</label>
            <input type="date" name="date_posted" value="<?php echo $date_posted; ?>">
        </div>
        <div class="input-group">
            <label>Person Age</label>
            <input type="number" name="person_age" value="<?php echo $person_age; ?>">
        </div>
        <div class="input-group">
            <label>Preferred Time Intervals</label>
            <input type="text" name="preferred_time_intervals" value="<?php echo $preferred_time_intervals; ?>">
        </div>
        <div class="input-group">
            <label>Caregiving Frequency</label>
            <select name="caregiving_frequency">
                <option value="Weekly" <?php echo ($caregiving_frequency== 'Weekly') ? 'selected' : ''; ?>>Weekly</option>
                <option value="Daily" <?php echo ($caregiving_frequency == 'Daily') ? 'selected' : ''; ?>>Daily</option>
                <option value="Weekends only" <?php echo ($caregiving_frequency == 'Weekends only') ? 'selected' : ''; ?>>Weekends only</option>
            </select>
        </div>
        <div class="input-group">
            <?php if ($edit_state4== false) : ?>
                <button type="submit" name="save4" class="btn">Save</button>
            <?php else : ?>
                <button type="submit" name="update4" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

    <div class="center-container-user">
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
    </div>


</body>

</html>