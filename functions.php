<?php


register_sidebar();
register_sidebar(array('name' => 'フッター１'));
register_sidebar(array('name' => 'フッター２'));
register_sidebar(array('name' => 'フッター３'));

add_theme_support('post-thumbnails');

function the_slug(){
  $slug = '';
  if(is_category()){
    $category = get_the_category();
    $slug = $category[0]->category->nicename;
  }else{
    $id = get_the_ID;
    $page = get_post($id);
    $slug = $page->post_name;
  }
  echo $slug;
}

$param = array(
  'header_nav'=>'ヘッダーナビゲーション(ブログの上)',
  'sidebar_nav'=>'サイドバーナビゲーション（ブログの横）',
  'footer_nav'=>'フッターナビゲーション（ブログの下）'
);
register_nav_menus($param);


//自作の関数//

function index_ver1(){
  ?>
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
      <?php endwhile; endif; ?>
　　</ol>
<?php
}

function snsbtn()
{ ?>
  <ul class="shere-sns">
    <li><a href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" rel="nofollow" target="_blank"><span class="fab fa-facebook-f  shere-btn background-facebook"> Facebook</span></a></li>
    <li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo get_the_title(); ?>"
           rel="nofollow"
           target="_blank"
      ><span class="fab fa-twitter  shere-btn background-twitter"> Twitter</span></a></li>
    <!--<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><span class="fab fa-google fa-lg shere-btn shere-btn background-google">&nbsp;Google+</span></a></li>-->
    <li><a href="http://getpocket.com/edit?url=<?php the_permalink(); ?>&<?php echo get_the_title(); ?>" rel="nofollow" target="_blank"><span class="fab fa-get-pocket shere-btn background-pocket"> Pocket</span></a></li>
  </ul>
<?php }

function cat_rand(){
  $cat = get_the_category();
  $cat_length = count($cat);
  $rand = rand(0,$cat_length-1);
  $cat_rand = $cat[$rand];
  return $cat_rand;
}

function cat_color(){
  $cat_color = cat_rand();
  $id = $cat_color->cat_ID;
  return $id%10;
}

function cat_name(){
  $cat_name = cat_rand();
  return $cat_name->cat_name;
}

function cat_nicename(){
  $cat_nicename = cat_rand();
  return $cat_nicename->category_nicename;
}

function cat_color_number($cat_id){
  $id = $cat_id;
  return $id%10;
}

function cat_link(){
  $cat = cat_rand();
  $id = $cat->cat_ID;
  $name = $cat->cat_name;
  $color_number = cat_color_number($id);
  $url = get_category_link($id);
  ?>
  <a href="<?php echo $url; ?>"><span class="category-name category-color-<?php echo $color_number; ?>"><?php echo $name; ?></span></a>
  <?php }

  function cat_links(){
    $cats = get_the_category();
    foreach($cats as $cat){
    $id = $cat->cat_ID;
    $name = $cat->cat_name;
    $color_number = cat_color_number($id);
    $url = get_category_link($id);
    ?>
    <a href="<?php echo $url; ?>"><span class="category-name category-color-<?php echo $color_number; ?>"><?php echo $name; ?></span></a>
    <?php }
 }

 function custom_editor_settings( $initArray ){
     $initArray['block_formats'] = "見出し1=h2; 見出し2=h3; 見出し3=h4;";
     return $initArray;
 }
 add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );


 class Plofile_Widget extends WP_Widget{

   function __construct(){
     parent::__construct(
     'plofile_widget',
     'profile',
     array( 'description' => 'プロフィールを設定します', )
   );
   }

   public function widget( $args, $instance) {
        $title = $instance['title'];
        $name = $instance['name'];
        $img_url = $instance['img_url'];
        $text = $instance['text'];
        $profile_url = $instance['profile_url'];
        $twitter = $instance['twitter'];
        $facebook = $instance['facebook'];
        $instagram = $instance['instagram'];

        echo $args['before_widget'];
        ?>
          <h2 class="widgettitle"><?php echo ${title};?></h2>
          <div class="profile-content">
            <?php if ($img_url): ?>
              <?php if($profile_url):?>
                <a href = "<?php echo ${profile_url} ?>"><img class="profile-img white-img" src="<?php echo ${img_url}?>" alt="profile"></a>
              <?php else: ?>
                <img class="profile-img" src="<?php echo ${img_url}?>" alt="profile">
              <?php endif ?>
            <?php endif ?>
            <?php if($name):?>
              <?php if($profile_url):?>
                <a class="user-name" href = "<?php echo ${profile_url} ?>"><?php echo ${name}?></a>
              <?php else: ?>
                <p class="user-name"><?php echo ${name}?></p>
              <?php endif ?>
            <?php endif ?>
            <?php if($text):?>
              <p class="profile-txt"><?php echo ${text} ?></p>
            <?php endif ?>
            <ul class="profile-sns">
              <?php if($facebook):?>
                <li><a href="<?php echo ${facebook} ?>" target="_blank"><span class="fab fa-facebook-f sns-btn fa-lg color-facebook"></span></a></li>
              <?php endif ?>
              <?php if($instagram):?>
                <li><a href="<?php echo ${instagram} ?>" target="_blank"><span class="fab fa-instagram sns-btn fa-lg color-instagram"></span></a></li>
              <?php endif ?>
              <?php if($twitter):?>
                <li><a href="<?php echo ${twitter} ?>" target="_blank"><span class="fab fa-twitter sns-btn fa-lg color-twitter"></span></a></li>
              <?php endif ?>
            </ul>
         </div>
        <?php
        echo $args['after_widget'];
	}


  public function form( $instance ){
       $title = $instance['title'];
       $title_name = $this->get_field_name('title');
       $title_id = $this->get_field_id('title');
       $img_url = $instance['img_url'];
       $img_url_name = $this->get_field_name('img_url');
       $img_url_id = $this->get_field_id('img_url');
       $name = $instance['name'];
       $name_name = $this->get_field_name('name');
       $name_id = $this->get_field_id('name');
       $text = $instance['text'];
       $text_name = $this->get_field_name('text');
       $text_id = $this->get_field_id('text');
       $profile_url = $instance['profile_url'];
       $profile_url_name = $this->get_field_name('profile_url');
       $profile_url_id = $this->get_field_id('profile_url');
       $twitter = $instance['twitter'];
       $twitter_name = $this->get_field_name('twitter');
       $twitter_id = $this->get_field_id('twitter');
       $facebook = $instance['facebook'];
       $facebook_name = $this->get_field_name('facebook');
       $facebook_id = $this->get_field_id('facebook');
       $instagram = $instance['instagram'];
       $instagram_name = $this->get_field_name('instagram');
       $instagram_id = $this->get_field_id('instagram');
       ?>
       <p>
          <label for="<?php echo $title_id; ?>">タイトル:</label>
          <input class="widefat" id="<?php echo $title_id; ?>" name="<?php echo $title_name; ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
       </p>
       <p>
          <label for="<?php echo $img_url_id; ?>">画像(url):</label>
          <input class="widefat" id="<?php echo $img_url_id; ?>" name="<?php echo $img_url_name; ?>" type="text" value="<?php echo esc_attr( $img_url ); ?>">
       </p>
       <p>
          <label for="<?php echo $name_id; ?>">名前:</label>
          <input class="widefat" id="<?php echo $name_id; ?>" name="<?php echo $name_name; ?>" type="text" value="<?php echo esc_attr( $name ); ?>">
       </p>
       <p>
          <label for="<?php echo $text_id; ?>">プロフィール:</label>
          <input class="widefat" id="<?php echo $text_id; ?>" name="<?php echo $text_name; ?>" type="text" value="<?php echo esc_attr( $text ); ?>">
       </p>
       <p>
          <label for="<?php echo $profile_url_id; ?>">プロフィールへのリンク(url)</label>
          <input class="widefat" id="<?php echo $profile_url_id; ?>" name="<?php echo $profile_url_name; ?>" type="text" value="<?php echo esc_attr( $profile_url ); ?>">
       </p>
       <p>
          <label for="<?php echo $facebook_id; ?>">facebook(url):</label>
          <input class="widefat" id="<?php echo $facebook_id; ?>" name="<?php echo $facebook_name; ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>">
       </p>
       <p>
          <label for="<?php echo $instagram_id; ?>">instagram(url):</label>
          <input class="widefat" id="<?php echo $instagram_id; ?>" name="<?php echo $instagram_name; ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>">
       </p>
       <p>
          <label for="<?php echo $twitter_id; ?>">twitter(url):</label>
          <input class="widefat" id="<?php echo $twitter_id; ?>" name="<?php echo $twitter_name; ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>">
       </p>
       <?php
   }


    function update($new_instance, $old_instance) {
      return $new_instance;
    }
}


//画像付き最近の投稿//
class My_Widget_Recent_Posts extends WP_Widget_Recent_Posts{
  function __construct(){
    parent::__construct(
    'Recent_Posts',
    '最近の投稿(画像付き)',
    array( 'description' => '最近の投稿を表示します', )
  );
  }
  function widget($args, $instance) {
        extract( $args );
        $title = apply_filters(
          'widget_title',
          empty($instance['title']) ? __('Recent Posts') : $instance['title'],
          $instance,
          $this->id_base);
        if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
            $number = 10;
        $posts = new WP_Query( apply_filters(
          'widget_posts_args',
          array( 'posts_per_page' => $number,
          'no_found_rows' => true,
          'post_status' => 'publish',
          'ignore_sticky_posts' => true ) ) );
        if( $posts->have_posts() ) :
          echo $args['before_widget'];?>
          <h2 class="widgettitle"><?php echo ${title};?></h2>
            <ul class="clearfix">
                <?php while( $posts->have_posts() ) : $posts->the_post(); ?>
                <li class="clearfix">
                  <?php if (has_post_thumbnail()) :
                    $image_id = get_post_thumbnail_id();
                    $image_url = wp_get_attachment_image_src($image_id,true);
                  ?>
                  <div class="recent-article-img">
                    <span style="background-image:url(<?php echo $image_url[0]; ?>)"></span>
                  </div>
                  <?php else: ?>
                  <div class="recent-article-img">
                    <span style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/no_image.jpg)"></span>
                  </div>
                  <?php endif; ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <div class="date-time"><?php the_time('Y.m.d'); ?></div>
                    <?php the_title(); ?>
                  </a>
                </li>
                <?php endwhile; ?>
            </ul>

            <?php
            echo $args['after_widget'];
        wp_reset_postdata();
        endif;
    }
}

function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Widget_Recent_Posts');
}
add_action('widgets_init', 'my_recent_widget_registration');

function my_scripts() {
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'javascript',get_stylesheet_directory_uri().'/script.js',array('jquery'));
}
add_action('wp_enqueue_scripts','my_scripts');

add_action( 'widgets_init', function () {
	register_widget( 'Plofile_Widget' );
} );

//filter//
add_filter('wp_list_categories','my_list_categories',5,2);
function my_list_categories($output,$args){
  $output = preg_replace('/<\/a>\s*\((\d+)\)/','</a><span class="count">($1)</span>',$output);
  return $output;
}
add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
  $output = preg_replace('/<\/a>\s*( )\((\d+)\)/',' ($2)</a>',$output);
  return $output;
}

//自動アップデート//
add_filter('allow_major_auto_core_updates', '__return_true');
add_filter('auto_update_plugin', '__return_true');

//セキュリティ//
add_filter('the_generator', '__return_empty_string');
remove_action('wp_head', 'wp_generator');

function remove_wp_version_str($src) {
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if (!empty($query['ver']) && $query['ver'] === $wp_version) {
    $src = remove_query_arg('ver', $src);
  }
  return $src;
}

add_filter('script_loader_src', 'remove_wp_version_str');
add_filter('style_loader_src', 'remove_wp_version_str');
?>
