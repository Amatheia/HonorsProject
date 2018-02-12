<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Edit Profile';
  require_once('header.php');

  require_once('appvars.php');
  require_once('connectvars.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (isset($_POST['submit'])) {
        // Grab the profile data from the POST
        $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
        $age = mysqli_real_escape_string($dbc, trim($_POST['age']));
        $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
        $state = mysqli_real_escape_string($dbc, trim($_POST['state']));
        $country = mysqli_real_escape_string($dbc, trim($_POST['country']));
        $error = false;

        // Update the profile data in the database
        if (!$error) 
        {
            if (!empty($first_name) && !empty($last_name) && !empty($age) 
            && !empty($city) && !empty($state) && !empty($country)) 
            {
                $query = "UPDATE members SET first_name = '$first_name', " . 
                         "last_name = '$last_name', age = '$age', " . 
                         "city = '$city', state = '$state', " . 
                         "country = '$country' " . 
                         "WHERE user_id = '" . $_SESSION['user_id'] . "'";

                mysqli_query($dbc, $query);

                // Confirm success with the user
                echo '<p>Your profile has been successfully updated. Would you 
                     like to <a href="viewprofile.php">view your profile</a>?</p>';

                mysqli_close($dbc);
                exit();
            }
            else 
            {
                echo '<p class="error">You must enter all of the profile data.</p>';
            }
        } // End of check for form submission
        else 
        {
            // Grab the profile data from the database
            $query = "SELECT first_name, last_name, age, city, state, country " . 
                    "FROM members WHERE user_id = '" . $_SESSION['user_id'] . "'";
            $data = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($data);

            if ($row != NULL) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $age = $row['age'];
                $city = $row['city'];
                $state = $row['state'];
                $country = $row['country'];
            }
            else 
            {
            echo '<p class="error">There was a problem accessing your profile.</p>';
            }
        }
    }
  mysqli_close($dbc);
?>
  <br />
  <br />
  <div id="setHeightProfile">
    <div class="center">
      <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'];)?>">
        <label for="firstname">First name:</label>
        <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
        <label for="lastname">Last name:</label>
        <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?php if (!empty($age)) echo $age; ?>" /><br />
        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php if (!empty($city)) echo $city; ?>" /><br />
        <label for="state">State:</label>
        <input type="text" id="state" name="state" value="<?php if (!empty($state)) echo $state; ?>" /><br />
        <label for="country">Country:</label>
        <input type="text" id="country" name="country" value="<?php if (!empty($country)) echo $country; ?>" /><br />
        <input class="submit" type="submit" value="Save Profile" name="submit" />
      </form>
    </div>
  </div>    

<?php
  // Insert the page footer
  require_once('footer.php');
?>
