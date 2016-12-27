<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

  <footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
      <span class="pull-right hidden-xs">
      <?php $this->options->BottomInfo(); ?>
      Power by <a data-no-instant target="blank" href="http://www.typecho.org">Typecho</a> | Theme <a data-no-instant target="blank" href="https://github.com/ihewro/typecho-theme-handsome/">handsome</a> <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a>
      </span>
      &copy; <?php echo date("Y");?> Copyright.
    </div>
  </footer>
  </div><!--end of .app app-header-fixed-->

<!--CDN加载-->
<script src="//cdn.bootcss.com/jquery/2.1.4/jquery.min.js" data-no-instant></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js" data-no-instant></script>
<script data-no-instant src="//cdn.bootcss.com/instantclick/3.0.1/instantclick.min.js"></script>
<script src="//cdn.bootcss.com/highlight.js/9.5.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script data-no-instant type="text/javascript">
InstantClick.on('change', function(isInitialLoad) {
  if (isInitialLoad === false) {
    //if (typeof MathJax !== 'undefined') // support MathJax
      //MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
    //if (typeof prettyPrint !== 'undefined') // support google code prettify
      //prettyPrint();
    if (typeof _hmt !== 'undefined')  // support 百度统计
      _hmt.push(['_trackPageview', location.pathname + location.search]);
    if (typeof ga !== 'undefined')  // support google analytics
        ga('send', 'pageview', location.pathname + location.search);
    if (typeof DUOSHUO !== 'undefined') //多说
        DUOSHUO.EmbedThread('.ds-thread');
  }
  $('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});
</script>

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

<!--音乐播放器开始。by qqdie 修改自youduBGM插件-->
<bgm>     
<a class="ymusic" onclick="playbtu();" target="_blank">
<i id="ydmc"></i>
</a>
<a class="ymusic" onclick="next();" id="ydnext" target="_blank">
<i class="iconfont icon-next"></i>
</a>
</bgm>
<script data-no-instant>
var yaudio = new Audio();
yaudio.controls = true;
var musicArr=[<?php $this->options->musiclist(); ?>];//后台填写播放列表
/*首次随机播放*/
var a=parseInt(Math.random()*musicArr.length);
var sj=musicArr[a];
yaudio.src=sj.mp3;
yaudio.ti=sj.title;
yaudio.art=sj.artist;
<?php if ( $this->options->isautoplay =='0' ) : ?>
<?php else: ?>
yaudio.play();
<?php endif; ?>
 </script>
<!--音乐播放器结束-->

<!-- 压缩后版本 -->
<script data-no-instant src="<?php $this->options->themeUrl('js/main.min.js') ?>"></script>
<script src="<?php $this->options->themeUrl('js/script.min.js') ?>"></script>

<!--页面布局开关-->
<script type="text/javascript">
<?php if (!empty($this->options->indexsetup) && in_array('header-fix', $this->options->indexsetup)): ?>
$(document).ready(function(){
    $('#alllayout').addClass("app-header-fixed");
    $('#comments a[href^=#][href!=#]').click(function() {
    var target = document.getElementById(this.hash.slice(1));
    if (!target) return;
    var targetOffset = $(target).offset().top - 50;
    $('html,body').animate({
        scrollTop: targetOffset
    },
    300);
    return false;
    });//主要修复评论定位不准确BUG
    if (window.location.hash.indexOf('#')>=0){$('html,body').animate({scrollTop: ($(window.location.hash).offset().top - 80)+"px"}, 300);};//主要修复评论定位不准确BUG
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
<script type="text/javascript">
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
