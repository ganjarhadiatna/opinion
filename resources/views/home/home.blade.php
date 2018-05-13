<!DOCTYPE html>
<html>
<head>
	<title>Pictlr - Welcome</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('/img/pictlr-4.png') }}" rel='SHORTCUT ICON'/>

	<!-- SASS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('sass/main.css') }}">

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
</head>
<body>
<div class="frame-guess">
	<div class="block theme-2 bdr-bottom">
		<!--
		<div class="logo" style="background-image: url('{{ asset('/img/6.png') }}')"></div>
		-->
		<div class="ttl ctn-main-font ctn-small ctn-center padding-10px">
			You Have New World Now.
		</div>
	</div>
	<div class="block theme-1">
		<div class="cover bdr-all">
			<div class="frame-info width-all">
				<div class="ctn-main-font ctn-min-color ctn-16px">
					<h2>Join pictlr today.</h2>
				</div>
				<div class="padding-10px"></div>
				<a href="{{ url('/login') }}">
					<button class="mrg-bottom create btn btn-sekunder-color" id="compose">
						<span class="ttl-post">Login</span>
					</button>
				</a>
				<a href="{{ url('/register') }}">
					<button class="btn btn-main-color" id="compose">
						<span class="ttl-post">Register</span>
					</button>
				</a>
			</div>
		</div>
	</div>
	<div class="block theme-2 bdr-bottom">
		<div class="ttl ctn-main-font ctn-small ctn-center padding-20px">What you can do?</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fa fa-lg fa-lightbulb"></div>
			</div>
			<div class="mid">
				Share your opinions
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-comments"></div>
			</div>
			<div class="mid">
				Discussion with other peoples
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-bookmark"></div>
			</div>
			<div class="mid">
				Save much opinions
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-thumbs-up"></div>
			</div>
			<div class="mid">
				Deal with others opinions
			</div>
		</div>
	</div>
	<div class="block theme-2">
		<div class="ttl ctn-main-font ctn-small ctn-center padding-20px">Start with it, for example.</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-clock"></div>
			</div>
			<div class="mid">
				Fresh Opinions
				<div class="padding-10px"></div>
				<a href="{{ url('/fresh') }}">
					<input type="button" class="btn btn-sekunder-color btn-no-border" value="View More">
				</a>
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-fire"></div>
			</div>
			<div class="mid">
				Populars Opinions
				<div class="padding-10px"></div>
				<a href="{{ url('/popular') }}">
					<input type="button" class="btn btn-sekunder-color btn-no-border" value="View More">
				</a>
			</div>
		</div>
		<div class="frame-info">
			<div class="pos top">
				<div class="icn fas fa-lg fa-bolt"></div>
			</div>
			<div class="mid">
				Trending Opinions
				<div class="padding-10px"></div>
				<a href="{{ url('/trending') }}">
					<input type="button" class="btn btn-sekunder-color btn-no-border" value="View More">
				</a>
			</div>
		</div>
	</div>
	<div class="block theme-1">
		<div class="cover bdr-all">
			<div class="frame-info width-all">
				<div class="ctn-main-font ctn-min-color ctn-16px">
					<h2>So, Let's get Started.</h2>
				</div>
				<div class="padding-10px"></div>
				<a href="{{ url('/login') }}">
					<button class="mrg-bottom create btn btn-sekunder-color" id="compose">
						<span class="ttl-post">Login</span>
					</button>
				</a>
				<a href="{{ url('/register') }}">
					<button class="btn btn-main-color" id="compose">
						<span class="ttl-post">Register</span>
					</button>
				</a>
			</div>
		</div>
	</div>
	<div class="block theme-2">
		<div class="ttl ctn-main-font ctn-small ctn-center padding-20px">Find us on.</div>
		<div>
			<div class="frame-info">
				<div class="pos top">
					<div class="icn fab fa-lg fa-facebook-f"></div>
				</div>
				<div class="mid">
					Facebook
				</div>
			</div>
			<div class="frame-info">
				<div class="pos top">
					<div class="icn fab fa-lg fa-instagram"></div>
				</div>
				<div class="mid">
					Instagram
				</div>
			</div>
			<div class="frame-info">
				<div class="pos top">
					<div class="icn fab fa-lg fa-twitter"></div>
				</div>
				<div class="mid">
					Twitter
				</div>
			</div>
			<div class="frame-info">
				<div class="pos top">
					<div class="icn fab fa-lg fa-google"></div>
				</div>
				<div class="mid">
					Google
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>