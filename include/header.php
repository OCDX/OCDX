<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand page-scroll" href="#page-top">OCDX Group1</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="./index.php">Home</a>
        </li>
        <li>
          <a href="./about.php">About</a>
        </li>
        <li>
          <a href="./search.php">Explore Data</a>
        </li>
        <li>
          <a href="./publish.php">Publish Data</a>
        </li>
        <?php
          session_start();
          if(isset($_SESSION["user_id"]) || isset($_SESSION["username"]))
            echo '
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-fw fa-user"></i>
                  '.$_SESSION["username"].'<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="./logout.php">Logout</a></li>
                </ul>
              </li>';
          else
            echo '
              <li>
                <a href="./login.php">Login</a>
              </li>';           
            
        ?>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>