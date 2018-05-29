$("#employeeToDoForm").submit(function(e){
    e.preventDefault();
    var description = $("#descriptionInput").val();
    var startDate = $("#startDateInput").val();
    var endDate = $("#endDateInput").val();
    var wichtig = $("#wichtigInput").prop('checked')? 1 : 0;
    var target_id = $("#employeeInput").val() ? $("#employeeInput").val() : $("#creator_id").val();
    var creator_id = $("#creator_id").val();
    console.log();
    var request = $.ajax({
       url: "http://localhost:8000/employees/todo",
       method: "POST",
       data: {
           description: description,
           startdate: startDate,
           enddate: endDate,
           importance: wichtig,
           target_id: target_id,
           id: creator_id
       }
    });
    request.done(function(msg) {
        console.log(msg);
        window.location.replace("http://localhost:8000/dashboard/employee");
    });
    request.fail(function(jqXHR, textStatus){
        console.log(jqXHR);
        console.log(textStatus);
    });
});


