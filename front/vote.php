<?php
    $subject = find("que",$_GET['id']);
?>
<fieldset>
    <legend>目前首頁:首頁>問卷調查><?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <form action="./api/vote.php" method="post">
    <?php
        $option = all("que",['parent'=>$subject['id']]);
            foreach( $option as $opt){
                echo "<div>";
                echo "<input type='radio' name='opt' value='".$opt['id']."'>";
                echo $opt['text'];
                echo "</div>";
            }
        
    ?>
    <input type="submit" value="我要投票">
   </form>
</fieldset>