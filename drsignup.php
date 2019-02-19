<?php
   include("config.php");
   session_start();
   $error = "";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $emailErr = "";
      $mblErr = "";
      $passErr = "";
      $flag = 0;

      $newemail = mysqli_real_escape_string($db,$_POST['email']);
      $newpassword = mysqli_real_escape_string($db,$_POST['password']); 
      $newname = mysqli_real_escape_string($db,$_POST['name']);
      $newmobile = mysqli_real_escape_string($db,$_POST['mobile']);
      $newcity = mysqli_real_escape_string($db,$_POST['city']);
      $newspecial = mysqli_real_escape_string($db,$_POST['special']);
      $newservice = mysqli_real_escape_string($db,$_POST['service']);
      $newpref = mysqli_real_escape_string($db,$_POST['pref']);
      $confirmpass = mysqli_real_escape_string($db,$_POST['confirmpass']);
      
      if (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Invalid email format\n"; 
         $flag = 1;
      }
      if (!preg_match('/^[0-9]{10}+$/', $newmobile)) {
         $mblErr = "Invalid Mobile Number\n";
         $flag = 1;
      }
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z.!@#$%]{8,12}$/', $newpassword)) {
         $passErr = "the password does not meet the requirements\n";
         $flag = 1;
      }
      if ($newpassword != $confirmpass){
         $passmatchErr = "Passwords don't match";
         $flag = 1;
      }
      if ($flag == 1) {
         $error = nl2br($emailErr.$mblErr.$passErr.$passmatchErr);
         $flag = 0;
      }else {
         $sql = "SELECT * from doctors where email = '$newemail'";
         $result = mysqli_query($db,$sql);
         $count = mysqli_num_rows($result);
         if ($count == 1) {
            $error = "Email already exists";
         }else {
            $sql1 = "INSERT INTO doctors (name,special,mobile,email,password,service,pref,city) VALUES ('$newname','$newspecial',$newmobile,'$newemail','$newpassword','$newservice','$newpref','$newcity')";
            $result = mysqli_query($db,$sql1);
            header("location: login.php");
         }
         
      }
      
   }
?>
<html>
<head>
   <meta name="viewport" content="width=device-width">
   <meta name="author" content="Aniket, Girish, Jayadeva">
   <title>Signup - DMCHP</title>
   <style>
   body {
  min-width: 720px;
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
  border-radius: 5px;
  border: 2px solid black;
  background-color: #f2f2f2;
  padding: 20px;
  width: 600px;
  margin-left: 23em;
  margin-top: 5em;
  margin-bottom: 5em;
}

.signup{
  color:#120f91;
}

/* Floating column for labels: 25% width */
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

/* Floating column for inputs: 75% width */
.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

#prefix{
  float: left;
  width: 10%;
}

#fname{
  float: left;
  width: 90%;
}


#mobextn{
  float: left;
  width: 12%;
}

#Mobile{
  float: left;
  width: 88%;
}
/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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
      <h1 class="signup">Sign Up</h1>
      <p class="signup">Please fill in this form to create an account.</p>
      <hr>
      <div style = "font-size:1em; color:#cc0000; margin-top:10px"><?php echo $error;?></div>
  <form action="" method = "post">
    <div class="row">
      <div class="col-25">
           <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="prefix" name="prefix" value="Dr.">
        <input type="text" id="fname" name="name" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Specialization</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="special" placeholder="if any">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="lname">Mobile no.</label>
      </div>
      <div class="col-75">
        <input type="text" id="mobextn" name="mobextn" value="+91">
        <input type="text" id="Mobile" name="mobile" placeholder="for example: 9876543210">
      </div>
    </div>

     <div class="row">
      <div class="col-25">
        <label for="email">Email ID</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" placeholder="for example: xyz@gmail.com">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="city">City/Town</label>
      </div>
      <div class="col-75">
        <input type="text" id="city" name="city" placeholder="for example: Bengaluru">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="preference">Prefered Service Activity</label>
      </div>
      <div class="col-75">
        <select id="preference" name="service">
          <option value="ANC Belagavi">ANC - Belagavi</option>
          <option value="ANC Chikkaballapur">ANC - Chikkaballapur</option>
          <option value="ANC Mandya">ANC - Mandya</option>
          <option value="ANC Tumkur">ANC - Tumkur</option>
          <option value="School Hubballi">School - Hubballi</option>
          <option value="School Chikkaballapur">School - Chikkaballapur</option>
        </select>
      </div>
    </div>


    <div class="row">
      <div class="col-25">
        <label for="spclpref">Any Special Preferences</label>
      </div>
      <div class="col-75">
        <textarea id="spclpref" name="pref" placeholder="Example: 3rd Sunday of the month would be prefered for Service Activity" style="height:75px"></textarea>
      </div>
    </div>
    <br>
    <hr>

    <div class="row">
      <div class="col-25">
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label for="password">Confirm Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="confirmpass">
      </div>
    </div>

    <br>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>

</div>
</body>
</html>