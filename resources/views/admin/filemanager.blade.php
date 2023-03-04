<div id="filemanager" class="modal-dialog modal-lg">
  	<div class="modal-content">
	    <div class="modal-header">
	    	<div class="row">
	    		<div class="col-sm-6">
	    			<div class="row">
		    			<div class="col-sm-6">
			      			<h4 class="modal-title" style="width: 120px;float: left;">File Manager</h4>
		    			</div>
				    </div>
	    		</div>
	    		<div class="col-sm-6">
			      	<button type="button" class="btn btn-default btn-close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
			      	<button type="button" data-toggle="tooltip" title="" id="button-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
			      	<button type="button" data-directory="{{$parent}}" data-target-id="{{$target_id}}" data-toggle="tooltip" title="" id="button-upload" class="btn btn-warning"><i class="fa fa-upload"></i> Upload</button>
				    @if($parent =='' && getStorageDisk()!=='s3')
				    <button type="button" data-toggle="tooltip" id="button-folder" class="btn btn-default"><i class="fa fa-folder"></i></button>
				    @endif
					@if(getStorageDisk()!=='s3')
					<button type="button" data-toggle="tooltip" id="button-parent" data-parent="/system/filemanager" title="Back" class="btn btn-primary"><i class="fa fa-level-up"></i></button>
				    @endif
					<a style="float: right;margin-bottom: 0;margin-right: 0;border-radius: 0;border-bottom: 0;" href="{{url('/system/filemanager?directory='.$parent)}}" data-toggle="tooltip"  id="button-refresh" class="btn btn-default"><i class="fa fa-refresh"></i></a>    	    	
		      	</div>
	    	</div>
	    </div>
    	<div class="modal-body">
      		<div class="row">
      		@if( !empty($media_files['files'] ) )
	      		@for ($i = 0; $i < count($media_files['files']); $i++)

		      		@if($media_files['files'][$i]['type'] == 'file')
					  	@php $ext = pathinfo($media_files['files'][$i]['name'], PATHINFO_EXTENSION); @endphp
		      			<div class="col-sm-2 col-xs-6 text-center">
				          	<div class="upload-img-items">
					          	<a href="javascript:void(0);" class="thumbnail">
								  	@if($ext == 'pdf')
									<img data-toggle="tooltip" class="img-fluid" alt="" src="{{ url('admin/image/pdf.png') }}" />
									@else
			                        <img data-toggle="tooltip" class="img-fluid" src="{{$media_files['files'][$i]['url'] }}" />
					          		@endif
								</a>
					          	<label>
					          		<input type="hidden" class="image-name" name="image_name" value="{{$media_files['files'][$i]['name']}}" />
					          		<input type="hidden" class="image-path" name="image_path" value="{{$media_files['files'][$i]['path'] }}" />
									<input type="hidden" class="image-href" name="image_href" value="{{$media_files['files'][$i]['url'] }}" />
					          		<input type="checkbox" name="path[]" value="{{ $media_files['files'][$i]['path'] }}" />{{ $media_files['files'][$i]['name'] }}
								</label>
				        	</div>
				        </div>
				    @else 
				    	<div class="col-sm-2 col-xs-6 text-center">
				          	<div class="upload-img-items">
					          	<a href="javascript:void(0);" data-directory="/system/filemanager?directory={{$media_files['files'][$i]['name'] }}" class="directory">
			                        <i class="fa fa-folder fa-5x"></i>
					          	</a>
					          	<label><input type="checkbox" name="path[]" value="{{ $media_files['files'][$i]['path'] }}" />{{ $media_files['files'][$i]['name'] }}</label>
				        	</div>
				        </div>
		      		@endif
		       	@endfor
	       	@else
		       	<div class="col-md-12">
		       		<p>Not found.</p>
		       	</div>
	       	@endif
	       	</div>
    	</div>
        <?php 
            if($total_data > $limit){
                ?>
                <div class="modal-footer">
                    <div class="custom-pagination">
                        <?php
                        $pages = ceil( $total_data/$limit);
                        echo CustomPagination::create($page, $pages, 2);
                        ?>
                    </div>
                </div>
                <?php
            }
        ?> 
  	</div>
</div>

<script type="text/javascript">
	$('a.thumbnail').on('click', function(e) {
		e.preventDefault();
		var target_id = "{{Session::get('target_id')}}";
		var file_name = $(this).parent().find('input.image-name').val();
		var file_href = $(this).parent().find('input.image-href').val();
		var file = $(this).parent().find('input.image-path').val();
		$('#input-image-name-'+target_id).val(file);
		$("#input-image-name-"+target_id).closest('div').css('background-image', 'url(' + file_href + ')');
		$('#modal-image').modal('hide');
	});

	$('#button-refresh').on('click', function(e) {
		e.preventDefault();
		$('#modal-image').load($(this).attr('href'));
	});
	
	$('a.directory').on('click', function(e) {
		e.preventDefault();
		$('#modal-image').load($(this).data('directory'));
		$('#modal-image').modal('show');
		return false;
	});
	$('#button-parent').on('click', function(e) {
		e.preventDefault();
		$('#modal-image').load($(this).data('parent'));
		
	});
	$('.custom-pagination a').on('click', function(e) {
		e.preventDefault();
		var base_url = "{{url('/')}}";
		var page = $(this).data('page');
		var target_id = "{{$target_id}}";
		var directory = "{{$parent}}";
		var target_url = base_url+"/system/filemanager?page="+encodeURIComponent(page)+"&target_id="+encodeURIComponent(target_id)+"&directory="+encodeURIComponent(directory);
		$('#filemanager').append('<div id="loader"></div>'); 
		$('#modal-image').load(target_url);
		
	});
	// upload file
	$('#button-upload').on('click', function() {
		
		var target_id = $(this).data('target-id');
		var directory = $(this).data('directory');
		$('#form-upload').remove();
		$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;">{{ csrf_field() }} <input type="hidden" name="directory" value="'+directory+'" /> <input type="hidden" name="target_id" value="'+target_id+'" /> <input type="file" name="file_name" value="" multiple="multiple" /></form>');
		$('#form-upload input[name=\'file_name\']').trigger('click');
		
		if (typeof timer != 'undefined') {
	    	clearInterval(timer);
		}
		timer = setInterval(function() {
			if ($('#form-upload input[name=\'file_name\']').val() != '') {
				clearInterval(timer);
				$.ajax({
					url: "{{url('/system/filemanager/upload')}}",
					type: 'post',
					dataType: 'json',
					data: new FormData($('#form-upload')[0]),
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: function() {
						$('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
						$('#button-upload').prop('disabled', true);
					},
					complete: function() {
						$('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
						$('#button-upload').prop('disabled', false);
					},
					success: function(json) {

						if (json['error']) {
							alert(json['error']);
						}
						if (json['success']) {
							alert(json['success']);
							$('#button-refresh').trigger('click');
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		}, 500);
	});
	$('#modal-image #button-delete').on('click', function(e) {
		
		if (confirm('Are you sure ?')) {

			var token = "{{csrf_token()}}";
			var directory= "{{$parent}}";
			var val = [];
	        $(':checkbox:checked').each(function(i){
	          	val[i] = $(this).val();
	        });
	        if(val.length < 1){
	        	confirm('Check atleast one.')
	        	return false;
	        }

			$.ajax({
				url: "{{url('/system/filemanager/delete')}}",
				type: 'post',
				dataType: 'json',
				data: $('input[name^=\'path\']:checked'),
				data: '_token='+token+'&directory='+ directory+'&path=' + encodeURIComponent( val ),
				
				beforeSend: function() {
					$('#button-delete').prop('disabled', true);
				},
				complete: function() {
					$('#button-delete').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}
					if (json['success']) {
						alert(json['success']);

						$('#button-refresh').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	});
	
	// create folder
	$('#button-folder').popover({
		html: true,
		placement: 'bottom',
		trigger: 'click',
		title: 'New Folder',
		content: function() {
			html  = '<div class="input-group">';
			html += '  <input type="text" name="folder" value="" placeholder="Folder Name" class="form-control">';
			html += '  <span class="input-group-btn"><button type="button"  id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
			html += '</div>';
			return html;
		}
	});
	$('#button-folder').on('shown.bs.popover', function() {
		$('#button-create').on('click', function() {
			var token = "{{csrf_token()}}";
			var directory= "{{$parent}}";
			var folder = $('input[name=\'folder\']').val();
			$.ajax({
				url: "{{url('/system/filemanager/folder/create')}}",
				type: 'post',
				dataType: 'json',
				data: {directory:directory,folder:folder,_token:token},
				beforeSend: function() {
					$('#button-create').prop('disabled', true);
				},
				complete: function() {
					$('#button-create').prop('disabled', false);
				},
				success: function(json) {
					if (json['error']) {
						alert(json['error']);
					}
					if (json['success']) {
						alert(json['success']);
						$('#button-refresh').trigger('click');
						$('#button-folder').trigger('click');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});
	});
	// search
	$('#button-search').on('click', function() {
		
	});

</script>