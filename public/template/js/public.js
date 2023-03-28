$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function loadMore(){
    const page = $('#page').val();

    //bước gọi server
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {page},
        url: '/services/load-product',  // copy link và tạo 1 route để đi vào hàm 
        success: function(result){
            if(result.html !== ''){
                $('#loadProduct').append(result.html);
                $('#page').val(Number(page) + 1);
            }else{
                alert('Load sạch sản phẩm rồi');
                $('#btn-loadmore').css('display', 'none');
            }
        }
    });
}