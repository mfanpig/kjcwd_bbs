<?php
/**
 *  [dz_手机管理(superman_dz_manage.{modulename})] (C)2012-2099 Powered by 时创科技.
 *  Version: 2.0
 *  Date: 2015-05-23 11:34:13
 */
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('SC_DEBUG', false);
if (SC_DEBUG) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED ^ E_STRICT);
}

class plugin_superman_dz_manage
{
	protected $setting;
	protected $config;

	public function plugin_superman_dz_manage()
	{
		global $_G;
		if (!$_G['cache']['plugin']['superman_dz_manage']) {
			loadcache('plugin');	
		}
		$this->config = $_G['cache']['plugin']['superman_dz_manage'];
	}
}
