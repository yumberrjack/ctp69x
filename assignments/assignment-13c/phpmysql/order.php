<?php

    $loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

    if ($loggedIn) {
        $email = $_SESSION['email'];
        $fname = $_SESSION['fname'];
    }

    $action = empty($_POST['action']) ? '' : $_POST['action'];

    if ($action == 'do_order') {
        handle_order();
    } else {
        $error = "Error in order form POST action";
        exit;
    }

    function handle_order() {
        
        require_once "db.conf";
        
        $title = empty($_POST['title']) ? '' : $_POST['title'];
        $interests = empty($_POST['interests']) ? '' : $_POST['interests'];
        $quote1 = empty($_POST['quote1']) ? '' : $_POST['quote1'];
        $quote2 = empty($_POST['quote2']) ? '' : $_POST['quote2'];
        $songname1 = empty($_POST['songname1']) ? '' : $_POST['songname1'];
        $artist1 = empty($_POST['artist1']) ? '' : $_POST['artist1'];
        $songname2 = empty($_POST['songname2']) ? '' : $_POST['songname2'];
        $artist2 = empty($_POST['artist2']) ? '' : $_POST['artist2'];
        $songname3 = empty($_POST['songname3']) ? '' : $_POST['songname3'];
        $artist3 = empty($_POST['artist3']) ? '' : $_POST['artist3'];
        $songname4 = empty($_POST['songname4']) ? '' : $_POST['songname4'];
        $artist4 = empty($_POST['artist4']) ? '' : $_POST['artist4'];
        $songname5 = empty($_POST['songname5']) ? '' : $_POST['songname5'];
        $artist5 = empty($_POST['artist5']) ? '' : $_POST['artist5'];
        $songname6 = empty($_POST['songname6']) ? '' : $_POST['songname6'];
        $artist6 = empty($_POST['artist6']) ? '' : $_POST['artist6'];
        
        $orderquery = "INSERT INTO orders (email, fname, title, interests, quote1, quote2, songname1, artist1, songname2, artist2, songname3, artist3, songname4, artist4, songname5, artist5, songname6, artist6) VALUES ('$email', '$fname', '$title', '$interests', '$quote1', '$quote2', '$songname1', '$artist1', '$songname2', '$artist2', '$songname3', '$artist3', '$songname4', '$artist4', '$songname5', '$artist5', '$songname6', '$artist6')";
         
        $orderresult = $mysqli->query($orderquery);
        
        if($orderresult) {
            setcookie("order", "success");
            header("Location: ../order.html");
            exit;
        } else {
            header("Location: ../order.html");
            exit;
        }
        
    }

    $orderresult->close();
    $mysqli->close();
?>