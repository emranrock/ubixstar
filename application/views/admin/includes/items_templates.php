<div class="item_<?= $res->order_id; ?>_<?= $line['id'] ?> ">
    <?php
    $total_price = $line['qty'] * $line['price'];
    $total_discount = $line['disc'];
    $after_discount = pure_decimal($total_price - $total_discount);
    ?>
    <h5 class="title"> <?= $line['title'] ?> <br />
        <small class="text-justify">Qty: <?= $line['qty'] ?> X <?= $line['price'] ?> =
            <span class="real_prc"><?= $total_price . '</span> ' ?>
                Discount:<span class="disc"><?= pure_decimal($total_discount) . '</span> ' ?>
        </small>
    </h5>

    <div class="inline">
        <input type="checkbox" class="form-check-input btn-space" data-id="<?= $line['id']; ?>" <?= $check; ?> />
        <button class="btn btn-xs btn-danger remove_item btn-space" data-id="<?= $res->order_id; ?>_<?= $line['id']; ?>" data-price="<?= $line['price'] ?>" data-qty="<?= $line['qty'] ?>" data-disc="<?= $line['disc'] ?> data-toggle=" tooltip" title="Delete"">
            <i class=" fa fa-minus-circle"></i>
        </button>
        <?php if ($this->uri->segment(2) != "returns") { ?>
            <button class="btn btn-xs btn-info merge_item btn-space" data-order_id="<?= $res->order_id; ?>" data-line_id="<?= $line['id'] ?>" data-phone="<?= $phone; ?>" data-address="<?= $address1 ?>" data-toggle="tooltip" title="Merge">
                <i class="fa fa-compress"></i>
            </button>
            <?php if ($count_line_items >= 2 && $count == 0) { ?>
                <button class="btn btn-xs btn-warning split_item btn-space" data-order_id="<?= $res->order_id; ?>_<?= $line['id'] ?>" data-toggle="tooltip" title="Split">
                    <i class="fa fa-arrows"></i>
                </button>
            <?php } ?>
            <?php

            if ($count == 0 && $this->uri->segment(2) == "shipment") { ?>
                <button class="btn btn-xs btn-success geo_btn btn-space" data-id="<?= $res->order_id ?>_<?= $line['id'] ?>" data-address="<?= $address1 ?><?= $address2 ?>"><i class="fa fa-map-marker" aria-hidden="true"></i></button>
                <div class="geocoding_area"></div>
        <?php }
        } ?>
        
    </div>
    
    <div class="<?= $line['id']; ?> hidden_fields">
        <input type="hidden" name="products[<?= $res->order_id ?>][order_id]" id="order_id_<?= $res->order_id ?>_<?= $line['id'] ?>" value="<?php echo $res->order_id; ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res->order_id ?>][order_price]" id="order_price_<?= $res->order_id ?>_<?= $line['id'] ?>" value="<?= $after_discount //$price; 
                                                                                                                                                    ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res->order_id; ?>][items][<?= $k; ?>][id]" id="item_id_<?= $res->order_id ?>_<?= $line['id'] ?>" value="<?= $line['id'] ?>" <?= $disabled ?> />
        <input type="hidden" name="products[<?= $res->order_id; ?>][items][<?= $k; ?>][product_pid]" value="<?= $line['pid'] ?>" id="product_id_<?= $res->order_id ?>_<?= $line['id'] ?>" <?= $disabled ?> />
    </div>
</div>
