
<section class="event__section buy-container">
    <div class="event__section__contents">
        <?php  if(NotikumiRenderHelper::hasSale($event->sessions)) { ?>
            <div id="checkout_target"></div>
        <?php } else { ?>
            <?=__('Venta de entradas no activa','notikumi-ticketing')?>
        <?php } ?>
    </div>
</section>