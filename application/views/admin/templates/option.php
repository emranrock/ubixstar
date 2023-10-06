<?php var_dump($res);?>
<div class="item_<?= $res['order_id'] ?>_<?= $line['id'] ?>">
    <h5><?= $line['title'] ?></h5>
    <div class="inline">
        <input type="checkbox" class="form-check-input btn-space" data-id="<?= $line['id'] ?>" <?= $check ?> />
        <button class="btn btn-xs btn-danger remove_item btn-space" data-id="<?= $res['order_id'] ?>_<?= $line['id'] ?>" data-price="<?= $line['price'] ?>"><i class="fa fa-minus-circle"></i></button>
        <button class="btn btn-xs btn-info merge_item btn-space" data-order_id="<?= $res['order_id'] ?>" data-line_id="<?= $line['id'] ?>"><i class="fa fa-compress"></i> </button>
        <?php if ($count === 0) { ?>
            <button class="btn btn-xs btn-default btn-link geo_btn" data-id="<?= $res['order_id'] ?>_<?= $line['id'] ?>" data-address="<?= $address1 ?><?= $address2 ?>">Geo Code</button>
            <div class="geocoding_area"></div>
        <?php } ?>

    </div>
    <div class="<?= $line['id'] ?> hidden_fields">
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][id]" id="product_id_<?= $res['order_id'] ?>_<?= $line['id'] ?>" value="<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][title]" value="<?= $line['title'] ?>" id="product_title_<?= $res['order_id'] ?>_<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][sku]" value="<?= $line['sku'] ?>" id="product_sku_<?= $res['order_id'] ?>_<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][qty]" value="<?= $line['qty'] ?>" id="product_qty_<?= $res['order_id'] ?>_<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][price]" value="<?= $line['price'] ?>" id="product_price_<?= $res['order_id'] ?>_<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res['order_id'] ?>][<?= $k ?>][product_id]" value="<?= $line['pid'] ?>" id="product_id_<?= $res['order_id'] ?>_<?= $line['id'] ?>" <?= $disabled ?> />
    </div>
</div>