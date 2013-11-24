            <footer>
                <p>Wireless Sensor Network and Internet Protocol Integration<br>
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
              var fahrenheit = Math.round(((9/5) * data) + 32);
              $('#celsius').html(data + '&deg;C');
              $('#fahrenheit').html(fahrenheit + '&deg;F');
            });
        }
        </script>
    </body>

</html>