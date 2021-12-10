<html>
    <head>
        <title>Login</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
         <link rel="stylesheet" type="text/css" href="Style.css">
    </head>

    <body onload="getLocation()">
        
        <div class="container">
            
            <div class="row">
                
                <div class="col-sm-4">
                </div>
                
                <div class="col-sm-4">
                    
                    <div class="login_form">
                        
                        <h1 class="text-center" style="margin-top: 0px; color: cornflowerblue;">Welcome</h1>
                        
                        <?php
                        
                          if(isset($_GET['loginerror']))
                          {
                            $loginerror=$_GET['loginerror'];
                          }
                          
                          if(!empty($loginerror))
                          {
                            echo '<p class="errmsg">Invalid login credentials,Please Try Again ..</p>';
                          }
                        ?>
                        
                    <form action="logindata.php" method="POST">
                        
                        <div class="form-group">
                            
                          <label for="email" class="label_txt">Mobile Number or Email</label>
                          
                          <input type="text" class="form-control" name="login_var"
                          value="<?php 
                          if(!empty($loginerror))
                            { 
                              echo $loginerror;
                            } 
                                 ?>" placeholder="Enter Mobile Number or Email">
                                  
                        </div>
                        
                        
                        <div class="form-group">
                            
                          <label for="password" class="label_txt">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Enter Password">
                        </div>
                        
                        
                        <div>
                          <input type="hidden" name="latitude" id="lat">
                          <input type="hidden" name="longitude" id="lon">
                        </div>

                        <button type="submit" name="login" class="form_btn btn btn-primary">Login</button>
                        
                    </form>
                      
                      <p style="font-size: 12px; text-align: center; margin-top: 10px;">
                          
                        <a href="forgot-pass.php" style="color: #00376b;">Forgot Password</a>
                        
                      </p>
                      
                      <br>
                      
                      <p>Don't have an account? <a href="Signup.php">Sign up</a></p>

                    </div>
                </div>
                
                
                <div class="col-sm-4">
                </div>

            </div>

        </div>

        <script>
            var x=document.getElementById("lat");
            var y=document.getElementById("lon");

          function getLocation()
            {
              if(navigator.geolocation)
                {
                  navigator.geolocation.getCurrentPosition(showPosition);
                }
              
              else
              {
                  x.innerHTML="Geolocation is not supported by this browser.";
              }
            }
          
          function showPosition(position)
            {
                document.getElementById("lat").value = position.coords.latitude ;
                document.getElementById("lon").value = position.coords.longitude;
            }
        </script>
    </body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>