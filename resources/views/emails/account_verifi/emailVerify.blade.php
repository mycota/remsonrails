

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Quotation System (Remson Rail System INC)</title>
    <link rel="icon" type="image/jpg" href="{{ asset('http://localhost/remsonrails/public/images/Rem_Icon.png') }}">

    

  </head>
  <body>

<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        
                    </nav>
            
            <ul class="breadcrumb" style="background-color: #ADD8E6">
            <a href="http://remsonrail.com"><img src="http://localhost/remsonrails/public/images/LOGO_REM.png"></a>
            </ul>
              
                    

            <div class="card-body" style="border: 1px solid gray; box-shadow: 0px 0px 0px gray;">
            
                    <fieldset style="width: px;">

                  <div class="content-section" style="background-color: ; font-size: 18px;">
                    
                      
                        <div class="jumbotron">
  <h3 >Well done, email is verified</h3>
  <hr>
  <p style="color: red;">Important information....</p>
  <ul>
    <li><p class="lead">Your data is kept safe by Remson</p></li>
    <li><p class="lead">The system is designed to ensure strong password is used.</p></li>
    <li><p class="lead">All your actions will be recorded, so do not try to alter the ULR or do anything to break the system.</p></li>
    <li><p class="lead">If any error happen please inform the Admin about it</p></li>
    <li><p class="lead">Do not shared your password with anyone</p></li>
    <li><p class="lead">Do logout if you no longer need to use the system</p></li>
    <li><p class="lead">Avoid accessing the system from computers you do not trust</p></li>

  </ul>
  <p style="color: blue;">Thank you ...</p>

  <hr class="my-4">
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="{{ route('createpassword.show', ['email' => $email] ) }}" role="button">Create Password</a>

  </p>

</div>
                        
                  </div>
              </fieldset>
            </div>

                
                
                <!-- <small style="color: red;">The email is from Remsonrail Quotation System</small> -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
  </body>
</html>