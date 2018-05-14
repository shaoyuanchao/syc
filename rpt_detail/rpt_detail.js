$(function () {
    // 最近七日访问统计展示
    rpt_detail();
})
var url_key = $('#url_key').text();
function rpt_detail() {
    var api_url = 'rpt_detail.php';
    post_data = {"url_key":url_key};
    CallApi(api_url, post_data, function (response) {
        var first, sec, third, thru, fri, sta, today;
        var rows = response.rows;
                first= rows.first;
                sec = rows.sec;
                third  = rows.third;
                thru = rows.thru;
                fri = rows.fri;
                sta = rows.sta;
                today = rows.today;
                var data =[first,sec,third,thru,fri,sta,today];
                var ctx = document.getElementById('myChart').getContext('2d');
                console.log(ctx);
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ["first", "second", "third", "fourth", "fifth", "sixth", "seventh"],
                        datasets: [{
                            label: "last seven days visit show.",
                            borderColor: 'rgb(255, 99, 132)',
                            data: data,
                        }]
                    },
                    options: {}
                });
             
                
    }, function (response) {
        console.log(response.errmsg)
    });
}

