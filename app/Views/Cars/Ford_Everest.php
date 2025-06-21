<?= $this->extend('base-layout/Car.blade.php') ?>

<?= $this->section('Car') ?>

<body class="bg-dark">
<div class="container my-5 bg-dark text-light rounded p-4">
  <div class="card mx-auto" style="max-width: 700px;">
    <img src="/Pictures/car1.jpg" class="card-img-top" alt="Ford Everest">
    <div class="card-body text-dark">
      <h3 class="card-title">Ford Everest (2025)</h3>
      <p class="card-text">
        The Ford Everest follows the Ranger into the next generation with an all-new design and a robust selection of advanced tech and safety features.
      </p>
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"><strong>Body Type:</strong> SUV</li>
        <li class="list-group-item"><strong>No. of seats:</strong> 7</li>
        <li class="list-group-item"><strong>Fuel Type:</strong> Diesel</li>
        <li class="list-group-item"><strong>Transmission:</strong> Automatic</li>
        <li class="list-group-item"><strong>Price:</strong> $40.00/day</li>
      </ul>

      <form action="<?= base_url('rent/submit') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="car_id" value="1"> <!-- Ford Everest ID -->

        <div class="mb-3">
          <label for="rent_start"><strong>Rental Start Date:</strong></label>
          <input type="date" id="rent_start" name="rent_start" class="form-control" required min="<?= date('Y-m-d') ?>">
        </div>

        <div class="mb-3">
          <label for="rent_end"><strong>Rental End Date:</strong></label>
          <input type="date" id="rent_end" name="rent_end" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Rental</button>
      </form>
    </div>
  </div>
</div>

<script>
  const rentStart = document.getElementById('rent_start');
  const rentEnd = document.getElementById('rent_end');

  rentStart.addEventListener('change', () => {
    const startDate = new Date(rentStart.value);
    const minEndDate = new Date(startDate);
    minEndDate.setDate(minEndDate.getDate() + 1);
    rentEnd.min = minEndDate.toISOString().split('T')[0];
    if (new Date(rentEnd.value) <= startDate) {
      rentEnd.value = '';
    }
  });
</script>

</body>
<?= $this->endSection() ?>
