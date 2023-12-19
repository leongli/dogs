<?php

require 'itemDAO.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function create_id() {
    $length = rand(4,20);
    $number = "";

    for($i = 0; $i < $length; $i++) {
        $new_rand = rand(0,9);
        $number = $number . $new_rand;
    }

    return $number;
}

define('MB', 1048576);

class itemDAOImpl implements itemDAO {

  
    public function getAllItems($mysqli){

        // Create Query
        $query = "SELECT * FROM items";

        // Get Result
        $result = $mysqli -> query($query);

        // Fetch Data
        return $result -> fetch_all(MYSQLI_ASSOC);

    }

    public function getItemsSorted($mysqli, $sortKey, $searchKey){
        
        if($searchKey==null){
            $query = "SELECT * FROM items";
        }else{
            $newkey = $mysqli -> real_escape_string(test_input($searchKey));
            $query = "SELECT * FROM items WHERE `Name` LIKE '%" . $newkey . "%' OR Category LIKE '%" . $newkey . "%' OR Brand LIKE '%" . $newkey . "%'";
        }
        
       
        $sort = $mysqli -> real_escape_string(test_input($sortKey));
        
        if($sort == "Price Ascending"){
            $query .=" ORDER BY price ASC";
        }else if ($sort == "Price Descending"){
            $query.=" ORDER BY price DESC";
        }else if ($sort == "Brand Ascending"){
            $query.=" ORDER BY Brand ASC";
        }else if ($sort == "Brand Descending"){
            $query.=" ORDER BY Brand DESC";
        }else if ($sort == "Category Ascending"){
            $query.=" ORDER BY Category ASC";
        }else if ($sort == "Category Descending"){
            $query.=" ORDER BY Category DESC";
        }
        $result = $mysqli -> query($query);
        return $result -> fetch_all(MYSQLI_ASSOC);
    }


    public function searchItems($mysqli, $key){

        $newkey = $mysqli -> real_escape_string(test_input($key));

        // Create Query
        $query = "SELECT * FROM items WHERE `Name` LIKE '%" . $newkey . "%' OR Category LIKE '%" . $newkey . "%' OR Brand LIKE '%" . $newkey . "%'";

        // Get Result
        $result = $mysqli -> query($query);

        // Fetch Data
        return $result -> fetch_all(MYSQLI_ASSOC);

    }

    public function updateCartItem($id, $newQty) {
        require_once('../config/config.php');
        require('../config/db.php');
        require("../model/Cart.php");
        session_start(); 
        require('../controller/cartController.php');

        $newQty = $mysqli -> real_escape_string(test_input($newQty));
        $id = $mysqli -> real_escape_string(test_input($id));

        $cart->update($id, $newQty);
    }

    public function addItemToCart($item, $qty){
        require_once('../config/config.php');
        require('../config/db.php');
        require("../model/Cart.php");
        session_start(); 
        require('../controller/cartController.php');

        $qty = $mysqli -> real_escape_string(test_input($qty));

        $cart->add($item['ItemID'], $item['Name'], $item['Category'], $item['Price'], $item['ImageURL'], $item['Brand'], $qty);
    }

    public function removeItemFromCart($id){
        require_once('../config/config.php');
        require('../config/db.php');
        require("../model/Cart.php");
        session_start(); 
        require('../controller/cartController.php');

        $id = $mysqli -> real_escape_string(test_input($id));

        $cart->remove($id);
    }

    public function addItem($mysqli, $name, $desc, $category, $brand, $price, $fileName, $fileTmpName, $fileSize, $fileError) {

    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg', 'jpeg', 'png');
    
        if(in_array($fileActualExt, $allowed)) {
            if($fileError === 0) {
                if($fileSize < 10*MB) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
    
                    $fileDestination = 'itemimages/' . $fileNameNew;
    
                    $query = "INSERT INTO items(`Name`, `Description`, Category, Brand, Price, ImageURL) VALUES(?,?,?,?,?,?)";

                    $stm = $mysqli -> prepare($query);
    
                    if($stm) {
                        $url = 'backend/itemimages/' . $fileNameNew;
                        $stm -> bind_param("ssssss",$name, $desc, $category, $brand, $price, $url);
                        // $check = $stm -> execute($arr);
        
                        if($stm -> execute()) {
                        //success 
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return 'Success';
                        } else {
                            return 'ERROR '. $mysqli -> error;
                        }
        
                    }
    
                } else {
                    return "The file you're trying to uplaod is over 10mb!";
                }
            } else {
                return "There was a error uploading your file!";
            }
        } else {
            return "You cannot upload files of this type!";
        }
            
    }

    public function updateItem($mysqli, $id, $name, $desc, $category, $brand, $price, $qty, $fileName, $fileTmpName, $fileSize, $fileError) {
        // Check if a file was uploaded
        if ($fileSize > 0 && $fileError === 0) {
            // Generate a unique file name
            $uniqueFileName = uniqid('item_image_') . '_' . time() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

            // Move the uploaded file to the "itemimages" directory
            $destination_path = getcwd().DIRECTORY_SEPARATOR;
            $target_path = $destination_path . basename( $fileName);
            @move_uploaded_file($fileTmpName, $target_path);

            // $uploadPath = './itemimages/' . $uniqueFileName;
            // move_uploaded_file($fileTmpName, $uploadPath);

            // Use the new file path in the update statement
            $imageURL = basename( $fileName);
        } else {
            // If no new image is provided, keep the existing one
            $imageURL = ''; // You may want to fetch the existing image URL from the database
        }

        // Prepare and execute the update statement
        $stmt = $mysqli->prepare("
            UPDATE `items`
            SET
                `Name` = ?,
                `Description` = ?,
                `Category` = ?,
                `Brand` = ?,
                `Price` = ?,
                `ImageURL` = ?,
                `Qty` = ?
            WHERE
                `ItemID` = ?
        ");

        $stmt->bind_param('ssssssss', $name, $desc, $category, $brand, $price, $imageURL, $qty, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function updateItemNoImage($mysqli, $id, $name, $desc, $category, $brand, $price, $qty) {
        $query = "UPDATE `items`
        SET
            `Name` = ?,
            `Description` = ?,
            `Category` = ?,
            `Brand` = ?,
            `Price` = ?,
            `Qty` = ?
        WHERE
            `ItemID` = ?;
        ";

        $stm = $mysqli -> prepare($query);

        if($stm) {
            $stm -> bind_param("sssssss",$name, $desc, $category, $brand, $price, $qty, $id);
            // $check = $stm -> execute($arr);

            if($stm -> execute()) {
                //success 
                return 'Success';
            } else {
                return 'ERROR '. $mysqli -> error;
            }
        }
    }

    public function getItemsById($id, $config, $db){

        require_once($config);
        require($db);

        $id = $mysqli -> real_escape_string(test_input($id));

         // Create Query
         $query = "SELECT * FROM items WHERE ItemID = " . $id . ";";

         // Get Result
         $result = $mysqli -> query($query);
 
         // Fetch Data
         return $result -> fetch_all(MYSQLI_ASSOC);
    }

    public function placeOrder(){
        require_once('../config/config.php');
        require('../config/db.php');
        require("../model/Cart.php");
        session_start(); 
        require('../controller/cartController.php');

        $totalCost = 0;
        $orderCart = $cart->getCart();

        $arr['id'] = create_id();
        $condition = true;
        while($condition) {
            $query = "SELECT * FROM orders WHERE OrderID = ? LIMIT 1";
            $stm = $mysqli -> prepare($query);

            if($stm) {
                $stm -> bind_param("s", $arr['id']);
            
                if($stm -> execute()) {
                    $result = $stm -> get_result();
                    $data = $result -> fetch_all(MYSQLI_ASSOC);
                    if(is_array($data) && count($data) > 0) {
                        $arr['id'] = create_id();
                        continue;
                    }
                }
            }
            $condition = false;
        }


        $query = "INSERT INTO orders(OrderID,CustomerID,DatePurchase,TotalCost) VALUES(" . $arr['id'] . "," . $_SESSION['myid'] . ",'" . date('Y-m-d') . "'," . $totalCost . ");";
        
        if($mysqli -> query($query)) {
            // Success
        } else {
            return 'ERROR'. $mysqli -> error;
        }

        if(isset($displaycart) || !$cart->isEmpty()) :
            foreach($orderCart as $item) :
                
                $query = "INSERT INTO order_items(OrderID,ItemID,`Name`,Category,Brand,Price,ImageURL,Qty) VALUES(?,?,?,?,?,?,?,?)";

                $stm = $mysqli -> prepare($query);
    
                if($stm) {

                    $itemId = $item->getId();
                    $itemName = $item->getName();
                    $itemCat = $item->getCategory();
                    $itemBrand = $item->getBrand();
                    $itemPrice = $item->getPrice();
                    $itemImg = $item->getImageURL();
                    $itemQty = $item->getOrderQty();

                    $stm -> bind_param("ssssssss", $arr['id'], $itemId, $itemName, $itemCat, $itemBrand, $itemPrice, $itemImg, $itemQty);
                    // $check = $stm -> execute($arr);
        
                    if($stm -> execute()) {
                        //success 
                    } else {
                        return 'ERROR '. $mysqli -> error;
                    }
        
                }
            
                $totalCost += ($item->getPrice() * $item->getOrderQty());
    
            endforeach; 
        endif;

        
        // Update total cost
        $query = "UPDATE orders SET TotalCost = " . $totalCost . " WHERE OrderID = " . $arr['id'];

        if($mysqli -> query($query)) {
        } else {
            echo 'ERROR'. $mysqli -> error;
        }

        $_SESSION['mycart'] = new Cart();

        return $arr['id'];

    }
}