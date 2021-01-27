$.ajax({
      url : "http://"+self.location.host+"/config/graphdata.php",
      type : "GET",
      dataType: 'json',
      success : function(data){
        console.log(data);

        var id = [];
        var Temperatur = [];
        var Luftfeuchtigkeit = [];
        var Datum = [];
  
        for(var i in data) {
          id.push("ID " + data[i].id);
          Temperatur.push(parseFloat(data[i].Temperatur));
          Luftfeuchtigkeit.push(data[i].Luftfeuchtigkeit);
          Datum.push(data[i].Datum.substring(0, 19));
        }

        var ctx = $("#line-chartcanvas");

        var chartdata = 
        {
            labels: Datum,
            datasets:
            [
                {
                    label: "Temperatur in °C",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(204, 229, 255, 0.75)",
                    borderColor: "rgba(204, 229, 255, 0.75)",
                    pointHoverBackgroundColor: "rgba(204, 229, 255, 0.75)",
                    pointHoverBorderColor: "rgba(204, 229, 255, 0.75)",
                    data: Temperatur
                },
                {
                    label: "Luftfeuchtigkeit in %",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(255, 229, 204, 0.75)",
                    borderColor: "rgba(255, 229, 204, 1)",
                    pointHoverBackgroundColor: "rgba(255, 229, 204, 1)",
                    pointHoverBorderColor: "rgba(255, 229, 204, 1)",
                    data: Luftfeuchtigkeit
                }

            ]
        };
  
        var options = {
          title : {
            display : true,
            position : "top",
            text : "Server Status",
            fontSize : 32,
            fontColor : "white"
          },
          legend : {
            display : true,
            position : "bottom",
            fontSize : "27",
            fontColor : "white"
          }
        };

        var ctx = document.getElementById('line-chartcanvas').getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: chartdata.labels,
              datasets: chartdata.datasets,  
              data: Temperatur,
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });   
    },
    error : function(data)
    {
      console.log(data);
    }
});
