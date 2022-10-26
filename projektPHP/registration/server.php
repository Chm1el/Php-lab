<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();
$min=0;
$max=1200;
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'sklep');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $imie = mysqli_real_escape_string($db, $_POST['imie']);
  $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
  $miasto = mysqli_real_escape_string($db, $_POST['miasto']);
  $kod = mysqli_real_escape_string($db, $_POST['kod']);
  $ulica = mysqli_real_escape_string($db, $_POST['ulica']);
  $tel = mysqli_real_escape_string($db, $_POST['tel']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($imie)) { array_push($errors, "name is required"); }
  if (empty($nazwisko)) { array_push($errors, "surname is required"); }
    if (empty($miasto)) { array_push($errors, "City is required"); }
    if ( !preg_match('/^[0-9]{2}-?[0-9]{3}$/Du',$kod) ){ array_push($errors,"Wprowadzono błędny kod pocztowy");}
    if (empty($ulica)) { array_push($errors, "Street is required"); }
    if (empty($tel)) { array_push($errors, "Number is required"); }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM klient WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
  	$query2 = "INSERT INTO adresy (miasto, kod_pocztowy, ulica, telefon) VALUES('$miasto', '$kod', '$ulica','$tel')";
  	$es=mysqli_query($db, $query2);
  	if($es==1)
  	{
  	    $sel="SELECT Id_adresu FROM adresy WHERE telefon='$tel'";
  	    $result = mysqli_query($db, $sel);
  	    $row=mysqli_fetch_row($result);
  	    $adres_id=$row[0];
  	    $insert="INSERT INTO klient (Id_adresu,username, email,passcode,imie,nazwisko)
                  			  VALUES('$adres_id','$username', '$email', '$password','$imie','$nazwisko')";
  	    $query=mysqli_query($db, $insert);
  	    if($query==1)
  	    {
  	        $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
  	    }
  	}
  }
}
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password_login']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password=md5($password);
  	echo "username=$username password=$password";
  	$query ="SELECT * FROM klient WHERE username='$username' AND passcode='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>