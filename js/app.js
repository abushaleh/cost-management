$(document).ready(function () {
    $.ajax({
        url: 'http://localhost/cost-management/allCategory.php?jsondata=1',
        type: "GET",
        dataType: "json",
        success: function (data) {
            var labels = data.cat;
            var costdata = data.cost;

            var ctx = document.getElementById('myChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: costdata,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.9)',
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 206, 86, 0.9)',
                            'rgba(75, 192, 192, 0.9)',
                            'rgba(153, 102, 255, 0.9)',
                            'rgba(255, 159, 64, 0.9)'
                        ],
                    }]
                }
            });
        }
    });
    
    /*
    $.ajax({
        url: "http://localhost/chartjs/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var player = [];
            var score = [];

            for (var i in data) {
                player.push("Player " + data[i].playerid);
                score.push(data[i].score);
            }

            var chartdata = {
                labels: player,
                datasets: [{
                    label: 'Player Score',
                    backgroundColor: 'rgba(200, 200, 200, 0.75)',
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: score
                }]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
    */
});