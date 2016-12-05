<?php
/**
 * 友情链接
 *
 * @package custom
 */
 $this->need('header.php'); ?>

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
      </header>
      <div class="wrapper-md">
       <ol class="breadcrumb bg-white b-a" itemscope="" itemtype="http://schema.org/WebPage">
        <li><a href="<?php $this->options->siteUrl(); ?>" itemprop="breadcrumb" title="返回首页" data-toggle="tooltip"><i class="fa fa-home" aria-hidden="true"></i> 首页</a></li>
        <li class="active"><?php $this->title() ?>  </li>
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
<div class="page-links">
<h2>内页链接</h2>
<ul><?php $mypattern = '<li><a href="{url}" title="{title}" target="_blank" >{name}</a>:{title}</li>'."\n"; Links_Plugin::output($mypattern, 0, "one");?></ul></div>

<div class="page-links">
<!--<h2>首页链接</h2>
<ul><?php //Links_Plugin::output($mypattern, 0, "five");?></ul></div>
<div class="page-links">-->

<h2>全站链接</h2>
<ul><?php Links_Plugin::output($mypattern, 0, "ten");?></ul></div>
<div class="page-links">
<h2>建议网站</h2>
<ul><?php Links_Plugin::output($mypattern, 0, "good");?></ul></div>

			        <?php $this->content(); ?>
          </div>
         </div>
        </article>
       </div>
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