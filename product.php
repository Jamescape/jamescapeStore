<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Jamescape Store</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Comfortaa:300,400|Roboto+Condensed:700,700i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/store.css" />

		<script src="js/cookies.js" type="text/javascript"></script>
	</head>
	<body onload="checkAndShowPrompt();">
		<div id="cookies">
			<div class="container">
				<p>We use cookies to make your experience on our website better. Read our <a href="https://jamescape.net/permalink/cookiepolicy.html" target="_blank">Cookie Policy</a> for more information.</p>
				<button class="btn btn-light" onclick="setAndHidePrompt();">I agree to the use of cookies</button>
			</div>
		</div>
		<section class="header">
			<a href="index.php">
				<div class="container">
					<h1 class="display-5"><span class="regular">Jamescape</span> <span class="light">Store</span></h1>
				</div>
			</a>
		</section>
		<section class="feature">
			<div class="container">
				<h2 class="white">Limited Edition Jamescape TV Does Dartmoor Merch</h2>
				<p class="lead">Just because the series is over, it doesn't mean the fun is! Get your Dartmoor merch while you still can...</p>
				<a href="https://store.jamescape.net/collection.php?id=5e5d15a53132630ccc0000e6" class="btn btn-light btn-lg">Show me!</a>
			</div>
		</section>
		<section class="main">
			<div class="container">
				<?php
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, "https://grumio.uk/cockpit/api/collections/get/merchandiseItem");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("populate" => 1, "filter" => array("_id" => $_GET['id']))));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
				$result = curl_exec($ch);
				curl_close($ch);

				$data = json_decode($result);

				if (isset($_GET['ret']))
				{
					$returnLink = 'http://' . urldecode($_GET['ret']);
				}
				else
				{
					$returnlink = 'index.php';
				}

				if ($data->total > 0)
				{
					$entry = $data->entries[0];

					echo
					'
					<div class="row">
						<div class="col-md-4">
							<div id="productCarousel" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">';

									$i = 0;

									foreach ($entry->images as $image)
									{
										if ($i == 0)
										{
											echo '<li data-target="#productCarousel" data-slide-to="' . $i . '" class="active"></li>';
										}
										else
										{
											echo '<li data-target="#productCarousel" data-slide-to="' . $i . '"></li>';
										}

										++$i;
									}

					echo
								'</ol>
								<div class="carousel-inner">';

								$i = 0;

								foreach($entry->images as $image)
								{
									if ($i == 0)
									{
										echo
										'<div class="carousel-item active">
											<img src="https://grumio.uk' . $image->path . '" class="d-block w-100" />
										</div>';
									}
									else
									{
										echo
										'<div class="carousel-item">
											<img src="https://grumio.uk' . $image->path . '" class="d-block w-100" />
										</div>';
									}

									++$i;
								}
								
					echo
								'</div>';

								if (count($entry->images) > 1)
								{
									echo
									'
									<a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>	
									';
								}
					echo
								'</div>
						</div>
						<div class="col-md-8">
							<h2>' . $entry->name . '</h2>
							<p><a href="collection.php?id=' . $entry->collection->_id . '">' . $entry->collection->name . '</a></p>
							<p class="lead">' . $entry->price . '</p>
							<p>' . $entry->description . '</p>
							<div class="buyInfoButtons">
								<a href="' . $entry->purchaseUrl . '" target="_blank" class="btn btn-lg btn-primary">Buy now</a>
								<a href="'. $returnLink . '" class="btn btn-lg btn-dark">Go back</a>
							</div>
						</div>
					</div>
					';

					if (isset($entry->type->sizingGuide) && $entry->type->sizingGuide != "")
					{
						echo
						'<h3>Sizing Guide</h3>' . $entry->type->sizingGuide;
					}
				}
				else
				{
					echo
					'
					<h2>Product not found</h2>
					<p>Unfortunely we could not find the product you asked us to look for. This could be because the product is not being sold any more or due to an error in the link.</p>
					';
				}
				?>
			</div>
		</section>
		<section class="footer">
			<p>Copyright &copy; Jamescape MMXX</p>
		</section>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>