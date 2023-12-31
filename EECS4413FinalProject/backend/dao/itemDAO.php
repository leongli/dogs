<?php
interface itemDAO {

    // public function getAllItems($mysqli);

    // public function getItemsByCat();

    // public function getItemsByBrand();

    // public function addItemToCart($item, $qty);

    // public function removeItemFromCart();

    public function getAllItems($mysqli);

    public function getItemsSorted($mysqli, $sort, $searchKey);

    public function searchItems($mysqli, $key);

    public function updateCartItem($id, $newQty);

    public function addItemToCart($item, $qty);

    public function removeItemFromCart($id);

    public function addItem($mysqli, $name, $desc, $category, $brand, $price, $fileName, $fileTmpName, $fileSize, $fileError);

    public function updateItem($mysqli, $id, $name, $desc, $category, $brand, $price, $qty, $fileName, $fileTmpName, $fileSize, $fileError);

    public function updateItemNoImage($mysqli, $id, $name, $desc, $category, $brand, $price, $qty);

    public function getItemsById($id, $config, $db);

    public function placeOrder($ship, $bill, $card);

}
