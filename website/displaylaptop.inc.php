<?php
require_once("laptop.php");
require_once("laptoptype.php");
if (!isset($_REQUEST['laptopID']) or (!is_numeric($_REQUEST['laptopID']))) {
    echo "<h2>Error: No valid laptop ID selected.</h2>";
    echo '<a href="index.php?content=listlaptops" class="btn btn-view">Return to List</a>';
} else {
    $laptopID = $_REQUEST['laptopID'];
    $laptop = Laptop::findLaptop($laptopID);
    if ($laptop) {
        $type = LaptopType::findLaptopType($laptop->laptopTypeID);
        $typeName = $type ? $type->laptopTypeName : "Unknown";
        
        // Dynamic Image Loading Logic
        $imagePath = "images/laptops/" . $laptop->laptopID . ".jpg";
        $displayImage = file_exists($imagePath) ? $imagePath : "images/placeholder.webp";
?>
        <div class="dashboard-header">
            <h2>Laptop Specifications</h2>
        </div>
        
        <div class="detail-card">
            <div class="detail-header">
                <div>
                    <h3><?php echo htmlspecialchars($laptop->laptopName); ?></h3>
                    <span class="badge-id">ID: <?php echo $laptop->laptopID; ?></span>
                </div>
                <span class="price-tag">$<?php echo number_format($laptop->sellPrice, 2); ?></span>
            </div>
            
            <div class="detail-content">
                <!-- Image Container -->
                <div class="detail-image">
                    <img src="<?php echo $displayImage; ?>" alt="Laptop Image">
                </div>
                
                <!-- Specs Grid -->
                <div class="detail-grid">
                    <div class="stat-box"><span>Code</span><strong><?php echo htmlspecialchars($laptop->laptopCode); ?></strong></div>
                    <div class="stat-box"><span>Category</span><strong><?php echo htmlspecialchars($typeName); ?></strong></div>
                    <div class="stat-box"><span>RAM</span><strong><?php echo $laptop->ram; ?> GB</strong></div>
                    <div class="stat-box"><span>Storage</span><strong><?php echo $laptop->storageCapacity; ?> GB</strong></div>
                    <div class="stat-box"><span>Screen</span><strong><?php echo $laptop->inchDimension; ?>"</strong></div>
                    <div class="stat-box"><span>Created</span><strong><?php echo date('M j, Y', strtotime($laptop->date_time_created)); ?></strong></div>
                </div>
            </div>
            
            <div class="detail-desc">
                <h4>Description</h4>
                <p><?php echo nl2br(htmlspecialchars($laptop->laptopDescription)); ?></p>
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-view" onclick="window.location.href='index.php?content=listlaptops'">Back to Inventory</button>
            </div>
        </div>
<?php
    } else {
        echo "<h2>Sorry, Laptop #$laptopID not found.</h2>";
    }
}
?>