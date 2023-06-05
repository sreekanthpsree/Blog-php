<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit blog</title>
    <?php
    require_once "../../../config/CategoryManage.php";
    session_start();

    // Will exit if the user is not admin
    
    if ($_SESSION['position'] !== "Admin" || isset($_SESSION['Username']) || isset($_SESSION['position'])) {
        header("Location:/Project/Dashboard/?error=NoAccess");
        exit();
    }
    $categories = new CategoryManage();
    $categoryId = $_GET['id'];
    $category = $categories->getCategoryById($categoryId);
    if (isset($_SESSION['errorArray'])) {
        $errorArray = $_SESSION['errorArray'];
        unset($_SESSION['errorArray']);
    }
    if (isset($_SESSION['valueArray'])) {
        $category = $_SESSION['valueArray'];
        unset($_SESSION['valueArray']);
    }
    ?>

</head>

<body>
    <?php require_once "../../../PageComponents/Header/navbar.php" ?>
    <div class="position-absolute w-50" style="margin:10%;border:2px">
        <h1>Edit category</h1>
        <hr>
        <form id="editForm" class="m-3" method="post" action="edit.php/?id=<?php echo $category['Id']; ?>">
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
                                value="<?php echo (isset($category['category'])) ? $category['category'] : "" ?>">
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
                                    $selected = ($option == $category['status']) ? "selected" : "";
                                    echo "<option value='$option' $selected>$option</option>";
                                }
                                ?>
                            </select>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                Please select a status
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </table>
            </fieldset>
        </form>
    </div>
    <div class="fixed-bottom">
        <?php require_once "../../../PageComponents/Footer/Footer.php" ?>
    </div>
</body>

</html>