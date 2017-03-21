<?php
/**
 * bufannao.com CMS主题专用插件
 * 
 * @package BufannaoCms
 * @author 不烦恼
 * @version 1.0.0
 * @link http://bufannao.com
 */
class BufannaoCms_Plugin implements Typecho_Plugin_Interface
{
	private static $_widgetPool = array();
	private static $pagebreak = '<!--nextpage-->';
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('admin/write-post.php')->option = array('BufannaoCms_Plugin', 'notice');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->___firstImageUrl = array('BufannaoCms_Plugin', '___firstImageUrl');
        Typecho_Plugin::factory('Widget_Archive')->___firstImageUrl = array('BufannaoCms_Plugin', '___firstImageUrl');
        Typecho_Plugin::factory('Widget_Archive')->query = array('BufannaoCms_Plugin', 'query');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('BufannaoCms_Plugin', 'contentEx');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
		$pic = Helper::options()->pluginUrl;
        $defaultPic = new Typecho_Widget_Helper_Form_Element_Text('defaultPic', NULL, $pic.'/BufannaoCms/defaultPic/demo.jpg', _t('文章默认图片'),  _t('文章不含图片时默认替代显示的图片(设置单个或从逗号分隔的多个图片中随机抽取一个)'));
        $form->addInput($defaultPic);

        $slideSize = new Typecho_Widget_Helper_Form_Element_Text('slideSize', NULL, '5', _t('幻灯文章数量'),  _t('用于图片幻灯方式显示文章的数量'));
        $form->addInput($slideSize);

        $topSize = new Typecho_Widget_Helper_Form_Element_Text('topSize', NULL, '5', _t('推荐文章数量'),  _t('显示推荐文章的数量'));
        $form->addInput($topSize);

        $randomSize = new Typecho_Widget_Helper_Form_Element_Text('randomSize', NULL, '5', _t('随机文章数量'),  _t('显示随机文章的数量'));
        $form->addInput($randomSize);

        $albumSize = new Typecho_Widget_Helper_Form_Element_Text('albumSize', NULL, '5', _t('相册文章数量'),  _t('显示相册文章的数量'));
        $form->addInput($albumSize);

        $hotSize = new Typecho_Widget_Helper_Form_Element_Text('hotSize', NULL, '5', _t('热评文章数量'),  _t('显示热评文章的数量'));
        $form->addInput($hotSize);

        $hotDay = new Typecho_Widget_Helper_Form_Element_Text('hotDay', NULL, '0', _t('热评文章有效天数'),  _t('显示多少天之内发布的文章(0为不限制)'));
        $form->addInput($hotDay);

        $guestbookSlug = new Typecho_Widget_Helper_Form_Element_Text('guestbookSlug', NULL, 'guestbook', _t('留言页面缩略名'),  _t('如页面“留言簿”的缩略名(用于筛选最新评论与最新留言)'));
        $form->addInput($guestbookSlug);

        $comments = new Typecho_Widget_Helper_Form_Element_Text('comments', NULL, '10', _t('最新评论数量'),  _t('默认显示除留言簿外的评论数量'));
        $form->addInput($comments);

        $messages = new Typecho_Widget_Helper_Form_Element_Text('messages', NULL, '10', _t('最新留言数量'),  _t('默认显示留言簿的留言数量'));
        $form->addInput($messages);

        $tracks = new Typecho_Widget_Helper_Form_Element_Text('tracks', NULL, '10', _t('评论足迹数量'),  _t('默认显示访客评论足迹的数量'));
        $form->addInput($tracks);

        $tags = new Typecho_Widget_Helper_Form_Element_Text('tags', NULL, '10', _t('随机标签数量'),  _t('默认显示随机标签的数量'));
        $form->addInput($tags);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 输出文章内容第一个图片URL
     * 
     * @access public
     * @return void
     */
    public static function ___firstImageUrl($widget)
    {
		$pattern = '/<img.*?\s+src=\"([^"]+?)\"[^>]*?>/is';
		if(preg_match($pattern, $widget->text, $image))
		{
			return $image[1];
		}
		else
		{
			$pic = explode(',', trim(Helper::options()->plugin('BufannaoCms')->defaultPic, ','));
			return trim($pic[rand(0,(count($pic) - 1))]);
		}
	}

    /**
     * 提交查询
     * 
     * @access public
     * @return void
     */
    public static function query($widget, $select)
    {
        if (isset($widget->request->orderBy)) {
            $select->order('table.contents.'.$widget->request->orderBy, Typecho_Db::SORT_DESC);
        }
        Typecho_Db::get()->fetchAll($select, array($widget, 'push'));
	}

    /**
     * 文章内容分页
     * 
     * @access public
     * @return void
     */
	public static function contentEx($text, $widget)
	{
		if(!($widget->is('post') OR $widget->is('page')))
		{
			return $text;
		}
		else
		{
			if(strpos($text, self::$pagebreak) === FALSE)
			{
				return $text;
			}
			$contents = explode(self::$pagebreak, $text);
			$total = count($contents);
			$contentpage = (int)$widget->request->contentpage;
			$contentpage = ($contentpage > 0 AND $contentpage <= $total) ? $contentpage : 1;

			$nav = new Typecho_Widget_Helper_PageNavigator_Box($total, $contentpage, 1, $widget->permalink.'?contentpage={page}');
			ob_start();
			echo '<ol class="page-navigator content-navigator">';
			$nav->render('&laquo;', '&raquo;', 3, '...');
			echo '</ol>';
			$nav = ob_get_clean();
			return Typecho_Common::cutParagraph($contents[$contentpage -1]).$nav;
		}
	}

    /**
     * 插件对缩略名规则提示
     * 
     * @access public
     * @return void
     */
    public static function notice($post)
    {
		return '';
	}

    /**
     * 幻灯功能实现方法
     * 
     * @access public
     * @return void
     */
    public static function slideShow($slideSize = 0)
    {
		if (!isset(self::$_widgetPool['slideShow'])) {
			$slide = Typecho_Widget::widget('Widget_Abstract_Contents@slideShow');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($slideSize))
			{
				$slideSize = $options->plugin('BufannaoCms')->slideSize;
			}

			$select = $slide->select()->where('table.contents.status = ?', 'publish')
				->where('table.contents.created < ?', $options->gmtTime)
				->where('table.contents.type = ?', 'post')
				->where('table.contents.slug LIKE ?', '\_\_%slide\_\_%')
				->order('table.contents.created', Typecho_Db::SORT_DESC)
				->limit($slideSize);

			$db->fetchAll($select, array($slide, 'push'));

			self::$_widgetPool['slideShow'] = $slide;
		}
		return self::$_widgetPool['slideShow'];
	}

    /**
     * 推荐文章实现方法
     * 
     * @access public
     * @return void
     */
    public static function topShow($topSize = 0)
    {
		if (!isset(self::$_widgetPool['topShow'])) {
			$top = Typecho_Widget::widget('Widget_Abstract_Contents@topShow');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($topSize))
			{
				$topSize = $options->plugin('BufannaoCms')->topSize;
			}

			$select = $top->select()->where('table.contents.status = ?', 'publish')
				->where('table.contents.created < ?', $options->gmtTime)
				->where('table.contents.type = ?', 'post')
				->where('table.contents.slug LIKE ?', '\_\_%top\_\_%')
				->order('table.contents.created', Typecho_Db::SORT_DESC)
				->limit($topSize);
			$db->fetchAll($select, array($top, 'push'));

			self::$_widgetPool['topShow'] = $top;
		}
		return self::$_widgetPool['topShow'];
	}

    /**
     * 相册文章实现方法
     * 
     * @access public
     * @return void
     */
    public static function albumShow($albumSize = 0)
    {
		if (!isset(self::$_widgetPool['albumShow'])) {
			$album = Typecho_Widget::widget('Widget_Abstract_Contents@albumShow');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($albumSize))
			{
				$albumSize = $options->plugin('BufannaoCms')->albumSize;
			}

			$select = $album->select()->where('table.contents.status = ?', 'publish')
				->where('table.contents.created < ?', $options->gmtTime)
				->where('table.contents.type = ?', 'post')
				->where('table.contents.slug LIKE ?', '\_\_%album\_\_%')
				->order('table.contents.created', Typecho_Db::SORT_DESC)
				->limit($albumSize);
			$db->fetchAll($select, array($album, 'push'));

			self::$_widgetPool['albumShow'] = $album;
		}
		return self::$_widgetPool['albumShow'];
	}

    /**
     * 随机文章实现方法
     * 
     * @access public
     * @return void
     */
    public static function randomShow($randomSize = 0)
    {
		if (!isset(self::$_widgetPool['randomShow'])) {
			$random = Typecho_Widget::widget('Widget_Abstract_Contents@randomShow');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($randomSize))
			{
				$randomSize = $options->plugin('BufannaoCms')->randomSize;
			}

			$totalsql = $db->fetchRow($db->select(array('COUNT(cid)' => 'total'))
				->from('table.contents')
				->where('table.contents.status = ?', 'publish')
				->where('table.contents.type = ?', 'post'));
			$total = $totalsql['total'];

			if($randomSize >= $total)
			{
				$select = $random->select()->where('table.contents.status = ?', 'publish')
					->where('table.contents.created < ?', $options->gmtTime)
					->where('table.contents.type = ?', 'post')
					->order('table.contents.created', Typecho_Db::SORT_DESC)
					->limit($randomSize);
				$db->fetchAll($select, array($random, 'push'));
			}
			else
			{
				$rand = array_rand(range(0,$total-1), $randomSize);
				foreach($rand as $offset){
					$select = $random->select()->where('table.contents.status = ?', 'publish')
						->where('table.contents.created < ?', $options->gmtTime)
						->where('table.contents.type = ?', 'post')
						->offset($offset)
						->limit(1);
					$db->fetchAll($select, array($random, 'push'));
				}
			}

			self::$_widgetPool['albumShow'] = $random;
		}
		return self::$_widgetPool['albumShow'];
	}

    /**
     * 热评文章实现方法
     * 
     * @access public
     * @return void
     */
    public static function hotShow($hotSize = 0, $hotDay = 0)
    {
		if (!isset(self::$_widgetPool['hotShow'])) {
			$hot = Typecho_Widget::widget('Widget_Abstract_Contents@hotShow');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($hotSize))
			{
				$hotSize = $options->plugin('BufannaoCms')->hotSize;
			}

			if(empty($hotDay))
			{
				$hotDay = $options->plugin('BufannaoCms')->hotDay;
			}

			$select = $hot->select()->where('table.contents.status = ?', 'publish')
				->where('table.contents.created < ?', $options->gmtTime)
				->where('table.contents.type = ?', 'post')
				->where('table.contents.commentsNum > ?', '0')
				->order('table.contents.commentsNum', Typecho_Db::SORT_DESC)
				->limit($hotSize);
			if($hotDay > 0){
				$select->where('table.contents.created > ?', $options->gmtTime - $hotDay * 86400);
			}
			$db->fetchAll($select, array($hot, 'push'));

			self::$_widgetPool['hotShow'] = $hot;
		}
		return self::$_widgetPool['hotShow'];
	}

    /**
     * 最新评论实现方法
     * 
     * @access public
     * @return void
     */
    public static function onlyComment($guestbookSlug = '', $comments = 0, $ignoreAuthor = TRUE)
    {
		if (!isset(self::$_widgetPool['onlyComment'])) {
			$onlyComment = Typecho_Widget::widget('Widget_Abstract_Comments@onlyComment');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($guestbookSlug))
			{
				$guestbookSlug = $options->plugin('BufannaoCms')->guestbookSlug;
			}

			if(empty($comments))
			{
				$comments = $options->plugin('BufannaoCms')->comments;
			}

			$select  = $onlyComment->select()->limit((int)$comments)
				->join('table.contents', 'table.comments.cid <> table.contents.cid')
				->where('table.comments.status = ?', 'approved')
				->where('table.contents.type = ?', 'page')
				->where('table.contents.slug = ?', $guestbookSlug)
				->order('table.comments.coid', Typecho_Db::SORT_DESC);

			if($options->commentsShowCommentOnly) {
				$select->where('table.comments.type = ?', 'comment');
			}
			if($ignoreAuthor) {
				$select->where('table.comments.ownerId <> table.comments.authorId');
			}
			$db->fetchAll($select, array($onlyComment, 'push'));

			self::$_widgetPool['onlyComment'] = $onlyComment;
		}
		return self::$_widgetPool['onlyComment'];
	}

    /**
     * 最新留言实现方法
     * 
     * @access public
     * @return void
     */
    public static function onlyMessage($guestbookSlug = '', $messages = 0, $ignoreAuthor = TRUE)
    {
		if (!isset(self::$_widgetPool['onlyMessage'])) {
			$onlyMessage = Typecho_Widget::widget('Widget_Abstract_Comments@onlyMessage');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($guestbookSlug))
			{
				$guestbookSlug = $options->plugin('BufannaoCms')->guestbookSlug;
			}

			if(empty($messages))
			{
				$messages = $options->plugin('BufannaoCms')->messages;
			}

			$select  = $onlyMessage->select()->limit((int)$messages)
				->join('table.contents', 'table.comments.cid = table.contents.cid')
				->where('table.comments.status = ?', 'approved')
				->where('table.contents.type = ?', 'page')
				->where('table.contents.slug = ?', $guestbookSlug)
				->order('table.comments.coid', Typecho_Db::SORT_DESC);

			if($options->commentsShowCommentOnly) {
				$select->where('table.comments.type = ?', 'comment');
			}
			if($ignoreAuthor) {
				$select->where('table.comments.ownerId <> table.comments.authorId');
			}
			$db->fetchAll($select, array($onlyMessage, 'push'));

			self::$_widgetPool['onlyMessage'] = $onlyMessage;
		}
		return self::$_widgetPool['onlyMessage'];
	}

    /**
     * 评论足迹实现方法
     * 
     * @access public
     * @return void
     */
    public static function CommentTracks($tracks = 0)
    {
		if (!isset(self::$_widgetPool['CommentTracks'])) {
			$track = Typecho_Widget::widget('Widget_Abstract_Comments@CommentTracks');
			$db = Typecho_Db::get();

			if(empty($tracks))
			{
				$tracks = Helper::options()->plugin('BufannaoCms')->tracks;
			}

			if($user = Typecho_Widget::widget('Widget_User') AND $user->hasLogin())
			{
				$mail = $user->mail;
			}
			else
			{
				$mail = Typecho_Cookie::get('__typecho_remember_mail');
			}

			$select  = $track->select()->limit((int)$tracks)
				->where('table.comments.status = ?', 'approved')
				->where('table.comments.mail = ?', $mail)
				->order('table.comments.coid', Typecho_Db::SORT_DESC);
			$db->fetchAll($select, array($track, 'push'));

			self::$_widgetPool['CommentTracks'] = $track;
		}
		return self::$_widgetPool['CommentTracks'];
	}

    /**
     * 内容引用实现方法
     * 
     * @access public
     * @return void
     */
    public static function quoteShow($slug = '', $quote = 'quote')
    {
		if($slug AND $quote)
		{
			$db = Typecho_Db::get();
			$options = Helper::options();

			$slugSql = $db->fetchRow($db->select('text')
				->from('table.contents')
				->where('table.contents.slug = ?', $slug));
			$pattern = '/<!--\s*'.$quote.'\s*-->(.+?)<!--\s*\/'.$quote.'\s*-->/is';
			if($text = $slugSql['text'] AND preg_match($pattern, $text, $quote))
			{
				return $quote[1];
			}
		}
		return '';
	}

    /**
     * 随机标签实现方法
     * 
     * @access public
     * @return void
     */
    public static function randomTag($ignoreZeroCount = TRUE, $randomSize = 0)
    {
		if (!isset(self::$_widgetPool['randomTag'])) {
			$random = Typecho_Widget::widget('Widget_Abstract_Metas@randomTag');
			$db = Typecho_Db::get();
			$options = Helper::options();

			if(empty($randomSize))
			{
				$randomSize = $options->plugin('BufannaoCms')->tags;
			}

			$select = $db->select(array('COUNT(mid)' => 'total'))->from('table.metas')
				->where('type = ?', 'tag');
			if($ignoreZeroCount)
			{
				$select->where('count > 0');
			}

			$totalsql = $db->fetchRow($select);
			$total = $totalsql['total'];

			if($randomSize >= $total)
			{
				$select = $random->select()->where('type = ?', 'tag')
					->order('count', Typecho_Db::SORT_DESC)
					->limit($randomSize);
				if($ignoreZeroCount)
				{
					$select->where('count > 0');
				}
				$db->fetchAll($select, array($random, 'push'));
			}
			else
			{
				$rand = array_rand(range(0,$total-1), $randomSize);
				foreach($rand as $offset){
					$select = $random->select()->where('type = ?', 'tag')
						->offset($offset)
						->limit(1);
					if($ignoreZeroCount)
					{
						$select->where('count > 0');
					}
					$db->fetchAll($select, array($random, 'push'));
				}
			}

			self::$_widgetPool['randomTag'] = $random;
		}
		return self::$_widgetPool['randomTag'];
	}
}