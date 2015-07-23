<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<p class="pbm bbda xi1">您已将本站帐号 <strong><?php echo $_G['member']['username'];?></strong> 与微信绑定</p>
<br />

<?php if($_G['wechatuser']['isregister']) { ?>
<h2>
<a href="javascript:;" onclick="display('unbind');" class="xi2">设置独立密码</a>
</h2>

<form id="wechatform" method="post" autocomplete="off" action="plugin.php?id=wechat:spacecp">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<div class="password">
<table cellspacing="0" cellpadding="0" class="tfm">
<tr>
<th><label>新密码</label></th>
<td><input type="password" name="newpassword1" size="30" class="px p_fre" tabindex="1" /></td>
<td class="tipcol"></td>
</tr>
<tr>
<th><label>确认密码</label></th>
<td><input type="password" name="newpassword2" size="30" class="px p_fre" tabindex="2" /></td>
<td class="tipcol"></td>
</tr>
<tr>
<th></th>
<td>
<button type="submit" name="resetpwsubmit" value="yes" class="pn pnc"><strong>提交</strong></button>
</td>
</tr>
</table>
</div>
</form>
<br />
<?php } ?>

<h2>
<a href="javascript:;" onclick="display('unbind');" class="xi2">解除已绑定帐号？</a>
</h2>

<div id="unbind" style="display:none;">
<form id="wechatform" method="post" autocomplete="off" action="plugin.php?id=wechat:spacecp">
<input type="hidden" name="formhash" value="<?php echo FORMHASH;?>" />
<?php if($_G['wechatuser']['isregister']) { ?>
<p class="mtm mbm">
请设置独立密码后再解除绑定关系
</p>
<?php } else { ?>
<p class="mtm mbm">
解除已绑定帐号？
</p>
<button type="submit" name="unbindsubmit" value="yes" class="pn pnc"><strong>确认解除</strong></button>
<?php } ?>
</form>
</div>

</form>