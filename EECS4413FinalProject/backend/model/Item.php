<?php

class Item {
  public $id;
  public $name;
  public $category;
  public $price;
  public $imageURL;
  public $brand; 
  public $orderQty; 

  /**
   * Constructor for the Item class
   * @param int $id - The ID of the item
   * @param string $name - The name of the item
   * @param string $category - The category of the item
   * @param float $price - The price of the item
   * @param string $imageURL - The URL of the item's image
   * @param string $brand - The brand of the item
   * @param int $orderQty - The quantity of the item (default is 1)
   */
  function __construct($id, $name, $category, $price, $imageURL, $brand, $orderQty = 1) {
    $this->id = $id;
    $this->name = $name;
    $this->category = $category;
    $this->price = $price;
    $this->imageURL = $imageURL;
    $this->brand = $brand;
    $this->orderQty = $orderQty;
  }

  /**
   * Gets the ID of the item
   * @return int - The ID of the item
   */
  function getId() {
    return $this->id;
  }

  /**
   * Sets the ID of the item
   * @param int $id - The new ID of the item
   */
  function setId($id) {
    $this->id = $id;
  }

  /**
   * Gets the name of the item
   * @return string - The name of the item
   */
  function getName() {
    return $this->name;
  }

  /**
   * Sets the name of the item
   * @param string $name - The new name of the item
   */
  function setName($name) {
    $this->name = $name;
  }

  /**
   * Gets the category of the item
   * @return string - The category of the item
   */
  function getCategory() {
    return $this->category;
  }

  /**
   * Sets the category of the item
   * @param string $category - The new category of the item
   */
  function setCategory($category) {
    $this->category = $category;
  }

    /**
   * Gets the price of the item
   * @return float - The price of the item
   */
  function getPrice() {
    return $this->price;
  }

  /**
   * Sets the price of the item
   * @param float $price - The new price of the item
   */
  function setPrice($price) {
    $this->price = $price;
  }
  
  /**
   * Gets the URL of the item's image
   * @return string - The URL of the item's image
   */
  function getImageURL() {
    return $this->imageURL;
  }

  /**
   * Sets the URL of the item's image
   * @param string $imageURL - The new URL of the item's image
   */
  function setImageURL($imageURL) {
    $this->imageURL = $imageURL;
  }

  /**
   * Gets the brand of the item
   * @return string - The brand of the item
   */
  function getBrand() {
    return $this->brand;
  }

  /**
   * Sets the brand of the item
   * @param string $brand - The new brand of the item
   */
  function setBrand($brand) {
    $this->brand = $brand;
  }

  /**
   * Gets the quantity of the item
   * @return int - The quantity of the item
   */
  function getOrderQty() {
    return $this->orderQty;
  }

  /**
   * Sets the quantity of the item
   * @param int $orderQty - The new quantity of the item
   */
  function setOrderQty($orderQty) {
    $this->orderQty = $orderQty;
  }

  /**
   * Returns a string representation of the Cart object
   * @return string - A string representation of the Cart object
   */
  function __toString()
  {
    // Use for order page do display all the information
  }

}

?>