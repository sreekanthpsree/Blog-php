<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php require_once "../../../css/config.php";
    require_once "../../../config/UserManage.php";
    $userData = new UserManage();
    $user = $userData->getUserById($_GET['id']);
    session_start();

    ?>
    <?php
    // session_start();
    if ($_SESSION['position'] !== "Admin") {
        header("Location:/Project/Dashboard/?error=NoAccess");
        exit();
    }
    if (isset($_SESSION['errorArray'])) {
        $errorArray = $_SESSION['errorArray'];
    }
    if (isset($_SESSION['valueArray'])) {
        $valueArray = $_SESSION['valueArray'];
    }
    if (isset($_GET['id']) && isset($user)) {
        $valueArray = $user;
    }
    ?>
</head>

<body>
    <div>
        <?php require_once "../../../PageComponents/Header/navbar.php" ?>

        <div class="d-flex flex-column m-3 p-3 shadow-lg bg-info-subtle rounded-4">
            <div class="d-flex justify-content-center">
                <div>
                    <h1 class="mb-3 justify-content-center">
                        Add user
                    </h1>
                </div>
            </div>
            <div class="d-flex justify-content-center">
            </div>
            <main class="d-flex rounded-1 justify-content-center  m-4 p-3 ">
                <form method="post"
                    action="../../users/signupManage.php?method=edit<?php echo "&id=" . $valueArray['Id'] ?>">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="userName" class="form-label">User Name</label>

                            <input type="text"
                                class="<?php echo "form-control " . ((isset($errorArray['Username'])) ? "is-invalid " : "") ?>"
                                id="username" name="Username" placeholder="User name"
                                value="<?php echo (isset($valueArray['Username'])) ? $valueArray['Username'] : ""; ?>">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php echo ((isset($errorArray['Username'])) ? "Invalid " . $errorArray['Username'] : ""); ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email"
                                class="<?php echo "form-control " . ((isset($errorArray['Email'])) ? "is-invalid " : "") ?>"
                                id="email" aria-describedby="emailHelp" placeholder="Email" name="Email"
                                value="<?php echo (isset($valueArray['Email'])) ? $valueArray['Email'] : ""; ?>">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php echo ((isset($errorArray['Email'])) ? "Invalid " . $errorArray['Email'] : ""); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text"
                                class="<?php echo "form-control " . ((isset($errorArray['Phonenumber'])) ? "is-invalid " : "") ?>"
                                id="phoneNumber" placeholder="Phone number"
                                value="<?php echo (isset($valueArray['Phonenumber'])) ? $valueArray['Phonenumber'] : ""; ?>"
                                name="Phonenumber">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php
                                echo ((isset($errorArray['Phonenumber'])) ? "Invalid " . $errorArray['Phonenumber'] : ""); ?>
                            </div>
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password"
                                class="<?php echo "form-control " . ((isset($errorArray['Password'])) ? "is-invalid " : "") ?>"
                                id="exampleInputPassword1" name="Password" placeholder="Password">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php
                                echo ((isset($errorArray['Password'])) ? "Invalid " . $errorArray['Password'] : ""); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="status" class="col-sm-3 col-form-label">
                                <h4>Status</h4>
                            </label>
                            <select
                                class="<?php echo "form-control " . ((isset($errorArray['status'])) ? "is-invalid " : "") ?>"
                                id="dropdown" name="status">
                                <?php
                                $options = array("Select", "Active", "Inactive");
                                foreach ($options as $option) {
                                    $selected = ($option == $valueArray['status']) ? "selected" : "";
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                                ?>
                            </select>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                <?php
                                echo ((isset($errorArray['status'])) ? "Select " . $errorArray['status'] : ""); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h5>User type</h5>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="position" value="Select" id="btnradio3"
                                autocomplete="off" checked hidden>
                            <label class="btn btn-outline-primary " for="btnradio3" hidden>Select</label>
                            <input type="radio" class="btn-check" value="Admin" name="position" id="btnradio1"
                                autocomplete="off">
                            <label class="btn btn-outline-primary rounded-start" for="btnradio1">Admin</label>
                            <input type="radio" class="btn-check" name="position" value="Normal" id="btnradio2"
                                autocomplete="off">
                            <label class="btn btn-outline-primary" for="btnradio2">Normal user</label>
                        </div>
                        <div style="color:red;">
                            <?php
                            echo ((isset($errorArray['position'])) ? "Select a user " . $errorArray['position'] : ""); ?>
                        </div>

                    </div>
                    <div style="text-align: center;">
                        <?php unset($_SESSION['errorArray']);
                        unset($_SESSION['valueArray']);
                        ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </main>
        </div>
        <?php require_once "../../../PageComponents/Footer/Footer.php" ?>
    </div>
</body>

</html>