<fieldset>
<legend>忘記密碼</legend>
<table>
    <tr>
        <td>請輸入信箱以查詢密碼</td>
    </tr>
    <tr>
        <td><input type="text" name='email' id='email'></td>
    </tr>
    <tr>
        <td id='result'></td>
    </tr>
    <tr>
        <td><button id="findPw">尋找</button></td>
    </tr>
</table>
<script>
$("#findPw").on("click",function(){
    let email = $("#email").val()
    console.log(email)
    $.post("./api/find_pw.php",{email},function(res){
        // 將 值或字串 加入 id為result html 標籤裡
        $("#result").html(res)
    })
})

</script>

</fieldset>