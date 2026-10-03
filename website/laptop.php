<?php
/* -- #Pabal Ahmed
   -- #IT202-004
   -- #pa478@njit.edu
   -- #4/2/2026 */
require_once('database.php');

class Laptop {
    public $laptopID; 
    public $laptopCode;
    public $laptopName;
    public $laptopDescription;
    public $ram;
    public $storageCapacity;
    public $inchDimension;
    public $laptopTypeID;
    public $buyPrice;
    public $sellPrice;
    /* Phase 4 Requirement: Include ALL fields */
    public $date_time_created;
    public $date_time_updated;

    function __construct($laptopID, $laptopCode, $laptopName, $laptopDescription, $ram, 
                         $storageCapacity, $inchDimension, $laptopTypeID, $buyPrice, 
                         $sellPrice, $date_time_created = null, $date_time_updated = null) {
        $this->laptopID = $laptopID;
        $this->laptopCode = $laptopCode;
        $this->laptopName = $laptopName;
        $this->laptopDescription = $laptopDescription; 
        $this->ram = $ram;                               
        $this->storageCapacity = $storageCapacity;       
        $this->inchDimension = $inchDimension;           
        $this->laptopTypeID = $laptopTypeID;
        $this->buyPrice = $buyPrice;
        $this->sellPrice = $sellPrice;
        $this->date_time_created = $date_time_created;
        $this->date_time_updated = $date_time_updated;
    }

    static function findLaptop($laptopID) {
        $db = getDB();
        $query = "SELECT * FROM laptops WHERE laptop_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $laptopID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $db->close();
        
        if ($row) {
            return new Laptop(
                $row['laptop_id'], $row['laptop_code'], $row['laptop_name'],
                $row['laptop_description'], $row['ram'], $row['storage_capacity'],
                $row['inch_dimension'], $row['laptop_type_id'], $row['laptop_buy_price'],
                $row['laptop_sell_price'], $row['date_time_created'], $row['date_time_updated']
            );
        }
        return NULL;
    }

    function __toString() {
        // Fixed the concatenation so all data actually returns
        return "<h2>Laptop ID: $this->laptopID</h2>" .
               "<h2>Name: $this->laptopName</h2>" .
               "<h2>Type ID: $this->laptopTypeID | Sell Price: $$this->sellPrice</h2>";
    }

    function saveLaptop() {
        $db = getDB();
        $query = "INSERT INTO laptops (laptop_id, laptop_code, laptop_name, laptop_description, ram, 
                  storage_capacity, inch_dimension, laptop_type_id, laptop_buy_price, laptop_sell_price) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("isssiiiidd", 
            $this->laptopID, $this->laptopCode, $this->laptopName, $this->laptopDescription,
            $this->ram, $this->storageCapacity, $this->inchDimension, $this->laptopTypeID,
            $this->buyPrice, $this->sellPrice
        );
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    static function getLaptops() {
        $db = getDB();
        $query = "SELECT * FROM laptops ORDER BY laptop_id";
        $result = $db->query($query);
        $laptops = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $laptops[] = new Laptop(
                $row['laptop_id'], $row['laptop_code'], $row['laptop_name'],
                $row['laptop_description'], $row['ram'], $row['storage_capacity'],
                $row['inch_dimension'], $row['laptop_type_id'], $row['laptop_buy_price'],
                $row['laptop_sell_price'], $row['date_time_created'], $row['date_time_updated']
            );
        }
        $db->close();
        return (count($laptops) > 0) ? $laptops : NULL;
    }

    static function getLaptopsByLaptopType($laptopTypeID) {
        $db = getDB();
        $query = "SELECT * FROM laptops WHERE laptop_type_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $laptopTypeID);
        $stmt->execute();
        $result = $stmt->get_result();
        $laptops = array();
        
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $laptops[] = new Laptop(
                $row['laptop_id'], $row['laptop_code'], $row['laptop_name'],
                $row['laptop_description'], $row['ram'], $row['storage_capacity'],
                $row['inch_dimension'], $row['laptop_type_id'], $row['laptop_buy_price'],
                $row['laptop_sell_price'], $row['date_time_created'], $row['date_time_updated']
            );
        }
        $db->close();
        return (count($laptops) > 0) ? $laptops : NULL;
    }

    function updateLaptop() {
        $db = getDB();
        $query = "UPDATE laptops SET 
                    laptop_code = ?, laptop_name = ?, laptop_description = ?, 
                    ram = ?, storage_capacity = ?, inch_dimension = ?, 
                    laptop_type_id = ?, laptop_buy_price = ?, laptop_sell_price = ? 
                  WHERE laptop_id = $this->laptopID";
        $stmt = $db->prepare($query);
        $stmt->bind_param("sssiiiidd", 
            $this->laptopCode, $this->laptopName, $this->laptopDescription,
            $this->ram, $this->storageCapacity, $this->inchDimension,
            $this->laptopTypeID, $this->buyPrice, $this->sellPrice
        );
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function removeLaptop() {
        $db = getDB();
        $query = "DELETE FROM laptops WHERE laptop_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $this->laptopID);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }
    static function getTotalLaptops() {
        $db = getDB();
        $query = "SELECT COUNT(laptop_id) FROM laptops";
        $result = $db->query($query);
        $row = $result->fetch_array();
        $db->close(); // Mandatory cleanup
        return $row ? $row[0] : 0;
    }

    static function getTotalSellPrice() {
        $db = getDB();
        $query = "SELECT SUM(laptop_sell_price) FROM laptops";
        $result = $db->query($query);
        $row = $result->fetch_array();
        $db->close(); // Mandatory cleanup
        return $row ? $row[0] : 0;
    }

    static function getTotalBuyPrice() {
    $db = getDB();
    $query = "SELECT SUM(laptop_buy_price) FROM laptops";
    $result = $db->query($query);
    $row = $result->fetch_array();
    $db->close();
    return $row[0] ? $row[0] : 0;
}
}
?>