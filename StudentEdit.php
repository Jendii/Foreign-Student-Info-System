<?php
require_once "pdo.php";
session_start();

if(isset($_POST['cancel'])){
 header("Location: StudentView.php");
 return;
}
if(isset($_POST['logout'])){
     header("Location: logout.php");
     return;
}

if(isset($_POST['save'])){
    $sql = "UPDATE profile SET nationality = :Nationality_,
            height = :Height_, weight = :Weight_, landline = :Landline_, mobile = :Mobile_,
            addressP = :AddP_, cityP = :CityP_, zipcodeP = :ZipP_ ,countryBirth = :CountryB_,
            civilStatus = :Civil_, ssrn = :SSRN_, email = :Email_,
            addressA = :AddA_, cityA = :CityA_, countryzipcodeA = :ZipA_,
            Gname = :Gname_, Grelationship = :Grel_,
            GaddressP =:Gadd_, GzipcodeP = :Gzip_,
            GcityP = :Gcity_, Gcountryzipcode = :Gcoun_, Glandline = :Glandline_, 
            Gmobile = :Gmobile_
            WHERE STUDENT_ID = :StudID_";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':StudID_' => $_POST['studentnumber'],

        ':Nationality_' => $_POST['nationality'],
        ':Height_' => $_POST['height'],
        ':Weight_' => $_POST['weight'],
        ':Landline_' => $_POST['landline'],
        ':Mobile_' => $_POST['mobile'],
        ':AddP_' => $_POST['addressP'],
        ':CityP_' => $_POST['cityP'],
        ':ZipP_' => $_POST['zipcodeP'],
        ':CountryB_' => $_POST['countrybirth'],
        ':Civil_' => $_POST['status'],
        ':SSRN_' => $_POST['ssrn'],
        ':Email_' => $_POST['email'],
        ':AddA_' => $_POST['addressA'],
        ':CityA_' => $_POST['cityA'],
        ':ZipA_' => $_POST['zipA'],

        ':Gname_' => $_POST['Gname'],
        ':Grel_' => $_POST['Grelationship'],
        ':Gadd_' => $_POST['Gaddress'],
        ':Gzip_' => $_POST['Gzipcode'],
        ':Gcity_' => $_POST['Gcity'],
        ':Gcoun_' => $_POST['Gcountry'],
        ':Glandline_' => $_POST['Glandline'],
        ':Gmobile_' => $_POST['Gmobile']


    ));
         $_SESSION['success'] = 'Record updated';
        header("Location: StudentView.php");
        return;
    
}


$stmt = $pdo->prepare("SELECT * FROM profile where STUDENT_ID = :wxyz");
$stmt->execute(array(":wxyz" => $_SESSION['student']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for Student ID';
    header("Location: StudentView.php") ;
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

  $s = htmlentities($row['Fname'].' '.$row['Lname']);   
?>
<html>
<head>
    <link rel="stylesheet" href="css/StudentEdit.css">
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
      echo ($s);
    ?> 
  </div>
  <img src="/NU/assets/exit.png" class="LogOutIcn"> 
  <form method="POST">
    <!-- <div class="LogOutBtn">Logout</div>  -->
    <input type="submit" name="logout" value="Logout" class="LogOutBtn">
  </form>
                    <!-- Logout Button Text Only -->
  <!--▲▲▲ Tab Design ▲▲▲-->

<h1 class = "HeaderFont">>Edit Profile</h1>  
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
<div class="BasicInfoBx">
<?php
 echo('<p class="CollegeTxt"><strong> College: </strong>'.$Col. '</p>');
 echo('<p class="CourseTxt"><strong> Course: </strong>'.$Cou. '</p>');
 
 echo('<p class="StudentNumTxt"><strong> Student Number: </strong>'.$Stu. '</p>');
?>  
</div>
<!--▲▲▲ Basic Info Design ▲▲▲-->

<!--▼▼▼ Persinal Info Design ▼▼▼-->
<div class="PersonaInfoBx"></div>
  <h3 class="PersonaInfo">I. Personal Information</h3>
  <p class="LastNameTxt"><span style="color: red; font-size:25px">*</span> Last Name:
    <input type="text" class="LastNameBx" name="lastname" value="<?=$Lna?>" required/></p>
  <p class="FirstNameTxt"><span style="color: red; font-size:25px">*</span> First Name:
    <input type="text" class="FirstNameBx" name="firstname" value="<?=$Fna?>" required/></p>
  <p class="MiddleNameTxt"><span style="color: red; font-size:25px">*</span> Middle Name:
    <input type="text" class="MiddleNameBx" name="middlename" value="<?=$Mna?>" required/></p>
<?php
   echo('<p class="BirthDateTxt"><strong> Date of Birth: </strong>'.$Bir. '</p>');
?> 

 <p class="Gender"><span style="color: red; font-size:25px">*</span> Gender:
    <input type="radio" id="male" name="gender" value="male" required
    <?php
        if($Gen == 'male'){
          echo "checked";
        }
        ?>
    >
    <label for="male" class="Radio">Male</label>
    <input type="radio" id="female" name="gender" value="female" required
     <?php
        if($Gen == 'female'){
          echo "checked";
        }
        ?>
    >
    <label for="female"class="Radio">Female</label>
  </p>


  <p class="NationalityTxt"><span style="color: red; font-size:25px">*</span> Citezenship/Nationality:
    <input type="text" class="NationalityBx" name="nationality" value="<?=$Nat?>" required/></p>
  <p class="HeightTxt">Height(cm):
    <input type="text" class="HeightBx" name="height" value="<?=$Hei?>"/></p>
  <p class="WeightTxt">Weight(kg):
    <input type="text" class="WeightBx" name="weight" value="<?=$Wei?>"/></p>

  <br>

  <h4 class="ContactFont">Contact Number(s) in the Philippines</h4>
    <p class="LandlineTxt">Landline:
      <input type="text" class="LandlineBx" name="landline" value="<?=$Lan?>"/></p>
    <p class="MobileTxt"><span style="color: red; font-size:25px">*</span> Mobile:
      <input type="tel" class="MobileBx" name="mobile" placeholder="09xxxxxxxxx"
      pattern="[0-9]{11}" value="<?=$Mob?>" required/></p><br>

  <h4 class="ResidentFont">Residential Address in the Philippines</h4>
    <p class="StreetTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
      <input type="text" class="StreetBx" name="addressP" value="<?=$AdP?>" required/></p>
    <p class="CityTxt"><span style="color: red; font-size:25px">*</span> Barangay, Municipality/City:
      <input type="text" class="CityBx" name="cityP" value="<?=$CiP?>" required/></p>
    <p class="ZipCodeTxt"><span style="color: red; font-size:25px">*</span> Province, Zip Code:
      <input type="text" class="ZipCodeBx" name="zipcodeP" value="<?=$ZiP?>" required/></p>

    <p class="CountryBirthTxt"><span style="color: red; font-size:25px">*</span> Country of Birth:
      <input type="text" class="CountryBirthBx" name="countrybirth" value="<?=$Cbi?>" required/>
    </p>

    <label class="CivilStatTxt" for="status"><span style="color: red; font-size:25px">*</span> Civil Status: </label>
    <!-- <input type="text" class="CivilStatBx" name="status" id="status" value="<?=$Sta?>" required/> -->
   <select class="CivilStatBx" name="status" id="status" required>
        <option selected disabled>--select--</option>
        <option value="single"
        <?php
        if($Sta == 'single'){
          echo "selected";
        }
        ?>
        >Single</option>
        <option value="married"
        <?php
        if($Sta == 'married'){
          echo "selected";
        }
        ?>
        >Married</option>
        <option value="annulled"
        <?php
        if($Sta == 'annulled'){
          echo "selected";
        }
        ?>
        >Annulled</option>
        <option value="separated"
        <?php
        if($Sta == 'separated'){
          echo "selected";
        }
        ?>
        >Separated</option>
        <option value="widowed"
        <?php
        if($Sta == 'widowed'){
          echo "selected";
        }
        ?>
        >Widowed</option>
        <option value="divorced"
        <?php
        if($Sta == 'divorced'){
          echo "selected";
        }
        ?>
        >Divorced</option>
      </select>
      
    <p class="SSSTxt"><span style="color: red; font-size:25px">*</span> Special Security Registration Number(SSRN) 
      <input type="text" class="SSSBx" name="ssrn" value="<?=$SSR?>" required></p>
    <p class="EmailTxt"><span style="color: red; font-size:25px">*</span> Email Address 
      <input type="email" class="EmailBx" name="email" value="<?=$Ema?>" required/></p>

  <h4 class="ResidentAbrFont">Residential Address Abroad </h4>
    <p class="StreetAbrTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
        <input type="text" class="StreetAbrBx" name="addressA" value="<?=$AdA?>" required/></p>
    <p class="CityAbrTxt"><span style="color: red; font-size:25px">*</span> City/State:
        <input type="text" class="CityAbrBx" name="cityA" value="<?=$CiA?>" required/></p>
    <p class="ZipCodeAbrTxt"><span style="color: red; font-size:25px">*</span> Country, Zip Code:
        <input type="text" class="ZipCodeAbrBx" name="zipA" value="<?=$ZiA?>" required/></p> 
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
<div class="GuardBx"></div>
<h3 class="GuardInfo">IV. Guardian's Information</h3>
  <p class="GuardNameTxt"><span style="color: red; font-size:25px">*</span> Name of Guardian (Last Name,First Name, Middle Name):
      <input type="text" class="GuardNameBx" name="Gname" value="<?=$GNa?>" required></p>
  <p class="RelationTxt"><span style="color: red; font-size:25px">*</span> Relationship with the Applicant: 
      <input type="text" class="RelationBx" name="Grelationship" value="<?=$GRe?>" required></p>
  <!-- <br> -->
  <h4 class="GuardResidentFont">Residential Address in the Philippines</h4>
    <p class="GuardAddressTxt"><span style="color: red; font-size:25px">*</span> House/Unit No., Street, Subdivision/Village:
        <input type="text" class="GuardAddressBx" name="Gaddress" value="<?=$GAd?>" required></p>
    <p class="GuardZipTxt"><span style="color: red; font-size:25px">*</span> Province, Zip Code:
        <input type="text" class="GuardZipBx" name="Gzipcode" value="<?=$GZi?>" required></p>

    <p class="GuardCityTxt"><span style="color: red; font-size:25px">*</span> Barangay, Municipality/City:
        <input type="text" class="GuardCityBx" name="Gcity" value="<?=$GCi?>" required></p>
    <p class="GuardCountryTxt"><span style="color: red; font-size:25px">*</span> Country, Zip Code:
        <input type="text" class="GuardCountryBx" name="Gcountry" value="<?=$GCo?>" required></p>

  <h4 class="GuardContactFont">Contact Number(s) in the Philippines</h4>
    <p class="GuardLandlineTxt">Landline:
      <input type="tel"class="GuardLandlineBx" name="Glandline" value="<?=$GLa?>"></p>
    <p class="GuardMobileTxt"><span style="color: red; font-size:25px">*</span> Mobile:
      <input type="tel" class="GuardMobileBx" name="Gmobile" placeholder="09xxxxxxxxx"
      pattern="[0-9]{11}" value="<?=$GMo?>" required></p>
  <br><br>
<!--▲▲▲ Guardian's Information Design ▲▲▲-->

  <input type="hidden" name="studentnumber" value="<?= $Stu?>"/>
  <input type="submit" class="SaveBtn" name="save" value="Save">
  <input type="submit" class="CancelBtn" name="cancel" value="Cancel" formnovalidate>

</form>
<div class="EndLine"></div>
</html>