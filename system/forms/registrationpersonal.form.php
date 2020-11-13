<section class="content">
    <div class="container-fluid">
        <div class="card">

        <div style="margin: 10px;" class="text-center">
                        <a href='http://192.168.0.33/sis/startregistration/summery/' class="btn btn-default btn-rounded mb-4" >
                            View Summery</a>

                            <h1 >
                <b>Personal details</b>
            </h1>
                    </div>

            <form method="POST" action="<?php echo $this->core->conf['conf']['path'] . "/startregistration/savepersonal/" . $this->core->item; ?> ">

                <div style="padding: 20px;" class="">

                    <div style="display: flex;">
                        <div class="form-line col-sm-4 ">
                            <label for="first_name">First Name :</label>
                            <input name="first_name" Class="form-control" required="required" />
                        </div>

                        <div class="form-line col-sm-4 ">
                            <label for="middle_name">Middle Name:</label>
                            <input name="middle_name" Class="form-control"/>
                        </div>

                        <div class="form-line col-sm-4 ">
                            <label for="last_name">Last Name:*</label>
                            <input name="last_name" Class="form-control" required="required" />
                        </div>

                       
                    </div>

                    <br> <br>

                    <div style="display: flex;">

                        <div class="form-line col-sm-4">
                            <label for="nrc">NRC :*</label>
                            <input name="nrc" id="nrc" placeholder="******/**/**" Class="form-control" required />
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="title">Title :*</label>
                            <select class="form-control" form-line col-sm-3" name="title" id="">
                                <option value="">Mr</option>
                                <option value="">Mrs</option>
                                <option value="">Madam</option>
                            </select>
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="dob">Date of Birth :*</label>
                            <input type="date" name="dob" Class="form-control" />
                        </div>

                    </div>

                    <br> <br>

                    <div style="display: flex;">

                        <div class="form-line col-sm-4">
                            <label for="gender">Gender :*</label>
                            <select class="form-control" form-line col-sm-3" name="gender" id="gender">
                                <option >Male</option>
                                <option >Female</option>
                                <option >Other</option>
                            </select>
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="maritalstatus">Marital Status :*</label>
                            <select class="form-control" form-line col-sm-3" name="maritalstatus" id="">
                                <option >Single</option>
                                <option >Married</option>
                                <option >Divorced</option>
                            </select>
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="nationality">Nationality :*</label>
                            <select class="form-control" form-line col-sm-3" name="nationality" >
                                <?php echo $country; ?>
                            </select>
                        </div>

                    </div>

                    <br> <br>

                    <div style="display: flex;">

                        <div class="form-line col-sm-4">
                            <label for="country_of_residence">Country of Residence </label>
                            <select class="form-control" form-line col-sm-3" name="country_of_residence" id="country_of_residence">
                                <?php echo $country; ?>
                            </select>
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="place_of_birth">Place of Birth :*</label>
                            <input type="text" name="place_of_birth" Class="form-control" required/>
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="residencial_address">Residencial Address </label>
                            <input type="text" name="residencial_address" Class="form-control" />
                        </div>

                    </div>

                    <br><br>

                    <div style="display: flex;">

                        <div class="form-line col-sm-4">
                            <label for="mobile_number">Mobile Number :*</label>
                            <input type="text" name="mobile_number" required Class="form-control" />
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="telephone">Telephone </label>
                            <input type="text" name="telephone" Class="form-control" />
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="fax">Fax :</label>
                            <input type="text" name="fax" Class="form-control" />
                        </div>

                    </div>

                    <br><br>

                    <div style="display: flex;">

                        <div class="form-line col-sm-4">
                            <label for="email">Email :*</label>
                            <input type="text" name="email" Class="form-control" required />
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="disability">Disability </label>
                            <input type="text" name="disability" Class="form-control" />
                        </div>

                        <div class="form-line col-sm-4">
                            <label for="datecreated">Date :</label>
                            <input type="date" name="datecreated" Class="form-control" />
                        </div>

                        

                    </div>



                </div>

                <div style="padding: 20px;" class="">
                    <!-- <a class="btn btn-primary" href="${contextPath}/${user.username}/application/1">Previous</a> -->
                    <button type="submit" class="btn btn-primary" name="next">Next</button>
                </div>
            </form>
        </div>

    </div>
</section>
