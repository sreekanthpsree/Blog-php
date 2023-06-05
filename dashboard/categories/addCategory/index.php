<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit blog</title>
    <?php require_once "../../../config/CategoryManage.php";
    require_once "../../../config/ValidateUserInput.php";
    session_start();
    if ($_SESSION['position'] !== "Admin") {
        header("Location:/Project/Dashboard/?error=NoAccess");
        exit();
    }


    $category = new CategoryManage();

    if ($_POST) {

        $validateUser = new ValidateInputField($_POST, "/Project/Dashboard/categories/addCategory?error=InvalidInput");
        $validateUser->validateInput();
        $category->addCategory($_POST['category'], $_POST['status']);
        header("Location:/Project/Dashboard/categories/");
        exit();
    }
    if (isset($_SESSION['errorArray'])) {

        $errorArray = $_SESSION['errorArray'];
        unset($_SESSION['errorArray']);
    }
    if (isset($_SESSION['valueArray'])) {
        $valueArray = $_SESSION['valueArray'];
        unset($_SESSION['valueArray']);
    }



    ?>
</head>

<body>
    <div>
        <?php require_once "../../../PageComponents/Header/navbar.php" ?>
        <div class="container mt-5 w-50">
            <h1>Add category</h1>
            <hr>
            <form class="m-3" method="POST" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                <fieldset>
                    <table>
                        <div class="row mb-4">
                            <label for="category" class="col-sm-3 col-form-label">
                                <h3>Category name</h3>
                            </label>
                            <div class="col-sm-10">
                                <input type="text"
                                    class="<?php echo "form-control " . ((isset($errorArray['category'])) ? "is-invalid " : "") ?>"
                                    id="category" name="category"
                                    value="<?php echo (isset($valueArray['category'])) ? $valueArray['category'] : "" ?>">
                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                    Please Enter a Category name
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="status" class="col-sm-3 col-form-label">
                                <h3>Status</h3>
                            </label>
                            <div class="col-sm-10">
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
                                    Please select a status
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </table>
                </fieldset>
            </form>
        </div>
        <div class="fixed-bottom">
            <?php require_once "../../../PageComponents/Footer/Footer.php" ?>
        </div>

</body>

</html>