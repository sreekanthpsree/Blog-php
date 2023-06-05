<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <?php require_once "../../../css/config.php";
    session_start();
    if (isset($_SESSION['Username'])) {
        header("Location:/Project/Dashboard/");
    }
    if (isset($_SESSION['errorArray'])) {
        echo "11";
        $errorArray = $_SESSION['errorArray'];
    }
    if (isset($_SESSION['valueArray'])) {
        $valueArray = $_SESSION['valueArray'];
    }
    ?>
</head>

<body>
    <?php require_once "../../../PageComponents/Header/navbar.php" ?>
    <div class="container mt-2 mb-3">
        <main class="m-3" style="text-align: center;">
            <form method="post" action="./loginManage.php" class="shadow-lg m-5 p-5 rounded bg-primary-subtle">

                <div>
                    <img class="mb-4" src="../../../logo//logo.png" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
                    <p style="color: red;">
                        <?php echo (isset($_GET['error'])) && ($_GET['error'] = "UserAlreadyExists") ? "User already exists! Please login" : "" ?>
                    </p>
                </div>
                <div class="form-floating p-3">
                    <label for="username" style="text-align:center;"></label>
                    <input type="username"
                        class="<?php echo "form-control-lg " . ((isset($errorArray['Username'])) ? "is-invalid " : "") ?>"
                        id="floatingInput" placeholder="Username" name="Username"
                        value="<?php echo (isset($valueArray['Username'])) ? $valueArray['Username'] : ""; ?>">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?php
                        echo ((isset($errorArray['Username'])) ? "Invalid " . $errorArray['Username'] : ""); ?>
                    </div>
                </div>
                <div class="form-floating p-3">
                    <label for="floatingPassword"></label>
                    <input type="password"
                        class="<?php echo "form-control-lg " . ((isset($errorArray['Password'])) ? "is-invalid " : "") ?>"
                        id="floatingPassword" placeholder="Password" name="Password">
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        <?php
                        echo ((isset($errorArray['Password'])) ? "Invalid " . $errorArray['Password'] : ""); ?>
                    </div>
                </div>
                <button class="btn btn-lg btn-primary position-relative" type="submit">Sign
                    in</button>
                <div class="mt-2"><a href="../signup//index.php">Not yet registerd</a></div>
            </form>
        </main>
    </div>
    <div>
        <?php require_once "../../../PageComponents/Footer/Footer.php" ?>
    </div>
</body>

</html>