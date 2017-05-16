<!DOCTYPE html>
<html>    
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Soul Efex</title>
      <meta name="Soul Efex" content="Soul Efex is dedicated to photographers, 
      artists, designers, musicians, videographers, and writers interested in 
      promoting positivity, holistic wellness, environmentalism, peace, 
      compassion, and exploration. We accept submissions for the Soul Efex 
      Magazine and the Soul Efex Website." />
      <link href="../styleSheets/site.css"  rel="stylesheet"  type="text/css" />
      <script>
        document.createElement('header');
        document.createElement('footer');
        document.createElement('nav');
        document.createElement('aside');
        document.createElement('section');
        document.createElement('article');
      </script>
  </head>
  <body>
    <header>
      <div id="wrapperHeader">
        <div id="titleLogo">
             <img src="../images/soul-efex-logo.png" alt="title">
        </div>
      <div class="header-social-icons">
        <h4>Follow us on</h4>
        <ul class="social-icons">
        <li><a href="https://www.facebook.com/soulefex">
          <img title="Facebook" alt="Facebook" src="../images/SVG/facebook.svg" width="35" height="35" />
        </a></li>
        <li><a href="https://twitter.com/soulefex">
          <img title="Twitter" alt="Twitter" src="../images/SVG/twitter.svg" width="35" height="35" />
        </a></li>
        <li><a href="https://www.pinterest.com/soulefex">
          <img title="Pinterest" alt="Pinterest" src="../images/SVG/pinterest.svg" width="35" height="35" />
        <li><a href="https://www.youtube.com/channel/UCiQmpZHWCpjMUiJGxmH3D2A">
          <img title="YouTube" alt="YouTube" src="../images/SVG/youtube.svg" width="35" height="35" />
        <li><a href="https://www.flickr.com/groups/soulefex">
          <img title="Flickr" alt="Flickr" src="../images/SVG/flickr.svg" width="35" height="35" /> 
        </a></li>
        </ul>    
      </div>
      <br />
      <br />
      <div id="navBar">    
        <nav>
          <a class="navBar" href="index.html">Home</a></a>  
          <a class="navBar" href="members.php">Members</a>
          <a class="navBar" href="about.html">About</a>
        </nav>
      </div>    
     </div>  
    </header> 
    
    <section>
      <article>
        <div id="setHeight">
          <br />
            <h2>Sign up to become a member or log in.</h2>
            <div class="center">
              <p>Before you can submit work, please create an account.</p>
            </div>  
          <br />  
          <div id="buttons">
            <a href="signup.php"><button class="button">Sign Up</button></a>
            <a href="login.php"><button class="button">Log In</button></a>
          </div>
        </div>  
      </article>
    </section>

  </body>
</html>

<?php
    //insert the page footer
    require_once('footer.php');
?>
