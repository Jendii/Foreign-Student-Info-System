<?php
session_start();
 require_once "pdo.php";
// Demand a GET parameter
if ( ! isset($_SESSION['saoname'])) {
    die('Name parameter missing');
}
if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}

if ( isset($_POST['AddStudent']) ) {
    header("Location: AddStudent.php");
    return;
}

$stmt = $pdo->prepare("SELECT * FROM SAO where NU_ID = :xyz");
$stmt->execute(array(":xyz" => $_SESSION['sao']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ( $row === false) {
    $_SESSION['error'] = 'User does not exist';
    header( 'Location: login.php' ) ;
    return;
}

// $n = htmlentities($row['name']);

?>

<html>
<head>
<link rel="stylesheet"  href="css/main.css">
<title>Main Page</title>
</head>
<body>
<div>
	<!--▼▼▼ Header Design ▼▼▼-->
	<div class="HeaderNU"></div>
	<div class="HeaderImage"></div>
	<img src="/NU/assets/NU LOGO2.png" class="NuLogo">
	<img src="/NU/assets/EducTW.png" class="TagLine">
	<div class="HeaderTxt">Foreign Student Information</div>
	<!--▲▲▲ Header Design ▲▲▲-->

	<!--▼▼▼ Tab Design ▼▼▼-->
	<div class="TabBar"></div>
	<div class="TabName">Welcome 
	 <?php
      echo ($_SESSION['saoname']);
    ?> 
	</div>
	
	<img src="/NU/assets/exit.png" class="LogOutIcn"> 
  <form method="POST">
    <!-- <div class="LogOutBtn">Logout</div>  -->
    <input type="submit" name="logout" value="Logout" class="LogOutBtn">
  </form>
									<!-- Logout Button Text Only -->
	<!-- <input type="submit" class="LogOutBtn" value="Logout"> -->  		<!-- Logout Button -->
	<!--▲▲▲ Tab Design ▲▲▲-->

	<!--▼▼▼ Search Bar & Add Student Design ▼▼▼-->
	<div class="SearchStdntTxt">Search Student:</div>
	<form method="POST">
		<input type="text" id="nam" class="StudentSearch" placeholder="Enter Student ID" name="search">
		<input type="submit" class="SearchBtn" value="Search" name="btnsearch">
		<input type="submit" class="AddStdntBtn" name="AddStudent" value="+ Student">
	</form>
	
	<!--▲▲▲ Search Bar & Add Student Design ▲▲▲-->


<div class="ListBG1">

	<?php
	ob_start();
	if (empty($_POST['search']) || isset($_POST['back'])){
	
	
		echo('<table id="myTable">'."\n");
		$stmt3 = $pdo->query("SELECT STUDENT_ID,college, course,Lname,Fname,Mname FROM profile ORDER BY STUDENT_ID ASC");
		$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
		if($row3){
		    echo("<tr><th><strong>Student Number</strong></th>
		      <th><strong>Student Name</strong></th>
		      <th><strong>College</strong></th>
		      <th><strong>Course</strong></th>
		      <th><strong>ACR Expiry</strong></th></tr>");
		    $stmt4 = $pdo->query("SELECT STUDENT_ID,college, course,Lname,Fname,Mname,acrExpiry
		     FROM profile ORDER BY STUDENT_ID ASC");
		    while ( $row4 = $stmt4->fetch(PDO::FETCH_ASSOC) ) {
		    echo ("<tr><td>");
		    echo('<a href="view.php?student_id='.$row4['STUDENT_ID'].'">');
		    echo($row4['STUDENT_ID']."</a></td><td>");
		    echo(htmlentities($row4['Fname']).' '.htmlentities($row4['Mname']).' '.
		        htmlentities($row4['Lname']));
		    echo("</td><td>");
		    echo(htmlentities($row4['college']));
		    echo("</td><td>");
		    echo(htmlentities($row4['course']));
		    echo("</td><td>");
		    echo(htmlentities($row4['acrExpiry']));
		    echo("</td></tr>\n");
		    }
		    }
		    }


if (isset($_POST['btnsearch']) && !empty($_POST['search'])) {
ob_clean(); 
$SID = htmlentities($_POST['search']);

 $stmt1 = $pdo->prepare("SELECT STUDENT_ID,college, course,Lname,Fname,Mname FROM profile where STUDENT_ID = :student_id");
                $stmt1->execute(array(":student_id" => $SID));
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    if($row1){
        echo('<form method="POST"><input type="submit" name="back" value="← Back"></form>');
        echo('<table>'."\n");
        echo("<tr><th><strong>Student Number</strong></th>
          <th><strong>Student Name</strong></th>
          <th><strong>College</strong></th>
          <th><strong>Course</strong></th>
          <th><strong>ACR Expiry</strong></th></tr>");
        $stmt2 = $pdo->prepare("SELECT STUDENT_ID,college, course,Lname,Fname,Mname, acrExpiry
         FROM profile WHERE STUDENT_ID = :awxyz");
        $stmt2->execute(array(":awxyz" => $_POST['search']));
        while ( $row2 = $stmt2->fetch(PDO::FETCH_ASSOC) ) {
        echo ("<tr><td>");
        echo('<a href="view.php?student_id='.$row2['STUDENT_ID'].'">');
        echo($row2['STUDENT_ID']."</a></td><td>");
        echo(htmlentities($row2['Fname']).' '.htmlentities($row2['Mname']).' '.
            htmlentities($row2['Lname']));
        echo("</td><td>");
        echo(htmlentities($row2['college']));
        echo("</td><td>");
        echo(htmlentities($row2['course']));
        echo("</td><td>");
        echo(htmlentities($row2['acrExpiry']));
        echo("</td></tr>\n");
        } 
         // end while row2
      // }
        echo("</table>");
	} // end if student exist
if ( $row1 === false ) {
    $_SESSION['error'] = 'Student Not Exist';
    header("Location: mainpage.php") ;
    return;
} // end if student not exist
} // end if empty


// if ( isset($_SESSION['success']) ) {
//     echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
//     unset($_SESSION['success']);
// }

// if ( isset($_SESSION['error']) ) {
//     echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
//     unset($_SESSION['error']); 
// }


?>
	</div>

</div>

</body>