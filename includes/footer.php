    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                   <?php
						// Define timezone local
						setlocale(LC_ALL, 'pt_PT', 'pt_PT.utf-8', 'pt_PT.utf-8', 'portuguese');
						// setlocale(LC_ALL, "pt_PT", "pt_PT.iso-8859-1", "pt_PT.utf-8", "portuguese");
						date_default_timezone_set('Europe/Lisbon');

						$date = date("Y"); 	// ou date("Y/m/d") date("Y-m-d")
						
					?>
                    <p>Copyright &copy; ESEN - SiteName - <?php echo strftime("%Y", strtotime( $date )); ?></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo $domain; ?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $domain; ?>js/bootstrap.min.js"></script>

</body>

</html>
