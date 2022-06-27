//這個finction會接受兩個參數一個是table一個是id
//我接收到table跟id，他就會要我去刪除資料
//api/del.php這個程式會告訴你table,id是哪筆資料
//然後你就把它刪除並且重整當前頁
function del(table,id){
    $.post("api/del.php",{table,id},()=>{
        location.reload();
        console.log(table,id)

    })
}