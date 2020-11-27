<?php
 session_start();
 require_once "pdo.php";

// Demand a GET parameter
if ( ! isset($_SESSION['sao'])) {
    die('Not logged in');
}
// If the user requested logout go back to index.php
if (isset($_POST['logout']) ) {
    $_SESSION['logout'] = $_POST['logout'];
    header('Location: logout.php');
    return;
}

if(isset($_POST['cancel'])){
     header("Location: mainpage.php");
     return;
}
// $_SESSION['error'] = 'All * are required';

if(isset($_POST['course']) && isset($_POST['college']) && isset($_POST['studentnumber']) && isset($_POST['lastname']) &&
    isset($_POST['firstname']) && isset($_POST['middlename']) && isset($_POST['birthdate']) &&
    isset($_POST['gender']) && isset($_POST['nationality']) && isset($_POST['mobile']) &&
    isset($_POST['addressP']) && isset($_POST['cityP']) && isset($_POST['zipcodeP']) &&
    isset($_POST['countrybirth']) && isset($_POST['status']) && isset($_POST['ssrn']) &&
    isset($_POST['email']) && isset($_POST['addressA']) && isset($_POST['cityA']) &&
    isset($_POST['zipA']) && isset($_POST['passport']) && isset($_POST['passportexpiry']) &&
    isset($_POST['placeissuance']) && isset($_POST['acr']) && isset($_POST['acrissuance']) &&
    isset($_POST['acrexpiry']) && isset($_POST['latestarrival']) && isset($_POST['flightnumber']) &&
    isset($_POST['laststay']) && isset($_POST['crn']) && isset($_POST['Gname']) &&
    isset($_POST['Grelationship']) && isset($_POST['Gaddress']) && isset($_POST['Gzipcode']) &&
    isset($_POST['Gcity']) && isset($_POST['Gcountry']) && isset($_POST['Gmobile'])
    && isset($_POST['add'])){

    $Course =  htmlentities($_POST['course']);
    $College =  htmlentities($_POST['college']);
    $Studentnumber =  htmlentities($_POST['studentnumber']);
    $Lname =  htmlentities($_POST['lastname']);
    $Fname =  htmlentities($_POST['firstname']);
    $Mname =  htmlentities($_POST['middlename']);
    $Birthdate =  htmlentities($_POST['birthdate']);
    $Gender =  htmlentities($_POST['gender']);
    $Nationality =  htmlentities($_POST['nationality']);
    $Height =  htmlentities($_POST['height']);
    $Weight =  htmlentities($_POST['weight']);
    $Landline =  htmlentities($_POST['landline']);
    $Mobile =  htmlentities($_POST['mobile']);
    $AddressP =  htmlentities($_POST['addressP']);
    $CityP =  htmlentities($_POST['cityP']);
    $ZipcodeP =  htmlentities($_POST['zipcodeP']);
    $Countrybirth =  htmlentities($_POST['countrybirth']);
    $Status =  htmlentities($_POST['status']);
    $SSRN =  htmlentities($_POST['ssrn']);
    $Email =  htmlentities($_POST['email']);
    $AddressA =  htmlentities($_POST['addressA']);
    $CityA =  htmlentities($_POST['cityA']);
    $ZipcodeA =  htmlentities($_POST['zipA']);
    $Passport =  htmlentities($_POST['passport']);
    $Passportexpiry =  htmlentities($_POST['passportexpiry']);
    $Placeissuance =  htmlentities($_POST['placeissuance']);
    $Latestarrival =  htmlentities($_POST['latestarrival']);
    $Flightnumber =  htmlentities($_POST['flightnumber']);
    $Laststay =  htmlentities($_POST['laststay']);
    $ACR =  htmlentities($_POST['acr']);
    $ACRissuance =  htmlentities($_POST['acrissuance']);
    $ACRexpiry =  htmlentities($_POST['acrexpiry']);
    $CRN =  htmlentities($_POST['crn']);
    $GName =  htmlentities($_POST['Gname']);
    $GRelationship =  htmlentities($_POST['Grelationship']);
    $GAddress =  htmlentities($_POST['Gaddress']);
    $GZipcode =  htmlentities($_POST['Gzipcode']);
    $GCity =  htmlentities($_POST['Gcity']);
    $GCountry =  htmlentities($_POST['Gcountry']);
    $GLandline =  htmlentities($_POST['Glandline']);
    $GMobile =  htmlentities($_POST['Gmobile']);

        if (!is_numeric($Mobile) || !is_numeric($GMobile)) 
        {
                    $_SESSION['error'] = "Mobile Phone must be numeric";
                    header("Location: add.php");
                    return;
        }

        $Birthdate = date_create($_POST['birthdate']);
        $Passportexpiry = date_create($_POST['passportexpiry']);
        $Latestarrival = date_create($_POST['latestarrival']);
        $Laststay = date_create($_POST['laststay']);
        $ACRexpiry = date_create($_POST['acrexpiry']);
        $ACRissuance = date_create($_POST['acrissuance']);

                $sql = "INSERT INTO profile (course,college,STUDENT_ID,Lname, Fname, Mname,
                bday,gender,nationality,height,weight,landline,mobile,
                addressP,cityP,zipcodeP,countryBirth,civilStatus,ssrn,email,
                addressA,cityA,countryzipcodeA,passport,passportExpiry,placeIssuance,
                latestArrival,flightNumber,lastStay,acr,acrIssuance,acrExpiry,crn,
                Gname,Grelationship,GaddressP,GzipcodeP,GcityP,Gcountryzipcode,Glandline,Gmobile) VALUES ( :Course_, :College_, :StudID_, :Ln_, :Fn_, :Mn_, :Bday_, :Gender_, :Nationality_, :Height_, :Weight_, :Landline_,:Mobile_, :AddP_, :CityP_, :ZipP_, :CountryB_, :Civil_, :SSRN_, :Email_, 
                    :AddA_, :CityA_, :ZipA_, :Passport_, :PassExp_, :PlaceIssu_, :Arrival_, :Flight_, :Stay_, 
                    :Acr_, :AcrIssu_, :AcrExp_, :Crn_, :Gname_, :Grel_, :Gadd_, :Gzip_, :Gcity_, :Gcoun_, 
                    :Glandline_, :Gmobile_)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(
                 array(
                    ':Course_' => $Course,
                    ':College_' => $College,
                    ':StudID_' => $Studentnumber,

                    ':Ln_' => $Lname,
                    ':Fn_' => $Fname,
                    ':Mn_' => $Mname,

                    ':Bday_' => date_format($Birthdate,"d/m/Y"),
                    ':Gender_' => $Gender,
                    ':Nationality_' => $Nationality,
                    ':Height_' => $Height,
                    ':Weight_' => $Weight,
                    ':Landline_' => $Landline,
                    ':Mobile_' => $Mobile,
                    ':AddP_' => $AddressP,
                    ':CityP_' => $CityP,
                    ':ZipP_' => $ZipcodeP,
                    ':CountryB_' => $Countrybirth,
                    ':Civil_' => $Status,
                    ':SSRN_' => $SSRN,
                    ':Email_' => $Email,
                    ':AddA_' => $AddressA,
                    ':CityA_' => $CityA,
                    ':ZipA_' => $ZipcodeA,
                    ':Passport_' => $Passport,
                    ':PassExp_' => date_format($Passportexpiry,"d/m/Y"),
                    ':PlaceIssu_' => $Placeissuance,
                    ':Arrival_' => date_format($Latestarrival,"d/m/Y"),
                    ':Flight_' => $Flightnumber,
                    ':Stay_' => date_format($Laststay,"d/m/Y"),
                    ':Acr_' => $ACR,
                    ':AcrIssu_' => date_format($ACRissuance,"d/m/Y"),
                    ':AcrExp_' => date_format($ACRexpiry,"d/m/Y"),
                    ':Crn_' => $CRN,
                    ':Gname_' => $GName,
                    ':Grel_' => $GRelationship,
                    ':Gadd_' => $GAddress,
                    ':Gzip_' => $GZipcode,
                    ':Gcity_' => $GCity,
                    ':Gcoun_' => $GCountry,
                    ':Glandline_' => $GLandline,
                    ':Gmobile_' => $GMobile
                    )
                );
                $_SESSION['success'] = "Record inserted";
                header("Location: dashboard.php?name=".urlencode($_SESSION['sao']));
                unset($_SESSION['error']);
                return;

            
} // end if set
?>

<html>
<head>
<link rel="stylesheet" href="css/AddStudent.css">

<title>Add Student</title>

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
  <!--▲▲▲ Tab Design ▲▲▲-->


<h1 class = "HeaderFont">>Add Student</h1>  


<p>
<?php
   // if ( isset($_SESSION['error']) ) {
   //  echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
   //  unset($_SESSION['error']);
// }
?>
</p>


<form method="post">
<!--▼▼▼ Basic Info Design ▼▼▼-->
<div class="BasicInfoBx"></div>

<label for="college" class="CollegeTxt"><span style="color: red; font-size:25px">*</span> College: </label>
<select name="college" class="CollegeBx" required>
  <option class="It" selected disabled >--select--</option>
  <optgroup class="It" label="Undergraduate">
  <option class="It" value="College of Allied Health">College of Allied Health</option>
  <option class="It" value="College of Hospitality Management">College of Hospitality Management</option>
  <option class="It" value="College of Education,Arts and Sciences">College of Education,Arts and Sciences</option>
  <option class="It" value="College of Engineering">College of Engineering</option>
  <option class="It" value="College of Dentistry">College of Dentistry</option>
  <option class="It" value="College of Computer Studies">College of Computer Studies</option>
  <option class="It" value="College of Business and Accountancy">College of Business and Accountancy</option>
  <option class="It" value="College of Architecture">College of Architecture</option>
</select>

  <label for="course" class="CourseTxt"><span style="color: red; font-size:25px">*</span> Course: </label>
  <select name="course" class="CourseBx" required>
  <option selected disabled>--select--</option>
  <optgroup label="College of Allied Health">
  <option value="Bachelor of Science in Medical Technology">Bachelor of Science in Medical Technology</option>
  <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing</option>
  <option value="Bachelor of Science in Pharmacy">Bachelor of Science in Pharmacy</option>

  <optgroup label="College of Hospitality Management">
  <option value="Bachelor of Science in Hotel and Restaurant Management">Bachelor of Science in Hotel and Restaurant Management</option>
  <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management</option>

  <optgroup label="College of Education,Arts and Sciences">
  <option value="Bachelor in Elementary Education">Bachelor in Elementary Education</option>
  <option value="Bachelor in Secondary Education Major in English">Bachelor in Secondary Education Major in English</option>
  <option value="Bachelor in Secondary Education Major in Mathematics">Bachelor in Secondary Education Major in Mathematics</option>
  <option value="Bachelor of Arts in English">Bachelor of Arts in English</option>
  <option value="Bachelor of Physical Education Major in Sports and Wellness">Bachelor of Physical Education Major in Sports and Wellness</option>
  <option value="Bachelor of Science in Psychology">Bachelor of Science in Psychology</option>

   <optgroup label="College of Engineering">
  <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering</option>
  <option value="Bachelor of Science in Computer Engineering">Bachelor of Science in Computer Engineering</option>
  <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering</option>
  <option value="Bachelor of Science in Electronics and Communications Engineering">Bachelor of Science in Electronics and Communications Engineering</option>
  <option value="Bachelor of Science in Environmental and Sanitary Engineering">Bachelor of Science in Environmental and Sanitary Engineering</option>
  <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering</option>

  <optgroup label="College of Dentistry">
  <option value="Doctor of Dental Medicine">Doctor of Dental Medicine</option>

   <optgroup label="College of Computer Studies">
  <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
  <option value="Bachelor of Science in Computer Science with Specialization in Digital Forensic">Bachelor of Science in Computer Science with Specialization in Digital Forensic</option>
  <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>

  <optgroup label="College of Business and Accountancy">
  <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
  <option value="Bachelor of Science in Accounting Technology">Bachelor of Science in Accounting Technology</option>
  <option value="Bachelor of Science in Business Administration Major in Finance Management">Bachelor of Science in Business Administration Major in Finance Management</option>
  <option value="Bachelor of Science in Business Administration Major in Marketing Management">Bachelor of Science in Business Administration Major in Marketing Management</option>

 <optgroup label="College of Architecture">
  <option value="Bachelor of Science in Architecture">Bachelor of Science in Architecture</option>
</select></p>


  <p class="StudentNumTxt"><span style="color: red; font-size:25px">*</span> Student Number: 
    <input type="text" class="StudentNumBx" name="studentnumber" required/></p>

<!--▲▲▲ Basic Info Design ▲▲▲-->


<!--▼▼▼ Persinal Info Design ▼▼▼-->
<div class="PersonaInfoBx"></div>
  <h3 class="PersonaInfo">I. Personal Information</h3>
  <p class="LastNameTxt"><span style="color: red; font-size:25px">*</span> Last Name:
    <input type="text" class="LastNameBx" name="lastname" required/></p>
  <p class="FirstNameTxt"><span style="color: red; font-size:25px">*</span> First Name:
    <input type="text" class="FirstNameBx" name="firstname" required/></p>
  <p class="MiddleNameTxt"><span style="color: red; font-size:25px">*</span> Middle Name:
    <input type="text" class="MiddleNameBx" name="middlename" required/></p>

  <p class="BirthDateTxt"><span style="color: red; font-size:25px">*</span> Date of Birth:<input type="Date" name="birthdate" required/>
    </p>
 
    

  <p class="Gender"><span style="color: red; font-size:25px">*</span> Gender:
    <input type="radio" id="male" name="gender" value="male" required>
    <label for="male" class="Radio">Male</label>
    <input type="radio" id="female" name="gender" value="female" required>
    <label for="female"class="Radio">Female</label>
  </p>
  <p class="NationalityTxt"><span style="color: red; font-size:25px">*</span> Citezenship/Nationality:
    <input type="text" class="NationalityBx" name="nationality" required/></p>
  <p class="HeightTxt">Height(cm):
    <input type="text" class="HeightBx" name="height"/></p>
  <p class="WeightTxt">Weight(kg):
    <input type="text" class="WeightBx" name="weight"/></p>

  <br>

  <h4 class="ContactFont">Contact Number(s) in the Philippines</h4>
    <p class="LandlineTxt">Landline:
      <input type="text" class="LandlineBx" name="landline"/></p>
    <p class="MobileTxt"><span style="color: red; font-size:25px">*</span> Mobile:
      <input type="tel" class="MobileBx" name="mobile" placeholder="09xxxxxxxxx"
      pattern="[0-9]{11}" required/></p><br>

  <h4 class="ResidentFont">Residential Address in the Philippines</h4>
    <p class="StreetTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
      <input type="text" class="StreetBx" name="addressP" required/></p>
    <p class="CityTxt"><span style="color: red; font-size:25px">*</span> Barangay, Municipality/City:
      <input type="text" class="CityBx" name="cityP" required/></p>
    <p class="ZipCodeTxt"><span style="color: red; font-size:25px">*</span> Province, Zip Code:
      <input type="text" class="ZipCodeBx" name="zipcodeP" required/></p>

    <p class="CountryBirthTxt"><span style="color: red; font-size:25px">*</span> Country of Birth:
      <input type="text" class="CountryBirthBx" name="countrybirth" required/></p>

    <label class="CivilStatTxt" for="status"><span style="color: red; font-size:25px">*</span> Civil Status: </label>
      <select class="CivilStatBx" name="status" id="status" required>
        <option selected disabled>--select--</option>
        <option value="single">Single</option>
        <option value="married">Married</option>
        <option value="annulled">Annulled</option>
        <option value="separated">Separated</option>
        <option value="widowed">Widowed</option>
        <option value="divorced">Divorced</option>
      </select>
    <p class="SSSTxt"><span style="color: red; font-size:25px">*</span> Special Security Registration Number(SSRN) 
      <input type="text" class="SSSBx" name="ssrn" required></p>
    <p class="EmailTxt"><span style="color: red; font-size:25px">*</span> Email Address 
      <input type="email" class="EmailBx" name="email" required/></p>

  <h4 class="ResidentAbrFont">Residential Address Abroad </h4>
    <p class="StreetAbrTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
        <input type="text" class="StreetAbrBx" name="addressA" required/></p>
    <p class="CityAbrTxt"><span style="color: red; font-size:25px">*</span> City/State:
        <input type="text" class="CityAbrBx" name="cityA" required/></p>
    <p class="ZipCodeAbrTxt"><span style="color: red; font-size:25px">*</span> Country, Zip Code:
        <input type="text" class="ZipCodeAbrBx" name="zipA" required/></p>
<!--▲▲▲ Basic Info Design ▲▲▲-->

<!--▼▼▼ Travel Info Design ▼▼▼-->
<div class="TravelInfoBx"></div>
<h3 class="TravelInfo">II. Travel Information</h3>
    <p class="PassportTxt"><span style="color: red; font-size:25px">*</span> Passport Number: 
      <input type="text" class="PassportBx" name="passport" required></p>
    <p class="ExpiryTxt"><span style="color: red; font-size:25px">*</span> Expiry Date/Valid Until: 
      <input type="Date" name="passportexpiry" placeholder="DD-MM-YYYY" required></p>
    <p class="IssuePlaceTxt"><span style="color: red; font-size:25px">*</span> Place of Issuance:
      <input type="text" class="IssuePlaceBx" name="placeissuance" required></p>

    <p class="ArrivalDateTxt"><span style="color: red; font-size:25px">*</span> Date of Latest Arrival: 
      <input type="Date" name="latestarrival" placeholder="DD-MM-YYYY" required></p>
    <p class="FlightNumTxt"><span style="color: red; font-size:25px">*</span> Flight Number:
      <input type="text" class="FlightNumBx" name="flightnumber" required></p>
    <p class="LastDayTxt"><span style="color: red; font-size:25px">*</span> Last Day of Authorized Stay: 
      <input type="Date" name="laststay" placeholder="DD-MM-YYYY" required></p>
<!--▲▲▲ Travel Info Design ▲▲▲-->

<!--▼▼▼ ACR I-CARD Design ▼▼▼-->
<div class="ACRBx"></div>
<h3 class="ACR">III. ACR I-CARD</h3>
  <p class="ACRNumTxt"><span style="color: red; font-size:25px">*</span> Alien Certificate of Registration (ACR) Number:
      <input type="text" class="ACRNumBx" name="acr" required></p>
  <p class="ACRIssueDateTxt"><span style="color: red; font-size:25px">*</span> Date of Issuance: 
      <input type="date" name="acrissuance" placeholder="DD-MM-YYYY" required></p>
  <p class="ValidDateTxt"><span style="color: red; font-size:25px">*</span> Expiry Date/Valid Until: 
      <input type="Date" name="acrexpiry" placeholder="DD-MM-YYYY" required></p>
  <p class="CertNumTxt"><span style="color: red; font-size:25px">*</span> Certificate of Residence Number (CRN):  
      <input type="text" class="CertNumBx" name="crn" required></p>
<!--▲▲▲ ACR I-CARD Design ▲▲▲-->


<!--▼▼▼ Guardian's Information Design ▼▼▼-->
<div class="GuardBx"></div>
<h3 class="GuardInfo">IV. Guardian's Information</h3>
  <p class="GuardNameTxt"><span style="color: red; font-size:25px">*</span> Name of Guardian (Last Name,First Name, Middle Name):
      <input type="text" class="GuardNameBx" name="Gname" required></p>
  <p class="RelationTxt"><span style="color: red; font-size:25px">*</span> Relationship with the Applicant: 
      <input type="text" class="RelationBx" name="Grelationship" required></p>
  <!-- <br> -->
  <h4 class="GuardResidentFont">Residential Address in the Philippines</h4>
    <p class="GuardAddressTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
        <input type="text" class="GuardAddressBx" name="Gaddress" required></p>
    <p class="GuardZipTxt"><span style="color: red; font-size:25px">*</span> Province, Zip Code:
        <input type="text" class="GuardZipBx" name="Gzipcode" required></p>

    <p class="GuardCityTxt"><span style="color: red; font-size:25px">*</span> Barangay, Municipality/City:
        <input type="text" class="GuardCityBx" name="Gcity" required></p>
    <p class="GuardCountryTxt"><span style="color: red; font-size:25px">*</span> Country, Zip Code:
        <input type="text" class="GuardCountryBx" name="Gcountry" required></p>
  <!-- <br> -->
  <h4 class="GuardContactFont">Contact Number(s) in the Philippines</h4>
    <p class="GuardLandlineTxt">Landline:
      <input type="tel"class="GuardLandlineBx" name="Glandline"></p>
    <p class="GuardMobileTxt"><span style="color: red; font-size:25px">*</span> Mobile:
      <input type="tel" class="GuardMobileBx" name="Gmobile" placeholder="09xxxxxxxxx"
      pattern="[0-9]{11}" required></p>
  <br><br>
<!--▲▲▲ Guardian's Information Design ▲▲▲-->


<input type="submit" class="AddBtn" name="add" value="Add">
<input type="submit" class="CancelBtn" name="cancel" value="Cancel" formnovalidate>
<!-- <input type="submit" name="logout" value="Logout"> -->             <!-- Logout Button Moved to Header Design-->

<div class="EndLine"></div>
</p>
</form>
</div>
</body>
</html>