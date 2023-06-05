<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CricNews</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
  <?php
  if (isset($_GET['action']) && $_GET['action'] === 'Logout') {
    session_destroy();
    header("Location: /Project/");
    exit();
  }
  $action = isset($_SESSION['Username']) ? 'Logout' : 'Login';

  if (isset($_GET['action']) && $_GET['action'] === 'Login') {
    header("Location: /Project/Dashboard/users/login");
    exit();
  }
  ?>
  <div class="shadow p-3 rounded-4">
    <nav class="shadow rounded-3 navbar fixed-top p-3 navbar-expand-lg navbar-light bg-warning bg-gradient">
      <div class="container-fluid">
        <a class="navbar-brand" href="/Project">
          <!-- <img src="/Project/logo/logo.png" alt="Logo" width="40" height="30" class="d-inline-block align-text-top" /> -->
          <h3 style="display:inline;">
            ReadToDay</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a href="http://localhost/Project/index.php" class="nav-link active" aria-current="page">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item me-2 shadow-lg rounded-3 ">
              <?php if (isset($_SESSION['Username'])): ?>
                <div class="dropdown bg-warning">
                  <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <?php echo "Hi, " . $_SESSION['Username'] ?>
                  </button>
                  <ul class="dropdown-menu bg-warning">
                    <li><a class="dropdown-item" href="/Project/Dashboard">Go to dashboard</a></li>
                  </ul>
                </div>
              <?php endif; ?>
            </li>
            <li class="nav-item me-2 m-1">
              <a class="btn btn  btn-<?php echo ($action === 'Logout') ? 'danger' : 'primary'; ?>"
                href="<?php echo $_SERVER['PHP_SELF']; ?>?action=<?php echo $action; ?>">
                <?php echo $action; ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  </div>
</body>

</html>