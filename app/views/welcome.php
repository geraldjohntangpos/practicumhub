<!-- Main -->
<div id="index-banner" class="parallax-container">
  <div class="section no-pad-bot">
    <div class="container">
      <br><br>
      <h1 class="header center teal-text text-lighten-2">PracticumHub</h1>
      <div class="row center">
        <h5 class="header col s12 light">A Web based Application for Practicum Program</h5>
      </div>
      <div class="row center">
        <a href="/practicumhub/signin" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Subscribe Now</a>
      </div>
      <br><br>

    </div>
  </div>
  <div class="parallax"><img src="plugins/background1.jpg" alt="Unsplashed background img 1"></div>
</div>


<div class="">
  <div class="section">
    <div class="row">
      <div class="col s12 m12">
        <br>
        <h2 class="center brown-text"><u>Services</u></h2>
      </div>
    </div>

    <!--   Icon Section   -->
      <div class="row scrollspy" id="services">
        <div class="col s12 m3">
          <div class="icon-block">
            <h1 class="center brown-text"><i class="material-icons large">important_devices</i></h1>
            <h5 class="center">Journal, DTR, Monitoring and Passing or Requirements Online</h5>

            <p class="light"></p>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="icon-block">
            <h1 class="center brown-text"><i class="material-icons large">border_color</i></h1>
            <h5 class="center">Digital Signature</h5>

            <p class="light"></p>
          </div>
        </div>

        <div class="col s12 m3">
          <div class="icon-block">
            <h1 class="center brown-text"><i class="material-icons large">assignment</i></h1>
            <h5 class="center">Task Manager</h5>

            <p class="light"></p>
          </div>
        </div>

      <div class="col s12 m3">
        <div class="icon-block">
          <h1 class="center brown-text"><i class="material-icons large">dashboard</i></h1>
          <h5 class="center">Post Jobs for Partner Companies</h5>

          <p class="light"></p>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="plugins/background2.jpg" alt="Unsplashed background img 2"></div>
</div>

<div class="">
  <div class="section">

    <div class="row">
      <div class="col s12 center">
        <h3><i class="mdi-content-send brown-text"></i></h3>
        <br>
        <h2 class="center brown-text"><u>About Us</u></h2>
        <p class="left-align light scrollspy" id="aboutus">ParcticumHub is a web based application
        for practicum programs that offers you tools and features to
        lessen the hassle encountered by the students, faculty and
        practicum coordinator and some of the companies.</p>
        <h2 class="center brown-text"><u>Our Team</u></h2>
        <div class=" ourTeam row">
          <div class="col s12 m4 l4">
            <img src="images/founders/hipster.png" class="ourTeamImg responsive-img circle" alt="Hipster">
            <p class="memberName center">Arna Cris D. Obenza</p>
            <h3 class="center brown-text">Hipster</h3>
          </div>
          <div class="col s12 m4 l4">
            <img src="images/founders/hustler.png" class="ourTeamImg responsive-img circle" alt="Hustler">
            <p class="memberName center">Karen Marie D. Salazer</p>
            <h3 class="center brown-text">Hustler</h3>
          </div>
          <div class="col s12 m4 l4">
            <img src="images/founders/hacker.png" class="ourTeamImg responsive-img circle" alt="Hacker">
            <p class="memberName center">Laurice Klaire Rago</p>
            <h3 class="center brown-text">Hacker</h3>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="plugins/background3.jpg" alt="Unsplashed background img 4"></div>
</div>

<div class="">
  <div class="section">

    <div class="row">
      <div class="col s12 center">
        <h3><i class="mdi-content-send brown-text"></i></h3>
        <br />
        <h4>Contact Us</h4>
        <p class="left-align light scrollspy" id="contact">
          
        </p>
        <div class=" ourTeam row">
          <div class="col s12 m4 l4">
            <img src="plugins/icons/facebook.ico" class="ourTeamImg responsive-img circle" alt="Hipster">
            <h3 class="center brown-text">Facebook</h3>
          </div>
          <div class="col s12 m4 l4">
            <img src="plugins/icons/twitter.ico" class="ourTeamImg responsive-img circle" alt="Hustler">
            <h3 class="center brown-text">Twitter</h3>
          </div>
          <div class="col s12 m4 l4">
            <img src="plugins/icons/googleplus.png" class="ourTeamImg responsive-img circle" alt="Hacker">
            <h3 class="center brown-text">Google+</h3>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="plugins/background4.jpg" alt="Unsplashed background img 4"></div>
</div>

<div class="">
  <div class="section">

    <div class="row">
      <div class="col s12 center">
        <h3><i class="mdi-content-send brown-text"></i></h3>
        <br />
        <h4>Partners</h4>
        <?php
          $schools = viewSchoolLanding();
          $companies = viewCompanyLanding();
        ?>
        <p class="left-align light scrollspy" id="partners"></p>
        <h5>School</h5>
        <?php
          if(count($schools) == 0) {
            ?>
            <div class="ourTeam row">
              <div class="col s12 center">
                <h3>No existing partner school yet.</h3>
              </div>
            </div>
            <?php
          }
          else {
            for($c = 0; $c<count($schools);) {
              ?>
              <div class="ourTeam row">
                <?php
                  for($c1 = 0; $c1<3; $c1++) {
                    $name = $schools[$c]['school_name'];
                    $image = $schools[$c]['school_image'];
                    ?>
                    <div class="col s12 m4 l4">
                      <img src="images/school/<?= $image; ?>" class="ourTeamImg responsive-img circle" alt="Hipster">
                      <h4 class="center brown-text"><?= $name; ?></h4>
                    </div>
                    <?php
                    $c++;
                    if($c == count($schools)) {
                      break;
                    }
                  }
                ?>
              </div>
              <?php
            }
          }
        ?>
        <h5>Company</h5>
        <?php
          if(count($companies) == 0) {
            ?>
            <div class="ourTeam row">
              <div class="col s12 center">
                <h3>No existing partner company yet.</h3>
              </div>
            </div>
            <?php
          }
          else {
            for($c = 0; $c<count($companies);) {
              ?>
              <div class="ourTeam row">
                <?php
                  for($c1 = 0; $c1<3; $c1++) {
                    $name = $companies[$c]['company_name'];
                    $image = $companies[$c]['image'];
                    ?>
                    <div class="col s12 m4 l4">
                      <img src="images/company/<?= $image; ?>" class="ourTeamImg responsive-img circle" alt="Hipster">
                      <h4 class="center brown-text"><?= $name; ?></h4>
                    </div>
                    <?php
                    $c++;
                    if($c == count($companies)) {
                      break;
                    }
                  }
                ?>
              </div>
              <?php
            }
          }
        ?>
      </div>
    </div>

  </div>
</div>

<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="plugins/background5.jpg" alt="Unsplashed background img 5"></div>
</div>
