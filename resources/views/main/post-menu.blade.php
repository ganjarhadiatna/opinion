<script type="text/javascript">
	function viewPost(idstory, title) {
		var server_post = '{{ url("/story/") }}'+'/'+idstory+'/'+title;
		window.location = server_post;
	}
	function editPost(idstory, iduser) {
		var server_post = '{{ url("/story/") }}'+'/'+idstory+'/edit/'+iduser+'/{{ csrf_token() }}';
		window.location = server_post;
	}
	function opQuestionPost(idstory) {
		opQuestion('open','Are you sure you want to delete this opinion ?', 'deletePost("'+idstory+'")');
	}
	function deletePost(idstory) {
		$.ajax({
			url: '{{ url("/story/delete") }}',
			type: 'post',
			data: {'idstory': idstory},
			beforeSend: function() {
				opQuestion('hide');
				open_progress('Deleting your opinion...');
			}
		})
		.done(function(data) {
			close_progress();
			if (data === 'success') {
				opAlert('open', 'This opinion has been deleted, to take effect try refresh this page.');
			} else {
				opAlert('open', 'Failed to delete this opinion.');
			}
		})
		.fail(function() {
			close_progress();
			opAlert('open', 'There is an error, please try again.');
		});
		
	}
	function opCommentPopup(stt, path, idcomment, title = '') {
		var id = '{{ Auth::id() }}';
		if (stt === 'open') {
			$('#'+path).show();
			if (id === iduser) {
				var menu = '<li onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+idcomment+")'"+')">Delete Comment</li>';
			} else {
				var menu = '<li onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+idcomment+")'"+')">Delete Comment</li>';
			}
			$('.content-popup .place-popup #val').html(menu);
		} else {
			$('#'+path).hide();
		}
	}
	function opPostPopup(stt, path, idstory, iduser, title = '') {
		var id = '{{ Auth::id() }}';
		if (stt === 'open') {
			$('#'+path).show();
			if (id === iduser) {
				var menu = '\
				<li onclick="viewPost('+"'"+idstory+"'"+', '+"'"+title+"'"+')">Read Opinion</li>\
				<li onclick="editPost('+idstory+','+iduser+')">Edit Opinion</li>\
				<li onclick="opQuestionPost('+idstory+')">Delete Opinion</li>';
			} else {
				var menu = '<li onclick="viewPost('+"'"+idstory+"'"+', '+"'"+title+"'"+')">Read Opinion</li>';
			}
			$('.content-popup .place-popup #val').html(menu);
		} else {
			$('#'+path).hide();
		}
	}
	$(document).ready(function() {
		$('#menu-popup').on('click', function(event) {
			event.preventDefault();
			opPostPopup('close', 'menu-popup');
		});
	});
</script>
<div class="content-popup" id="menu-popup">
	<div class="place-popup">
		<ul>
		    <div id="val"></div>
		    <li class="btm" onclick="opPostPopup('close', 'menu-popup')">Exit</li>
		</ul>
	</div>
</div>