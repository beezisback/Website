Моля напишете целия линк.<br> 
Пример: http://youtube.com/watch?v=hQSTvkvZmtM<br> 
<form method='post' action=''> 
<input type='text' name='video' class='textbox'/> 
<input type='submit' name='submit'value="Давай!" class="button"> 
</form> 
<? 
if($_POST['submit']){ 
$video="$_POST[video]";//wzimame napisanoto wyw forma 
$video=str_replace("http://youtube.com/watch?v=", "http://cache.googlevideo.com/get_video?video_id=", $video);//zamenqme http://youtube.com/watch?v= s http://cache.googlevideo.com/get_video?video_id=", $ 
echo"<a href=\"$video\">Сваляне</a><br>$video";}//izwejdame rezultata 
?>

Моля напишете целия линк.<br> 
Пример: http://vbox7.com/play:3a0c59b2<br> 
<form method='post' action=''> 
<input type='text' name='video' class='textbox'/> 
<input type='submit' name='submit'value="Давай!" class="button"> 
</form> 
<? 

if(eregi('vbox7.com',$_POST['video']) && isset($_POST['submit'])){ 
$fail = explode(':',$_POST['video']); //взимаме файла 
$dir = substr($fail[2],0,2); //взимаме директорията на файла 
echo "<a href=http://media.vbox7.com/s/$dir/$fail[2].flv>Сваляне</a><br>Линк: http://media.vbox7.com/s/$dir/$fail[2].flv"; //извеждаме 
} 
?>