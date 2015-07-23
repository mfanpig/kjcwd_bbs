<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<table class="tb tb2 ">
<tr><th colspan="15" class="partition">说明</th></tr>
<tr><td class="tipsblock" colspan="15">若安装后第二天还是无提交历史，可能是插件冲突引起的，可尝试停用插件定位导致冲突的插件。</td></tr>
<tr class="header">
        <th>提交日期</th>
        <th>当日提交数</th>
        <th>累计提交数</th>
</tr><?php if(is_array($loglist)) foreach($loglist as $row) { ?><tr class="hover">
    <td><?php echo $row['ctime'];?></td>
    <td><?php echo $row['urlnum'];?></td>
    <td><?php echo $row['urlcount'];?></td>
</tr>
<?php } ?>
</table>