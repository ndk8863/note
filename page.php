<?php get_header()?>
<div class="container">
<?php if(function_exists('bcn_display')):?>
  <div class="breadcrumbs">
    <?php  bcn_display(); ?>
  </div>
<?php endif;?>
   <div class="feature-list">
    <div class="main">
      <div class="single-body clearfix">
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
         <div class="single-content clearfix">
           <h1 class="single-article-title"><?php the_title();?></h1>
           <div class="single-content-txt">
            <?php the_content();?>
           </div>
         </div>
        <?php endwhile; endif; ?>
     </div>
  </div>
<?php get_sidebar();?>
<?php get_footer();?>
