<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReadToDay</title>
    <?php
    session_start();
    ?>
    <style>
        .d-flex {
            display: flex;
        }

        .sidebar {
            flex: 0 0 250px;
        }

        .blog {
            flex: 1;
        }
    </style>
</head>

<body class="bg-warning-subtle">
    <?php require_once "../Project/PageComponents/Header/navbar.php" ?>

    <div class="d-flex bg-warning-subtle m-5">
        <div class="blog">
            <?php require_once "../Project/PageComponents/blog/blog.php" ?>
        </div>
    </div>
    </div>
    <hr>
    <?php require_once "../Project/PageComponents/Footer/Footer.php" ?>
</body>

</html>