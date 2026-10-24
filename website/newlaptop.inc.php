<script language="javascript">
function validateForm() {
    var form = document.newlaptop;
    if (form.laptopID.value == "" || form.laptopName.value == "") {
        alert("ID and Name are required.");
        return false;
    }
    if (parseFloat(form.buyPrice.value) <= 0 || parseFloat(form.sellPrice.value) <= 0) {
        alert("Prices must be greater than zero.");
        return false;
    }
    return true;
}
<?php require_once("laptoptype.php"); ?>
</script>

<div class="dashboard-header">
    <h2>Enter New Laptop Information</h2>
</div>

<form name="newlaptop" action="index.php" method="post" onsubmit="return validateForm()" class="modern-form">
    <div class="form-grid">
        <div class="input-group">
            <label>Laptop ID</label>
            <input type="number" name="laptopID" min="1" max="1000000" required>
        </div>
        
        <div class="input-group">
            <label>Code</label>
            <input type="text" name="laptopCode" minlength="2" maxlength="10" required>
        </div>
        
        <div class="input-group full-width">
            <label>Name</label>
            <input type="text" name="laptopName" minlength="10" maxlength="100" required>
        </div>
        
        <div class="input-group full-width">
            <label>Description</label>
            <textarea name="laptopDescription" rows="3" minlength="50" maxlength="255" required></textarea>
        </div>
        
        <div class="input-group">
            <label>RAM (GB)</label>
            <input type="number" name="ram" min="1" max="128" required>
        </div>
        
        <div class="input-group">
            <label>Storage (GB)</label>
            <input type="number" name="storageCapacity" min="1" max="8000" required>
        </div>
        
        <div class="input-group">
            <label>Dimension (in)</label>
            <input type="number" name="inchDimension" min="1" max="50" required>
        </div>
        
        <div class="input-group">
            <label>Type</label>
            <select name="laptopTypeID" required>
                <?php
                $laptopTypes = LaptopType::getLaptopTypes();
                if ($laptopTypes) {
                    foreach ($laptopTypes as $type) {
                        echo "<option value=\"$type->laptopTypeID\">$type->laptopTypeName</option>\n";
                    }
                }
                ?>
            </select>
        </div>
        
        <div class="input-group">
            <label>Buy Price ($)</label>
            <input type="number" step="0.01" name="buyPrice" min="0.01" max="10000" required>
        </div>
        
        <div class="input-group">
            <label>Sell Price ($)</label>
            <input type="number" step="0.01" name="sellPrice" min="0.01" max="15000" required>
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="btn btn-view" onclick="window.location='index.php?content=listlaptops'">Cancel</button>
        <button type="submit" class="btn btn-update">Submit New Laptop</button>
        <input type="hidden" name="content" value="addlaptop">
    </div>
</form>