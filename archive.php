<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

    <!-- aside -->
    <?php $this->need('aside.php'); ?>
    <!-- / aside -->

    <!-- content -->
<div id="content" class="app-content">
  <div class="butterbar hide">
    <span class="bar"></span>
  </div>
  <a href="#" class="off-screen-toggle hide" data-toggle-class=".app-aside=off-screen"></a>
  <main class="app-content-body">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
      <div class="col">
        <header class="bg-light lter b-b wrapper-md">
          <h1 class="m-n font-thin h3 text-black l-h"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h1>
          </header>
        <div class="wrapper-md">

       <ol class="breadcrumb bg-white b-a" itemscope="" itemtype="http://schema.org/WebPage">
        <li><a href="<?php $this->options->siteUrl(); ?>" itemprop="breadcrumb" title="返回首页" data-toggle="tooltip"><i class="iconfont icon-shouye" aria-hidden="true"></i> 首页</a></li>
        <li class="active"><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?></li>
       </ol>
       <?php if ($this->have()): ?>
            <!-- 输出文章-->
      <div class="blog-post">  
      <?php while($this->next()): ?>      
        <div class="panel">
         <!-- 文章页面头图-->
          <div id="index-post-img">
        <?php if (array_key_exists('thumb',unserialize($this->___fields()))): ?>
          <img src="<?php echo $this->fields->thumb; ?>" class="img-full">
        <?php else: ?>
          <?php $thumb = showThumbnail($this); if(!empty($thumb)): ?>
          <img src="<?php echo $thumb ?>" class="img-full">
        <?php endif; ?>
        <?php endif; ?>
      </div>
          <!-- 文章内容-->
          <div class="wrapper-lg">
          

            <h2 class="m-t-none"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
            <div>
            <?php $this->excerpt(200, '...'); //180就是摘要的字数，...是后缀; ?>
            </div>
            <div class="line line-lg b-b b-light"></div>
            <div class="text-muted">
              <i class="iconfont icon-user1 text-muted"></i> <a href class="m-r-sm"><?php $this->author(); ?> </a>
              <i class="iconfont icon-weibiaoti5 text-muted"></i> <?php $this->date('F j, Y'); ?>
              <a href="<?php $this->permalink() ?>#comments" class="m-l-sm"><i class="iconfont icon-comments text-muted"></i><?php $this->commentsNum(_t(' 暂无评论'), _t(' 1 条评论'), _t(' %d 条评论')); ?></a>
            </div>
          </div>
        </div>
     <?php endwhile; ?>     
        
      </div>
          <?php else: ?>
            <p class="m-b-md"> 没有找到搜索结果，请尝试更换关键词。</p>
          <?php endif; ?>

          <!--分页 按钮-->
          <nav class="text-center m-t-lg m-b-lg" role="navigation">
        <?php $this->pageNav('&laquo;', '&raquo;'); ?>
          </nav>
        </div>
      </div>
      <!-- 右侧栏-->
      <?php $this->need('sidebar.php') ?>
    </div>
  </main>
</div>
    <!-- /content -->

    <!-- footer -->
    <?php $this->need('footer.php'); ?>
    <!-- / footer -->