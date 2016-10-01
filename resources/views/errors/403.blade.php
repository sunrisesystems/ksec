<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>No Access</title>	
	<style type="text/css">
		/*
		Author:Imran Shaikh
		Author Url: www.iwebkreative.com
		CSS Name: Errors
		CSS Version: 0.0.1v;
		*/

		@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700);

		* {
			padding: 0;
			margin: 0;
		}

		html,
		body {
			height: 100%;
		}

		body {
			font-family: 'Open Sans', sans-serif;
			background-color: #f3f3f4;
		}

		body p {
			font-family: 'Open Sans', sans-serif;
			font-size: 14px;
			line-height: normal;
			margin-bottom: 10px;
		}

		h1,h2,h3,h4 {
			line-height: normal;
			font-weight: 600;
			font-family: 'Open Sans', sans-serif;
		}

		.pageWrapper {
			position: relative;

			margin: 0 auto;
			max-width: 960px;
			text-align: center;
		}
		/* action */
		.button {
			-moz-user-select: none;
			background-image: none;
			border: 1px solid transparent;
			cursor: pointer;
			display: inline-block;
			font-size: 14px;
			font-weight: normal;
			line-height: 1.42857;
			margin-bottom: 0;
			padding: 6px 12px;
			text-align: center;
			vertical-align: middle;
			white-space: nowrap;
		}
		.button.button-accent {
			color: #fff;
			background-color: #c70000;
		}
		.button:hover {
			background-image: none;
			box-shadow: 0 3px 5px rgba(0, 0, 0, 0.125) inset;
			outline: 0 none;
		}
		/*
			error pages
			1) No Access
		*/



		/* no access */
		.pageWrapper {
			height: 100%;
			min-height: 100%;
		}
		.errorContainer {
			display:table;
			width: 100%;
			height: 100%;
		}
		.errorInnerWrapper {
			display: table-cell;
			vertical-align: middle;
		}
		.errorImgWrapper {
			border-radius: 105px;
			height: 105px;
			margin: 15px auto;
			opacity: 0.1;
			width: 105px;
		}
		.errorImgWrapper img {
			width: 100%;
		}

		.errorContent h2 {
			font-size: 42px;
			color: #212121;
		}
		.errorContent p {
			color: #727272;
			font-size: 18px;
		}
		.errorContent a,
		.errorContent a:hover,
		.errorContent a:focus {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="pageWrapper">
		<div class="errorContainer">
			<div class="errorInnerWrapper">
				<div class="errorContentWrapper">
				<div class="errorImgWrapper">
					<img src="{!! asset('images/no-access.png') !!}" alt="" />
				</div>
				<div class="errorContent">
					<h2>OOPS!</h2>
					<p>Sorry, you don't have access to this page.</p>
					
					<div class="error-action">
						<a class="button button-accent" href="{{URL::to('/')}}">
							Back to Home          
						</a>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>