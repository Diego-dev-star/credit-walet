<?php
add_action('admin_menu', 'budget_setting_page', 15);
function budget_setting_page()
{
    add_menu_page(
        __('pageart-budget', 'pb'), // title
        'Pageart-Budget', // link text
        'manage_options', // user role  who  can  create
        'budget-p',
        'create_budget_page', // view
        'dashicons-money', // icon
        10 // menu position
    );
}

add_action('admin_enqueue_scripts', 'style_backend', 25);
function style_backend()
{
    wp_enqueue_style('admin_styles', plugins_url('/pageart-budget/admin/css/plugin.css'));

}

function create_budget_page()
{
    return include __DIR__ . '/views/budget.php';
}

//writing  budget

function writing_budget()
{
    if ($_POST['submit'] == 'ok'):
        $file = fopen(__DIR__ . '/views/budget.txt', 'w+');
        $value = $_POST['budget'];
        fwrite($file, $value);
        fclose($file);
    endif;

}

function get_budget_value()
{
    $filename = __DIR__ . '/views/budget.txt';
    $budget = file($filename);
    return $budget[0];
}

function how_musch_budget()
{
    $budget = get_budget_value();
    $sum = 0;
    foreach (all_orders() as $price):
        $sum += $price['o_total'];
    endforeach;
    $suma = $budget - $sum;
    return $suma;
}

function tree_budget_column()
{
    //$budget = get_budget_value();
    $sum = 0;
    foreach (get_orders_story() as $price):
        if ($price['atribute'] != null):
            $sum += $price['price'];
        endif;
    endforeach;
    $suma = 0 + $sum;
    return $suma;
}

function get_orders_story()
{
    $query = new WC_Order_Query(array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
    ));
    $orders = $query->get_orders();
    $story = [];
    foreach ($orders as $order):
        foreach (wc_get_order($order)->get_items() as $key => $product):
            $id = (int)$product->get_product_id();
            $atr = new WC_Product($id);
            $story[$key]['p_data'] .= $product->get_id();
            $story[$key]['price'] .= (int)$atr->get_price() + ((int)$atr->get_price() * 0.23);
            $story[$key]['atribute'] .= $atr->get_attribute('pa_oznaczenie');
            $story[$key]['number'] .= wc_get_order($order)->get_id();
            $story[$key]['customer_name'] .= wc_get_order($order)->get_billing_first_name() . wc_get_order($order)->get_billing_last_name();
            $story[$key]['order_final_price'] .= wc_get_order($order)->get_total();
        endforeach;
    endforeach;
    return $story;

}

function all_orders()
{
    $query = new WC_Order_Query(array(
        'limit' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
    ));
    $orders = $query->get_orders();
    $total = [];
    foreach ($orders as $key => $order):
        $total[$key]['o_total'] .= wc_get_order($order)->get_total();
    endforeach;
    return $total;
}

