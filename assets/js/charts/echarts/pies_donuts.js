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
            // var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);
            // var nested_pie = ec.init(document.getElementById('nested_pie'), limitless);
            // var infographic_donut = ec.init(document.getElementById('infographic_donut'), limitless);
            // var rose_diagram_hidden = ec.init(document.getElementById('rose_diagram_hidden'), limitless);
            // var rose_diagram_visible = ec.init(document.getElementById('rose_diagram_visible'), limitless);
            // var lasagna_donut = ec.init(document.getElementById('lasagna_donut'), limitless);
            // var pie_timeline = ec.init(document.getElementById('pie_timeline'), limitless);
            // var multiple_donuts = ec.init(document.getElementById('multiple_donuts'), limitless);


            // Charts setup
            // ------------------------------

            //
            // Basic pie options
            //

            basic_pie_options = {

                // Add title
                // title: {
                //     text: 'Browser popularity',
                //     subtext: 'Open source information',
                //     x: 'center'
                // },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                // legend: {
                //     orient: 'vertical',
                //     x: 'left',
                //     data: ['IE', 'Opera', 'Safari', 'Firefox', 'Chrome']
                // },

                // Display toolbox
                // toolbox: {
                //     show: true,
                //     orient: 'vertical',
                //     feature: {
                //         mark: {
                //             show: true,
                //             title: {
                //                 mark: 'Markline switch',
                //                 markUndo: 'Undo markline',
                //                 markClear: 'Clear markline'
                //             }
                //         },
                //         dataView: {
                //             show: true,
                //             readOnly: false,
                //             title: 'View data',
                //             lang: ['View chart data', 'Close', 'Update']
                //         },
                //         magicType: {
                //             show: true,
                //             title: {
                //                 pie: 'Switch to pies',
                //                 funnel: 'Switch to funnel',
                //             },
                //             type: ['pie', 'funnel'],
                //             option: {
                //                 funnel: {
                //                     x: '25%',
                //                     y: '20%',
                //                     width: '50%',
                //                     height: '70%',
                //                     funnelAlign: 'left',
                //                     max: 1548
                //                 }
                //             }
                //         },
                //         restore: {
                //             show: true,
                //             title: 'Restore'
                //         },
                //         saveAsImage: {
                //             show: true,
                //             title: 'Same as image',
                //             lang: ['Save']
                //         }
                //     }
                // },

                // Enable drag recalculate
                calculable: true,

                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: '60%',
                    center: ['35%', '57.5%'],
                    data: [
                        {value: 335, name: 'IE'},
                        {value: 310, name: 'Opera'},
                        {value: 234, name: 'Safari'},
                        {value: 135, name: 'Firefox'},
                        {value: 1548, name: 'Chrome'}
                    ]
                }]
            };





            // Apply options
            // ------------------------------

            basic_pie.setOption(basic_pie_options);
            basic_donut.setOption(basic_donut_options);
            nested_pie.setOption(nested_pie_options);
            infographic_donut.setOption(infographic_donut_options);
            rose_diagram_hidden.setOption(rose_diagram_hidden_options);
            rose_diagram_visible.setOption(rose_diagram_visible_options);
            lasagna_donut.setOption(lasagna_donut_options);
            pie_timeline.setOption(pie_timeline_options);
            multiple_donuts.setOption(multiple_donuts_options);



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
