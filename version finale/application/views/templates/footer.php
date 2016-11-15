<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url("assets/js/jquery-ui.min.js") ;?>"></script>
<script src="<?php echo base_url("assets/js/jquery-ui-sliderAccess.js") ;?>"></script>
<script src="<?php echo base_url("assets/js/jquery-ui-timepicker-addon.min.js") ;?>"></script>
<script>

    $('.deadline').datetimepicker();

    // screen adjust for panels
    $(".login-adjust").css("padding-top", $(window).height() * 0.25);

    var screen = $(window).height();
    var app = $("#app").height();

    if(screen > app) {
        $(".screen-adjust").css("min-height", $(window).height());
    }
    else {
        $(".screen-adjust").css("min-height", $("#app").height());
    }

    $(".adjust-menu").css("min-height", $("#app").height());
    $(".adjust-panel").css("min-height", $(window).height($("#title").height()));

    // add miniTask to form
    $(document).ready(function() {
        var max_fields      = 100; //maximum input boxes allowed
        var wrapper         = $(".mini-task"); //Fields wrapper
        var add_button      = $(".addMiniTask"); //Add button ID


        var x = 0; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment


                $(wrapper).append(
                    '<div>'+
                    '<a href="#" class="close remove_field">&times;</a>'+
                    '<hr>' +
                    '<div class="form-group">' +
                    '<h4>Titre</h4> ' +
                    '<input class="form-control" type="text" name="title[mini]['+ x +']" placeholder="Titre de la tâche" value=""> ' +
                    '</div> ' +
                    '<div class="form-group">' +
                    '<h4>Deadline</h4>'+
                    '<input class="form-control deadline" type="text" name="deadline[mini]['+ x +']" value=""'+
                    '</div>'+
                    '<div class="form-group"> ' +
                    '<h4>Commentaire</h4> ' +
                    '<textarea class="form-control" name="comment[mini]['+ x +']" placeholder="Plus d\'information sur la tâche"></textarea> ' +
                    '</div>'+
                    '</div>'); //add input box

                $('.deadline').datetimepicker();
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })

    });

    // Check if mini task are done to check the MainTask
    $(document).ready(function () {
        $('.main').on('click', function() {

            var id_main = $(this).attr("id")
            var main_name = $(this).attr("name")
            var id_mini = $("#"+ id_main +"").attr("id")
            var check = $('input[id="'+ main_name + '"]:checked')

            console.log($('input[id="'+ id_mini +'"').prop(':checked'))

            if(id_mini == id_main && check) {
                $('input[id="'+ id_mini +'"').each(function () {
                    $(this).prop('checked', true)
                    $(this).prop('readonly', true)
                })
            }
        });
    })


    //Reset Form
    $(".reset").on('click', function() {
        $('#userForm').find("input[type=text], input[type=email], input[type=password]").val("");
        $('#newTask').find("input[type=text], textarea").val("");
    });
    
    //Change Button
    $('.banUser').on('click', function () {
        $("#addButton").hide();
        $('.button').append(
            '<a id="banButton" class="btn btn-primary" data-toggle="modal" data-target="#confirm">Ban</a>'
        )
    })
    $('.addUser').on('click', function () {
        $("#banButton").hide();
        $('.button').append(
            '<a id="addButton" class="btn btn-success" data-toggle="modal" data-target="#confirm">Add</a>'
        )
    })

    $('#delete').on('click', function () {
        $('.delete').attr("href", "<?php echo base_url(); ?>index.php/chef/delete")
    })
    
    //Reset Modal
    $("#seeTask").on("hidden.bs.modal", function () {
        $(".mini-task").html("");
    })

    $("#addTask").on("hidden.bs.modal", function () {
        $(".mini-task").html("");
    })
    $("#seeUser").on("hidden.bs.modal", function () {
        $("#banButton").remove();
        $(".avatar").html("");
    })

    //AJAX
       function ajaxSearch(){
            var input_data = $('#searchUser').val();
           if(input_data === 0) {
                $('#suggestions').hide();
           } else {

               var post_data = {
                   'searchUser' : input_data
               };

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url(); ?>index.php/search",
                   data: post_data,
                   success: function(data){
                       //return success
                       if (data.length > 0) {
                           $('#suggestions').show();
                           $('#autoSuggestionsList').addClass('auto_list');
                           $('#autoSuggestionsList').html(data);
                       }
                   }
               })

           }
       }

        function getUser (value) {
            var id = value;
            $.ajax({
                type:"POST",
                dataType: "json",
                url:"<?php echo base_url(); ?>index.php/search/user/"+ id +"",
                success: function(data)
                {
                    //return success
                    var href = "admin/delete/"+ data.id +"";
                    $('.delete').attr("href", href)

                    $('.id').val(data.id)
                    $('.firstname').val(data.prenom)
                    $('.lastname').val(data.nom)
                    $('.email').val(data.email)
                    $('.password').val(data.mdp)
                    $('.fonction').val(data.fonction)
                    $('.avatar').val(data.avatar)
                    $('.type').val(data.is_admin)
                }
            })
        }

    function addUser (value) {
        var id = value;
        $.ajax({
            type:"POST",
            dataType: "json",
            url:"<?php echo base_url(); ?>index.php/search/user/"+ id +"",
            success: function(data)
            {
                //return success

                var href = "<?php echo base_url(); ?>index.php/chef/add/"+ data.id +"/"+ data.fonction +"";
                $('.add').attr("href", href)

                $('.firstname').text(data.prenom)
                $('.lastname').text(data.nom)
                $('.email').text(data.email)
                $('.fonction').text(data.fonction)
                if (data.avatar){
                    $('.avatar').append(
                        '<img class="avatar" style="width: 150px; height: 150px;" src="'+ data.avatar +'">'
                    )
                } else {
                    $('.avatar').append(
                        '<span class="glyphicon glyphicon-user"></span>'
                    )
                }

            }
        })
    }

    function banUser (value) {
        var id = value;
        $.ajax({
            type:"POST",
            dataType: "json",
            url:"<?php echo base_url(); ?>index.php/search/user/"+ id +"",
            success: function(data)
            {
                //return success

                var href = "chef/ban/"+ data.id +"";
                $('.ban').attr("href", href)

                $('.firstname').text(data.prenom)
                $('.lastname').text(data.nom)
                $('.email').text(data.email)
                $('.fonction').text(data.fonction)
                if (data.avatar){
                    $('.avatar').append(
                        '<img class="avatar" style="width: 150px; height: 150px;" src="'+ data.avatar +'">'
                    )
                } else {
                    $('.avatar').append(
                        '<span class="glyphicon glyphicon-user"></span>'
                    )
                }

            }
        })
    }

    function getTask (value) {

        var id = value;
        $.ajax({
            type:"POST",
            dataType: "json",
            url:"<?php echo base_url(); ?>index.php/task/"+ id +"",
            success: function(data)
            {
                //return success

                $.each(data[0], function (i, value) {

                    var id = value.id

                    $("input[name='title[main]']").attr('name', 'title['+ id +']');
                    $("input[name='deadline[main]']").attr('name', 'deadline['+ id +']');
                    $("textarea[name='comment[main]']").attr('name', 'comment['+ id +']');

                    $("input[name='title["+ id +"]']").val(value.intitule)
                    $("input[name='deadline["+ id +"]']").val(value.dead_line)
                    $("textarea[name='comment["+ id +"]']").val(value.commentaire)


                })

                $.each(data[1], function (i, value) {

                    var id = value.id

                    console.log(id)

                    if (i == '0')
                    {
                        $("input[name='title[mini][0]']").attr('name', 'title['+ id +']');
                        $("input[name='deadline[mini][0]']").attr('name', 'deadline['+ id +']');
                        $("textarea[name='comment[mini][0]']").attr('name', 'comment['+ id +']');

                        $("input[name='title["+ id +"]']").val(value.intitule)
                        $("input[name='deadline["+ id +"]']").val(value.dead_line)
                        $("textarea[name='comment["+ id +"]']").val(value.commentaire)
                    }
                    else if (i >= 1)
                    {
                            $(".mini-task").append(
                                '<div>'+
                                '<hr>' +
                                '<div class="form-group">' +
                                '<h4>Titre</h4> ' +
                                '<input class="form-control title" type="text" name="title['+ id +']" placeholder="Titre de la tâche" value=""> ' +
                                '</div> ' +
                                '<div class="form-group">' +
                                '<h4>Deadline</h4>'+
                                '<input class="form-control deadline" type="text" name="deadline['+ id +']" value="">'+
                                '</div>'+
                                '<div class="form-group"> ' +
                                '<h4>Commentaire</h4> ' +
                                '<textarea class="form-control comment" name="comment['+ id +']" placeholder="Plus d\'information sur la tâche"></textarea> ' +
                                '</div>'+
                                '</div>'); //add input box

                            $("input[name='title["+ id +"]']").val(value.intitule)
                            $("input[name='deadline["+ id +"]']").val(value.dead_line)
                            $("textarea[name='comment["+ id +"]']").val(value.commentaire)

                    }

                })

            }
        })
    }


</script>
</body>
</html>