<?php get_header(); ?>

<div id="content">
<div id="entry_content">
<?php 
$catId = get_query_var('cat');?>
<?php if($catId) : //如果有选取分类 ?>
<?php $cat = get_category($catId); ?>
	<div id="sub_nav"> 
	<ul>
		<?php if($cat->category_parent): //如果有父级分类  ?>
			<?php wp_list_categories('orderby=order&title_li=&show_option_none=&depth=1&hide_empty=0&child_of='.$cat->category_parent);?>
		<?php else :?>
			<?php 
			 wp_list_categories('orderby=order&title_li=&show_option_none=&depth=1&hide_empty=0&child_of='.$cat->cat_ID );?>
		<?php endif ?>
		<div class="clear"></div>
	</ul>
	</div>
<?php endif ?>
  <?php if (have_posts()) : 
  if(is_home()){ //相关作品全览分类 不在主页显示其中文章
  query_posts($query_string .'&cat=-6');}  ?>
  <?php while (have_posts()) : the_post(); ?>
    <?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?> <div <?php post_class(); ?>> <?php }} ?>
      <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      <p class="date"><?php the_time('Y-m-d') ?>  <?php //comments_popup_link('<span class="commentcount">漂亮</span>', '<span class="commentcount">沙发被抢！</span>', '<span class="commentcount"> 已经有 % 人排排坐了!</span>'); ?> </p>
      
      <?php if(is_search()) : ?>
        <div class="entry search-results">
          <?php the_excerpt(); ?>
        </div>
      <?php else : ?>
        <div class="entry">
          <?php { if ( function_exists('add_theme_support')) the_post_thumbnail( 'post-thumbnail' ); } ?>
          <?php the_content('继续阅读 &raquo; '); ?>
        </div>
        <?php if(is_home()) { if ( function_exists('wp_list_comments') ) { ?></div><!-- close post_class --><?php }} ?>
      <?php endif; ?>
  <?php endwhile; ?>

<?php /*?>  <div class="navigation">
    <p class="alignleft"><?php next_posts_link('&laquo; 以前的文章') ?></p>
    <p class="alignright"><?php previous_posts_link('新的文章 &raquo;') ?></p>
  </div><?php */?>
  
    <?php if(function_exists(‘wp_pagenavi’)) {
    wp_pagenavi();
  } else { ?> 
  <!--<div class="navigation">
    <p class="alignleft"><?php next_posts_link('&laquo; 以前的文章') ?></p>
    <p class="alignright"><?php previous_posts_link('新的文章 &raquo;') ?></p>
  </div>-->
  <?php if(function_exists(‘wp_pagenavi’)) { wp_pagenavi(); } ?> 
  <?php wp_pagenavi(); ?>
  <!--分页-->
  
  <?php } ?>

  
  <?php else : ?>
  
  <div class="entry">
    <span class="error"><img src="<?php bloginfo('template_directory'); ?>/images/mal.png" alt="error duck" /></span> 
    <p>额~貌似您要找的东西不在这儿哦！看点别的啥吧？</p>
  </div>

  <?php endif; ?>
  
   

  
</div> <!-- close entry_content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>