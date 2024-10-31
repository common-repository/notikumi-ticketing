<?php
global $ntk_path, $shortcode_position;
global $ntk_action_call_purchase_tickets, $ntk_action_call_purchase_tickets_en;
$desired_image_size = 400;
$format_date = array(
    'es' => 'j \\d\\e F', 
    'en' => 'j F'
);
?>


<section class="list-cards">
<?php
foreach($events as $event) {
?>

<div class="card-event-container">
    <div class="card-event <?=($event->sessions[0]->status == 5) ? 'card-event-cancel' : ''?>">
        <?php if(count($event->images) > 0) { ?>
            <a class="card-event__main-image" href="<?=NotikumiRenderHelper::printLink($event, $ntk_path)?>">
                <div class="image" style="background-image:url(<?=esc_url(NotikumiRenderHelper::get_image_first($event, $desired_image_size))?>)"></div>
            </a>
        <?php } ?>
        <div class="card-event__main-content">
            <div class="text-container">
                <a href="<?=NotikumiRenderHelper::printLink($event, $ntk_path)?>">
                    <h2 class="event">
                        <?=NotikumiRenderHelper::getTitle($event); ?>
                    </h2>
                </a>
                <?php 
                foreach($event->venues as $venue) {
                ?>
                    <div class="location"><?= $venue->name ?>, <?= $venue->place ?></div>
                <?php
                }
                
                ?>
                <?php
                foreach($event->sessions as $session) {
                ?>
                <div class="date"><?= date($format_date[NotikumiRenderHelper::get_locale()], $session->startTms/1000)?></div>
                <?php
                }


                NotikumiRenderHelper::print_cancel_box($event);

                ?>
            </div>

            <div class="buy-container">
            <?php 
            if($session->sales && isset($session->sales->channel)) {
            ?>
                <a href="<?=NotikumiRenderHelper::printLink($event, $ntk_path)?>" class="btn btn-primary btn-main">
                    <?= NotikumiRenderHelper::printAnchorLink($ntk_action_call_purchase_tickets, $ntk_action_call_purchase_tickets_en); ?>
                </a>
            <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>


<?php
}
?>

</section>
