@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#post-nav ul li').each(function(index, el) {
			$(this).removeClass('active');
			$('#{{ $nav }}').addClass('active');
		});
	});
</script>
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				<div class="bdr-bottom padding-10px">
					<div class="ctn-main-font ctn-min-color ctn-16px">
						<div class="sc-header">
							<div class="sc-place sc-pad">
							@foreach ($profile as $p)
								<div class="sc-grid sc-grid-2x">
									<div class="sc-col-1">
										@if (Auth::id() == $p->id)
											<a href="{{ url('/me/setting') }}">
												<button class="btn btn-circle btn-primary-color">
													<span class="fas fa-lg fa-cog"></span>
												</button>
											</a>
											<a href="{{ url('/me/setting/profile') }}">
												<button class="btn btn-circle btn-primary-color">
													<span class="fas fa-lg fa-pencil-alt"></span>
												</button>
											</a>
											<a href="{{ url('/compose') }}">
												<button class="btn btn-circle btn-primary-color">
													<span class="fas fa-lg fa-plus"></span>
												</button>
											</a>
										@else
											<h3 class="ttl-head-2 ctn-main-font ctn-sek-color">
												Profile
											</h3>
										@endif
									</div>
									<div class="sc-col-2 txt-right">
										@if (Auth::id() == $p->id)
											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
											<a href="{{ route('logout') }}" 
												onclick="event.preventDefault();
												document.getElementById('logout-form').submit();">
												<button class="btn btn-primary-color btn-radius">
													<span class="fas fa-lg fa-power-off"></span>
													<span class="">Logout</span>
												</button>
											</a>
										@else
											@if (!is_int($statusFolow))
												<input 
													type="button" 
													name="edit" 
													class="btn btn-sekunder-color add-follow-{{ $p->id }}" 
													id="add-follow-{{ $p->id }}" 
													value="Follow" 
													onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
											@else
												<input 
													type="button" 
													name="edit" 
													class="btn btn-main3-color add-follow-{{ $p->id }}" 
													id="add-follow-{{ $p->id }}" 
													value="Unfollow" 
													onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
											@endif
										@endif
									</div>
								</div>
							@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="frame-profile">
				@foreach ($profile as $p)
					<div class="profile">
						<div class="foto padding-bottom-10px">
							<div 
								class="image image-120px image-circle" 
								id="place-picture" 
								style="background-image: url({{ asset('/profile/thumbnails/'.$p->foto) }});"></div>
						</div>
						<div class="info">
							<div class="user-name ctn-main-font ctn-standar" id="edit-name">{{ $p->name }}</div>
							<div>
								<p id="edit-about"><strong>{{ $p->username }}</strong></p>
							</div>
							<div>
								<p id="edit-about">{{ $p->about }}</p>
							</div>
							<div class="other">
								<a class="link" href="{{ $p->website }}" target="_blank">{{ $p->website }}</a>
							</div>
							<div class="other mrg-bottom">
								<ul>
									<li>
										<a href="{{ url('/user/'.$p->id.'/following') }}">
											<span class="val">{{ $p->ttl_following }}</span>
											<span class="ttl">Following</span>
										</a>
									</li>
									<li>
										<a href="{{ url('/user/'.$p->id.'/followers') }}">
											<span class="val">{{ $p->ttl_followers }}</span>
											<span class="ttl">Followers</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
			<div class="place-notif">
				@if (Auth::id() === $p->id)
				<div>
					<div class="navigator nav-2x nav-theme-2 bdr-bottom" id="post-nav">
						<ul>
							<a href="{{ url('/me/opinions') }}">
								<li id="story">Your Opinions</li>
							</a>
							<a href="{{ url('/me/saves') }}">
								<li id="bookmark">Saves</li>
							</a>
						</ul>
					</div>
				</div>
				@endif
				<div>
					@if (count($userStory) == 0)
						@include('main.post-empty')	
					@else
						<div>
							@foreach ($userStory as $story)
								@include('main.post')
							@endforeach
						</div>
						{{ $userStory->links() }}
					@endif
				</div>
			</div>
		</div>
		<div class="rig post-grid-2">
			@include('main.side-menu')
		</div>
	</div>
</div>
@endsection