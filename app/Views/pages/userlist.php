<?= $this->extend('base-layout/admin.blade.php') ?>

<?= $this->section('admin') ?>


<div class="container mt-5">
    <h2 class="text-center mb-4">User Table</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-grey text-light">
            <thead class="table-light text-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Car Model</th>
                    <th scope="col">Buttons</th>
                </tr>
            </thead>
           <tbody>
    <?php if (!empty($users) && is_array($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['id']) ?></td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['car_model'] ?? '—') ?></td>
                <td>
                    <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">No users found.</td>
        </tr>
    <?php endif; ?>
</tbody>
        </table>
    </div>
</div>


<?= $this->endsection('content') ?>