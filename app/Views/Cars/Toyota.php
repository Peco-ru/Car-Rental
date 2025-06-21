<?= $this->extend('base-layout/Car.blade.php') ?>

<?= $this->section('Car') ?>
<body class='bg-dark'>

  <div class="container my-5">
    <div class="card mx-auto" style="max-width: 700px;">
      <img src="/Pictures/car2.jpg" class="card-img-top" alt="Toyota Fortuner">
      <div class="card-body">
        <h3 class="card-title">Toyota Fortuner</h3>
        <p class="card-text">
          The Toyota Fortuner is the best-selling midsize SUV in the Philippines. This ladder-frame vehicle has been around since the early 2000s and has since become a household name thanks to its rugged platform and tested durability thanks to its robust platform and strong brand support. The second-generation model has been consistently topping the sales chart, not only in its segment but for the entire Philippine automotive industry as well. Fast-forward to October 2020, and the Toyota Motor Philippines finally brings in the updated version of the midsize SUV.
        </p>
        <ul class="list-group list-group-flush mb-3">
          <li class="list-group-item"><strong>Body Type:</strong> SUV</li>
          <li class="list-group-item"><strong>No. of seats:</strong> 7</li>
          <li class="list-group-item"><strong>Fuel Type:</strong> Diesel</li>
          <li class="list-group-item"><strong>Transmission:</strong> Manual</li>
          <li class="list-group-item"><strong>Price:</strong> $40.00/day</li>
        </ul>
        <form action="<?= base_url('rent/submit') ?>" method="post">
            <?= csrf_field() ?> <!-- CSRF protection -->

            <input type="hidden" name="car_id" value="4"> <!-- Car ID -->

            <div class="mb-3">
          <label for="rent_start"><strong>Rental Start Date:</strong></label>
          <input type="date" id="rent_start" name="rent_start" class="form-control" required min="<?= date('Y-m-d') ?>">
        </div>

        <div class="mb-3">
          <label for="rent_end"><strong>Rental End Date:</strong></label>
          <input type="date" id="rent_end" name="rent_end" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
        </div>

            <button type="submit" class="btn btn-primary">Submit Rental</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const rentStart = document.getElementById('rent_start');
    const rentEnd = document.getElementById('rent_end');

    rentStart.addEventListener('change', () => {
      const startDate = new Date(rentStart.value);
      if (rentEnd.value) {
        const endDate = new Date(rentEnd.value);
        if (endDate <= startDate) {
          rentEnd.value = '';
        }
      }
      const minEndDate = new Date(startDate);
      minEndDate.setDate(minEndDate.getDate() + 1);
      rentEnd.min = minEndDate.toISOString().split('T')[0];
    });
  </script>
</body>
<?= $this->endSection() ?>
