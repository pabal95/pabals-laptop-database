<?php
require_once("laptop.php");
require_once("laptoptype.php");

// Calculate Real-Time Stats
$laptops = Laptop::getLaptops();
$types = LaptopType::getLaptopTypes();

$laptopCount = $laptops ? count($laptops) : 0;
$typeCount = $types ? count($types) : 0;
$totalSell = 0;
$totalBuy = 0;

if ($laptops) {
    foreach ($laptops as $laptop) {
        $totalSell += $laptop->sellPrice;
        $totalBuy += $laptop->buyPrice;
    }
}
?>

<div class="welcome-container">
    <h1 class="welcome-title">Welcome, Pabal!</h1>
    
    <form action="index.php" method="post" class="unified-search-form">
        <div class="search-wrapper">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" name="searchQuery" class="unified-search-input" placeholder="Search by name, or use id:12, typeid:3..." required autofocus>
        </div>
        <input type="hidden" name="content" value="search">
    </form>
    
    <div class="search-hints">
        <span class="hint-badge">Name or Code</span>
        <span class="hint-badge">id: [number]</span>
        <span class="hint-badge">typeid: [number]</span>
    </div>

    <!-- Restored Real-Time Inventory Stats -->
    <div class="real-time-stats">
        <div class="stat-card">
            <span class="stat-label">Total Categories</span>
            <span class="stat-value"><?php echo $typeCount; ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Total Laptops</span>
            <span class="stat-value"><?php echo $laptopCount; ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Total Buy Price</span>
            <span class="stat-value highlight-red">$<?php echo number_format($totalBuy, 2); ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Total Sell Price</span>
            <span class="stat-value highlight-green">$<?php echo number_format($totalSell, 2); ?></span>
        </div>
    </div>
</div>