@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">
				<div class="ttl-head padding-15px">
					<div class="ctn-main-font ctn-min-color ctn-16px">Notifications</div>
				</div>
				@if (count($notif) == 0)
					<div class="padding-20px">
						<div class="frame-empty">
							<div class="icn fa fa-lg fa-thermometer-empty btn-main-color"></div>
							<div class="padding-15px ctn-main-font ctn-sek-color ctn-small">Notifications Empty</div>
						</div>
					</div>
				@else
					@foreach ($notif as $dt)
						@if ($dt->type == 'follow')
							<div class="frame-notif grid grid-2x">
								<div class="grid-1">
									<a href="{{ url('/user/'.$dt->id) }}">
										<div 
											class="image image-40px image-radius"
											style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
									</a>
								</div>
								<div class="grid-2">
									<div class="notif-mid">
										<div class="ntf-mid">
											<div class="desc">
												<a href="{{ url('/user/'.$dt->id) }}">
													<strong>
														{{ $dt->username }}
													</strong>
												</a>
												Started following you
											</div>
											<div class="desc date">
												{{ date('F d, Y h:i:sa', strtotime($dt->created)) }}
											</div>
										</div>
									</div>
								</div>
							</div>
						@else
							<div class="frame-notif grid grid-3x">
								<div class="grid-1">
									<a href="{{ url('/user/'.$dt->id) }}">
										<div 
											class="image image-40px image-radius"
											style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
									</a>
								</div>
								<div class="grid-2">
									<div class="notif-mid">
										<div class="ntf-mid">
											<div class="desc">
												<a href="{{ url('/user/'.$dt->id) }}">
													<strong>
														{{ $dt->username }}
													</strong>
												</a>
												@if ($dt->type == 'comment')
													{{ 'Commented "'.$dt->val_comment.'" on your opinion' }}
												@elseif ($dt->type == 'love')
													Agree with your opinion
												@else
													Save your opinion
												@endif
											</div>
											<div class="padding-10px">
												<a href="{{ url('/story/'.$dt->idstory) }}" class="ctn-main-font ctn-min-color ctn-desc ctn-link">
													{{ '"'.$dt->val_story.'"' }}
												</a>
											</div>
											<div class="desc date">
												{{ date('F d, Y h:i:sa', strtotime($dt->created)) }}
											</div>
										</div>
									</div>
								</div>
								<div class="grid-3 txt-right">
									<a href="{{ url('/story/'.$dt->idstory) }}">
										<div class="image image-40px image-radius">
											<span class="icn fas fa-lg fa-lightbulb"></span>
										</div>
									</a>
								</div>
							</div>
						@endif
					@endforeach
				@endif
			</div>
			{{ $notif->links() }}
		</div>
		<div class="rig post-grid-2">
			@include('main.side-menu')
		</div>
	</div>
</div>
@endsection