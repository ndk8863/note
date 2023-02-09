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
          <?php the_post_thumbnail() ?>
       <div class="single-content clearfix">
        <?php cat_links(); ?>
         <p class ="single-date-time"><?php echo get_the_date(); ?></p>
         <h1 class="single-article-title"><?php the_title();?></h1>
         <div class="single-content-txt">
          <?php the_content();?>
         </div>
        <?php snsbtn() ?>
         <div class="single-category-tag-cloud">
           <span class="fas fa-folder"></span>&nbsp;カテゴリー&nbsp;&nbsp;<?php the_category('/'); ?></br>
           <span class="fas fa-tag"></span>&nbsp;タグ&nbsp;&nbsp;<?php single_tag_title('/'); ?></br>
         </div>
        </div>
      <div class="prev-next-area prev">
       <?php previous_post_link('%link','prev</br>%title'); ?>
      </div>
      <div class="prev-next-area next">
       <?php next_post_link('%link','next</br>%title</i>'); ?>
      </div>
    <?php endwhile; endif; ?>
   </div>
  </div>
  <?php get_sidebar();?>
  <?php get_footer();?>
