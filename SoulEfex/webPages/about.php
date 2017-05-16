<?php
    //start the session
    require_once('startsession.php');

    //insert the page header
    $page_title = 'Home';
    require_once('header.php');

    require_once('appvars.php');
    require_once('connectvars.php');
    
    //show the navigation menu
    require_once('navmenu.php');

    //connect to the database 
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');     

    mysqli_close($dbc);
?>

<section>
      <article>
          <br />
            <h2>It's not just a feeling, it's a movement!</h2>
            <div id="about">
              <div class="aboutImage">
                <img src="../images/yoga.jpg" alt="yoga" width="100%">
              </div>
              <p>Soul Efex is a media business dedicated 
              to photographers, artists, designers, musicians, videographers, 
              and writers interested in promoting positivity, holistic wellness, 
              environmentalism, peace, compassion, and exploration.
              </p>
              <p>
              This is a submission-based website and magazine. We are interested 
              in subject matter that will educate, inspire,
              and uplift public consciousness. We embrace themes and concepts
              that are socially relevant and engage viewers and readers.
              </p>
              <p>
              Our mission is to provide positive, inspirational, and eco-conscious
              content that is family and workplace friendly.
              </p>
              <div class="gif">
                <img src="../images/soullogo.gif" alt="soul gif" width="100%">
              </div>    
            </div>
          <br />  
      </article>
    </section>
    
  <footer>
    <div id="wrapperFooter">
      <address>Copyright &copy;Soul Efex 2016. All rights reserved.</address>
    </div>
  </footer>

</body>
</html>