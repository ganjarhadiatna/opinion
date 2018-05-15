<?php use App\ProfileModel; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Opinion - @yield('title')</title>
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
	<script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
	<script type="text/javascript">
		var iduser = '{{ Auth::id() }}';

		function setScroll(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll');
			} else {
				$('html').removeClass('set-scroll');
			}
		}
		function setScrollMobile(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll-mobile');
			} else {
				$('html').removeClass('set-scroll-mobile');
			}
		}
		function opSearch(stt) {
			if (stt === 'open') {
				$('#search').show();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search').hide();
				setScroll('show');
			}
		}
		function opCreateStory(stt) {
			if (stt === 'open') {
				$('#create').show();
				setScroll('hide');
			} else {
				$('#create').hide();
				setScroll('show');
			}
		}
		function opToggle(stt) {
			var tr = $('#'+stt).attr('class');
			if (tr === 'toggle fa fa-lg fa-toggle-off') {
				$('#'+stt).attr('class', 'toggle tgl-active fa fa-lg fa-toggle-on');
			} else {
				$('#'+stt).attr('class', 'toggle fa fa-lg fa-toggle-off');
			}
		}
		function pictZoom(idstory) {
			var img = $('#pict-'+idstory).attr('key');
			var str = "{{ url('/story/covers/') }}"+'/'+img;
			var dt = '<img src="'+str+'" alt="pict">';
			$('#zoom-pict').show();
			$('#zoom-pict .zp-main').html(dt);
			setScroll('hide');
		}
		function toLink(path) {
			window.location = path;
		}
		function cekNotif() {
			$.get('{{ url("/notif/cek") }}', function(data) {
				//console.log('notif: '+data);
				if (data != 0) {
					$('#main-notif-sign').show();
				} else {
					$('#main-notif-sign').hide();
				}
			});
		}
		
		function goBack() {
			window.history.back();
		}

		function toLeft() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (sc >= 0) {
				$('#ctnTag').animate({scrollLeft: (sc - wd)}, 500);
			}
		}
		function toRight() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (true) {
				$('#ctnTag').animate({scrollLeft: (sc + wd)}, 500);
			}
		}

		function addLove(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore.');
			} else {
				$.ajax({
					url: '{{ url("/add/love") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'love') {
						$('.love-'+idstory).addClass('love');
						$('.icn-love-'+idstory).attr('class', 'icn-love-'+idstory+' fas fa-lg fa-thumbs-up');
					} else if (data === 'unlove') {
						$('.love-'+idstory).removeClass('love');
						$('.icn-love-'+idstory).attr('class', 'icn-love-'+idstory+' far fa-lg fa-thumbs-up');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to agree story.');
						$('.love-'+idstory).removeClass('love');
						$('.icn-love-'+idstory).attr('class', 'icn-love-'+idstory+' far fa-lg fa-thumbs-up');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to unagree story.');
						$('.love-'+idstory).addClass('love');
						$('.icn-love-'+idstory).attr('class', 'icn-love-'+idstory+' fas fa-lg fa-thumbs-up');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
				})
				.fail(function() {
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}

		function addBookmark(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can save this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/bookmark") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'bookmark') {
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' fas fa-lg fa-bookmark');
					} else if (data === 'unbookmark') {
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' far fa-lg fa-bookmark');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to save story to bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' far fa-lg fa-bookmark');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to remove story from bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' fas fa-lg fa-bookmark');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
					//console.log(data);
				})
				.fail(function(data) {
					//console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}

		window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ready(function() {
			var pth = "@yield('path')";

			if (iduser) {
				setInterval('cekNotif()', 3000);
			}

			$(window).scroll(function(event) {
				var top = $(window).scrollTop();
				var hg = Math.floor($('#home-main-object').height() - $('#home-side-object').height());
				var top1 = Math.floor($('#home-side-object').height() - ($(window).height() - 100));
				if ($('#home-main-object').height() > $('#home-side-object').height()) {
					if (top >= top1) {
						$('#home-side-object').attr('class', 'side-fixed');
					}
					if (top >= (hg + top1)) {
						$('#home-side-object').attr('class', 'side-absolute');
					}
					if (top < top1) {
						$('#home-side-object').attr('class', '');
					}
				}
			});

			$(window).scroll(function(event) {
				var hg = $('#header').height();
				var top = $(this).scrollTop();
				if (top > hg) {
					$('#main-search').addClass('hide');
				} else {
					$('#main-search').removeClass('hide');
				}
			});

			$('#txt-search').focusin(function () {
				$('#main-search .main-search').addClass('select');
			}).focusout(function () {
				$('#main-search .main-search').removeClass('select');
			});

			$('#close-zoom, #zoom-pict').on('click',function () {
				$('#zoom-pict').hide();
				setScroll('show');
			});
			
			$('#header .place .menu .pos .btn-circle').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});

			$('#place-search').submit(function(event) {
				var ctr = $('#txt-search').val();
				window.location = "{{ url('/search/') }}"+'/'+ctr;
			});
			
		});
	</script>
</head>
<body>
	<div id="header">
		<div class="place bdr-bottom">
			<div class="menu col-1000px">
				<div class="pos lef">
					<a href="{{ url('/') }}">
						<button class="btn-icn btn btn-main2-color btn-radius" id="home">
							<span class="fas fa-lg fa-home"></span>
							<span class="mobile ctn-main-font ctn-sek-color ctn-14px">Home</span>
						</button>
					</a>
					<a href="{{ url('/categories') }}">
						<button class="btn-icn btn btn-main2-color" id="category" key="hide">
							<span class="fas fa-lg fa-search"></span>
							<span class="mobile ctn-main-font ctn-sek-color ctn-14px">Explore</span>
						</button>
					</a>
					<a href="{{ url('/me/notifications') }}">
						<button class="btn-icn btn btn-main2-color" id="notif" key="hide">
							<div class="notif-icn absolute fas fa-lg fa-circle" id="main-notif-sign"></div>
							<span class="far fa-lg fa-bell"></span>
							<span class="mobile ctn-main-font ctn-sek-color ctn-14px">Notifications</span>
						</button>
					</a>
				</div>
				<div class="pos mid right">
					@if (Auth::id())
						@foreach (ProfileModel::UserSmallData(Auth::id()) as $dt)
							<a href="{{ url('/me') }}">
								<button class="pp btn btn-main2-color btn-radius" id="profile">
									<div 
										class="image image-40px image-circle" 
										style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});" 
										id="profile"></div>
									<div class="mobile username ctn-main-font ctn-14px">{{ $dt->username }}</div>
								</button>
							</a>
						@endforeach
					@else
						<a href="{{ url('/login') }}">
							<button class="pp btn btn-main2-color ctn-up btn-radius"
								style="float: right; margin-left: 15px; padding: 0 15px;" id="profile">
								<span>Login</span>
							</button>
						</a>
					@endif
					<a href="{{ url('/compose') }}">
						<button class="create btn btn-circle btn-main3-color" id="op-add" key="hide">
							<span class="fas fa-lg fa-plus"></span>
						</button>
					</a>
					<div class="main-search bdr-all" id="main-search">
						<form id="place-search" action="javascript:void(0)" method="get">
							<button type="submit" class="btn-search btn btn-main4-color">
								<span class="fa fa-lg fa-search"></span>
							</button>
							<input type="text" name="q" class="txt txt-main-color txt-no-shadow" id="txt-search" placeholder="Search.." required="true">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="zoom-pict" id="zoom-pict">
			<button class="close btn btn-circle btn-main2-color" id="close-zoom">
				<span class="fas fa-lg fa-times"></span>
			</button>
			<div class="zp-main"></div>
		</div>
	</div>
	<div id="body">
		@yield('content')
	</div>
	@include('main.loading-bar')
	@include('main.post-menu')
	@include('main.question-menu')
	@include('main.alert-menu')
</body>
</html>
