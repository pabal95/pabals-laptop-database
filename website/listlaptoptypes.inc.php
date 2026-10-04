<?php
require_once("laptoptype.php");
$laptopTypes = LaptopType::getLaptopTypes();

if ($laptopTypes) {
?>
    <div class="dashboard-header">
        <h2>Laptop Categories</h2>
    </div>

    <div class="inventory-grid">
        <?php
        foreach ($laptopTypes as $type) {
        ?>
            <div class="laptop-card">
                <div class="card-header">
                    <span class="badge-id">ID: <?php echo $type->laptopTypeID; ?></span>
                    <span class="price-tag">Shelf <?php echo $type->laptopShelfNumber; ?></span>
                </div>
                
                <h3><?php echo htmlspecialchars($type->laptopTypeName); ?></h3>
                <p style="color: #a6accd; font-size: 0.9rem; margin-top: -10px;">Code: <?php echo htmlspecialchars($type->laptopTypeCode); ?></p>
                
                <form action="index.php" method="post" class="card-actions">
                    <input type="hidden" name="laptopTypeID" value="<?php echo $type->laptopTypeID; ?>">
                    
                    <button type="submit" name="content" value="displaylaptoptype" class="btn btn-view">View</button>
                    <button type="submit" name="content" value="updatelaptoptype" class="btn btn-update">Edit</button>
                    <button type="button" class="btn btn-delete" onclick="triggerTypeDelete(<?php echo $type->laptopTypeID; ?>)">Delete</button>
                </form>
            </div>
        <?php 
        } 
        ?>
    </div>
    
    <?php $count = count($laptopTypes); ?>
    <div class="inventory-summary">
        <p><strong>Total Categories:</strong> <?php echo $count; ?></p>
    </div>

    <!-- Native HTML5 Modal for Laptop Types -->
    <dialog id="deleteTypeModal" class="modern-modal">
        <h3>Confirm Deletion</h3>
        <p>Are you sure you want to permanently delete this category? This action cannot be undone.</p>
        <form action="index.php" method="post" class="modal-actions">
            <input type="hidden" name="laptopTypeID" id="modalLaptopTypeID" value="">
            <button type="button" class="btn btn-view" onclick="document.getElementById('deleteTypeModal').close()">Cancel</button>
            <button type="submit" name="content" value="removelaptoptype" class="btn btn-delete">Delete</button>
        </form>
    </dialog>

    <script>
    function triggerTypeDelete(typeID) {
        document.getElementById('modalLaptopTypeID').value = typeID;
        document.getElementById('deleteTypeModal').showModal();
    }
    </script>

<?php
} else {
    echo "<h2>No laptop categories found in the database.</h2>";
}
?>