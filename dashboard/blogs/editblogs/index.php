<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit blog</title>
    <?php require_once "../../../css/config.php";
    require_once "../../../config/BlogManage.php";
    require_once "../../../config/CategoryManage.php";
    require_once "../../../config/ValidateUserInput.php";

    $blogs = new BlogManage();
    $categories = new CategoryManage();
    $category = $categories->getActiveCategotires();
    $blog = $blogs->getPostById($_GET['id']);
    session_start();

    if (isset($_SESSION['errorArray'])) {
        echo "11";
        $errorArray = $_SESSION['errorArray'];
        unset($_SESSION['errorArray']);
    }
    if (isset($_SESSION['valueArray'])) {
        $blog = $_SESSION['valueArray'];
        unset($_SESSION['valueArray']);
    }

    ?>
</head>

<body>
    <?php require_once "../../../PageComponents/Header/navbar.php" ?>
    <div class="position-absolute w-50" style="margin:10%;border:2px">
        <h1>Edit blog</h1>
        <form class="m-3" method="post" action="edit.php/?id=<?php echo $_GET['id']; ?>">
            <fieldset>
                <table>
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">
                            <h3>Title</h3>
                        </label>
                        <div class="col-sm-10">
                            <input name="title" type="text"
                                class="<?php echo "form-control " . ((isset($errorArray['title'])) ? "is-invalid " : "") ?>"
                                id="title" value="<?php echo (isset($blog['title'])) ? $blog['title'] : ""; ?>">
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
                                id="content"><?php echo (isset($blog['content'])) ? $blog['content'] : ""; ?></textarea>
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
                            <select class="form-control" id="dropdown" name="category">
                                <?php
                                foreach ($category as $values) {
                                    $selected = ($values['categories'] == $blog['category'] ? 'selected' : "");
                                    ?>
                                    <option value="<?php echo $values['categories'] ?>" <?php echo $selected ?>><?php echo $values['categories'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="content" class="col-sm-2 col-form-label">
                            <h3>Image</h3>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control form-control-lg" id="formFileLg" type="file">
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