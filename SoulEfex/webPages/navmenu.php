<?php
    //generate the navigation menu
    echo '<div class="navibar">';
    if (isset($_SESSION['username'])) {
        echo '<a href="editprofile.php">Edit Profile</a>  &nbsp; &nbsp;';
        echo '<a href="viewprofile.php">View Profile</a>  &nbsp; &nbsp;';
        echo '<a href="submit.php">Submit</a>  &nbsp; &nbsp;';
        echo '<a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a> &nbsp;';
    }
    else {
        echo '<a href="login.php">Log In</a>  ';
        echo '<a href="signup.php">Sign Up</a>';
    }
    echo '</div>';
?>