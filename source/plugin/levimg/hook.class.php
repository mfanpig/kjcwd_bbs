<?php

/**
 * Lev.levme.com [ 专业开发各种Discuz!插件 ]
 *
 * Copyright (c) 2013-2014 http://www.levme.com All rights reserved.
 *
 * Author: Mr.Lee <675049572@qq.com>
 *
 * Date: 2013-02-17 16:22:17 Mr.Lee $
 */


if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

class plugin_levimg_forum extends plugin_levimg {//免费版本只开放贴内图片优化功能，并点选无收藏图片功能
	
	public static function viewthread_posttop_output() {
		if (!self::_isopen('postbottom')) return self::_levimg();
	}
	
	public static function viewthread_postbottom_output() {
		if (self::_isopen('postbottom')) return self::_levimg();
	}
	
	public static function _levimg() {
		if ($_GET['inajax']) return array();
		global $_G, $postlist;//print_r($postlist);
		$forums = (array)unserialize(self::$PL_G['forums']);
		if ($forums[0] && !in_array($_G['fid'], $forums)) return array();
		$PLSTATIC = self::$PLSTATIC;
		$imgs = array();
		$_k = -1;
		foreach ($postlist as $k => $r) { 
			$_k++;
			//if (!$_G['uid']) $postlist[$k]['imagelist'] = array();
			$imgstr = $imgsrc = $imgs[$_k] = $bigimg  = '';
			if (!$_G['uid']) {
				$referer = urlencode($_G['siteurl'].'forum.php?mod=viewthread&tid='.$_G['tid']);
				$_login  = '<a onclick="showWindow(\'login\', this.href);return false;" class="xi1" 
							href="member.php?mod=logging&action=login&referer='.$referer
								.'">登陆/注册后查看大图【还可以在图片上标注哦！】</a>';
				$_control = <<<EOF
							<a onclick="showWindow('login', this.href);return false;"
							href="member.php?mod=logging&action=login&referer={$referer}" id="sideimgbtncol_{$k}">大图 | 
EOF;
			}
			if ($r['attachments'] && $r['imagelistcount']) {
				foreach ($r['attachments'] as $aid => $v) {
					if (!$v['isimage']) continue;
					//unset($postlist[$k]['attachments'][$aid]);
					$_bigimg = $imgsrc = self::attbasedir($v['remote']).$v['attachment'];
					if ($v['thumb']) {
						$imgsrc .= '.thumb.jpg';
					}elseif (self::_isopen('cutimg')) {
						$cutimg = explode('=', self::$PL_G['cutimg']);
						$_cutw  = $cutimg[0] >0 ? intval($cutimg[0]) : 100;
						$_cuth  = $cutimg[1] >0 ? intval($cutimg[1]) : 100;
						$cuttype= self::_isopen('cuttype') ? 1 : 2;
						$imgsrc = self::isthumb($_bigimg, $_cutw, $_cuth, $cuttype);
					}
					$alt = self::_levdiconv($v['filename'].$r['subject'], CHARSET, 'utf-8');
					if ($_G['uid']) {
						$_width  = $v['width'] > 750 ? 750 : $v['width'];
						$fid = $_G['fid'];
						$bigimg .= <<<EOF
							<a href="javascript:;" class="dimg"><img src="{$_bigimg}" class="vbigimg" 
							fid="{$fid}" tid="{$v['tid']}" pid="{$v['pid']}" aid="{$v['aid']}" 
							width="{$_width}" id="{$v['width']}" alt="{$alt}" 
							title="{$alt}"><p class="hovertips"></p><p class="imgext opcty"></p></a>
EOF;
					}
					$imgstr .= <<<EOF
						<a href="javascript:;" class="dimg" style="width:100px; height:100px;text-align:center;overflow:hidden;">
						<img src="{$imgsrc}" alt="{$alt}" title="{$alt}" class="index{$k}" /></a>
EOF;
				}
				if ($imgstr) {
					$display = array('', 'display:none;', 'huise', '');
					if (self::_isopen('bigimg') && $_G['uid']) $display = array('display:none;', '', '', 'huise');
					if ($_G['uid']) $_control = <<<EOF
						<a href="javascript:;" onclick="imgcol(this, 1, {$k})" id="imgbtncol_{$k}" class="{$display[3]}">大图</a> | 
						<a style="color:#999">
EOF;
					$imgs[$_k] = <<<EOF
						<div style="width: 100%;" id="levimg">
							<div class="rfm pictitle">
							<table style="width:100%"><tbody>
							<tr><td style='width:10px'>&nbsp;</td><td class="tdbg">图片</td>
							<td>$_login</td>
								<td style="text-align:right;" id="imgcol_{$k}">显示方式：
								<a href="javascript:;" onclick="imgcol(this, -1, {$k})">原贴</a> | 
								<a href="javascript:;" onclick="imgcol(this, 0, {$k})" class="{$display[2]}">小图</a> | 
								{$_control}播放</a>&nbsp;</td></tr>
							</tbody></table></div>
							<div class="rfm" id="smallimg_{$k}" style="{$display[0]}">
							<table style="width:100%"><tbody>
							<tr><td style="padding:5px 0;">{$imgstr}</td></tr>
							</tbody></table></div>
							<div class="rfm vbigimgbox" id="bigimg_{$k}" dataid="{$k}" style="{$display[1]}">
							<table style="width:100%"><tbody>
							<tr><td style="padding:5px 0;">{$bigimg}</td></tr>
							</tbody></table></div>
						</div>
EOF;
				}
			}elseif (strpos($r['message'], 'src="http://') !==FALSE) {
				$display = array('', 'display:none;', 'huise', '');
				if (self::_isopen('bigimg') && $_G['uid']) $display = array('display:none;', '', '', 'huise');
				if ($_G['uid']) $_control = <<<EOF
						<a href="javascript:;" onclick="imgcol(this, 1, {$k})" id="imgbtncol_{$k}" class="{$display[3]}">大图</a> | 
						<a style="color:#999">
EOF;
				$imgs[$_k] = <<<EOF
					<div style="width: 100%; float: left;" id="levimg">
							<div class="rfm pictitle">
							<table style="width:100%"><tbody>
							<tr><td style='width:10px'>&nbsp;</td><td class="tdbg">图片</td>
							<td>$_login</td>
								<td style="text-align:right;" id="imgcol_{$k}">显示方式：
								<a href="javascript:;" onclick="imgcol(this, -1, {$k})">原贴</a> | 
								<a href="javascript:;" onclick="imgcol(this, 0, {$k})" class="{$display[2]}">小图</a> | 
								{$_control}播放</a>&nbsp;</td></tr>
							</tbody></table></div>
							<div class="rfm" id="smallimg_{$k}" style="{$display[0]}">
							<table style="width:100%"><tbody>
							<tr><td style="padding:5px 0;">{$imgstr}</td></tr>
							</tbody></table></div>
							<div class="rfm vbigimgbox" id="bigimg_{$k}" dataid="{$k}" style="{$display[1]}">
							<table style="width:100%"><tbody>
							<tr><td style="padding:5px 0;">{$bigimg}</td></tr>
							</tbody></table></div>
					</div>
EOF;
			}
			//$postlist[$k]['imagelistcount'] = 0;
		}
		
		return self::_levdiconv($imgs);
	}
	
}

class plugin_levimg {

	public static $PL_G, $_G, $PLNAME, $PLSTATIC, $PLURL, $lang = array(), $table, $navtitle, $uploadurl, $remote, $talk;

	public function __construct() {
		self::_init();
		self::$lang = self::_levlang();
	}

	public static function global_footer() {
		if ($_GET['mod'] != 'viewthread' && $_GET['id']!='levimg:levimg') return '';
		if (self::_isopen('remoteimg')) $remoteimg = "$$('.t_f img').hide();";
		$remote = self::$remote;
		$plurl  = self::$PLURL;
		$PLSTATIC = self::$PLSTATIC;
		if (self::$_G['uid']) {
			$tid = self::$_G['tid'];
			$fid = self::$_G['fid'];
			$isremote = <<<EOF
				$$('.t_f img').each(function (index, e) {
					if (!$$(this).attr('aid')) {
						var _pid = $$(this).parent().attr('id');
						  if (_pid) {
							_pid = _pid.replace('postmessage_', '');
							_src = $$(this).attr("src");
							_width = parseInt($$(this).attr('width')) > 750 ? 750 : parseInt($$(this).attr('width'));
							var _bigimg = '<a href="javascript:;" class="dimg"><img src="'+ _src +
							'" fid="{$fid}" tid="{$tid}" pid="'+ _pid +'" aid="0"'+
							'" class="vbigimg" width="'+ _width +'" id="'+ _width +'" '+
							'><p class="hovertips"></p><p class="imgext opcty"></p></a>';
							$$('#bigimg_'+ _pid + ' td').append(_bigimg);
							var _smallimg = '<a href="javascript:;" class="dimg" '+
							'style="width:100px; height:100px;text-align:center;overflow:hidden;"><img src="'+ _src +
							'" class="index'+ _pid +'" width="100" /></a>';
							$$('#smallimg_'+ _pid + ' td').append(_smallimg);
						 }
					 }
				});
EOF;
		}else {
			$isremote = <<<EOF
				$$('.guestviewthumb img').each(function (index, e) {
					if (!$$(this).attr('aid')) {
						_pid = $$(this).parent().attr('id') ? $$(this).parent().attr('id') : $$(this).parent().parent().attr('id');
						if (_pid) {
							_pid = _pid.replace('postmessage_', '');
							_src = $$(this).attr("src");
							var _smallimg = '<a href="javascript:;" class="dimg" '+
							'style="width:100px; height:100px;text-align:center;overflow:hidden;"><img src="'+ _src +
							'" onclick="'+ $$(this).attr("onclick") +'" width="100" /></a>';
							$$('#smallimg_'+ _pid + ' td').append(_smallimg);
						}
					 }
				});
				$$('.guestviewthumb').hide();
EOF;
		}
		
		$return  = <<<EOF
			  <link rel="stylesheet" href="{$PLSTATIC}css/css.css" type="text/css">
			  <script language="javascript" type="text/javascript">
						
			  		{$islabel}
					
					function imgcol(obj, type, pid) {
						$$('#imgcol_'+ pid +' a').removeClass('huise');
						$$(obj).addClass('huise');
						switch (type) {
							case 1 :
							case 2 :
								$$('#smallimg_'+ pid).hide();
								$$('#bigimg_'+ pid).show();
								$$('#postmessage_'+ pid +' img').hide();
								break;
							case -1: 
								$$('#bigimg_'+ pid).hide();
								$$('#smallimg_'+ pid).show();
								$$('#postmessage_'+ pid +' img').show();
								$$('#postmessage_'+ pid +' .guestviewthumb').show();
							default:
								$$('#bigimg_'+ pid).hide();
								$$('#smallimg_'+ pid).show();
								break;
						}
					}
					
					{$isremote}
					{$remoteimg}
					$$('.attm .mbn').hide();
			  </script>
EOF;
		return  self::_loadextjs(1).self::_levdiconv($return);
	}
	
	public static function _init() {

		global $_G;
		self::$_G     = $_G;
		self::$PLNAME = 'levimg';
		self::$PL_G   = self::$_G['cache']['plugin'][self::$PLNAME];//print_r($PL_G);

		self::$PLSTATIC = 'source/plugin/'.self::$PLNAME.'/statics/';
		self::$PLURL    = 'plugin.php?id='.self::$PLNAME.':'.self::$PLNAME;
		self::$uploadurl= self::$PLSTATIC.'upload/common/';
		self::$remote   = 'plugin.php?id='.self::$PLNAME.':l&fh='.FORMHASH.'&m=';
	}

	public static function attbasedir($remote = 0) {//X2.5 up
			if($remote) {
				$imgsrc = self::$_G['setting']['ftp']['attachurl'].'forum/';
			} else {
				$imgsrc = self::$_G['siteurl'].self::$_G['setting']['attachurl'].'forum/';
			}
		return $imgsrc;
	}
	public static function isthumb($picsource, $thumbwidth = 100, $thumbheight = 100, $type = 1) {
		$imagename = basename($picsource);
		$thumbpath = 'thumb/'.substr($imagename, 0, 2).'/thumb_'.$thumbwidth.'_'.$thumbheight.'_'.$imagename;
		$fileroot  = DISCUZ_ROOT.self::$PLSTATIC.'upload/';
		if (is_file($fileroot.$thumbpath)) return self::$PLSTATIC.'upload/'.$thumbpath;
		require_once libfile('class/image');
		$image = new image();
		setglobal('setting/attachdir', $fileroot);
		if($image->Thumb($picsource, $thumbpath, $thumbwidth, $thumbheight, $type)) {
			return self::$PLSTATIC.'upload/'.$thumbpath;
		}
	}
	public static function _levlang($string = '', $key = 0) {
		$sets  = $string ? $string : self::$PL_G['levlang'];
		$lang  = array();
		if ($sets) {
			$array = explode("\n", $sets);
			foreach ($array as $r) {
				$thisr  = explode('=', trim($r));
				$lang[trim($thisr[0])] = trim($thisr[1]);
			}
			if (!$key) {
				$lang['extscore'] = self::$_G['setting']['extcredits'][self::$PL_G['scoretype']]['title'];
				$flang = lang('plugin/levimg');
				if (is_array($flang)) $lang = $lang + $flang;
			}
		}
		return $lang;
	}

	public static function _levdiconv($string, $in_charset = 'utf-8', $out_charset = CHARSET) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = diconv($val, $in_charset, $out_charset);
			}
		} else {
			$string = diconv($string, $in_charset, $out_charset);
		}
		return $string;
	}
	
	public static function _isopen($key = 'close') {
		$isopen = unserialize(self::$PL_G['isopen']);
		if (is_array($isopen) && in_array($key, $isopen)) return TRUE;
	}
	
	public static function _loadextjs($jquery = 0) {
		global $_G;
		$js = '';
		if ($jquery && self::$_G['loadjquery'] !=1) {
			$_G['loadjquery'] = 1;
			$js .= '<script language="javascript" type="text/javascript" src="'.self::$PLSTATIC.'jquery.min.js"></script>
					 <script language="javascript" type="text/javascript">var $$ = jQuery.noConflict();</script>';
		}
		if (self::$_G['loadartjs'] !=1) {
			$_G['loadartjs'] = 1;
			$js .= '<script type="text/javascript" src="'.self::$PLSTATIC.'dialog417/dialog.js?skin=default"></script>
				  	<script type="text/javascript" src="'.self::$PLSTATIC.'dialog417/plugins/iframeTools.js"></script>';
		}
		return $js;
	}
	
	public static function _galadate($time, $show = 0) {
		if (!is_file(DISCUZ_ROOT.'source/plugin/levimg/ext/lunar.class.php')) return $time;
		if (strpos($time, '|') !==FALSE) {
			require_once DISCUZ_ROOT.'source/plugin/levimg/ext/lunar.class.php';
			$lunar = new Lunar();
			$_time = substr(strstr($time, '|'), 1);
			$_tarr = explode('-', $_time);
			$_data = $lunar->convertLunarToSolar(date('Y', TIMESTAMP), intval($_tarr[0]), intval($_tarr[1]));
			if ($show) return $time.'('.trim($_data[1]).'-'.trim($_data[2]).')';
			$time  = trim($_data[1]).'-'.trim($_data[2]);
		}
		return $time;

	}
	
}








