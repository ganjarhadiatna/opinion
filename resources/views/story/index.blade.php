@extends('layout.index')
@section('title',$title)
@section('path',$path)
@section('content')
@foreach ($getStory as $story)
<script type="text/javascript">
	var id = '{{ Auth::id() }}';
	var server = '{{ url("/") }}';

	function getComment(idstory, stt) {
		var offset = $('#offset-comment').val();
		var limit = $('#limit-comment').val();
		if (stt == 'new') {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/0/'+offset;
		} else {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/'+offset+'/'+limit;
		}
		$.ajax({
			url: url_comment,
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_user = server+'/user/'+data[i].id;
				if (data[i].id == id) {
					var op = '<span class="fa fa-lg fa-circle"></span>\
							<span class="del pointer" onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+data[i].idcomment+")'"+')" title="Delete comment.">Delete</span>';
				} else {
					var op = '';
				}
				dt += '\
					<div class="frame-comment comment-owner">\
						<div class="dt-1">\
							<a href="'+server_user+'" title="'+data[i].username+'">\
								<div class="image image-45px image-circle" style="background-image: url('+server_foto+')"></div>\
							</a>\
						</div>\
						<div class="dt-2">\
							<div class="desk comment-owner-radius">\
								<div class="comment-main">\
									<a href="'+server_user+'" title="'+data[i].username+'"><strong class="comment-name">'+data[i].username+'</strong></a>\
									<div>'+data[i].description+'</div>\
								</div>\
							</div>\
							<div class="tgl">\
								<span>'+data[i].created+'</span>\
								'+op+'\
							</div>\
						</div>\
					</div>\
				';
			}
			if (stt === 'new') {
				$('#place-comment').html(dt);
			} else {
				$('#place-comment').append(dt);

				var ttl = (parseInt($('#offset-comment').val()) + 5);
				$('#offset-comment').val(ttl);
			}
			if (data.length >= limit) {
				$('#frame-more-comment').show();
			} else {
				$('#frame-more-comment').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function deleteComment(idcomment) {
		$.ajax({
			url: '{{ url("/delete/comment") }}',
			type: 'post',
			data: {'idcomment': idcomment},
		})
		.done(function(data) {
			if (data === 'success') {
				getComment('{{ $story->idstory }}', 'new');
			} else {
				opAlert('open', 'Deletting comment failed.');
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		}).
		always(function() {
			opQuestion('hide');
		});
	}
	function toComment() {
		var top = $('#tr-comment').offset().top;
		$('html, body').animate({scrollTop : (Math.round(top) - 70)}, 300);
		$('#comment-description').focus();
	}
	$(document).ready(function() {
		$('#offset-comment').val(0);
		$('#limit-comment').val(5);
		getComment('{{ $story->idstory }}', 'add');

		$('#comment-publish').submit(function(event) {
			var idstory = '{{ $story->idstory }}';
			var desc = $('#comment-description').val();
			if (desc === '') {
				$('#comment-description').focus();
			} else {
				$.ajax({
					url: '{{ url("/add/comment") }}',
					type: 'post',
					data: {
						'description': desc,
						'idstory': idstory
					},
				})
				.done(function(data) {
					if (data === 'failed') {
						opAlert('open', 'Sending comment failed.');
						$('#comment-description').focus();
					} else {
						$('#comment-description').val('');
						//refresh comment
						getComment('{{ $story->idstory }}', 'new');
					}
				})
				.fail(function(data) {
					console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		});

		$('#load-more-comment').on('click', function(event) {
			getComment('{{ $story->idstory }}', 'add');
		});

		$('.change-img').on('click', function(event) {
			var img = $(this).attr('key');
			$('#place-img').attr('src', server+'/story/covers/'+img);
		});

	});
</script>
@endforeach
<div class="col-1000px">
	<div class="post-home post-grid post-grid-2x">
		<div class="lef post-grid-1" id="home-main-object">
			<div class="place-notif">

				<div class="frame-story">
					<div class="bdr-bottom">
						<div class="sc-header padding-15px">
							<div class="sc-place sc-pad no-background">
								<div class="sc-grid sc-grid-2x">
									<div class="sc-col-1">
										@if ($story->id == Auth::id())
											<button class="btn btn-circle btn-primary-color  btn-focus" onclick="opQuestionPost('{{ $story->idstory }}')">
												<span class="far fa-lg fa-trash-alt"></span>
											</button>
											<a href="{{ url('/story/'.$story->idstory.'/edit/'.Auth::id().'/'.csrf_token()) }}">
												<button class="btn btn-circle btn-primary-color  btn-focus">
													<span class="fas fa-lg fa-pencil-alt"></span>
												</button>
											</a>
										@endif
										<button class="btn btn-circle btn-primary-color  btn-focus" onclick="opPostPopup('open', 'menu-popup', '{{ $story->idstory }}', '{{ $story->id }}', '{{ $title }}')">
											<span class="fas fa-lg fa-ellipsis-h"></span>
										</button>
									</div>
									<div class="sc-col-2 txt-right">
										<button class="btn btn-main3-color btn-no-border"
											key="{{ $story->idstory }}" 
											onclick="addBookmark('{{ $story->idstory }}')">
											@if (is_int($story->is_save))
												<span class="bookmark-{{ $story->idstory }} fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
											@else
												<span class="bookmark-{{ $story->idstory }} far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
											@endif
											<span>Save</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pos bot">
						<div class="padding-bottom-10px"></div>
						<div class="profile">
							<div class="foto">
								<a href="{{ url('/user/'.$story->id) }}">
									<div class="image image-45px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
								</a>
							</div>
							<div class="info">
								<div class="name">
									<div>
										<a href="{{ url('/user/'.$story->id) }}">
											{{ $story->username }}
										</a>
									</div>
								</div>
							</div>
							<div class="tool">
								@if ($story->id != Auth::id())
									@if (is_int($statusFolow))
										<input type="button" name="follow" class="btn btn-main3-color" id="add-follow-{{ $story->id }}" value="Unfollow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
									@else
										<input type="button" name="follow" class="btn btn-sekunder-color" id="add-follow-{{ $story->id }}" value="Follow" onclick="opFollow('{{ $story->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
									@endif
								@endif
							</div>
						</div>
					</div>
					<div class="pos mid">
						<div class="ctn-main-font ctn-min-color ctn-mikro ctn-sans-serif">
							<?php echo $story->description; ?>
						</div>
					</div>
					<div class="pos mid">
						@if (count($tags) > 0)
							<div>
								@foreach($tags as $tag)
									<?php 
										$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
										$title = str_replace($replace, '', $tag->tag); 
									?>
									<a href="{{ url('/tags/'.$title) }}" class="frame-top-tag">
										<div>{{ $tag->tag }}</div>
									</a>
								@endforeach
							</div>
						@endif
					</div>
					@if ($story->ttl_image != 0)
						<div>
							<div class="padding-10px" key="more design">
								<div class="place-search-tag">
									<div class="st-lef">
										<div class="btn btn-circle btn-sekunder-color btn-no-border hg-100px" onclick="toLeft()">
											<span class="fa fa-lg fa-angle-left"></span>
										</div>
									</div>
									<div class="st-mid ctn-main-font ctn-left" id="ctnTag">
										@if (count($images) != 0)
											@foreach ($images as $img)
											<div 
												id="pict-{{$img->idimage}}"
												class="image image-100px image-radius change-img"
												style="background-image: url({{ asset('/story/thumbnails/'.$img->image) }})"
												key="{{$img->image}}"
												onclick="pictZoom({{$img->idimage}})"></div>
											@endforeach
										@endif
									</div>
									<div class="st-rig">
										<div class="btn btn-circle btn-sekunder-color btn-no-border hg-100px" onclick="toRight()">
											<span class="fa fa-lg fa-angle-right"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
					<div class="pos bot">
						<div class="menu-val">
							<ul class="no-pad ctn-main-font ctn-14px">
								<li>{{ $story->ttl_comment.' Comments' }}</li>
								<li><span class="icn fa fa-1x fa-circle"></span></li>
								<li>{{ $story->ttl_love.' Agree' }}</li>
								<li><span class="icn fa fa-1x fa-circle"></span></li>
								<li>{{ $story->ttl_save.' Saves' }}</li>
								<li><span class="icn fa fa-1x fa-circle"></span></li>
								<li>{{ $story->ttl_image.' Images' }}</li>
								<li><span class="icn fa fa-1x fa-circle"></span></li>
								<li>{{ date('F d, Y h:i:sa', strtotime($story->created)) }}</li>
							</ul>
						</div>
					</div>
					<div class="pos mid">
						<div class="grid grid-2x padding-bottom-10px">
							<div class="grid-1">
								<!--
								<button class="btn-oth btn btn-sekunder-color btn-radius" title="share your opinions?">
									<span class="fas fa-1x fa-plus"></span>
									<span>Opinion</span>
								</button>
								-->
								@if (is_int($story->is_love))
									<button class="btn btn-sekunder-color btn-radius love love-{{ $story->idstory }}" 
										title="Agree with this opinion?" 
										onclick="addLove('{{ $story->idstory }}')">
										<span class="icn-love-{{ $story->idstory }} fas fa-lg fa-thumbs-up"></span>
										<span>Agree</span>
									</button>
								@else
									<button class="btn btn-sekunder-color btn-radius love-{{ $story->idstory }}" 
										title="Agree with this opinion?" 
										onclick="addLove('{{ $story->idstory }}')">
										<span class="icn-love-{{ $story->idstory }} far fa-lg fa-thumbs-up"></span>
										<span>Agree</span>
									</button>
								@endif
							</div>
							<div class="grid-2 text-right crs-default">
								<button class="btn btn-circle btn-sekunder-color" onclick="toComment()">
									<span class="far fa-lg fa-comment"></span>
								</button>
								<button class="btn btn-circle btn-sekunder-color save"
									key="{{ $story->idstory }}" 
									onclick="addBookmark('{{ $story->idstory }}')">
									@if (is_int($story->is_save))
										<span class="bookmark-{{ $story->idstory }} fas fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
									@else
										<span class="bookmark-{{ $story->idstory }} far fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
									@endif
								</button>
							</div>
						</div>
					</div>
					@if (Auth::id())
					<div class="pos bot bdr-top">
						<div class="padding-top-10px">
							<div class="top-comment" id="tr-comment">
								<form method="post" action="javascript:void(0)" id="comment-publish">
									<div class="comment-head">
										<div>
											<input class="txt comment-text txt-primary-color" id="comment-description" placeholder="Type comment here.." />
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					@endif
					<div class="pos bot bdr-bottom">
						<div class="ctn-main-font ctn-14px ctn-sek-color ctn-bold padding-bottom-15px">
							Response
						</div>
						<div class="comment-content" id="place-comment"></div>
						<div class="frame-more" id="frame-more-comment">
							<div class="padding-top-15px">
								<input type="hidden" name="offset" id="offset-comment" value="0">
								<input type="hidden" name="limit" id="limit-comment" value="0">
								<button class="btn btn-sekunder-color btn-radius" id="load-more-comment">
									<span class="Load More Comment">Load More</span>
								</button>
							</div>
						</div>
						<div class="padding-bottom-15px"></div>
					</div>
				</div>
			</div>
			<div>
				<div class="place-notif">
					<div class="ttl-head padding-15px">
						<div class="ctn-main-font ctn-min-color ctn-16px">
							Other Opinions
						</div>
					</div>
					@if (count($newStory) == 0)
						@include('main.empty')
					@else
						<div>
							@foreach ($newStory as $story)
								@include('main.post-list')
							@endforeach
						</div>
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
