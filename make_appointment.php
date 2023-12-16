
<?php  include('server.php');
        
        if (isset($_GET['edit6'])) {
                $appointment_id = $_GET['edit6'];
                $edit_state6 = true;
                    
                $rec6 = mysqli_query($db, "SELECT * FROM APPOINTMENT WHERE appointment_id=$appointment_id");
                $record6 = mysqli_fetch_array($rec6);
                $caregiver_user_id = $record6['caregiver_user_id'];
                $member_user_id = $record6['member_user_id'];
                $appointment_date = $record6['appointment_date'];
                $appointment_time = $record6['appointment_time'];
                $work_hours = $record6['work_hours'];
                $status = $record6['status'];

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
                <th>Appointment ID</th>
                <th>Caregiver User ID</th>
                <th>Member User ID</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Work Hours</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($results6)) { ?>

                <tr>
                    <td><?php echo $row['appointment_id']; ?></td>
                    <td><?php echo $row['caregiver_user_id']; ?></td>
                    <td><?php echo $row['member_user_id']; ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td><?php echo $row['work_hours']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a class="edit_btn" href="make_appointment.php?edit6=<?php echo $row['appointment_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del6=<?php echo $row['appointment_id']; ?>">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">
        <input type="hidden" name="appointment_id" value="<?php echo $appointment_id; ?>">
        <div class="input-group">
            <label>Caregiver User ID</label>
            <input type="text" name="caregiver_user_id" value="<?php echo $caregiver_user_id; ?>">
        </div>
        <div class="input-group">
            <label>Member User ID</label>
            <input type="text" name="member_user_id" value="<?php echo $member_user_id; ?>">
        </div>
        <div class="input-group">
            <label>Appointment Date</label>
            <input type="date" name="appointment_date" value="<?php echo $appointment_date; ?>">
        </div>
        <div class="input-group">
            <label>Appointment Time</label>
            <input type="time" name="appointment_time" value="<?php echo $appointment_time; ?>">
        </div>
        <div class="input-group">
            <label>Work Hours</label>
            <input type="number" name="work_hours" value="<?php echo $work_hours; ?>">
        </div>
        <div class="input-group">
            <label>Status</label>
            <select name="status">
                <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Confirmed" <?php echo ($status == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Declined" <?php echo ($status == 'Declined') ? 'selected' : ''; ?>>Declined</option>
            </select>
        </div>
        <div class="input-group">
            <?php if ($edit_state6 == false) : ?>
                <button type="submit" name="save6" class="btn">Save</button>
            <?php else : ?>
                <button type="submit" name="update6" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

    <div class="center-container-user">
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
    </div>
</body>

</html>