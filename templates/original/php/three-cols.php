<?php
global $ntk_path;
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
                    <a href="<?= NotikumiRenderHelper::printLink($event, $ntk_path)?>">
                        <h2 class="event">
                            <?= NotikumiRenderHelper::getTitle($event) ?>
                        </h2>
                    </a>
                    <?php 
                    foreach($event->venues as $venue) {
                    ?>
                        <div class="location"><?= esc_html($venue->name) ?>, <?= esc_html($venue->place) ?></div>
                    <?php
                    }
                    ?>
                    <?php
                    foreach($event->sessions as $session) {
                    ?>
                    <div class="date"><?= date($format_date[$locale], $session->startTms/1000)?></div>
                    <?php
                    }

                    NotikumiRenderHelper::print_cancel_box($event);
                    ?>
                </div>

                <div class="buy-container">
                <?php 
                if($session->sales) {
                ?>
                    <a href="<?=NotikumiRenderHelper::printLink($event,$ntk_path)?>" class="btn btn-primary btn-main">
                        <?=
                        NotikumiRenderHelper::printAnchorLink($ntk_action_call_purchase_tickets, $ntk_action_call_purchase_tickets_en);
                        ?>
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

<!--

<section>
<?php
if(count($event->images) > 0) {
?>
    <a href="<?= NotikumiRenderHelper::getFirstSession($event)->slug?>">
        <img src="<?=$event->images[0]->sizes->$desired_image_size?>" width="400"/>
    </a>
<?php
}
?>

<h3><?= $event->title; ?></h3>
<?php 
foreach($event->venues as $venue) {
?>
    <div><?= $venue->name ?>, <?= $venue->place ?></div>
<?php
}
?>

<?php
foreach($event->sessions as $session) {
?>
    <div>
        <a href="./url-event-detail/<?=$session->slug?>">
            <?= date("D, j F Y H:i", $session->startTms/1000)?>
        </a>

        <?php 
        if($session->sales) {
        ?>
            <button>Comprar entradas</button>
        <?php
        }
        ?>
    </div>
<?php
}
?>

-->