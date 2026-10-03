<?php
require_once("laptop.php");
$laptops = Laptop::getLaptops();

if ($laptops) {
    $totalValue = 0; 
?>
    <div class="dashboard-header">
        <h2>Laptop Inventory</h2>
    </div>

    <div class="inventory-grid">
        <?php
        foreach ($laptops as $laptop) {
            $totalValue += $laptop->buyPrice; 
        ?>
            <div class="laptop-card">
                <div class="card-header">
                    <span class="badge-id">ID: <?php echo $laptop->laptopID; ?></span>
                    <span class="price-tag">$<?php echo number_format($laptop->buyPrice, 2); ?></span>
                </div>
                
                <h3><?php echo htmlspecialchars($laptop->laptopName); ?></h3>
                
                <!-- Action Buttons: using mini-forms to preserve your existing POST logic -->
                <form action="index.php" method="post" class="card-actions">
                    <input type="hidden" name="laptopID" value="<?php echo $laptop->laptopID; ?>">
                    
                    <button type="submit" name="content" value="displaylaptop" class="btn btn-view">View</button>
                    <button type="submit" name="content" value="updatelaptop" class="btn btn-update">Edit</button>
                   
                    <button type="button" class="btn btn-delete" onclick="triggerDelete(<?php echo $laptop->laptopID; ?>)">Delete</button>
                </form>
            </div>
        <?php 
        } 
        ?>
    </div>
    
    <div class="inventory-summary">
        <p><strong>Total Inventory Value:</strong> $<?php echo number_format($totalValue, 2); ?></p>
    </div>

<?php
} else {
    echo "<h2>No laptops found in the database.</h2>";
}
?>

<!-- Native HTML5 Modal -->
<dialog id="deleteModal" class="modern-modal">
    <h3>Confirm Deletion</h3>
    <p>Are you sure you want to permanently delete this laptop? This action cannot be undone.</p>
    <form action="index.php" method="post" class="modal-actions">
        <input type="hidden" name="laptopID" id="modalLaptopID" value="">
        <button type="button" class="btn btn-view" onclick="document.getElementById('deleteModal').close()">Cancel</button>
        <button type="submit" name="content" value="removelaptop" class="btn btn-delete">Delete</button>
    </form>
</dialog>

<script>
function triggerDelete(laptopID) {
    document.getElementById('modalLaptopID').value = laptopID;
    document.getElementById('deleteModal').showModal();
}
</script>