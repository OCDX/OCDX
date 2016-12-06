<?php session_start(); ?>
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
  <link href="summernote/summernote.css" rel="stylesheet" type="text/css" >

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body id="page-top">

  <?php include_once './include/header.php'; ?>

  <header style="color:#444;">
    <div class="header-content">
      <div class="container">
        <div class="row">
          <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
            <div class="well profile">
              <div class="col-md-12" id="loading">
                <h3>Loading data... Please wait.</h3>
                <div class="progress progress-striped active page-progress-bar">
                  <div class="progress-bar" style="width: 100%;"></div>
                </div>
              </div>
              <div class="content" style="display:none">
                <div class="col-md-12">
                  <h3>
                    <span id="title"></span><br>
                    <small id="comment"></small>
                  </h3>
                  <br>
                  <p>
                    <strong>By <span id="username"></span></strong>
                    <br>
                    <small id="date_created"></small>
                  </p>
                  <span class="tags" id="standards_versions"></span> 
                  <hr>
                </div>             
                <div class="col-md-12 divider text-center" id="buttons">
                  <h2><strong id="files_count"></strong></h2>
                  <p><small>Files</small></p>
                  <button class="btn btn-info btn-block" id="download_button"><span class="fa fa-download"></span> Download </button>
                </div>
              </div>
            </div>                 
          </div>
        </div>
      </div>    
    </div>    
  </header>
  <div class="content" style="display:none;">
    <section class="no-padding" style="margin:20px auto" id="download">
      <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Files</strong></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
                <div class="list-group" id="files">
                </div>
              </div>
              <div class="col-md-8" id="files_content">

              </div>
            </div>
          </div>
        </div>
      </div> <!-- /container -->
    </section>
  </div>

  <div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Manifest</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="javascript:save_manifest();">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

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
    var username = "<?=$_SESSION['username'] ?>";
    function scroll_to(id)
      {
      id = id.replace("link", "");
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
      }
    function file_select(obj,id)
      {
      $(".files_bt").removeClass('active');
      $(obj).addClass('active');

      $(".files_list").hide();
      $("#file_"+id).delay(400).fadeIn('slow');
      }

    function delete_manifest(name)
      {
      if(name === username && confirm("Are you sure to delete this manifest?"))
        {
        $(".content").fadeOut('fast', function() {
          $("#loading").delay(400).fadeIn('fast');
        });
        $.ajax({
          type: "POST",
          url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/deleteManifest.php",
          //url: "http://localhost/OCDXGroupProject/services/deleteManifest.php",
          dataType: 'json',
          data: {manifestId : "<?=$_GET['id'] ?>"},
          success: function(res)
            {
            if(res.success)
              {
              alert(res.msg);
              window.location.href = "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX";
              }
            else
              {
              if(res.msg)
                alert(res.msg);
              else
                alert("Error!");

              $("#loading").fadeOut('fast', function() {
                $(".content").delay(400).fadeIn('fast');
              });              
              }
            }
          });        
        }
      }
    function edit_manifest(name)
      {
      $('#edit input[name=title]').val($("#title").text());   
      $('#edit input[name=comment]').val($("#comment").text());   
      $('#edit input[name=standards]').val($("#standards_versions").text());   
      $('#edit').modal('show');
      }
    function save_manifest()
      {
      var data = { 
        manifestId : "<?=$_GET['id'] ?>",
        standards : $('#edit input[name=standards]').val(),
        comment : $('#edit input[name=comment]').val(),
        title : $('#edit input[name=title]').val()
      }

      $.ajax({
        type: "POST",
        url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/updateManifest.php",
        //url: "http://localhost/OCDXGroupProject/services/updateManifest.php",
        dataType: 'json',
        data: data,
        success: function(res)
          {
          if(res.success)
            {
            $("#title").text(data.title)
            $("#comment").text(data.comment)
            $("#standards_versions").text(data.standards);
            $('#edit').modal('hide');
            }
          }
        }); 
      }
    function delete_file(id)
      {
      if(confirm("Are you sure?"))
        {
        $("#file_list_"+id).remove();
        $("#file_"+id).remove();
        }
      }

    $(document).ready(function() {
      $("#download_button").click(function(event) {
        scroll_to("download");
      });
      $.ajax({
        type: "POST",
        url: "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/viewManifest.php",
        //url: "http://localhost/OCDXGroupProject/services/viewManifest.php",
        dataType: 'json',
        data: {manifest : "<?=$_GET['id'] ?>"},
        success: function(res)
          {
          if(res.success == false)
            {
            $("#loading").html("<h3>Id:<?=$_GET['id'] ?>, "+res.msg+"</h3>")
            }
          else
            {
            $("#loading").fadeOut('fast', function() {
              $("#title").text(res.title);
              $("#comment").text(res.comment);
              $("#standards_versions").text(res.standards_versions);
              $("#username").text(res.username);
              $("#date_created").text(res.date_created);
              $("#files_count").text(res.files.length);

              $.each(res.files, function(index, val) {
                var delete_file_button = '';
                if(username === res.username)
                  delete_file_button = '<button class="btn btn-danger" onclick="javascript:delete_file('+index+');">Delete</button>';

                $("#files").append('<a class="files_bt list-group-item" id="file_list_'+index+'" onclick="javascript:file_select(this,'+index+')">'+val.name+'</a>');
                $("#files a:first-child").addClass('active');

                $("#files_content").append('<div class="files_list" id="file_'+index+'" style="display:none">\
                  <h3>\
                    '+val.name+'\
                  </h3>\
                  <form action="http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/download.php" method="post" target="_blank">\
                    <button type="submit" class="btn pull-left"><i class="fa fa-download fa-pull-right fa-border text-danger"></i> Download</button>\
                    <input type="hidden" name="filename" value="'+val.name+'">\
                  </form>\
                  '+delete_file_button+'\
                  <div class="clearfix"></div>\
                  <br>\
                  <strong>File format:</strong> '+val.format+'<br>\
                  <strong>File size:</strong> '+val.size+' Bytes <br>\
                  <h3>Abstract:</h3>\
                  <div class="well well-sm">\
                  '+val.abstract+'\
                  </div>\
                </div>');

                $(".files_list:first-child").fadeIn('fast');
              });
              if(username === res.username)
                {
                $("#buttons").append('<button class="btn btn-warning btn-block" onclick="javascript:edit_manifest(\''+res.username+'\');">Edit</butoon> <button class="btn btn-danger btn-block" onclick="javascript:delete_manifest(\''+res.username+'\');">Delete</butoon>')
                }
              $(".content").fadeIn('fast');
            });
            }
          console.log(res);
          }
        });

    });
  </script>

</body>

</html>
