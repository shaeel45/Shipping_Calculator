<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test UPS® Rates</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .form-section {
      max-width: 800px;
      margin: 20px auto;
      padding: 25px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }
    h2 {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
    }
    input[type="text"], input[type="number"], select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
    }
    .row {
      display: flex;
      gap: 20px;
    }
    .row .col {
      flex: 1;
    }
    .submit-btn {
      margin-top: 25px;
      padding: 10px 20px;
      font-size: 16px;
    }
  </style>
</head>
<body>

<div class="form-section">
  <h2>Test UPS® rates</h2>
  <form method="POST" action="get_rate.php">
    <label>Package Type</label>
    <select name="package_type">
      <option value="box">Box</option>
      <option value="envelope">Envelope</option>
    </select>

    <label>Size and Weight</label>
    <div class="row">
      <div class="col">
        <input type="number" name="length" placeholder="Length" required>
      </div>
      <div class="col">
        <input type="number" name="width" placeholder="Width" required>
      </div>
      <div class="col">
        <input type="number" name="height" placeholder="Height" required>
      </div>
      <div class="col">
        <select name="unit">
          <option value="CM">cm</option>
          <option value="IN">in</option>
        </select>
      </div>
    </div>

    <label>Weight</label>
    <input type="number" name="weight" step="0.1" required> lb

    <div class="row">
      <div class="col">
        <h3>Ship from</h3>
        <?php include 'address_fields.php'; ?>
      </div>
      <div class="col">
        <h3>Ship to</h3>
        <?php include 'address_fields.php'; ?>
      </div>
    </div>

    <button class="submit-btn" type="submit">Test UPS® rates</button>
  </form>
</div>

</body>
</html>
