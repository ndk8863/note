<?php get_header()?>
<div class="container">
<?php if(function_exists('bcn_display')):?>
  <div class="breadcrumbs">
    <?php  bcn_display(); ?>
  </div>
<?php endif;?>
  <div class="feature-list">
   <div class="main clearfix">
    <div class="index-body">
      <?php if ( empty( get_search_query() ) ) :?>
        <p>検索キーワードが未入力です。</p>
      <?php else :?>
      <div class="archive-title">
        <h1>『<?php echo get_search_query(); ?>』での検索結果一覧</h1>
      </div>
      <ol>
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <li class="article clearfix">
          <a href="<?php the_permalink(); ?>">
          <?php if ( has_post_thumbnail()) :
              $image_id = get_post_thumbnail_id();
              $image_url = wp_get_attachment_image_src($image_id, true);
            ?>
            <div class="zoom-post-thumbnail">
             <div style="background-image:url(<?php echo $image_url[0]; ?>)"></div>
            </div>
            <div class="responsive-post-thumbnail">
              <?php the_post_thumbnail() ?>
            </div>
          <?php else: ?>
            <div class="zoom-post-thumbnail">
             <div style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/no_image.jpg)"></div>
            </div>
          <?php endif ?>
            <div class="article-body">
             <?php cat_links();?>
              <a href="<?php the_permalink(); ?>">
                <div class ="date-time"><?php echo get_the_date(); ?></div>
                <h2 class="article-title"><?php the_title(); ?></h2>
              </a>
              <?php the_excerpt(); ?>
          </div>
        </li>
      <?php endwhile; ?>
　　</ol>
      <div class="pager">
      <?php global $wp_rewrite;
      $paginate_base = get_pagenum_link(1);
      if(strpos($paginate_base, '?') || ! $wp_rewrite->using_permalinks()){
        $paginate_format = '';
        $paginate_base = add_query_arg('paged','%#%');
      }
      else{
        $paginate_format = (substr($paginate_base,-1,1) == '/' ? '' : '/') .
        user_trailingslashit('page/%#%/','paged');;
        $paginate_base .= '%_%';
      }
      echo paginate_links(array(
        'base' => $paginate_base,
        'format' => $paginate_format,
        'total' => $wp_query->max_num_pages,
        'mid_size' => 4,
        'current' => ($paged ? $paged : 1),
        'prev_text' => '«',
        'next_text' => '»',
      )); ?>
     </div>
     <?php else : ?>
     <p>検索条件にヒットした記事がありませんでした。</p>
     <?php endif; ?>
	<?php endif; ?>
   </div>
  </div>
<?php get_sidebar();?>
<?php get_footer();?>
