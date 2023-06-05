<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CricNews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <?php require_once "../../config/commentsManage.php";
    $comment = new CommentsManage();
    $comments = $comment->getComments();
    session_start();
    if ($_SESSION['position'] !== "Admin") {
        header("Location:/Project/Dashboard/?error=NoAccess");
        exit();
    }

    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <?php require_once "../../PageComponents/Header/navbar.php" ?>
    <div class="m-4 position-absolute start-50 top-50 translate-middle w-50">
        <table class="table table-striped" bo>
            <header>
                <h1>Comments</h1>
            </header>
            <hr>
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Comments</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Post</th>
                    <th scope="col">Edit</th>
                    <th scope='col'>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $values) { ?>


                    <tr>
                        <th scope="row">
                            <?php echo $values['Id'] ?>
                        </th>
                        <td>
                            <?php echo $values['Comment'] ?>
                        </td>
                        <td>
                            <?php echo $values['Name'] ?>
                        </td>
                        <td>
                            <?php
                            $approved = $values['Approved'] ? "Approved" : "Not Approved";
                            echo $approved ?>
                        </td>
                        <td>
                            <?php
                            $postName = $comment->getPostName($values['PostId']);
                            echo $postName['title'];
                            ?>
                        </td>
                        <td>
                            <?php
                            $status = $comment->getApprovalStatus($values['Id']);
                            $buttonStatus = $status['Approved'] ? "disabled" : "";
                            $buttonColor = $status['Approved'] ? "secondary" : "primary";
                            $buttonName = $status['Approved'] ? "Approved" : "Approve"; ?>
                            <form action="./approveComments//approve.php?id=<?php echo $values['Id'] ?>" method="post">
                                <button type="submit" class="btn btn-<?php echo $buttonColor ?>" <?php echo $buttonStatus ?>>
                                    <?php
                                    echo $buttonName
                                        ?>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="./deleteComments//delete.php?id=<?php echo $values['Id'] ?>   " method="post">
                                <button type="submit" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="fixed-bottom">
        <?php require_once "../../PageComponents/Footer/Footer.php" ?>
    </div>

</body>

</html>