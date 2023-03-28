$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){

    if(confirm('Ban co chac xoa truong nay hay ko ? ')){
        $.ajax({
            type:'DELETE',
            datatype: 'JSON',
            data: {id},
            url: url,
            success: function(result){
                if(result.error === false){
                    alert(result.message);
                    location.reload();
                }else{
                    alert("Error: xoa bi loi, chua xoa dc");
                }
            }
        })
    }
}


// upload 

$('#upload').change(function(){
    const form = new FormData();
    form.append('file', $(this)[0].files[0]); 

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function(results){
            if(results.error === false){
                $('#image_show').html('<a href="'+results.url+'" target="_blank"> <img src="'+results.url+'" width="500px">'+results.url+'</a>');
                $('#thumbnail').val(results.url);
            }else {
                alert('upload file looix')
            }
        }
    });
});
