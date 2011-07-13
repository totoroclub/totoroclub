<div id="sidebar-left">
    <ul>
      <?php if ( !function_exists('dynamic_sidebar')
        || !dynamic_sidebar('widget-left') ) : ?>
       <?php endif; ?>
    </ul>
</div> <!-- sidebar-left -->