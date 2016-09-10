/* ------------------------------------------------------------------------------
 *
 *  # Google Visualization - sliced 3D donut
 *
 *  Google Visualization sliced 3D donut chart demonstration
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */


// Sliced 3D donut chart
// ------------------------------

// Initialize chart
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawExploded3d);


// Chart settings
function drawExploded3d() {

    // Data
    var data = google.visualization.arrayToDataTable([
        ['Language', 'Speakers (in millions)'],
        ['Assamese', 1103],
        ['Bengali', 83]
    ]);


    // Options
    var options = {
        fontName: 'Roboto',
        height: 200,
        width: 240,
        chartArea: {
            left: 50,
            width: '100%',
            height: '100%'
        },
        is3D: true,
        pieSliceText: 'label',
        slices: {
            2: {offset: 0.15},
            8: {offset: 0.1},
            10: {offset: 0.15},
            11: {offset: 0.1}
        }
    };


    // Instantiate and draw our chart, passing in some options.
    var pie_3d_exploded = new google.visualization.PieChart($('#google-3d-exploded')[0]);
    pie_3d_exploded.draw(data, options);

    var pie_3d_exploded = new google.visualization.PieChart($('#google-3d-exploded_1')[0]);
    pie_3d_exploded.draw(data, options);
}