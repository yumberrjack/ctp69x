<?php
    //used alot of Proffessor Wergeles code here for the login
    if(!session_start()) {
        header("Location: ../home.html");
        exit;
    }

    $loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

    if ($loggedIn) {
        header("Location: order.html");
        exit;
    }

    $action = empty($_POST['action']) ? '' : $_POST['action'];

    if ($action == 'do_login') {
        handle_login();
    } else if ('do_registration') {
        handle_registration();
    } else {
        $error = "Error in POST action";
        exit;
    }
    function handle_login() {
        
        require_once "db.conf";
        
        $emaillogin = empty($_POST['emaillogin']) ? '' : $_POST['emaillogin'];
        $passwordlogin = empty($_POST['passwordlogin']) ? '' : $_POST['passwordlogin'];
        
        $loginquery = "SELECT id FROM users WHERE email = '$emaillogin' AND userPassword = '$passwordlogin'";

        $resultlogin = $mysqli->query($loginquery);
        
        if($resultlogin) {
            $match = $resultlogin->num_rows;
            
            if($match == 1){
                setcookie("email", $emaillogin);
                $fnamequery = "SELECT fname FROM users WHERE email = '$email'";
                $fnameresult = $mysqli->query($fnamequery);
                setcookie("fname", $fnameresult);
                header("Location: ../order.html");
                exit;
            } else {               
                $error = "Error: Incorrect email or password combination";
                header("Location: ../loginPage.html");
                exit;
            }
        }
    }

    function handle_registration() {
        
        require_once "db.conf";
        
        $emailreg = empty($_POST['emailreg']) ? '' : $_POST['emailreg'];
        $passwordreg = empty($_POST['passwordreg']) ? '' : $_POST['passwordreg'];
        $fname = empty($_POST['fname']) ? '' : $_POST['fname'];
        $lname = empty($_POST['lname']) ? '' : $_POST['lname'];
        $address1 = empty($_POST['address1']) ? '' : $_POST['address1'];
        $address2 = empty($_POST['address2']) ? '' : $_POST['address2'];
        $city = empty($_POST['city']) ? '' : $_POST['city'];
        $state = empty($_POST['state']) ? '' : $_POST['state'];
        $zip = empty($_POST['zip']) ? '' : $_POST['zip'];
        
        $regquery = "INSERT INTO users (email, userPassword, fname, lname, address1, address2, city, state, zip) values ('$emailreg', '$passwordreg', '$fname', '$lname', '$address1', '$address2', '$city', '$state', '$zip')";
         
        $resultreg = $mysqli->query($regquery);
        
        if($resultreg) {
            header("Location: ../order.html");
            $_SESSION['email'] = $emailreg;
            $_SESSION['fname'] = $fname;
            exit;
        } else {
            $error = "Error: Registration unsuccesful";
            header("Location: ../loginPage.html");
            exit;
        }
        
    }
    

    $resultreg->close();
    $resultlogin->close();
    $mysqli->close();
?>