<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<!-- aside -->
	<?php $this->need('aside.php'); ?>
	<!-- / aside -->

  	<!-- content -->
	<div id="content" class="app-content"> 
   <a href="#" class="off-screen-toggle hide" data-toggle-class=".app-aside=off-screen"></a>
   <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
      <header class="bg-light lter b-b wrapper-md">
       <h1 class="entry-title m-n font-thin h3 text-black l-h"><?php $this->title() ?></h1>
       <!--文章标题下面的小部件-->
       <ul class="entry-meta text-muted list-inline m-b-none small">
       <!--作者-->
        <li class="meta-author"> <i class="iconfont icon-user1" aria-hidden="true"></i> <span class="sr-only">作者：</span> <a class="meta-value" href="<?php $this->author->permalink(); ?>" rel="author"> <?php $this->author(); ?> </a></li>
        <!--发布时间-->
        <li class="meta-date"> <i class="iconfont icon-weibiaoti5" aria-hidden="true"></i> <span class="sr-only">发布时间：</span> <time class="meta-value" datetime="2016-07-16T17:27:59+00:00"> <?php $this->date('F j, Y'); ?>  </time></li>
        <!--浏览数-->
        <li class="meta-views"> <i class="iconfont icon-eye" aria-hidden="true"></i> <span class="meta-value"><?php get_post_view($this) ?>次浏览</span></li>
        <!--评论数-->
        <li class="meta-comments"> <i class="iconfont icon-comments" aria-hidden="true"></i> <?php $this->commentsNum('%d 条评论'); ?></li>
        <!--标签-->        
        <li class="meta-tags"> <i class="iconfont icon-tags" aria-hidden="true"></i> <span class="sr-only">标签：</span> <span class="meta-value"><?php $this->tags(' ', true, 'none'); ?></span></li>
       </ul>
      </header>
      <div class="wrapper-md">
       <ol class="breadcrumb bg-white b-a" itemscope="" itemtype="http://schema.org/WebPage">
        <li><a href="<?php $this->options->siteUrl(); ?>" itemprop="breadcrumb" title="返回首页" data-toggle="tooltip"><i class="iconfont icon-shouye" aria-hidden="true"></i> 首页</a></li>
        <li><?php $this->category(','); ?></li>
        <li class="active">正文</li>
       </ol>
       <!--博客文章样式 begin with .blog-post-->
       <div class="blog-post">
        <article class="panel post-2529 post type-post status-publish format-standard has-post-thumbnail hentry category-develop tag-javascript-api tag-148">
        <!--文章页面的头图-->
         <div class="entry-thumbnail" aria-hidden="true"> 
        <?php if (array_key_exists('thumb',unserialize($this->___fields()))): ?>
          <img width="900" height="300" src="<?php echo $this->fields->thumb; ?>" class="img-responsive center-block wp-post-image" />
        <?php else: ?>
          <?php $thumb = showThumbnail($this); if(!empty($thumb)): ?>
          <img width="900" height="300" src="<?php echo $thumb ?>" class="img-responsive center-block wp-post-image" />
        <?php endif; ?>
        <?php endif; ?>
         </div>
         <!--文章内容-->
         <div class="wrapper-lg">
          <div class="entry-content l-h-2x">
			        <?php $this->content(); ?>
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


    <!-- footer -->
	<?php $this->need('footer.php'); ?>
  	<!-- / footer -->