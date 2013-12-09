<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = 'about';
include('pages/header.php');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
        
        <div class="span9" id="content">
	        <!-- morris stacked chart -->
	        <div class="row-fluid">
	            <!-- block -->
	            <div class="block">
	                <div class="navbar navbar-inner block-header">
	                    <div class="muted pull-left">About</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                    	<h1>Wireless Sensor Network and Internet Protocol Interoperability</h1>
	                    	<small>&copy; Guntur D Putra 2013</small>
	                    	<hr>
	                    	<p>This application is intended for Wireless Sensor Network and Internet Protocol Integration</p>
	                    	<p>Source code are freely available at GitHub: 
	                    		<a href="https://github.com/gtrdp/wsn-ip-interoperability" target="_blank">github.com/gtrdp/wsn-ip-interoperability</a></p>
	                    </div>
	                </div>
	            </div>
	            <!-- /block -->
	        </div>
	    </div>
    </div>
    <hr>

<?php include('pages/footer.php'); ?>