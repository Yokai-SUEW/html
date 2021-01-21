$(document).ready(function(){
    $.ajax({
      url : "http://localhost/status.php",
      type : "GET",
      success : function(data){
        console.log(data);
  
        var id = [];
        var Temperatur = [];
        var Luftfeuchtigkeit = [];
        var Datum = [];
  
        for(var i in data) {
          id.push("ID " + data[i].id);
          Temperatur.push(data[i].temperatur);
          Luftfeuchtigkeit.push(data[i].luftfeuchtigkeit);
          Datum.push(data[i].datum);
        }
  
        var chartdata = {
          labels: Datum,
          datasets: [
            {
              label: "Temperatur",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(59, 89, 152, 0.75)",
              borderColor: "rgba(59, 89, 152, 1)",
              pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
              pointHoverBorderColor: "rgba(59, 89, 152, 1)",
              data: Temperatur
            },
            {
              label: "Luftfeuchtigkeit",
              fill: false,
              lineTension: 0.1,
              backgroundColor: "rgba(29, 202, 255, 0.75)",
              borderColor: "rgba(29, 202, 255, 1)",
              pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
              pointHoverBorderColor: "rgba(29, 202, 255, 1)",
              data: Luftfeuchtigkeit
            }
          ]
        };
  
        var ctx = $("#mycanvas");
  
        var LineGraph = new Chart(ctx, {
          type: 'line',
          data: chartdata
        });
      },
      error : function(data) {
  
      }
    });
  });