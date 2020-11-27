<?php 
require_once "pdo.php";
session_start();
// Check to see if we have some POST data, if we do process it
if ( isset($_POST['who']) && isset($_POST['pass']) ) {

    $ID = htmlentities($_POST['who']);
    $PassW = htmlentities($_POST['pass']);
    $hashed_password = sha1($PassW);

            $stmt = $pdo->prepare("SELECT * FROM SAO where NU_ID = :nu_id");
            $stmt->execute(array(":nu_id" => $ID));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ( $row === false ) {

                    $stmtS = $pdo->prepare("SELECT * FROM profile where STUDENT_ID = :stud_id");
                    $stmtS->execute(array(":stud_id" => $ID));
                    $rowS = $stmtS->fetch(PDO::FETCH_ASSOC);
                    if ($rowS === false) {
                        $_SESSION['error'] = 'Incorrect User ID and Password';
                        header("Location: login.php");
                        return;
                    }

                    else if($rowS){
                        $stmtS2 = $pdo->prepare("SELECT * FROM profile where bday = :stud_pass");
                        $stmtS2->execute(array(":stud_pass" => $PassW));
                        $rowS2 = $stmtS2->fetch(PDO::FETCH_ASSOC);
                        if ($rowS2 === false) {
                            $_SESSION['error'] = 'Incorrect User ID and Password';
                            header("Location: login.php");
                            return;
                        }
                    else{
                        $_SESSION['student'] = $ID;
                        header("Location: studentView.php");
                        return;
                    }
                    
                } // END CHECK STUDENT PASSWORD
                       
            } // END CHECK IF NOT SAO 


            else {
                $stmt2 = $pdo->prepare("SELECT * FROM SAO where Password = :pass");
                $stmt2->execute(array(":pass" => $hashed_password));
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                if ( $row2 === false ) {
                            $_SESSION['error'] = 'Incorrect Password';
                            header("Location: login.php");
                            return;
                    }
                   
                    else if ($row2){
                        $_SESSION['sao'] = $ID;
                        $_SESSION['saoname'] = htmlentities($row2['name']);
                        // header("Location: mainpage.php?name=".urlencode($_SESSION['sao']));
                        header("Location: mainpage.php");
                        return;
                    }  
                } // END CHECK SAO PASSWORD 
} // end if set

?>
<html>
<head>
    <link rel="stylesheet" href="css/login.css">
<title>Login Page</title>
</head>
<body>
<div class="container">

<img src="/NU/assets/NU LOGO2.png" class="NuLogo">
<img src="/NU/assets/EducTW.png" class="TagLine">

<div class="LoginBx"></div> 
    <div id="AccountHdr">Account Login</div>
    <div class="line"></div>

<form method="POST">
    <input type="text" name="who" id="nam" class="UsernameTxt" placeholder="User ID" required>
    <br/>               <!-- User ID Text Box -->
    <input type="password" name="pass" id="id_1723" class="PasswordTxt" placeholder="Password" required>
    <br/>   <!-- Password Text Box -->
    
    <input type="submit" class="LoginBtn" value="Login">   
 <div id="Error">          
        <?php
        // Flash pattern
        if ( isset($_SESSION['error']) ) {
             echo(htmlentities($_SESSION['error']));
            unset($_SESSION['error']);
        }
        ?>
    </div>   
</form>
   
</div>
</body>
