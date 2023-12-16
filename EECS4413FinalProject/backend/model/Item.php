<?php

class Item {
  public $id;
  public $name;
  public $category;
  public $price;
  public $imageURL;
  public $brand; 
  public $orderQty; 

  function __construct($id, $name, $category, $price, $imageURL, $brand, $orderQty = 1) {
    $this->id = $id;
    $this->name = $name;
    $this->category = $category;
    $this->price = $price;
    $this->imageURL = $imageURL;
    $this->brand = $brand;
    $this->orderQty = $orderQty;
  }

  function getId() {
    return $this->id;
  }

  function setId($id) {
    $this->id = $id;
  }

  function getName() {
    return $this->name;
  }

  function setName($name) {
    $this->name = $name;
  }

  function getCategory() {
    return $this->category;
  }

  function setCategory($category) {
    $this->category = $category;
  }

  function getPrice() {
    return $this->price;
  }

  function setPrice($price) {
    $this->price = $price;
  }
  
  function getImageURL() {
    return $this->imageURL;
  }

  function setImageURL($imageURL) {
    $this->imageURL = $imageURL;
  }

  function getBrand() {
    return $this->brand;
  }

  function setBrand($brand) {
    $this->brand = $brand;
  }

  function getOrderQty() {
    return $this->orderQty;
  }

  function setOrderQty($orderQty) {
    $this->orderQty = $orderQty;
  }

  function __toString()
  {
    // Use for orde page do display all the information
  }

}

?>