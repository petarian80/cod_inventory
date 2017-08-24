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

        $trLast.after($trNew);            


    })

    $('#issue-part-no-input').keyup(function(e) {
         
         var box = $(this);
         var formData = {
             'product_part_no' : $(this).val()
         };

         console.log(formData);
         if(formData['product_part_no'].length >= 1){           
           // process the form
           console.log("ss");
           $.ajax({
               type        : 'POST',
               url         : 'http://localhost:8080/cod/ajax-items.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   console.log("p");
                   console.log(data);
                   //$(this).after(data);
                   $('#result').html(data).fadeIn();
                   $('#result li').click(function() {
                     
                    box.val($(this).text());
                    // $.ajax({
                    //     type        : 'POST',
                    //     url         : 'ajax-items.php',
                    //     data        : formData,
                    //     dataType    : 'json',
                    //     encode      : true
                    // })
                    //     .done(function(data) {
                    //         console.log("p");
                    //         console.log(data);
                    //         //$(this).after(data);
                    //         $('#result').html(data).fadeIn();
                    //         $('#result li').click(function() {

                    //             box.val($(this).text());
                    //             $('#result').fadeOut(500);

                    //         });

                    //         box.blur(function(){
                    //             $("#result").fadeOut(500);
                    //         });

                    //     });
                     $('#result').fadeOut(500);

                   });

                   box.blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {
           //$("#result").hide();

         };

         e.preventDefault();
     });



});












function addIssueRowItem(){

        

}





