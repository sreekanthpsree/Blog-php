<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
    session_start();
    if (!isset($_SESSION['Username'])) {
        header("Location:/Project/Dashboard/users/login");
    }
    ?>
</head>

<body>
    <div>
        <div>
            <?php require_once "../PageComponents/Header/navbar.php" ?>
        </div>
        <div>
            <h1 class="m-3">Dashboard</h1>
        </div>
        <div class="grid position-absolute start-50 translate-middle" style="margin-top: 200px;">

            <button onclick="window.location.href='/Project/Dashboard/blogs/'" type="button"
                class="m-2 p-2 g-col-6 btn btn-secondary">Blogs</button>
            <button onclick="window.location.href= '/Project/Dashboard/categories/'" type="button"
                class="m-2 btn btn-secondary p-2 g-col-6">Categories</button>
            <button type="button" class="m-2 btn btn-secondary p-2 g-col-6"
                onclick="window.location.href='/Project/Dashboard/comments'"><a>Comments</a></button>
            <button type="button" class="m-2 btn btn-secondary p-2 g-col-6"
                onclick="window.location.href='/Project/Dashboard/users/'"><a>Users</a></button>

        </div>
    </div>
</body>

</html>