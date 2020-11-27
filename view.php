<?php
require_once "pdo.php";
session_start();


 if(isset($_POST['cancel'])){
     header("Location: mainpage.php");
     return;
}

if(isset($_POST['logout'])){
     header("Location: logout.php");
     return;
}


if(isset($_POST['edit'])){
     header("Location: edit.php?student_id=".urlencode($_GET['student_id']));
     return;
}

// Guardian: Make sure that auto_id is present
if ( !isset($_GET['student_id']) ) {
  $_SESSION['error'] = "Missing Student ID";
  header("Location: mainpage.php");
  return;
}
// $_SESSION['Student_ID'] = $_GET['student_id'];
// $_SESSION['student'] = $_GET['student_id'];
$stmt = $pdo->prepare("SELECT * FROM profile where STUDENT_ID = :xyz");
$stmt->execute(array(":xyz" => $_GET['student_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for Student ID';
    header("Location: mainpage.php") ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

    $Cou =  htmlentities($row['course']);
    $Col =  htmlentities($row['college']);
    $Stu =  htmlentities($row['STUDENT_ID']);
    $Lna =  htmlentities($row['Lname']);
    $Fna =  htmlentities($row['Fname']);
    $Mna =  htmlentities($row['Mname']);
    $Bir =  htmlentities($row['bday']);
    $Gen =  htmlentities($row['gender']);
    $Nat =  htmlentities($row['nationality']);
    $Hei =  htmlentities($row['height']);
    $Wei =  htmlentities($row['weight']);
    $Lan =  htmlentities($row['landline']);
    $Mob =  htmlentities($row['mobile']);
    $AdP =  htmlentities($row['addressP']);
    $CiP =  htmlentities($row['cityP']);
    $ZiP =  htmlentities($row['zipcodeP']);
    $Cbi =  htmlentities($row['countryBirth']);
    $Sta =  htmlentities($row['civilStatus']);
    $SSR =  htmlentities($row['ssrn']);
    $Ema =  htmlentities($row['email']);
    $AdA =  htmlentities($row['addressA']);
    $CiA =  htmlentities($row['cityA']);
    $ZiA =  htmlentities($row['countryzipcodeA']);
    $Pas =  htmlentities($row['passport']);
    $PaE =  htmlentities($row['passportExpiry']);
    $PlI =  htmlentities($row['placeIssuance']);
    $Arr =  htmlentities($row['latestArrival']);
    $Fli =  htmlentities($row['flightNumber']);
    $Sty =  htmlentities($row['lastStay']);
    $Acr =  htmlentities($row['acr']);
    $AcI =  htmlentities($row['acrIssuance']);
    $AcE =  htmlentities($row['acrExpiry']);
    $Crn =  htmlentities($row['crn']);
    $GNa =  htmlentities($row['Gname']);
    $GRe =  htmlentities($row['Grelationship']);
    $GAd =  htmlentities($row['GaddressP']);
    $GZi =  htmlentities($row['GzipcodeP']);
    $GCi =  htmlentities($row['GcityP']);
    $GCo =  htmlentities($row['Gcountryzipcode']);
    $GLa =  htmlentities($row['Glandline']);
    $GMo =  htmlentities($row['Gmobile']);
?>
<html>
<head>
<link rel="stylesheet"  href="css/view.css">
<title>View</title>
</head>
<body>
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
  <!-- <input type="submit" name="logout" value="Logout"> -->     <!-- Logout Button -->
  <!--▲▲▲ Tab Design ▲▲▲-->


<h1 class = "HeaderFont">>
    <?php  
    echo($_GET['student_id']);
    ?>
</h1>  



<p>
<?php
//    if ( isset($_SESSION['error']) ) {
//     echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
//     unset($_SESSION['error']);
// }
//    if ( isset($_SESSION['success']) ) {
//     echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
//     unset($_SESSION['success']);
// }
?>
</p>
<!--▼▼▼ Basic Info Design ▼▼▼-->
<div class="BasicInfoBx">
<?php
 echo('<p class="CollegeTxt"><strong> College: </strong>'.$Col. '</p>');
 echo('<p class="CourseTxt"><strong> Course: </strong>'.$Cou. '</p>');
 
 echo('<p class="StudentNumTxt"><strong> Student Number: </strong>'.$Stu. '</p>');
?>  
</div>
<!--▲▲▲ Basic Info Design ▲▲▲-->

<!--▼▼▼ Personal Info Design ▼▼▼-->
<div class="PersonaInfoBx">
<?php
 echo('<h2 class="PersonaInfo">I. Personal Information</h2>');
 echo('<p class="LastNameTxt"><strong> Last Name: </strong>'.$Lna. '</p>');
 echo('<p class="FirstNameTxt"><strong> First Name: </strong>'.$Fna. '</p>');
 echo('<p class="MiddleNameTxt"><strong> Middle Name: </strong>'.$Mna. '</p>');

 echo('<p class="BirthDateTxt"><strong> Date of Birth: </strong>'.$Bir. '</p>');
 echo('<p class="Gender"><strong> Gender: </strong>'.$Gen. '</p>');

 echo('<p class="NationalityTxt"><strong> Citezenship/Nationality: </strong>'.$Nat. '</p>');
 echo('<p class="HeightTxt"><strong> Height: </strong>'.$Hei. '</p>');
 echo('<p class="WeightTxt"><strong> Weight: </strong>'.$Wei. '</p>');

 echo('<h3 class="ContactFont"><u>Contact Number(s) in the Philippines</u></h3>');
 echo('<p class="LandlineTxt"><strong> Landline: </strong>'.$Lan. '</p>');
 echo('<p class="MobileTxt"><strong> Mobile: </strong>'.$Mob. '</p>');

 echo('<h3 class="ResidentFont"><u>Residential Address in the Philippines</u></h3>');
 echo('<p class="StreetTxt"><strong> House/Unit No., Street, Subdivision/Village: </strong>'.$AdP.'</p>');
 echo('<p class="CityTxt"><strong> Barangay, Municipality/City: </strong>'.$CiP.'</p>');
 echo('<p class="ZipCodeTxt"><strong> Province, Zip Code: </strong>'.$ZiP.'</p>');

 echo('<p class="CountryBirthTxt"><strong> Country of Birth: </strong>'.$Cbi.'</p>');
 echo('<p class="CivilStatTxt"><strong> Civil Status: </strong>'.$Sta.'</p>');

 echo('<p class="SSSTxt"><strong> Special Security Registration Number(SSRN): </strong>'.$SSR.'</p>');
 echo('<p class="EmailTxt"><strong> Email Address: </strong>'.$Ema.'</p>');

 echo('<h3 class="ResidentAbrFont"><u>Residential Address Abroad</u></h3>');
 echo('<p class="StreetAbrTxt"><strong> House/Unit No., Street, Subdivision/Village: </strong>'.$AdA.'</p>');
 echo('<p class="CityAbrTxt"><strong> Barangay, Municipality/City: </strong>'.$CiA.'</p>');
 echo('<p class="ZipCodeAbrTxt"><strong> Province, Zip Code: </strong>'.$ZiA.'</p>');

?>
</div>
<!--▲▲▲ Personal Info Design ▲▲▲-->

<!--▼▼▼ Travel Info Design ▼▼▼-->
<div class="TravelInfoBx">
<?php
 echo('<h2 class="TravelInfo">II. Travel Information</h2>');
 echo('<p class="PassportTxt"><strong> Passport Number: </strong>'.$Pas.'</p>');
 echo('<p class="ExpiryTxt"><strong> Expiry Date/Valid Until: </strong>'.$PaE.'</p>'); 
 echo('<p class="IssuePlaceTxt"><strong> Place of Issuance: </strong>'.$PlI.'</p>');

 echo('<p class="ArrivalDateTxt"><strong> Date of Latest Arrival: </strong>'.$Arr.'</p>');
 echo('<p class="FlightNumTxt"><strong> Flight Number: </strong>'.$Fli.'</p>');
 echo('<p class="LastDayTxt"><strong> Last Day of Authorized Stay: </strong>'.$Sty.'</p>');
?>
</div>
<!--▲▲▲ Travel Info Design ▲▲▲-->

<!--▼▼▼ ACR I-CARD Design ▼▼▼-->
<div class="ACRBx">
<?php 
 echo('<h2 class="ACR">III. ACR I-CARD</h2>');
 echo('<p class="ACRNumTxt"><strong> Alien Certificate of Registration (ACR) Number: </strong>'.$Acr.'</p>');
 echo('<p class="ACRIssueDateTxt"><strong> Date of Issuance: </strong>'.$AcI.'</p>');
 echo('<p class="ValidDateTxt"><strong> Expiry Date/Valid Until: </strong>'.$AcE.'</p>');
 echo('<p class="CertNumTxt"><strong> Certificate of Residence Number (CRN): </strong>'.$Crn.'</p>');
?>
</div>
<!--▲▲▲ ACR I-CARD Design ▲▲▲-->

<!--▼▼▼ Guardian's Information Design ▼▼▼-->
<div class="GuardBx">
<?php
 echo("<h2 class='GuardInfo'>IV. Guardian's Information</h2>");
 echo('<p class="GuardNameTxt"><strong> Name of Guardian (Last Name,First Name, Middle Name): </strong>'.$GNa.'</p>');
 echo('<p class="RelationTxt"><strong> Relationship with the Applicant: </strong>'.$GRe.'</p>');

 echo('<h3 class="GuardResidentFont"><u>Residential Address in the Philippines</u></h3>');
 echo('<p class="GuardAddressTxt"><strong> House/Unit No., Street, Subdivision/Village: </strong>'.$GAd.'</p>');
 echo('<p class="GuardZipTxt"><strong> Province, Zip Code: </strong>'.$GZi.'</p>');

 echo('<p class="GuardCityTxt"><strong> Barangay, Municipality/City: </strong>'.$GCi.'</p>');
 echo('<p class="GuardCountryTxt"><strong> Country, Zip Code: </strong>'.$GCo.'</p>');

 echo('<h3 class="GuardContactFont"><u>Contact Number(s) in the Philippines</u></h3>');
 echo('<p class="GuardLandlineTxt"><strong> Landline: </strong>'.$GLa.'</p>');
 echo('<p class="GuardMobileTxt"><strong> Mobile: </strong>'.$GMo.'</p>');

?>
</div>
<!--▲▲▲ Guardian's Information Design ▲▲▲-->

<form method="POST">
  <input type="submit" class="EditBtn" name="edit" value="Edit">
  <input type="submit" class="CancelBtn" name="cancel" value="Cancel" formnovalidate>
</form>

<div class="EndLine"></div>
</body>
</html>