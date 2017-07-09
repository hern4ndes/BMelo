<?php include ("header.php");?>
				<div id="page-heading">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<h1>Encontre-nos</h1>
								<span>...</span>
							</div>
						</div>
					</div>
				</div>

				<section class="contact-form">
					<div class="container">
						<div class="row">
                            <div class="col-md-4">
								<div class="right-info">
									<h4>Encontre-nos</h4>
                                    <div class="line-dec"></div>
                                    <p><?php echo nl2br($institucional->texto_encontre_nos);?></p>
                                    <ul>
                                        <li><i class="fa fa-phone"></i><?php echo $institucional->telefones;?></li>
                                        <li><i class="fa fa-envelope"></i><?php echo $institucional->email;?></li>
                                        <li><i class="fa fa-clock-o"></i><?php echo $institucional->funcionamento;?></li>
                                    </ul>
								</div>

							</div>
                            <div class="map">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</section>
                <!-- Google Map Init-->
                <script src="https://maps.googleapis.com/maps/api/js"></script>
                <script>
                    function initialize() {
                        var mapCanvas = document.getElementById('map');
                        var mapOptions = {
                            center: new google.maps.LatLng(-5.08542724, -42.81084538),
                            zoom: 20,
                            scrollwheel: true,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        }
                        var map = new google.maps.Map(mapCanvas, mapOptions)
                    }
                    google.maps.event.addDomListener(window, 'load', initialize);
                </script>
<?php include ("footer.php");?>