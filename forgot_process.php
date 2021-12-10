<?php

  require_once("config.php");

  if(isset($_POST['subforgot']))
    { 
     $login=$_REQUEST['login_var'];
     $query = "select * from  signup where (pnumber='$login' OR email = '$login')"; 
     $res = mysqli_query($dbc,$query);
     $result=mysqli_fetch_array($res);

    if($result)
      {
       $findresult = mysqli_query($dbc, "SELECT * FROM signup WHERE (pnumber='$login' OR email = '$login')");

    if($res = mysqli_fetch_array($findresult))
      {
        $oldftemail = $res['email'];  
      }

    $token = bin2hex(random_bytes(50));
    $inresult = mysqli_query($dbc,"insert into pass_reset(email,token) values('$oldftemail','$token')");

    $_SESSION["email_id"]=$oldftemail;
    $_SESSION["email_token"]=$token;

    if($inresult)  
      { 
        header("location:forgot-pass-mail.php");   
      }
    }
    else  
    {
    header("location:forgot-pass.php?err=".$login); 
    }    
  }
?>           