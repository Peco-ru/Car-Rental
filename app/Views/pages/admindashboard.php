<?= $this->extend('base-layout/admin.blade.php') ?>

<?= $this->section('admin') ?>

<style>
header.bg-image {
    background-size: cover;
    background-position: center;
    height: 250px;
    background-color: <?= esc($backgroundColor ?? 'transparent') ?>;
    background-image: url('<?= esc($background) ?>');
}
</style>

<script>
function changeBackground(imageUrl) {
    const header = document.querySelector('header.bg-image');
    if (header) {
        header.style.backgroundImage = `url('${imageUrl}')`;
    }
}
</script>


<div class="container mt-3 text-center">
    <button class="btn btn-primary me-2" onclick="changeBackground('/Pictures/bg1.jpg')">Background 1</button>
    <button class="btn btn-secondary me-2" onclick="changeBackground('/Pictures/bg2.avif')">Background 2</button>
    <button class="btn btn-success" onclick="changeBackground('/Pictures/bg3.jpg')">Background 3</button>
</div>

        <!-- Header-->
<header class="bg-image rounded-3 border border-danger mt-5 py-5">
    <div class="container">
        <div class="text-center text-light">
            <h1 class="display-4 fw-bolder">Rent a Car</h1>
        </div>
        <div class="text-center text-light d-flex justify-content-center">
            <p class="lead fw-normal w-50 bg-danger text-center rounded-5">Welcome Admin</p>
        </div>
    </div>
</header>

<div class="container font-large rounded-3 mt-2 bg-light">
        <h1>Editor Mode</h1>
        <!-- Section-->
        <section class="py-0">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img src="/Pictures/car1.jpg" class="card-img-top" alt="Ford"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Ford Everest</h5>
                                    <!-- Product price-->
                                    $40.00/day
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Remove Car</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img src="/Pictures/car2.jpg" class="card-img-top" alt="Ford"/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">NISSAN TERRA</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$20.00</span>
                                    $18.00/day
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Remove Car</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="/Pictures/car3.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Mitsubishi Montero Sport</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through">$50.00</span>
                                    $25.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Remove Car</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="/Pictures/car4.jpg" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">TOYOTA FORTUNER</h5>
                                    <!-- Product price-->
                                    $40.00
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="#">Remove Car</a></div>
                            </div>
                        </div>
            
        </div>            
        </section>

        <div class="container mt-4">
    <form action="<?= site_url('/admin/upload-background') ?>" method="post" enctype="multipart/form-data">
        <label for="background">Upload Background Image</label>
        <input type="file" name="background" class="form-control" accept="image/*" required>
        <button type="submit" class="btn btn-success mt-2">Upload</button>
    </form>
</div>



        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>
<?= $this->endSection() ?>

