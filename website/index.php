<!-- -- #Pabal Ahmed
-- #IT202-004
-- #pa478@njit.edu
-- #3/13/2026 -->
<?php
session_start();
require_once("config.php");
require_once("laptoptype.php");
require_once("laptop.php");
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pabal's Laptops | Inventory</title>
    <link rel="stylesheet" type="text/css" href="ih_styles.css">
    <script src = "realtime.js"></script>
</head>
<body>
    <header>
        <?php include("header.inc.php"); ?>
    </header>

    <section style="display: flex; min-height: 600px;">
        <nav>
            <?php include("nav.inc.php"); ?>
        </nav>
        
        <main style="flex: 1; padding: 20px;">
            <?php
            if (isset($_REQUEST['content'])) {
                // This line looks for files like 'listlaptops.inc.php'
                include($_REQUEST['content'] . ".inc.php");
            } else {
                include("main.inc.php");
            }
            ?>
        </main>
       <?php if (isset($_SESSION['login'])) { ?>
        <aside>
            <?php include("aside.inc.php"); ?>
            <script>
                getRealTime();
                setInterval(getRealTime, 5000);
            </script>
        </aside>
        <?php } ?>
    </section>

    <footer>
         <?php include("footer.inc.php"); ?>
    </footer>
</body>
</html>
<?php
ob_end_flush();
?>