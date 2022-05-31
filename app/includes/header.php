  <!-- header -->
  <header class="clearfix">
    <div class="logo">
      <a href="<?php echo BASE_URL . '/index.php' ?>">
        <h1 class="logo-text"><span>Awa</span>Inspires</h1>
      </a>
    </div>
    <div class="fa fa-reorder menu-toggle"></div>
    <nav>
      <ul>
        <li><a href="<?php echo BASE_URL . '/index.php' ?>">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
    
          <!-- if there is id enterd this mean that there is a user logged in so do #if -->
          <!-- else show sign up and log in do #else -->
          <!-- without start the session we won`t see the username in index page "that is header.php is invoked on it" cause index.php hasn`t that function where it in db.php -->          
          <!--#if-->
          <!--if (isset($_SESSION['id'])): mean if id exist it is differ from true ir false check that is in #dashboard and cause of this line also when we logout we see login and sign up again-->
  <?php if (isset($_SESSION['id'])): ?> 

        <li>
          <a href="#" class="userinfo">
            <i class="fa fa-user"></i>
                <?php echo $_SESSION['username']; ?>
            <i class="fa fa-chevron-down"></i>
          </a>
          <ul class="dropdown">
              <!--#dashboard-->
  <?php if ($_SESSION['admin']): ?>
            <li><a href=" <?php echo BASE_URL . '/admin/dashboard.php' ?> ">Dashboard</a></li>
 <?php endif; ?>         
            <li><a href=" <?php echo BASE_URL . '/logout.php' ?> " class="logout">logout</a></li>
          </ul>
        </li>
          <!--#else-->
 <?php else: ?>
          
        <li><a href=" <?php echo BASE_URL . '/register.php' ?> ">Sign up</a></li>
        <li>
          <a href=" <?php echo BASE_URL . '/login.php' ?> ">
            <i class="fa fa-sign-in"></i>
            Login
          </a>
        </li>       
 <?php endif; ?>         
     </ul>
    </nav>
  </header>
  <!-- // header -->
