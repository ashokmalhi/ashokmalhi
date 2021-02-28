function updateChart(data, charts) {
    data.forEach((item, index) => {
        charts[index].graph.data.labels = item.label;
        charts[index].graph.data.datasets.forEach((dataset, i) => {
            dataset.data = item.value;
        });
        charts[index].graph.update();
    });
}

function drawChart(charts) {
    //charts => array of charts want to draw
    charts.forEach((element, index) => {
        var ctx = document.getElementById(element.el);
        if(element.gt == "bar" && element.el != "stackChart"){
            var graphConfig = barChart();
        }
        else if(element.el == "stackChart"){
            var graphConfig = stackedColumn();
        }
        else{
            var graphConfig = getConfig();
        }

        graphConfig.type =
            element.gt != undefined ? element.gt : graphConfig.type;
        charts[index].graph = new Chart(ctx, graphConfig);

        if (charts[index].plugins != undefined) {
            graphConfig.options.plugins = charts[index].plugins;
        }

        if (charts[index].scales != undefined) {
            graphConfig.options.scales = charts[index].scales;
        }
    });
}
function getConfig() {
    var config = {
        type: "doughnut",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Total #",
                    data: [],
                    backgroundColor: [
                        "rgba(64, 193, 172, 1)",
                        "rgba(70, 78, 126, 1)",
                        "rgba(204, 204, 204, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(75, 12, 192, 1)",
                        "rgba(25, 139, 64, 1)",
                        "rgba(255, 59, 64, 1)",
                        "rgba(205, 159, 64, 1)",
                        "rgba(155, 19, 64, 1)",
                        "rgba(25, 15, 64, 1)",
                    ],
                    borderWidth: 3,
                },
            ],
        },
        options: {
            responsive: true,
            legend: {
                position: "left",
                labels: {
                    generateLabels: function (chart) {
                        var data = chart.data;
                        if (data.labels.length && data.datasets.length) {
                            return data.labels.map(function (label, i) {
                                var meta = chart.getDatasetMeta(0);
                                var ds = data.datasets[0];
                                var arc = meta.data[i];
                                var custom = (arc && arc.custom) || {};
                                var getValueAtIndexOrDefault =
                                    Chart.helpers.getValueAtIndexOrDefault;
                                var arcOpts = chart.options.elements.arc;
                                var fill = custom.backgroundColor
                                    ? custom.backgroundColor
                                    : getValueAtIndexOrDefault(
                                          ds.backgroundColor,
                                          i,
                                          arcOpts.backgroundColor
                                      );
                                var stroke = custom.borderColor
                                    ? custom.borderColor
                                    : getValueAtIndexOrDefault(
                                          ds.borderColor,
                                          i,
                                          arcOpts.borderColor
                                      );
                                var bw = custom.borderWidth
                                    ? custom.borderWidth
                                    : getValueAtIndexOrDefault(
                                          ds.borderWidth,
                                          i,
                                          arcOpts.borderWidth
                                      );

                                // We get the value of the current label
                                var value =
                                    chart.config.data.datasets[
                                        arc._datasetIndex
                                    ].data[arc._index];

                                return {
                                    // Instead of `text: label,`
                                    // We add the value to the string
                                    text: label + " : " + value,
                                    fillStyle: fill,
                                    strokeStyle: stroke,
                                    lineWidth: bw,
                                    hidden:
                                        isNaN(ds.data[i]) ||
                                        meta.data[i].hidden,
                                    index: i,
                                };
                            });
                        } else {
                            return [];
                        }
                    },
                },
            },
            plugins: {
                datalabels: {
                    formatter: () => {
                        return "";
                    },
                    color: "#fff",
                },
            },
            scales: {},
        },
    };
    return config;
}
function barChart(){
    var config = {
        type: "bar",
        data: {
            labels: [],
            datasets: [
                {
                    label: "Total #",
                    data: [],
                    backgroundColor: [
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)",
                        "rgb(255, 221, 0)"
                    ],
                    borderWidth: 1,
                },
            ],
        },
    }
    return config;
}

function stackedColumn(){
    var config = {
        type: 'bar',
        data: {
          labels: [],
          datasets: [
            {
                label: "Walk",
                data: [],
                backgroundColor: [
                        'rgb(0, 183, 236)',
                        'rgb(0, 183, 236)',
                        'rgb(0, 183, 236)'

                ],
                borderWidth: 3,
            },
            {
                label: "Jog",
                data: [],
                backgroundColor: [
                        'rgb(255, 221, 0)',
                        'rgb(255, 221, 0)',
                        'rgb(255, 221, 0)'
                ],
                borderWidth: 3,
            },
            {
                label: "Run",
                data: [],
                backgroundColor: [
                        "rgb(255, 140, 0)",
                        "rgb(255, 140, 0)",
                        "rgb(255, 140, 0)",
                    
                ],
                borderWidth: 3,
            },
        ],
        },
        options: {
          scales: {
            xAxes: [{ stacked: true,
                maxBarThickness: 16,
                gridLines: {
                    color: 'rgba(54, 53, 53)'
               } }],
            yAxes: [{ stacked: true,
                gridLines: {
                    color: 'rgba(54, 53, 53)'
               }
             }]
          },
        },
        
    }
    return config;
}