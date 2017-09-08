function listByName(item){

    console.log(item.value);


}

function listByPart(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'product_part_no' : box.val()
         };
         
         if(formData['product_part_no'].length >= 1){           
           // process the form           
           $.ajax({
               type        : 'POST',
               url         : 'ajax-items.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
            .done(function(data) {
                result.html(data).fadeIn();                   
                result.children('li').click(function() {                     
                    box.val($(this).text());
                    fillIssueRecordByPart(item, $(this).text())
                    result.fadeOut(500);  
                    box.blur();
                })
            })
         }

}

function fillIssueRecordByPart(item, text){

    var formData = {
        'product_by_part_no' : text
    };

    console.log(formData);
    if(formData['product_by_part_no'].length >= 1){           
        // process the form           
        $.ajax({
            type        : 'POST',
            url         : 'ajax-items.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
        .done(function(data) {                   
            
            console.log(data);
            // data = data[0];
            
            if(data != null){
                var tr = $(item).parent().parent();
                tr.children('#item_name').children('input[name="item_name"]').val(data['name']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);

                
            }
            

            
        })
    }

}


function listByname(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'product_Name' : box.val()
         };
         
         if(formData['product_Name'].length >= 1){           
           // process the form           
           $.ajax({
               type        : 'POST',
               url         : 'ajax-items.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
            .done(function(data) {
                result.html(data).fadeIn();                   
                result.children('li').click(function() {                     
                    box.val($(this).text());
                    fillIssueRecordByname(item, $(this).text())
                    result.fadeOut(500);  
                    box.blur();
                })
            })
         }

}

function fillIssueRecordByname(item, text){

    var formData = {
        'product_by_name' : text
    };

    console.log(formData);
    if(formData['product_by_name'].length >= 1){           
        // process the form           
        $.ajax({
            type        : 'POST',
            url         : 'ajax-items.php',
            data        : formData,
            //dataType    : 'json',
            encode      : true
        })
        .done(function(data) {                   
            
            console.log(data);
            // data = data[0];
            
            if(data != null){
                var tr = $(item).parent().parent();
                tr.children('#part_no').children('input[name="part_no"]').val(data['name']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);

                
            }
            

            
        })
    }

}

$(document).ready(function() {
    
    $.ajaxSetup({
        error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
    });

    // $("#item-issue-form").submit(function(e) {
    //     e.preventDefault();
    // });

    $('#add_product').click(function(e){
        e.preventDefault();        

        var $tableBody = $('#items-issue-table').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
            $trNew.find('input').val('');

        $trLast.after($trNew);            

    })


 $('#add_product').click(function(e){
        e.preventDefault();        

        var $tableBody = $('#items-recieve-table').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
            $trNew.find('input').val('');

        $trLast.after($trNew);            

    })




    $('#item-issue-form').submit(function(e){
        e.preventDefault();

        var issueObjects = [];
        var trArray = $(this).find('#items-issue-table tbody tr');

        trArray.each(function (index, value){
            var row = {};
            
            var part = $(value).find('input[name="part_no"]').val()
            var name = $(value).find('input[name="item_name"]').val()
            row["part_no"] = part;
            row["item_name"] = name;

            console.log(index, value);
            issueObjects[index] = row;
        });

        // full array
        console.log(issueObjects);
        

    });


    



});





