/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - bars
 *
 *  Google Visualization bar chart demonstration
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */


// Bar chart
// ------------------------------

// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawBar);


// Chart settings
function drawBar() {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Year', 'Sales', {role: 'annotation'}, 'Expenses', 'Sachin', 'Om', {role: 'annotation'}],
        ['2004',  1000, 'asjkas',      400,      500,      800, 'test']
    ]);


    // Options
    var options_bar = {
        fontName: 'Roboto',
        height: 200,
        width: 500,
        fontSize: 12,
        Label: true,
        chartArea: {
            left: '10%',
            width: '100%',
            height: 150
        },
        tooltip: {
            textStyle: {
                fontName: 'Roboto',
                fontSize: 10
            }
        },
        vAxis: {
            gridlines:{
                color: '#e5e5e5',
                count: 10
            },
            minValue: 0
        },
        // legend: {
        //     position: 'top',
        //     alignment: 'center',
        //     textStyle: {
        //         fontSize: 10
        //     }
        // }
    };

    // Draw chart
    var bar = new google.visualization.BarChart($('#google-bar')[0]);
    bar.draw(data, options_bar);

}


// Resize chart
// ------------------------------

$(function () {

    // Resize chart on sidebar width change and window resize
    $(window).on('resize', resize);
    $(".sidebar-control").on('click', resize);

    // Resize function
    function resize() {
        drawBar();
    }
});
