<?php

/*
 *  V3t  2013.08.29 
 * 
 * 我们是谁? 我们是一家工作室, 主要从事网站设计, Discuz模板制作, WordPress企业项目, PHP+Mysql应用开发及相关外包服务.
 * 我们致力于为每一位用户, 打造独立个性的产品, 提升用户体验, 让你的网站更加的接近 Web 2.0 标准.
 *
 * 手机: 182-3270-3356  150-7679-6160
 * QQ:  32-77558-32  2-292-191-585
 * Email: 327755832@qq.com
 *
 * 工作时间：周一至周六上午8:30-11:30、下午1:00-5:00、晚上8:00-10:00(业务咨询时间)，周日需提前预约
 * 网站管理在线时间：每工作日上午9:30-10:00、下午2:00-3:00、晚上9:00-10:00 
 *
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

//语言, 如修改注意标点符号
function m_lang($f) {	
$m_lang = array(
	'home' => '首页',
	'forum' => '论坛',
	'mfriendall' => '全部',
	'mfriendprofile' => '资料',
	'mfriendgroup' => '分组',
	'more' => '更多',
	'fup' => '上级',
	'flist' => '列表',
	'res' => '刷新',	
	'prev' => '上一页',
	'next' => '下一页',
	'newth' => '新帖',
	'dfth' => '默认',
	'subfrm' => '子版块',
	'thtys' => '分类',
	'pta' => '发表于',
	'reply' => '发表回复',
	'srp' => '查看回复',
	'rcom' => '发表评论',
	'acom' => '查看评论',
	'opt' => '选填',
	'od' => '条',
	'de' => '的',
	'tt' => '共有',
	'thread' => '主题',
	'reply' => '回复',	
	'views' => '看贴',
	'mods' => '管理',
	'mthread' => '帖子',
	'mforum' => '版块',
	'profile' => '个人资料',
	'favorite' => '我的收藏',
	'mypm' => '我的消息',
	'psubject' => '帖子标题',
	'arc' => '文章',
	'lz' => '楼主',
	'cldate' => '日期格式:2010-12-01 10:50',
	'pcf' => '重复',	
	'back' => '返回',
	'search' => '搜索',
	'searchthread' => '输入帖子关键字',
	'new_remind' => '有新提醒',	
	'touch' => '触屏版',
	'tthread' => '正文',
	'nosearch' => '暂无',
	'gohome' => '返回首页',
	'regmes' => '原因',	
	'upload_pic' => '上传图片',	
	'reg' => '注册',
	'qq' => '登录',
	'noid' => '没有账号?',
	'yesid' => '已有账号?',	
	'username' => '账号',	
    );
	if($m_lang[$f]) $f = $m_lang[$f]; 
	if(CHARSET =='gbk'){
		return $f;
	}else{
		return diconv($f,'GBK',CHARSET);
	}
}

?>