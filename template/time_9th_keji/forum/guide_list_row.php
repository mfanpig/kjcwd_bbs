<?php echo 'Theme by Time';exit;?>
				<!--{if $list['threadcount']}-->
						<!--{loop $list['threadlist'] $key $thread}-->
							<tbody id="$thread[id]">
								<tr {eval $i++;} {if ($i % 2 === 0)} {eval $i=0;} class="list2"{/if}>
									<td class="icn">
										<a href="forum.php?mod=viewthread&tid=$thread[icontid]&{if $_GET['archiveid']}archiveid={$_GET['archiveid']}&{/if}extra=$extra" title="{if $thread['displayorder'] == 1}{lang thread_type1} - {/if}
											{if $thread['displayorder'] == 2}{lang thread_type2} - {/if}
											{if $thread['displayorder'] == 3}{lang thread_type3} - {/if}
											{if $thread['displayorder'] == 4}{lang thread_type4} - {/if}
											{if $thread[folder] == 'lock'}{lang closed_thread} - {/if}
											{if $thread['special'] == 1}{lang thread_poll} - {/if}
											{if $thread['special'] == 2}{lang thread_trade} - {/if}
											{if $thread['special'] == 3}{lang thread_reward} - {/if}
											{if $thread['special'] == 4}{lang thread_activity} - {/if}
											{if $thread['special'] == 5}{lang thread_debate} - {/if}
											{if $thread[folder] == "new"}{lang have_newreplies} - {/if}
											{lang target_blank}" target="_blank">
										<!--{if $thread[folder] == 'lock'}-->
											<img src="{IMGDIR}/folder_lock.gif" />
										<!--{elseif $thread['special'] == 1}-->
											<img src="{IMGDIR}/pollsmall.gif" alt="{lang thread_poll}" />
										<!--{elseif $thread['special'] == 2}-->
											<img src="{IMGDIR}/tradesmall.gif" alt="{lang thread_trade}" />
										<!--{elseif $thread['special'] == 3}-->
											<img src="{IMGDIR}/rewardsmall.gif" alt="{lang thread_reward}" />
										<!--{elseif $thread['special'] == 4}-->
											<img src="{IMGDIR}/activitysmall.gif" alt="{lang thread_activity}" />
										<!--{elseif $thread['special'] == 5}-->
											<img src="{IMGDIR}/debatesmall.gif" alt="{lang thread_debate}" />
										<!--{elseif in_array($thread['displayorder'], array(1, 2, 3, 4))}-->
											<img src="{IMGDIR}/pin_$thread[displayorder].gif" alt="$_G[setting][threadsticky][3-$thread[displayorder]]" />
										<!--{else}-->
											<img src="{IMGDIR}/folder_$thread[folder].gif" />
										<!--{/if}-->
										</a>
									</td>
									<th class="$thread[folder]">
										<!--{if !$thread['forumstick'] && $thread['closed'] > 1 && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
												<!--{eval $thread[tid]=$thread[closed];}-->
										<!--{/if}-->
										$thread[typehtml] $thread[sorthtml]
										<!--{if $thread['moved']}-->
											{lang thread_moved}:<!--{eval $thread[tid]=$thread[closed];}-->
										<!--{/if}-->
										<a href="forum.php?mod=viewthread&tid=$thread[tid]&{if $_GET['archiveid']}archiveid={$_GET['archiveid']}&{/if}extra=$extra" target="_blank" class="xst" >$thread[subject]</a><!--{if $_G['setting']['threadhidethreshold'] && $thread['hidden'] >= $_G['setting']['threadhidethreshold']}-->&nbsp;<span class="xg1">{lang hidden}</span>&nbsp;<!--{/if}--><!--{if $view == 'hot'}-->&nbsp;<span class="xi1">$thread['heats']{lang guide_attend}</span>&nbsp;<!--{/if}-->
										<!--{if $thread[icon] >= 0}-->
											<img src="{STATICURL}image/stamp/{$_G[cache][stamps][$thread[icon]][url]}" alt="{$_G[cache][stamps][$thread[icon]][text]}" align="absmiddle" />
										<!--{/if}-->
										<!--{if $thread['rushreply']}-->
											<img src="{IMGDIR}/rushreply_s.png" alt="{lang rushreply}" align="absmiddle" />
										<!--{/if}-->
										<!--{if $stemplate && $sortid}-->$stemplate[$sortid][$thread[tid]]<!--{/if}-->
										<!--{if $thread['readperm']}--> - [{lang readperm} <span class="xw1">$thread[readperm]</span>]<!--{/if}-->
										<!--{if $thread['price'] > 0}-->
											<!--{if $thread['special'] == '3'}-->
											- <span class="xi1">[{lang thread_reward} <span class="xw1">$thread[price]</span> {$_G[setting][extcredits][$_G['setting']['creditstransextra'][2]][unit]}{$_G[setting][extcredits][$_G['setting']['creditstransextra'][2]][title]}]</span>
											<!--{else}-->
											- [{lang price} <span class="xw1">$thread[price]</span> {$_G[setting][extcredits][$_G['setting']['creditstransextra'][1]][unit]}{$_G[setting][extcredits][$_G['setting']['creditstransextra'][1]][title]}]
											<!--{/if}-->
										<!--{elseif $thread['special'] == '3' && $thread['price'] < 0}-->
											- [{lang reward_solved}]
										<!--{/if}-->
										<!--{if $thread['attachment'] == 2}-->
											<img src="{STATICURL}image/filetype/image_s.gif" alt="attach_img" title="{lang attach_img}" align="absmiddle" />
										<!--{elseif $thread['attachment'] == 1}-->
											<img src="{STATICURL}image/filetype/common.gif" alt="attachment" title="{lang attachment}" align="absmiddle" />
										<!--{/if}-->
										<!--{if $thread['digest'] > 0 && $filter != 'digest'}-->
											<img src="{IMGDIR}/digest_$thread[digest].gif" align="absmiddle" alt="digest" title="{lang thread_digest} $thread[digest]" />
										<!--{/if}-->
										<!--{if $thread['displayorder'] == 0}-->
											<!--{if $thread[recommendicon] && $filter != 'recommend'}-->
												<img src="{IMGDIR}/recommend_$thread[recommendicon].gif" align="absmiddle" alt="recommend" title="{lang thread_recommend} $thread[recommends]" />
											<!--{/if}-->
											<!--{if $thread[heatlevel]}-->
												<img src="{IMGDIR}/hot_$thread[heatlevel].gif" align="absmiddle" alt="heatlevel" title="$thread[heatlevel] {lang heats}" />
											<!--{/if}-->
											<!--{if $thread['rate'] > 0}-->
												<img src="{IMGDIR}/agree.gif" align="absmiddle" alt="agree" title="{lang rate_credit_add}" />
											<!--{elseif $thread['rate'] < 0}-->
												<img src="{IMGDIR}/disagree.gif" align="absmiddle" alt="disagree" title="{lang posts_deducted}" />
											<!--{/if}-->
										<!--{/if}-->
										<!--{if $thread['replycredit'] > 0}-->
											- <span class="xi1">[{lang replycredit} <strong> $thread['replycredit']</strong> ]</span>
										<!--{/if}-->
										<!--{if $thread[multipage]}-->
											<span class="tps">$thread[multipage]</span>
										<!--{/if}-->
										<!--{if $thread['weeknew']}-->
											<a href="forum.php?mod=redirect&tid=$thread[tid]&goto=lastpost#lastpost" class="xi1">New</a>
										<!--{/if}-->
										<!--{if !$thread['forumstick'] && ($thread['isgroup'] == 1 || $thread['fid'] != $_G['fid'])}-->
											<!--{if $thread['related_group'] == 0 && $thread['closed'] > 1}-->
												<!--{eval $thread[tid]=$thread[closed];}-->
											<!--{/if}-->
										<!--{/if}-->
									</th>
									<td class="by"><a href="forum.php?mod=forumdisplay&fid=$thread[fid]" target="_blank">$list['forumnames'][$thread[fid]]['name']</a></td>
									<td class="by">
										<cite>
										<!--{if $thread['authorid'] && $thread['author']}-->
											<a href="home.php?mod=space&uid=$thread[authorid]" c="1">$thread[author]</a><!--{if !empty($verify[$thread['authorid']])}--> $verify[$thread[authorid]]<!--{/if}-->
										<!--{else}-->
											$_G[setting][anonymoustext]
										<!--{/if}-->
										</cite>
										<em><span{if $thread['istoday']} class="xi1"{/if}>$thread[dateline]</span></em>
									</td>
									<td class="num"><a href="forum.php?mod=viewthread&tid=$thread[tid]&extra=$extra" class="xi2">$thread[replies]</a><em><!--{if $thread['isgroup'] != 1}-->$thread[views]<!--{else}-->{$groupnames[$thread[tid]][views]}<!--{/if}--></em></td>
									<td class="by">
										<cite><!--{if $thread['lastposter']}--><a href="{if $thread[digest] != -2}home.php?mod=space&username=$thread[lastposterenc]{else}forum.php?mod=viewthread&tid=$thread[tid]&page={echo max(1, $thread[pages]);}{/if}" c="1">$thread[lastposter]</a><!--{else}-->$_G[setting][anonymoustext]<!--{/if}--></cite>
										<em><a href="{if $thread[digest] != -2}forum.php?mod=redirect&tid=$thread[tid]&goto=lastpost$highlight#lastpost{else}forum.php?mod=viewthread&tid=$thread[tid]&page={echo max(1, $thread[pages]);}{/if}">$thread[lastpost]</a></em>
									</td>
								</tr>
							</tbody>
							<!--{if $view == 'my' && $viewtype=='reply' && !empty($tids[$thread[tid]])}-->
								<tbody class="bw0_all">
									<tr>
										<td class="icn">&nbsp;</td>
										<td colspan="5">
											<!--{loop $tids[$thread[tid]] $pid}-->
											<!--{eval $post = $posts[$pid];}-->
											<div class="tl_reply pbm xg1"><a href="forum.php?mod=redirect&goto=findpost&ptid=$thread[tid]&pid=$pid" target="_blank"><!--{if $post[message]}-->{$post[message]}<!--{else}-->...<!--{/if}--></a></div>
											<!--{/loop}-->
										</td>
									</tr>
								</tbody>
								<tr><td colspan="6"></td></tr>
							<!--{/if}-->
							<!--{if $view == 'my' && $viewtype=='postcomment'}-->
								<tr>
									<td class="icn">&nbsp;</td>
									<td colspan="5" class="xg1">$thread[comment]</td>
								</tr>
							<!--{/if}-->
						<!--{/loop}-->
				<!--{else}-->
						<tbody class="bw0_all"><tr><th colspan="5"><p class="emp">{lang guide_nothreads}</p></th></tr></tbody>
				<!--{/if}-->
