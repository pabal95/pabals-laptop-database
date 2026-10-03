  <!-- -- #Pabal Ahmed
-- #IT202-004
-- #pa478@njit.edu
-- #3/13/2026 -->
  <?php
   if (isset($_SESSION['login'])) {
   ?>
    <div class="navigation">
      <table width="100%" cellpadding="3">
        <?php
         echo "<td><h3>Welcome, {$_SESSION['login']}</h3></td>";
         ?>
        <tr>
          <td><img src = "images/home.png" alt="Home Icon" width="16" height="16">&nbsp;
          <a href="index.php"><strong>Home</strong></a></td>
        </tr>
        <tr>
          <td><img src = "images/categories.png" alt="Categories Icon" width="16" height="16">&nbsp;
            <strong>Laptop Types</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=listlaptoptypes">
              <strong>List Laptop Types</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=newlaptoptype">
              <strong>Add New Laptop Type</strong></a></td>
        </tr>
        <tr>
          <td>
            <img src = "images/items.png" alt="Items Icon" width="16" height="16">&nbsp;
            <strong>Laptops</strong></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=listlaptops">
              <strong>List Laptops</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;<a href="index.php?content=newlaptop">
              <strong>Add New Laptop</strong></a></td>
        </tr>
        <tr>
          <td>
            <hr />
          </td>
        </tr>
        <tr>
          <td><a href="index.php?content=logout">
            <img src = "images/logout.png" alt="Logout Icon" width="16" height="16"></a>&nbsp;
            <a href="index.php?content=logout">
              <strong>Logout</strong></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
            <form action="index.php" method="post">
              <label>Search Laptop Type ID:</label><br>
              <input type="text" name="laptopTypeID" size="14" />
              <input type="submit" value="find" />
              <input type="hidden" name="content" value="updatelaptoptype" />
            </form>
          </td>
        </tr>
        <tr>
          <td>
           <form action="index.php" method="post">
            <label>Search Laptop ID:</label><br>
            <input type="text" name="laptopID" size="14" />
            <input type="submit" value="find" />
            <input type="hidden" name="content" value="updatelaptop" />
          </form>
          </td>
        </tr>
      </table>
    </div>
  <?php
   }
   ?>