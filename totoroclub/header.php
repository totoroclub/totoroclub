<!DOCTYPE html>
<html<?php language_attributes(); ?>>
<!--  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"  xmlns="http://www.w3.org/1999/xhtml"  -->
<head>
  <head profile="http://gmpg.org/xfn/11">
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
  <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php bloginfo('url'); ?>/xmlrpc.php?rsd" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <script src="http://ajax.microsoft.com/ajax/jQuery/jquery-1.5.2.min.js" type="text/javascript"></script>
  <script src="http://cdn.jquerytools.org/1.2.5/full/jquery.tools.min.js"></script> 
  
  <!--[if IE]>
    <link href="<?php bloginfo('template_directory'); ?>/ie.css" type="text/css" rel="stylesheet" media="screen" />
  <![endif]-->
  
  <!--[if IE 7]>
    <link href="<?php bloginfo('template_directory'); ?>/ie7.css" type="text/css" rel="stylesheet" media="screen" />
  <![endif]-->
  
  <!--[if lte IE 6]>
    <link href="<?php bloginfo('template_directory'); ?>/ie6.css" type="text/css" rel="stylesheet" media="screen" />
  <![endif]-->

  <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
  <?php wp_head(); ?>
<script type="text/javascript">
	$(function(){
		//去掉最后一个entry的分割背景
		$('#entry_content .entry:last').css('backgroundImage','none');
		//加上搜索提示
		$('#searchform .search').css('color','#999').val('请输入搜索内容').focus(function(){
			this.value = this.value ==='请输入搜索内容' ? '' : this.value;
			this.style.color = '#000';
		}).blur(function(){
			this.value = this.value ==='' ? '请输入搜索内容' : this.value;
			this.style.color = '#aaa';
		});
		//加上年表提示
		$(".years").tooltip({ 
			position: 'center left',
			offset: [12, 28],
			effect: 'slide',
			delay: 0
		});
		//无相关文章时不显示
		if($('.related_post').text() ===''){
			$('.related_post,.related_post_title').remove();
		}
		$('p.tags span').text('关键词:');
		//去掉Comments are closed 
		$('.nocomments').text('');
	})
</script>
</head>

<body <?php body_class(); ?>> 
<!--[if lte IE 7]>
<div id="ie6-warning">您正在使用 Internet Explorer 7或者7以下版本的浏览器，要获得最好的浏览体验,强烈建议您升级到
 	<a href="http://www.google.com/chrome/?hl=zh-CN">Chrome（谷歌浏览器）</a>，或选择以下浏览器：
    <a href="http://www.microsoft.com/china/windows/internet-explorer/" target="_blank">Internet Explorer 9</a> / 
    <a href="http://www.mozillaonline.com/">Firefox（火狐浏览器）</a> /
    <a href="http://www.apple.com.cn/safari/">Safari</a> / <a href="http://www.operachina.com/">Opera</a>
    <a href="javascript:void(0)" onclick="close_tip()" style="color:red;position:absolute;right:5px" >不用管我，我就要用 IE ！</a>
</div>
<style type="text/css">
    #ie6-warning {
        background: rgb(255, 255, 225) url("http://ued.taobao.com/images/warning.gif") no-repeat scroll 3px center;
        position: absolute;
        top: 0;
        left: 0;
        font-size: 12px;
        color: #333;
        width: 97%;
        padding: 2px 15px 2px 23px;
        text-align: left;
        display:none;
    }
    #ie6-warning a {
        text-decoration: none;
    }
</style>
 <script type="text/javascript">
 function getCookie(c_name)
{
if (document.cookie.length>0)
  {
  c_start=document.cookie.indexOf(c_name + "=")
  if (c_start!=-1)
    { 
    c_start=c_start + c_name.length+1 
    c_end=document.cookie.indexOf(";",c_start)
    if (c_end==-1) c_end=document.cookie.length
    return unescape(document.cookie.substring(c_start,c_end))
    } 
  }
  return ""
}
 $(function(){
 	var ieTip = getCookie("ieTip");
 	if(ieTip === 'false'){
 		return;
 	}else if( ieTip === 'ture' || !ieTip ){
		setTimeout(function(){
			$("#ie6-warning").slideDown('slow');
		},500);
 	}else{
			
 	}
        /* 文本折叠 */
jQuery(function($){
/* $('.jqhi-title').css({cursor:"s-resize"});*/
 $('span.jqhi-title').click(function(){
 $(this).next('div').slideToggle('500');return false;
 });
})
});
 </script>
<script type="text/javascript">
	function close_tip(){
		$("#ie6-warning").slideUp('slow');
		document.cookie = "ieTip=false";
	}
    function position_fixed(el, eltop, elleft) {
        // check if this is IE6
        if (!window.XMLHttpRequest)
            window.onscroll = function() {
                el.style.top = (document.documentElement.scrollTop + eltop) + "px";
                el.style.left = (document.documentElement.scrollLeft + elleft) + "px";
            };
        else el.style.position = "fixed";
    }
    position_fixed(document.getElementById("ie6-warning"), 0, 0);
</script>
<![endif]-->
<div id="header">
		
</div>
<div id="wrapper">
<div id="left-area">
	<div id="main_nav">
	    <!-- <span class="header_image"></span> -->
	  <?php if ( has_nav_menu( 'main-menu' )) : ?>
	    <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => '' )); ?>
	  <?php else: ?>
	    <ul class="menu">
	      <li class="cat-item"><a href="<?php bloginfo('url'); ?>">首页</a></li>
	      <?php if(is_user_logged_in()): ?>
	      <?php wp_list_categories('orderby=order&title_li=&depth=1&hide_empty=0&exclude=1'); ?>
	      <?php else : ?>
	      <?php wp_list_categories('orderby=order&title_li=&depth=1&hide_empty=0&exclude=1,8,9'); ?>
	      <?php endif ?>
	      <li class=""><a href="http://www.totoroclub.net/forum" target="_blank" >论坛入口</a></li>
	    </ul>
	  <?php endif; ?>
	</div>
    <?php get_sidebar('left'); ?>
</div>
