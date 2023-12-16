 
<?php  include('server.php');
        if (isset($_GET['edit3'])) {
                $member_user_id = $_GET['edit3'];
                $edit_state3 = true;

                $rec3= mysqli_query($db, "SELECT * FROM ADDRESS WHERE member_user_id=$member_user_id");
                $record3= mysqli_fetch_array($rec3);
                $house_number = $record3['house_number'];
                $street = $record3['street'];
                $town= $record3['town'];
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
                <th>Member User ID</th>
                <th>House Number</th>
                <th>Street</th>
                <th>Town</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($row= mysqli_fetch_array($results3)) { ?>

                <tr>
                    <td><?php echo $row['member_user_id']; ?></td>
                    <td><?php echo $row['house_number']; ?></td>
                    <td><?php echo $row['street']; ?></td>
                    <td><?php echo $row['town']; ?></td>
                    <td>
                        <a class="edit_btn" href="add_address.php?edit3=<?php echo $row['member_user_id']; ?>">Edit</a>
                    </td>
                    <td>
                        <a class="del_btn" href="server.php?del3=<?php echo $row['member_user_id']; ?>">Delete</a>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">
        <div class="input-group">
            <label>Memebr User ID</label>
            <input type="text" name="member_user_id" value="<?php echo $member_user_id; ?>">
        </div>
        <div class="input-group">
            <label>House Number</label>
            <input type="text" name="house_number" value="<?php echo $house_number; ?>">
        </div>
        <div class="input-group">
            <label>Street</label>
            <input type="text" name="street" value="<?php echo $street; ?>">
        </div>
        <div class="input-group">
            <label>Town</label>
            <input type="text" name="town" value="<?php echo $town; ?>">
        </div>
        <div class="input-group">
            <?php if ($edit_state3== false) : ?>
                <button type="submit" name="save3" class="btn">Save</button>
            <?php else : ?>
                <button type="submit" name="update3" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>

    <div class="center-container-user">
        <button class="btn main-page-button" onclick="location.href='index.php'">Main page</button>
</div>

</body>

</html>