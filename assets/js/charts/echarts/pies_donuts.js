/* ------------------------------------------------------------------------------
 *
 *  # Echarts - pies and donuts
 *
 *  Pies and donuts chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {

    // Set paths
    // ------------------------------

    require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
        }
    });


    // Configuration
    // ------------------------------

    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/pie',
            'echarts/chart/funnel'
        ],


        // Charts setup
        function (ec, limitless) {

            // Initialize charts
            // ------------------------------

            var basic_pie = ec.init(document.getElementById('basic_pie'), limitless);

            //
            // Basic pie options
            //

            basic_pie_options = {

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Enable drag recalculate
                calculable: true,

                // Add series

                    series: [{
                        name: 'Browsers',
                        type: 'pie',
                        radius: '60%',
                        center: ['35%', '57.5%'],
                        data: eval(Vehicle_RoadMemo_DailyQuantity)
                    }]

            };





            // Apply options
            // ------------------------------

            basic_pie.setOption(basic_pie_options);
            basic_donut.setOption(basic_donut_options);
            // nested_pie.setOption(nested_pie_options);
            // infographic_donut.setOption(infographic_donut_options);
            // rose_diagram_hidden.setOption(rose_diagram_hidden_options);
            // rose_diagram_visible.setOption(rose_diagram_visible_options);
            // lasagna_donut.setOption(lasagna_donut_options);
            // pie_timeline.setOption(pie_timeline_options);
            // multiple_donuts.setOption(multiple_donuts_options);



            // Resize charts
            // ------------------------------

            window.onresize = function () {
                setTimeout(function (){
                    basic_pie.resize();
                    basic_donut.resize();
                    nested_pie.resize();
                    infographic_donut.resize();
                    rose_diagram_hidden.resize();
                    rose_diagram_visible.resize();
                    lasagna_donut.resize();
                    pie_timeline.resize();
                    multiple_donuts.resize();
                }, 200);
            }
        }
    );
});
