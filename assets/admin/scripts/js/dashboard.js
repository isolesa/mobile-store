$(document).ready(function(){

    $(document).on("click",".exportLink",function(e){
        e.preventDefault();

        let urls = []; let visits = [];
        let url = document.getElementsByClassName("urlHidden");
        let visit = document.getElementsByClassName("visitsHidden");

        for(let i = 0; i < url.length; i++){
            urls.push(url[i].value);
            visits.push(visit[i].value);
        }

        let data = {
            urls:urls,
            visits:visits
        };

        sendUrls(data);
    });
});

function sendUrls(data){

    $.ajax({
        url:"models/admin/dashboard/export-excel.php",
        method:"POST",
        dataType:"json",
        data:data,
        success:function(data, statusText, jqXHR){
            $("#download").click();
            },
        error:function(xhr, status, error){
            console.log(status + ': ' + error);
        }
    });
}