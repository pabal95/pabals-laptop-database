<?php
require_once("laptoptype.php");
if (!isset($_POST['laptopTypeID']) || !is_numeric($_POST['laptopTypeID'])) {
    echo "<h2>Error: A valid Category ID is required to update.</h2>";
    echo '<br><button class="btn btn-view" onclick="window.location.href=\'index.php?content=listlaptoptypes\'">Return to Categories</button>';
} else {
    $laptopTypeID = $_POST['laptopTypeID'];
    $laptopType = LaptopType::findLaptopType($laptopTypeID);
    if ($laptopType) {
?>
        <div class="dashboard-header">
            <h2>Update Category #<?php echo $laptopTypeID; ?></h2>
        </div>
        
        <form name="laptopTypes" action="index.php" method="post" class="modern-form">
            <div class="form-grid">
                <div class="input-group">
                    <label>Category Code</label>
                    <input type="text" name="laptopTypeCode" minlength="2" maxlength="10" value="<?php echo htmlspecialchars($laptopType->laptopTypeCode); ?>" required>
                </div>
                
                <div class="input-group full-width">
                    <label>Category Name</label>
                    <input type="text" name="laptopTypeName" minlength="10" maxlength="100" value="<?php echo htmlspecialchars($laptopType->laptopTypeName); ?>" required>
                </div>
                
                <div class="input-group">
                    <label>Shelf Number</label>
                    <input type="number" name="laptopShelfNumber" min="1" max="100" value="<?php echo htmlspecialchars($laptopType->laptopShelfNumber); ?>" required>
                </div>
                
                <div class="input-group">
                    <label>Date Created</label>
                    <input type="text" value="<?php echo date('M j, Y g:i A', strtotime($laptopType->date_time_created)); ?>" disabled style="opacity: 0.5; cursor: not-allowed; background: transparent;">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-view" onclick="window.location='index.php?content=listlaptoptypes'">Cancel</button>
                <button type="submit" name="answer" value="Update Laptop Type" class="btn btn-update">Update Category</button>
                <input type="hidden" name="laptopTypeID" value="<?php echo $laptopTypeID; ?>">
                <input type="hidden" name="content" value="changelaptoptype">
            </div>
        </form>
<?php
    }
}
?>