<div>目前位置: 首頁 > 分類網誌 > 最新文章區 </div>

<table style="width:100%">
    <tr>
        <td width="30%">標題</td>
        <td width="50%">內容</td>
        <td></td>
    </tr>
    <?php
    $total = nums("news", ["sh" => 1]);
    $div = 5;
    $pages = ceil($total / $div);
    $now = (!empty($_GET['p']))?$_GET['p'] : 1;
    $start = ($now - 1) * $div;
    $news = all("news", ["sh" => 1],"limit $start,$div");

//  print_r($news);

    foreach ($news as $n) {
    ?>

        <tr>
            <td class="clo title" style="cursor:pointer;color:blue"><?= $n["title"] ?></td>
            <td>
                <div class="line"><?= mb_substr($n["text"], 0, 20, "utf8"); ?>...</div>
                <div class= "content" style="display: none"><?=nl2br($n['text']);?></div>
            </td>
            <td>
                <?php 
                    if(!empty($_SESSION["user"])){

                        $chk = nums("log",["news"=>$n['id'],"user"=>$_SESSION['user']]);
                    

                    if($chk>0){
                        // echo "<a href='#' id='good".$n['id']."' 
                        // onclick=\"good('".$n["id"]."','2','".$_SESSION['user']."')\">回收讚</a>";
                        ?>
                        <a href="#" id="good<?=$n['id'];?>" onclick="good('<?=$n['id'];?>','2','<?=$_SESSION['user'];?>')">回收讚</a>
                        <?php 

                    }else{
                        // echo "<a href='#' id='good".$n['id']."' 
                        // onclick=\"good('".$n["id"]."','1','".$_SESSION['user']."')\">讚</a>";
                    ?>
                        <a href="#" id="good<?=$n['id'];?>" onclick="good('<?=$n['id'];?>','1','<?=$_SESSION['user'];?>')">讚</a>
                    <?php
                    }
                
         
                }
                ?>
            </td>
        </tr>

    <?php
    }
    ?>
</table>

<?php
if (($now - 1) > 0) {
    echo "<a href='index.php?do=news&p=". ($now - 1) ."'> < </a>";
}

for ($i = 1; $i <= $pages; $i++) {
    $fontSize = ($i == $now) ? "24px" : "18px";
    echo "<a href='index.php?do=news&p=$i' style='font-size:$fontSize'>" . $i . "</a>";
}
if (($now - 1) <= $pages) {
    echo "<a href='index.php?do=news&p=" . ($now + 1) . "'> > </a>";
}
?>
<script>
    $(".title").on("click",function(){
        // toggle 一個顯示 一個隱藏
        // next("td").children(".line ,.content") next下一層   children子類別
        $(this).next("td").children(".line ,.content").toggle();
    })

</script>