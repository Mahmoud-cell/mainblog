  <!-- header -->
  <header class="clearfix">
    <a class="logo" href=" <?php echo BASE_URL . '/index.php' ?> ">
        <h1 class="logo-text"><span>Awa</span>Inspires</h1>
    </a>
    <div class="fa fa-reorder menu-toggle"></div>
    <nav>
      <ul>
          <?php if(isset($_SESSION['username']) ):?>
                <li>
                  <a href="#" class="userinfo">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['username'];?>
                    <i class="fa fa-chevron-down"></i>
                  </a>
                  <ul class="dropdown">
                    <li><a href="<?php echo BASE_URL . '/logout.php';?>" class="logout">logout</a></li>
                  </ul>
                </li>
          <?php endif; ?>
<!--        <li><a href="#">Home</a></li>-->
      </ul>
    </nav>
  </header>
  <!-- // header -->
