window.delete_alert = () =>  {
    if (!window.confirm("本当に削除しますか？")) {
        window.alert("キャンセルされました");
        return false;
    }
    document.deleteform.submit();
}

var date = new Date();
var year = date.getFullYear();
var month = date.getMonth() + 1;
var day = date.getDate();
document.getElementById("current_month").innerHTML = year + "-" + month;
