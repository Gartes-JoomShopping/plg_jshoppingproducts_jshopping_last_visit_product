<?php
/**
* @package Joomla
* @subpackage JoomShopping
* @author Nevigen.com
* @website http://nevigen.com/
* @email support@nevigen.com
* @copyright Copyright � Nevigen.com. All rights reserved.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @license agreement http://nevigen.com/license-agreement.html
**/

    use Joomla\CMS\Uri\Uri;

    defined('_JEXEC') or die;

class plgJshoppingproductsJshopping_last_visit_product extends JPlugin {

    /**
     * Перед отображением страницы товара
     *
     * @param JshoppingViewProduct $view
     *
     * @since  3.9
     * @auhtor Gartes | sad.net79@gmail.com | Skype : agroparknew | Telegram : @gartes
     * @date   02.12.2020 14:34
     */
    function onBeforeDisplayProductView(JshoppingViewProduct $view) {

        $session = \Joomla\CMS\Factory::getSession();
		$RecentlyViewed = $session->get('RecentlyViewed', [] );
        if( !in_array( $view->product->product_id , $RecentlyViewed ) )
        {
            $RecentlyViewed[] = $view->product->product_id ;
        }#END IF
        $session->set('RecentlyViewed', $RecentlyViewed );



//		echo'<pre>';print_r( $RecentlyViewed );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );



//        $RecentlyViewed


		$last_visited_products = $session->get('last_visited_products', array());

//		echo'<pre>';print_r( $last_visited_products );echo'</pre>'.__FILE__.' '.__LINE__;
//		die(__FILE__ .' '. __LINE__ );
        return ;


		if (isset($last_visited_products[$view->product->product_id])) {
			unset($last_visited_products[$view->product->product_id]);
		}
		$product = new stdClass();
		$product->name = $view->product->name;
		$product->orig_image = $view->product->image;
		$product->image = $view->product->image;
		$product->product_thumb_image = $view->product->product_thumb_image;
		$product->product_id = $view->product->product_id;
		$product->currency_id = $view->product->currency_id;
		$product->tax_id = $view->product->product_tax_id;
		$product->orig_product_price = $view->product->product_price;
		$product->product_price = $view->product->product_price;
		$product->product_old_price = $view->product->product_old_price;
		$product->min_price = $view->product->min_price;
		$product->different_prices = $view->product->different_prices;
		$product->product_manufacturer_id = $view->product->product_manufacturer_id;
		$product->vendor_id = $view->product->vendor_id;
		$product->delivery_times_id = $view->product->delivery_times_id;
		$product->label_id = $view->product->label_id;
		$product->category_id = $view->category_id;
		$last_visited_products[$product->product_id] = $product;
		$session->set('last_visited_products', $last_visited_products);
    }

}
?>