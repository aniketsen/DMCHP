<?php
   include("config.php");
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      $loginas = $_POST['loginas'];
      if($loginas == 'Select') {
        $error = "Please Select Doctor or Volunteer";
      }else if($loginas == 'Doctor') {
        $sql = "SELECT * FROM doctors WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $username = $row['name'];
        $count = mysqli_num_rows($result);
        if($count == 1) {
          $_SESSION['login_user'] = $email;
          $_SESSION['login_as'] = $loginas;
         
          header("location: welcome.php");
        }else {
          $error = "Your Email or Password is invalid";
        }
      }else if($loginas == 'Volunteer') {
        $sql = "SELECT * FROM volunteers WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $username = $row['name'];
        $count = mysqli_num_rows($result);
        if($count == 1) {
          $_SESSION['login_user'] = $email;
          $_SESSION['login_as'] = $loginas;
         
          header("location: welcome.php");
        }else {
          $error = "Your Email or Password is invalid";
        }
      }

      
   }
?>
<html>
<head>
   <title>Login - DMCHP</title>
   <meta name="viewport" content="width=device-width">
   <meta name="author" content="Aniket, Girish, Jayadeva">
   <style>
   body {
  min-width: 50em;
  background-image: url(Images/back.png);
  background-attachment: fixed;
  background-size: cover;
  color:#000;
  margin: 0;
}

#heading{
  margin-left: 24em;
  color:#ea1a07;
}
#tagline{
  margin-left: 7em;
  color:#870819;
}

/* Style inputs, select elements and textareas */
input[type=text], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}

input[type=password], select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}
/* Style the label to display next to the inputs */
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}


/* Style the container */
.container {
  border-radius: 0.5em;
  border: 0.1em solid black;
  background-color: #f2f2f2;
  padding: 1.5em;
  width: 35em;
  margin-left: 23em;
  margin-top: 5em;
  margin-bottom: 5em;
}

.login{
  color:#120f91;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 25%;
  margin-top: 1.2em;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 75%;
  margin-top: 1.2em;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
#password{
  font-size:0.75em;
}


/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit], #heading, #tagline {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>
   <div id="heading">
   <h1>Divine Mother and Child Health Programme</h1>
  <h3 id="tagline">A Healthy Mother begets a Healthy Child</h3>
   </div>

   <div class="container">
      <h1 class="login">Login</h1>
      <hr>
      <div style = "font-size:1em; color:#cc0000; margin-top:10px"><?php echo $error;?></div>
  <form action="" method = "post">
    <div class="row">
      <div class="col-25">
           <label for="loginas">Login As:</label>
      </div>
      <div class="col-75">
          <select id="loginas" name="loginas">
            <option value="Select" disabled selected>Select</option>
            <option value="Doctor">Doctor</option>
            <option value="Volunteer">Volunteer</option>
          </select>
      </div>
    </div>

    <div class="row">
      <div class="col-25">
           <label for="email">Email ID</label>
      </div>
      <div class="col-75">
          <input type="text" id="email" name="email" placeholder="Your Registered Email ID">
      </div>
    </div>

 <div class="row">
      <div class="col-25">
           <label for="password">Password</label>
      </div>
      <div class="col-75">
          <input type="password" id="password" name="password">
      </div>
    </div>
<br>
 <div class="row" id="loginbtn">
      <input type="submit" value="Login">
    </div>

   </div>
</form>
</body>
</html>