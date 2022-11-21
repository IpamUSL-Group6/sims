<!-- ===============================================
	**** A COMPLETE VALIDATE FORM WITH PHP ****
================================================ -->

<!-- ==============  PHP begin  =================-->
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
						else{
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
						else{
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
						else{
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
							$eyear = "*Please select year";
						}
						
						if($er == 0)
						{
                            /* $cn = mysqli_connect("localhost", "root", "", "db_admission");*/
							
							$sql = "INSERT INTO student (sname, gname, contact, email, dept, course, year) VALUES (
							'".mysqli_real_escape_string($cn, strip_tags($sname))."',
							'".mysqli_real_escape_string($cn, strip_tags($gname))."', 
							'".mysqli_real_escape_string($cn, strip_tags($contact))."', 
							'".mysqli_real_escape_string($cn, strip_tags($email))."', 
							'".mysqli_real_escape_string($cn, strip_tags($dept))."', 
							'".mysqli_real_escape_string($cn, strip_tags($course))."', 
							".mysqli_real_escape_string($cn, strip_tags($year))."
							)";
							
							if(mysqli_query($cn , $sql))
							{
								print '<span class = "successMessage">Data saved into system.</span>';
								$sname = "";
								$gname = "";
								$contact = "";
								$email = "";
								$dept = "";
								$course = "";
								$year = "";
									
							}
							else
							{
								print '<span class= "errorMessage">'.mysqli_error($cn).'</span>';
							}
						}
						else
						{
							print '<span class = "errorMessage">Please fill all the required fields correctly.</span>';
						}
					}
					
					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
					
//================================ PHP End =============================	
?>

<div class="form-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h3>Admission form</h3>
				</div>

				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="left-side-form">
										<h5><label for="sname">Student Name</label>
										<span class="error"><?php print $esname; ?></span></h5>
										<p><input type="text" name="sname" value="<?php print $sname; ?>"></p>

										<h5><label for="gname">Guardian Name</label><span class="error">
												<?php print $egname; ?></span></h5>
										<p><input type="text" name="gname" value="<?php print $gname; ?>"></p>

										<h5><label for="contact">contact</label><span class="error">
												<?php print $econtact; ?></span></h5>
										<p><input type="text" name="contact" value="<?php print $contact; ?>"></p>

										<h5><label for="email">email</label><span class="error">
												<?php print $eemail; ?></span></h5>
										<p><input type="text" name="email" value="<?php print $email; ?>"></p>

										<h5><label for="dept">Deptartment</label><span class="error">
												<?php print $edept; ?></span></h5>
										<p><textarea name="dept"><?php print $dept; ?></textarea></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="right-side-form">
										<h5><label for="course">course</label><span class="error">
												<?php print $ecourse; ?></span></h5>
										<p><input type="text" name="course" value="<?php print $course; ?>"></p>

										<h5><label for="year">year</label></h5>
										<p><select name="year" id="">
												<option value="0">Year 1</option>
												<option value="1">Year 2</option>
												<option value="2">Year 3</option>
												<option value="3">Year 4</option>
											</select><span class="error">
												<?php print $eyear; ?></span></p>

										<p><input type="submit" name="submit" value="Submit"></p>
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
