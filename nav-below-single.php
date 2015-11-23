<div class="posts-link">
	<?php
        $prev_post = get_previous_post();
        if (!empty( $prev_post )):
    ?>
    <div class="prev-post">
        <p>Read previous post </p>
        <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
            <?php echo $prev_post->post_title; ?>
        </a>
    </div>
    <?php endif; ?>
    <?php
        $next_post = get_next_post();
        if (!empty( $next_post )):
    ?>
    <div class="next-post">
        <p>Read next post </p>
        <a href="<?php echo get_permalink( $next_post->ID ); ?>">
            <?php echo $next_post->post_title; ?>
        </a>
    </div>
    <?php endif; ?>

</div>