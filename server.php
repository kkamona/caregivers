<?php 
        session_start();
       
        // initialize variables
        //USER
        $email="";
        $given_name="";
        $surname="";
        $city="";
        $phone_number="";
        $profile_description= "";
        $password="";

        $user_id = 0;
        $edit_state= false;

        //CAREGIVER
        $photo="";
        $gender="";
        $caregiving_type="";
        $hourly_rate="";

        $caregiver_user_id="";
        $edit_state1=false;

        //MEMBER
        $house_rules = "";
        $member_user_id = "";
        $edit_state2 = false;

        //ADDRESS
        $house_number = "";
        $street = "";
        $town = "";
        $member_user_id = "";
        $edit_state3= false;
        
        //JOB
        $member_user_id = "";
        $required_caregiving_type = "";
        $other_requirements = "";
        $date_posted = "";
        $person_age = "";
        $preferred_time_intervals = "";
        $caregiving_frequency = "";
        $job_id = 0;
        $edit_state4= false;


        //JOB APPLICATION
        $caregiver_user_id = "";
        $job_id = "";
        $date_applied = "";
        $edit_state5= false;

        //APPOINTMENT
        $caregiver_user_id= "";
        $member_user_id= "";
        $appointment_date = "";
        $appointment_time = "";
        $work_hours = "";
        $status = "";
        $appointment_id = 0;
        $edit_state6 = false;

        $db = mysqli_connect('localhost', 'root','Database.123', 'caregivers');
        

        function isEmailOrPhoneNumberExists($email, $phone_number, $user_id = null) {
            global $db;
            $query = "SELECT * FROM USER WHERE email='$email' OR phone_number='$phone_number'";
            if ($user_id) {
                $query .= " AND user_id != $user_id";
            }
            $result = mysqli_query($db, $query);
            return mysqli_num_rows($result) > 0;
        }
        
        //USER
        if (isset($_POST['save'])) {
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $given_name = $_POST['given_name'];
            $surname = $_POST['surname'];
            $city = $_POST['city'];
            $profile_description = $_POST['profile_description'];
            $password = $_POST['password'];
            if (isEmailOrPhoneNumberExists($email, $phone_number)) {
                $_SESSION['msg'] = "Email or phone number already exists. Please choose a different one.";
            } else {
            $query = "INSERT INTO USER (email, given_name, surname, city, phone_number, profile_description, password)
                    VALUES('$email', '$given_name', '$surname', '$city', '$phone_number', '$profile_description', '$password')";

            mysqli_query($db, $query);
            $_SESSION['msg'] = "Record saved";
            }
            header('location: register_user.php');
        }



        if (isset($_POST['update'])) {
            $email=$_POST['email'];
            $given_name=$_POST['given_name'];
            $surname=$_POST['surname'];
            $city=$_POST['city'];
            $phone_number=$_POST['phone_number'];
            $profile_description= $_POST['profile_description'];
            $password=$_POST['password'];
            $user_id= $_POST['user_id'];
            mysqli_query($db, "UPDATE USER SET email='$email', given_name='$given_name',  surname='$surname', city='$city', phone_number='$phone_number', profile_description='$profile_description', password='$password' WHERE user_id=$user_id");
            $_SESSION['msg'] = "Record updated!"; 
            header('location: register_user.php');
        }
        
        if (isset($_GET['del'])) {
            $user_id = $_GET['del'];
            mysqli_query($db, "DELETE FROM USER WHERE user_id=$user_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE USER AUTO_INCREMENT = 1"); 
            header('location: register_user.php');
        }



        $results = mysqli_query($db, "SELECT * FROM USER");


        //CAREGIVER
        function insertCaregiver($caregiver_user_id, $photo, $gender, $caregiving_type, $hourly_rate) {
            global $db;

            try {
                // Check if the user_id already exists in the MEMBER table
                $checkQuery = "SELECT * FROM MEMBER WHERE member_user_id = $caregiver_user_id";
                $checkResult = mysqli_query($db, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    // If user_id is used by a MEMBER, throw an exception
                    throw new Exception("A user_id can only be associated with either a CAREGIVER or a MEMBER.");
                } else {
                    // Proceed with the insertion if the user_id is not used by a MEMBER
                    $query = "INSERT INTO CAREGIVER (caregiver_user_id, photo, gender, caregiving_type, hourly_rate)
                            VALUES ('$caregiver_user_id', '$photo', '$gender', '$caregiving_type', '$hourly_rate')";
                    mysqli_query($db, $query);
                    $_SESSION['msg'] = "Record saved";
                    header('location: register_caregiver.php');
                }
            } catch (Exception $e) {
                // Catch the exception and display a user-friendly error message
                $_SESSION['msg'] = "Error: " . $e->getMessage();
                header('location: register_caregiver.php');
            }
        }

        // Handle form submissions for CAREGIVER
        if (isset($_POST['save1'])) {
            $photo = $_POST['photo'];
            $gender = $_POST['gender'];
            $caregiving_type = $_POST['caregiving_type'];
            $hourly_rate = $_POST['hourly_rate'];
            $caregiver_user_id = $_POST['caregiver_user_id'];

            insertCaregiver($caregiver_user_id, $photo, $gender, $caregiving_type, $hourly_rate);
        }


        if (isset($_POST['update1'])) {
            $photo=$_POST['photo'];
            $gender=$_POST['gender'];
            $caregiving_type=$_POST['caregiving_type'];
            $hourly_rate=$_POST['hourly_rate'];
            $caregiver_user_id= $_POST['caregiver_user_id'];

            mysqli_query($db, "UPDATE CAREGIVER SET photo='$photo', gender='$gender',  caregiving_type='$caregiving_type', hourly_rate = '$hourly_rate' WHERE caregiver_user_id=$caregiver_user_id");
            $_SESSION['msg'] = "Record updated!"; 
            header('location: register_caregiver.php');
        }
        
        if (isset($_GET['del1'])) {
            $caregiver_user_id = $_GET['del1'];
            mysqli_query($db, "DELETE FROM CAREGIVER WHERE caregiver_user_id=$caregiver_user_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE CAREGIVER AUTO_INCREMENT = 1"); 
            header('location: register_caregiver.php');
        }

        $results1 = mysqli_query($db, "SELECT * FROM CAREGIVER");


        //MEMBER
        function insertMember($member_user_id, $house_rules) {
            global $db;

            try {
                // Check if the user_id already exists in the CAREGIVER table
                $checkQuery = "SELECT * FROM CAREGIVER WHERE caregiver_user_id = $member_user_id";
                $checkResult = mysqli_query($db, $checkQuery);

                if (mysqli_num_rows($checkResult) > 0) {
                    // If user_id is used by a CAREGIVER, throw an exception
                    throw new Exception("A user_id can only be associated with either a CAREGIVER or a MEMBER.");
                } else {
                    // Proceed with the insertion if the user_id is not used by a CAREGIVER
                    $query = "INSERT INTO MEMBER (member_user_id, house_rules) VALUES ('$member_user_id', '$house_rules')";
                    mysqli_query($db, $query);
                    $_SESSION['msg'] = "Record saved";
                    header('location: register_member.php');
                }
            } catch (Exception $e) {
                // Catch the exception and display a user-friendly error message
                $_SESSION['msg'] = "Error: " . $e->getMessage();
                header('location: register_member.php');
            }
        }

        // Handle form submissions for MEMBER
        if (isset($_POST['save2'])) {
            $house_rules = $_POST['house_rules'];
            $member_user_id = $_POST['member_user_id'];

            insertMember($member_user_id, $house_rules);
        }


        if (isset($_POST['update2'])) {
            $house_rules = $_POST['house_rules'];
            $member_user_id = $_POST['member_user_id'];

            mysqli_query($db, "UPDATE MEMBER SET house_rules='$house_rules' WHERE member_user_id=$member_user_id");
            $_SESSION['msg'] = "Record updated!";
            header('location: register_member.php');
        }

        if (isset($_GET['del2'])) {
            $member_user_id = $_GET['del2'];
            mysqli_query($db, "DELETE FROM MEMBER WHERE member_user_id=$member_user_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE MEMBER AUTO_INCREMENT = 1");
            header('location: register_member.php');
        }


        $results2= mysqli_query($db, "SELECT * FROM MEMBER");

        //ADDRESS
        if (isset($_POST['save3'])) {
            $house_number = $_POST['house_number'];
            $street = $_POST['street'];
            $town = $_POST['town'];
            $member_user_id = $_POST['member_user_id'];
    
                $query = "INSERT INTO ADDRESS (member_user_id, house_number, street, town)
                        VALUES('$member_user_id', '$house_number', '$street', '$town')";
        
                mysqli_query($db, $query);
                $_SESSION['msg'] = "Record saved";
                header('location: add_address.php');
        }
        
        if (isset($_POST['update3'])) {
            $house_number = $_POST['house_number'];
            $street = $_POST['street'];
            $town = $_POST['town'];
            $member_user_id = $_POST['member_user_id'];
        
            mysqli_query($db, "UPDATE ADDRESS SET house_number='$house_number', street='$street', town='$town' WHERE member_user_id=$member_user_id");
            $_SESSION['msg'] = "Record updated!";
            header('location: add_address.php');
        }
        
        if (isset($_GET['del3'])) {
            $member_user_id = $_GET['del3'];
            mysqli_query($db, "DELETE FROM ADDRESS WHERE member_user_id=$member_user_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE ADDRESS AUTO_INCREMENT = 1");
            header('location: add_address.php');
        }
        
        $results3 = mysqli_query($db, "SELECT * FROM ADDRESS");

        //JOB
        if (isset($_POST['save4'])) {
            try{
            $member_user_id = $_POST['member_user_id'];
            $required_caregiving_type = $_POST['required_caregiving_type'];
            $other_requirements = $_POST['other_requirements'];
            $date_posted = $_POST['date_posted'];
            $person_age = $_POST['person_age'];
            $preferred_time_intervals = $_POST['preferred_time_intervals'];
            $caregiving_frequency = $_POST['caregiving_frequency'];
        
                $query = "INSERT INTO JOB (member_user_id, required_caregiving_type, other_requirements, date_posted, person_age, preferred_time_intervals, caregiving_frequency)
                        VALUES('$member_user_id', '$required_caregiving_type', '$other_requirements', '$date_posted', '$person_age', '$preferred_time_intervals', '$caregiving_frequency')";
        
                mysqli_query($db, $query);
                $_SESSION['msg'] = "Record saved";
                header('location: post_job.php');
            } catch (Exception $e) {
                // Catch the exception and display a user-friendly error message
                $_SESSION['msg'] = "Error: " . $e->getMessage();
                header('location: post_job.php');
            }
        }
        
        if (isset($_POST['update4'])) {
            $member_user_id = $_POST['member_user_id'];
            $required_caregiving_type = $_POST['required_caregiving_type'];
            $other_requirements = $_POST['other_requirements'];
            $date_posted = $_POST['date_posted'];
            $person_age = $_POST['person_age'];
            $preferred_time_intervals = $_POST['preferred_time_intervals'];
            $caregiving_frequency = $_POST['caregiving_frequency'];
            $job_id = $_POST['job_id'];
        
            mysqli_query($db, "UPDATE JOB SET member_user_id='$member_user_id', required_caregiving_type='$required_caregiving_type', other_requirements='$other_requirements', date_posted='$date_posted', person_age='$person_age', preferred_time_intervals='$preferred_time_intervals', caregiving_frequency='$caregiving_frequency' WHERE job_id=$job_id");
            $_SESSION['msg'] = "Record updated!";
            header('location: post_job.php');
        }
        
        if (isset($_GET['del4'])) {
            $job_id = $_GET['del4'];
            mysqli_query($db, "DELETE FROM JOB WHERE job_id=$job_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE JOB AUTO_INCREMENT = 1");
            header('location: post_job.php');
        }
        
        // Fetch all JOB records
        $results4= mysqli_query($db, "SELECT * FROM JOB");

        //JOB_APPLICATION
        if (isset($_POST['save5'])) {
            try{
            $caregiver_user_id= $_POST['caregiver_user_id'];
            $job_id = $_POST['job_id'];
            $date_applied = $_POST['date_applied'];
        
                $query = "INSERT INTO JOB_APPLICATION (caregiver_user_id, job_id, date_applied)
                        VALUES('$caregiver_user_id', '$job_id', '$date_applied')";
                mysqli_query($db, $query);
                $_SESSION['msg'] = "Record saved";
                header('location: create_job_application.php');
            } catch (Exception $e) {
                // Catch the exception and display a user-friendly error message
                $_SESSION['msg'] = "Error: " . $e->getMessage();
                header('location: create_job_application.php');
            }
        }
        
        if (isset($_POST['update5'])) {
            $caregiver_user_id = $_POST['caregiver_user_id'];
            $job_id= $_POST['job_id'];
            $date_applied = $_POST['date_applied'];
        
            mysqli_query($db, "UPDATE JOB_APPLICATION SET date_applied='$date_applied', job_id=$job_id WHERE caregiver_user_id = $caregiver_user_id");
            $_SESSION['msg'] = "Record updated!";
            header('location: create_job_application.php');
        }
        
        if (isset($_GET['del5'])) {
            $caregiver_user_id = $_GET['del5'];
            $job_id = $_GET['del5'];
            mysqli_query($db, "DELETE FROM JOB_APPLICATION WHERE caregiver_user_id=$caregiver_user_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE JOB_APPLICATION AUTO_INCREMENT = 1");
            header('location: create_job_application.php');
        }
        
        // Fetch all JOB_APPLICATION records
        $results5 = mysqli_query($db, "SELECT * FROM JOB_APPLICATION");

        //APPOINTMENT
        if (isset($_POST['save6'])) {
        try{
            $caregiver_user_id= $_POST['caregiver_user_id'];
            $member_user_id= $_POST['member_user_id'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $work_hours = $_POST['work_hours'];
            $status = $_POST['status'];
        
                $query = "INSERT INTO APPOINTMENT (caregiver_user_id, member_user_id, appointment_date, appointment_time, work_hours, status)
                        VALUES('$caregiver_user_id', '$member_user_id', '$appointment_date', '$appointment_time', '$work_hours', '$status')";
        
                mysqli_query($db, $query);
                $_SESSION['msg'] = "Record saved";
                header('location: make_appointment.php');
            } catch (Exception $e) {
                // Catch the exception and display a user-friendly error message
                $_SESSION['msg'] = "Error: " . $e->getMessage();
                header('location: make_appointment.php');
            }
        }
        
        if (isset($_POST['update6'])) {
            $caregiver_user_id = $_POST['caregiver_user_id'];
            $member_user_id= $_POST['member_user_id'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $work_hours = $_POST['work_hours'];
            $status = $_POST['status'];
            $appointment_id = $_POST['appointment_id'];
        
            mysqli_query($db, "UPDATE APPOINTMENT SET caregiver_user_id='$caregiver_user_id', member_user_id='$member_user_id', appointment_date='$appointment_date', appointment_time='$appointment_time', work_hours='$work_hours', status='$status' WHERE appointment_id=$appointment_id");
            $_SESSION['msg'] = "Record updated!";
            header('location: make_appointment.php');
        }
        
        if (isset($_GET['del6'])) {
            $appointment_id = $_GET['del6'];
            mysqli_query($db, "DELETE FROM APPOINTMENT WHERE appointment_id=$appointment_id");
            $_SESSION['msg'] = "Record deleted!";
            mysqli_query($db, "ALTER TABLE APPOINTMENT AUTO_INCREMENT = 1");
            header('location: make_appointment.php');
        }
        
        // Fetch all APPOINTMENT records
        $results6 = mysqli_query($db, "SELECT * FROM APPOINTMENT");






?>