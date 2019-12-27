<?php
include_once "../base.php";
$newsid = $_GET["newsid"];
$news = find("news",$newsid);
// nl2br 將/n 換成 br
echo nl2br($news['text']);
?>