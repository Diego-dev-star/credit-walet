<?php
/*
Plugin Name: pageart-budget
Description: Create alternative bubget for  cutomers SMK
Author: Vitali B for Pageart TM
Version: 0.0.1
*/

//including bacend function file
include __DIR__.'/admin/backend-functions.php';
// add front link  on template

add_filter('wp_nav_menu_items', 'menu_link', 10, 2);

function menu_link($items, $args) {

    if ($args->menu_id == 'primary-menu'){
        $items .= '
           <li>
             
              <a href="#"> <i class="fa fa-credit-card-alt" aria-hidden="true"></i> 
              '.how_musch_budget().' '.get_woocommerce_currency().'
              
          </li>   
          <li>  
           <a href="#"> <i class="fa fa-calculator" aria-hidden="true"></i>
              '.tree_budget_column().' '.get_woocommerce_currency().'
              </a>  
              </li> 
          ';

    }

    return $items;
}
