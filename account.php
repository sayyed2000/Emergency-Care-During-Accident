<?php

  require_once("config.php");
  
  if(!isset($_SESSION["login_sess"]))
  {
      header("location:Login.php");
  }
  
   $email=$_SESSION["login_email"];

   $lat = $_SESSION["lat"];
   $lon = $_SESSION["lon"];
   
   $lat = 19.7514798;
   $lon = 75.7138884;
       
   $findresult = mysqli_query($dbc,"SELECT * FROM signup WHERE email='$email' ");
   if($res = mysqli_fetch_array($findresult))
   {
       $_SESSION["pnumber"] = $res['pnumber'];
       $_SESSION["fname"]   = $res['fname'];
       $_SESSION["lname"]   = $res['lname'];
   }

      $hos = mysqli_query($dbc,"SELECT * , (6371 * acos(cos(radians($lat)) * 
           cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) +
           sin(radians($lat)) * sin(radians(latitude )))) AS distance 
           FROM hospitals HAVING distance < 5000 ORDER BY distance LIMIT 0, 1 ") ;
           
           if($hinfo = mysqli_fetch_array($hos))
              {
                  $id   = $hinfo['id'];
                  $name = $hinfo['name'];
                  $add  = $hinfo['address'];
                  $pno  = $hinfo['pnumber'];
                  $_SESSION["hospital_mail"] = $hinfo['email'];
              }

            else
            {
                $name = "Sorry We are unable to find nearest hospital from you";
                $add  = "Sorry no data available for this location";
                $pno  = "Sorry no data available for this location";
                $_SESSION["hospital_mail"] = "";
            }  
              
      $pol = mysqli_query($dbc,"SELECT * , (3959 * acos(cos(radians($lat)) * 
           cos(radians(lat)) * cos(radians(lon) - radians($lon)) + 
           sin(radians($lat)) * sin(radians(lat )))) AS distance
           FROM police HAVING distance < 28 ORDER BY distance LIMIT 0, 1 ") ;
                
                if($pinfo = mysqli_fetch_array($pol))
                   {
                       $id    = $pinfo['id'];
                       $pname = $pinfo['psname'];
                       $pnumber = $pinfo['psnumber'];
                       $_SESSION["police_mail"] = $pinfo['email'];
                   }
                else

                {
                    $pname = "Sorry no data available for this location";
                    $pnumber = "Sorry no data available for this location";
                    $_SESSION["police_mail"] = "";
                }   
    
      $fire = mysqli_query($dbc,"SELECT * , (3959 * acos(cos(radians($lat)) * 
            cos(radians(fblat)) * cos(radians(fblon) - radians($lon)) + 
            sin(radians($lat)) * sin(radians(fblat ))))AS distance
            FROM firebrigade HAVING distance < 28 ORDER BY distance LIMIT 0, 1 ") ;
                   
                if($finfo = mysqli_fetch_array($fire))
                   {
                     $id     = $finfo['id'];
                     $fbname = $finfo['fbname'];
                     $fbnumber = $finfo['fbnumber'];
                     $_SESSION["firebrigade_mail"] = $finfo['email'];
                   }

                else
                {
                    $fbname = "Sorry no data available for this location";
                    $fbnumber = "No data available for this location";
                    $_SESSION["firebrigade_mail"] = "";
                }   
                   
   $chkbox = $_POST['option'];
   $i = 0;
   $selectedbox = [];
   While($i < count($chkbox))
    {
       $selectedbox[] = $chkbox[$i];
       $i++;
    }
   
    if(count($selectedbox)==1)
       {
          header("location:help.php?error=1");
       }
       
       if (count($selectedbox)==4)
        {
            header("location:help-mail.php");
        }  
       
       if (count($selectedbox)==2)
       {
           if(in_array("Hospital", $selectedbox ,TRUE))
           {
              $_SESSION["firebrigade_mail"] = "";
              $_SESSION["police_mail"] = "";
              
              
              header("location:help-mail.php");
           }
           elseif(in_array("Police", $selectedbox , TRUE))
           {
              $_SESSION["firebrigade_mail"] = "";
              $_SESSION["hospital_mail"] = "";
              
              
              header("location:help-mail.php");
           }
           
           else
           {
             $_SESSION["police_mail="] = "";
             $_SESSION["hospital_mail"] = "";
             
             header("location:help-mail.php");
           }   
       }
       
       if(count($selectedbox)==3)
       {
           if(in_array("Hospital", $selectedbox , TRUE) && in_array("Police", $selectedbox , TRUE))
           {
               $_SESSION["firebrigade_mail"] = "";
               
               
               header("location:help-mail.php");
           }
           elseif(in_array("Hospital", $selectedbox , TRUE) && in_array("Firebrigade", $selectedbox , TRUE))
           {
               $_SESSION["police_mail"] = "";
               
               header("location:help-mail.php");
           }
           
           else
           {
               $_SESSION["hospital_mail"] = "";
               
               header("location:help-mail.php");
           }
       }
    
   ?>

   <html>
     <head>
       <title>My Account - </title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
       <link rel="stylesheet" type="text/css" href="Style.css">
     </head>
     <body>
        <div class="container">
             <div class="row">
                 <div class="col-sm-3">
                 </div>
                 <div class="col-sm-6">
                     <div class="login_form" style="margin-top:5%">
                     <p><a href="logout.php"><span style="color:red; float: right;">Logout</span></a></p>
                       <p><h1>Welcome!<span style="color:#33CC00"> <?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?> </span></h1></p>
                       <table class="table">
                             <tr>
                                <th>Name</th>
                                <td>
                                    <?php
                                       echo $_SESSION["fname"]." ".$_SESSION["lname"];
                                    ?>
                                </td>
                             </tr>
                             <tr>
                                <th>Mobile Number</th>
                                <td>
                                    <?php
                                       echo $_SESSION["pnumber"]; 
                                    ?>
                                </td>
                             </tr>
                             
                             <tr>
                                 <th>Preference</th>
                                 <td>
                                     <?php
                                        echo $_SESSION["pref"];
                                     ?>
                                 </td>
                             </tr>
                             
                            <tr>
                                 <th>Nearest Hospital Name</th>
                                 <td>
                                    <?php
                                        echo $name;
                                    ?>        
                                 </td>
                             </tr>
                             
                             <tr>
                                 <th>Hospital Address<br>Hospital Ph No</th>
                                 <td>
                                    <?php
                                        echo $add."<br>";
                                        echo $pno;
                                    ?>        
                                 </td>
                             </tr>
                             
                             <tr>
                                 <th>Police Station Name<br>Police Ph No</th>
                                 <td>
                                     <?php
                                        echo $pname."<br>";
                                        echo $pnumber;
                                     ?>
                                 </td>
                             </tr>
                             
                             <tr>
                                 <th>Firebrigade Name<br>Firebrigade Ph No</th>
                                 <td>
                                     <?php
                                        echo $fbname."<br>";
                                        echo $fbnumber."<br>";
                                     ?>
                                 </td>
                             </tr>
                             
                             <tr>
                                 <th>Message Status</th>
                                 <td>
                                     <?php 
                                        if(isset($_GET['sent'])){
                                            echo "Sent Successful to ".$_SESSION["pref"];
                                        }
                                        if(isset($_GET['servererr']))
                                        {
                                            echo "Failed To Sent Message";
                                        }
                                     ?>
                                 </td>
                             </tr>
                       </table>
                     </div> 
                    <div class="col-sm-3">
                    </div> 
                 </div>
             </div>
        </div>    
     </body>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </html>       
     