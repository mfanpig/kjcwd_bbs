<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('list_8');
block_get('139,138,142,141,143,140,144');?><?php include template('common/header'); $list = array();?><?php $wheresql = category_get_wheresql($cat);?><?php $list = category_get_list($cat, $wheresql, $page);?><link rel="stylesheet" type="text/css" href="template/time_9th_keji/src/list.css" />
<script src="template/time_9th_keji/src/js/jquery.superslide.js" type="text/javascript" type="text/javascript"></script><?php echo adshow("text/wp a_t");?><style id="diy_style" type="text/css"></style>
<div class="wp"> 
  <!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]--> 
</div>
<div class="tit_top cl"> 
        <?php if(($_G['group']['allowpostarticle'] || $_G['group']['allowmanagearticle'] || $categoryperm[$catid]['allowmanage'] || $categoryperm[$catid]['allowpublish']) && empty($cat['disallowpublish'])) { ?> 
        <a href="portal.php?mod=portalcp&amp;ac=article&amp;catid=<?php echo $cat['catid'];?>" class="y post">发布文章</a> 
        <?php } ?>
        <h3><?php echo $cat['catname'];?></h3><div class="cl" style="float: left; min-width: 200px; min-height: 30px;"><!--[diy=diy_info]--><div id="diy_info" class="area"><div id="framep6c8DC" class="frame move-span cl frame-1"><div id="framep6c8DC_left" class="column frame-1-c"><div id="framep6c8DC_left_temp" class="move-span temp"></div><?php block_display('139');?></div></div></div><!--[/diy]--></div> 
</div>
<div id="ct" class="ct2 wp inside_box cl">
  <div class="mn"> 
    <?php echo adshow("articlelist/mbm hm/1");?><?php echo adshow("articlelist/mbm hm/2");?> 
    <!--[diy=listcontenttop]--><div id="listcontenttop" class="area"></div><!--[/diy]-->
    <div class="bm">
      <!-- 文章列表 begin -->
      <div class="list_new Framebox cl"> 
        <?php if(is_array($list['list'])) foreach($list['list'] as $value) { ?> 
        <?php $highlight = article_title_style($value);?> 
        <?php $article_url = fetch_article_url($value);?>        
        <div class="news_list cl">
          <div class="cl"> 
            <?php if($value['pic']) { ?>
            <div class="new_pic">
              <div class="bubba"><a href="<?php echo $article_url;?>" target="_blank"><img src="<?php echo $value['pic'];?>" alt="<?php echo $value['title'];?>"/></a>
                </div>
            </div>
            <?php } ?>
            <div class="new_body">
              <h2><a href="<?php echo $article_url;?>" target="_blank" <?php echo $highlight;?>><?php echo $value['title'];?></a> <?php if($value['status'] == 1) { ?>(待审核)<?php } ?></h2>
              <div class="meta"><?php if($value['catname'] && $cat['subs']) { ?><span class="meta-class"><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a></span><?php } ?><span class="meta-date"><?php echo $value['dateline'];?></span> 
                <?php if($_G['group']['allowmanagearticle'] || ($_G['group']['allowpostarticle'] && $value['uid'] == $_G['uid'] && (empty($_G['group']['allowpostarticlemod']) || $_G['group']['allowpostarticlemod'] && $value['status'] == 1)) || $categoryperm[$value['catid']]['allowmanage']) { ?> 
                <span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=edit&amp;aid=<?php echo $value['aid'];?>">编辑</a></span> <span><a href="portal.php?mod=portalcp&amp;ac=article&amp;op=delete&amp;aid=<?php echo $value['aid'];?>" id="article_delete_<?php echo $value['aid'];?>" onClick="showWindow(this.id, this.href, 'get', 0);">删除</a></span> 
                <?php } ?></div>
              <p><?php echo $value['summary'];?></p>
            </div>
          </div>
        </div>
        
        <?php } ?> 
      </div>
      <!-- 文章列表 end --> 
      <!--[diy=listloopbottom]--><div id="listloopbottom" class="area"></div><!--[/diy]--> 
    </div>
    <?php echo adshow("articlelist/mbm hm/3");?><?php echo adshow("articlelist/mbm hm/4");?> 
    <?php if($list['multi']) { ?>
    <div class="pgs cl"><?php echo $list['multi'];?></div>
    <?php } ?> 
    
    <!--[diy=diycontentbottom]--><div id="diycontentbottom" class="area"></div><!--[/diy]--> 
    
  </div>
  <div class="sd pph">
    <div class="drag"> 
      <!--[diy=diyrighttop]--><div id="diyrighttop" class="area"></div><!--[/diy]--> 
    </div>
    
    <!-- 分类 -->
    <div class="list_box cl" style="margin: 0;">
    <?php if($cat['subs']) { ?>
      <div class="tit01 cl" style="margin: 11px 0 20px 0;">
        <h2>下级分类</h2>
      </div>
      <div class="portal_sort Framebox2 cl" style="margin: 0 0 15px 0;">
        <ul>
          <?php if(is_array($cat['subs'])) foreach($cat['subs'] as $value) { ?>          <li><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } elseif($cat['others']) { ?>
      <div class="tit01 cl" style="margin: 11px 0 20px 0;">
        <h2>相关分类</h2>
      </div>
      <div class="portal_sort Framebox2 cl" style="margin: 0 0 15px 0;">
        <ul>
          <?php if(is_array($cat['others'])) foreach($cat['others'] as $value) { ?>          <li><a href="<?php echo $portalcategory[$value['catid']]['caturl'];?>"><?php echo $value['catname'];?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
    </div> 
    <!-- 推荐阅读 -->
    <div class="sbody cl" style="margin: 10px 0 0 0;"> 
      <!--[diy=sbody]--><div id="sbody" class="area"><div id="frameQQy7sf" class="frame move-span cl frame-1"><div id="frameQQy7sf_left" class="column frame-1-c"><div id="frameQQy7sf_left_temp" class="move-span temp"></div><?php block_display('138');?></div></div><div id="frameES98zm" class="frame move-span cl frame-1"><div id="frameES98zm_left" class="column frame-1-c"><div id="frameES98zm_left_temp" class="move-span temp"></div><?php block_display('142');?></div></div><div id="frameLqxtE7" class="frame move-span cl frame-1"><div id="frameLqxtE7_left" class="column frame-1-c"><div id="frameLqxtE7_left_temp" class="move-span temp"></div><?php block_display('141');?></div></div><div id="frameMe2WMq" class="frame move-span cl frame-1"><div id="frameMe2WMq_left" class="column frame-1-c"><div id="frameMe2WMq_left_temp" class="move-span temp"></div><?php block_display('143');?><?php block_display('140');?><?php block_display('144');?></div></div></div><!--[/diy]--> 
    </div>

    <div class="drag"> 
      <!--[diy=diy2]--><div id="diy2" class="area"></div><!--[/diy]--> 
    </div>
  </div>
</div>
<div class="wp mtn"> 
  <!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]--> 
</div><?php include template('common/footer'); ?>