���� �������� ����� ����.<br> 
������: http://youtube.com/watch?v=hQSTvkvZmtM<br> 
<form method='post' action=''> 
<input type='text' name='video' class='textbox'/> 
<input type='submit' name='submit'value="�����!" class="button"> 
</form> 
<? 
if($_POST['submit']){ 
$video="$_POST[video]";//wzimame napisanoto wyw forma 
$video=str_replace("http://youtube.com/watch?v=", "http://cache.googlevideo.com/get_video?video_id=", $video);//zamenqme http://youtube.com/watch?v= s http://cache.googlevideo.com/get_video?video_id=", $ 
echo"<a href=\"$video\">�������</a><br>$video";}//izwejdame rezultata 
?>

���� �������� ����� ����.<br> 
������: http://vbox7.com/play:3a0c59b2<br> 
<form method='post' action=''> 
<input type='text' name='video' class='textbox'/> 
<input type='submit' name='submit'value="�����!" class="button"> 
</form> 
<? 

if(eregi('vbox7.com',$_POST['video']) && isset($_POST['submit'])){ 
$fail = explode(':',$_POST['video']); //������� ����� 
$dir = substr($fail[2],0,2); //������� ������������ �� ����� 
echo "<a href=http://media.vbox7.com/s/$dir/$fail[2].flv>�������</a><br>����: http://media.vbox7.com/s/$dir/$fail[2].flv"; //��������� 
} 
?>