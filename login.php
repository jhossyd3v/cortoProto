<?php 
include 'users.php';
//Connects to your Database 
//$conect = mysqli_connect("localhost","root","210591", "simple-php-login") or die(mysql_error()); 
//Checks if there is a login cookie
if(isset($_COOKIE['ID_your_site'])){ //if there is, it logs you in and directes you to the members page
 	$username = $_COOKIE['ID_your_site'];
 	$pass = $_COOKIE['Key_your_site'];
	$usuario = getUser($username,$users);
	//foreach ($users as $key => $value) {		
		if($username == $usuario['user']) {			
			if($pass == $usuario['pass']) {				
				header("Location: members.php");
			} else {
				header("Location: login.php");
			}
		}	
	//}	
 	/*$check = mysqli_query($conect, "SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
 	while($info = mysqli_fetch_array( $check )){
 		if ($pass != $info['password']){}
 		else{
 			header("Location: login.php");
		}
 	}*/
 }
 //if the login form is submitted 
 if (isset($_POST['submit'])) {
	// makes sure they filled it in
 	if(!$_POST['username']){
 		die('You did not fill in a username.');
 	}
 	if(!$_POST['pass']){
 		die('You did not fill in a password.');
 	}
 	// checks it against the database
 	/*if (!get_magic_quotes_gpc()){
 		$_POST['email'] = addslashes($_POST['email']);
 	}*/
 	//$check = mysqli_query($conect, "SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());
 //Gives error if user dosen't exist
 /*$check2 = mysqli_num_rows($check);
 if ($check2 == 0){
	die('That user does not exist in our database.<br /><br />If you think this is wrong <a href="login.php">try again</a>.');
}*/	
	$usuario = getUser($_POST['username'], $users);
	//foreach ($users as $key => $value) {		
		if($_POST['username'] = $usuario['user']) {			
			$_POST['pass'] = stripslashes($_POST['pass']);
 			$usuario['pass'] = stripslashes($usuario['pass']);
			if ($_POST['pass'] != $usuario['pass']){
				die('Incorrect password, please <a href="login.php">try again</a>.');
			}
			else{ // if login is ok then we add a cookie 
				$_POST['username'] = stripslashes($_POST['username']); 
				$hour = time() + 3600; 
				setcookie('ID_your_site', $_POST['username'], $hour); 
				setcookie('Key_your_site', $_POST['pass'], $hour);	 
				//then redirect them to the members area 
				header("Location: members.php"); 
			}
		}
	//}
	//while($info = mysqli_fetch_array( $check )){
	//$_POST['pass'] = stripslashes($_POST['pass']);
 	//$info['password'] = stripslashes($info['password']);
 	//$_POST['pass'] = md5($_POST['pass']);
	//gives error if the password is wrong
 	/*if ($_POST['pass'] != $info['password']){
 		die('Incorrect password, please <a href="login.php">try again</a>.');
 	}
	else{ // if login is ok then we add a cookie 
		$_POST['username'] = stripslashes($_POST['username']); 
		$hour = time() + 3600; 
		setcookie('ID_your_site', $_POST['username'], $hour); 
		setcookie('Key_your_site', $_POST['pass'], $hour);	 
		//then redirect them to the members area 
		header("Location: members.php"); 
	}
}*/
}
else{
// if they are not logged in 
?>
 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post"> 
 <table border="0"> 
 <tr><td colspan=2><h1>Login</h1></td></tr> 
 <tr><td>Username:</td><td> 
 <input type="text" name="username" maxlength="40"> 
 </td></tr> 
 <tr><td>Pass:</td><td> 
 <input type="password" name="pass" maxlength="50"> 
 </td></tr> 
 <tr><td colspan="2" align="right"> 
 <input type="submit" name="submit" value="Login"> 
 </td></tr> 
 </table> 
 </form> 
 <?php 
 }
 function getUser($userToFindOut,$users) {
    foreach ($users as $key => $value) {
        if($value['user'] == $userToFindOut) {
            return $value;
        }
    }
    return 0;
}
 ?> 
