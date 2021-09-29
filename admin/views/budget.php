<h1><?php _e('Utwórz budżet ogólny', 'pb') ?></h1>
<div class="container">
    <h2><?php _e('Sekcja tworzenia budżetu', 'pb') ?></h2>
    <form action="<?php writing_budget() ?>" class="budget-form" method="post">
        <div class="enter-form">
            <input class="form" id="budget" name="budget" type="number" value="<?php echo  get_budget_value(); ?>"/>
            <input type="submit" name="submit" class="btn-custom" value="ok">
        </div>
        <strong><?php _e('Budżet: ', 'pb') ?><span><?php echo get_budget_value(); ?>
                <?php echo get_woocommerce_currency() ?></span></strong>
        <strong><?php _e('Pozostały budżet: ', 'pb') ?><span><?php echo how_musch_budget(); ?>
                <?php echo get_woocommerce_currency() ?></span></strong>
        <strong><?php _e('Poza umowy: ', 'pb') ?><span><?php echo tree_budget_column(); ?>
                <?php echo get_woocommerce_currency() ?></span></strong>

    </form>
</div>

<div class="conatiner__history">
    <h2><?php _e('Historia wykorzystania budżetu', 'pb') ?></h2>
    <table>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th width="25%"><?php _e('Imię ', 'pb') ?><?php _e('Nazwisko', 'cc') ?></th>
            <th width="25%"><?php _e('suma', 'pb') ?></th>
            <th width="25%"><?php _e('zamówienie', 'pb') ?></th>
            <th width="25%"><?php _e('Kwota zamówienia','pb')?></th>
        </tr>
        </thead>
        <tbody>
        <?php $num =1;
        $data = get_orders_story()?>
        <?php foreach ( $data as $item): ?>
            <?php if($item['price'] != 0):?>
            <tr>
                <th scope="row"><?php echo $num++?></th>
                <td width="25%"><?php echo $item['customer_name']?></td>
                <td width="25%"> - <?php echo $item['price']?> <?php echo get_woocommerce_currency();?></td>
                <td width="25%"><?php _e('Zamówienie #','pb')?><?php echo $item['number']?></td>
                <td width="25%"><?php echo $item['order_final_price']?> <?php echo get_woocommerce_currency();?></td>
            </tr>
                <?php endif;?>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>