<html>
<head>
	<style>
		.inner-left, .inner-right {
		width: 42%;
		padding: 4%;
		padding-top: 0px;
		}
		.container .eight.columns, .card {
			-webkit-box-shadow: 0px 0px 50px rgba(50, 50, 50, 0.2);
			-moz-box-shadow: 0px 0px 50px rgba(50, 50, 50, 0.2);
			box-shadow: 0px 0px 50px rgba(50, 50, 50, 0.2);
			padding: 5px;
			height: 100%;
			width: 100%;
			float: left;
			padding: 5px;
			text-align: center;
			text-transform: uppercase;
			font-weight: 900;
			font-family: 'Arial';
			font-size: 200%;
		}
		.card { text-decoration: none; background-color: #469ad0; }
		.card p { color: white; text-shadow: 1px 0 0 #000, -1px 0 0 #000, 0 1px 0 #000, 0 -1px 0 #000, 1px 1px #000, -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000; overflow: hidden; }
		.card:hover { 
		    -webkit-box-shadow: 0px 0px 100px rgba(70, 154, 208, 0.2);
			-moz-box-shadow: 0px 0px 100px rgba(70, 154, 208, 0.2);
			box-shadow: 0px 0px 100px rgba(70, 154, 208, 0.2);
			-webkit-transition: all 0.2s linear;
			-o-transition: all 0.2s linear;
			-moz-transition: all 0.2s linear;
			-ms-transition: all 0.2s linear;
			-kthtml-transition: all 0.2s linear;
			transition: all 0.2s linear;
		}
		.card-container {
				width: 20%;
				float: left;
				margin: 1.25%;
				height: 100px;
				padding: 1.25%;
		}
		@media all and (max-width: 1200px) {
		.container .main { width: 100%; }
		}
	</style>
</head>
<body style="overflow:hidden;">
<div class="container main content"> 
			  <?php 
				//Make the iterator for the temp directory 
				$dir = new DirectoryIterator('/var/www/subdomains'); 
				$dirs = [];
				foreach ($dir as $subdir) { 
					if (!$subdir->isDir() || $subdir->isDot()) continue; 

					$dirName = $subdir->getBaseName();
					//Print the subdirectory name 
					if (file_exists('/var/www/subdomains/' . $subdir . '/wp-login.php') == false && $subdir != 'ayal' && $subdir != 'samantha' && $subdir != 'test' ) {
						if (strpos($texthtml,'Hello World!') === false) {
							array_push($dirs, $subdir->getBaseName());
						}
					} 
				}
				
				$result = shuffle($dirs);
				$count = 0;
				//Loop through all the subdirectories 
				foreach ($dirs as $subdir) { 
					 $texthtml = file_get_contents('/var/www/subdomains/' . $subdir . '/index.html');
					 preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $texthtml, $image);
					 $imageURL = split("\"",$image['src'])[0];
					 if ($imageURL !== '') {
						 if (strpos($imageURL, 'http://') === false) { $imageURL = 'http://' . $subdir . '.codebykids.com/' . $imageURL;  }
					 }
					 if (strpos($texthtml,'Hello World!') === false) {
					
						?>
						<div class="card-container">
							<a class="card" style="background-image: url('<?php print $imageURL; ?>'); background-size: auto 100%; background-color: #469ad0;" href="http://<?php echo $subdir; ?>.codebykids.com" target="_blank"><p style="padding-top: 5px;"><?php echo $subdir; ?></p></a><br> 
						</div>
						<?php
						$count++;
						if ($count == 4) {
							break;
						}					
					}

				} 
			?>
	  </div>
</body>
</html>
