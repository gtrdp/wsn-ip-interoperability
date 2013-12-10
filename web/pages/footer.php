            <footer>
                <p>Wireless Sensor Network and Internet Protocol Interoperability<br>
                &copy; Guntur D Putra 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap-switch.min.js"></script>

        <script src="vendors/bootstrap-datepicker.js"></script>
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery.timepicker.js"></script>
        <link href="vendors/jquery.timepicker.css" rel="stylesheet" media="screen">

        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>

        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>

        <script type="text/javascript" src="vendors/chartjs/knockout-3.0.0.js"></script>
        <script type="text/javascript" src="vendors/chartjs/globalize.min.js"></script>
        <script type="text/javascript" src="vendors/chartjs/dx.chartjs.js"></script>

        <script type="text/javascript" src="vendors/jquery.mousewheel.js"></script>

        <script type="text/javascript" src="vendors/spin.min.js"></script>
        
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $('#waktu').timepicker();

            // Datepicker
            $('#optionsCheckbox').change(function() {
                if($(this).is(":checked")) {
                    $('#enabledDatetime').show();
                    $('#disabledDatetime').hide();
                }else{
                    $('#enabledDatetime').hide();
                    $('#disabledDatetime').show();
                }
                
            });

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
                    gauge.value(data);
                    gauge.subvalues([data]);
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
                subvalueIndicator: {
                    type: 'textcloud',
                    color: 'powderblue',
                    text: {
                        format: 'fixedPoint',
                        precision: 1,
                        font: {
                            color: 'white'
                        }
                    }
                },
                value: 24,
                subvalues: [24]
            });

            $("#gaugeSetting").dxCircularGauge({
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
                subvalueIndicator: {
                    type: 'textcloud',
                    color: 'powderblue',
                    text: {
                        format: 'fixedPoint',
                        precision: 1,
                        font: {
                            color: 'white'
                        }
                    }
                },
                value: 24,
                subvalues: [24]
            });

            $('#gaugeSetting').bind('mousewheel', function(event) {
                var gauge = $('#gaugeSetting').dxCircularGauge('instance');
                var value = gauge.value();
                var subValue = gauge.subvalues();
                
                gauge.value(value + (event.deltaY/500));
                gauge.subvalues([subValue[0] + (event.deltaY/500)]);
                return false;
            });

            /*
            function ganti(){
                var gauge = $('#gaugeContainer').dxCircularGauge('instance');
                gauge.needleValue(0, 23);
                gauge.markerValue(0, 23);
            }*/
        </script>

        <script type="text/javascript">
            var opts = {
              lines: 13, // The number of lines to draw
              length: 20, // The length of each line
              width: 8, // The line thickness
              radius: 30, // The radius of the inner circle
              corners: 1, // Corner roundness (0..1)
              rotate: 0, // The rotation offset
              direction: 1, // 1: clockwise, -1: counterclockwise
              color: '#000', // #rgb or #rrggbb or array of colors
              speed: 1, // Rounds per second
              trail: 60, // Afterglow percentage
              shadow: false, // Whether to render a shadow
              hwaccel: false, // Whether to use hardware acceleration
              className: 'spinner', // The CSS class to assign to the spinner
              zIndex: 2e9, // The z-index (defaults to 2000000000)
              top: 'auto', // Top position relative to parent in px
              left: 'auto' // Left position relative to parent in px
            };
            var target = document.getElementById('content');
            var spinner = new Spinner(opts);
            //spinner.spin(target);

            function startSpin() {
                spinner.spin(target);

                var device  = document.getElementById('deviceType').value;
                var address = document.getElementById('address').value;
                alert('Push the button on specified node NOW!');
                $.get("script/add-device.php?device=" + device + "&address=" + address, function(data,status){
                    if(data){
                        alert(data);
                        spinner.stop();
                        location.href = 'add-device.php?device=' + device;
                    }
                });
                return false;
            }
        </script>
    </body>

</html>