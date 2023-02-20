$(document).on('click', 'a[data-toggle=\'image\']', function(e) {
    e.preventDefault();
    var $element = $(this);
    var $popover = $element.data('bs.popover'); // element has bs popover?
    var target_id = $element.data('target-id');

    if ($popover) {
        return;
    }
    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<button type="button" data-target-id="'+target_id+'" id="button-image" class="button-image custom-btn edit"><i class="fa fa-plus"></i></button> <button type="button" data-target-id="'+target_id+'" id="button-clear" class="custom-btn delete"><i class="fa fa-trash-o"></i></button>';
        }
    });
    $element.popover('show');
});

$(document).on("click",".button-image",function(e){
    e.preventDefault();
    var $button = $(this);
    var target_id = $button.data('target-id');
    var $icon   = $button.find('> i');  
    $('#modal-image').remove();
    $.ajax({
        url: "/user/filemanager",
        data:{target_id:target_id},
        dataType: 'html',
        beforeSend: function() {
            $button.prop('disabled', true);
            if ($icon.length) {
                $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
            }
        },
        complete: function() {
            $button.prop('disabled', false);
            if ($icon.length) {
                $icon.attr('class', 'fa fa-picture-o');
            }
        },
        success: function(html) {
            $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
            $('#modal-image').modal('show');
        }
    });
    $('a[data-toggle="image"]').popover('dispose');
});

$(document).on("click","#button-clear",function(e){
    e.preventDefault();
    var target_id = $(this).data('target-id');
    $element.parent().find('#input-image-'+target_id).html('');
    $element.parent().find('#input-image-name-'+target_id).val('');
    //$element.popover('destroy');
    $element.popover('dispose');
});
