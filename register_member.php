
<?php  include('server.php');

        if (isset($_GET['edit2'])) {
                $member_user_id = $_GET['edit2'];
                $edit_state2= true;  

                $rec2 = mysqli_query($db, "SELECT * FROM MEMBER WHERE member_user_id=$member_user_id");
                $record2= mysqli_fetch_array($rec2);
                $house_rules= $record2['house_rules'];
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
                <th>Member ID</th>
                <th>House Rules</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row= mysqli_fetch_array($results2)) { ?>

                <tr>
                    <td><?php echo $row['member_user_id']; ?></td>
                    <td><?php echo $row['house_rules']; ?></td>
                    <td>
                        <a class="edit_btn" href="register_member.php?edit2=<?php echo $row['member_user_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del2=<?php echo $row['member_user_id']; ?>">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">
        <div class="input-group">
            <label>Member User ID</label>
            <input type="text" name="member_user_id" value="<?php echo $member_user_id; ?>">
        </div>
        <div class="input-group">
            <label>House Rules</label>
            <input type="text" name="house_rules" value="<?php echo $house_rules; ?>">
        </div>
        <div class="input-group">
            <?php if ($edit_state2 == false) : ?>
                <button type="submit" name="save2" class="btn">Save</button>
            <?php else : ?>
                <button type="submit" name="update2" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

<div class="center-container-user">
        <button class="btn secondary-button" onclick="location.href='add_address.php'">Add your address details</button>
        <button class="btn secondary-button" onclick="location.href='post_job.php'">Post a job</button>
        <button class="btn secondary-button" onclick="location.href='make_appointment.php'">Make an appointment</button>
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
</div>



</body>

</html>