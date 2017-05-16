<?php
    //start the session
    require_once('startsession.php');

    //insert the page header
    $page_title = 'Home';
    require_once('header.php');

    require_once('appvars.php');
    require_once('connectvars.php');
    
    //make sure the user is logged in before going any further.
    if (!isset($_SESSION['user_id'])) {
        echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
        exit();
    }
    
    //show the navigation menu
    require_once('navmenu.php');
?>

    <section>
      <article>
        <div id="confirmation">
        <p>Thank you for your submission!</p>
        <p>It will be reviewed in the order in which it was received.
           Email notifications are provided only for selected content.</p>
        </div>
      </article>
    </section>
    
</body>
</html>

<?php
    //insert the page footer
    require_once('footer.php');
?>    