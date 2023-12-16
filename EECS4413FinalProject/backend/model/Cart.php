<?php

require 'Item.php';

class Cart {
  public $cart;

  function __construct() {
    $this->cart = array();
  }

  function add($id, $name, $category, $price, $imageURL, $brand, $orderQty = 1) {
    $found = false;
    foreach($this->cart as $item) {
        if($item->getId() == $id) {
            $found = true;
            $item->setOrderQty((int)$item->getOrderQty() + (int)$orderQty);
        }
    }

    if(!$found) {
        $newItem = new Item($id, $name, $category, $price, $imageURL, $brand, $orderQty);
        // print_r($newItem) ;
        // print_r($this->cart) ;
        if(count($this->cart) == 0) {
          $this->cart = array($newItem);
          // print_r($newItem) ;
          // print_r($this->cart) ;
        } else {
          array_push($this->cart, $newItem);
        }
        // print_r($this->cart) ;
    }
  }

  function update($id, $newQty) {
    foreach($this->cart as $item) {
        if($item->getId() == $id) {
            $item->setOrderQty($newQty);
        }
    }
  }

  function remove($id) {
    foreach($this->cart as $key => $item) {
        if($item->getId() == $id) {
            unset($this->cart[$key]);
        }
    }
    $this->cart = array_values($this->cart);  // Reindex the array
  }

  function size() {
    return count($this->cart);
  }

  function isEmpty() {
    return (count($this->cart) == 0);
  }

  function getCart() {
    return $this->cart;
  }

  function clear() {
    $this->cart = array();
  }

  function __toString()
  {
    return 'Cart to String';
  }

}

?>