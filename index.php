<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Jamescape Store</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Comfortaa:300,400|Roboto+Condensed:700,700i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/store.css" />
	</head>
	<body>
		<section class="header">
			<a href="#">
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
		<section class="products">
			<div class="container">
				<h2>What's Hot</h2>
				<p>We're still selling all of our other merchandise items as normal through the our distribution partners, TShirt Studio! See what we've got on offer below...</p>
				<div class="row">
					<?php
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, "https://grumio.uk/cockpit/api/collections/get/merchandiseItem");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("populate" => 1)));
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
					$result = curl_exec($ch);
					curl_close($ch);

					$data = json_decode($result);

					foreach($data->entries as $entry)
					{
						echo
						'
						<div class="col-md-4 col-xl-3">
							<div class="product">
								<img src="https://grumio.uk' . $entry->images[0]->path . '" />
								<h5 class="black"><a href="product.php?id=' . $entry->_id . '&ret=' . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '">' . $entry->name . '</a></h5>
								<p class="lead">' . $entry->price . '</p>
								<div class="buyInfoButtons">
									<a href="' . $entry->purchaseUrl . '" class="btn btn-primary" target="_blank">Buy now</a><a href="product.php?id=' . $entry->_id . '&ret=' . urlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) . '" class="btn btn-light">More info</a>
								</div>
							</div>
						</div>
						';
					};
					?>
				</div>
			</div>
		</section>
		<section class="footer">
			<p>Copyright &copy; Jamescape MMXX</p>
		</section>
	</body>
</html>