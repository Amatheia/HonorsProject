<?php
    //if the user is logged in, delete the session vars to log them out
    session_start();
    if (isset($_SESSION['user_id'])) {
        //delete the session vars by clearing the $_SESSION array
        $_SESSION = array();

        //delete the session cookie by setting its expiration to an hour ago (3600)
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600);
        }

        //destroy the session
        session_destroy();
    }

    //delete the user ID and username cookies by setting their expirations to an hour ago (3600)
    setcookie('user_id', '', time() - 3600);
    setcookie('username', '', time() - 3600);

    //redirect to the home page
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.html';
    header('Location: ' . $home_url);
?>