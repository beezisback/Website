<!--News-->
{news_posts}
<div class="left-bar"><div class="left-space">{news_posts.title}</div></div>
<div class="left-mid">
<table width="100%">
<tr>
<td valign="top"><div class="left-highlight"><br/><font color="white">Admin</font><br/>{news_posts.author}<br/><img src="./styles/default/images/avatars/{news_posts.avatar}.gif" class="news-avatar"><br/><br/><font size="1px">Posted<br/><font color="#90cf5d">{news_posts.date}</font></font></div></td>
<td valign="top">
{news_posts.body}
</td>
</tr>
</table>
</div>
<div class="left-foot"></div>
<br/>
{/news_posts}
<!--End News-->