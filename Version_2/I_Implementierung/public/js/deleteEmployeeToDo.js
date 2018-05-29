function deleteToDo(todo_id, user_id){
    var request = $.ajax({
        url: "http://localhost:8000/employees/todo",
        method: "DELETE",
        header:{
            "Content-Type": "application/json; charset=UTF-8"
        },
        data: JSON.stringify({
            todo_id: todo_id,
            user_id: user_id
        })
    });
    request.done(function(msg) {
        console.log(msg);
        location.reload();
    });
    request.fail(function(jqXHR, textStatus){
        console.log(jqXHR);
        console.log(textStatus);
    });
}


