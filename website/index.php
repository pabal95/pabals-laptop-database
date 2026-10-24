<?php
session_start();

$allowed = [
    'main', 'login', 'validate', 'search',
    'listlaptops', 'newlaptop', 'addlaptop', 'displaylaptop',
    'updatelaptop', 'changelaptop', 'removelaptop',
    'listlaptoptypes', 'newlaptoptype', 'addlaptoptype', 'displaylaptoptype',
    'updatelaptoptype', 'changelaptoptype', 'removelaptoptype',
];

$request = $_REQUEST['content'] ?? 'main';
if (!in_array($request, $allowed, true)) {
    $request = 'main';
}

if (!isset($_SESSION['login']) && $request !== 'validate') {
    $content = 'login';
} else {
    $content = $request;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pabal's Laptops Inventory</title>
    <link rel="stylesheet" href="ih_styles.css">
</head>
<body>
    <?php if ($content == 'login'): ?>
        <!-- If not logged in, ONLY load the login screen -->
        <?php include("login.inc.php"); ?>
    <?php else: ?>
        <!-- If logged in, load the full application layout -->
        <?php include("header.inc.php"); ?>
        <div style="display: flex; min-height: calc(100vh - 120px);">
            <aside style="width: 250px; background: #181825; border-right: 1px solid #313244;">
                <?php include("nav.inc.php"); ?>
            </aside>
            <main style="flex: 1; padding: 2rem; overflow-y: auto;">
                <?php include($content . ".inc.php"); ?>
            </main>
        </div>
        <?php include("footer.inc.php"); ?>
    <?php endif; ?>
</body>
</html>