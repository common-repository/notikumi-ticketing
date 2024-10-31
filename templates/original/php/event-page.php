<?php
$desired_image_size = 400;
?>

<section class="event__section">
    <div class="card-event__main-content">
            
        <?php if(count($event->images) > 0) { ?>
            <div class="card-event__main-image">
                <img src="<?=esc_url(NotikumiRenderHelper::get_image_first($event, $desired_image_size))?>">
            </div>
        <?php } ?>
        
        <div class="main-info-container">
            <div class="main-info venue">
            <?php 
            foreach($event->venues as $venue) {
                NotikumiRenderHelper::print_venue($venue);
            }
            ?>
            </div>
            
            <div class="main-info date">
            <?php
            if(count($event->sessions) == 1) {
                NotikumiRenderHelper::print_session($event->sessions[0]);
            }
            else if(count($event->sessions) < 5) {
                foreach($event->sessions as $session) {
                    NotikumiRenderHelper::print_session($session);
                }
            }
            else { ?>
                <span><?=__('Múltiples sesiones','notikumi-ticketing')?></span>
            <?php } ?>
            </div>

            <?php
                NotikumiRenderHelper::print_cancel_box($event);
            ?>
        </div>
    </div>
</section>

<section class="event__section buy-container">
    <div class="event__section__title">            
        <span>
            <span class="dashicons-before dashicons-tickets-alt has-icons"></span>
            <?=__('Entradas','notikumi-ticketing')?>       
            <span class="secondary_text">
                <?=NotikumiRenderHelper::print_from($event->sessions)?>
            </span>
        </span>
        <span>
            <span class="dashicons-before dashicons-arrow-down-alt2 has-icons"></span>
        </span>
    </div>
    <div class="event__section__contents">
        <?php  if(NotikumiRenderHelper::hasSale($event->sessions)) { ?>
            <div id="checkout_target"></div>
        <?php } else { ?>
            <?=__('Venta de entradas no activa','notikumi-ticketing')?>            
        <?php } ?>
    </div>
</section>


<section class="event__section">
    <div class="">
        <div class="card-event__description">
            <?= NotikumiRenderHelper::print_description($event->descriptions);  ?>
        </div>        
    </div>
</section>