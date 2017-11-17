function selectTagSublist(letter) {
	$('#tag_sublist_loading ul.tag_sublist').each(function() {
		this.hide();
	});
	if (letter == 'cloud') {
		$('#tag_cloud').show();
	} else {
		$('#tag_cloud').hide();
		$('#tag_sublist_' + letter).show();
	}
}

function selectTagCloudOrList() {
    $('#tag_cloud_handle').click(function(event) {
        event.preventDefault();
        $('#tag_cloud').show();
        $('#tag_list_inner').hide();
    });

    $('#tag_list_handle').click(function(event) {
        event.preventDefault();
        $('#tag_cloud').hide();
        $('#tag_list_inner').show();
    });
}
