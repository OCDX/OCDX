<?php
  
  session_start();
  if(isset($_SESSION["user_id"]) || isset($_SESSION["username"]))
    header("Location: ./index.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="group1">

  <title>OCSX - Group1</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS -->
  <link href="css/creative.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css" >

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body id="page-top">

  <?php include_once './include/header.php'; ?>

  <header>
    <div class="header-content">
      <div class="header-content-inner">
        <h1 id="homeHeading">LOGIN</h1>
        <hr>
        <p>1,751,009,072 <small>bytes of data today</small></p>
      </div>
    </div>
  </header>

  <section class="no-padding" style="margin:50px auto" id="register">
    <div class="container">

      <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
          <div id="alert">
          </div>          
          <form method="post" role="form" id="login_form">
            <fieldset>
              <h2>Please Login</h2>
              <hr class="colorgraph">
              <div class="form-group">
                <input type="text" name="username" class="form-control input-lg" placeholder="Username" required>
              </div>
              <div class="form-group">
                <input type="password" name="password"= class="form-control input-lg" placeholder="Password" required>
              </div>
              <hr class="colorgraph">
              <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <input type="submit" value="Login" onclick="javascript:void(0);" id="submitbutton" class="btn btn-success btn-block btn-lg" tabindex="3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                  <a href="./register.php" class="btn btn-lg btn-primary btn-block">Register</a>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include_once './include/footer.php'; ?>

  <!-- jQuery -->
  <script src="vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Theme JavaScript -->
  <script src="js/creative.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#login_form").submit(function(event) {
        var $form = $(this);
        event.preventDefault();

        $('#alert').html('<div class="alert alert-info">Submitting..</div>'); 
        $("#submitbutton").prop('disabled', true);
        $.ajax({
          type: "POST",
          url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/getUser.php",
          //url: "http://localhost/OCDXGroupProject/services/getUser.php",
          dataType: 'json',
          data: $form.serializeArray(),
          success: function(response)
            {
            if(response.success)
              {
              $('#alert').html('<div class="alert alert-success"><span class="fa fa-success"></span>'+response.msg+'</div>');
              <?php
                if(isset($_GET['redirect']))
                  $url = 'http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/'.$_GET["redirect"].'.php';
                else
                  $url = 'http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/index.php';
              ?>
              window.location.href = "<?=$url ?>";
              }
            else
              {
              $("#submitbutton").prop('disabled', false);
              $('#alert').html('<div class="alert alert-danger"><span class="fa fa-warning"></span> '+response.msg+'</div>');
              }
            
            }
          });
        
      });
    });    
  </script>  

</body>

</html>
