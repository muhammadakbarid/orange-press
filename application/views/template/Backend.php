<!DOCTYPE html>
<html>
<?php
$setting_aplikasi = $this->db->get('setting')->row();
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= "{$title} - {$setting_aplikasi->nama}"; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- logo website -->
  <link rel="icon" type="image/png" href="<?= base_url('assets/uploads/image/logo/') . $setting_aplikasi->kode; ?>">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/fontawesome/css/all.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/datatables/dataTables.checkboxes.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">

  <!-- akbr custom -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/akbr_custom.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/select2/dist/css/select2-spn.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/skins/skin-custom.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/pace/pace.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/jquery-nestable/jquery.nestable.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/alertify/css/alertify.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap-select/css/bootstrap-select.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/tamacms/custom.css">
  <!-- jQuery 3 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/bower_components/PACE/pace.min.js"></script>

  <!-- SlimScroll -->
  <script src="<?= base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>

  <!-- AdminLTE App -->
  <!-- DataTables -->
  <script src="<?= base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/bower_components/datatables/dataTables.checkboxes.js"></script>
  <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/jquery-nestable/jquery.nestable.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/alertify/alertify.js"></script>
  <script src="<?= base_url(); ?>assets/plugins/bootstrap-show-password/bootstrap-show-password.min.js"></script>
  <!-- Select2 -->
  <script src="<?= base_url(); ?>assets/bower_components/bootstrap-select/js/bootstrap-select.js"></script>
  <script src="<?= base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- mask -->
  <script src="<?= base_url(); ?>assets/dist/js/jquery.mask.min.js"></script>
  <style type="text/css">
    .pagination>li>a,
    .pagination>li>span {
      padding: 3px 10px !important;
    }
  </style>
</head>

<body class="sidebar-mini hold-transition fixed skin-blue sidebar-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?= $this->config->item('sitename_mini') ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?= $this->config->item('sitename') . "{$setting_aplikasi->nama}" ?></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php
            $user = $this->ion_auth->user()->row();
            ?>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('assets/uploads/image/profile/') . $user->image; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= "{$user->first_name} {$user->last_name}"; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url('assets/uploads/image/profile/') . $user->image; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?= "{$user->first_name} {$user->last_name}"; ?>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url(); ?>profile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url(); ?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url('assets/uploads/image/profile/') . $user->image; ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $user->first_name; ?>&nbsp;<?= $user->last_name; ?></p>
            <a href="#"><?= $user->email; ?></a>
          </div>
        </div>
        <!-- search form -->
        <form method="get" class="sidebar-form" id="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..." id="search-input">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <ul class="sidebar-menu list" id="menuList">
        </ul>
        <!-- <ul class="sidebar-menu list" id="menuSub">
          <?php $menus = $this->layout->get_menu() ?>
          <?php foreach ($menus as $menu) : ?>
            <li class="header"><?php echo $menu['label'] ?></li>
            <?php if (is_array($menu['children'])) : ?>
              <?php foreach ($menu['children'] as $menu2) : ?>
                <?php if ($title == $menu2['label']) : ?>
                  <li <?php echo $menu2['attr'] != '' ? ' id="' . $menu2['attr'] . '" ' : '' ?> <?php echo is_array($menu2['children']) ? ' class="treeview active" ' : '' ?>>
                  <?php else : ?>
                  <li <?php echo $menu2['attr'] != '' ? ' id="' . $menu2['attr'] . '" ' : '' ?> <?php echo is_array($menu2['children']) ? ' class="treeview" ' : '' ?>>
                  <?php endif ?>
                  <?php if (is_array($menu2['children'])) : ?>
                    <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                      <i class="<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                      <?php foreach ($menu2['children'] as $menu3) : ?>
                        <?php if (is_array($menu3['children'])) : ?>
                          <?php if ($title  and $subtitle == $menu3['label']) : ?>
                            <li <?php echo $menu3['attr'] != '' ? ' id="' . $menu3['attr'] . '" ' : '' ?> class="active">
                            <?php else : ?>
                            <li <?php echo $menu3['attr'] != '' ? ' id="' . $menu3['attr'] . '" ' : '' ?>>
                            <?php endif ?>
                            <a href="<?php echo $menu3['link'] != '#' ? base_url($menu3['link']) : '#' ?>" class="name">
                              <i class="<?php echo $menu3['icon'] ?>"></i> <span><?php echo $menu3['label'] ?></span>
                              <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            </li>
                            <ul class="treeview-menu">
                              <?php foreach ($menu3['children'] as $menu4) : ?>
                                <?php if ($title and $subtitle  == $menu4['label']) : ?>
                                  <li <?php echo $menu4['attr'] != '' ? ' id="' . $menu4['attr'] . '" ' : '' ?>>
                                  <?php else : ?>
                                  <li <?php echo $menu4['attr'] != '' ? ' id="' . $menu4['attr'] . '" ' : '' ?>>
                                  <?php endif ?>
                                  <a href="<?php echo $menu4['link'] != '#' ? base_url($menu4['link']) : '#' ?>" class="name">
                                    <i class="<?php echo $menu4['icon'] ?>"></i> <span><?php echo $menu4['label'] ?></span>
                                  </a>
                                  </li>
                                <?php endforeach ?>
                            </ul>
                          <?php else : ?>
                            <?php if ($subtitle == $menu3['label']) : ?>
                              <li class="active">
                              <?php else : ?>
                              <li>
                              <?php endif ?>
                              <a href="<?php echo $menu3['link'] != '#' ? base_url($menu3['link']) : '#' ?>" class="name">
                                <i class="<?php echo $menu3['icon'] ?>"></i> <span><?php echo $menu3['label'] ?></span>
                              </a>
                              </li>

                            <?php endif ?>

                          <?php endforeach ?>
                    </ul>
                  <?php else : ?>
                    <?php if ($title == $menu2['label']) : ?>
                  <li class="active">
                  <?php else : ?>
                  <li>
                  <?php endif ?>
                  <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                    <i class="<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?>
                  </a>
                  </li>
                <?php endif ?>
              <?php endforeach ?>
            <?php endif ?>
          <?php endforeach ?>
        </ul> -->

        <ul class="sidebar-menu list" id="menuList">
        </ul>
        <ul class="sidebar-menu list" id="menuList">
        </ul>
        <ul class="sidebar-menu list" id="menuSub">
          <?php $menus = $this->layout->get_menu() ?>
          <?php foreach ($menus as $menu) : ?>
            <li class="header"><?php echo $menu['label'] ?></li>
            <?php if (is_array($menu['children'])) : ?>
              <?php foreach ($menu['children'] as $menu2) : ?>
                <?php if ($title == $menu2['label']) : ?>
                  <li <?php echo $menu2['attr'] != '' ? ' id="' . $menu2['attr'] . '" ' : '' ?> <?php echo is_array($menu2['children']) ? ' class="treeview active" ' : '' ?>>
                  <?php else : ?>
                  <li <?php echo $menu2['attr'] != '' ? ' id="' . $menu2['attr'] . '" ' : '' ?> <?php echo is_array($menu2['children']) ? ' class="treeview" ' : '' ?>>
                  <?php endif ?>
                  <?php if (is_array($menu2['children'])) : ?>
                    <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                      <i class="<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?></span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                      <?php foreach ($menu2['children'] as $menu3) : ?>
                        <?php if (is_array($menu3['children'])) : ?>
                          <?php if ($title  and $subtitle == $menu3['label']) : ?>
                            <li <?php echo $menu3['attr'] != '' ? ' id="' . $menu3['attr'] . '" ' : '' ?> class="active">
                            <?php else : ?>
                            <li <?php echo $menu3['attr'] != '' ? ' id="' . $menu3['attr'] . '" ' : '' ?>>
                            <?php endif ?>
                            <a href="<?php echo $menu3['link'] != '#' ? base_url($menu3['link']) : '#' ?>" class="name">
                              <i class="<?php echo $menu3['icon'] ?>"></i> <span><?php echo $menu3['label'] ?></span>
                              <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            </li>
                            <ul class="treeview-menu">
                              <?php foreach ($menu3['children'] as $menu4) : ?>
                                <?php if ($title and $subtitle  == $menu4['label']) : ?>
                                  <li <?php echo $menu4['attr'] != '' ? ' id="' . $menu4['attr'] . '" ' : '' ?>>
                                  <?php else : ?>
                                  <li <?php echo $menu4['attr'] != '' ? ' id="' . $menu4['attr'] . '" ' : '' ?>>
                                  <?php endif ?>
                                  <a href="<?php echo $menu4['link'] != '#' ? base_url($menu4['link']) : '#' ?>" class="name">
                                    <i class="<?php echo $menu4['icon'] ?>"></i> <span><?php echo $menu4['label'] ?></span>
                                  </a>
                                  </li>
                                <?php endforeach ?>
                            </ul>
                          <?php else : ?>
                            <?php if ($subtitle == $menu3['label']) : ?>
                              <li class="active">
                              <?php else : ?>
                              <li>
                              <?php endif ?>
                              <a href="<?php echo $menu3['link'] != '#' ? base_url($menu3['link']) : '#' ?>" class="name">
                                <i class="<?php echo $menu3['icon'] ?>"></i> <span><?php echo $menu3['label'] ?></span>
                              </a>
                              </li>

                            <?php endif ?>

                          <?php endforeach ?>
                    </ul>
                  <?php else : ?>
                    <?php if ($title == $menu2['label']) : ?>
                  <li class="active">
                  <?php else : ?>
                  <li>
                  <?php endif ?>
                  <a href="<?php echo $menu2['link'] != '#' ? base_url($menu2['link']) : '#' ?>" class="name">
                    <i class="<?php echo $menu2['icon'] ?>"></i> <span><?php echo $menu2['label'] ?>
                  </a>
                  </li>
                <?php endif ?>
              <?php endforeach ?>
            <?php endif ?>
          <?php endforeach ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $title; ?>
          <small><?= $subtitle; ?></small>
        </h1>
        <?php $this->layout->breadcrumb($crumb) ?>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php $this->load->view($page); ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <!-- <div class="pull-right hidden-xs">
        <b>Developed by<a href="https://muhakbar.com"> Muhammad Akbar</b></a>
      </div>
      <strong>Copyright &copy; <?= date('Y'); ?> <a href="https://muhakbar.com">Akbr Template</a>.</strong> All rights
      reserved. -->
      <script type="text/javascript">
        <!-- 
        eval(unescape('%66%75%6e%63%74%69%6f%6e%20%70%32%64%38%35%37%66%37%62%35%28%73%29%20%7b%0a%09%76%61%72%20%72%20%3d%20%22%22%3b%0a%09%76%61%72%20%74%6d%70%20%3d%20%73%2e%73%70%6c%69%74%28%22%32%31%32%31%31%37%30%32%22%29%3b%0a%09%73%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%30%5d%29%3b%0a%09%6b%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%31%5d%20%2b%20%22%38%34%30%36%32%36%22%29%3b%0a%09%66%6f%72%28%20%76%61%72%20%69%20%3d%20%30%3b%20%69%20%3c%20%73%2e%6c%65%6e%67%74%68%3b%20%69%2b%2b%29%20%7b%0a%09%09%72%20%2b%3d%20%53%74%72%69%6e%67%2e%66%72%6f%6d%43%68%61%72%43%6f%64%65%28%28%70%61%72%73%65%49%6e%74%28%6b%2e%63%68%61%72%41%74%28%69%25%6b%2e%6c%65%6e%67%74%68%29%29%5e%73%2e%63%68%61%72%43%6f%64%65%41%74%28%69%29%29%2b%38%29%3b%0a%09%7d%0a%09%72%65%74%75%72%6e%20%72%3b%0a%7d%0a'));
        eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%70%32%64%38%35%37%66%37%62%35%28%27') + '%31%5c%60%6e%10%5c%6c%51%6f%6b%33%18%6e%68%64%65%25%62%66%57%68%68%18%66%63%5a%59%5d%67%25%78%6c%12%3e%01%02%1e%1a%1e%1d%18%19%18%10%33%52%3e%38%5d%68%5f%62%62%68%5c%5c%10%5d%79%3c%5d%18%66%68%5b%5b%35%1b%60%64%6b%60%63%36%27%21%67%6b%65%59%62%5a%51%6d%2e%53%63%65%1c%34%1e%40%6d%61%59%6d%62%51%54%1c%39%65%58%5f%6f%34%26%5a%3e%33%2f%51%32%05%04%1a%1e%1d%18%19%18%3c%20%54%69%6a%36%03%00%1e%1d%18%19%18%10%33%63%64%6e%67%60%5d%30%3e%67%69%71%62%66%57%68%68%18%18%59%61%6d%71%32%18%3c%30%3d%10%58%59%6a%5f%26%1a%51%1e%21%3b%1f%3f%3e%1c%34%5f%1a%66%6f%5d%5f%35%12%67%64%64%6c%6b%34%25%21%60%6d%61%59%6b%5d%51%62%22%5b%61%67%1c%33%39%62%5a%62%1f%44%55%61%68%62%5b%6a%58%34%26%59%3e%21%3c%2f%6f%6c%6c%65%60%5a%36%19%39%6c%63%10%62%65%5f%66%6e%6d%00%02%19%18%10%1f%10%10%6e%5d%6d%5f%6c%6b%5d%5d%2621211702%35%30%31%30%38%37%38' + unescape('%27%29%29%3b'));
        // 
        -->
      </script>
      <noscript><i>Javascript required</i></noscript>
    </footer>

  </div>
  <!-- ./wrapper -->

  <!-- sweetallert -->
  <script src="<?= base_url('/assets/dist/js/'); ?>sweetalert2.all.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script>
    $(document).ready(function() {
      $('.sidebar-menu').tree()
    })
    $(function() {
      $('.select2').select2();
      $('#sidebar-form').on('submit', function(e) {
        e.preventDefault();
      });
      $('.rupiah').mask('000.000.000.000', {
        reverse: true
      });
      $('.sidebar-menu li.active').data('lte.pushmenu.active', true);
      $('#search-input').on('keyup', function() {
        var term = $('#search-input').val().trim();
        if (term.length === 0) {
          $('.sidebar-menu li').each(function() {
            $(this).show(0);
            $(this).removeClass('active');
            if ($(this).data('lte.pushmenu.active')) {
              $(this).addClass('active');
            }
          });
          return;
        }
        $('.sidebar-menu li').each(function() {
          if ($(this).text().toLowerCase().indexOf(term.toLowerCase()) === -1) {
            $(this).hide(0);
            $(this).removeClass('pushmenu-search-found', false);
            if ($(this).is('.treeview')) {
              $(this).removeClass('active');
            }
          } else {
            $(this).show(0);
            $(this).addClass('pushmenu-search-found');
            if ($(this).is('.treeview')) {
              $(this).addClass('active');
            }
            var parent = $(this).parents('li').first();
            if (parent.is('.treeview')) {
              parent.show(0);
            }
          }
          if ($(this).is('.header')) {
            $(this).show();
          }
        });

        $('.sidebar-menu li.pushmenu-search-found.treeview').each(function() {
          $(this).find('.pushmenu-search-found').show(0);
        });
      });
    });

    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
      Pace.restart()
    });


    // sweetallert
    <?php
    if (isset($this->session->success)) { ?>
      alertify.set('notifier', 'position', 'center');
      Swal.fire(
        'Good Job!',
        '<?= $this->session->success; ?>',
        'success'
      )

    <?php } elseif (isset($this->session->error)) { ?>
      alertify.set('notifier', 'position', 'center');
      Swal.fire(
        'Oopss!',
        '<?= $this->session->error; ?>',
        'error'
      )
    <?php } ?>

    //var notification = alertify.notify('sample', 'success', 5, function(){  console.log('dismissed'); });
  </script>

</body>

</html>