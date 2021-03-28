<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		
		

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <link rel="shortcut icon" type="image/x-icon" href="favico.ico" />
	<title>LOGIN to SIA</title>
    <meta charset="utf-8">
  </head>
<body>

	<style type="text/css">
	
	@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
	*{
 	  margin: 0;
 	  padding: 0;
	  box-sizing: border-box;
	  font-family: 'Poppins', sans-serif;
	}
	 html,body{
	   display: grid;
	   height: 100%;
	   width: 100%;
	   place-items: center;
	   background: #f2f2f2;
	   /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
	 }
	 ::selection{
	   background: #4158d0;
	   color: #fff;
	 }
	 .wrapper{
	   width: 380px;
	   background: #fff;
	   border-radius: 15px;
	   box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
	 }
	 .wrapper .title{
	   font-size: 35px;
	   font-weight: 600;
	   text-align: center;
	   line-height: 100px;
	   color: #fff;
	   user-select: none;
	   border-radius: 15px 15px 0 0;
	   background: linear-gradient(-135deg, #c850c0, #4158d0);
	 }
	 .wrapper form{
	   padding: 10px 30px 50px 30px;
	 }
	 .wrapper form .field{
	   height: 50px;
	   width: 100%;
	   margin-top: 20px;
	   position: relative;
	 }
	 .wrapper form .field input{
	   height: 100%;
	   width: 100%;
	   outline: none;
	   font-size: 17px;
	   padding-left: 20px;
	   border: 1px solid lightgrey;
	   border-radius: 25px;
	   transition: all 0.3s ease;
	 }
	 .wrapper form .field input:focus,
	 form .field input:valid{
	   border-color: #4158d0;
	 }
	 .wrapper form .field label{
	   position: absolute;
	   top: 50%;
	   left: 20px;
	   color: #999999;
	   font-weight: 400;
	   font-size: 17px;
	   pointer-events: none;
	   transform: translateY(-50%);
	   transition: all 0.3s ease;
	 }
	 form .field input:focus ~ label,
	 form .field input:valid ~ label{
	   top: 0%;
	   font-size: 16px;
	   color: #4158d0;
	   background: #fff;
	   transform: translateY(-50%);
	 }
	 form .content{
	   display: flex;
	   width: 100%;
	   height: 50px;
	   font-size: 16px;
	   align-items: center;
	   justify-content: space-around;
	 }
	 form .content .checkbox{
	   display: flex;
	   align-items: center;
	   justify-content: center;
	 }
	 form .content input{
	   width: 15px;
	   height: 15px;
	   background: red;
	 }
	 form .content label{
	   color: #262626;
	   user-select: none;
	   padding-left: 5px;
	 }
	 form .content .pass-link{
	   color: "";
	 }
	 form .field input[type="submit"]{
	   color: #fff;
	   border: none;
	   padding-left: 0;
	   margin-top: -10px;
	   font-size: 20px;
	   font-weight: 500;
	   cursor: pointer;
	   background: linear-gradient(-135deg, #c850c0, #4158d0);
	   transition: all 0.3s ease;
	 }
	 form .field input[type="submit"]:active{
	   transform: scale(0.95);
	 }
	 form .signup-link{
	   color: #262626;
	   margin-top: 20px;
	   text-align: center;
	 }
	 form .pass-link a,
	 form .signup-link a{
	   color: #4158d0;
	   text-decoration: none;
	 }
	 form .pass-link a:hover,
	 form .signup-link a:hover{
	   text-decoration: underline;
	 }
	 
</style>
	 
<div class="wrapper">
	<div class="title">
	Login Form</div>
		<form method="post">
    		<div class="field">
          		<input type="text" name="user_name" required>
          		<label>Username</label>
        	</div>
			<div class="field">
          		<input type="password" name = "password" required>
          		<label>Password</label>
        	</div>
		<div class="content">
          	<div class="checkbox">
            	<input type="checkbox" id="remember-me">
            	<label for="remember-me">Remember me</label>
         	</div>
			<div class="pass-link">
				<a href="#">Forgot password?</a></div>
			</div>
			<div class="field">
    			<input type="submit" value="Login">
			</div>
		<div class="signup-link">
		Not a member? <a href="signup.php">Signup now</a></div>
		</form>
	</div>
</body>
</html>