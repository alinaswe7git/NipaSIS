<?php
class startregistration
{

        public $core;
        public $view;

        public function configView()
        {
                $this->view->open = TRUE;
                $this->view->header = TRUE;
                $this->view->footer = TRUE;
                $this->view->menu = FALSE;
                $this->view->internalMenu = TRUE;
                $this->view->javascript = array();
                $this->view->css = array();

                return $this->view;
        }

        public function buildView($core)
        {
                $this->core = $core;
                //change the back ground color from defualt to transparent
                echo '<style>
			.bodycontainer {
				background-color: #1C00ff00;
			}
			.contentwrapper {
				padding: 20px;
			}
		</style>';
        }

        public function logoutStartregistration($item)
        {
                session_unset();
                session_destroy();

                include $this->core->conf['conf']['formPath'] . "registrationlogin.form.php";
        }

        //displays PERSONAL INFORMATION of online registration...................................
        public function personalStartregistration($item)
        {
                // Always start thils first

                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages
                        include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                        $select = new optionBuilder($this->core);
                        $country = $select->showCountry();

                        include $this->core->conf['conf']['formPath'] . "registrationpersonal.form.php";
                        echo $_SESSION['applicant_id'];
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        public function savepersonalStartregistration()
        {

                // // remove all session variables
                // session_unset();
                // session_destroy();

                $applicant_id = $_SESSION['applicant_id'];

                // Next of Kin details
                $first_name = $this->core->cleanPost['first_name'];
                $last_name = $this->core->cleanPost['last_name'];
                $middle_name = $this->core->cleanPost['middle_name'];
                $nrc = $this->core->cleanPost['nrc'];
                $title = $this->core->cleanPost['title'];

                $dob = $this->core->cleanPost['dob'];
                $gender = $this->core->cleanPost['gender'];
                $maritalstatus = $this->core->cleanPost['maritalstatus'];
                $nationality = $this->core->cleanPost['nationality'];
                $country_of_residence = $this->core->cleanPost['country_of_residence'];

                $place_of_birth = $this->core->cleanPost['place_of_birth'];
                $residencial_address = $this->core->cleanPost['residencial_address'];
                $mobile_number = $this->core->cleanPost['mobile_number'];
                $telephone = $this->core->cleanPost['telephone'];
                $fax = $this->core->cleanPost['fax'];

                $postal_address = $this->core->cleanPost['postal_address'];
                $residencial_address = $this->core->cleanPost['residencial_address'];
                $mobile_number = $this->core->cleanPost['mobile_number'];
                $telephone = $this->core->cleanPost['telephone'];
                $fax = $this->core->cleanPost['fax'];

                $email = $this->core->cleanPost['email'];
                $disability = $this->core->cleanPost['disability'];
                $datecreated = $this->core->cleanPost['datecreated'];


                $sql = "INSERT INTO `appl_personal` (`applicantno`, `NRCnumber`, `lastname`, `firstname`,`middlename`, `title`, `dateofbirth`, `placeofbirth`,`gender`, `maritalstatus`, `nationality`, `countryofresidence`,`postaladdress`, `residentialaddress`, `mobilephone`, `telephone`,`fax`, `email`, `disability`,`dateofcreation`) 
                                VALUES ('$applicant_id','$nrc', '$last_name', '$first_name','$middle_name','$title', '$dob', '$place_of_birth','$gender','$maritalstatus', '$nationality', '$country_of_residence','$postal_address','$residencial_address', '$mobile_number', '$telephone','$fax','$email', '$disability', '$datecreated');";

                if ($this->core->database->doInsertQuery($sql)) {
                        echo '<div class="successpopup">The requested user account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/kin/'; </script>";
                } else {
                        //used to check the error with the sql query
                        //echo $sql . error;
                        echo '<script>alert("Personal information for this applicant already exists")</script>';
                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/summery/'; </script>";
                }
        }


        //displays the secetion where users can upload files related to registration...................
        public function uploadStartregistration($item)
        {
                // Always start thils first


                if (isset($_SESSION['applicant_id'])) {

                        include $this->core->conf['conf']['formPath'] . "registrationfiles.form.php";
                        echo $_SESSION['applicant_id'];
                } else {
                        // Redirect them to the login page

                        include $this->core->conf['conf']['formPath'] . "registration3.form.php";
                }
        }

        //..............................................................................................

        // public function saveupload(){

        //         //session id to show that the user is login
        //         $applicant_id = $_SESSION['applicant_id'];

        //         $grade_12_certificate = $this->core->cleanPost['grade_12_certificate'];
        //         $passport_nrc = $this->core->cleanPost['passport_nrc'];
        //         $qualification = $this->core->cleanPost['qualification'];
        //         $qualification1 = $this->core->cleanPost['qualification1'];

        // }

        public function savefilesStartregistration()
        {

                $applicant_id = $_SESSION['applicant_id'];
                $txt = "image";

                if (isset($_FILES["file"])) {

                        $file = $_FILES["file"];

                        $home = getcwd();
                        $path = $this->core->conf['conf']["dataStorePath"] . 'uploads';



                        if (!is_dir($path)) {
                                mkdir($path, 0755, true);
                        }

                        if ($_FILES["file"]["error"] > 0) {
                                echo "Error: " . $file["error"]["file"] . "<br>";
                        } else {

                                $fname = $_FILES["file"]["name"];
                                $destination = $path . "/" . $fname;

                                if (file_exists($destination)) {
                                        $fname = rand(1, 999) . '-' . $fname;
                                        $destination = $path . "/" . $fname;
                                }

                                echo $_FILES["file"]["tmp_name"];

                                move_uploaded_file($_FILES["file"]["tmp_name"], "http://192.168.0.33/sis/datastore/uploads/");

                                if (file_exists($destination)) {
                                        echo '<div class="successpopup">File uploaded as ' . $fname . '</div>';
                                }
                        }
                } else {
                        echo 'testtesttesttetstetstetstets';
                }

                $base = $this->core->conf['conf']['path'] . '/datastore/uploads/' . $fname;


                //if(!empty($applicant_id)){
                //      $sql = "UPDATE `content` SET `Content` = '".$content."', `Name` = '".$name."' WHERE `ContentID` = '".$id."';";
                //}else{


                $sql = "INSERT INTO `appl_attachments` (`applicantno`, `attachtype`, `fileno`, `academic_professional_qualification`,`grade12certificate`,`passportornrc`) 
				VALUES ('" . $applicant_id . "', '" . $txt . "', '" . $applicant_id . "', '$base', '$base', '$base');";
                //}

                if ($this->core->database->doInsertQuery($sql)) {
                        echo '<div class="successpopup">The requested user account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                        //echo "<script> location.href='http://192.168.0.33/sis/startregistration/show/'; </script>";

                } else {
                        //used to check the error with the sql query
                        echo $sql . error;
                        echo '<div class="successpopup">The requested user account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                }

                $this->core->redirect("home", "show", NULL);
        }

        //..............................................................................................




        //displays the sponsor and next of kin page of the online registration................................
        public function kinStartregistration($item)
        {
                // Always start thils first


                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages

                        $applicant_id = $_SESSION['applicant_id'];

                        include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                        $select = new optionBuilder($this->core);
                        $applicantid = $select->showKin($applicant_id);
                        $nn = $applicantid;

                        if (print $nn == $applicant_id) {
                                //echo "<script> location.href='http://192.168.0.33/sis/startregistration/program/'; </script>";
                        } elseif (print $nn == $applicant_id) {
                                # code...
                        }

                        include $this->core->conf['conf']['formPath'] . "registration1.form.php";
                        echo $_SESSION['applicant_id'];
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        //this is called when the user hits the next button of the first page of the registration page
        //to enable the data to be saved to the session
        public function savekinStartregistration()
        {

                if ($_SESSION['applicant_id'] != null) {

                        $applicant_id = $_SESSION['applicant_id'];
                        // Next of Kin details
                        $nextofkin_fullname = $this->core->cleanPost['nextofkin_fullname'];
                        $nextofkin_relationship = $this->core->cleanPost['nextofkin_relationship'];
                        $nextofkin_postaladdress = $this->core->cleanPost['nextofkin_postaladdress'];
                        $nextofkin_telephone = $this->core->cleanPost['nextofkin_telephone'];
                        $nextofkin_email = $this->core->cleanPost['nextofkin_email'];

                        //load the data for the next of kin in the database
                        $sql = "INSERT INTO `appl_nextofkin` (`applicantno`, `fullname`, `relationship`,`postaladdress`, `telephone`, `email`) 
                        VALUES ('$applicant_id', '$nextofkin_fullname', '$nextofkin_relationship', '$nextofkin_postaladdress','$nextofkin_telephone','$nextofkin_email');";

                        if ($this->core->database->doInsertQuery($sql)) {
                                //echo '<script> alert("test"); </script>';
                        } else {
                                //echo $sql.error;
                                
                        }

                        // Adding variables to session
                        $_SESSION['nextofkin_fullname'] = $nextofkin_fullname;
                        $_SESSION['nextofkin_relationship'] = $nextofkin_relationship;
                        $_SESSION['nextofkin_postaladdress'] = $nextofkin_postaladdress;
                        $_SESSION['nextofkin_telephone'] = $nextofkin_telephone;
                        $_SESSION['nextofkin_email'] = $nextofkin_email;


                        // Sponsor details
                        $sponsor_sponsorname = $this->core->cleanPost['sponsor_sponsorname'];
                        $sponsor_relationship = $this->core->cleanPost['sponsor_relationship'];
                        $sponsor_telephone = $this->core->cleanPost['sponsor_telephone'];
                        $sponsor_postaladdress = $this->core->cleanPost['sponsor_postaladdress'];
                        $sponsor_email = $this->core->cleanPost['sponsor_email'];

                        //load the data for the next of sponsor in the database
                        $sql = "INSERT INTO `appl_sponsor` (`applicantno`, `sponsorname`, `relationship`,`postaladdress`, `telephone`, `email`) 
                        VALUES ('$applicant_id', '$sponsor_sponsorname', '$sponsor_relationship', '$sponsor_telephone','$sponsor_postaladdress','$sponsor_email');";

                        if ($this->core->database->doInsertQuery($sql)) {
                                echo '<div class="successpopup">The requested sponsor account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                        } else {
                                //echo $sql.error;
                                echo '<div class="successpopup">The requested sponsor account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                        }


                        // Adding variables to session
                        $_SESSION['sponsor_sponsorname'] = $sponsor_sponsorname;
                        $_SESSION['sponsor_relationship'] = $sponsor_relationship;
                        $_SESSION['sponsor_telephone'] = $sponsor_telephone;
                        $_SESSION['sponsor_postaladdress'] = $sponsor_postaladdress;
                        $_SESSION['sponsor_email'] = $sponsor_email;


                        // Employment details
                        $employment_employer = $this->core->cleanPost['employment_employer'];
                        $employment_jobtitle = $this->core->cleanPost['employment_jobtitle'];
                        $employment_postaladdress = $this->core->cleanPost['employment_postaladdress'];
                        $employment_telephone = $this->core->cleanPost['employment_telephone'];
                        $employment_dateofappointment = $this->core->cleanPost['employment_dateofappointment'];


                        //load the data for the next of sponsor in the database
                        $sql = "INSERT INTO `appl_employment` (`applicantno`, `employer`, `jobtitle`,`postaladdress`, `telephone`, `dateofappointment`) 
                        VALUES ('$applicant_id', '$employment_employer', '$employment_jobtitle', '$employment_postaladdress','$employment_telephone','$employment_dateofappointment');";

                        if ($this->core->database->doInsertQuery($sql)) {
                                echo '<div class="successpopup">The requested employment account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                        } else {
                                echo $sql . error;
                                echo '<div class="successpopup">The requested employment account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                        }


                        // Adding variables to session
                        $_SESSION['employment_employer'] = $employment_employer;
                        $_SESSION['employment_jobtitle'] = $employment_jobtitle;
                        $_SESSION['employment_postaladdress'] = $employment_postaladdress;
                        $_SESSION['employment_telephone'] = $employment_telephone;
                        $_SESSION['employment_dateofappointment'] = $employment_dateofappointment;

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/previous/'; </script>";
               
                } else {
                       echo "<script> location.href='http://192.168.0.33/sis/startregistration/access/'; </script>";
                }
        }

        //displays the regsitration page of online registration.........................................
        public function createStartregistration($item)
        {
                include $this->core->conf['conf']['formPath'] . "registrationregister.form.php";
        }

        //displays the second page of online registration
        public function subjectsStartregistration($item)
        {

                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages
                        include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                        $select = new optionBuilder($this->core);
                        $subject = $select->showSubjects();

                        include $this->core->conf['conf']['formPath'] . "registration5.form.php";
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        public function savesubjectStartregistration()
        {

                $applicant_id = $_SESSION['applicant_id'];
                $count = $this->core->cleanPost["count"];

                for ($x = 1; $x <= $count; $x++) {
                        $subject = $this->core->cleanPost["subject" . $x];
                        $grade = $this->core->cleanPost["grade" . $x];
                        $level = $this->core->cleanPost["level" . $x];

                        $sql = "INSERT INTO `appl_grades` (`applicantno`, `subject_id`, `level`, `grade`) 
                                VALUES ('$applicant_id','$subject', '$grade', '$level');";

                        if ($this->core->database->doInsertQuery($sql)) {
                                echo $sql.error;
                                echo '<div class="successpopup">The new user account has been created.<br/> </div>';
                               echo "<script> location.href='http://192.168.0.33/sis/startregistration/institution/'; </script>";
                        } else {
                                //used to check the error with the sql query
                                echo $sql . error;
                                echo '<div class="successpopup">The requested user account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                        }
                        // echo $x;
                        // echo $institution1;
                }
        }



        //displays the page for the user to enter previous institions visted  of online registration.......................................
        public function institutionStartregistration($item)
        {
                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages
                        include $this->core->conf['conf']['formPath'] . "registration6.form.php";
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        //this method is used to save the registration6 page (institution) 
        public function saveprofessionStartregistration()
        {

                $applicant_id = $_SESSION['applicant_id'];
                $count = $this->core->cleanPost["count"];

                for ($x = 1; $x <= $count; $x++) {
                        $institution = $this->core->cleanPost["institution" . $x];
                        $qualification = $this->core->cleanPost["qualification" . $x];
                        $area_of_specialisation = $this->core->cleanPost["area_of_specialisation" . $x];
                        $date_obtained = $this->core->cleanPost["date_obtained" . $x];

                        $sql = "INSERT INTO `appl_professional` (`applicantno`, `institution`, `specialisation`, `qualification`, `dateobtained`) 
                                        VALUES ('$applicant_id', '$institution', '$area_of_specialisation', '$qualification','$date_obtained');";

                        if ($this->core->database->doInsertQuery($sql)) {
                                echo '<div class="successpopup">The requested user account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                                echo "<script> location.href='http://192.168.0.33/sis/startregistration/upload/'; </script>";
                        } else {
                                //used to check the error with the sql query
                                //echo $sql.error;
                                echo '<div class="successpopup">The requested user account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                        }
                }
        }

        //displays the select program page of online registration............................
        public function programStartregistration($item)
        {

                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages
                        include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                        $select = new optionBuilder($this->core);
                        $schools = $select->showStudies();

                        include $this->core->conf['conf']['formPath'] . "registration2.form.php";
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        public function saveprogramStartregistration()
        {
                //login id
                $applicant_id = $_SESSION['applicant_id'];

                $program_level = $this->core->cleanPost['program_level'];
                $mode_of_study = $this->core->cleanPost['mode_of_study'];
                $campus = $this->core->cleanPost['campus'];
                $how_you_head_of_nipa = $this->core->cleanPost['how_you_head_of_nipa'];
                $program = $this->core->cleanPost['program'];

                //load the data for the next of kin in the database
                $sql = "INSERT INTO `appl_program` (`applicantno`, `level`, `modeofstudy`,`campus`, `knowhow`, `program`) 
                VALUES ('$applicant_id', '$program_level', '$mode_of_study', '$campus','$how_you_head_of_nipa','$program');";

                if ($this->core->database->doInsertQuery($sql)) {
                        echo '<div class="alert alert-success" role="alert"> <strong>Success</strong> Saved! </div>';
                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/personal/'; </script>";
                } else {
                        //echo $sql.error;
                        echo '<div class="successpopup">The requested next of kin account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                }
        }

        //displays the login page of online registration
        public function previousStartregistration($item)
        {
                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages
                        include $this->core->conf['conf']['formPath'] . "registration4.form.php";
                } else {
                        // Redirect them to the login page

                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                }
        }

        //this method is used to save the registration6 page (institution) 
        public function savepreviousStartregistration()
        {

                $applicant_id = $_SESSION['applicant_id'];
                $count = $this->core->cleanPost["count"];

                $examination_number = $this->core->cleanPost['examination_number'];
                $examination_body = $this->core->cleanPost['examination_body'];
                $examination_year = $this->core->cleanPost['examination_year'];

                $sql = "INSERT INTO `appl_exam` (`applicantno`, `examno`, `exambody`, `examyear`) 
                        VALUES ('$applicant_id', '$examination_number', '$examination_body', '$examination_year');";

                if ($this->core->database->doInsertQuery($sql)) {

                        for ($x = 1; $x <= $count; $x++) {
                                $school = $this->core->cleanPost["school" . $x];
                                $start_year = $this->core->cleanPost["start_year" . $x];
                                $end_year = $this->core->cleanPost["end_year" . $x];
                                $level_of_attainment = $this->core->cleanPost["level_of_attainment" . $x];


                                $sql = "INSERT INTO `appl_schools` (`applicantno`, `school`, `yearfrom`, `yearto`, `level`) 
                                                VALUES ('$applicant_id', '$school', '$start_year', '$end_year','$level_of_attainment');";

                                if ($this->core->database->doInsertQuery($sql)) {
                                        echo '<div class="successpopup">The requested user account has been created.<br/> WRITE THE FOLLOWING INFORMATION DOWN OR REMEMBER IT!</div>';
                                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/subjects/'; </script>";
                                } else {
                                        //used to check the error with the sql query
                                        //echo $sql.error;
                                        echo '<div class="successpopup">The requested user account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                                }
                        }
                } else {
                        //used to check the error with the sql query
                        //echo $sql.error;
                        echo '<div class="successpopup">The requested user account has failed to be created .<br/> CHECK THE DETAILS!</div>';
                }
        }


        //this is called when the user hits the next button of the second page of the registration page
        //to enable the data to be saved to the session
        public function saveProgram()
        {

                // profram details
                $Program_type = $this->core->cleanPost['Program_type'];
                $mode_of_study = $this->core->cleanPost['mode_of_study'];
                $campus = $this->core->cleanPost['campus'];
                $how_you_head_of_nipa = $this->core->cleanPost['how_you_head_of_nipa'];
                $selected_program = $this->core->cleanPost['selected_program'];

                // Adding variables to session
                $_SESSION['Program_type'] = $Program_type;
                $_SESSION['mode_of_study'] = $mode_of_study;
                $_SESSION['campus'] = $campus;
                $_SESSION['how_you_head_of_nipa'] = $how_you_head_of_nipa;
                $_SESSION['selected_program'] = $selected_program;


                // User registration details
                $email = $this->core->cleanPost['email'];
                $password = $this->core->cleanPost['password'];
                $sponsor_telephone = $this->core->cleanPost['sponsor_telephone'];
                $sponsor_postaladdress = $this->core->cleanPost['sponsor_postaladdress'];
                $sponsor_email = $this->core->cleanPost['sponsor_email'];

                // Adding variables to session
                $_SESSION['sponsor_sponsorname'] = $sponsor_sponsorname;
                $_SESSION['sponsor_relationship'] = $sponsor_relationship;
                $_SESSION['sponsor_telephone'] = $sponsor_telephone;
                $_SESSION['sponsor_postaladdress'] = $sponsor_postaladdress;
                $_SESSION['sponsor_email'] = $sponsor_email;


                // Employment details
                $employment_employer = $this->core->cleanPost['employment_employer'];
                $employment_jobtitle = $this->core->cleanPost['employment_jobtitle'];
                $employment_postaladdress = $this->core->cleanPost['employment_postaladdress'];
                $employment_telephone = $this->core->cleanPost['employment_telephone'];
                $employment_dateofappointment = $this->core->cleanPost['employment_dateofappointment'];

                // Adding variables to session
                $_SESSION['employment_employer'] = $employment_employer;
                $_SESSION['employment_jobtitle'] = $employment_jobtitle;
                $_SESSION['employment_postaladdress'] = $employment_postaladdress;
                $_SESSION['employment_telephone'] = $employment_telephone;
                $_SESSION['employment_dateofappointment'] = $employment_dateofappointment;

                //load the data in the database
                $sql = "INSERT INTO `newapplicantlog` (`emailornumber`, `applicantID`, `datetimelogged`) 
                        VALUES ('$emailadd', '$idd', '$dateTimeLogged');";

                $this->core->redirect("startregistration", "show2", NULL);
        }

        //displays the login page of online registration...................................................
        public function loginStartregistration($item)
        {
                include $this->core->conf['conf']['formPath'] . "registrationlogin.form.php";
        }

        public function saveaccessStartregistration()
        {

                // Always start this first
                session_start();

                try {
                        //login information
                        $email_phone_number = $this->core->cleanPost['email_phone_number'];
                        $password = $this->core->cleanPost['password'];

                        //sets the time zone to central african time 
                        date_default_timezone_set("Africa/Harare");
                        $dateTimeLogged = date("Y-m-d h:i:sa");

                        if (!filter_var($email_phone_number, FILTER_VALIDATE_EMAIL)) {
                                $phoneNumber = $email_phone_number;
                                // $hash = password_hash($password, PASSWORD_DEFAULT);
                                $hash = hash('sha512', $password . $this->core->conf['conf']['hash'] . $phoneNumber);
                                echo $hash;
                                //sql qury to validate the user who is trying to login
                                $sql = "SELECT * FROM `users` WHERE `users`.emailorphone = '$phoneNumber' AND `users`.password = '$hash' ";


                                $run = $this->core->database->doSelectQuery($sql);

                                $idd = '';
                                $phoneadd = '';
                                while ($fetch = $run->fetch_assoc()) {
                                        //users uniqu identification
                                        $idd = $fetch['id'];

                                        //users login email address
                                        $phoneadd = $fetch['emailorphone'];

                                        echo $idd . "..........................................";
                                        echo $phoneadd;
                                }
                                if ($idd != null) {

                                        $sql = "INSERT INTO `newapplicantlog` (`emailornumber`, `applicantID`, `datetimelogged`) 
                        VALUES ('$phoneadd', '$idd', '$dateTimeLogged');";

                                        if ($this->core->database->doInsertQuery($sql)) {

                                                $_SESSION['applicant_id'] = $idd;


                                                //redirect to select program after login
                                                echo "<script> location.href='http://192.168.0.33/sis/startregistration/summery/'; </script>";
                                        } else {
                                                echo $sql . error;
                                                //echo ' <script> alert(""); <script>';
                                                echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                                        }
                                } else {
                                        echo $sql . error;
                                        echo '<script>alert("Failed to login make sure your email and password are correct");</script>';
                                        //echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                                }
                        } else {
                                $email = $email_phone_number;
                                // $hash = password_hash($password, PASSWORD_DEFAULT);
                                $hash = hash('sha512', $password . $this->core->conf['conf']['hash'] . $email);
                                //sql qury to validate the user who is trying to login
                                $sql = "SELECT * FROM `users` WHERE `users`.emailorphone = '$email' AND `users`.password = '$hash' ";


                                $run = $this->core->database->doSelectQuery($sql);

                                $idd = '';
                                $emailadd = '';
                                while ($fetch = $run->fetch_assoc()) {
                                        //users uniqu identification
                                        $idd = $fetch['id'];
                                        //users login email address
                                        $emailadd = $fetch['emailorphone'];
                                }
                                if ($idd != null) {

                                        $sql = "INSERT INTO `newapplicantlog` (`emailornumber`, `applicantID`, `datetimelogged`) 
                        VALUES ('$emailadd', '$idd', '$dateTimeLogged');";

                                        if ($this->core->database->doInsertQuery($sql)) {

                                                $_SESSION['applicant_id'] = $idd;


                                                //redirect to select program after login
                                                echo "<script> location.href='http://192.168.0.33/sis/startregistration/summery/'; </script>";
                                        } else {
                                                echo $sql . error;
                                                echo '<div class="successpopup">failed to add information to log  .<br/> CHECK THE DETAILS!</div>';
                                        }
                                } else {
                                        echo '<script>alert("Failed to login make sure your email and password are correct");</script>';
                                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                                }
                        }



                        // }else{

                        // }

                } catch (Execption $ex) {
                        echo '<div class="successpopup">Failed to login because of error check access information.<br/> CHECK THE DETAILS!</div>';
                }
        }

        public function saveStartregistration()
        {
                // new applicant details
                $emailorphone = $this->core->cleanPost['emailorphone'];
                $password = $this->core->cleanPost['password'];

                date_default_timezone_set("Africa/Harare");
                $dateTimeCreated = date("Y-m-d h:i:sa");

                // $hash = password_hash($password, PASSWORD_DEFAULT);
                $hash = hash('sha512', $password . $this->core->conf['conf']['hash'] . $emailorphone);



                $sql = "INSERT INTO `users` (`emailorphone`, `password`, `datetimecreated`) 
				VALUES ('$emailorphone', '$hash', '$dateTimeCreated');";

                if ($this->core->database->doInsertQuery($sql)) {
                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/login/'; </script>";
                } else {
                        //echo $sql.error;
                        echo "<script> location.href='http://192.168.0.33/sis/startregistration/create/'; </script>";
                }
        }

        public function searchPrograms()
        {
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);

                $study = $select->showStudies(null);
                $program = $select->showPrograms(null, null, null);
                $courses = $select->showCourses(null);

                include $this->core->conf['conf']['formPath'] . "searchgrades.form.php";
        }

        //displays summery information of online registration...................................
        public function summeryStartregistration($item)
        {
                // Always start thils first


                if (isset($_SESSION['applicant_id'])) {
                        // Grab user data from the database using the user_id
                        // Let them access the "logged in only" pages

                        $applicant_id = $_SESSION['applicant_id'];


                        // $sql = "SELECT * FROM `appl_personal` WHERE `applicantno` = $applicant_id ";
                        // $run = $this->core->database->doSelectQuery($sql);
                        // $fetch = $run->fetch_assoc();

                        include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                        $select = new optionBuilder($this->core);
                        $personal = $select->showPersonal($applicant_id);

                        $program = $select->showProgram($applicant_id);

                        $employment = $select->showEmployment($applicant_id);

                        $sponsor = $select->showSponsor($applicant_id);

                        $nextofkin = $select->showKins($applicant_id);

                        $grade12 = $select->showGrade12($applicant_id);

                        $educationhistory = $select->showPreviousschool($applicant_id);

                        $olevel = $select->showOlevel($applicant_id);

                        $tertiaryedu = $select->showTertiaryeducation($applicant_id);

                        $upload = $select->showUploads($applicant_id);



                        include $this->core->conf['conf']['formPath'] . "regsummery.form.php";
                        echo $_SESSION['applicant_id'];
                } else {
                        // Redirect them to the login page

                        include $this->core->conf['conf']['formPath'] . "registrationlogin.form.php";
                }
        }
}
