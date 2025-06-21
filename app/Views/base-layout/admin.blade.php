<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bare - Start Bootstrap Template</title>
        <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body class="bg-dark body">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-black">
                <div class="container">
                        <ul class="navbar-nav ms-auto text-large">
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="http://localhost:8080/index.php/admin">Home</a></li>

                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="http://localhost:8080/userlist">Users</a></li> 
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('login/logout') ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <?= $this->renderSection('admin') ?>
        </div>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
