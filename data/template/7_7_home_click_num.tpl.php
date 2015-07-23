<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); $clicknum = 0;?><?php if(is_array($clicks)) foreach($clicks as $key => $value) { $clicknum = $clicknum + $value['clicknum'];?><a class="like" href="home.php?mod=spacecp&amp;ac=click&amp;op=add&amp;clickid=<?php echo $key;?>&amp;idtype=<?php echo $idtype;?>&amp;id=<?php echo $id;?>&amp;hash=<?php echo $hash;?>&amp;handlekey=clickhandle" id="click_<?php echo $idtype;?>_<?php echo $id;?>_<?php echo $key;?>" onclick="showWindow(this.id, this.href, 'get', 0);"> <span><?php echo $value['name'];?></span> 
<span id="like-num"><?php echo $value['clicknum'];?></span> 
</a> 

<?php } ?> 

<script type="text/javascript">
function errorhandle_clickhandle(message, values) {
if(values['id']) {
  showCreditPrompt();
  $('like-num').innerHTML = parseInt($('like-num').innerHTML) + 1;
  ajaxget('home.php?mod=spacecp&ac=click&op=show&clickid='+values['clickid']+'&idtype='+values['idtype']+'&id='+values['id'], 'click_div');
}
}
</script>
