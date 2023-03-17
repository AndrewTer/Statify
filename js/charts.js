"use strict";

var Charts = (function () {
    function Charts(chart_labels, values) {
        switch (localStorage.getItem("theme")) {
            case 'darkness':
            case 'dark-sapphire':
                this.tickColor = "lightgray";
                this.linesColor = "#07689F";
                this.borderColor = "#00FFFF";
                break;

            case 'spotted':
                this.tickColor = "ghostwhite";
                this.linesColor = "#0191e2";
                this.borderColor = "#00FFFF";
                break;

            case 'bahama-blue':
                this.tickColor = "#262626";
                this.linesColor = "lightgray";
                this.borderColor = "#3886B2";
                break;

            default:
                this.tickColor = "lightgray";
                this.linesColor = "#07689F";
                this.borderColor = "#00FFFF";
                break;
        }
        
        this.initRadar(chart_labels, values);
    }
    Charts.prototype.initRadar = function (chart_labels, values) {
        var ctxD = $('#radarChartDark'), chartData = {
            type: 'radar',
            data: {
                labels: chart_labels,
                datasets: [
                    {
                        backgroundColor: this.convertHex("#2ACAEA", 40),
                        borderColor: this.borderColor,
                        borderWidth: 2,
                        pointRadius: 3,
                        data: values
                    }
                ]
            },
            options: {
                scale: {
                    pointLabels: {
                        fontColor: this.tickColor,
                        fontSize: 12
                    },
                    gridLines: {
                        color: this.linesColor
                    },
                    angleLines: {
                        color: this.linesColor
                    },
                    ticks: {
                        display: false,
                        max: 100,
                        min: 0,
                        stepSize: 20
                    }
                },
                tooltips: {
                    displayColors: false,
                    callbacks: {
                        label: function(tooltipItems, data) { 
                            return tooltipItems.yLabel + '%';
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        }, myDarkRadarChart = new Chart(ctxD, chartData);
    };
    
    Charts.prototype.convertHex = function (hex, opacity) {
        hex = hex.replace('#', '');
        var r = parseInt(hex.substring(0, 2), 16);
        var g = parseInt(hex.substring(2, 4), 16);
        var b = parseInt(hex.substring(4, 6), 16);
        var result = 'rgba(' + r + ',' + g + ',' + b + ',' + opacity / 100 + ')';
        return result;
    };
    return Charts;
}());

switch(user_gender) {
    case 'male':
        var gender_chart = 'Мужчины';
        break;
    case 'female':
        var gender_chart = 'Женщины';
        break;
    default:
        var gender_chart = 'По полу';
        break;
};

if (among_all == 1) {
    var chart_users = 100;
} else {
    var chart_users = Math.round(100-(among_all/all_users)*100);
}

if (among_gender == 1) {
    var chart_gender = 100;
} else {
    var chart_gender = Math.round(100-(among_gender/all_gender)*100);
}

if (among_friends == 1) {
    var chart_friends = 100;
} else {
    var chart_friends = Math.round(100-(among_friends/all_friends)*100);
}

if (among_city == 1) {
    var chart_city = 100;
} else {
    var chart_city = Math.round(100-(among_city/all_city)*100);
}

if (among_country == 1) {
    var chart_country = 100;
} else {
    var chart_country = Math.round(100-(among_country/all_country)*100);
}

var labels = ['Все пользователи', gender_chart, 'Друзья', 'По городу', 'По стране'];

var values = [chart_users, chart_gender, chart_friends, chart_city, chart_country];

var myChart = new Charts(labels, values);