$(function () {

    var limit=10;
    var offset = 0;
  // 网页访问概要统计刷新处理
  rpt_overview_refresh(limit, offset,function (response) {
        }, function (response) {
            console.log(response.errmsg)
        });
       
        rpt_overview(limit, offset,function (response) {
          var count = response.rows;
          for (var i = 0; i < count.length; i++) {
            $("#count_rows").append(
                '<tr>' +
                   '<td>' + count[i].rpt_title + '</td>' + 
                   '<td>' + count[i].rpt_sort + '</td>' + 
                   '<td>' + count[i].url_key + '</td>' + 
                   '<td>' + count[i].rpt_unit + '</td>' + 
                   '<td>' + count[i].rpt_count + '</td>' + 
                   '<td>' + count[i].rpt_time + '</td>' +
                   '</tr>'
                );
        }

      }, function (response) {
          console.log(response.errmsg);
      });
  

});


