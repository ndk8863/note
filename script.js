jQuery(function(){
   jQuery('.scroll-btn').hide();
　　

  //header//
  // 固定する場所が存在することの確認
  if( jQuery('.fixing-base .fixing-box').length > 0 ){
    var base_selector = '.fixing-base'
    var fixing_selector = base_selector + ' .fixing-box'

    jQuery(window).on('load scroll resize', function(){
      var base_top = jQuery(base_selector).offset().top
      if( jQuery(window).scrollTop() > base_top ){
        jQuery(fixing_selector).addClass('fixed');
        jQuery(base_selector).height(jQuery(fixing_selector).outerHeight());
        jQuery(fixing_selector).width(jQuery(base_selector).width());
      } else {
        jQuery(fixing_selector).removeClass('fixed');
        jQuery(base_selector).height('');
        jQuery(fixing_selector).width('');
      }
    })
  }

  jQuery(document).ready(function() {
    var hsize = jQuery(window).height();
    jQuery("#responsive-menu").css("height", hsize + "px");
  });
  jQuery(window).resize(function() {
    var hsize = jQuery(window).height();
    jQuery("#responsive-menu").css("height", hsize + "px");
  });


  jQuery('.menu-nav').find('.menu-item-has-children').hover(
    function(){
      jQuery(this).children('ul').fadeIn('fast');
  },
    function(){
      jQuery(this).children('ul').fadeOut('fast');
  });

	jQuery('.menu-nav').find('.page_item_has_children').hover(
    function(){
      jQuery(this).children('ul').fadeIn('fast');
  },
    function(){
      jQuery(this).children('ul').fadeOut('fast');
  });


  jQuery('#menu-icon').click(function(){
    var $menu = jQuery('#responsive-menu');
    if($menu.hasClass('open')){
      $menu.fadeOut();
      $menu.removeClass('open');
      jQuery(this).removeClass('act');
    }else{
      $menu.fadeIn();
      $menu.addClass('open');
      jQuery(this).addClass('act');
    }
  });

  if(jQuery('.mobile-nav').find('.menu-item').hasClass('menu-item-has-children')){
    jQuery('.mobile-nav').find('.menu-item-has-children').before('<span class="fas fa-angle-down fa-lg child-menu-button"></span>');
  }

	if(jQuery('.mobile-nav').find('.page_item').hasClass('page_item_has_children')){
    jQuery('.mobile-nav').find('.page_item_has_children').before('<span class="fas fa-angle-down fa-lg child-menu-button"></span>');
  }

  var $mobile_child = jQuery('.mobile-nav').children('.menu-item-has-children');
    $mobile_child.children('a').hover(
    function(){
      jQuery(this).closest('.menu-item-has-children').prev('.child-menu-button').css({color:"#fff"});
    },
    function(){
      jQuery(this).closest('.menu-item-has-children').prev('.child-menu-button').css({color:"#888888"});
    });
    $mobile_child.children('ul').find('.menu-item-has-children').children('a').hover(
      function(){
        jQuery(this).closest('.menu-item-has-children').prev('.child-menu-button').css({color:"#fff"});
      },
      function(){
        jQuery(this).closest('.menu-item-has-children').prev('.child-menu-button').css({color:"#888888"});
      });

	var $mobile_child = jQuery('.mobile-nav').children('.page_item_has_children');
    $mobile_child.children('a').hover(
    function(){
      jQuery(this).closest('.page_item_has_children').prev('.child-menu-button').css({color:"#fff"});
    },
    function(){
      jQuery(this).closest('.page_item_has_children').prev('.child-menu-button').css({color:"#888888"});
    });
    $mobile_child.children('ul').find('.page_item_has_children').children('a').hover(
      function(){
        jQuery(this).closest('.page_item_has_children').prev('.child-menu-button').css({color:"#fff"});
      },
      function(){
        jQuery(this).closest('.page_item_has_children').prev('.child-menu-button').css({color:"#888888"});
      });



  jQuery('.child-menu-button').click(function(){
    var $menu = jQuery(this).next('.menu-item-has-children').children('ul');
    if($menu.hasClass('open')){
      $menu.slideUp('fast');
      $menu.removeClass('open');
      jQuery(this).removeClass('fa-rotate-180');
    }else{
      $menu.slideDown('fast');
      $menu.addClass('open');
      jQuery(this).addClass('fa-rotate-180');
    }
  });

	jQuery('.child-menu-button').click(function(){
    var $menu = jQuery(this).next('.page_item_has_children').children('ul');
    if($menu.hasClass('open')){
      $menu.slideUp('fast');
      $menu.removeClass('open');
      jQuery(this).removeClass('fa-rotate-180');
    }else{
      $menu.slideDown('fast');
      $menu.addClass('open');
      jQuery(this).addClass('fa-rotate-180');
    }
  });


//footer//
  if(window.matchMedia('(min-width:768px)').matches){
  jQuery('.footer-post').hover(
    function(){
      jQuery(this).find('.footer-post-title').slideDown('fast');
    },
    function(){
      jQuery(this).find('.footer-post-title').slideUp('fast');
    });
  }

  jQuery('.scroll-btn').click(function(){
    jQuery('body,html').animate({ scrollTop: 0 },'swing');
        return false;
  });

  jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 570) {
            jQuery('.scroll-btn').fadeIn();
        } else {
            jQuery('.scroll-btn').fadeOut();
        }
    });
});
