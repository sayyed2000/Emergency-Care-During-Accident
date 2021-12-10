<?php

   require_once("config.php");
   
   if(isset($_POST['login']))
   {
       $login=$_POST['login_var'];
       $password=$_POST['password'];

       $latitude=$_POST['latitude'];
       $longitude=$_POST['longitude'];

       $query="select * from signup where (pnumber='$login' or email='$login')";
       $res=mysqli_query($dbc,$query);
       $numRows=mysqli_num_rows($res);
       
       if($numRows==1)
       {
           $row = mysqli_fetch_assoc($res);
           if(password_verify($password,$row['password']))
           {
               $_SESSION["login_sess"]="1";
               $_SESSION["login_email"]=$row['email'];
               
               $_SESSION["lat"]=$latitude;
               $_SESSION["lon"]=$longitude;

            header("location:help.php");   
           }
           else
           {
               header("location:index.php?loginerror=".$login);
           }
        }
        else
           {
             header("location:index.php?loginerror=".$login);
           }
   } 

?>