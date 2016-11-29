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
        <h1 id="homeHeading">Explore Datasets</h1>
        <p style="margin:0 auto;">1,751,009,072 <small>bytes of data today</small></p>
        <hr>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <input type="text" class="form-control" placeholder="Search for datasets" id="search_keyword">
            <br>
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-info active">
                <input type="radio" name="options" value="keyword" checked> Keyword
              </label>
              <label class="btn btn-info">
                <input type="radio" name="options" value="username" > Username
              </label>
            </div>            
            <hr>
            <button class="btn btn-primary btn-xl" id="search_button">SEARCH</button>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section class="no-padding text-center" id="status" style="display: none; padding:30px 0;">

  </section>
  <section class="no-padding" id="result" style="display: none; margin-top:15px;">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <hgroup>
            <h1>Search Results</h1>
            <h2 class="lead">
              <strong class="text-danger"><span id="count_result">0</span></strong> results were found for the search for
              <strong class="text-danger" id="keyword"></strong>
            </h2>               
          </hgroup>
        </div>
      </div>
      <section class="no-padding" style="margin: 20px 0;">
        <div calss="row">
          <div class="col-md-8 col-md-offset-2" id="search_list">
          </div>
        </div>
      </section>
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
    function scroll_to(id)
      {
      id = id.replace("link", "");
      $('html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
      }

    $(document).ready(function() {
      $("#search_button").click(function(event) {
        var keyword = $("#search_keyword").val();
        var count = 0;
        if(keyword.length > 0)
          {
          $("#status").fadeIn('fast', function() {
            $(this).html('<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>');
            scroll_to("status");
          });
          var search_by = $('input[name=options]:checked').val();
          var url = "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/searchManifest.php";
          //url = "http://localhost/OCDXGroupProject/services/searchManifest.php";

          if(search_by === "username")
            {
            url = "http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/services/searchByUsername.php";
            //url = "http://localhost/OCDXGroupProject/services/searchByUsername.php";
            }

          console.log(search_by);

          $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            data: { searchField : keyword, username : keyword },
            success: function (res)
              {
              $("#search_list").html('');
              //<h3><a target="_blank" href="http://localhost/swe/view.php?id='+val.manifest_id+'">'+val.title+'</a></h3>\
              $.each(res, function(index, val) {
                count++;
                var date = val.date_created.split(" ");
                var list = '\
                  <article class="search-result row">\
                    <div class="col-xs-12 col-sm-12 col-md-10">\
                      <h3><a target="_blank" href="http://ec2-54-145-239-64.compute-1.amazonaws.com/OCDX/view.php?id='+val.manifest_id+'">'+val.title+'</a></h3>\
                      <p>'+val.description+'</p>\
                    </div>\
                    <div class="col-xs-12 col-sm-12 col-md-2">\
                      <ul class="meta-search">\
                        <li><i class="glyphicon glyphicon-calendar"></i> <span>'+date[0]+'</span></li>\
                        <li><i class="glyphicon glyphicon-time"></i> <span>'+date[1]+'</span></li>\
                        <li><i class="glyphicon glyphicon-user"></i> <span>'+val.username+'</span></li>\
                      </ul>\
                    </div>\
                    <span class="clearfix border"></span>\
                  </article>';
                $("#search_list").append(list);
              });

              $("#keyword").text(keyword);
              $("#count_result").text(count);

              $("#status").fadeOut('fast', function() {
                $("#result").fadeIn('fast');
                scroll_to("result");
              });

              }
          });
          }
        else
          {
          $("#status").fadeIn('fast', function() {
            $(this).html('<h2 class="text-danger">Error: Keyword is required!</h2>');
            scroll_to("status");
          });
          }
      });
    });
  </script>

</body>

</html>
