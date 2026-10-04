<?php
require_once("laptop.php");
require_once("laptoptype.php");

$query = trim($_POST['searchQuery'] ?? '');

if (empty($query)) {
    echo "<div class='dashboard-header'><h2>Please enter a search term.</h2></div>";
    echo '<button class="btn btn-view" onclick="window.location.href=\'index.php\'">Go Back</button>';
} 
// 1. Check for "id: [number]"
elseif (preg_match('/^id:\s*(\d+)$/i', $query, $matches)) {
    $_REQUEST['laptopID'] = $matches[1];
    include('displaylaptop.inc.php');
} 
// 2. Check for "typeid: [number]"
elseif (preg_match('/^typeid:\s*(\d+)$/i', $query, $matches)) {
    $_REQUEST['laptopTypeID'] = $matches[1];
    include('displaylaptoptype.inc.php');
} 
// 3. Default: Search by Laptop Name or Code
else {
    $db = getDB();
    $searchParam = "%" . $query . "%";
    
    // Secure prepared statement for wildcard search
    $stmt = $db->prepare("SELECT * FROM laptops WHERE laptop_name LIKE ? OR laptop_code LIKE ?");
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo "<div class='dashboard-header'><h2>Search Results for \"".htmlspecialchars($query)."\"</h2></div>";
    
    if ($result->num_rows > 0) {
        echo "<div class='inventory-grid'>";
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $laptop = new Laptop(
                $row['laptop_id'], $row['laptop_code'], $row['laptop_name'],
                $row['laptop_description'], $row['ram'], $row['storage_capacity'],
                $row['inch_dimension'], $row['laptop_type_id'], $row['laptop_buy_price'],
                $row['laptop_sell_price'], $row['date_time_created'], $row['date_time_updated']
            );
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
        echo "</div>";
    } else {
        echo "<div class='detail-card'><p style='color: #a6accd;'>No laptops found matching that description.</p></div>";
    }
    $db->close();
}
?>