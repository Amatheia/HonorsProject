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
        echo '<p class="login">Please <a href="login.php">log in</a> to access 
             this page.</p>';
        exit();
    }
    
    //show the navigation menu
    require_once('navmenu.php');
?>

    <section>
      <article>
        <br />
          <h2>Online Art/Photo Submissions</h2>
        <br />  
      </article>
    </section>
  
    <section>
      <article>
        <div id="requirements">
          <p>Please read all requirements prior to submitting. All submissions are 
           subjected to review. Submission does not mean acceptance. 
           Content must be relevant to Soul Efex audience. Please only submit your 
           best work.</p>
           <br />
            <h3>Art/Photo requirements</h3>
            <p>You are the copyright holder to 
            the image(s) being submitted. Image(s) should not contain any visual 
            watermark/text/graphic overlays. Image(s) should be provided as 
            individual, high-qualify JPEG files in the RGB color space. Image(s) 
            are 1200 pixels on its longest side; resolution is set at 72dpi. 
            Please combine all image files into a single ZIP file. Image(s) 
            should be less than 20MB total. Please provide all credit information. 
            If you are submitting multiple images with different team members, 
            please note each image with their own credits.</p>
        <br />
        </div>
      </article>
    </section>

<?php

    if (isset($_POST['submit'])) {

        //grab the data from the POST
        $submission_type = $_POST['submissiontype'];
        $title = $_POST['title'];
        $credits = $_POST['credits'];
        $shortbio = $_POST['shortbio'];
        $copyright = $_POST['copyright'];
        $review = $_POST['review'];
        $zipfile = $_FILES['zipfile']['name'];
        $zipfile_type = $_FILES['zipfile']['type'];
        $zipfile_size = $_FILES['zipfile']['size'];
        $output_form = 'no';


        if (empty($submission_type) || empty($title) || empty($credits)
            || empty($shortbio) || empty($zipfile) || empty($copyright)
            || empty($review)) {
            //message to user - at least one of the input fields is blank 
            echo 'Please fill out all of the information.<br /><br />';
            $output_form = 'yes';
        }
    } else {
        $output_form = 'yes';
    }

    if (!empty($submission_type) && !empty($title) && !empty($credits)
        && !empty($shortbio) && !empty($zipfile) && !empty($copyright)
        && !empty($review)) {
        //connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);      

            //http://www.sitepoint.com/web-foundations/mime-types-summary-list/        
            if ((($zipfile_type == 'application/octet-stream') 
            || ($zipfile_type == 'application/zip')
            || ($zipfile_type == 'application/x-compressed-zip'))
            && ($zipfile_size > 0) && ($zipfile_size <= SE_MAXFILESIZE)) {
                if ($_FILES['zipfile']['error'] == 0) {
                    //move the file to the target upload folder
                    $target = SE_UPLOADPATH . $zipfile;
                    if (move_uploaded_file($_FILES['zipfile']['tmp_name'], $target)) {
                        //write the data to the database
                        $query1 = "INSERT INTO submissions (user_id, date, " . 
                                 "submission_type, title, zipfile, short_bio, " . 
                                 "copyright, review)" . 
                                 "VALUES ('" . $_SESSION['user_id']. "', NOW(), " . 
                                 "'$submission_type', '$title', " . 
                                 "'$zipfile', '$shortbio', '$copyright', '$review' )";
                        $query2 = "INSERT INTO credits (credits) VALUES ('$credits')";
                        mysqli_query($dbc, $query1)
                                or die ('Data not inserted.');
                        $id1 = mysqli_insert_id($dbc);        
                        mysqli_query($dbc, $query2)
                                or die ('Data not inserted.');
                        $id2 = mysqli_insert_id($dbc);
                        
                        $query3 = "INSERT INTO sub_credits (submit_id,credits_id) " . 
                                  "VALUES ('$id1','$id2')";
                        mysqli_query($dbc, $query3) 
                                or die ('Data not inserted.');
                                
                        $query4 = "INSERT INTO online_submit (submit_id) " .
                                  "VALUES ('$id1')";
                        mysqli_query($dbc, $query4) 
                                or die ('Data not inserted.');
                        $id4 = mysqli_insert_id($dbc);        
                                
                        $query5 = "INSERT INTO online_art_submissions (online_submit_id, title) " .
                                  "VALUES ('$id4', '$title')";
                        mysqli_query($dbc, $query5) 
                                or die ('Data not inserted.');                     
                
                        mysqli_close($dbc);
                        
                        echo '<meta http-equiv="refresh" content="0; 
                             URL=submissionconfirmation.php">';

                        //clear the data to clear the form
                        $title = "";
                        $credits = "";
                        $shortbio = "";
                        $zipfile = "";
                    }
                    else {
                        echo '<p class="error">Sorry, there was a problem uploading 
                            your submission.</p>';
                    }

                }
            }
            else {
                echo '<p class="error">The ZIP file must be no greater than ' 
                . (SE_MAXFILESIZE / 1048576) . ' MB in size.</p>';
            }

    }
    
    if ($output_form == 'yes') {
?>
  <div class="formrow">
    <form enctype="multipart/form-data" id="submit" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo SE_MAXFILESIZE; ?>" />
        <label for="submissiontype">Submission Type:</label>
        <select id="submissiontype" name="submissiontype">
          <option value="Art" <?php if (!empty($submissiontype) && $submissiontype == 'Art') echo 'selected = "selected"'; ?>>Art</option>
          <option value="Photography" <?php if (!empty($submissiontype) && $submissiontype == 'Photography') echo 'selected = "selected"'; ?>>Photography</option>
        </select><br />
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php if (!empty($title)) echo $title; ?>" /><br />
        <label for="credits">Credits:</label>
        <textarea id="credits" name="credits" rows="10" cols="50" wrap="hard"><?php if (!empty($credits)) echo $credits; ?></textarea><br />
        <br />
        <label for="shortbio">Short Bio:</label>
        <textarea id="shortbio" name="shortbio" rows="10" cols="50" wrap="hard"><?php if (!empty($shortbio)) echo $shortbio; ?></textarea><br />
        <label for="zipfile">Submission ZIP File:</label>
        <input type="file" id="zipfile" name="zipfile" /><br /><br />
        <label for="copyright">Copyright Declaration:</label>
        <span><input type="checkbox" name="copyright" value="copyright">
              I declare that I am the copyright-holder of the images being submitted for review, 
              and/or that I have the permission of the copyright-holder to submit the images for review.</span><br /><br />
        <label for="review">Review Acknowledgement:</label>
        <span><input type="checkbox" name="review" value="review">
              I understand that submission does not mean acceptance; and that all 
              submissions are subjected to review.</span><br />
  </div>          
      <div class="center">              
        <input class="submit" type="submit" value="Submit" name="submit" />
      </div>    
    </form>

  <div id="requirements">
        <p>Notice: If accepted, we will contact you by email and send you a release 
         that must be signed and returned with the accepted photos. 
         Selected photos must be sent back in high res 300dpi, size 8.5x11.
         Instructions will be provided in the email.</p>
  </div>         

<?php
    }
?>

</body>
</html>

<?php
    //insert the page footer
    require_once('footer.php');
?>