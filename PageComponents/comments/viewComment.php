<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <?php require_once "../config/commentsManage.php";

    $comments = new CommentsManage();
    $comment = $comments->getCommentsByPost($_GET['id']);
    ?>

    <style>
        .comment-card {
            margin-bottom: 20px;
        }

        .comment-card .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
        }

        .comment-card .card-body {
            padding: 10px;
        }

        .comment-card .card-text {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Comments</h3>
        <hr>

        <div class="comments-section">
            <?php foreach ($comment as $values) { ?>
                <div class="comment-card card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <?php echo $values['Name'] ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?php echo $values['Comment'] ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>