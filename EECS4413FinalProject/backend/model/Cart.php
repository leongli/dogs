<?php

require 'Item.php';

class Cart {
  public $cart;

  function __construct() {
    $this->cart = array();
  }

  /**
   * Adds an item to the cart or updates the quantity if the item is already present
   * @param int $id - The ID of the item.
   * @param string $name - The name of the item.
   * @param string $category - The category of the item.
   * @param float $price - The price of the item.
   * @param string $imageURL - The URL of the item's image.
   * @param string $brand - The brand of the item.
   * @param int $orderQty - The quantity of the item to be added (default is 1).
   */
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

  /**
   * Updates the quantity of an item in the cart
   * @param int $id - The ID of the item to be updated.
   * @param int $newQty - The new quantity of the item.
   */
  function update($id, $newQty) {
    foreach($this->cart as $item) {
        if($item->getId() == $id) {
            $item->setOrderQty($newQty);
        }
    }
  }

  /**
   * Removes an item from the cart
   * @param int $id - The ID of the item to be removed.
   */
  function remove($id) {
    foreach($this->cart as $key => $item) {
        if($item->getId() == $id) {
            unset($this->cart[$key]);
        }
    }
    $this->cart = array_values($this->cart);  // Reindex the array
  }

  /**
   * Returns the number of items in the cart
   * @return int - The number of items in the cart.
   */
  function size() {
    return count($this->cart);
  }

  /**
   * Checks if the cart is empty
   * @return bool - True if the cart is empty, false otherwise.
   */
  function isEmpty() {
    return (count($this->cart) == 0);
  }

    /**
   * Retrieves the items in the cart
   * @return array - An array containing the items in the cart.
   */
  function getCart() {
    return $this->cart;
  }

   /**
   * Clears all items from the cart
   */
  function clear() {
    $this->cart = array();
  }

  /**
   * Returns a string representation of the Cart object
   * @return string - A string representation of the Cart object.
   */
  function __toString()
  {
    return 'Cart to String';
  }

}

?>