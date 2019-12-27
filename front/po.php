<style>
    fieldset {
        list-style-type: none;
        display: inline-block;
        /* 圖片垂直對齊該行元素的最高位置。 */
        vertical-align: top;
        padding: 15px;
        margin-top: 15px;
    }
    fieldset li {
        margin: 10px 0;
        padding: 5px;
        color: blue;
    }

    fieldset li:hover {
        background: skyblue;
        cursor: pointer;
    }

    .typelist {
        width: 15%;
    }

    .newslist {
        width: 70%;
    }

    .list div {
        margin: 5px 0;
        cursor: pointer;
    }
</style>
<div>目前位置: 首頁 > 分類網誌 > <span class="type">健康新知</span> </div>
<fieldset class="typelist">
    <legend>分類網誌</legend>
    <li data-type="1">健康新知</li>
    <li data-type="2">菸害防制</li>
    <li data-type="3">癌症防治</li>
    <li data-type="4">慢性病防治</li>
</fieldset>
<fieldset class="newslist">
    <legend>文章列表</legend>
        <div class="list"></div>
        <div class="post"></div>
</fieldset>

<script>
    $("li").on("click", function() {
        let type = $(this).data("type")
        let nav = $(this).html()
        $(".type").html(nav)
        // 刪除內容
        $(".post").html("")
        getList(type)
    })

    function getList(type) {
        // 拿樓上給的 type的值 如 1   去資料庫拿標題資料做成div  
        // 後將 資料庫 id 給新增div
        $.get("./api/getlist.php", {type}, function(list) {
            // 顯示標題
            $(".list").html(list)

           
            $(".list div").on("click",function(){
               
                let newsid = $(this).data("news")
                // 拿 div 裡藏的 id  去資料庫找id  輸入內容
                $.get("./api/getnwes.php",{newsid},function(news){
                    // 刪除之前標題
                    $(".list").html("")
                    // 顯示內容
                    $(".post").html(news)
                })
            })
        })
    }
</script>