<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bare - Start Bootstrap Template</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-black">
                <div class="container">
                    <a class="navbar-brand">Welcome <strong class="text-danger" ><?= session()->get('username'); ?></strong></a><br>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="http://localhost:8080/index.php/dashboard">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= base_url('login/logout') ?>">Logout</a></li>  
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="http://localhost:8080/index.php/about">About</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="container">
            <?= $this->renderSection('Car') ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
        
    </body>
</html>
