<div class="dashboard-header">
    <h2>Enter New Category Information</h2>
</div>

<form name="newlaptoptype" action="index.php" method="post" class="modern-form">
    <div class="form-grid">
        <div class="input-group">
            <label>Category ID</label>
            <input type="number" name="laptopTypeID" min="1" max="9999999" required>
        </div>
        
        <div class="input-group">
            <label>Category Code</label>
            <input type="text" name="laptopTypeCode" minlength="2" maxlength="10" required>
        </div>
        
        <div class="input-group full-width">
            <label>Category Name</label>
            <input type="text" name="laptopTypeName" minlength="10" maxlength="100" required>
        </div>
        
        <div class="input-group">
            <label>Shelf Number</label>
            <input type="number" name="laptopShelfNumber" min="1" max="100" required>
        </div>
    </div>
    
    <div class="form-actions">
        <button type="button" class="btn btn-view" onclick="window.location='index.php?content=listlaptoptypes'">Cancel</button>
        <button type="submit" class="btn btn-update">Submit New Category</button>
        <input type="hidden" name="content" value="addlaptoptype">
    </div>
</form>