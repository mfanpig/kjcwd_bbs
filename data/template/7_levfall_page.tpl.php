<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
 <?php if(is_array($lists)) foreach($lists as $k => $v) { if($k < lev_fall::$PL_G['page']) { $tidimg = C::t('forum_attachment_n')->fetch_max_image('tid:'.$v[tid], 'tid', $v[tid]);?><div class="item masonry_brick">
<div class="item_t">
<?php if(!empty($tidimg)) { ?>
<div class="img">
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>">
<img width="210" src="data/attachment/forum/<?php echo $tidimg['attachment'];?>" /></a>
<?php if($v['price']) { ?><span class="price extprice"><?php echo $lev_lang['rmb'];?><?php echo $v['price'];?></span><?php } ?>
<div class="btns">
<a onclick="art.dialog({padding:0,title:'<?php echo $lev_lang['big'];?>',content:'<img src=\'data/attachment/forum/<?php echo $tidimg['attachment'];?>\'>'});" href="javascript:;" class="img_album_btn"><?php echo $lev_lang['big'];?></a>
</div>
</div>
<?php } ?>
<div style="font-size:12px;">
<table width="210" cellspacing="0">
<tr><td rowspan="2" width="33" valign="top"><span class="avatarimg"><?php echo avatar($v[authorid], 'small');?></span></td>
<td align="left"><a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" style="height:15px;display:block;overflow:hidden;"><?php echo $v['author'];?></a></td>
<td align="right"><span style="color:#aaa;padding-right:2px;"><?php echo dgmdate($v['dateline'], 'u');?></span></td></tr>
<tr><td colspan="2"><p style="color:#aaa;width:177px;height:16px;overflow:hidden;"><?php echo $v['subject'];?></p></td></tr>
</table>
</div>
<?php if(lev_fall::$PL_G['show_reply']) { $posts = C::t('forum_post')->fetch_all_by_tid(0, $v[tid], TRUE, 'DESC', 0, lev_fall::$PL_G['show_reply']);?><?php if(is_array($posts)) foreach($posts as $r) { if($r['position']!=1 && strpos($r['message'], '[/') ===false) { ?>
<div class="title replyc">
<table width="210" cellspacing="0">
<tr><td rowspan="2" width="33"><span class="avatarimg"><?php echo avatar($r[authorid], 'small');?></span></td>
<td align="left"><a href="home.php?mod=space&amp;uid=<?php echo $v['authorid'];?>" style="height:15px;display:block;overflow:hidden;"><?php echo $r['author'];?></a></td>
<td align="right"><p style="color:#aaa;padding-right:2px;height:15px;overflow:hidden;"><?php echo dgmdate($r['dateline'], 'u');?></p></td></tr>
<tr><td colspan="2"><p style="color:#aaa;width:177px;height:16px;overflow:hidden;"><?php echo $r['message'];?></p></td></tr>
</table>
</div>
<?php } } } ?>
</div>
<div class="item_b clearfix">
<div class="items_likes fl" style="border:none;">
<a href="javascript:;" onclick="showWindow('favorite', 'home.php?mod=spacecp&ac=favorite&type=thread&id=<?php echo $v['tid'];?>');" class="like_btn"></a>
<em class="bold"><?php echo $v['favtimes'];?></em>
</div>
<div class="items_comment fr">
<em class="bold"><?php echo $v['replies'];?></em>
<a href="javascript:;" onclick="showWindow('reply', 'forum.php?mod=post&action=reply&fid=<?php echo $v['fid'];?>&tid=<?php echo $v['tid'];?>')"><?php echo $lev_lang['comment'];?></a> | 
<a href="forum.php?mod=viewthread&amp;tid=<?php echo $v['tid'];?>"><?php echo $lev_lang['more'];?></a>
</div>
</div>
</div><!--item end-->
<?php } } ?>