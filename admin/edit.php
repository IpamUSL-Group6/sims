<?php
    $sname = "";
    $gname = "";
    $contact = "";
    $email = "";
    $dept = "";
    $course = "";
    $year = "";
					
    $esname = "";
    $egname = "";
    $econtact = "";
    $eemail = "";
    $edept = "";
    $ecourse = "";
    $eyear = "";


    $sql = "select * from student where id = ".$_GET['eid'];
    $table = mysqli_query($cn, $sql);
    $row = mysqli_fetch_assoc($table);
					
	if(isset($_POST['submit']))
	{
	$sname = $_POST['sname'];
	$gname = $_POST['gname'] ;
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$dept = $_POST['dept'];
	$course = $_POST['course'];
	$year = $_POST['year'];
						
    $er = 0;
						
    if($sname == "")
    {
        $er++;
        $esname = "*Required";
    }
    else
    {
        $sname = test_input($sname);
        if(!preg_match("/^[a-zA-Z ]*$/",$sname)){
            $er++;
            $esname = "*Only letters and white space allowed";
        }
    }

    if($gname == "")
    {
        $er++;
        $egname = "*Required";
    }
    else
    {
		$gname = test_input($gname);
		if(!preg_match("/^[a-zA-Z ]*$/",$gname)){
		$er++;
		$egname = "*Only letters and white space allowed";
        }
    }

    if($contact == "")
    {
        $er++;
        $econtact = "*Required";
    }
    else
    {
        $contact = test_input($contact);
        if(!preg_match("/^[+0-9]*$/",$contact)){
            $er++;
            $econtact = "*Only numbers are allowed";
        }
							
    }

        if($email == "")
        {
            $er++;
            $eemail = "*Required";
        }
        else
        {
            $email = test_input($email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $er++;
                $eemail = "*Email format is invalid";
            }
            
        }

        if($dept == "")
        {
            $er++;
            $edept = "*Required";
        }

        if($course == "")
        {
            $er++;
            $ecourse = "*Required";
        }

        if($year == 0)
        {
            $er++;
            $eyear = "*Please select shift";
        }

        if($er == 0)
        {
            $sql = "update student set sname = '".strip_tags($sname)."', 
            gname = '".strip_tags($gname)."',
            contact = '".strip_tags($contact)."',
            email = '".strip_tags($email)."',
            dept = '".strip_tags($dept)."',
            course = '".strip_tags($course)."',
            year = ".strip_tags($year)." where id = ".$_GET['eid'];
            
            if(mysqli_query($cn, $sql))
            {
                print '<span class = "successMessage">Data update successfully</span>';
                $row['sname'] = "";
                $row['gname'] = "";
                $row['contact'] = "";
                $row['email'] = "";
                $row['dept'] = "";
                $row['course'] = "";
                $row['year'] = "";
            }
            else
            {
                print '<span>'.mysqli_error($cn).'</span>';
            }
        }
    }
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>


<div class="form-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 id="et">Student Info:
                        <?php print $_GET['eid'].', Name: '.$row["sname"]; ?>'s Information</h3>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="left-side-form">
                                        <h5><label for="sname">Student Name</label>
                                            <span class="error">
                                                <?php print $esname; ?></span></h5>
                                        <p><input type="text" name="sname" value="<?php print $row['sname']; ?>"></p>

                                        <h5><label for="gname">Guardian Name</label><span class="error">
                                                <?php print $egname; ?></span></h5>
                                        <p><input type="text" name="gname" value="<?php print $row['gname']; ?>"></p>

                                        <h5><label for="contact">Contact</label><span class="error">
                                                <?php print $econtact; ?></span></h5>
                                        <p><input type="text" name="contact" value="<?php print $row['contact']; ?>"></p>

                                        <h5><label for="email">Email</label><span class="error">
                                                <?php print $eemail; ?></span></h5>
                                        <p><input type="text" name="email" value="<?php print $row['email']; ?>"></p>

                                        <h5><label for="dept">Department</label><span class="error">
                                                <?php print $edept; ?></span></h5>
                                        <p><textarea name="dept"><?php print $row['dept']; ?></textarea></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="right-side-form">
                                        <h5><label for="course">Course</label><span class="error">
                                                <?php print $ecourse; ?></span></h5>
                                        <p><input type="text" name="course" value="<?php print $row['course']; ?>"></p>

                                        <h5><label for="year">Year</label></h5>
                                        <p><select name="year" id="">
                                                <option value="0">Year 1</option>
                                                <option value="1">Year 2</option>
                                                <option value="2">Year 3</option>
                                                <option value="3">Year 4</option>
                                            </select><span class="error">
                                                <?php print $eyear; ?></span></p>

                                        <p><input type="submit" name="submit" value="Save Change"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
