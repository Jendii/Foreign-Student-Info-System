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

if(isset($_POST['save'])){
    $sql = "UPDATE profile SET course = :Course_ , college = :College_, 
            passport = :Passport_, passportExpiry = :PassExp_, 
            placeIssuance = :PlaceIssu_,
            latestArrival = :Arrival_, flightNumber = :Flight_, 
            lastStay = :Stay_, acr = :Acr_,
            acrIssuance = :AcrIssu_, acrExpiry = :AcrExp_, crn = :Crn_
            WHERE STUDENT_ID = :StudID_";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':Course_' => $_POST['course'],
        ':College_' => $_POST['college'],
        ':StudID_' => $_POST['studentnumber'],

        ':Passport_' => $_POST['passport'],
        ':PassExp_' => $_POST['passportexpiry'],
        ':PlaceIssu_' => $_POST['placeissuance'],
        ':Arrival_' => $_POST['latestarrival'],
        ':Flight_' => $_POST['flightnumber'],
        ':Stay_' => $_POST['laststay'],
        ':Acr_' => $_POST['acr'],
        ':AcrIssu_' => $_POST['acrissuance'],
        ':AcrExp_' => $_POST['acrexpiry'],
        ':Crn_' => $_POST['crn']
    ));
         $_SESSION['success'] = 'Record updated';
        header("Location: mainpage.php");
        return;
    
}

// Guardian: Make sure that student_id is present
if (isset($_SESSION['sao'])) {
    if ( ! isset($_GET['student_id']) ) {
    $_SESSION['error'] = "Missing Student ID";
    header("Location: mainpage.php");
    return;
    }   
}

$_SESSION['StudentID'] = $_GET['student_id'];

$stmt = $pdo->prepare("SELECT * FROM profile where STUDENT_ID = :wxyz");
$stmt->execute(array(":wxyz" => $_GET['student_id']));
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
    <link rel="stylesheet" href="css/edit.css">
<title>Edit</title>
</head>
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
  <!--▲▲▲ Tab Design ▲▲▲-->

<h1 class = "HeaderFont">>Edit Student Profile</h1>  
<!-- <p> -->
<?php
//    if ( isset($_SESSION['error']) ) {
//     echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
//     unset($_SESSION['error']);
// }
?>
<!-- </p> -->
<form method="post">
<!--▼▼▼ Basic Info Design ▼▼▼-->
<div class="BasicInfoBx"></div>

<label for="college" class="CollegeTxt"><span style="color: red; font-size:25px">*</span> College: </label>
<!-- <input type="text" name="college" class="CollegeBx"  value="<?= $Col ?>"required> -->
<select name="college" class="CollegeBx" required>
  <option class="It" selected disabled >--select--</option>
  <optgroup class="It" label="Undergraduate">
  <option class="It" value="College of Allied Health"
    <?php
      if($Col == 'College of Allied Health'){
        echo "selected";
      }
    ?>
  >College of Allied Health</option>
  <option class="It" value="College of Hospitality Management"
   <?php
        if($Col == 'College of Hospitality Management'){
          echo "selected";
        }
      ?>
  >College of Hospitality Management</option>
  <option class="It" value="College of Education,Arts and Sciences"
  <?php
        if($Col == 'College of Education,Arts and Sciences'){
          echo "selected";
        }
      ?>
  >College of Education,Arts and Sciences</option>
  <option class="It" value="College of Engineering"
  <?php
        if($Col == 'College of Engineering'){
          echo "selected";
        }
      ?>
  >College of Engineering</option>
  <option class="It" value="College of Dentistry"
  <?php
        if($Col == 'College of Dentistry'){
          echo "selected";
        }
      ?>
  >College of Dentistry</option>
  <option class="It" value="College of Computer Studies"
  <?php
        if($Col == 'College of Computer Studies'){
          echo "selected";
        }
      ?>
  >College of Computer Studies</option>
  <option class="It" value="College of Business and Accountancy"
   <?php
        if($Col == 'College of Business and Accountancy'){
          echo "selected";
        }
      ?>
  >College of Business and Accountancy</option>
  <option class="It" value="College of Architecture"
  <?php
        if($Col == 'College of Architecture'){
          echo "selected";
        }
      ?>
  >College of Architecture</option>
</select>


<label for="course" class="CourseTxt"><span style="color: red; font-size:25px">*</span> Course: </label>
<!-- <input type="text" name="course" class="CourseBx"  value="<?= $Cou ?>" required> -->
<select name="course" class="CourseBx" required>
  <option selected disabled>--select--</option>
  <optgroup label="College of Allied Health">
  <option value="Bachelor of Science in Medical Technology"
  <?php
        if($Cou == 'Bachelor of Science in Medical Technology'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Medical Technology</option>
  <option value="Bachelor of Science in Nursing"
  <?php
        if($Cou == 'Bachelor of Science in Nursing'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Nursing</option>
  <option value="Bachelor of Science in Pharmacy"
  <?php
        if($Cou == 'Bachelor of Science in Pharmacy'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Pharmacy</option>

  <optgroup label="College of Hospitality Management">
  <option value="Bachelor of Science in Hotel and Restaurant Management"
  <?php
        if($Cou == 'Bachelor of Science in Hotel and Restaurant Management'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Hotel and Restaurant Management</option>
  <option value="Bachelor of Science in Tourism Management"
  <?php
        if($Cou == 'Bachelor of Science in Tourism Management'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Tourism Management</option>

  <optgroup label="College of Education,Arts and Sciences">
  <option value="Bachelor in Elementary Education"
  <?php
        if($Cou == 'Bachelor in Elementary Education'){
          echo "selected";
        }
      ?>
  >Bachelor in Elementary Education</option>
  <option value="Bachelor in Secondary Education Major in English"
  <?php
        if($Cou == 'Bachelor in Secondary Education Major in English'){
          echo "selected";
        }
      ?>
  >Bachelor in Secondary Education Major in English</option>
  <option value="Bachelor in Secondary Education Major in Mathematics"
  <?php
        if($Cou == 'Bachelor in Secondary Education Major in Mathematics'){
          echo "selected";
        }
      ?>
  >Bachelor in Secondary Education Major in Mathematics</option>
  <option value="Bachelor of Arts in English"
  <?php
        if($Cou == 'Bachelor of Arts in English'){
          echo "selected";
        }
      ?>
  >Bachelor of Arts in English</option>
  <option value="Bachelor of Physical Education Major in Sports and Wellness"
  <?php
        if($Cou == 'Bachelor of Physical Education Major in Sports and Wellness'){
          echo "selected";
        }
      ?>
  >Bachelor of Physical Education Major in Sports and Wellness</option>
  <option value="Bachelor of Science in Psychology"
   <?php
        if($Cou == 'Bachelor of Science in Psychology'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Psychology</option>

   <optgroup label="College of Engineering">
  <option value="Bachelor of Science in Civil Engineering"
  <?php
        if($Cou == 'Bachelor of Science in Civil Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Civil Engineering</option>
  <option value="Bachelor of Science in Computer Engineering"
  <?php
        if($Cou == 'Bachelor of Science in Computer Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Computer Engineering</option>
  <option value="Bachelor of Science in Electrical Engineering"
  <?php
        if($Cou == 'Bachelor of Science in Electrical Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Electrical Engineering</option>
  <option value="Bachelor of Science in Electronics and Communications Engineering"
  <?php
        if($Cou == 'Bachelor of Science in Electronics and Communications Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Electronics and Communications Engineering</option>
  <option value="Bachelor of Science in Environmental and Sanitary Engineering"
   <?php
        if($Cou == 'Bachelor of Science in Environmental and Sanitary Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Environmental and Sanitary Engineering</option>
  <option value="Bachelor of Science in Mechanical Engineering"
  <?php
        if($Cou == 'Bachelor of Science in Mechanical Engineering'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Mechanical Engineering</option>

  <optgroup label="College of Dentistry">
  <option value="Doctor of Dental Medicine"
  <?php
        if($Cou == 'Doctor of Dental Medicine'){
          echo "selected";
        }
      ?>
  >Doctor of Dental Medicine</option>

   <optgroup label="College of Computer Studies">
  <option value="Bachelor of Science in Computer Science"
    <?php
        if($Cou == 'Bachelor of Science in Computer Science'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Computer Science</option>
  <option value="Bachelor of Science in Computer Science with Specialization in Digital Forensic"
  <?php
        if($Cou == 'Bachelor of Science in Computer Science with Specialization in Digital Forensic'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Computer Science with Specialization in Digital Forensic</option>
  <option value="Bachelor of Science in Information Technology"
  <?php
        if($Cou == 'Bachelor of Science in Information Technology'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Information Technology</option>

  <optgroup label="College of Business and Accountancy">
  <option value="Bachelor of Science in Accountancy"
  <?php
        if($Cou == 'Bachelor of Science in Accountancy'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Accountancy</option>
  <option value="Bachelor of Science in Accounting Technology"
  <?php
        if($Cou == 'Bachelor of Science in Accounting Technology'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Accounting Technology</option>
  <option value="Bachelor of Science in Business Administration Major in Finance Management"
    <?php
        if($Cou == 'Bachelor of Science in Business Administration Major in Finance Management'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Business Administration Major in Finance Management</option>
  <option value="Bachelor of Science in Business Administration Major in Marketing Management"
  <?php
        if($Cou == 'Bachelor of Science in Business Administration Major in Finance Management'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Business Administration Major in Marketing Management</option>

 <optgroup label="College of Architecture">
  <option value="Bachelor of Science in Architecture"
  <?php
        if($Cou == 'Bachelor of Science in Architecture'){
          echo "selected";
        }
      ?>
  >Bachelor of Science in Architecture</option>
</select>
<?php 
echo('<p class="StudentNumTxt"><strong> Student Number: </strong>'.$Stu. '</p>');
?>
<!--▲▲▲ Basic Info Design ▲▲▲-->

<!--▼▼▼ Persinal Info Design ▼▼▼-->
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
<div class="TravelInfoBx"></div>
<h3 class="TravelInfo">II. Travel Information</h3>
    <p class="PassportTxt"><span style="color: red; font-size:25px">*</span> Passport Number: 
      <input type="text" class="PassportBx" name="passport" value="<?= $Pas ?>" required></p>
    <p class="ExpiryTxt"><span style="color: red; font-size:25px">*</span> Expiry Date/Valid Until: 
      <input type="text" name="passportexpiry"  value="<?= $PaE ?>" placeholder="dd/mm/yyyy" required></p>
    <p class="IssuePlaceTxt"><span style="color: red; font-size:25px">*</span> Place of Issuance:
      <input type="text" class="IssuePlaceBx" name="placeissuance" value="<?= $PlI ?>" required></p>

    <p class="ArrivalDateTxt"><span style="color: red; font-size:25px">*</span> Date of Latest Arrival: 
      <input type="text" name="latestarrival" value="<?= $Arr ?>" placeholder="dd/mm/yyyy" required></p>
    <p class="FlightNumTxt"><span style="color: red; font-size:25px">*</span> Flight Number:
      <input type="text" class="FlightNumBx" name="flightnumber" value="<?= $Fli ?>" required></p>
    <p class="LastDayTxt"><span style="color: red; font-size:25px">*</span> Last Day of Authorized Stay: 
      <input type="text" name="laststay" value="<?= $Sty ?>" placeholder="dd/mm/yyyy" required></p>
<!--▲▲▲ Travel Info Design ▲▲▲-->

<!--▼▼▼ ACR I-CARD Design ▼▼▼-->
<div class="ACRBx"></div>
<h3 class="ACR">III. ACR I-CARD</h3>
  <p class="ACRNumTxt"><span style="color: red; font-size:25px">*</span> Alien Certificate of Registration (ACR) Number:
      <input type="text" class="ACRNumBx" name="acr" value="<?= $Acr ?>" required></p>
  <p class="ACRIssueDateTxt"><span style="color: red; font-size:25px">*</span> Date of Issuance: 
      <input type="text" name="acrissuance" value="<?= $AcI ?>" placeholder="dd/mm/yyyy" required></p>

  <p class="ValidDateTxt"><span style="color: red; font-size:25px">*</span> Expiry Date/Valid Until: 
      <input type="text" name="acrexpiry" value="<?= $AcE ?>" placeholder="dd/mm/yyyy" required></p>

  <p class="CertNumTxt"><span style="color: red; font-size:25px">*</span> Certificate of Residence Number (CRN):  
      <input type="text" class="CertNumBx" name="crn" value="<?= $Crn ?>" required></p>
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
  <input type="hidden" name="studentnumber" value="<?= $Stu?>"/>
  <input type="submit" class="SaveBtn" name="save" value="Save">
  <input type="submit" class="CancelBtn" name="cancel" value="Cancel" formnovalidate>

</form>
<div class="EndLine"></div>
</html>