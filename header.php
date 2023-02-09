<!DOCTYPE html>
<html>
<lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
　<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/responsive.css" type="text/css" />
　　<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <title><?php wp_title('|',true,'right');?><?php bloginfo('name');?></title>
  <?php wp_head()?>
</head>
<body id="<?php the_slug(); ?>" <?php body_class();?>>
  <div class="header">
    <div class="fixing-base">
      <div class="global-menu clearfix fixing-box">
        <div class="container">
        <a href="<?php echo home_url()?>"><span class="fas fa-home home-icon"></span></a>
         <?php wp_nav_menu(array(
          'container' => 'nav',
          'menu_class'=> 'menu-nav',
          'container_id' => 'gNav',
          'theme_location' => 'header_nav',
         )
       ); ?>
       <?php get_search_form();?>
    </div>
   </div>
 </div>
</div>
 <div class="responsive-header">
  <a id="menu-icon"  class="menu-trigger" href="#">
    <span></span>
    <span></span>
    <span></span>
  </a>
  <a href="<?php echo home_url()?>"><span class="fas fa-home home-icon fa-lg"></span></a>
   <div id="responsive-menu">
     <?php wp_nav_menu(array(
      'container' => 'nav',
      'menu_class'=> 'mobile-nav',
      'container_id' => 'gNav',
      'theme_location' => 'header_nav',
     )
   ); ?>
   </div>
 </div>
 <?php if(is_home()):?>
   <div class="header-blog-title">
      <h1 id="blog-title"><a href="<?php echo home_url()?>"><?php bloginfo('name');?></a></h1>
      <p><?php bloginfo('description'); ?></p>
   </div>
 <?php else: ?>
 <div class="header-blog-title">
   <div class="container">
     <p id="blog-title"><a href="<?php echo home_url()?>"><?php bloginfo('name');?></a></p>
     <p><?php bloginfo('description'); ?></p>
   </div>
 </div>
 <?php endif; ?>
