<div id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-4 col-md-6 col-xs-6 r-full-width' ); ?> >
	<div class="grid-blog">
		<div class="grid-blog-img">
			<?php if ( has_post_thumbnail() && ! post_password_required() ): ?>
                <?php the_post_thumbnail(); ?>
            <?php else: ?>
                <h4>No image found!</h4>
            <?php endif ?>
		</div>
		<div class="product-detail blog-detail">
			<span class="date"><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
			<?php if ( is_single() ) : ?>
                <h5><?php the_title(); ?></h5>
            <?php else: ?>    
                <h5><a href="<?php echo the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 3	, '...' ); ?></a></h5>
            <?php endif ?>
		
			<?php if ( is_search() ) : ?>
                <p><?php the_excerpt(); ?></p>
            <?php else: ?>
                <p><?php echo wp_trim_words( get_the_excerpt(), 10	, '...' ); ?></p>
            <?php endif ?>
		
			<div class="aurthor-detail">
				<span>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), $size = 34, ''); ?>
					<?php the_author(); ?></span>
				<a class="add-wish" href="#"><i class="fa fa-share-alt"></i></a>
			</div>
		</div>
	</div>
</div>