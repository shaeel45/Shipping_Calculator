<div class="fields">
<label for="country-0">Country/Region</label>
<select id="country-0" name="country[]" class="country-length" style="margin-bottom: 10px;margin-top:0px;">
  <option value="US">United States</option>
</select>

<label>Address</label>
<input type="text"  class="full-length" style="margin-bottom: 10px;" name="address[]" placeholder="123 Main Street" required>

<label>Apartment, Suite, etc.</label>
<input type="text"  class="full-length" style="margin-bottom: 10px;" name="suite[]" placeholder="Apt #2B">

<div class="address-group" style="margin-bottom: 10px;">
  <div>
    <label>City</label>
    <input type="text" class="full-lengths"  name="city[]" required>
  </div>
  <div>
    <label>State</label>
    <input type="text" class="full-lengths"  name="state[]" required>
  </div>
</div>

<label>ZIP Code</label>
<input type="text" class="full-length"  name="zip[]" required>
</div>