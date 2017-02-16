<?php 
    require_once 'isuser.php';
    if($loguser) {
        header('Location: signin.php');
    }

    if(isset($_GET['error'])) {
        echo "<p class='error'>".$_GET['error']."</p>";
    }

    if(isset($_SESSION['loggeduser'])) {
        header('Location: signin.php');
        exit;
    }


    // define variables and set to empty values for valiation
    $nameErr = $emailErr = $passwordErr = $passwordconfirmErr = $birthdateErr = $jobErr = $addressErr = $interestsErr = $creditlimitErr = "";
    $name = $email = $password = $passwordconfirm = $birthdate = $job = $address = "";
    $creditlimit = 100;
    $nameValid = $emailValid = $passwordValid = $passwordconfirmValid = $birthdateValid = $jobValid = $addressValid = $interestsValid = $creditlimitValid = false;


    $interests = user::getInterestsList();


    if($_POST) {

        //validate name
        if(isset($_POST['name'])&&!empty($_POST['name'])) {
            $name = test_input($_POST["name"]);
            if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "* Only letters and white space allowed";
            }
            else if(strlen($name)<3) {
                $nameErr = "* Name must be 3 or more letters";
            }
            else {
                $nameValid = true;
            }
        }
        else {
            $nameErr = "* Name is required";
        }


        //validate email
        if(isset($_POST['email'])&&!empty($_POST['email'])) {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Invalid email address"; 
            }
            else {
                $emailValid = true;
            }
        }
        else {
            $emailErr = "* Email is required";
        }


        //validate password
        if(isset($_POST['password'])&&!empty($_POST['password'])) {
            $password = $_POST["password"];
            if(strlen($password)<6) {
                $passwordErr = "* Password must be 6 or more characters";
            }
            else{
                $passwordValid = true;
            }
        }
        else {
            $passwordErr = "* Password can't be empty !";
        }

        //validate password confirm 
        if(isset($_POST['passwordconfirm'])&&!empty($_POST['passwordconfirm'])) {
            $passwordconfirm = $_POST["passwordconfirm"];
            if(strcmp($password, $passwordconfirm) !== 0) {
                $passwordconfirmErr = "* Passwords don't match";
            }
            else{
                $passwordconfirmValid = true;
            }
        }
        else {
            $passwordconfirmErr = "* Password confirm can't be empty";
        }


        //validate birthdate
        if(isset($_POST['birthdate'])&&!empty($_POST['birthdate'])) {
            $birthdate = $_POST['birthdate'];
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthdate)) {
                $birthdateErr = "* Date must be in format YYYY-MM-DD ex:'2012-09-12'";
            }
            else {
                $birthdateValid = true;
            }
        }
        else {
            $birthdateErr = "* Birthdate is required";
        }


        //validate job
        if(isset($_POST['job'])&&!empty($_POST['job'])) {
            $job = test_input($_POST['job']);
            if(strlen($job)<2) {
                $jobErr = "* Job can't be less than 2 letters";
            }
            else {
                $jobValid = true;
            }
        }
        else {
            $jobErr = "* Job is required";
        }


        //validate address
        if(isset($_POST['address'])&&!empty($_POST['address'])) {
            $address = test_input($_POST['address']);
            if(strlen($address)<10) {
                $addressErr = "*Addrress can't be less than 10 characters";
            }
            else {
                $addressValid = true;
            }
        }
        else {
            $addressErr = "* Addrress is required";
        }


        //validate interests
        @$user_interests = $_POST['interests'];
        if((count($user_interests)>0)) {
            $interestsValid = true;
            // echo "<pre>";
            // var_dump($_POST);
            // echo "</pre>";
            // die();
        }
        else {
            $interestsErr = "* interests are required";
        }


        //validate creditlimit
        if(isset($_POST['creditlimit'])&&!empty($_POST['creditlimit'])) {
            $creditlimit = test_input($_POST['creditlimit']);
            if($creditlimit<0) {
                $creditlimitErr = "* Credit Limit can't be negative!";
            }
            else {
                $creditlimitValid = true;
            }
        }
        else {
            $creditlimitErr = "* Credit Limit is required";
        }


        //if all fields are valid
        if($nameValid && $emailValid && $passwordValid && $passwordconfirmValid && $birthdateValid && $jobValid && $addressValid && $interestsValid && $creditlimitValid) {
            
            $user = new user();

            $user->name = $name;
            $user->email = $email;
            $user->password = sha1($password);
            $user->birthdate = $birthdate;
            $user->job = $job;
            $user->address = $address;
            $user->creditlimit = $creditlimit;
            $user->userinterests = $user_interests;

            $state = $user->insert();

            if($state) {
                //echo "success";
                header('Location: signin.php');
            }
            else {
                header('Location: new-account.php?error=failed to create new user');
            }

        }

        
    }

?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>eCommerce - Create New Account</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->


        <div id="wrapper">
            <?php require_once 'header.php'; ?>

            <hr />

            <section id="main-content" class="clearfix">
                <div id="new-account">
                    <h1>Create New Account</h1>

                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate>
                        <p>
                            <label for="name">
                                <span class="required-field">*</span> NAME:
                            </label>
                            <input type="text" id="name" name="name" required value="<?= $name?>">
                            <br><span class="form-error"><?= $nameErr;?></span>
                        </p>
                        <p>
                            <label for="email">
                                <span class="required-field">*</span> EMAIL:
                            </label>
                            <input id="emailField" type="email" id="email" name="email" required value="<?= $email?>">
                            <br><span class="form-error"><?= $emailErr;?></span>
                        </p>
                        <p>
                            <label for="password">
                                <span class="required-field">*</span> PASSWORD:
                            </label>
                            <input type="password" id="password" name="password" required>
                            <br><span class="form-error"><?= $passwordErr;?></span>
                        </p>
                        <p>
                            <label for="passwordconfirm">
                                <span class="required-field">*</span> CONFIRM PASSWORD:
                            </label>
                            <input type="password" id="passwordconfirm" name="passwordconfirm" required>
                            <br><span class="form-error"><?= $passwordconfirmErr;?></span>
                        </p>
                        <p>
                            <label for="birthdate">
                                <span class="required-field">*</span> BIRTHDATE:
                            </label>
                            <input type="text" id="datepicker" name="birthdate" required value="<?= $birthdate ?>">
                            <br><span class="form-error"><?= $birthdateErr;?></span>
                        </p>
                        <p>
                            <label for="job">
                                <span class="required-field">*</span> JOB:
                            </label>
                            <input id="job" name="job" required value="<?= $job?>"> 
                            <br><span class="form-error"><?= $jobErr;?></span>
                        </p>
                        <p>
                            <label for="address">
                                <span class="required-field">*</span> ADDRESS:
                            </label>
                            <textarea id="address" name="address" required><?= $address ?></textarea>
                            <br><span class="form-error"><?= $addressErr;?></span>
                        </p>
                        <?php if($interests): ?>
                        <p>
                            <label>
                                <span class="required-field">*</span> INTERESTS:
                            </label>
                            <?php foreach($interests as $interest): ?> 
                                <label class="check-label">
                                    <input type="checkbox" name="interests[]" id="interests[]" value="<?= $interest->idcategory ?>">
                                    <?= $interest->name ?>
                                </label>

                            <?php endforeach; ?>
                            <span class="form-error"><?= $interestsErr;?></span>
                            <br>
                        </p>
                        <?php endif; ?>


                        <p>
                            <label for="creditlimit">
                                <span class="required-field">*</span> CREDIT LIMIT:
                            </label>
                            <input type="number" min="0" step="100" id="creditlimit" name="creditlimit" required value="<?= $creditlimit?>">
                            <br><span class="form-error"><?= $creditlimitErr;?></span>
                        </p>

                        <p>Fields marked with <span class="required-field">*</span> are required.</p>

                        <hr />

                        <input type="submit" value="CREATE NEW ACCOUNT" class="secondary-cart-btn">
                    </form>
                </div><!-- end new-account -->
            </section><!-- end main-content -->

            <hr />

<?php require_once 'footer.php'; ?>
            
