$(document).ready(function () {
//form.serialize()
let body = $("body");
    $(".js-delete-row").click(function (e) {
        e.preventDefault();
        let btn = $(this), id = btn.data('id');
        if (confirm('Are you sure?')) {
            $.ajax({
                url: "/delete",
                data: {id: id},
                type: 'post',
                success: function (result) {
                    console.log(result);
                },

            });

        }


    });
    $(".js-add-record").click(function (e) {
        e.preventDefault();
        //# вместо id в js. класс обозначается "."
        let name = $("#villager_name").val(), age = $("#villager_age").val(),
            cid = $("select").first().val();
        if (confirm('Adding?')) {
            $.ajax({
                url: "/create",
                type: 'post',
                data: {name: name, age: age, cid: cid},
                success: function (result) {//ВОЗМОЖНО НАДО сделать здесь json decode
                    result = JSON.parse(result);
                    let errors = result.errors;
                    $.each(errors, function (key, value) {
                            let field = "#feedback_" + key;
                            $(field).html(value);
                            $(field).css("display", "block");
                            setTimeout(() => {
                                $(field).css("display", "none")
                            }, 2000);
                        }
                    );
                    //$.each( res, function (key, value){alert(key+": "+value)})
                    if (result.result === 'Added successful') {
                        $(".js-add-record").html("Success");
                    } else {
                        $(".js-add-record").html("Error");
                    }
                },
                //errors вызывается только если сервер не ответил на запрос или ответил с ошибкой (403, 404, 500)
                error: function (error) {
                    console.log('Fatal Error');
                }
            })
        }
    });

    body.on('click','.js-edit-row', function e(){
        let btn = $(this), id = btn.data('id'), field=$("#tr_"+id);
        $.ajax({
            url: "/editRow",
            method: "post",
            data: {id: id},
            success: function (result){
                //console.log(field);
                field.replaceWith(result);
            }
        });
    });

    body.on('click','.js-save-row', function e(){
        let btn = $(this), id = btn.data('id'), name = $("#iname_"+id).val(), age = $("#iage_"+id).val(), cid = $("#icid_"+id).val(), field=$("#tr_"+id)
        //console.log(name, age, cid);
        $.ajax({
            url: "/saveRow",
            method: "post",
            data: {id: id, name: name, age: age, cid:cid},
            success: function (result){
                field.replaceWith(result);
            }
        });
    });

    // $(".js-edit-row").click(function e() {
    //     let btn = $(this), id = btn.data('id')
    //     $.ajax({
    //         data: {id:id},
    //         success: function (result) {
    //             console.log(btn.attr('class'));
    //             //btn.attr('class', 'js-save-row');
    //             if (btn.hasClass('save')) {
    //                 btn.html('Edit');
    //             } else {
    //                 btn.html('Save');
    //                 let field=$("#name_"+id), s = "<input type text='text' name='name' value='"+field[0].innerText+"'>";
    //                 field.html(s);
    //
    //                 field=$("#age_"+id);
    //                 s = "<input type text='number' name='age' value='"+field[0].innerText+"'>";
    //                 field.html(s);
    //
    //                 field=$("#cid_"+id);
    //                 let cities=$("#cities")[0].innerHTML, city = field[0].innerText;
    //                 cities = cities.replace("<option value=\"0\" selected=\"\">City</option>", "");
    //                 cities = cities.replace(">"+city, " selected>"+city);
    //                 console.log(cities);
    //                 s = "<select input type='cid' name='cid'>"+cities+"</select>";
    //                 field.html(s);
    //
    //             }
    //             btn.toggleClass('save');
    //         }
    //     });
    // });

    // $(".js-save-row").click(function e() {
    //     let btn = $(this), id = btn.data('id')
    //     $.ajax({
    //         success: function (result) {
    //             btn.attr('class', 'js-edit-row');
    //             btn.html('Edit');
    //             console.log("Save");
    //         }
    //     });
    // });

});