var posts = {
    sort_by : 'date',
    sort : 'desc',
    page : 1,

    showSort : function(){
        $('#comment_table th a').removeClass('sort_asc').removeClass('sort_desc');
        $('#comment_table #sort_'+posts.sort_by).addClass('sort_'+posts.sort);
    },

    getData : function(){
        var overlay = $('.transparent');
        overlay.show();
        $.post('/index/get',{sort_by:posts.sort_by, sort:posts.sort, page:posts.page}, function(data){
           data = $.parseJSON(data);
           if(data.status==='ok'){
               $('#comment_table tbody').html(data.posts);
               $('#pagination_content').html(data.pagination);
           }
           overlay.hide();
        });
    }

};

$(document).ready(function(){
    $('#comment_table th a').click(function(){
        var id = $(this).attr('id');
        id = id.split('_');
        var newSort = id[id.length-1];
        if(newSort===posts.sort_by){
            posts.sort = (posts.sort==='asc') ? 'desc' : 'asc';
        }else{
            posts.sort_by = newSort;
            posts.sort = 'desc';
        }
        posts.page = 1;
        posts.showSort();
        posts.getData();
        return false;
    });

    $('#pagination_content').on('click', '.page_item', function(){
        var id = $(this).attr('id');
        id = id.split('_');
        posts.page = id[id.length-1];
        posts.getData();
    });
    posts.showSort();
});