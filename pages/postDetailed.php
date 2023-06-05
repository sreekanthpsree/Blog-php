<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed page</title>
    <?php

    require_once "../../Project/css/config.php";
    require_once "../config/blogManage.php";
    $blogManage = new BlogManage();
    $blog = $blogManage->getPostById($_GET['id']);

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

<body class="bg-danger">
    <?php require_once "../PageComponents/Header/navbar.php"; ?>
    <div class="container mt-5 bg-danger-subtle rounded-3 shadow-lg p-5">
        <div class="card mx-auto shadow border border-0" style="max-width: 800px;">
            <div class="rounded-3  shadow">
                <img src="/Project/uploads/<?php echo $blog['image'] ?>" class="card-img-top rounded-3" alt="images">
            </div>
            <div class="card-body shadow bg-danger-subtle rounded-3">
                <h1 class="card-title">
                    <?php echo $blog['title'] ?>
                </h1>
                <h4>
                    <?php echo "By " . $blog['author'] ?>
                </h4>
                <h5>
                    <?php echo "Date: " . $blog['date'] ?>
                </h5>
                <p class="card-text fs-3">
                    <?php echo $blog['content'] ?>
                </p>
            </div>
        </div>
        <div class="m-5 p-4 rounded-4 w-50 bg-danger-subtle bg-gradient">
            <h4>Add comment</h4>
            <form action="../PageComponents//comments//addComm.php?id=<?php echo $_GET['id'] ?>" method="post"
                style="max-width: 400px; margin: 0 auto;">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email"
                        class="form-control <?php echo (isset($errorArray['email'])) ? 'is-invalid' : '' ?>"
                        name="email" value="<?php echo (isset($valueArray['email'])) ? $valueArray['email'] : '' ?>">
                    <?php if (isset($errorArray['email'])): ?>
                        <div class="invalid-feedback">
                            Please enter a valid Email
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name"
                        class="form-control <?php echo (isset($errorArray['name'])) ? 'is-invalid' : '' ?>" name="name"
                        value="<?php echo (isset($valueArray['name'])) ? $valueArray['name'] : '' ?>">
                    <?php if (isset($errorArray['name'])): ?>
                        <div class="invalid-feedback">
                            Please enter a valid name
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea rows="3" id="comment"
                        class="form-control <?php echo (isset($errorArray['comment'])) ? 'is-invalid' : '' ?>"
                        name="comment"><?php echo (isset($valueArray['comment'])) ? $valueArray['comment'] : '' ?></textarea>
                    <?php if (isset($errorArray['comment'])): ?>
                        <div class="invalid-feedback">
                            Please enter a comment
                        </div>
                    <?php endif; ?>
                </div>
                <div class="m-3">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
        <hr>
        <?php require_once "../PageComponents/comments/viewComment.php" ?>
    </div>
    <?php require_once "../PageComponents/Footer/Footer.php" ?>
</body>

</html>