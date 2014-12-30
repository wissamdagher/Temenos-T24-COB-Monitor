<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>New COB</h2>

		<div>
			A new COB has been loaded in the system:
			COB Date: {{ $cob_date}}
			To view COB data, follow this link: {{ URL::to('/dashboard', array($cob_date)) }}.
		</div>
	</body>
</html>
