<!-- Navbar -->
<div class="navbar-fixed scrollspy" id="home">
<nav class="white" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="/practicumhub/home" class="brand-logo">PracticumHub</a>
    <ul class="right hide-on-med-and-down">
      <li>
        <a href="#" class='dropdown-button' data-activates='droplist'>
          <ul class="">
            <li>Welcome Dept Admin <strong><u><?php echo getAcctFullname(array($_SESSION['ACCT_NO'])); ?></u></strong></li>
            <li><i class="material-icons">keyboard_arrow_down</i></li>
          </ul>
        </a>
      </li>
    </ul>

    <!-- Dropdown Structure -->
    <ul id='droplist' class='dropdown-content black-text'>
      <li><a href="/practicumhub/home/<?php echo $_SESSION['ACCT_NO']; ?>">Profile</a></li>
      <li><a href="/practicumhub/home/managesubs">Manage Subscriptions</a></li>
      <li><a href="/practicumhub/home/manageprog">Manage Programs</a></li>
      <li><a href="/practicumhub/home/manageschool">Manage My School</a></li>
      <li><a href="/practicumhub/home/viewjobs">View Jobs</a></li>
      <li class="divider"></li>
      <li><a href="/practicumhub/logout">LOGOUT</a></li>
    </ul>

    <ul id="nav-mobile" class="side-nav">
      <li><a href="/practicumhub/signin">SIGN IN</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
</div>
