<?= $this->extend('base-layout/login.blade.php') ?>

<?= $this->section('login') ?>




<body class="bg-background">

<div class="container">
<!-- Flash error using Bootstrap alert -->
    <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php endif; ?>

    <!-- Show validation errors -->
    <?php if (isset($validation)) : ?>
        <?= $validation->listErrors('bootstrap') ?>
    <?php endif; ?>
</div>

<form method="post" action="<?= base_url('authenticate') ?>">
    <?= csrf_field() ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Login</h3>
      <form>
        <div class="form-group">
        <label for="username">Username</label><br>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?= old('username') ?>" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="<?= old('password') ?>" required>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <div class="text-center mt-3">
        <small>Don't have an account? <a href="http://localhost:8080/index.php/registration">Sign up</a></small>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</form>
</div>
</body>
<?= $this->endSection() ?>
