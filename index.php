<?php
// Handle rate fetching mockup (simulate response on POST)
$showResults = false;
$rates = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["test_ups"])) {
    $showResults = true;

    // Normally you would fetch from UPS API here. We'll mock data.
    $rates = [
        ["name" => "UPS® Ground", "cost" => "$10.52 USD"],
        ["name" => "UPS 3 Day Select® (3 days)", "cost" => "$20.40 USD"],
        ["name" => "UPS 2nd Day Air® (2 days)", "cost" => "$29.97 USD"],
        ["name" => "UPS 2nd Day Air A.M.® (2 days)", "cost" => "$33.02 USD"],
        ["name" => "UPS Next Day Air Saver® (1 day)", "cost" => "$50.62 USD"],
        ["name" => "UPS Next Day Air® (1 day)", "cost" => "$52.79 USD"],
        ["name" => "UPS Next Day Air® Early (1 day)", "cost" => "$86.57 USD"]
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Test UPS® Rates</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .open-modal-btn {
      padding: 10px 20px;
      font-size: 16px;
      margin: 30px;
      cursor: pointer;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      width: 90%;
      max-width: 1000px;
      max-height: 90%;
      overflow-y: auto;
    }

    .tab-header {
      display: flex;
      border-bottom: 1px solid #ccc;
    }

    .tab-header div {
      padding: 10px 20px;
      cursor: pointer;
    }

    .tab-header .active {
      border-bottom: 3px solid #000;
      font-weight: bold;
    }

    .tab-content {
      display: none;
      padding-top: 20px;
    }

    .tab-content.active {
      display: block;
    }

    .form-row {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }

    .form-group {
      flex: 1;
      min-width: 200px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 4px;
    }

    input, select {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      text-align: left;
      padding: 10px;
      border: 1px solid #ccc;
    }

    .note {
      background: #e6f0ff;
      padding: 10px;
      border-left: 4px solid #0073e6;
      margin-bottom: 15px;
    }

    .actions {
      margin-top: 20px;
      text-align: right;
    }

    .btn {
      padding: 10px 16px;
      border: none;
      background: #000;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
    }

    .modal-inner {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      width: 100%;
      max-width: 1000px;
      position: relative;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
    }
  </style>
</head>
<body>

<!-- Open Modal Button -->
<button class="open-modal-btn" onclick="openModal()">Test UPS® Rates</button>

<!-- Modal -->
<div id="rateModal" class="modal">
  <div class="modal-inner">
    <span class="close-btn" onclick="closeModal()">×</span>

    <div class="tab-header">
      <div id="details-tab" class="active" onclick="switchTab('details')">Details</div>
      <div id="results-tab" onclick="switchTab('results')">Results</div>
    </div>

    <div id="details" class="tab-content active">
      <form method="POST">
        <div class="form-row">
          <div class="form-group">
            <label>Package Type</label>
            <select name="package_type">
              <option value="Box">Box</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group"><label>Length</label><input type="number" name="length" value="30" required></div>
          <div class="form-group"><label>Width</label><input type="number" name="width" value="20" required></div>
          <div class="form-group"><label>Height</label><input type="number" name="height" value="15" required></div>
          <div class="form-group"><label>Unit</label>
            <select name="unit"><option>cm</option></select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group"><label>Weight</label><input type="number" name="weight" value="1" required></div>
        </div>

        <h4>Ship From</h4>
        <div class="form-row">
          <div class="form-group"><label>Country</label><select name="from_country"><option>United States</option></select></div>
          <div class="form-group"><label>Address</label><input name="from_address" value="423 Bussen Underground Road"></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label>City</label><input name="from_city" value="St. Louis"></div>
          <div class="form-group"><label>State</label><input name="from_state" value="Missouri"></div>
          <div class="form-group"><label>ZIP</label><input name="from_zip" value="63129"></div>
        </div>

        <h4>Ship To</h4>
        <div class="form-row">
          <div class="form-group"><label>Country</label><select name="to_country"><option>United States</option></select></div>
          <div class="form-group"><label>Address</label><input name="to_address" value="423 Bussen Underground Road"></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label>City</label><input name="to_city" value="St. Louis"></div>
          <div class="form-group"><label>State</label><input name="to_state" value="Missouri"></div>
          <div class="form-group"><label>ZIP</label><input name="to_zip" value="63129"></div>
        </div>

        <div class="actions">
          <button type="submit" name="test_ups" class="btn">Test UPS® rates</button>
        </div>
      </form>
    </div>

    <div id="results" class="tab-content <?php echo $showResults ? 'active' : ''; ?>">
      <?php if ($showResults): ?>
        <div class="note">
          Your rates displayed to customers at checkout may differ. These sample rates do not include the default box weight or any rate adjustments in your shipping zones.
        </div>

        <table>
          <thead>
            <tr><th>Fetched rates</th><th>Cost</th></tr>
          </thead>
          <tbody>
            <?php foreach ($rates as $rate): ?>
              <tr><td><?= $rate["name"] ?></td><td><?= $rate["cost"] ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No rate data fetched yet.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
  function switchTab(tab) {
    document.getElementById("details").classList.remove("active");
    document.getElementById("results").classList.remove("active");
    document.getElementById("details-tab").classList.remove("active");
    document.getElementById("results-tab").classList.remove("active");

    document.getElementById(tab).classList.add("active");
    document.getElementById(tab + "-tab").classList.add("active");
  }

  function openModal() {
    document.getElementById('rateModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('rateModal').style.display = 'none';
  }

  <?php if ($showResults): ?>
    window.onload = function() {
      openModal();
      switchTab('results');
    };
  <?php endif; ?>
</script>

</body>
</html>
