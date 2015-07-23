<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script src="source/plugin/baidusubmit/template/jquery-1.8.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();    
jQuery(document).ready(function(){
    jQuery('#cseui').attr("href","<?php echo $znUrl;?>");
    jQuery('.img-question').mouseover(function(){
        jQuery('#cseTips').show();
    }).mouseleave(function(){
        jQuery('#cseTips').hide();
    });
    jQuery('#closeAuto').click(function(){
        var autoType = '<?php echo $auto;?>';
        var url = '';
        if (autoType === '1') {
            url = '<?php echo $baseUrl;?>' + '&type=manual';
        } else if (autoType === '2') {
            url = '<?php echo $baseUrl;?>' + '&type=closeAuto';
        }
        jQuery.getJSON(url,function(data){
            if (data.status) {
                window.location.reload();
            } else {
                alert("启用失败，请重试");
                window.location.reload();
            }
        });
    })
    jQuery('#userSitemap').click(function(){
        if (jQuery(this).attr('checked') === 'checked'){
            var url = '<?php echo $openUserSitemapUrl;?>';
            if (url){
                jQuery.getJSON(url,function(data){
                    if (data.status === 1) {
                        window.location.reload();
                    } else {
                        alert("启用失败，请重试");
                        window.location.reload();
                    }
                });
            }  
        } else if (jQuery(this).attr('checked') === undefined){
            var url = '<?php echo $closeUserSitemapUrl;?>';
            if (url){
                jQuery.getJSON(url,function(data){
                    if (data.status === 1) {
                        window.location.reload();
                    } else {
                        alert("停用失败，请重试或者卸载插件");
                        window.location.reload();
                    }
                });
            }            
        }
    })
    jQuery('#cse_full').click(function(){
        var engineId = jQuery('#engine').val();
        var baiducse = '<?php echo $baiducse;?>';
        var url = '';
        if (engineId && baiducse === '1'){
            url = '<?php echo $openUrl;?>' + '&cse_type=2';
        } else if (engineId && baiducse === '2'){
            url = '<?php echo $openUrl;?>' + '&cse_type=1';
        }
        if (url){
          jQuery.getJSON(url,function(data){
              if (data.status) {
                  window.location.reload();
              } else {
                  alert("启用失败，请重试");
                  window.location.reload();
              }
          });
        }        
    })
    jQuery('#openlogin').click(function(){
        parent.location.href='<?php echo $login;?>';
    })
    jQuery('#opencse').click(function (){
        var engineId = jQuery('#engine').val();
        var baiducse = '<?php echo $baiducse;?>';
        if (engineId && baiducse === '0'){
              var url = '<?php echo $openUrl;?>';
              if (url){
                jQuery.getJSON(url,function(data){
                    if (data.status) {
                        window.location.reload();
                    } else {
                        alert("启用失败，请重试");
                        window.location.reload();
                    }
                });
              }
        }
    });
  jQuery('#closecse').click(function(){
      var url = '<?php echo $closeUrl;?>';
      if (url){
        jQuery.getJSON(url,function(data){
            if (data.status) {
                window.location.reload();
            } else {
                alert("停用失败，请重试或者卸载插件");
                window.location.reload();
            }
        });
      } 
  });
});

function ajaxpost2(formid, showid, waitid, submitbtn) {
    var waitid = typeof waitid === 'undefined' || waitid === null ? showid : (waitid !== '' ? waitid : '');
    var showidclass = !showidclass ? '' : showidclass;
    var curform = $(formid);

    var action = curform.getAttribute('action');
    action = hostconvert(action);
    curform.action = action.replace(/\&inajax\=1/g, '')+'&inajax=1';

    submitbtn.disabled = true;

    $(showid).innerHTML = '';

    var x = new Ajax('HTML', waitid);
    x.showLoading();
    x.showId = $(showid);

    var poststr = 'siteurl=' + encodeURIComponent(curform.elements['siteurl'].value) + '&auth=1';

    x.post(curform.action, poststr, function(s, x) {
        s = eval('(' + s + ')');
        ajaxinnerhtml($(showid), s.msg);
        if (s.error === 0) {
            $(showid).className = authStatus.success.msgclass;
            submitbtn.value = authStatus.success.btntext;
            $('siteurl').disabled = true;
            $('siteurl').className = authStatus.success.inputclass;
            //打开全局
            isExist = 1;
            window.location.reload();
        } else {
            $(showid).className = authStatus.failed.msgclass;
            submitbtn.innerHTML = authStatus.failed.btntext;
            $('siteurl').disabled = false;
            $('siteurl').className = authStatus.failed.inputclass;
        }
        submitbtn.disabled = false;

        doane();
    });

    return false;
}
var isExist = <?php if($keyExist) { ?>1<?php } else { ?>0<?php } ?>;

var authStatus = {
    'success':{
        'btntext': '重新验证',
        'msgclass': '',
        'inputclass': 'dsclass'
    },
    'failed':{
        'btntext': '验证',
        'msgclass': 'errormsg',
        'inputclass': ''
    }
};

function formsubmit(form)
{
    if (1 == isExist) {
        $('submit').value = '验证';
        $('siteurl').disabled = false;
        $('siteurl').className = '';
        $('returnmessage').innerHTML = '';
        isExist = 0;
    } else {
        ajaxpost2('authform','returnmessage', 'xwaitid', $('submit'));
    }
    return false;
}
</script>
<input type="hidden" id="engine" value="<?php echo $engine;?>"/>
<table class="tb tb2 " id="tips">
<tbody>
    <tr><th class="partition">简介 & 说明</th></tr>
    <tr>
        <td class="tipsblock" s="1">
            <ul id="tipslis">
                <li>安装百度结构化数据提交插件后，能又快又全的向百度提交网页及内容，有助于：</li>
                <li>1）百度 Spider 更好地了解您的网站，优化收录</li>
                <li>2）网站在百度搜索上得到更好展现</li>
                <li>1.	您还可以到
                    <a target="_blank" href="http://zhanzhang.baidu.com/">百度站长平台</a>提交：
                    <a target="_blank"  href="http://zhanzhang.baidu.com/sitemap/index">sitemap</a>
                    |<a target="_blank" href="http://zhanzhang.baidu.com/schema/index">结构化数据</a>
                    |<a target="_blank" href="http://zhanzhang.baidu.com/badlink/index">死链提交</a>
                </li>
                <li>2.	使用过程中，有任何意见或建议请提至
                    <a target="_blank" href="http://zhanzhang.baidu.com/feedback/index">百度站长反馈中心</a>
                </li>
            </ul>
        </td>
    </tr>
</tbody>
</table>

<form method="post" id="authform" action="<?php echo $url;?>&auth=1" onsubmit="return formsubmit(this);">
<table class="tb tb2 ">
    <tr>
        <th colspan="15" class="partition">站点验证</th></tr>
    <tr>
        <td colspan="2" class="td27" s="1">论坛网址：</td>
    </tr>
    <tr class="noborder">
        <td class="vtop rowform"><input type="text" name="siteurl" id="siteurl" style="width:250px" value="<?php echo $siteUrl;?>" <?php if($keyExist) { ?>disabled="disabled" class="dsclass"<?php } ?> /></td>
    </tr>
    <tr>
        <td colspan="15">
            <div class="fixsel"><input type="submit" class="btn" id="submit" name="submit" title="&#25353;&#32;&#69;&#110;&#116;&#101;&#114;&#32;&#38190;&#21487;&#38543;&#26102;&#25552;&#20132;&#24744;&#30340;&#20462;&#25913;" value="<?php if(!$keyExist) { ?>验证<?php } else { ?>重新验证<?php } ?>"> <span id="returnmessage"></span><span id="xwaitid"></span></div>
        </td>
    </tr>
</table>
</form>

<form method="post" action="<?php echo $url;?>">
    <input type="hidden" name="ping" value="1" />
    <table class="tb tb2">
        <tr><th colspan="15" class="partition">实时推送</th></tr>
        <tr>
            <td class="vtop rowform">
                <ul>
                    <li <?php if($openping) { ?>class="checked"<?php } ?>><input type="radio" class="radio" name="openping" value="1" <?php if($openping) { ?>checked="checked"<?php } ?> />开启</li>
                    <li <?php if(!$openping) { ?>class="checked"<?php } ?>><input type="radio" class="radio" name="openping" value="0" <?php if(!$openping) { ?>checked="checked"<?php } ?> />关闭</li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><input type="submit" class="btn" name="submit" value="保存" /></td>
        </tr>
    </table>
</form>
<?php if($token) { ?>
    <table class="tb tb2">
        <tr><th colspan="15" class="partition">更多功能</th></tr>
        <?php if(!$baiducse) { ?>
            <tr>
                <td class="vtop rowform" style="height:auto">
                    <?php if($engine) { ?>
                        <ul style="margin-bottom: 5px">本插件已集成百度站内搜索功能（包括搜帖子/搜用户/搜版块，<a href="http://zn.baidu.com/cse/wiki2/help?wid=a" target="_blank">查看介绍</a>），点击即可<a id="opencse" href="###">一键开启</a></ul>
                    <?php } else { ?>
                        <ul style="margin-bottom: 5px">本插件已集成百度站内搜索功能（包括搜帖子/搜用户/搜版块，<a href="http://zn.baidu.com/cse/wiki2/help?wid=a" target="_blank">查看介绍</a>），点击<a id="openlogin" href="###">登录</a>后即可开启</ul>
                    <?php } ?>
                </td>
            </tr> 
        <?php } ?>
    </table>
    <?php if($baiducse == 1) { ?>
        <div style="clear:both;margin: 5px 0"></div>
        <?php if($auto == 2) { ?>
        <img style="float: left;margin-right: 10px" src="source/plugin/baidusubmit/template/notice.jpg"/>
        <?php } else { ?>
        <img style="float: left;margin-right: 10px" src="source/plugin/baidusubmit/template/right.png"/>
        <?php } ?>
        <div style="float: left;width: 95%;">
            <?php if($auto == 1 && ($lH || $lm)) { ?>
            <ul style="margin:5px 0;">正在抓取和收录您的论坛数据，为保证搜索体验，百度站内搜索将在<strong style="color:#990000"><?php echo $lH;?></strong>小时<strong style="color:#990000"><?php echo $lm;?></strong>分钟后自动开启</ul>
            <li class="tipsblock cseshuoming2">如果希望手动开启，请点击<a href="###" id='closeAuto'>停止自动开启</a></li>
            <li class="tipsblock cseshuoming2"><input style="vertical-align:middle" type="checkbox" id="userSitemap" <?php if($userSitemap) { ?>checked<?php } ?>/>提交论坛的用户名、头像、简介等信息，用于“搜用户”功能</li>
            <li class="tipsblock cseshuoming2">更多帮助信息，请点击<a href='http://zn.baidu.com/cse/wiki2/help?wid=j' target="_blank">站内搜索Discuz!插件帮助</a></li>
            <?php } elseif($auto == 2) { ?>
            <ul style="margin:5px 0;">正在抓取和收录您的论坛数据，点击<a id="closeAuto" href="###">一键开启</a>即可立刻开始使用百度站内搜索</ul>
            <li class="tipsblock cseshuoming2">数据收录不充分会影响搜索效果，您可以登录<a href="http://zn.baidu.com/" target="_blank">百度站内搜索</a>，在“搜索框管理”的“行业模板数据提交”功能中查看数据更新情况，或点击<a href="###" id='cseui' target="_blank">效果测试页面</a>进行测试。</li>
            <li class="tipsblock cseshuoming2"><input style="vertical-align:middle" type="checkbox" id="userSitemap" <?php if($userSitemap) { ?>checked<?php } ?>/>提交论坛的用户名、头像、简介等信息，用于“搜用户”功能</li>            
            <li class="tipsblock cseshuoming2">更多帮助信息，请点击<a href='http://zn.baidu.com/cse/wiki2/help?wid=j' target="_blank">站内搜索Discuz!插件帮助</a></li>
            <?php } else { ?>
            <ul style="margin:5px 0;position:relative;">您已启用百度站内搜索-兼容版<img class="img-question" style="vertical-align:middle;margin-left: 3px" src="source/plugin/baidusubmit/template/bl_notice.jpg"/>，进行更多个性化设置请点击<a href="http://zn.baidu.com/" target="_blank">设置</a>
            <div id="cseTips" class="colorTip tip_style colorTipContainer" style="left: 50.5px; top: -128px;display: none">兼容版不会改变原有的搜索框样式，并保留搜索下拉菜单（“帖子”和“用户”使用百度站内搜索，其他频道使用原有搜索）。但无法开启搜索提示（即搜索词自动填充）、划词搜索、搜索词推荐、内文提词、移动端适配等高级功能。<span class="pointyTipShadow"></span><span class="pointyTip"></span></div>
            </ul>
            <li class="tipsblock cseshuoming2">如需切换回原有站内搜索功能，请点击<a href="###" id='closecse'>停用</a></li>
            <li class="tipsblock cseshuoming2">注意：兼容版无法使用搜索提示、移动适配等高级功能，您可以点击<a href="###" id='cse_full'>切换到完整版</a>。如果您的站点使用的不是Discuz!默认模板，切换到完整版后可能会出现样式兼容问题，原有搜索框不再显示。您可以在<a href="http://zn.baidu.com/" target="_blank">百度站内搜索</a>后台的“搜索框管理”页面修改搜索框样式，以实现样式兼容。</li>            
            <li class="tipsblock cseshuoming2"><input style="vertical-align:middle" type="checkbox" id="userSitemap" <?php if($userSitemap) { ?>checked<?php } ?>/>提交论坛的用户名、头像、简介等信息，用于“搜用户”功能</li>
            <li class="tipsblock cseshuoming2">更多帮助信息，请点击<a href='http://zn.baidu.com/cse/wiki2/help?wid=j' target="_blank">站内搜索Discuz!插件帮助</a></li>
            <?php } ?>
        </div>
    <?php } elseif($baiducse == 2) { ?>
        <div style="clear:both;margin: 5px 0"></div>
        <img style="float: left;margin-right: 10px" src="source/plugin/baidusubmit/template/right.png"/>
        <div style="float: left;width: 95%;">
            <ul style="margin:5px 0;position:relative;">您已启用百度站内搜索-完整版<img class="img-question" style="vertical-align:middle;margin-left: 3px" src="source/plugin/baidusubmit/template/bl_notice.jpg"/>，进行更多个性化设置请点击<a href="http://zn.baidu.com/" target="_blank">设置</a>
            <div id="cseTips" class="colorTip tip_style colorTipContainer" style="left: 50.5px; top: -92px;display: none">完整版可以支持开启搜索提示、热搜词、划词搜索、搜索词推荐、内文提词、移动端适配等高级功能，但在非Discuz!默认模板网站上可能会出现样式兼容问题。<span class="pointyTipShadow"></span><span class="pointyTip"></span></div>
            </ul>
            <li class="tipsblock cseshuoming2">如需切换回原有站内搜索功能，请点击<a href="###" id='closecse'>停用</a></li>
            <li class="tipsblock cseshuoming2">注意：完整版支持开启搜索提示、移动端适配等功能，但在非Discuz!默认模板网站上可能会出现样式兼容问题，原有搜索框不再显示。如出现样式兼容问题，您可以在<a href="http://zn.baidu.com/" target="_blank">百度站内搜索</a>后台的“搜索框管理”页面修改搜索框样式，或点击<a href="###" id='cse_full'>切换回兼容版</a>。</li>
            <li class="tipsblock cseshuoming2"><input style="vertical-align:middle" type="checkbox" id="userSitemap" <?php if($userSitemap) { ?>checked<?php } ?>/>提交论坛的用户名、头像、简介等信息，用于“搜用户”功能</li>
            <li class="tipsblock cseshuoming2">更多帮助信息，请点击<a href='http://zn.baidu.com/cse/wiki2/help?wid=j' target="_blank">站内搜索Discuz!插件帮助</a></li>
        </div>    
    <?php } } ?>
<div style="clear:both;margin-bottom: 10px"></div>
<?php if($msgType == 1) { ?>
<div id="cseerror2" class="errormsg">
    <ul>登录异常，请重新登录</ul>
</div>
<?php } elseif($msgType == 2) { ?>
<div id="cseerror2" class="errormsg">
    <ul>鉴权失败，请重新验证</ul>
</div>
<?php } elseif($msgType == 3) { ?>
<div id="cseerror2" class="errormsg">
    <ul>鉴权失败，无法开启，请重装插件</ul>
</div>
<?php } elseif($msgType == 4) { ?>
<div id="cseerror2" class="errormsg">
    <ul>更新状态失败，请重装插件</ul>
</div>
<?php } elseif($msgType == 5) { ?>
<div id="cseerror2" class="errormsg">
    <ul>创建搜索引擎失败，请重试</ul>
</div>
<?php } ?>
<style type="text/css">
.floattop {
top: auto;
}
.desc{
width:80%;
font-size:12px;
margin-bottom:10px;
margin-top:5px;
}
.showclass{
}
.dsclass {
background-color: #888888;
}
.errormsg {
color: #FF0000;
}
.cseshuoming2 {
color: #999999;
padding-left: 10px;
}
.cseshuoming2 a{
color: #999999;
text-decoration:underline;
}

.img-question{
    
}

/*tip气泡*/
.colorTip{
        display:none;
        position:absolute;
        padding:6px;
        color:#C8660E;

        background-color:#FEF3CC;
        border:1px solid #FEDFB7;
        /*text-indent: 2em;*/
        
        font-size:12px;
        font-style:normal;
        line-height:18px;
        width:230px;
        text-decoration:none;
        white-space:normal;
        word-break:break-all;
        -moz-border-radius:1px;
        -webkit-border-radius:1px;

         box-shadow: 0.1px 2px 4px #D9D9D9;  
        -moz-box-shadow: 0.1px 2px 4px #D9D9D9;
        -webkit-box-shadow: 0.1px 2px 4px #D9D9D9;

        border-radius:1px;
        z-index:1000;
}

.pointyTip,.pointyTipShadow{
        border:6px solid transparent;
        _border:6px solid #dddddd;

        bottom:-12px;
        height:0;
        left:50%;
        margin-left:-6px;
        position:absolute;
        width:0;
        font-size: 0;
        line-height: 0;
        _filter:chroma(color=#dddddd);
        z-index:1001;
        
}

.pointyTipShadow{
        border-width:7px;
        bottom:-14px;
        _bottom:-15px;
        margin-left:-7px;
}

.colorTipContainer{
        _zoom:1; 
        text-decoration:none !important;
}

.tip_style .pointyTip{ border-top-color:#FEF3CC;}
.tip_style .pointyTipShadow{ border-top-color:#E2E2E2;}
</style>