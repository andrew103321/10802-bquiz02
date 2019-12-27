<fieldset>
    <legend>最新文章管理</legend>
    <form action="./api/news.php" method="post">
        <table class="ct" style="width:70%;margin:auto">
            <tr>
                <td>標題</td>
                <td>內容</td>
                <td>顯示</td>
                <td>刪除</td>
            </tr>
        


        <?php
         $total = nums("news");
         $div = 3;
         $pages = ceil($total / $div);
         $now = (!empty($_GET['p']))?$_GET['p'] : 1;
         $start = ($now - 1) * $div;
         $news = all("news",[],"limit $start,$div");
     
         foreach ($news as $key=>$n) {
        ?>
            <tr>
                <td class='clo'><?=($key+1+$start);?></td>
                <td><?=$n['title']?></td>
                <td><input type="checkbox" name="sh[]" value="<?=$n['id'];?>" <?=($n['sh']==1)?"checked":'';?>></td>
                <td><input type="checkbox" name="del[]" value="<?=$n['id'];?>"></td>
                <input type="hidden" name="id[]" value="<?=$n['id'];?>">
            </tr>
            <?php
         }
            ?>
        </table>
    
    <div>
    <?php
            if (($now - 1) > 0) {
                echo "<a href='admin.php?do=news&p=". ($now - 1) ."'> < </a>";
            }
            
            for ($i = 1; $i <= $pages; $i++) {
                $fontSize = ($i == $now) ? "24px" : "18px";
                echo "<a href='admin.php?do=news&p=$i' style='font-size:$fontSize'>" . $i . "</a>";
            }
            if (($now - 1) <= $pages) {
                echo "<a href='admin.php?do=news&p=" . ($now + 1) . "'> > </a>";
            }
    ?>
    </div>
    <div class="ct"><input type="submit" value="確認修改"></div>
    </form>
    </fieldset>