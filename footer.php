<?php if (!defined('__TYPECHO_ROOT_DIR__'))
    exit; ?>
<footer id="footer" class="app-footer" role="footer">
    <div class="wrapper b-t bg-light">
        <span class="pull-right hidden-xs">
            <?php $this->options->BottomInfo(); ?>
            Power by <a data-no-instant target="blank" href="http://www.typecho.org">Typecho</a> | Theme <a
                data-no-instant target="blank"
                href="https://github.com/LemoFire/typecho-theme-handsome-opensource">handsome-opensource</a> <a
                onclick="gotoTop()" class="m-l-sm text-muted" data-toggle="tooltip" data-placement="auto left"
                title="返回顶部"><i class="iconfont icon-longarrowup"></i></a>
        </span>
        <?php $this->options->BottomleftInfo(); ?>
        &copy;
        <?php echo date("Y"); ?> Copyright.
    </div>
</footer>
</div><!--end of .app app-header-fixed-->

<?php $this->footer(); ?>

<!--develope本地版本-->
<!--<script data-no-instant src="<?php //$this->options->themeUrl('js/develope/ui-nav.js') ?>"></script>
<script data-no-instant src="<?php //$this->options->themeUrl('js/develope/ui-toggle.js') ?>"></script>
<script data-no-instant src="<?php //$this->options->themeUrl('js/develope/ui-client.js') ?>"></script>
<script src="<?php //$this->options->themeUrl('js/develope/script.js') ?>"></script>-->

<!--CDN加载-->
<script src="//cdn.bootcss.com/bootstrap/3.3.4/js/bootstrap.min.js" data-no-instant></script>
<!-- <script data-no-instant src="//cdn.bootcss.com/instantclick/3.0.1/instantclick.min.js"></script> -->
<script data-no-instant src="<?= THEME_URL ?>/packages/instantclick.js"></script>
<script src="//cdn.bootcss.com/highlight.js/9.5.0/highlight.min.js"></script>



<script data-no-instant type="text/javascript">
    <?php $this->options->customJs() ?>//自定义js输出位置
    InstantClick.on('change', function (isInitialLoad) {
        if (isInitialLoad === false) {
            if (typeof MathJax !== 'undefined') {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            } // support MathJax
            if (typeof _hmt !== 'undefined')  // support 百度统计
                _hmt.push(['_trackPageview', location.pathname + location.search]);
            if (typeof ga !== 'undefined')  // support google analytics
                ga('send', 'pageview', location.pathname + location.search);
            if (typeof DUOSHUO !== 'undefined') //多说
                DUOSHUO.EmbedThread('.ds-thread');
        }
        $('pre code').each(function (i, block) {
            hljs.highlightBlock(block);
        });
        <?php $this->options->ChangeAction() ?>//instantclick 回调函数输出位置
    });
    <?php if ($this->options->preload == '0'): ?>
        InstantClick.init('mouseover');
    <?php elseif ($this->options->preload == '1'): ?>
        InstantClick.init('mousedown');
    <?php elseif ($this->options->preload == '2'): ?>
        InstantClick.init('<?php $this->options->delaytime(); ?>');
    <?php endif; ?>
</script>


<!-- 压缩后版本 -->
<script data-no-instant src="<?= THEME_URL ?>/js/main.min.js"></script>
<script src="<?= THEME_URL ?>/js/script.min.js"></script>


<!--页面布局header-fix-->
<script type="text/javascript">
    <?php if (!empty($this->options->indexsetup) && in_array('header-fix', $this->options->indexsetup)): ?>
        $(document).ready(function () {
            $('#comments a[href^="#"][href!="#"]').click(function () {
                var target = document.getElementById(this.hash.slice(1));
                if (!target) return;
                var targetOffset = $(target).offset().top - 50;
                $('html,body').animate({
                    scrollTop: targetOffset
                },
                    300);
                return false;
            });//主要修复评论定位不准确BUG
            if (window.location.hash.indexOf('#') >= 0) {
                setTimeout(function () {
                    $('html,body').animate({ scrollTop: ($(window.location.hash).offset().top - 50) + "px" }, 300);
                }, 700);
            }//主要修复评论定位不准确BUG
        });
    <?php endif; ?>
</script>
<!--页页面布局header-fix结束-->

<!--comments.php 页面必需js-->
<?php if ($this->is('single') & !($this->is('page', 'cross'))): ?>
    <?php if ($this->allow('comment')): ?>
        <script type="text/javascript">
                (function () {
                    window.TypechoComment = {
                        dom: function (id) {
                            return document.getElementById(id);
                        },
                        create: function (tag, attr) {
                            var el = document.createElement(tag);
                            for (var key in attr) {
                                el.setAttribute(key, attr[key]);
                            }
                            return el;
                        },
                        reply: function (cid, coid) {
                            var comment = this.dom(cid),
                                parent = comment.parentNode,
                                response = this.dom('<?php echo $this->respondId(); ?>'),
                                input = this.dom('comment-parent'),
                                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                                textarea = response.getElementsByTagName('textarea')[0];
                            if (null == input) {
                                input = this.create('input', {
                                    'type': 'hidden',
                                    'name': 'parent',
                                    'id': 'comment-parent'
                                });
                                form.appendChild(input);
                            }
                            input.setAttribute('value', coid);
                            if (null == this.dom('comment-form-place-holder')) {
                                var holder = this.create('div', {
                                    'id': 'comment-form-place-holder'
                                });
                                response.parentNode.insertBefore(holder, response);
                            }
                            comment.appendChild(response);
                            this.dom('cancel-comment-reply-link').style.display = '';
                            if (null != textarea && 'text' == textarea.name) {
                                textarea.focus();
                            }
                            return false;
                        },
                        cancelReply: function () {
                            var response = this.dom('<?php echo $this->respondId(); ?>'),
                                holder = this.dom('comment-form-place-holder'),
                                input = this.dom('comment-parent');
                            if (null != input) {
                                input.parentNode.removeChild(input);
                            }
                            if (null == holder) {
                                return true;
                            }
                            this.dom('cancel-comment-reply-link').style.display = 'none';
                            holder.parentNode.insertBefore(response, holder);
                            return false;
                        }
                    };
                })();
        </script>
        <!--点击用户名即可修改游客信息-->
        <script type="text/javascript">
            $("#comments .reply a").addClass("comment-reply-link label bg-info");
            $('#comments .cancel-comment-reply a').addClass("label bg-primary m-l-xs");
            function showhidediv(id) {
                var sbtitle = document.getElementById(id);
                if (sbtitle) {
                    if (sbtitle.style.display == 'block') {
                        sbtitle.style.display = 'none';
                    } else {
                        sbtitle.style.display = 'block';
                    }
                }
            }
        </script>
        <!--表情OwO代码开始，来自DIYgod-->
        <script>
            var OwOdemo = new OwO({
                logo: '表情',
                container: document.getElementsByClassName('OwO')[0],
                target: document.getElementsByClassName('OwO-textarea')[0],
                api: '<?= THEME_URL ?>/packages/OwO/OwO.json',
                position: 'down',
                width: '100%',
                maxHeight: '220px'
            });
        </script>

        <!--表情OwO代码结束-->
    <?php endif; ?>
<?php endif; ?>
<!--comments.php 必需js结束-->

<!--lightgallery必备组件-->
<script src="//cdn.bootcss.com/lightgallery/1.3.9/js/lightgallery.min.js"></script>
<script src="//cdn.bootcss.com/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
<script src="//cdn.bootcss.com/lightgallery/1.2.21/js/lg-zoom.min.js"></script>

<!--代码高亮插件启动-->
<script>hljs.initHighlightingOnLoad();</script>


<!--图片延迟加载开始-->
<?php if (!empty($this->options->indexsetup) && in_array('lazyloadimg', $this->options->indexsetup)): ?>
    <script src="<?= THEME_URL ?>/js/jquery.lazyload.min.js"></script>
    <script type="text/javascript">
        //图片延迟加载
        $("img").lazyload({
            effect: 'fadeIn'
        });
    </script>
<?php endif; ?>
<!--图片延迟加载结束-->

<!--音乐播放器开始。by qqdie 修改自youduBGM插件-->
<?php if (!empty($this->options->indexsetup) && in_array('musicplayer', $this->options->indexsetup)): ?>
    <bgm>
        <a class="ymusic" onclick="playbtu();" target="_blank">
            <i id="ydmc"></i>
        </a>
        <a class="ymusic" onclick="next();" id="ydnext" target="_blank">
            <i class="iconfont icon-next"></i>
        </a>
    </bgm>
    <script data-no-instant>
        if (!window.yaudio) {
            window.yaudio = new Audio();
            window.yaudio.controls = true;
            window.musicArr = [<?php $this->options->musiclist(); ?>];//后台填写播放列表
            /*首次随机播放*/
            window.musicIndex = parseInt(Math.random() * musicArr.length);
            window.currentMusic = musicArr[window.musicIndex];
            window.yaudio.src = window.currentMusic.mp3;
            window.yaudio.ti = window.currentMusic.title;
            window.yaudio.art = window.currentMusic.artist;
            <?php if ($this->options->isautoplay == '0'): ?>
            <?php else: ?>
                if (!window.disableautoplay) {
                    window.yaudio.play();
                }
                window.disableautoplay = true;
            <?php endif; ?>
        } else {
            if (!window.yaudio.paused) {
                var oyd = document.getElementById("ydmc");
                oyd.className = "iconfont icon-music icon-spin-music";
            }
        }


    </script>
    <script data-no-instant src="<?php $this->options->themeUrl('js/player.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/prbug.min.js'); ?>"></script>
<?php endif; ?>
<!--音乐播放器结束-->

</body><!--#body end-->

</html><!--html end-->