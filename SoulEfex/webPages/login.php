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
    require_once('connectvars.php');
    
    //insert the page header
    $page_title = 'Log In';

    //start the session
    session_start();

    //clear the error message
    $error_msg = "";

    //if the user isn't logged in, try to log them in
    if (!isset($_SESSION['user_id'])) {
        if (isset($_POST['submit'])) {
        //connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        //grab the user-entered log-in data
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            if (!empty($user_username) && !empty($user_password)) {
                //look up the username and password in the database
                $query = "SELECT user_id, username FROM members " . 
                        "WHERE username = '$user_username' AND password = SHA('$user_password')";
                $data = mysqli_query($dbc, $query);

                if (mysqli_num_rows($data) == 1) {
                    //the log-in is OK so set the user ID and username session vars (and cookies) 
                    //and redirect to the home page
                    $row = mysqli_fetch_array($data);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
                    setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/membershome.php';
                    header('Location: ' . $home_url);
                }
                else {
                    //the username/password are incorrect so set an error message
                    $error_msg = 'Sorry, you must enter a valid username and password to log in.';
                }
            }
            else {
                //the username/password weren't entered so set an error message
                $error_msg = 'Sorry, you must enter your username and password to log in.';
            }
        }
    }

    //if the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
    if (empty($_SESSION['user_id'])) {
        echo '<p class="error">' . $error_msg . '</p>';
?>
  
  <div id="setHeightLogin">
    <div class="center">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
          <label for="username">Username:</label>
          <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
          <label for="password">Password:</label>
          <input type="password" name="password" /><br />
        </fieldset>
        <input type="submit" value="Log In" name="submit" />
      </form>
    </div>  
  </div>
  <br />
  
<?php
    }
    else {
        //confirm the successful log-in
        echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '.</p>');
    }
?>

<?php
    //insert the page footer
    require_once('footer.php');
?>