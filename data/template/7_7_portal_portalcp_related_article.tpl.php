<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('portalcp_related_article');?><?php include template('common/header'); if(($op == 'manual')) { if($ra) { ?>
<li id="<?php echo $ra['aid'];?>">
<em><?php echo $ra['title'];?></em>
<span class="xg1">
<a href="javascript:;" onclick="uparticle(<?php echo $ra['aid'];?>);" title="上移"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="上移" /></a>
<a href="javascript:;" onclick="downarticle(<?php echo $ra['aid'];?>);" title="下移"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="下移" /></a>
<a href="javascript:;" onclick="delarticle(<?php echo $ra['aid'];?>);" title="删除"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="删除" /></a>
</span>
</li>
<?php } } elseif(($op == 'get')) { if(is_array($articlelist)) foreach($articlelist as $list) { ?><li id="<?php echo $list['aid'];?>">
<em><?php echo $list['title'];?></em>
<span class="xg1">
<a href="javascript:;" onclick="uparticle(<?php echo $list['aid'];?>);" title="上移"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="上移" /></a>
<a href="javascript:;" onclick="downarticle(<?php echo $list['aid'];?>);" title="下移"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="下移" /></a>
<a href="javascript:;" onclick="delarticle(<?php echo $list['aid'];?>);" title="删除"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="删除" /></a>
</span>
</li>
<?php } } elseif(($op == 'search')) { if(is_array($articlelist)) foreach($articlelist as $list) { ?><li>
<input type="checkbox" name="article" id="article_<?php echo $list['aid'];?>_pc" class="pc" value="<?php echo $list['aid'];?>" onclick="getarticlenum();"/>
<label for="article_<?php echo $list['aid'];?>_pc" id="article_<?php echo $list['aid'];?>"><?php echo $list['title'];?></label>
</li>
<?php } } elseif(($op == 'add')) { if(is_array($articlelist)) foreach($articlelist as $ra) { ?><li id="raid_li_<?php echo $ra['aid'];?>">
<input type="hidden" name="raids[]" value="<?php echo $ra['aid'];?>" size="5">
<a href="<?php echo fetch_article_url($ra);; ?>" target="_blank"><?php echo $ra['title'];?></a>
(文章 ID: <?php echo $ra['aid'];?>)
<a href="javascript:;" onclick="raid_delete(<?php echo $ra['aid'];?>);" class="xg1">删除</a>
</li>
<?php } } else { ?>
<h3 class="flb">
<em>管理相关文章</em>
<?php if($_G['inajax']) { ?><span><a href="javascript:;" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');" class="flbc" title="关闭">关闭</a></span><?php } ?>
</h3>
<div class="c bart">
<div class="pns cl">
<div class="y">
文章 ID:
<input type="text" name="manualid" id="manualid" class="px vm" value="0" size="10" />&nbsp;
<button type="button" name="raid_button" class="pn" value="false" onclick="manualadd();"><em>手工添加</em></button>
</div>
<?php echo $category;?>&nbsp;
<input type="text" name="searchkey" id="searchkey" class="px vm" value="<?php echo $searchkey;?>" size="10" />&nbsp;
<button type="button" name="search_button" class="pn vm" value="false" onclick="articlesearch();"><em>搜索</em></button>
</div>
<div class="cl">
<div class="z" id="chkalldiv">
<p class="mtm mbn cl">
<span class="xg1 y">待选(<span id="articlenum">0</span>/<span id="articlenumall"><?php echo $count;?></span> 最多显示50条)</span>
<label class="chkall"><input type="checkbox" name="chkall" id="chkall" class="pc" value="" onclick="selectall();"/>全选</label>
</p>
<ul id="articlelist" class="bartl"><?php if(is_array($articlelist)) foreach($articlelist as $list) { ?><li>
<input type="checkbox" name="article" id="article_<?php echo $list['aid'];?>_pc" class="pc" value="<?php echo $list['aid'];?>" onclick="getarticlenum();"/><label for="article_<?php echo $list['aid'];?>_pc" id="article_<?php echo $list['aid'];?>"><?php echo $list['title'];?></label>
</li>
<?php } ?>
</ul>
</div>
<div class="barto">
<button name="choosebutton" class="pn" onclick="choosearticle();" title="将选中项标记为已选"><em>&gt;</em></button>
</div>
<div class="y">
<p class="mtm mbn">已选(<strong id="selectednum" class="xi1">0</strong>)</p>
<ul id="selectedarticle" class="bartl"></ul>
</div>
</div>
</div>
<p class="o pns">
<input type="hidden" id="selectedarray" name="selectedarray" value="" />
<?php if($_GET['update']) { ?>
<input type="hidden" id="update" name="update" value="1" />
<?php } ?>
<button type="submit" name="dsf" class="pn pnc" onclick="addrelatearticle();"><span>确定</span></button>
<button type="reset" name="dsf" class="pn" onclick="hideWindow('<?php echo $_GET['handlekey'];?>');"><em>取消</em></button>
</p>

<script type="text/javascript" reload="1">
function choosearticle() {
var article = document.getElementsByName("article");
for(var i = 0; i < article.length; i++){
if(article[i].checked) {
var choosed = $("article_"+article[i].value).innerHTML;
choosed ='<li id="'+article[i].value+'"><em>'+choosed+'</em><span class="xg1"><a href="javascript:;" onclick="uparticle('+article[i].value+');" title="上移"><img class="vm" src="<?php echo IMGDIR;?>/icon_top.gif" alt="上移" /></a> <a href="javascript:;" onclick="downarticle('+article[i].value+');" title="下移"><img class="vm" src="<?php echo IMGDIR;?>/icon_down.gif" alt="下移" /></a> <a href="javascript:;" onclick="delarticle('+article[i].value+');" title="删除"><img class="vm" src="<?php echo IMGDIR;?>/data_invalid.gif" alt="删除" /></a></span></li>';
if(!$(article[i].value)) {
$("selectedarticle").innerHTML += choosed;
}
}
}
updatearticlearray();
}
function uparticle(id) {
var lastid = getdivid(id, 'last');
if(lastid) {
var lastdiv = $(lastid);
        var div = $(id);
$("selectedarticle").insertBefore(div,lastdiv);
}
updatearticlearray();
}
function downarticle(id) {
var nextid = getdivid(id, 'next');
if(nextid) {
var nextdiv = $(nextid);
        var div = $(id);
$("selectedarticle").insertBefore(nextdiv,div);
}
updatearticlearray();
}
function delarticle(id) {
var div = $(id);
div.parentNode.removeChild(div);
updatearticlearray();
}
function updatearticlearray() {
var list = document.getElementById("selectedarticle").getElementsByTagName("li");
var str = '';
for(var i = 0; i < list.length; i++)
{
if(str == '') {
str = list[i].id;
} else {
str = str + ',' + list[i].id;
}

}
$('selectedarray').value = str;
$('selectednum').innerHTML = list.length;
}
function getdivid(id,type) {
var str = $('selectedarray').value;
    var arr = new Array();
var rstr = '';
arr = str.split(",");

for (var i = 0; i < arr.length; i++) {
if (arr[i] == id) {
if(type == 'last') {
if(arr[i-1]) {
rstr = arr[i-1];
}
} else if(type == 'next') {
if(arr[i+1]) {
rstr = arr[i+1];
}
}
break;
}
}
return rstr;
}
function manualadd() {
var manualid = $('manualid').value;
if($(manualid)) {
alert('该文章已经添加过了');
return false;
}
var url = 'portal.php?mod=portalcp&ac=related&op=manual&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&manualid='+manualid;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('selectedarticle').innerHTML += s;
updatearticlearray();
} else {
alert('没有找到指定的文章');
return false;
}
});
}
function articlesearch() {
var searchkey = $('searchkey').value;
var searchcate = $('searchcate').value;
var url = 'portal.php?mod=portalcp&ac=related&op=search&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&searchkey='+searchkey+'&searchcate='+searchcate;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$('articlelist').innerHTML = s;
getarticlenum();
} else {
$('articlelist').innerHTML = '';
getarticlenum();
return false;
}
});

}
function getarticlenum() {
var article = document.getElementsByName("article");
for(var i = 0, j = 0; i < article.length; i++){
if(article[i].checked) {
j++;
}
}
$('articlenum').innerHTML = j;
$('articlenumall').innerHTML = article.length;
}
function addrelatearticle() {
var relatedid = $("selectedarray").value;
if(relatedid) {
var url = 'portal.php?mod=portalcp&ac=related&op=add&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&relatedid='+relatedid;
if($('update')) {
url += '&update=1';
}
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
if($('portalview')) {
showDialog('操作成功 ', 'right', '', 'window.location.reload();');
} else {
$('raid_div').innerHTML = '';
$('raid_div').innerHTML = s;
}
}
});
} else {
$('raid_div').innerHTML = '';
}
hideWindow('<?php echo $_GET['handlekey'];?>');
}
function getrelatedarticle() {
var input = document.getElementById("raid_div").getElementsByTagName("input");
if(input) {
var id = '';
for(var i = 0;i < input.length;i++)
{
if(id) {
id = id + ',' + input[i].value;
} else {
id = input[i].value;
}
}
if(id != '') {
var url = 'portal.php?mod=portalcp&ac=related&op=get&catid=<?php echo $catid;?>&aid=<?php echo $aid;?>&inajax=1&id='+id;
var x = new Ajax();
x.get(url, function(s){
s = trim(s);
if(s) {
$("selectedarray").value = id;
$('selectedarticle').innerHTML = s;
$('selectednum').innerHTML = input.length;
}
});
}

} else {
return true;
}
}
function selectall() {
var input = document.getElementById("chkalldiv").getElementsByTagName("input");
var checkall = 'chkall';
count = 0;
for(var i = 0; i < input.length; i++) {
var e = input[i];
if(e.name && e.name != checkall) {
e.checked = input[checkall].checked;
if(e.checked) {
count++;
}
}
}
return count;
}
getrelatedarticle();
</script>
<?php } include template('common/footer'); ?>