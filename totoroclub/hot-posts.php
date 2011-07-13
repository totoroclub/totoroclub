<?php
/*
 * Plugin Name:  hot-posts
 * Version: 0.1
 * Plugin URI:  none
 * Description: 这是一个显示热门文章的小工具(widget),需要安装WP-PostViews Plus插件。
 * Author: filod
 * Author URI: http://www.filod.net/
 */
 
/**
 * HotPostsWidget Class
 */
class HotPostsWidget extends WP_Widget {
	/*构造函数*/
    function HotPostsWidget() {
		 $widget_ops = array('classname'=>'widget_hot_posts','description'=>'显示博客中的热门文章');
		 $control_ops = array('width'=>250,'height'=>300);
		 parent::WP_Widget(false,$name ='热门文章(可配置)');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		$title = apply_filters('widget_title',empty($instance['title']) ? '&nbsp;' : $instance['title']);
		$showPosts = empty($instance['showPosts']) ? 10 : $instance['showPosts'];
		$showDays = empty($instance['showDays']) ? 30 : $instance['showDays'];
        ?>
              <?php echo $before_widget; ?>
                  <?php echo $before_title
                      . $title 
                      . $after_title; ?>
                 <?php 
				 /* 主要显示内容
					‘post’ ：显示文章的浏览次数，而不是页面,默认如此
					10 ：最多显示10篇文章；
					30 ：显示30天以内的文章统计；
					true ：显示文章，若改为 false 则不显示文章；
					false ：不显示搜索引擎机器人的查询次数，若改为 true 则全部显示。*/
					if(function_exists('get_timespan_most_viewed')){
						echo '<ul class="hot-posts">';
						get_timespan_most_viewed('post', $showPosts, 0, true, false,$showDays);
						echo '</ul>';
					}else{
						echo '<span style="color:Red;background:Yellow">您需要安装WP-PostViews Plus插件以启用此小工具!</span>';
					}
				 ?>
				
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {		
		$instance = wp_parse_args((array)$instance,array('title'=>'热门','showPosts'=>10,'showDays'=>30));
        $title = esc_attr($instance['title']);
		$showPosts = esc_attr($instance['showPosts']);
		$showDays = esc_attr($instance['showDays']);
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('title').'">标题:<input style="width:200px;" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('showPosts').'">最多显示文章数量:<input style="width:200px;" id="'.$this->get_field_id('showPosts').'" name="'.$this->get_field_name('showPosts').'" type="text" value="'.$showPosts.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="'.$this->get_field_name('showDays').'">显示多少天以来的热门:<input style="width:200px;" id="'.$this->get_field_id('showDays').'" name="'.$this->get_field_name('showDays').'" type="text" value="'.$showDays.'" /></label></p>';
    }
} // class HotPostsWidget 

add_action('widgets_init', create_function('', 'return register_widget("HotPostsWidget");'));
?>