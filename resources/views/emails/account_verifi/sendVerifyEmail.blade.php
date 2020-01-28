

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    

  </head>
  <body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; background-color: #f8fafc; color: #74787e; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">

    <style>
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>



<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-12">

            <div class="card" >
                <div class="card-header" style="background-color: ;">
                    <nav class="navbar navbar-expand-lg navbar-dark " style="font-size: 16px;">
                        
                    </nav>
            
            <ul class="breadcrumb">
            <a href="http://remsonrail.com"><img src="http://localhost/remsonrails/public/images/LOGO_REM.png"></a>
            </ul>
              
                    

            <div class="card-body" style="border: 1px solid gray; box-shadow: 0px 0px 0px gray;">
            
                    <fieldset style="width: px;">
                    <center><legend><h2>Verify Email</h2></legend></center>

                  <div class="content-section" style="background-color: ; font-size: 18px;">
                    
                      
                        <h3 class="display-">Hello, {{ $user->name }}!</h3><hr>
                          <p></p>
                          <p>To activate your account, you need to verify your email first.</p>
                          <p>
                            <center><p> <h2> <a href="{{ route('emails.account_verifi.emailverifybyuser', ['email' => $user->email, 'verifyToken' => $user->verifyToken]) }}"><input style="background-color: green; border: 1px solid gray; box-shadow: 18px 12px 8px gray;" type="button" value="Verify email"></a></h2></p></center>
                          </p>
                        
                  </div>
              </fieldset>
            </div>

                
                
                <small style="color: red;">The email is from Remsonrail Quotation System</small>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
  </body>
</html>