<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add blog</title>
    <?php require_once "../../../css/config.php" ?>
    <?php
    require_once "../../../config/BlogManage.php";
    require_once "../../../config/ValidateUserInput.php";
    session_start();
    $addBlog = new BlogManage();
    if ($_POST) {
        $validateInput = new ValidateInputField($_POST, "/Project/Dashboard/blogs/addBlog?error=Invalidinput");
        $validateInput->validateInput();
        print_r($_POST);
        print_r($_FILES);
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "../../../uploads/" . $filename;
        $addBlog->addBlog($_POST['title'], $_POST['content'], $_POST['category'], $filename);
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "ashda";
            echo "<h3>  Failed to upload image!</h3>";
        }
        unset($_SESSION['errorArray']);
        unset($_SESSION['valueArray']);
        header("Location:/Project/Dashboard/blogs/");
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
    require_once "../../../config/CategoryManage.php";
    $categories = new CategoryManage();
    $category = $categories->getActiveCategotires();
    ?>
</head>

<body>
    <?php require_once "../../../PageComponents/Header/navbar.php" ?>
    <div class="container mt-5" style="margin:10%;border:2px">
        <h1>Add blog</h1>
        <form class="m-3" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post"
            enctype="multipart/form-data">
            <fieldset>
                <table>
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">
                            <h3>Title</h3>
                        </label>
                        <div class="col-sm-10">
                            <input name="title" type="text"
                                class="<?php echo "form-control " . ((isset($errorArray['title'])) ? "is-invalid " : "") ?>"
                                id="title"
                                value="<?php echo (isset($valueArray['title'])) ? $valueArray['title'] : ""; ?>">
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                Please Enter a title
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="content" class="col-sm-2 col-form-label">
                            <h3>Content</h3>
                        </label>
                        <div class="col-sm-10">
                            <textarea name="content" type="password"
                                class="<?php echo "form-control " . ((isset($errorArray['content'])) ? "is-invalid " : "") ?>"
                                rows="4"
                                id="content"><?php echo (isset($valueArray['content'])) ? $valueArray['content'] : ""; ?></textarea>
                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                Please Enter a content
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">
                            <h3>Category</h3>
                        </label>
                        <div class="col-sm-10">
                            <select
                                class="<?php echo "form-control " . ((isset($errorArray['category'])) ? "is-invalid " : "") ?>"
                                id="dropdown" name="category">
                                <?php
                                $options = $category;
                                foreach ($category as $option) {
                                    $selected = ($option['categories'] == $valueArray['status']) ? "selected" : "";
                                    ?>
                                    <option value="<?php echo $option['categories'] ?>"><?php echo $option['categories'] ?>
                                    </option>";
                                <?php } ?>
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">
                            <h3>Image</h3>
                        </label>
                        <div class="col-sm-10">
                            <input name="image" class="form-control form-control-lg" id="formFileLg" type="file">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </table>
            </fieldset>
        </form>
    </div>
    <div class="fixed-bottom">
        <?php require_once "../../../PageComponents/Footer/Footer.php" ?>
    </div>
</body>

</html>