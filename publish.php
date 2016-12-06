<?php
  
  session_start();
  if(!isset($_SESSION["user_id"]) && !isset($_SESSION["username"]))
    header("Location: ./login.php?redirect=publish");

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
        <h1 id="homeHeading">Publish Your Data</h1>
        <hr>
        <p><?php include_once './include/byte.php'; ?> <small>bytes of data today</small></p>
        <a href="#new_manifest" class="btn btn-primary btn-xl page-scroll">Publish Now</a>
      </div>
    </div>
  </header>

  <form action="" method="post" enctype="multipart/form-data" id="new_manifest">
    <section class="no-padding" style="margin:20px auto" id="header">
      <div class="container">
        <div class="panel panel-info">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <input class="form-control input-lg" name="title" type="text" placeholder="Enter a Descriptive Title" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <input class="form-control" name="comment" type="text" placeholder="Include a brief data overview for the subtitle" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <input class="form-control" name="standards" type="text" placeholder="Standard version of the manifest" autocomplete="off" required>
                </div>              
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <h3>By <small><?=$_SESSION['username'] ?></small></h3>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /container -->
    </section>


    <section class="no-padding" style="margin:20px auto" id="upload">
      <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Upload Files</strong></div>
          <div class="panel-body">
            <!-- Standar Form -->
            <h4>Select files from your local machine</h4>
            <div class="form-inline">
              <button class="btn btn-sm btn-primary" id="add_file">Add file</button>
            </div>
            <!-- Upload Finished -->
            <div class="js-upload-finished">
              <h3>Processed files</h3>
              <div class="list-group" id="processed_files">
              <!--            
                <div style="display:none;" id="input_files">
                </div>
              -->
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /container -->
    </section>
    <hr>

    <section class="no-padding">
      <center>
        <button type="submit" class="btn btn-info btn-lg" style="margin:20px auto;">Publish Dataset</button>
      </center>
    </section>
  </form>

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
    var count = 0;
    $(document).ready(function() {
      $("#add_file").click(function(event) {
        event.preventDefault();
        // var $clone = $("#new_file").clone();
        // $clone.removeAttr('id');
        // $("#input_files").append($clone);
        // $("#processed_files").append('<p class="list-group-item list-group-item-success">\
        //     <span class="badge alert-success pull-right">Success</span> '+$clone.val()+'\
        //   </p>');
        // $("#new_file").val("");
        $("#processed_files").append('<div class="form-group form-inline">\
                <input type="file" name="file'+count+'">\
              </div>');
        count++;
      });

      $("#new_manifest").submit(function(event) {
        event.preventDefault();
        $("#new_manifest button").prop('disabled', true);

        var formData = new FormData($(this)[0]);

        $.ajax({
          url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/insertManifest.php",
          //url: "http://localhost/OCDXGroupProject/services/insertManifest.php",
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function (res) {
            if(res.success == false)
              {
              alert("Fail "+res.msg);
              $("#new_manifest button").prop('disabled', false);
              }
            else
              {
              //alert("Success new manifest Id is "+res.manifestId);
              window.location = "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/view.php?id="+res.manifestId;
              }
          }
        });

      });
    });
  </script>

</body>

</html>
