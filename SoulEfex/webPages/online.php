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
          <h2>Submissions</h2>
        <br />
        <div id="setSubmitHeight">
          <div class="center">
            <p id="subtype">Please choose a submission type and view its requirements.</p>
          </div>  
        <br />  
          <div id="buttons">
            <a href="art.php"><button class="button">Art/Photo Submission</button></a>
            <a href="articles.php"><button class="button">Writing Submission</button></a>
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