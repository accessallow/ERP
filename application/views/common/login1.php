
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Expense Monitor</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>assets/bootstrap3/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/mystyles/signin.css" rel="stylesheet">

        <style>
            body{
                background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAJCAYAAADgkQYQAAAAG0lEQVQYV2M0rtr+/2ybJyMDHoBXEqZvVBEDACulBArYVVYrAAAAAElFTkSuQmCC) repeat;
                /*background: rgb(0,0,0);*/
                height: 667px;
                -webkit-box-shadow: inset -5px 5px 132px 11px rgba(0,0,0,0.75);
                -moz-box-shadow: inset -5px 5px 132px 11px rgba(0,0,0,0.75);
                box-shadow: inset -5px 5px 132px 11px rgba(0,0,0,0.75);
            }

            .form-signin{
                border: solid 1px rgba(183,222,237,1);
                border-radius: 1em;

                -webkit-box-shadow: 10px 10px 59px 0px rgba(0,0,0,0.75);
                -moz-box-shadow: 10px 10px 59px 0px rgba(0,0,0,0.75);
                box-shadow: 10px 10px 59px 0px rgba(0,0,0,0.75);

                background: rgba(183,222,237,1);
                background: -moz-linear-gradient(top, rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%);
                background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(183,222,237,1)), color-stop(50%, rgba(113,206,239,1)), color-stop(51%, rgba(33,180,226,1)), color-stop(100%, rgba(183,222,237,1)));
                background: -webkit-linear-gradient(top, rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%);
                background: -o-linear-gradient(top, rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%);
                background: -ms-linear-gradient(top, rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%);
                background: linear-gradient(to bottom, rgba(183,222,237,1) 0%, rgba(113,206,239,1) 50%, rgba(33,180,226,1) 51%, rgba(183,222,237,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b7deed', endColorstr='#b7deed', GradientType=0 );
            }

        </style>
    </head>

    <body>

        <div class="container" >
            <div class="row" style="height: 6em;">

            </div>

            <form class="form-signin" action="login" method="post">
                <center>
                    <h3 class="form-signin-heading" style="">JAT Login</h3>
                    <p style="color: white; background: rgb(62, 114, 132); padding: 2px; border-radius: 3px;">Username <b>demo</b> Password :  <b>12345</b></p>
                    <label for="inputEmail" class="sr-only">Username</label>
                    <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
                    <div style="height: 5px;"></div>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" style="width:40%;border-radius: 15px;background: rgb(62, 114, 132);">Login</button>
                </center>
            </form>

        </div> <!-- /container -->



    </body>
</html>
