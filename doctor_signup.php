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
      
      if (!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Invalid email format\n"; 
         $flag = 1;
      }
      if (!preg_match('/^[0-9]{10}+$/', $newmobile)) {
         $mblErr = "Invalid Mobile Number\n";
         $flag = 1;
      }
      if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z.!@#$%]{8,12}$/', $newpassword)) {
         $passErr = "the password does not meet the requirements";
         $flag = 1;
      }
      if ($flag == 1) {
         $error = nl2br($emailErr.$mblErr.$passErr);
         $flag = 0;
      }else {
         $sql = "SELECT * from details where email = '$newemail'";
         $result = mysqli_query($db,$sql);
         $count = mysqli_num_rows($result);
         if ($count == 1) {
            echo "Email already exists";
         }else {
            $sql1 = "INSERT INTO details (name,mobile,email,password) VALUES ('$newname',$newmobile,'$newemail','$newpassword')";
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
   <link href="Signup.css" type="text/css" rel="stylesheet">
   <title>Signup - DMCHP</title>
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
  <form action="action_page.php">
    <div class="row">
      <div class="col-25">
           <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="prefix" name="prefix" value="Dr.">
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
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
        <label for="password">Password</label>
      </div>
      <div class="col-75">
        <input type="password" id="password" name="password">
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
        <select id="preference" name="preference">
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
        <textarea id="spclpref" name="spclpref" placeholder="Example: 3rd Sunday of the month would be prefered for Service Activity" style="height:75px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
</body>
</html>