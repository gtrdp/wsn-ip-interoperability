            <footer>
                <p>Wireless Sensor Network and Internet Protocol Interoperability<br>
                &copy; Guntur D Putra 2013</p>
            </footer>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap-switch.min.js"></script>
        <script src="assets/scripts.js"></script>

        <?php if ($page == 'dashboard'): ?>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script type="text/javascript" src="vendors/chartjs/knockout-3.0.0.js"></script>
        <script type="text/javascript" src="vendors/chartjs/globalize.min.js"></script>
        <script type="text/javascript" src="vendors/chartjs/dx.chartjs.js"></script>
    
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 3000, barColor: '#006600'});

            //boostrap-switch
            $('.button-relay').on('switch-change', function () {
                var value = $(this).parent().siblings('.chart-relay').attr('data-percent');

                // Find status
                $(this).parent().siblings('.chart-relay').find('.status-relay').text(value == 100 ? 'OFF':'ON');
                // Update the pie chart
                $(this).parent().siblings('.chart-relay').data('easyPieChart').update(100 - value);
                // Update the attribute
                $(this).parent().siblings('.chart-relay').attr('data-percent', 100 - value);

                // Get the atmy and relay ID
                var atmy = $(this).attr('atmy');
                var relayID = $(this).attr('relay-id');

                //Ajax to change the XBee's relay
                var status = $(this).find('.relay-checkbox').is(':checked')? 'on': 'off';
                console.log(status);
                $.get('script/action.php?status=' + status + '&relay=' + relayID + '&atmy=' + atmy);
            });
        });
        </script>
        <script>
        // Script for keep updating every 300 milisecond
        $(document).ready(function(){
            setInterval(function(){getTemperature()}, 300);
        });

        function getTemperature(){
            $('.temperatureGauge').each(function(){
                var theObject = $(this);
                var nodeAddress = $(this).attr('node');

                $.get("script/temperature.php?node=" + nodeAddress, function(data,status){
                    var gauge = theObject.dxCircularGauge('instance');
                    if(data){
                        gauge.value(data);
                        gauge.subvalues([data]);
                    }
                });
            });
        }
        </script>

        <script type="text/javascript">
            $(".temperatureGauge").dxCircularGauge({
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
                value: 27,
                subvalues: [27]
            });
        </script>  

        <?php elseif ($page == 'profile'): ?>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script type="text/javascript" src="vendors/chartjs/knockout-3.0.0.js"></script>
        <script type="text/javascript" src="vendors/chartjs/globalize.min.js"></script>
        <script type="text/javascript" src="vendors/chartjs/dx.chartjs.js"></script>
        
        <script src="vendors/bootstrap-datepicker.js"></script>
        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery.timepicker.js"></script>
        <link href="vendors/jquery.timepicker.css" rel="stylesheet" media="screen">

        <script type="text/javascript" src="vendors/jquery.mousewheel.js"></script>
        
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000, barColor: '#006600'});

            //boostrap-switch
            $('.button-relay').on('switch-change', function () {
                var value = $(this).parent().siblings('.chart-relay').attr('data-percent');

                // Find status
                $(this).parent().siblings('.chart-relay').find('.status-relay').text(value == 100 ? 'OFF':'ON');
                // Update the pie chart
                $(this).parent().siblings('.chart-relay').data('easyPieChart').update(100 - value);
                // Update the attribute
                $(this).parent().siblings('.chart-relay').attr('data-percent', 100 - value);

                // Get the atmy and relay ID
                var atmy = $(this).attr('atmy');
                var relayID = $(this).attr('relay-id');

                //Ajax to change the XBee's relay
                //var status = $(this).find('.relay-checkbox').is(':checked')? 'on': 'off';
                //console.log(status);
                //$.get('script/action.php?status=' + status + '&relay=' + relayID + '&atmy=' + atmy);
            });
        });
        </script>
        

        <script type="text/javascript">
            $(".temperatureGauge").dxCircularGauge({
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

            $('.temperatureGauge').bind('mousewheel', function(event) {
                var gauge = $(this).dxCircularGauge('instance');
                var value = gauge.value();
                var subValue = gauge.subvalues();
                
                gauge.value(value + (event.deltaY/500));
                gauge.subvalues([subValue[0] + (event.deltaY/500)]);
                return false;
            });
        </script>

        <?php elseif ($page == 'xbee'): ?>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>

        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 3000, barColor: '#006600'});

            //boostrap-switch
            $('.button-relay').on('switch-change', function () {
                var value = $(this).parent().siblings('.chart-relay').attr('data-percent');

                // Find status
                $(this).parent().siblings('.chart-relay').find('.status-relay').text(value == 100 ? 'OFF':'ON');
                // Update the pie chart
                $(this).parent().siblings('.chart-relay').data('easyPieChart').update(100 - value);
                // Update the attribute
                $(this).parent().siblings('.chart-relay').attr('data-percent', 100 - value);

                // Get the atmy and relay ID
                var atmy = $(this).attr('atmy');
                var relayID = $(this).attr('relay-id');

                //Ajax to change the XBee's relay
                var status = $(this).find('.relay-checkbox').is(':checked')? 'on': 'off';
                console.log(status);
                $.get('script/action.php?status=' + status + '&relay=' + relayID + '&atmy=' + atmy);
            });
        });
        </script>

        <?php elseif ($page == 'iqrf'): ?>
        <script type="text/javascript" src="vendors/chartjs/knockout-3.0.0.js"></script>
        <script type="text/javascript" src="vendors/chartjs/globalize.min.js"></script>
        <script type="text/javascript" src="vendors/chartjs/dx.chartjs.js"></script>

        <script type="text/javascript">
            $(".temperatureGauge").dxCircularGauge({
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
                value: 27,
                subvalues: [27]
            });
        </script>

        <script>
        // Script for keep updating every 300 milisecond
        $(document).ready(function(){
            setInterval(function(){getTemperature()}, 300);
        });

        function getTemperature(){
            $('.temperatureGauge').each(function(){
                var theObject = $(this);
                var nodeAddress = $(this).attr('node');

                $.get("script/temperature.php?node=" + nodeAddress, function(data,status){
                    var gauge = theObject.dxCircularGauge('instance');
                    if(data){
                        gauge.value(data);
                        gauge.subvalues([data]);
                    }
                });
            });
        }
        </script>
        <?php endif; ?>


        <?php if ($page == 'iqrf' || $page == 'xbee'): ?>
        <script type="text/javascript" src="vendors/spin.min.js"></script>

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
                if(device == 'iqrf')
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

        <?php endif;?>
    </body>

</html>