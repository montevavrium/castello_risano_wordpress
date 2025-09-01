<?php

// enqueue parent stylesheet
add_action( 'wp_enqueue_scripts', 'booklium_child_wp_enqueue_scripts' );
function booklium_child_wp_enqueue_scripts() {

	$parent_theme = wp_get_theme( get_template() );
	$child_theme = wp_get_theme();

	// Enqueue the parent stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_theme['Version'] );
	wp_enqueue_style( 'booklium-style', get_stylesheet_uri(), array('parent-style'), $child_theme['Version'] );

	// Enqueue the parent rtl stylesheet
	if ( is_rtl() ) {
		wp_enqueue_style( 'parent-style-rtl', get_template_directory_uri() . '/rtl.css', array(), $parent_theme['Version'] );
	}
	
	wp_enqueue_style( 'custom-child', get_stylesheet_directory_uri() . '/custom.css', array(), time() );
}





function my_custom_shortcode($atts, $content = null) {
	
	$atts = shortcode_atts(
        array(
            'posts' => 4,        // сколько постов выводить по умолчанию
            'category' => '',    // категория по умолчанию (пусто = все)
        ),
        $atts,
        'events'
    );

    // Начало верстки
    $out = '
    <!-- Блок Retreat -->
    <section class="retreat-section">
      <div class="retreat-wrapper">
        <!-- Заголовок -->
        <div class="retreat-title text-center">
          <h2>Castello Risano - Soul Retreat</h2>
        </div>

        <!-- Описание -->
        <div class="retreat-description text-center">
          <p>A place to reconnect with yourself, nestled on the shores of the Mediterranean Sea.</p>
          <p class="retreat-invitation">Do you want to join a retreat? <a href="#booking" class="retreat-invitation-link">Book here 👉</a></p>
        </div>

        <!-- Фотографии -->
        <div class="retreat-photos">
    ';

    // Запрос записей
    $args = array(
        'post_type' => 'post', // или твой кастомный тип записи, если нужен
        'posts_per_page' => 4, // сколько постов показывать
    'ignore_sticky_posts' => true, // игнорировать закрепленные посты
    'no_found_rows'       => true, // не считать общее количество постов (ускоряет)
    );
	
	if (!empty($atts['category'])) {
        $args['category_name'] = sanitize_text_field($atts['category']);
    }
    $query = new WP_Query($args);

    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            $out .= '<div id="post-' . get_the_ID() . '" class="retreat-photo-item" style="--delay: 0.1s;">';
			$out .= '<div class="retreat-photo-image">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</div>';
			$date = get_post_meta( get_the_ID(), 'event_date', true );
            $out .= '<div class="retreat-photo-content">
                <h3 class="retreat-photo-title">' . get_the_title() . '</h3>
                <div class="retreat-photo-date">'.esc_html($date).'</div>
                <a href="' . get_the_permalink() . '" class="event-button">Book here</a>
            </div>';
            $out .= '</div>';
        endwhile;
    endif;

    // Сбрасываем глобальный пост после кастомного запроса
    wp_reset_postdata();

    // Продолжение верстки
    $out .= '
        </div>

        <!-- Преимущества -->
        <div class="retreat-benefits">
          <h3 class="benefits-title">By booking a retreat with us, you get:</h3>
          <div class="benefits-items">
            <div class="benefits-item" style="--delay: 0.1s;">
              <div class="benefits-icon">
                <i class="fas fa-swimming-pool"></i>
              </div>
              <p class="benefits-text">A beautiful place to stay with a heated pool.</p>
            </div>
            <div class="benefits-item" style="--delay: 0.2s;">
              <div class="benefits-icon">
                <i class="fas fa-heart"></i>
              </div>
              <p class="benefits-text">A program led by a yoga teacher and a psychologist for deep personal growth.</p>
            </div>
            <div class="benefits-item" style="--delay: 0.3s;">
              <div class="benefits-icon">
                <i class="fas fa-map-marked-alt"></i>
              </div>
              <p class="benefits-text">A travel package to explore Montenegro.</p>
            </div>
          </div>
        </div>
      </div>
    </section>';

    return $out;
}

add_shortcode('events', 'my_custom_shortcode');