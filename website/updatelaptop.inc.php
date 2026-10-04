<?php
if (!isset($_POST['laptopID']) or (!is_numeric($_POST['laptopID']))) {
    echo "<h2>Error: Invalid laptop ID selection.</h2>";
    echo '<br><button class="btn btn-view" onclick="window.location.href=\'index.php?content=listlaptops\'">Return to List</button>';
} else {
    $laptopID = $_POST['laptopID'];
    $laptop = Laptop::findLaptop($laptopID);
    if ($laptop) {
?>
    <div class="dashboard-header">
        <h2>Update Laptop #<?php echo $laptop->laptopID; ?></h2>
    </div>
    
    <form name="laptops" action="index.php" method="post" class="modern-form">
        <div class="form-grid">
            <div class="input-group">
                <label>Laptop Code</label>
                <input type="text" name="laptopCode" minlength="2" maxlength="10" value="<?php echo htmlspecialchars($laptop->laptopCode); ?>" required>
            </div>
            
            <div class="input-group full-width">
                <label>Laptop Name</label>
                <input type="text" name="laptopName" minlength="10" maxlength="100" value="<?php echo htmlspecialchars($laptop->laptopName); ?>" required>
            </div>
            
            <div class="input-group full-width">
                <label>Description</label>
                <textarea name="laptopDescription" rows="3" minlength="100" maxlength="255" required><?php echo htmlspecialchars($laptop->laptopDescription); ?></textarea>
            </div>
            
            <div class="input-group">
                <label>RAM (GB)</label>
                <input type="number" name="ram" min="1" max="256" value="<?php echo htmlspecialchars($laptop->ram); ?>" required>
            </div>
            
            <div class="input-group">
                <label>Storage (GB)</label>
                <input type="number" name="storageCapacity" min="1" max="8000" value="<?php echo htmlspecialchars($laptop->storageCapacity); ?>" required>
            </div>
            
            <div class="input-group">
                <label>Dimension (in)</label>
                <input type="number" name="inchDimension" min="1" max="100" value="<?php echo htmlspecialchars($laptop->inchDimension); ?>" required>
            </div>
            
            <div class="input-group">
                <label>Category</label>
                <select name="laptopTypeID" required>
                    <?php
                    $laptopTypes = LaptopType::getLaptopTypes();
                    if ($laptopTypes) {
                        foreach ($laptopTypes as $type) {
                            $selected = ($type->laptopTypeID == $laptop->laptopTypeID) ? "selected" : "";
                            echo "<option value=\"$type->laptopTypeID\" $selected>$type->laptopTypeName</option>\n";
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="input-group">
                <label>Date Created</label>
                <input type="text" value="<?php echo date('M j, Y g:i A', strtotime($laptop->date_time_created)); ?>" disabled style="opacity: 0.5; cursor: not-allowed; background: transparent;">
            </div>
            
            <div class="input-group">
                <label>Buy Price ($)</label>
                <input type="number" step="0.01" name="buyPrice" min="0.01" max="10000" value="<?php echo htmlspecialchars($laptop->buyPrice); ?>" required>
            </div>
            
            <div class="input-group">
                <label>Sell Price ($)</label>
                <input type="number" step="0.01" name="sellPrice" min="0.01" max="15000" value="<?php echo htmlspecialchars($laptop->sellPrice); ?>" required>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="button" class="btn btn-view" onclick="window.location='index.php?content=listlaptops'">Cancel</button>
            <button type="submit" name="answer" value="Update Laptop" class="btn btn-update">Update Laptop</button>
            <input type="hidden" name="laptopID" value="<?php echo $laptopID; ?>">
            <input type="hidden" name="content" value="changelaptop">
        </div>
    </form>
<?php
    }
}
?>