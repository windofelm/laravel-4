$('document').ready(function(){

    $('#form_submit').click(function(){
        $('#target_form').submit();
    });

    $('#category_submit').click(function(){
        $('#category_form').submit();
    });


    $('.delete_group').on('click',function(event){

        $('#btn_delete_group').prop('href','forum/group/'+event.target.id+'/delete');
    });

    $('.delete_category').on('click',function(event){

        $('#btn_delete_category').prop('href', event.target.id + '/delete');
    });

    $('.new_category').on('click', function(event){

        var category_id = event.target.id;

        var pieces = category_id.split('-');

        $('#category_form').prop('action','forum/category/' + pieces[2] + '/new');
    });

})