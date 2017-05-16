<?php
    // Start the session
    require_once('startsession.php');

    // Insert the page header
    $page_title = 'View Profile';
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

    // Grab the profile data from the database
    if (!isset($_GET['user_id'])) {
        $query = "SELECT username, first_name, last_name, age, city, state, " . 
            "country FROM members WHERE user_id = '" . $_SESSION['user_id'] . "'";
    }
    else {
        $query = "SELECT username, first_name, last_name, age, city, state, " . 
                "country FROM members WHERE user_id = '" . $_GET['user_id'] . "'";
    }
    $data = mysqli_query($dbc, $query);

    if (mysqli_num_rows($data) == 1) {
        // The user row was found so display the user data
        $row = mysqli_fetch_array($data);
        echo '<br/><br/><div id="setHeightProfile">';
        echo '<center><table>';
        if (!empty($row['username'])) {
            echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
        }
        if (!empty($row['first_name'])) {
            echo '<tr><td class="label">First name:</td><td>' . $row['first_name'] . '</td></tr>';
        }
        if (!empty($row['last_name'])) {
            echo '<tr><td class="label">Last name:</td><td>' . $row['last_name'] . '</td></tr>';
        }
        if (!empty($row['age'])) {
            echo '<tr><td class="label">Age:</td><td>' . $row['age'] . '</td></tr>';
        }
        if (!empty($row['city']) || !empty($row['state'])) {
            echo '<tr><td class="label">Location:</td><td>' . $row['city'] . ', ' . $row['state'] . '</td></tr>';
        }
            echo '</table></center>';
        if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id'])) {
            echo '<center><p>Would you like to <a href="editprofile.php">edit 
                 your profile</a>?</p></center></div>';
        }
    } // End of check for a single row of user results
    else {
        echo '<p class="error">There was a problem accessing your profile.</p>';
    }

    mysqli_close($dbc);
?>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
