<html>
    <head>
        <title> </title>
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://codeorigin.jquery.com/jquery-2.0.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>


        <style type=text/css>
            BODY {
			FONT-FAMILY: "Helvetica Neue", Helvetica, Arial, sans-serif;}
            #turnkey-credit #override { display: none; }
			.row {
			  margin-left: 0px;
			  margin-right: 0px;
			}
			.page-header{
				padding-bottom:5px;
				margin:20px 0 20px;
				border-bottom:1px solid #eee
			}
			img {height:200px;}
        </style>
		<script>
			$( document ).ready(function() {

				//Update the status buttons onload
				$('.status').each(function(){
					var btn=$(this)
                    btn.button('loading')
					updatestatus(btn.parent().attr("id"))
				})

				function getstatus(service) {
					return $.get( "ajax.php", { servicestatus:service } )

				};


				function updatestatus(service){
					getstatus(service)
						.done(function(data)
						{	var btn='#'+service+'status'
							if (data==0)
							{
								$(btn).button('reset')
								$(btn).html('Running')
								$(btn).removeClass("btn-danger")
								$(btn).addClass("btn-success")
							} else {
								$(btn).button('reset')
								$(btn).html('Down')
								$(btn).removeClass("btn-success")
								$(btn).addClass("btn-danger")
							}
						})
				}

			 	$('.start').click(function () {
					var btn = $(this)
					var statusbtn = '#'+btn.parent().attr("id")+'status'
					$(statusbtn).button('loading')
					btn.button('loading')

					$.get( "ajax.php", { service: btn.parent().attr("id"), action: "start" } )
						.done(function(result)
							{
								btn.button('reset');
								btn.toggleClass("btn-success",1000);
								btn.html("<span class='glyphicon glyphicon-ok'></span> Done");
								updatestatus(btn.parent().attr("id"))
							});
				});
				$('.stop').click(function () {
					var btn = $(this)
					var statusbtn = '#'+btn.parent().attr("id")+'status'
					$(statusbtn).button('loading')
					btn.button('loading')

					$.get( "ajax.php", { service: btn.parent().attr("id"), action: "stop" } )
						.done(function(result)
							{
								updatestatus(btn.parent().attr("id"))
								btn.button('reset');
								btn.addClass("btn-success",1000);
								btn.html("<span class='glyphicon glyphicon-ok'></span> Done");


							});
				});

			});
		</script>
    </head>
    <body>
		<?php
			require 'config.php';
			$sbfeed=$url.":".$sbport."/api/".$sbkey."/";

		?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 ">
					<div class="row">
						<div class="col-md-12">

							<!-- Services -->
							<div class="page-header">
								<h2>Services</h2>
							</div>
							<table class="table">
								<?php foreach($services as $x) { ?>
								<tr>
									<td><?php echo $x ?>:</td>
									<td id="<?php echo $x; ?>">
										<button type="button" id="<?php echo $x; ?>status"  class="btn btn-success btn-sm status" data-loading-text="Refreshing!">Running</button>
									</td>
									<td>
										<div class="btn-group" id="<?php echo $x;?>">
											<button type="button" id="start" class="btn btn-default btn-sm start" data-toggle="button" data-loading-text="Please Wait!">Start</button>
											<button type="button" id="stop" class="btn btn-default btn-sm stop" data-toggle="button" data-loading-text="Please Wait!">Stop</button>
										</div>
									</td>
								</tr>
								<?php }; ?>
							</table>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="page-header"><h2>
								System Information</h2>
							</div>
							<b>Uptime:</b>
							<?php system("uptime"); ?>
							<br/>
							<b>Memory Usage (MB):</b>
							<pre><?php system("free -t -mo | grep 'Total\|total'"); ?></pre> 
							<br/>

							<b>Disk Usage:</b>
							<pre><?php system("df -h |grep -E '^(/dev|File)'"); ?></pre>
						</div>
					</div>
				</div>
                <div class="col-sm-7">
                    <?php
                    $feed=$sbfeed."?cmd=future";
                    $sbJSON = json_decode(file_get_contents($feed));
                    echo "<div class='page-header'><h2>Coming Soon</h2></div>";?>

                    <div class="row"><?php
                        foreach($sbJSON->{data}->{today} as $show) {?>
                        <div class="col-sm-5 col-md-4"><?php
                            $newDate = date("j M Y", strtotime($show->{airdate}));
                            $posterurl=$sbfeed."?cmd=show.getposter&tvdbid=".$show->{tvdbid};?>
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img class="img-rounded" src="<?php echo  $posterurl ?>"><br />
                                </div>
                                <div class="panel-footer">
                                    <b>Airs:</b> <?php echo $newDate ?> <br />
                                </div>
                            </div>

                        </div>
						<?php }
                        foreach($sbJSON->{data}->{soon} as $show) {?>
                        <div class="col-sm-5 col-md-4"><?php
                            $newDate = date("j M Y", strtotime($show->{airdate}));
                            $posterurl=$sbfeed."?cmd=show.getposter&tvdbid=".$show->{tvdbid};?>
                            <div class="panel panel-default text-center">
                                <div class="panel-body">
                                    <img class="img-rounded" src="<?php echo  $posterurl ?>"><br />
                                </div>
                                <div class="panel-footer">
                                    <b>Airs:</b> <?php echo $newDate ?> <br />
                                </div>
                            </div>

                        </div>
                        <?php }?>
                    </div>

                </div><!--col-md-7-->
            </div>

        </div>


    </body>
</html>



