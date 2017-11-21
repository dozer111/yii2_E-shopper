<?php if(!empty($session['cart'])) : ?>
<div class="table-responsive">
    <table class="table table-hover table-striped">
    <thead>
    <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Delete Position</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($session['cart'] as $id=>$item): ?>
    <tr>
        <td><?=\yii\helpers\Html::img("@web/images/home/{$item['img']}")?></td>
        <td><?= $item['name']?></td>
        <td><?= $item['price']?></td>
        <td> <?= $item['qty']?></td>
        <td><span data-id="<?=$id?>" class="glyphicon glyphicon-remove text-danger delItem" aria-hidden="true"></span></td>
    </tr>

    <?php endforeach; ?>
    <tr>
        <td>All items</td>
        <td><?=$session['cart.qty']?></td>
    </tr>
    <tr>
        <td>Res price</td>
        <td><?=$session['cart.sum']?></td>
    </tr>
    </tbody>
    </table>


</div>
<?php endif; ?>