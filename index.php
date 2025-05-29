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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
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

    .length-row {
      display: flex;
      margin-bottom: 10px;
    }

    .form-group {
      flex: 1;
      min-width: 200px;
    }

    .length-group,
    .unit {
      min-width: 150px;

    }


    label {
      font-weight: bold;
      display: block;
      margin-bottom: 4px;
    }

    .package-type {
      width: 100%;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .length,
    .width,
    .height {
      width: 125px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      border-top: none;
      border-bottom: none;
    }

    th,
    td {
      text-align: left;
      border: 1px solid #ddd;
      padding: 8px;
    }

    thead tr:first-child th {
      border-top: none;
    }

    tbody tr:last-child td {
      border-bottom: none;
    }


    .note {
      background: #e6f0ff;
      padding: 17px;
      margin-bottom: 15px;
      border-radius: 13px;
      color: #0073e6;
      border: 1px solid #0073e6;
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

    .btn-close {
      padding: 10px 16px;
      border: none;
      background: #f1f1f1;
      color: #373737;
      cursor: pointer;
      border-radius: 4px;
      margin-right: 2px;
    }

    .modal-inner {
      background-color: white;
      border-radius: 10px;
      width: 100%;
      max-width: 1000px;
    }

    .header-modal {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #f1f1f1;
      border-bottom: 1px solid #ccc;
      border-top-left-radius: 8px;
      border-top-right-radius: 8px;
    }

    .header-modal h5 {
      margin: 0;
      font-size: 16px;
      font-weight: 600;
    }

    .close-btn {
      font-size: 20px;
      cursor: pointer;
      color: #333;
      transition: color 0.2s ease;
    }

    .close-btn:hover {
      color: red;
    }

    .row {
      display: flex;
      gap: 20px;
    }

    .row .col {
      flex: 1;
    }

    .full-length {
      width: 423px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .country-length {
      width: 435px;
      ;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .address-group {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
    }

    .full-lengths {
      width: 200px;
      padding: 6px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .fields {
      padding: 5px;
    }
  </style>
</head>

<body>

  <button class="open-modal-btn" onclick="openModal()">Test UPS® Rates</button>
  <div id="rateModal" class="modal">
    <div class="modal-inner">
      <div class="header-modal">
        <h5>Test UPS® Rates</h5>
        <span class="close-btn" onclick="closeModal()">×</span>
      </div>
      <div class="modal-content">
        <div class="tab-header">
          <div id="details-tab" class="active" onclick="switchTab('details')">Details</div>
          <div id="results-tab" onclick="switchTab('results')">Results</div>
        </div>

        <div id="details" class="tab-content active">
          <form method="POST">
            <div class="form-row">
              <div class="form-group">
                <label>Package type</label>
                <select name="package_type" class="package-type">
                  <option value="Box">Box</option>
                  <option value="Envelope">Envelope</option>
                </select>
              </div>
            </div>
            <h3>Size and weight</h3>
            <div class="length-row">
              <div class="length-group"><label>Length</label><input type="number" class="length" name="length" value="30" required></div>
              <div class="length-group"><label>Width</label><input type="number" class="width" name="width" value="20" required></div>
              <div class="length-group"><label>Height</label><input type="number" class="height" name="height" value="15" required></div>
              <div class="length-group"><label>Unit</label>
                <select class="height" name="unit" class="unit">
                  <option>cm</option>
                  <option>in</option>
                </select>

              </div>
            </div>

            <div class="form-row">
              <div class="form-group"><label>Weight</label><input type="number" class="package-type" name="weight" value="1" required></div>
              <div class="length-group"><label>Unit</label>
                <select class="height" name="unit" class="unit">
                  <option>lb</option>
                  <option>kg</option>
                </select>

              </div>
            </div>

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
            <div class="actions">
              <button type="button" name="test_ups" class="btn-close" onclick="closeModal()">Close</button>
              <button type="submit" name="test_ups" class="btn">Test UPS® rates</button>
            </div>
          </form>
        </div>

        <div id="results" class="tab-content <?php echo $showResults ? 'active' : ''; ?>">
          <?php if ($showResults): ?>
            <div class="note">
              <i class="fas fa-info-circle"></i> Your rates displayed to customers at checkout may differ. These sample rates do not include the default box weight or any rate adjustments in your shipping zones.
            </div>

            <table>
              <thead>
                <tr>
                  <th>Fetched rates</th>
                  <th>Cost</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($rates as $rate): ?>
                  <tr>
                    <td><?= $rate["name"] ?></td>
                    <td><?= $rate["cost"] ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>

            <div class="actions">
              <button type="button" name="test_ups" class="btn-close" onclick="switchTab('details')">Close</button>
              <button type="submit" name="test_ups" class="btn">Test UPS® rates</button>
            </div>
          <?php else: ?>
            <p>No rate data fetched yet.</p>
          <?php endif; ?>
        </div>
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