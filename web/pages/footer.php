            <footer>
                <p>Wireless Sensor Network and Internet Protocol Interoperability<br>
                &copy; Guntur D Putra 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap-switch.min.js"></script>
        
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>

        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>

        <script type="text/javascript" src="vendors/chartjs/knockout-2.2.1.js"></script>
        <script type="text/javascript" src="vendors/chartjs/globalize.min.js"></script>
        <script type="text/javascript" src="vendors/chartjs/dx.chartjs.js"></script>

        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000, barColor: '#006600'});

            //boostrap-switch
            $('.button-relay-1').on('switch-change', function () {
                var value = $('.chart-relay-1').attr('data-percent');
                $('.status-relay-1').text(value == 100 ? 'OFF':'ON');
                $('.chart-relay-1').data('easyPieChart').update(100 - value);
                $('.chart-relay-1').attr('data-percent', 100 - value);

                var status = $('#relay1').is(':checked')? 'on': 'off';
                $.get('script/action.php?status=' + status + '&relay=1');
            });
            $('.button-relay-2').on('switch-change', function () {
                var value = $('.chart-relay-2').attr('data-percent');
                $('.status-relay-2').text(value == 100 ? 'OFF':'ON');
                $('.chart-relay-2').data('easyPieChart').update(100 - value);
                $('.chart-relay-2').attr('data-percent', 100 - value);

                var status = $('#relay2').is(':checked')? 'on': 'off';
                $.get('script/action.php?status=' + status + '&relay=2');
            });
        });
        </script>
        <script>
        $(document).ready(function(){
            setInterval(function(){getTemperature()}, 300);
        });

        function getTemperature(){
            $.get("script/temperature.php", function(data,status){
                var gauge = $('#gaugeContainer').dxCircularGauge('instance');
                if(data){
                    gauge.needleValue(0, data);
                    gauge.markerValue(0, data);
                }
            });
        }
        </script>

        <script type="text/javascript">
            $("#gaugeContainer").dxCircularGauge({
                scale: {
                    startValue: 0,
                    endValue: 60,
                    majorTick: {
                        color: 'black',
                        tickInterval : 10
                    },
                    minorTick: {
                        visible: true,
                        color: 'black',
                        tickInterval : 1
                    }
                },
                rangeContainer: {
                    backgroundColor: 'none',
                    ranges: [
                        {
                            startValue: 0,
                            endValue: 20,
                            color: 'blue'
                        },
                        {
                            startValue: 20,
                            endValue: 40,
                            color: 'green'
                        },
                        {
                            startValue: 40,
                            endValue: 60,
                            color: 'red'
                        }
                    ],
                    offset: 5,
                },
                needles: [{ value: 24}],
                markers: [{ value: 24 }]
            });

            function ganti(){
                var gauge = $('#gaugeContainer').dxCircularGauge('instance');
                gauge.needleValue(0, 23);
                gauge.markerValue(0, 23);
            }
        </script>
    </body>

</html>