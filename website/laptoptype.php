<?php
/* -- #Pabal Ahmed
   -- #IT202-004
   -- #pa478@njit.edu
   -- #4/2/2026 */
require_once('database.php');

class LaptopType {
   public $laptopTypeID;
   public $laptopTypeCode;
   public $laptopTypeName;
   public $laptopShelfNumber;
   public $date_time_created;

   // Constructor matches your SQL exactly: 4 editable fields + 1 timestamp
   function __construct($laptopTypeID, $laptopTypeCode, $laptopTypeName, $laptopShelfNumber, $date_time_created = null) {
       $this->laptopTypeID = $laptopTypeID;
       $this->laptopTypeCode = $laptopTypeCode;
       $this->laptopTypeName = $laptopTypeName;
       $this->laptopShelfNumber = $laptopShelfNumber;
       $this->date_time_created = $date_time_created;
   }

   function __toString() {
       return "<h2>$this->laptopTypeID - $this->laptopTypeName ($this->laptopTypeCode)</h2>\n";
   }

   static function findLaptopType($laptopTypeID) {
        $db = getDB();
        $query = "SELECT * FROM laptop_types WHERE laptop_type_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $laptopTypeID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $db->close();
        
        if ($row) {
            return new LaptopType(
                $row['laptop_type_id'], 
                $row['laptop_type_code'], 
                $row['laptop_type_name'], 
                $row['laptop_ShelfNumber'], 
                $row['date_time_created']
            );
        }
        return NULL;
    }

   function saveLaptopType() {
       $db = getDB();
       $query = "INSERT INTO laptop_types (laptop_type_id, laptop_type_code, laptop_type_name, laptop_ShelfNumber) 
                 VALUES (?, ?, ?, ?)";
       $stmt = $db->prepare($query);
       // 4 placeholders = 4 variables (i, s, s, i)
       $stmt->bind_param("issi",
           $this->laptopTypeID,
           $this->laptopTypeCode,
           $this->laptopTypeName,
           $this->laptopShelfNumber
       );
       $result = $stmt->execute();
       $db->close();
       return $result;
   }

   static function getLaptopTypes() {
       $db = getDB();
       $query = "SELECT * FROM laptop_types ORDER BY laptop_type_id";
       $result = $db->query($query);
       $laptopTypes = array();
       while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
           $laptopTypes[] = new LaptopType(
               $row['laptop_type_id'],
               $row['laptop_type_code'],
               $row['laptop_type_name'],
               $row['laptop_ShelfNumber'],
               $row['date_time_created']
           );
       }
       $db->close();
       return (count($laptopTypes) > 0) ? $laptopTypes : NULL;
   }

   function updateLaptopType() {
       $db = getDB();
       $query = "UPDATE laptop_types SET 
                    laptop_type_code = ?, 
                    laptop_type_name = ?, 
                    laptop_ShelfNumber = ? 
                  WHERE laptop_type_id = $this->laptopTypeID";
       $stmt = $db->prepare($query);
       // 3 placeholders = 3 variables (s, s, i)
       $stmt->bind_param("ssi",
           $this->laptopTypeCode,
           $this->laptopTypeName,
           $this->laptopShelfNumber
       );
       $result = $stmt->execute();
       $db->close();
       return $result;
   }

   function removeLaptopType() {
        $db = getDB();
        $query = "DELETE FROM laptop_types WHERE laptop_type_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("i", $this->laptopTypeID);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }
  // Replace getTotalCategories with this at the end of laptoptype.php
static function getTotalLaptopTypes() {
    $db = getDB();
    $query = "SELECT COUNT(laptop_type_id) FROM laptop_types";
    $result = $db->query($query);
    $row = $result->fetch_array();
    $db->close();
    return $row ? $row[0] : 0;
}
}
?>