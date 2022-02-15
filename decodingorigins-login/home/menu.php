<?php ?>
		    <li>
                        <p>  </p>
                    </li>
 		<li>
                        <a href="index.php" class="waves-effect"><i class="fa  fa-reorder fa-fw" aria-hidden="true"></i>Choose Project</a>
                    </li>

                      <li>
                        <!--<a href="reset_password.php" class="waves-effect"><i class="fa  fa-gears fa-fw" aria-hidden="true"></i>Reset Password</a>-->
                    </li>
                    <li>
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSe_sATXgvFnLiceu6F_PMKUfxhbKrgosaLjOhszzISn9-Q2Ig/viewform?vc=0&c=0&w=1" target="_blank" class="waves-effect"><i class="fa  fa-edit fa-fw" aria-hidden="true"></i>Feedback</a>
                    </li>

                    <?php



                   if(isset($_SESSION['user_id']) ){


require '../database_login.php';
$records = $conn->prepare('SELECT id,email,password,fname,lname,security FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);



	}
else{
header("Location: ../../index.php");
	}


                     if($results['security']==0){ ?>

                    <li>
                        <!--<a href="access.php" class="waves-effect"><i class="fa  fa-users fa-fw" aria-hidden="true"></i>Add User  </a>-->
                    </li>
                    <?php }?>

  <?php ?>
