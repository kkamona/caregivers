
<?php  include('server.php');   

        if (isset($_GET['edit5'])) {
                $caregiver_user_id = $_GET['edit5'];
                $job_id = $_GET['edit5'];
                $edit_state5 = true;
                    
                $rec5 = mysqli_query($db, "SELECT * FROM JOB_APPLICATION WHERE caregiver_user_id=$caregiver_user_id");
                $record5 = mysqli_fetch_array($rec5);
                $caregiver_user_id = $record5['caregiver_user_id'];
                $job_id = $record5['job_id'];
                $date_applied = $record5['date_applied'];
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
                <th>Caregiver User ID</th>
                <th>Job ID</th>
                <th>Date Applied</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row = mysqli_fetch_array($results5)) { ?>

                <tr>
                    <td><?php echo $row['caregiver_user_id']; ?></td>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['date_applied']; ?></td>
                    <td>
                        <a class="edit_btn" href="create_job_application.php?edit5=<?php echo $row['caregiver_user_id']; ?>">Edit</a>
                       
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del5=<?php echo $row['caregiver_user_id']; ?>">Delete</a>
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
            <label>Job ID</label>
            <input type="text" name="job_id" value="<?php echo $job_id; ?>">
        </div>
        <div class="input-group">
            <label>Date Applied</label>
            <input type="date" name="date_applied" value="<?php echo $date_applied; ?>">
        </div>
        <div class="input-group">
            <?php if ($edit_state5 == false) : ?>
                <button type="submit" name="save5" class="btn">Save</button>
            <?php else : ?>
                <button type="submit" name="update5" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

    <div class="center-container-user">
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
    </div>
</body>

</html>