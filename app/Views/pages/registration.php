<?= $this->extend('base-layout/login.blade.php') ?>

<?= $this->section('login') ?>
<body>

<?php if(isset($validation)): ?>
    <div style="color:red;">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<form action="<?= base_url('/registration/store') ?>" method="post">
    <?= csrf_field() ?>


    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h3>Register</h3>
            <div class="form-group">
                <label>Username</label><br>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?= set_value('username') ?>"><br>
            </div>

            <div class="form-group">
                <label>Email</label><br>
                <input type="email" class="form-control" placeholder="Enter Email" name="email" value="<?= set_value('email') ?>"><br>
            </div>


            <div class="form-group">
                <label>Password</label><br>
                <input type="password" class="form-control" placeholder="Password" name="password"><br>
            </div>

            <div class="form-group">
                <label>Confirm Password</label><br>
                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirm"><br>
            </div>

            <div class="mb-3">
                <label for="inputGroupSelect02" class="form-label">Select Role</label>
                <select class="form-select" id="inputGroupSelect02" name="role">
                    <option value="" selected disabled>Choose a role...</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>

            

            <div class="text-center mt-3">
            <small>Already have an account?<a href="http://localhost:8080/index.php/login">login</a></small>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</div>
</div>
</form>

</body>
<?= $this->endSection() ?>
