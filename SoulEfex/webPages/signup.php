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
      <link href="../styleSheets/site.css"  rel="stylesheet"  type="text/css"  />
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

<?php
    //insert the page header
    $page_title = 'Sign Up';

    require_once('appvars.php');
    require_once('connectvars.php');

    //connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('Error connecting to MySQL server.');

    if (isset($_POST['submit'])) 
    {
        //grab the profile data from the POST, escapes special characters in a string for use in an SQL statement
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $output_form = 'no';
            
        if (!empty($username) && !empty($password1) && !empty($password2) 
        && ($password1 == $password2) && !empty($email))
        {
            
            //make sure someone isn't already registered using this username
            $query = "SELECT * FROM members WHERE username = '$username'";
            $data = mysqli_query($dbc, $query);
            if (mysqli_num_rows($data) == 0) {
                //the username is unique, so insert the data into the database
                $query = "INSERT INTO members (username, password, join_date, email)" .  
                "VALUES ('$username', SHA('$password1'), NOW(), '$email')";
                 mysqli_query($dbc, $query)
                        or die ('Data not inserted.');
                
                //confirm success with the user
                echo '<p>Your new account has been successfully created. 
                      You\'re now ready to <a href="login.php">log in</a>.</p>';        
        
                mysqli_close($dbc);
                exit();
            }
            else {
                //an account already exists for this username, so display an error message
                echo '<p class="error">An account already exists for this username. 
                    Please use a different address.</p>';
                $username = "";
            }
        }
        else {
             echo '<p class="error">You must enter all of the sign-up data 
             correctly, including the desired password twice.</p>';
        }
    }
    else {
        $output_form = 'yes';
    }
  
   mysqli_close($dbc);
   
   if ($output_form == 'yes') {
?>

  <div id ="setHeight">
    <div class="center">
      <p>Please enter your username and password to sign up.</p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'];)?>">
        <fieldset>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" 
                value="<?php if (!empty($username)) echo $username; ?>" /><br />
          <label for="password1">Password:</label>
          <input type="password" id="password1" name="password1" /><br />
          <label for="password2">Password (retype):</label>
          <input type="password" id="password2" name="password2" /><br />
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" /><br /><br />
          <!--captcha-->
          <label for="verify">Verification:</label>
          <input type="text" id="verify" name="verify" value="Enter the pass-phrase." /> 
          &nbsp; &nbsp;<img src="captcha.php" alt="Verification pass-phrase" />
        </fieldset>
        <input class="submit" type="submit" name="submit" value="Submit" />
      </form>
    </div>
  </div>
  
<?php
   }
?>

<?php
    //insert the page footer
    require_once('footer.php');
?>
