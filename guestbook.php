<?php   
    /**  
    * 留言板  
    *  
    * @package custom  
    */  
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<!-- aside -->
	<?php $this->need('aside.php'); ?>
	<!-- / aside -->

  	<!-- content -->
	<div id="content" class="app-content"> 
   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
      <header class="bg-light lter b-b wrapper-md">
       <h1 class="entry-title m-n font-thin h3 text-black l-h"><?php $this->title() ?>
            <?php if($this->user->hasLogin()):?>
                <a class="superscript" href="<?php Helper::options()->adminUrl()?>write-page.php?cid=<?=$this->cid ?>" target="_blank"><i class="iconfont icon-pencilsquareo" aria-hidden="true"></i></a>
            <?php endif?>
       </h1>
      </header>
      <div class="wrapper-md">
       <ol class="breadcrumb bg-white b-a" itemscope="" itemtype="http://schema.org/WebPage">
        <li><a href="<?php $this->options->rootUrl(); ?>" itemprop="breadcrumb" title="返回首页" data-toggle="tooltip"><i class="iconfont icon-home" aria-hidden="true"></i> 首页</a></li>
        <li class="active"><?php $this->title() ?>  </li>
       </ol>
       <!--博客文章样式 begin with .blog-post-->
       <div id="postpage" class="blog-post">
        <article class="panel">
        <!--文章页面的头图-->
        <?php echoPostThumbnail($this); ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
          <div id="list-post">          
          <ul class='readers-list'>     
          <?php getFriendWall(); ?>     
          </ul>
          </div>
          <div class="entry-content l-h-2x">
            <?php parseContent($this); ?>
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