<?php   
    /**  
    * 豆瓣书单  
    *  
    * @package custom  
    */  
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<!-- aside -->
	<?php $this->need('aside.php'); ?>
	<!-- / aside -->

<?php
$userID=$this->fields->doubanID;   //这里修改为你的豆瓣ID (ps:并非昵称)
$url = "https://api.douban.com/v2/book/user/$userID/collections?count=100"; //最多取100条数据
$res=json_decode(file_get_contents($url),true); //读取api得到json
$res = $res['collections'];
foreach($res as $v){
//已经读过的书
if($v['status']=="read"){
    $book_name=$v['book']['title'];
    $book_img = $v['book']['images']['medium'];
    $book_url = $v['book']['alt'];
    $readlist[] = array("name"=>$book_name,"img"=>$book_img,"url"=>$book_url);
}elseif($v['status']=="reading"){
    //正在读的书
    $book_name=$v['book']['title'];
    $book_img = $v['book']['images']['medium'];
    $book_url = $v['book']['alt'];
    $readinglist[] = array("name"=>$book_name,"img"=>$book_img,"url"=>$book_url);
}elseif($v['status']=="wish"){
    //想读的书
    $book_name=$v['book']['title'];
    $book_img = $v['book']['images']['medium'];
    $book_url = $v['book']['alt'];
    $wishlist[] = array("name"=>$book_name,"img"=>$book_img,"url"=>$book_url);
}
}
?>
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
        <?php if((!empty($this->options->indexsetup) && in_array('NoRandomPic-post', $this->options->indexsetup)) || $this->fields->thumb == "no"): ?>
        <?php else: ?>
        <?php echoPostThumbnail($this); ?>
        <?php endif; ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
          <div class="entry-content l-h-2x">
            <div class="booklist">
              <h2>我的书单</h2>
                <div class="section">
                    <h4>正在读的书</h4>
                    <ul class="clearfix">
                        <?php foreach($readinglist as $v):?>
                        <li>
                            <div class="photo"><img src="<?php echo $v['img'];?>" width="98" height="151" /></div>
                            <div class="rsp"></div>
                            <div class="text"><a href="<?php echo $v['url'];?>" target="_blank"><h3><?php echo $v['name'];?></h3></a></div>
                        </li>
                        <?php endforeach; ?>
                     </ul>
                </div>
                <div class="section">
                    <h4>已读的书</h4>
                    <ul  class="clearfix">
                        <?php foreach($readlist as $v):?>
                        <li>
                            <div class="photo"><img src="<?php echo $v['img'];?>" width="98" height="151" /></div>
                            <div class="rsp"></div>
                            <div class="text"><a href="<?php echo $v['url'];?>" target="_blank"><h3><?php echo $v['name'];?></h3></a></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="section">
                    <h4>想读的书</h4>
                    <ul  class="clearfix">
                        <?php foreach($wishlist as $v):?>
                        <li>
                            <div class="photo"><img src="<?php echo $v['img'];?>" width="98" height="151" /></div>
                            <div class="rsp"></div>
                            <div class="text"><a href="<?php echo $v['url'];?>" target="_blank"><h3><?php echo $v['name'];?></h3></a></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $(".booklist .section ul li .rsp").hide();
        $(".booklist .section    ul li").hover(function(){
                $(this).find(".rsp").stop().fadeTo(500,0.5)
                $(this).find(".text").stop().animate({left:'0'}, {duration: 500})
            },
            function(){
                $(this).find(".rsp").stop().fadeTo(500,0)
                $(this).find(".text").stop().animate({left:'30'}, {duration: "fast"})
                $(this).find(".text").animate({left:'-300'}, {duration: 0})
            });
    });
</script>

    <!-- footer -->
	<?php $this->need('footer.php'); ?>
  	<!-- / footer -->