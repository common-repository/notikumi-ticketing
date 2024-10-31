<?php
class NotikumiRenderHelper {

    public static $hour_separator_at = array(
        'es' => ' \\a \\l\\a\\s', 
        'en' => ' ');
    public static $hour_separator_from = array(
        'es' => ' \\d\\e\\s\\d\\e', 
        'en' => ' \\f\\r\\o\\m');
    public static $hour_separator_until = array(
        'es' => ' \\h\\a\\s\\t\\a', 
        'en' => ' \\t\\o');
    public static $date_separator = array(
        'es' => ' \d\\e ', 
        'en' => ' ');
    public static $opening_gates = array(
        'es' => 'Apertura de puertas', 
        'en' => 'Opening doors');


    public static $ALLOWED_LANGS = array("es", "en");
    public static $DEFAULT_LANG = "en";
    public static $DEFAULT_LOCALE = "en_US";

    public static function getFirstSession($event) {
        return $event->sessions[0];
    }
    public static function getTitle($event) {
        $title = $event->title;
        $title = str_replace("Evento de ", "", $title);
        $title = str_replace("Concierto de ", "", $title);

        return esc_html($title);
    }
    public static function printLink($event, $local_path) {        
        $path = get_site_url().$local_path."/";
        return esc_url($path.NotikumiRenderHelper::getFirstSession($event)->slug);
    }

    public static function printAnchorLink($custom_es, $custom_en) {
        if(NotikumiRenderHelper::get_locale() == "es" && !empty($custom_es)) {
            echo $custom_es;
        }
        else if(NotikumiRenderHelper::get_locale() == "en" && !empty($custom_en)) {
            echo $custom_en;
        }
        else _e('Comprar entradas', 'notikumi-ticketing' );
    }

    public static function printDate($session) {
        return date("l, j ".NotikumiRenderHelper::$date_separator[NotikumiRenderHelper::get_locale()]." F Y", $session->startTms/1000);
    }

    public static function printDateDetail($session) {
        $multiple_date = (($session->endTms - $session->startTms) / 1000 / 60 / 60 / 24) > 1;
        $startFormat = "";
        $endFormat = "";
        $locale = NotikumiRenderHelper::get_locale();

        if($multiple_date) {
            $startFormat = "d-m-Y";
            $endFormat = " / d-m-Y";
        }
        else {
            $startFormat = "l, j ".NotikumiRenderHelper::$date_separator[$locale]." F Y";
        }

        if($session->hasStartHour && $session->hasEndHour) {
            $startFormat .= NotikumiRenderHelper::$hour_separator_from[$locale]." H:i";
            $endFormat .= NotikumiRenderHelper::$hour_separator_until[$locale]." H:i";
        }
        else if($session->hasEndHour) {
            $endFormat .= NotikumiRenderHelper::$hour_separator_until[$locale]." H:i";
        }
        else if($session->hasStartHour) {
            $startFormat .= NotikumiRenderHelper::$hour_separator_from[$locale]." H:i";
        }
        
        $start = date($startFormat, $session->startTms/1000);

        $end = $endFormat != "" ? date($endFormat, $session->endTms/1000) : "";

        return esc_html($start."".$end);
    }

    public static function print_session($session) { ?>
        <div class="">
            <div class="session_date dashicons-before dashicons-calendar-alt has-icons">
                <?=esc_html(NotikumiRenderHelper::printDateDetail($session))?>
            </div>
            <?php if($session->openingDoors != "") { ?>
                <div class="secondary-info opening_doors">
                    <?=__('Apertura de puertas','notikumi-ticketing').': '.esc_html($session->openingDoors) ?>
                </div>
            <?php } 
        ?>
        </div>
        <?php
    }

    public function print_event_form_to_grid($slug, $channel, $custom_css) {
		echo NotikumiRenderHelper::get_event_form_to_grid($slug, $channel, $custom_css);
    }
    
	public function get_event_form_to_grid($slug, $channel, $custom_css) {
		$out = '
			<input type="hidden" id="ntk-checkout-slug" value="'.$slug.'">
			<input type="hidden" id="ntk-checkout-channel" value="'.$channel.'">
			<input type="hidden" id="ntk-checkout-locale" value="'.NotikumiRenderHelper::get_locale().'">
			<input type="hidden" id="ntk-checkout-custom-css" value="'.$custom_css.'">
			<input type="hidden" id="ntk-checkout-environment" value="production">
		';
		return $out;
    }
    

    public static function print_venue($venue) { ?>
        <div class="">
            <div class="location dashicons-before dashicons-location has-icons">
                <?= esc_html($venue->name) ?>, <?= esc_html($venue->place) ?>

                <?php if( $venue->address->streetName != "") { ?>
                    <div class="secondary-info location__address"><?= esc_html($venue->address->streetName) ?></div>
                <?php } ?>
                
            </div>
        </div>
        <?php
    }

    public static function get_image_first($event, $desired_image_size) {
        if(count($event->images)>0) {
            // Main image
            for($i = 0; $i < count($event->images); $i++) {
                if($event->images[$i]->principal) {
                    return $event->images[$i]->sizes->$desired_image_size;
                }
            }
            return $event->images[0]->sizes->$desired_image_size;
        }
        
    }
    public static function print_description($descriptions) {

        /*
        $MAX_WORDS = 100;
        $words = array();
        $shown_array = explode(" ", );
        $hidden_string = "";

        if(count($shown_array) >= $MAX_WORDS){
            $hidden_array = array_slice($shown_array, $MAX_WORDS);
            $shown_array = array_slice($shown_array, 0, $MAX_WORDS);
            //$shown_array[101] = "<span class=\"read_more--text\">... <a href='#' class=\"read_more--action\">Leer más</a><span>";
            $hidden_string = "<div class=\"extra_text hidden\">".implode(" ", $hidden_array)."</div>";
        }
        
        $shown_string = implode(" ", $shown_array);
        
        echo wp_kses($shown_string.$hidden_string, NotikumiRenderHelper::allowedTags());
        */
        $locale = NotikumiRenderHelper::get_locale();
        $default_lang = NotikumiRenderHelper::$DEFAULT_LANG;
        $description = '';
        if(!empty($descriptions->$locale)) {
            $description = $descriptions->$locale;
        }
        else if(!empty($descriptions->es)) {
            $description = $descriptions->es;
        }
        else if(!empty($descriptions->$default_lang)) {
            $description = $description->$default_lang;
        }


        echo wp_kses($descriptions->$locale, NotikumiRenderHelper::allowedTags());
    }

    public static function print_cancel_box($event) {
        if($event->sessions[0]->status == 5) {
        ?>
            <div class="alert alert-danger cancel-box">
                <h4><?=__('Evento cancelado','notikumi-ticketing')?></h4>
            </div>
        <?php        
        }
    }

    private static function allowedTags() {
        return array(
            'a' => array(
                'href' => array(),
                'title' => array(),
                'class' => array()
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'p' => array(),
            'span' => array(
                'class' => array()
            ),
            'div' => array(),
        );
    }

    public static function hasSale($sessions) {
        //var_dump($sessions);
        for($i = 0; $i<count($sessions); $i++) {
            if($sessions[$i]->sales) {
                return true;
            }
        }
        return false;
    }

    public static function print_from($sessions) {
        //var_dump($sessions);
        $min;
        for($i = 0; $i<count($sessions); $i++) {
            if($sessions[$i]->sales) {
            }
        }
        return "";
    }

    public static function get_locale() {
        $locale = get_locale();
        $locale = str_replace('_', '-', $locale);

        $locale_array = explode("-", $locale);

        $locale_country = (count($locale_array) > 1) ? $locale_array[0] : $locale;

        if(in_array($locale_country, NotikumiRenderHelper::$ALLOWED_LANGS)) {
            return $locale_country;
        }
        else {
            return NotikumiRenderHelper::$DEFAULT_LANG;
        }
    }

}
?>