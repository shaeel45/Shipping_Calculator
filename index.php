<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>UPS Rate Calculator Modal</title>
  <style>
    /* Basic page and button styles */
    body {
      font-family: Arial, sans-serif;
    }
    .open-modal-btn {
      padding: 10px 20px;
      font-size: 16px;
      margin: 30px;
      cursor: pointer;
    }

    /* Modal styles */
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
      max-width: 800px;
      max-height: 90%;
      overflow-y: auto;
    }

    .close-btn {
      float: right;
      cursor: pointer;
      font-size: 20px;
      font-weight: bold;
      margin-top: -15px;
      margin-right: -15px;
      background: #ccc;
      border-radius: 50%;
      padding: 5px 10px;
    }

    label, input, select {
      display: block;
      margin-top: 10px;
      width: 100%;
      padding: 8px;
    }

    .row {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .col {
      flex: 1;
      min-width: 180px;
    }
  </style>
</head>
<body>

<!-- Trigger Button -->
<button class="open-modal-btn" onclick="openModal()">Test UPS® Rates</button>

<!-- Modal -->
<div id="rateModal" class="modal">
  <div class="modal-content">
    <span class="close-btn" onclick="closeModal()">&times;</span>

    <h2>Test UPS® Rates</h2>
    <form method="POST" action="get_rate.php">
      <label>Package Type</label>
      <select name="package_type">
        <option value="box">Box</option>
        <option value="envelope">Envelope</option>
      </select>

      <label>Size and Weight</label>
      <div class="row">
        <div class="col"><input type="number" name="length" placeholder="Length" required></div>
        <div class="col"><input type="number" name="width" placeholder="Width" required></div>
        <div class="col"><input type="number" name="height" placeholder="Height" required></div>
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
          <h3>Ship From</h3>
          <input type="text" name="from_address" placeholder="Address" required>
          <input type="text" name="from_city" placeholder="City" required>
          <input type="text" name="from_state" placeholder="State" required>
          <input type="text" name="from_zip" placeholder="ZIP Code" required>
        </div>

        <div class="col">
          <h3>Ship To</h3>
          <input type="text" name="to_address" placeholder="Address" required>
          <input type="text" name="to_city" placeholder="City" required>
          <input type="text" name="to_state" placeholder="State" required>
          <input type="text" name="to_zip" placeholder="ZIP Code" required>
        </div>
      </div>

      <br>
      <button type="submit">Test UPS® Rates</button>
    </form>
  </div>
</div>

<!-- JavaScript -->
<script>
  function openModal() {
    document.getElementById('rateModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('rateModal').style.display = 'none';
  }

  // Optional: Close modal if user clicks outside
  window.onclick = function(event) {
    const modal = document.getElementById('rateModal');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>

</body>
</html>
