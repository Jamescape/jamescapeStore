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
							<img class="productImage" src="https://grumio.uk' . $entry->images[0]->path . '" />
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
					else
					{
						echo 'notfound';
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
	</body>
</html>