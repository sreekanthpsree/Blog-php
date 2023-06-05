<?php
$categorySelected = "All";
$searchText = "All";
require_once "./config/BlogManage.php";
require_once "./helpers/TrimString.php";
require_once "./config/CategoryManage.php";
$helpers = new Helpers();
$blogs = new BlogManage();
$category = new CategoryManage();
$categories = $category->getActiveCategotires();


$page = isset($_GET['page']) ? $_GET['page'] : 1;
//To Check if the category is selected

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category'])) {
    $categorySelected = $_POST['category'];
} elseif (isset($_GET['category']) && $_GET['category'] !== "All") {
    $categorySelected = $_GET['category'];
} else {
    $blog = $blogs->getPostS($page);
}
$blog = $blogs->getPostByCategory($categorySelected, $page);

//To check if the search is clicked

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $blog = $blogs->searchBlog($_POST['search'], $page);
    $searchText = $_POST['search'];
}

//To persist search when changing pages
if (isset($_GET['search']) && $_GET['search'] !== "All") {
    $searchText = $_GET['search'];
    $blog = $blogs->searchBlog($searchText, $page);
}



//To manage the total page count for pagination
if (isset($_GET['page']) && $_GET['page'] > 1) {
    $totalPage = $blogs->pageCount($categorySelected, $_GET['page'] - 1);
    $blog = $blogs->searchBlog("", $page);
}

//To manage the total page count for pagination and persist the category selected

if (isset($categorySelected) && $categorySelected !== "All") {
    $totalPage = $blogs->pageCount($categorySelected);
}

//To make pagination available for search
if (isset($searchText) && $searchText !== "All") {

    $totalPage = $blogs->pageCount("$categorySelected", $page, $searchText);
} else {
    $totalPage = $blogs->pageCount();
}

//To make pagination available when category and search selected
if (isset($searchText) && isset($categorySelected) && $searchText !== "All" && $categorySelected !== "All") {
    $blog = $blogs->getBlogBySearchAndCategory($categorySelected, $searchText, $page);
}

//To manage the next and previous pages and disble accordingly

$previousPage = $page - 1;
$nextPage = $page + 1;
$disableNext = ($page >= $totalPage) ? "disabled" : "";
$disablePrevious = ($page <= 1) ? "disabled" : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .fade-bottom {
            position: relative;
        }

        .fade-bottom::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 60px;
            /* Height of the fade effect */
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            pointer-events: none;
        }

        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease;
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="p-2 border bg-warning shadow-lg rounded-3 w-50" style="text-align:center;margin:auto 25%;">
            <form class="d-flex" role="search" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <input class="form-control me-3" type="search" value="<?php
                $value = $searchText === "All" ? "" : $searchText;
                echo $value;
                ?>" placeholder="Search" aria-label="Search" name="search" />
                <button class="btn" type="submit">
                    Search
                </button>
            </form>
        </div>
        <div class="container p-3 shadow-lg rounded-3 mt-2 ">
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?search=' . urlencode($searchText); ?>" method="POST">
                <div class="form-group p-3 bg-warning shadow-lg bg-gradient rounded-3 m-3">
                    <label for="dropdown" class="fs-3">Categories</label>
                    <select class="form-control" id="dropdown" name="category">
                        <option>All</option>

                        <?php foreach ($categories as $values) {
                            $selected = ($values['categories'] === $categorySelected ? "Selected" : "")
                                ?>
                            <option value="<?php echo $values['categories'] ?>" <?php echo $selected ?>><?php echo $values['categories'] ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button class="btn btn-primary btn-lg shadow-lg m-3" type="submit">
                        Filter
                    </button>
                </div>
            </form>
        </div>
        <div class="container text-center">
            <div class="row row-cols-5 gap-4 m-3 p-1" style="text-align:center;">
                <?php foreach ($blog as $value) { ?>
                    <div class="col card p-1 shadow-lg bg-warning-subtle fade-bottom rounded-3 position-relative"
                        style="width: 18rem;">
                        <div class="position-relative">
                            <img src="<?php echo "/Project/uploads/" . $value['image'] ?>" class="card-img-top"
                                alt="News image" style="width: 100%; height: 100%; object-fit: cover;">
                            <div class="tooltip-content position-absolute top-0 start-0 w-100 h-100"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Click for more details"></div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $value['title']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $value['date'] ?>
                            </p>
                            <p class="card-text">
                                <?php
                                $str = $value['content'];
                                $content = $helpers->trimString($str, 150);
                                echo $content . "....";
                                ?>
                            </p>
                        </div>
                        <a href="/Project/pages/postDetailed.php?id=<?php echo $value['Id']; ?>" class="stretched-link"></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="mt-5">
            <nav aria-label="Page navigation example ">
                <ul class="pagination">
                    <li class="page-item ">
                        <a class="page-link <?php echo $disablePrevious ?>"
                            href="/Project/index.php?page=<?php
                            echo $previousPage . '&category=' . urlencode($categorySelected) . '&search=' . urlencode($searchText); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                        <li class="page-item"><a class="page-link"
                                href="/Project/index.php?page=<?php echo $i . '&category=' . urlencode($categorySelected) . '&search=' . urlencode($searchText); ?>"><?php echo $i ?></a>
                        </li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link <?php echo $disableNext ?>"
                            href="/Project/index.php?page=<?php
                            echo $nextPage . '&category=' . urlencode($categorySelected) . '&search=' . urlencode($searchText); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    </div>
</body>

</html>