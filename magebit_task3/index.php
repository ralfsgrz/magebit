<?php
    include "./classes/Validator.php";
    include "./classes/Subcription.php";
    include "./db/database.php";

    if(isset($_POST['submit']))            // if form submitted run this
    {
        $val = new Validator($_POST);
        $errors = $val->validateForm();    // store php validation errors in an array

        if(empty($errors))                 // if no errors returned 
        {
            $db = new Database();
            $conn = $db->getConnection();

            $subscription = new Subcription($conn);
            $subscription->setEmail($_POST['email']);

            $subscription->create();
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mid/Junior - Web Developer Test | Task 3</title>
</head>
<body>
    <div id="wrapper">
        <div id="base-left">
            <div id="top">
                <div id="top-bar">
                    <div id="logo-pineapple">
                        <img id="union" src="./img/Union.png" alt="pineapple">
                        <img id="pineapple" src="./img/pineapple..png" alt="pineapple-text">
                    </div>
                    <div id="navigation">
                        <a id="nav-item" href="#">About</a>
                        <a id="nav-item" href="#">How it works</a>
                        <a id="nav-item" href="#">Contact</a>
                    </div>
                </div>
            </div>
            <div id="content">
                <div id="success"><img id="trophy" src="./img/ic_success.svg" alt="" /></div>
                <h1 id="heading">Subscribe to newsletter</h1>
                <h3 id="subheading">Subscribe to our newsletter and get 10% discount on pineapple glasses.</h3>
                <form id="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <div id="information">
                        <div id="email-input">
                            <div id="pre-input"></div>
                            <input id="email" type="text" name="email" placeholder="Type your email address here..." 
                                    value="<?php echo htmlspecialchars($_POST["email"] ?? ''); // set back previous input value?>"/>
                            <button id="arrow" name="submit" value="submit"><img  src="./img/ic_arrow.svg" alt="arrow" /></button>
                        </div>
                        <div class="error e-error"><?php echo $errors["email"] ?? ''; // display the error message?></div> 
                        <div id="tos">
                            <input id="terms" name="terms" type="checkbox" />
                            <label id="terms-text" for="terms">I agree to <a href="#">terms of service</a></label>
                        </div>
                        <div class="error t-error"><?php echo $errors["terms"] ?? ''; // display the error message?></div>
                    </div>
                </form>
                <hr id="line">
                <div id="socials">
                    <a id="facebook" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a id="instagram" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a id="twitter" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a id="youtube" href="#">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div id="base-right">
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>