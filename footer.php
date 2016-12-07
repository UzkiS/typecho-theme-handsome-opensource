<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

  <footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
  <!--网站统计代码-->
<script data-no-instant type="text/javascript">
  <?php $this->options->analysis(); ?>
</script>
      <span class="pull-right hidden-xs">Power by <a data-no-instant target="blank" href="http://www.typecho.org">Typecho</a> | Theme <a data-no-instant target="blank" href="http://www.ihewro.com">handsome</a> <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a>
      </span>
      &copy; <?php echo date("Y");?> Copyright.
    </div>


  </footer>
  </div><!--end of .app app-header-fixed-->

<!--CDN加载-->
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" data-no-instant></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js" data-no-instant></script>
<script data-no-instant src="http://apps.bdimg.com/libs/instantclick/3.0.1/instantclick.min.js"></script>

<script data-no-instant>
<?php if ( $this->options->preload =='0' ) : ?>
InstantClick.init('mouseover');
<?php elseif ( $this->options->preload =='1' ) : ?>
InstantClick.init('mousedown');
<?php elseif ( $this->options->preload =='2' ) : ?>
InstantClick.init('<?php $this->options->delaytime(); ?>');
<?php endif; ?>
</script>
<!--develope本地版本-->
<!--<script data-no-instant src="<?php $this->options->themeUrl('js/develope/ui-nav.js') ?>"></script>
<script data-no-instant src="<?php $this->options->themeUrl('js/develope/ui-toggle.js') ?>"></script>
<script data-no-instant src="<?php $this->options->themeUrl('js/develope/ui-client.js') ?>"></script>
<script src="<?php $this->options->themeUrl('js/develope/script.js') ?>"></script>-->

<!--压缩后版本-->
<script data-no-instant src="<?php $this->options->themeUrl('js/main.min.js') ?>"></script>
<script src="<?php $this->options->themeUrl('js/script.min.js') ?>"></script>

<!--页面布局开关-->
<script type="text/javascript">
<?php if (!empty($this->options->indexsetup) && in_array('header-fix', $this->options->indexsetup)): ?>
$(document).ready(function(){
    $('#alllayout').addClass("app-header-fixed");
});
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('aside-fix', $this->options->indexsetup)): ?>
$(document).ready(function(){
    $('#alllayout').addClass("app-aside-fixed");
});
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('aside-folded', $this->options->indexsetup)): ?>
$(document).ready(function(){
    $('#alllayout').addClass("app-aside-folded");
});
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('aside-dock', $this->options->indexsetup)): ?>
$(document).ready(function(){
    $('#alllayout').addClass("app-aside-dock");
});
<?php endif; ?>
<?php if (!empty($this->options->indexsetup) && in_array('container-box', $this->options->indexsetup)): ?>
$(document).ready(function(){
	$('html').addClass("bg");
    $('#alllayout').addClass("container");
});
<?php endif; ?>
</script>

<?php if( !empty($this->options->indexsetup) && in_array('atargetblank',$this->options->indexsetup) ): ?>
<script data-no-instant type="text/javascript">
    //Add target="_blank" to a tags
    $(document).bind('DOMNodeInserted', function(event) {
        $('.comment-author a,#postpage a[href^="http"]').each(
            function() {
                if (!$(this).attr('target')) {
                    $(this).attr('target', '_blank')
                }
            }
        );
    });
</script>
<?php endif; ?>
<?php $this->footer(); ?>

</body><!--#body end-->
</html><!--html end-->
