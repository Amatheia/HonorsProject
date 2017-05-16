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
            <div id="setHeightLogin">
              <p>Your images and articles will appear here once submitted and 
                 approved.</p>
            </div>     
        </article>
    </section>
</body>    

<?php
    //insert the page footer
    require_once('footer.php');
?>