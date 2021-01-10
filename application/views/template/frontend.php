<!DOCTYPE html>
<html>
<?php
$setting_aplikasi = $this->db->get('setting')->row();
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= "{$setting_aplikasi->nama}"; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/scss/main.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/scss/skin.css">
  <!-- logo website -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/image/logo/') . $setting_aplikasi->kode; ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ?>assets/script/index.js"></script>
</head>

<body id="wrapper">

  <section id="top-header">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 top-header-links">
          <ul class="contact_links">
            <li><i class="fa fa-phone"></i><a href="#">+91 848 594 5080</a></li>
            <li><i class="fa fa-envelope"></i><a href="#">sales@aspiresoftware.in</a></li>
          </ul>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <ul class="social_links">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            <li><a href="#"><i class="fa fa-skype"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    </div>

  </section>

  <header>
    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url() ?>">
            <h1>MI 19</h1><span><?= "{$setting_aplikasi->nama}"; ?></span>
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
            <?php $fmenus = $this->layout->get_frontend_menu() ?>
            <?php
            foreach ($fmenus as $fm) {
              if ($fm['label'] == $title) {
                $active = 'active';
              } else {
                $active = '';
              };
              if ($fm['label'] == 'Sign in') {
                if (!$this->ion_auth->logged_in()) {
                  // redirect them to the login page
                  $signin = 'Sign In';
                  $signin_url = 'login';
                  echo '<li class="' . $active . '"><a href="' . site_url('/') . $signin_url . '"> ' . $signin . ' </a>';
                } else {
                  $signin = 'Dashboard';
                  $signin_url = 'dashboard';
                  echo '<li class="' . $active . '"><a href="' . site_url('/') . $signin_url . '"> ' . $signin . ' </a>';
                }
              } else {
                echo '<li class="' . $active . '"><a href="' . site_url('/') . $fm['link'] . '"> ' . $fm["label"] . ' </a>';
              }
            }

            ?>


          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>
  </header>
  <!--/.nav-ends -->

  <!-- content -->
  <section class="content">
    <?php $this->load->view($page); ?>
  </section>
  <!-- end of content -->
  <section id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 block">
          <div class="footer-block">
            <h4>Address</h4>
            <hr />
            <p>Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum.
            </p>
            <a href="#" class="learnmore">Learn More <i class="fa fa-caret-right"></i></a>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 block">
          <div class="footer-block">
            <h4>Useful Links</h4>
            <hr />
            <ul class="footer-links">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Features</a></li>
              <li><a href="#">Portfolio</a></li>
              <li><a href="#">Contact</a></li>
              <li><a href="#">Sign In</a></li>
              <li><a href="#">Sign Up</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 block">
          <div class="footer-block">
            <h4>Community</h4>
            <hr />
            <ul class="footer-links">
              <li><a href="#">Blog</a></li>
              <li><a href="#">Forum</a></li>
              <li><a href="#">Free Goods</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 <block></block>">
          <div class="footer-block">
            <h4>Recent Posts</h4>
            <hr />
            <ul class="footer-links">
              <li>
                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                <p class="post-date">May 25, 2017</p>
              </li>
              <li>
                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                <p class="post-date">May 25, 2017</p>
              </li>
              <li>
                <a href="#" class="post">Lorem ipsum dolor sit amet</a>
                <p class="post-date">May 25, 2017</p>
              </li>

            </ul>
          </div>
        </div>
      </div>
    </div>


  </section>

  <section id="bottom-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 btm-footer-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Use</a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 copyright">
          Developed by <a href="#">Aspire Software Solutions</a> designed by <a href="#">Designing Team</a>
        </div>
      </div>
    </div>
  </section>

  <div id="panel">
    <div id="panel-admin">
      <div class="panel-admin-box">
        <div id="tootlbar_colors">
          <button class="color" style="background-color:#1abac8;" onclick="mytheme(0)"></button>
          <button class="color" style="background-color:#ff8a00;" onclick="mytheme(1)"> </button>
          <button class="color" style="background-color:#b4de50;" onclick="mytheme(2)"> </button>
          <button class="color" style="background-color:#e54e53;" onclick="mytheme(3)"> </button>
          <button class="color" style="background-color:#1abc9c;" onclick="mytheme(4)"> </button>
          <button class="color" style="background-color:#159eee;" onclick="mytheme(5)"> </button>
        </div>
      </div>

    </div>
    <a class="open" href="#"><span><i class="fa fa-gear fa-spin"></i></span></a>
  </div>

</html>