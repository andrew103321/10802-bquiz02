<fieldset>
<legend>會員註冊</legend>
<div>*請設定您要註冊的帳號及密碼(最長12個字元)</div>
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
                        if(res==1){
                           
                            alert("註冊成功")
                        }else{

                        } 
                    })

                }else{
                    alert("密碼錯誤")
                }
            }
        })

    }
    
})

</script>