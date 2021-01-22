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
          Temperatur.push(data[i].temperatur);
          Luftfeuchtigkeit.push(data[i].luftfeuchtigkeit);
          Datum.push(data[i].datum);
        }

        var ctx = $("#line-chartcanvas");

        var chartdata = 
        {
            labels: Datum,
            datasets:
            [
                {
                    label: "Temperatur",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(230, 0, 0, 0.75)",
                    borderColor: "rgba(230, 0, 0, 1)",
                    pointHoverBackgroundColor: "rgba(230, 0, 0, 1)",
                    pointHoverBorderColor: "rgba(230, 0, 0, 1)",
                    data: Temperatur
                },
                {
                    label: "Luftfeuchtigkeit",
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                    borderColor: "rgba(59, 89, 152, 1)",
                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
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
        var myLineChart = new Chart(ctx,
        {
            type: 'line',
            data: chartdata,
            options: options
        });
    },
    error : function(data)
    {
      console.log(data);
    }
});
