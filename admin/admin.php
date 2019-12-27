<fieldset>
    <legend>帳號管理</legend>
    <form action="./api/userdel.php" method="post">
    <table class='ct' style="width:70%;margin:auto">
    <tr>
        <td>帳號</td>
        <td>密碼</td>
        <td>刪除</td>
    </tr>
    <?php
        $users = all("user");
        foreach($users as $u){ 
            if($u['acc']!="admin"){
    
    ?>
    <tr>
        <td><?=$u['acc'];?></td>
        <!-- str_repeat 把密碼換星星    mb_strlen 計算密碼長度 -->
        <td><?=str_repeat("*",mb_strlen($u['pw']));?></td>
        <td><input type="checkbox" name="del[]" value="<?=$u['id'];?>"></td>
    </tr>

    <?php
    }
    }
    ?>
    </table>
    <div class="ct">
        <input type="submit" value="確認刪除"> 
        <input type="reset" value="清空選取"> 
    </div>
    </form>
    <h1>新增會員</h1>
    <table>
    <tr>
        <td>step1:登入帳號</td>
        <td><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td>step2:登入密碼</td>
        <td><input type="text" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td>step3:再次確認</td>
        <td><input type="text" name="pw2" id="pw2"></td>
    </tr>
    <tr>
        <td>step4:信箱(忘記密碼時使用)</td>
        <td><input type="text" name="email" id="email"></td>
    </tr>
    <tr>
        <td><input type="submit" value="註冊" id='reg'><input type="reset" value="清除"></tr>
    </tr>
</table>

</fieldset>
<script>
$("input[type='reset']").on("click",function(){
            $("#acc,#pw,#pw2,#email").val("");
        })

$("#reg").on("click",function(){
    let acc = $("#acc").val()
    let pw = $("#pw").val()
    let pw2 = $("#pw2").val()
    let email = $("#email").val()
    if(acc.length>12){
        alert("帳號超過12個字")
    }

    if(acc=="" || pw=="" || pw2==""|| email==""){
        alert("不可空白");
    }else{
        $.post("./api/chkacc.php",{acc},function(status){
            if(status=="1"){
                alert("帳號重複")
            }else{
                if(pw==pw2){
                    $.post("./api/reg.php",{acc,pw,email},function(res){
                        location.reload();
                    })

                }else{
                    alert("密碼錯誤")
                }
            }
        })

    }
    
})

</script>
