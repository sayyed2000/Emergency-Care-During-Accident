<html>
    <head>
        <title>Help</title>

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
                    <form action="account.php" method="POST" class="signup_form">
                        <div class="form-group">
                            <h3 style="text-align: center;">Emergency Services</h3>
                        </div>
                           
                        <div class="form-check" style="margin-top: 5%;">
                            <div><label class="label_txt">Choose Which Service/Services You Want to get as soon as possible...</label></div>
                            <?php
                               if(isset($_GET['error']))
                               {
                                   echo '<p class="errmsg">Please Select atleast one service ...</p>';
                               }
                            ?>
                            <input type="checkbox" name="option[]" value="Hospital" checked>
                            <label>
                              Hospital
                            </label>
                            <input type="checkbox" name="option[]" value="Police">
                            <label>
                              Police
                            </label>
                            <input type="checkbox" name="option[]" value="Firebrigade">
                            <label>
                              Firebrigade
                            </label>
                            <input type="hidden" name="option[]" value="hidden" checked>
                          </div>

                        <button type="submit" name="submit" style="margin-bottom: 5%; margin-top: 5%;" class="form_btn btn btn-primary">Submit</button>
                        
                         
                      </form>

                </div>

                <div class="col-sm-3">

                </div>
            </div>
        </div>
    </body>
</html>