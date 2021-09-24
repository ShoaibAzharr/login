<html>
	<head>
		<link rel="icon" href="download.jpg" type="image/x-icon">
		
		<title>
			WP Brigade Phase 1 Test
		</title>
		
		<link rel="stylesheet" href="\Phase1-test\style.css">
		
	</head>

<!--PHP script start -->
<?php

	//definition of value variables
		$name         = NULL;
		$email        = NULL;
		$number       = NULL;
		$lname        = NULL;
		$address      = NULL;
		$password     = NULL;
		$cpassword    = NULL;
		$gender       = NULL;

	//definition of error variables
		$nameerr      = NULL;
		$emailerr     = NULL;
		$numbererr    = NULL;
		$lnameerr     = NULL;
		$addresserr   = NULL;
		$passworderr  = NULL;
		$cpassworderr = NULL;
		$gendererr    = NULL;
		$termserr     = NULL;

	//bool variable to check if error exist
		$error		  = false;


	//if the form is submitted 
	if( isset( $_POST['formsubmit'] ) )
	{
		
		//Sanitization of user data
			$name      = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
			$lname     = filter_var( $_POST['lname'], FILTER_SANITIZE_STRING );
			$email	   = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
			$number    = filter_var( $_POST['number'], FILTER_SANITIZE_NUMBER_INT );
			$address   = filter_var( $_POST['address'], FILTER_SANITIZE_STRING );
			$password  = filter_var( $_POST['password'], FILTER_SANITIZE_STRING );
			$cpassword = filter_var( $_POST['cpassword'], FILTER_SANITIZE_STRING );

		if( isset( $_POST['gender'] ) )
		{
			$gender    = filter_var( $_POST['gender'], FILTER_SANITIZE_STRING );
		}
		
		//validation of form data

		//first name
		if ( empty( $name ) ){

			$nameerr= "Enter name first";
			$error = true;

		}
		
		elseif ( !preg_match( "/^[a-zA-Z-' ]*$/", $name ) ) {

			$nameerr = "Only letters and white space allowed";
			$error = true;

		}
		elseif ( 20 < strlen( $name )  || 2 > strlen( $name ) ){
		
			$nameerr = "First name must be between 2 to 20";
			$error = true;

		}

		//last name
		if ( empty( $lname ) ){
		
			$lnameerr = "Enter last name";
			$error = true;

		}
		elseif ( !preg_match( "/^[a-zA-Z-' ]*$/", $lname ) ) {
			
			$lnameerr = "Only letters and white space allowed in last name";
			$error = true;

		}
		elseif ( 20 < strlen( $lname )  || 2 > strlen( $lname ) ){
		
			$lnameerr = "Last name must be between 2 to 20";
			$error = true;

		}


		//gender
		
		if( empty( $gender ) ){
			
			$gendererr = "Please Select Gender";
			$error = true;
		
		}
		elseif ( "Male" !== $gender && "Female" !== $gender  ){
			
			$gendererr = "Please Select a valid gender!";
			$error = true;

		}
		
		
		
		//email
		if ( empty( $email ) ){
			
			$emailerr = "Please Enter The Email";
			$error = true;
			
		}
		elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		
			$emailerr = "Email is not valid!";
			$error = true;

		}
		elseif ( 20 < strlen( $email ) || 2 > strlen( $email ) ){
			
			$emailerr = "Email must be between 2 to 20";
			$error = true;

		}
		
		
		//number
		if ( empty( $number ) ){
		
			$numbererr = "please enter the number!";
			$error = true;

		}
		elseif ( !preg_match( "/^[0][0-9]/", $number) ){
			
			$numbererr = "Number is not valid";
			$error = true;

		}
		elseif ( 7 !== strlen( $number ) ){
			
			$numbererr = "Phone number must contains 7 numbers" ;
			$error = true;

		}
		

		//address
		if ( empty( $address ) ){
			
			$addresserr = "please enter the address!" ;
			$error = true;

		}
		elseif ( 50 < strlen( $address ) || 10 > strlen( $address ) ){
		
			$addresserr = "Address must be between 10 to 50";
			$error = true;

		}


		//password & confirm password
		if ( empty( $password ) ){
			
			$passworderr =  "please enter the password!";
			$error = true;

		}
		else{

			if ( 20 < strlen( $password ) || 6 > strlen( $password ) ){
				
				$passworderr = "Password must be between 6 to 20" ;
				$error = true;

			}
			elseif ( empty( $cpassword ) ){
				
				$cpassworderr = "please enter the confirm password!" ;
				$error = true;

			}
			elseif ( $password !== $cpassword ){
				
				$cpassworderr = "Password not matched!" ;
				$error = true;

			}
			
		}
		
		//terms
		if ( !isset( $_POST['terms'] ) ){
			
			$termserr = "please accept the terms & conditions!";
			$error = true;
			
		}

		//validation end

		//if there is no error
		if( !$error ){
		
			echo "<h1>Your form is submitted $name! </h1>";
			unset( $_POST['submit']);
		
		}
		else{

			echo "<h1>Please Check All Input Fields </h1>";
			unset( $_POST['submit']);
			
		}
	}
?>
<!--PHP script ended -->

	<body>
		<form action="" method="POST">
			<!--Hidden input to check form submitted -->

			<input type="hidden" name="formsubmit">
			
			<!--First Name -->
		
			<label for="name" id="label">
				First Name
			</label>	
			<span>
				*
			</span>
			
			<?php echo "<span>" .$nameerr. "</span>" ?>
			<br>
			<input type="text" id="text" name="name" value="<?php echo $name;?>">

			<!--Last name -->
			
			<br>
			<label for="lname" id="label">
				Last Name
			</label>	
			<span>
				*
			</span>
			<?php echo "<span>" .$lnameerr. "</span>"?>
			<br>
			<input type="text" id="text" name="lname" value="<?php echo $lname;?>">

			<!--Gender -->
			
			<br>
			<label for="gender">
				Gender
			</label> 
			<span>
				*
			</span>
			<?php echo "<span>" .$gendererr. "</span>"?>
			<br>
			<input type="radio" name="gender" id="male" value="Male"
				<?php 
					if( 'Male' === $gender ){

						echo "checked";

					}
				?>
			>
			<label for="male">
				Male
			</label>
			<input type="radio" name="gender" id="female" value="Female"
				<?php 
					if( 'Female' === $gender ){

						echo "checked";
						
					}
				?>
			>
			<label for="female">
				Female
			</label>
			
			
			<!--Email -->
		
			<br>
			<label for="email">
				Email
			</label> 
			<span>
				*
			</span>
			<?php echo "<span>" .$emailerr. "</span>"?>
			<br>
			<input type="text" id="text" name="email" value="<?php echo $email;?>">
			
			<!--Number -->
			
			<br>
			<label for="number">
				Ph No.
			</label>
			<span>
				*
			</span>
			<?php echo "<span>" .$numbererr. "</span>"?>
			<br>
			<input type="text"id="text" name="number" value="<?php echo $number; ?>">
			
			
			<!--Address -->
			
			<br>
			<label for="address">
				Address
			</label>
			<span>
				*
			</span>
			<?php echo "<span>" .$addresserr. "</span>"?>
			<br>
			<input type="text"id="text" name="address" value="<?php echo $address; ?>">
			
			
			<!--Password -->
			
			<br>
			<label for="password">
				Password
			</label>
			<span>
				*
			</span>
			<?php echo "<span>" .$passworderr. "</span>"?>
			
			<br>
			<input type="password"id="text" name="password" >
			
			
			<!--Confirm Password -->
			
			<br>
			<label for="cpassword">
				Confirm Password
			</label>
			<span>
				*
			</span>
			<?php echo "<span>" .$cpassworderr. "</span>"?>
			<br>
			<input type="password"id="text" name="cpassword" >
			<br>

			<!-- Terms-->
			
			<br>
			<input type="checkbox" id="terms" name="terms">
			<label for="terms">
				I accept terms & conditions
			</label>
			<span>
				*
			</span>
			<?php echo "<span>" .$termserr. "</span>"?>
			<br>
			
			<!--Submit Button -->
			
			<button type="submit">
				Submit
			</button>
	
		</form>
	</body>
</html>