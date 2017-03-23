<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<!-- aside -->
	<?php $this->need('aside.php'); ?>
	<!-- / aside -->

  	<!-- content -->
	<div id="content" class="app-content markdown-body"> 
   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
      <header class="bg-light lter b-b wrapper-md">
       <h1 class="entry-title m-n font-thin h3 text-black l-h"><?php $this->title() ?>
            <?php if($this->user->hasLogin()):?>
                <a class="superscript" href="<?php Helper::options()->adminUrl()?>write-post.php?cid=<?=$this->cid ?>" target="_blank"><i class="iconfont icon-pencilsquareo" aria-hidden="true"></i></a>
            <?php endif?>
       </h1>
       <!--文章标题下面的小部件-->
       <ul class="entry-meta text-muted list-inline m-b-none small">
       <!--作者-->
        <li class="meta-author"><i class="iconfont icon-user1" aria-hidden="true"></i> <span class="sr-only">作者：</span> <a class="meta-value" href="<?php $this->author->permalink(); ?>" rel="author"> <?php $this->author(); ?></a></li>
        <!--发布时间-->
        <li class="meta-date"><i class="iconfont icon-clocko" aria-hidden="true"></i> <span class="sr-only">发布时间：</span> <time class="meta-value"><?php if($this->options->langis == '0'): ?><?php $this->date('F j, Y'); ?><?php elseif($this->options->langis == '1'): ?><?php $this->date('Y 年 m 月 d 日'); ?><?php elseif($this->options->langis == '2'): ?><?php $this->date('Y 年 m 月 d 日'); ?><?php endif; ?></time></li>
        <!--浏览数-->
        <li class="meta-views"><i class="iconfont icon-eye" aria-hidden="true"></i> <span class="meta-value"><?php get_post_view($this) ?>次浏览</span></li>
        <!--评论数-->
        <li class="meta-comments"><i class="iconfont icon-comments" aria-hidden="true"></i><a class="meta-value" href="#comments"><?php $this->commentsNum(_t(' 暂无评论'), _t(' 1 条评论'), _t(' %d 条评论')); ?></a></li>
        <!--分类-->        
        <li class="meta-categories"><i class="iconfont icon-tags" aria-hidden="true"></i> <span class="sr-only">分类：</span> <span class="meta-value"><?php $this->category(' '); ?></span></li>
       </ul>
      </header>
      <div class="wrapper-md">
       <ol class="breadcrumb bg-white b-a" itemscope="" itemtype="http://schema.org/WebPage">
        <li><a href="<?php $this->options->rootUrl(); ?>" itemprop="breadcrumb" data-toggle="tooltip" data-placement="top" title="返回首页"><i class="iconfont icon-home" aria-hidden="true"></i> 首页</a></li>
        <li><?php $this->category(','); ?></li>
        <li class="active">正文</li>
       </ol>
       <!--博客文章样式 begin with .blog-post-->
       <div id="postpage" class="blog-post">
        <article class="panel">
        <!--文章页面的头图-->
        <?php if((!empty($this->options->indexsetup) && in_array('NoRandomPic-post', $this->options->indexsetup)) || $this->fields->thumb == "no"): ?>
        <?php else: ?>
        <?php echoPostThumbnail($this); ?>
        <?php endif; ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
          <div class="entry-content l-h-2x">
          <?php parseContent($this); ?>
          </div>
         </div>
        </article>
       </div>
       <!--上一篇&下一篇-->
       <nav class="m-t-lg m-b-lg">
        <ul class="pager">
        <?php thePrev($this); ?>   <?php theNext($this); ?>
        </ul>
       </nav>
       <!--评论-->
        <?php $this->need('comments.php') ?>
      </div>
     </div>
     <!--文章右侧边栏开始-->
    <?php $this->need('sidebar.php')?>
     <!--文章右侧边栏结束-->
    </div>
   </main>
  </div>
  	<!-- /content -->

<script src="<?php $this->options->themeUrl("js/toc.min.js") ?>"></script>
    <!-- footer -->
	<?php $this->need('footer.php'); ?>
  	<!-- / footer -->