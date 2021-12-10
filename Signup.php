<?php
require_once("config.php");?>


<html>
    <head>
        <title>SignUp</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
         <link rel="stylesheet" type="text/css" href="Style.css">
    
    </head>

    <body>
        <div class="container">

            <div class="row">
                
    <?php
    if(isset($_POST['signup']))
    
    {
        extract($_POST);
        if(strlen($fname)<3)
        {
            $error[]='Please Enter First Name using 3 characters atleast';
        }
        if(strlen($fname)>20){
            $error[]='First Name : Max length 20 Characters Allowed';
        }
        if(!preg_match("/^[A-Za-z _]*[A-Za-z]+[A-Za-z _]*$/", $fname)){
            $error[]='Invalid Entry First Name, Please Enter letters without any Digit or special symbol like 
            (1,2,3,#,$,%,*,!)';
        }

        if(strlen($lname)<3)
        {
            $error[]='Please Enter Last Name using 3 characters atleast';
        }
        if(strlen($lname)>20){
            $error[]='Last Name : Max length 20 Characters Allowed';
        }
        if(!preg_match("/^[A-Za-z _]*[A-Za-z]+[A-Za-z _]*$/", $lname)){
            $error[]='Invalid Entry Last Name, Please Enter letters without any Digit or special symbol like 
            (1,2,3,#,$,%,*,!)';
        }

        if(strlen($pnumber)<10)
        {
            $error[]='Please Enter Phone Number using 10 characters atleast';
        }
        if(strlen($pnumber)>10){
            $error[]='Please Enter Phone Number using 10 characters atmost';
        }
        if(!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $pnumber)){
            $error[]='Invalid Entry for Mobile Number. Enter digits only without any space 
            - Eg - 0123456789 ' ;
        }
        if(strlen($email)>50)
        {
            $error[]='Email Max length 50 Characters allowed';
        }
        if($hfield != $vfield){
            $error[]='Email verifacation Failed.You need to verify again.';
        }
        if($password == ''){
            $error[]='Please Enter the Password';
        }
        if($cpassword == ''){
            $error[]='Please Confirm the password.';
        }
        if($password != $cpassword){
            $error[]='Password do no match';
        }
        if(strlen($password)<5){
            $error[]='The Password should be minimum 5 characters';
        }
        if(strlen($password)>20){
            $error[]='The Password should be maximum 20 characters';
        }
      $sql="select * from signup where (pnumber='$pnumber' or email='$email');";
      $res=mysqli_query($dbc,$sql);
      if(mysqli_num_rows($res) > 0){
           $row = mysqli_fetch_assoc($res);
           
              if($uname==$row['uname']){
                 $error[]='Username already Exists';
                }
                if($email==$row['email']){
             $error[]='Email already Exists';
         }
       }
        if(!isset($error)){
           $date=date('Y-m-d');
        $options = array("cost"=>4);
           $password = password_hash($password,PASSWORD_BCRYPT,$options);
           
           
        $result = mysqli_query($dbc,"INSERT into signup(fname,lname,pnumber,email,password,date) values('$fname','$lname','$pnumber','$email','$password','$date')");   
        
        if($result)
        {
            $done=2;
        }
        else{
            $error[]='Failed : Something went wrong';
        }
           
       }
    }
    ?> 
               
                <div class="col-sm-4">
                <br><br><br><br><br>
                 
                <?php
                  if(isset($error))
                   {
                      foreach($error as $error)
                        {
                          echo '<p class="errmsg">&#x26A0;' .$error.'</p><br><br>';
                        }
                   }
                ?>
               
                
                </div>
                <div class="col-sm-4">
                    
                <?php if(isset($done))
                 { ?>
                 <div class="successmsg"><span style="font-size:100px;">&#9989;</span><br>
                    You have registered successfully .<br>
                    <a href="index.php" style="color:#fff;">Login here...</a></div>
                <?php } else { ?>
                    
                    <div class="signup_form">
                        <h1 class="text-center" style="padding-top:0px; margin-top:0px;">Register Here</h1>
                    <form action="" method="POST" style="margin-top:0px;">
                        <div class="form-group">
                          <label for="fname" class="label_txt">First Name</label>
                          <input type="text" class="form-control" name="fname" id="name" placeholder="First Name" value="<?php if
                          ( isset($error)){ echo $fname; } ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="label_txt">Last Name</label>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php if
                            ( isset($error)){ echo $lname; } ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pnumber" class="label_txt">Phone Number</label>
                            <input type="text" class="form-control" name="pnumber" placeholder="Enter Your Mobile Number" value="<?php if
                            ( isset($error)){ echo $pnumber; } ?>" required>
                        </div>
                          <div class="form-group">
                            <label for="email" class="label_txt">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php if
                            ( isset($error)){ echo $email; } ?>" required>
                          </div>
                          <div class="form-group">
                              <button type="button" onclick="sendmail()" id="ebutton" class="btn btn-primary ">Verify</button>
                          </div>
                          <div>
                              <input type="number" name="vfield" class="form-control" value="<?php if(isset($error)){ echo $vfield; } ?>" required placeholder="Enter verification code">
                          </div><br>
                          <div>
                              <input type="hidden" id="hfield" name="hfield">
                          </div>
                        <div class="form-group">
                          <label for="password" class="label_txt">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="form-group">
                            <label for="cpassword" class="label_txt">Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                          </div>

                        <button type="submit" class="form_btn btn btn-primary" name="signup" >SignUp</button><br>
                        <br>
                        <p>Already have an account? <a href="index.php">Log in</a></p>
                        
                       <?php } ?> 
                      </form>
                      
                      </div>
                </div>
                <div class="col-sm-4">
                </div>
            </div>

        </div>
        
      <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="crossorigin="anonymous"></script>
      <script src="https://smtpjs.com/v3/smtp.js"></script>

      <script>
            function generateOTP() {
          
          // Declare a digits variable 
          // which stores all digits
          var digits = '0123456789';
          let OTP = '';
          for (let i = 0; i < 4; i++ ) {
              OTP += digits[Math.floor(Math.random() * 10)];
          }
          return OTP;
      }
      
 
      function sendmail(){
    
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var subject = "Email Verification ";
    var message = generateOTP();
    
    document.getElementById("hfield").value=message;

    // var body = $('#body').val();

    var Body='Name: '+name+'<br>Email: '+email+'<br>Subject: '+subject+'<br>Verification Code is : '+message;
    //console.log(name, phone, email, message);

    Email.send({
SecureToken:"fbf31702-bb7f-4a4e-9c1c-4ccf17ee777f",
        To: email,
        From: "sender email",
        Subject: "New message on Email Verification "+name,
        Body: Body
    }).then(
        message =>{
            //console.log (message);
            if(message=='OK'){
            alert('OTP for email verification has been sent to your email');
            }
            else{
                console.error (message);
                alert('There is an error while sending message. ');
                
            }

        }
    );

}
        </script>
        
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>