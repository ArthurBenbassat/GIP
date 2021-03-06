<?php
require_once 'classes/shopAPI.php';

class Cart
{
    function getCart($guid)
    {
      try {
          if (!isset($guid)) {
              return 'No products in the cart';
          } else {
              $api =  new ShopAPI();
              $cart = $api->getCart($guid);
              $items = '';
              if ($_COOKIE['language'] == 'en_US') {
                $totalLang = 'subtotal';
              } elseif ($_COOKIE['language'] == 'fr_FR') {
                $totalLang = 'total';
              } else {
                $totalLang = 'subtotaal';
              }

              if (count($cart->lines) == 0) {
                return 'No products in the cart';
              } else {
                for ($i = 0; $i < count($cart->lines); $i++) {
                    $productId = $cart->lines[$i]->product->id;
                    $id = $cart->lines[$i]->id;
                    $quantity = $cart->lines[$i]->quantity;
                    $name = $cart->lines[$i]->product->name;
                    $photo = $cart->lines[$i]->product->photo;
                    $price = number_format((float)$cart->lines[$i]->product->price, 2, '.', '');
                    $total = number_format((float)$cart->totalPrice, 2, '.', '');
                    $linePrice = number_format((float)$cart->lines[$i]->linePrice, 2, '.', '');
                    $items .= "<tr id='line$id'>
                <td>
                  <div class='media'>
                  <a href='product.php?id=$productId'>
                    <div class='d-flex'>
                      <img
                        src='img/product/$photo'
                        alt=''
                      />
                    </div>
                    </a>
                    <div class='media-body'>
                      <p>$name</p>
                    </div>
                    
                  </div>
                </td>
                <td>
                  <h5>€$price</h5>
                </td>
                <td>
                <form>
                <div class='value-button' id='decrease' onclick='decreaseValue(this)' data-line_id='$id' data-line_index='$i' value='Decrease Value'>-</div>
                <input type='number' id='number$id' class='number' value='$quantity'/>
                <div class='value-button' id='increase' onclick='increaseValue(this)' data-line_id='$id' data-line_index='$i' value='Increase Value'>+</div>
                </form>
                </td>
                <td>
                  <h5 id='linePrice$id'>€$linePrice</h5>
                </td>
                <td>
                <button class='btn delProductCart' data-line_id='$id'><i class='fa fa-trash'></i></button>
                </td>
              </tr>";
                }
                
                $items .= "
              <tr id='subtotal'>
                <td></td>
                <td></td>
                <td>
                  <h5>$totalLang</h5>
                </td>
                <td>
                  <h5 id='totalPrice'>€$total</h5>
                </td>
              </tr>
              ";

                return $items;
              }
          }
        } catch (Exception $e) {
          return '';
        }
    }
}
