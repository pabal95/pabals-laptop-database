
<?php
require_once("laptoptype.php");
if (!isset($_REQUEST['laptopTypeID']) or (!is_numeric($_REQUEST['laptopTypeID']))) {
    echo "<h2>Error: No valid Category ID selected.</h2>";
    echo '<br><button class="btn btn-view" onclick="window.location.href=\'index.php?content=listlaptoptypes\'">Return to Categories</button>';
} else {
    $laptopTypeID = $_REQUEST['laptopTypeID'];
    $laptopType = LaptopType::findLaptopType($laptopTypeID);
    
    if ($laptopType) {
?>
        <div class="dashboard-header">
            <h2>Category Details</h2>
        </div>
        
        <div class="detail-card" style="margin-bottom: 2rem;">
            <div class="detail-header" style="border-bottom: none; padding-bottom: 0; margin-bottom: 0;">
                <div>
                    <h3><?php echo htmlspecialchars($laptopType->laptopTypeName); ?></h3>
                    <span class="badge-id">ID: <?php echo $laptopType->laptopTypeID; ?> | Code: <?php echo htmlspecialchars($laptopType->laptopTypeCode); ?></span>
                </div>
                <span class="price-tag">Shelf <?php echo $laptopType->laptopShelfNumber; ?></span>
            </div>
            
            <div class="form-actions" style="margin-top: 1.5rem;">
                <button type="button" class="btn btn-view" onclick="window.location.href='index.php?content=listlaptoptypes'">Back to Categories</button>
            </div>
        </div>

        <?php
        $laptops = Laptop::getLaptopsByLaptopType($laptopTypeID); 
        if ($laptops) {
            $itemtotal = 0;
        ?>
            <div class="dashboard-header">
                <h3>Inventory in this Category</h3>
            </div>
            
            <div class="inventory-grid">
                <?php
                foreach ($laptops as $laptop) {
                    $itemtotal += $laptop->sellPrice;
                ?>
                    <div class="laptop-card">
                        <div class="card-header">
                            <span class="badge-id">ID: <?php echo $laptop->laptopID; ?></span>
                            <span class="price-tag">$<?php echo number_format($laptop->sellPrice, 2); ?></span>
                        </div>
                        
                        <h3><?php echo htmlspecialchars($laptop->laptopName); ?></h3>
                        
                        <form action="index.php" method="post" class="card-actions">
                            <input type="hidden" name="laptopID" value="<?php echo $laptop->laptopID; ?>">
                            <button type="submit" name="content" value="displaylaptop" class="btn btn-view">View</button>
                            <button type="submit" name="content" value="updatelaptop" class="btn btn-update">Edit</button>
                        </form>
                    </div>
                <?php 
                } 
                ?>
            </div>
            
            <div class="inventory-summary">
                <p><strong>Category Total Value:</strong> $<?php echo number_format($itemtotal, 2); ?></p>
            </div>
        <?php
        } else {
            echo "<div class='detail-card'><p style='text-align: center; color: #a6accd; margin: 0;'>No laptops are currently assigned to this category.</p></div>";
        }
    } else {
        echo "<h2>Sorry, laptop category $laptopTypeID not found</h2>";
        echo '<br><button class="btn btn-view" onclick="window.location.href=\'index.php?content=listlaptoptypes\'">Back to List</button>';
    }
}
?>