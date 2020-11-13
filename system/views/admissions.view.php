<?php
class admissions
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
                // echo '<style>
                // 	.bodycon {
                // 		background-color: #1C00ff00;
                // 	}
                // 	.contentwrapper {
                // 		padding: 20px;
                // 	}
                // </style>';
        }


        //displays the sponsor and next of kin page of the online registration................................
        public function applicantAdmissions($item)
        {
                // Always start thils first
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);
                $applicant = $select->showApplicant();

                include $this->core->conf['conf']['formPath'] . "applicantlist.form.php";
        }

        //displays the sponsor and next of kin page of the online registration................................
        public function admittedAdmissions($item)
        {
                // Always start thils first
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);
                $applicant = $select->showAdmitted();

                include $this->core->conf['conf']['formPath'] . "acceptedapplicant.form.php";
        }


        //displays the sponsor and next of kin page of the online registration................................
        public function rejectedAdmissions($item)
        {
                // Always start thils first
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);
                $applicant = $select->showRejected();

                include $this->core->conf['conf']['formPath'] . "rejectedapplicant.form.php";
        }


        //displays the applicants that are automatically eligable for admission................................
        public function autoselectedAdmissions($item)
        {
                // Always start thils first
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);
                $applicant = $select->showAutoselected();

                include $this->core->conf['conf']['formPath'] . "applicantautoselected.form.php";
        }

        //displays the applicants that are automatically eligable for admission................................
        public function profileAdmissions($item)
        {
                $applicantsid = $_GET['id'];
                $applicantno = substr($applicantsid, 19);

                // Always start thils first
                include $this->core->conf['conf']['classPath'] . "showoptions.inc.php";

                $select = new optionBuilder($this->core);
                $personal = $select->showPersonal($applicantno);
                $olevel  = $select->showOlevel($applicantno);
                $program  = $select->showProgram($applicantno);

                $nextofkin  = $select->showKins($applicantno);
                $sponsor  = $select->showSponsor($applicantno);
                $employment  = $select->showEmployment($applicantno);

                include $this->core->conf['conf']['formPath'] . "applicantprofile.form.php";
        }

        public function savestatusAdmissions($item)
        {
                $applicantnumber = $this->core->cleanPost['applicantno'];
                echo $applicantnumber;
                $admin = $this->core->cleanPost['currentuser'];
                $accept = $_POST['accept'];
                $reject = $_POST['reject'];

                //sets the time zone to central african time 
                date_default_timezone_set("Africa/Harare");
                $dateTimeLogged = date("Y-m-d h:i:sa");

                if ($accept) {
                        $acceptstatus = "accepted";
                        $sql = "INSERT INTO appl_status (`user`,`userdate`,`applicantno`,`status`) VALUES ('$admin', '$dateTimeLogged', '$applicantnumber', '$acceptstatus');";
                        $this->core->database->doInsertQuery($sql);
                        echo $sql . error;
                        echo "ACCEPTED";
                } else if ($reject) {
                        $rejectstatus = "rejected";
                        $sql = "INSERT INTO appl_status (`user`,`userdate`,`applicantno`,`status`) VALUES ('$admin', '$dateTimeLogged', '$applicantnumber', '$rejectstatus');";
                        //echo $sql.error;
                        echo "rejected";
                }
        }
}
