
// generate barcode
$('#barcode').submit(function() {
    if ($.trim($("#bar-code").val()) === "" ) {
        alert('provide barcode value');
        return false;
    }
});

// function to delete rows 
function deleteRow(item){

    var box = $(item);
    var parent = box.parent().parent().parent()
   if( $(parent).closest('tr').is('tr:only-child') ) {
    alert('cannot delete last row');
   
   
}
else {
    $(parent).closest('tr').remove();
}

    

}

// to calculate fol and total amaount
function calculate(item)

  {
       var box = $(item);
         var result = $(item).parent().parent();
    var item_demanded = parseInt($(result).find('#item_demanded').children('input[name="item_demanded"]').val());
    var rate = parseInt($(result).find('#rate').children('input[name="rate"]').val());
    var item_issued = parseInt($(result).find('#item_issued').children('input[name="item_issued"]').val());
    var qty = parseInt($(result).find('#quantity').children('input[name="quantity"]').val());
 
   if (!isNaN(item_demanded) && !isNaN(item_issued)){
       if(item_issued > qty){
       $(result).find('#item_issued').children('input[name="item_issued"]').val(qty);

       var to_fol = parseInt(item_demanded) - parseInt(qty);
            $(result).find('#to_fol').children('input[name="to_fol"]').val(to_fol);
        if ( rate != null){
                var total = parseInt(qty) * parseInt(rate);
                $(result).find('#total').children('input[name="total"]').val(total);
            }
       
        }

        if((item_issued <= item_demanded) && (item_issued <= qty)){
            var to_fol = parseInt(item_demanded) - parseInt(item_issued);
            $(result).find('#to_fol').children('input[name="to_fol"]').val(to_fol);

            if ( rate != null){
                var total = parseInt(item_issued) * parseInt(rate);
                $(result).find('#total').children('input[name="total"]').val(total);
            }
        
        }

       
         
    } else {
            $(result).find('#to_fol').children('input[name="to_fol"]').val('');
            
            $(result).find('#total').children('input[name="total"]').val('');
         
    }
     
        


}



// fill mission input field
function mission_list(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'mission_list' : box.val()
         };
         
         if(formData['mission_list'].length >= 1){           
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
                   result.fadeOut(500);  
                    box.blur();
                })
            })
         }
        }


        //fill search product field
function findProduct(item){
         
         var box = $(item);
         var result = $(box).parent().children("#result");
         var formData = {
             'search_product' : box.val()
         };
         
         if(formData['search_product'].length >= 1){           
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
                result.html(data).fadeIn();                   
                result.children('li').click(function() {                     
                    box.val($(this).text());
                    result.fadeOut(500);  
                    box.blur();
                })
            })
         }
        }


function unit_list(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'unit_list' : box.val()
         };
         
         if(formData['unit_list'].length >= 1){           
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
                   result.fadeOut(500);  
                    box.blur();
                })
            })
         }

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
                tr.children('#rate').children('input[name="rate"]').val(data['rate']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);
                tr.children('#quantity').children('input[name="quantity"]').val(data['qty_avaiable']);

                
            }
            

            
        })
    }

}




function listByname(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'product_name' : box.val()
         };
         
         if(formData['product_name'].length >= 1){           
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
            dataType    : 'json',
            encode      : true
        })
        .done(function(data) {                   
            
            console.log(data);
            // data = data[0];
            
            if(data != null){
                var tr = $(item).parent().parent();
                tr.children('#part_no').children('input[name="part_no"]').val(data['part']);
                tr.children('#rate').children('input[name="rate"]').val(data['rate']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);

                
            }
            

            
        })
    }

}

// for recieve form
function listByPart_recieve(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'product_part_no_recieve' : box.val()
         };
         
         if(formData['product_part_no_recieve'].length >= 1){           
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
                    fillIssueRecordByPart_recieve(item, $(this).text())
                    result.fadeOut(500);  
                    box.blur();
                })
            })
         }

}

function fillIssueRecordByPart_recieve(item, text){

    var formData = {
        'product_by_part_no_recieve' : text
    };

    console.log(formData);
    if(formData['product_by_part_no_recieve'].length >= 1){           
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
                tr.children('#categorie').children('input[name="categorie"]').val(data['categorie']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);

                
            }
            

            
        })
    }

}




function listByname_recieve(item){
         
         var box = $(item);
         var result = $(item).parent().children("#result");
         var formData = {
             'product_name_recieve' : box.val()
         };
         
         if(formData['product_name_recieve'].length >= 1){           
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
                    fillIssueRecordByname_recieve(item, $(this).text())
                    result.fadeOut(500);  
                    box.blur();
                })
            })
         }

}

function fillIssueRecordByname_recieve(item, text){

    var formData = {
        'product_by_name_recieve' : text
    };

    console.log(formData);
    if(formData['product_by_name_recieve'].length >= 1){           
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
                tr.children('#part_no').children('input[name="part_no"]').val(data['part']);
                tr.children('#categorie').children('input[name="categorie"]').val(data['categorie']);
                tr.children('#unit_id').children('input[name="unit_id"]').val(data['unit']);

                
            }
            

            
        })
    }

}

// end of js for issue form




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

    // $('#edit-product').submit(function(e){
    //     e.preventDefault();
        
    // }

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
            var fol = $(value).find('input[name="to_fol"]').val()
           // var mission = $(value).find('input[name="mission"]').val()
            var rate = $(value).find('input[name="rate"]').val()
            var demand = $(value).find('input[name="item_demanded"]').val()
            var issued = $(value).find('input[name="item_issued"]').val()
            var unit = $(value).find('input[name="unit_id"]').val()
            var total = $(value).find('input[name="total"]').val()
         //   var unit_name = $(value).find('input[name="unit_name"]').val()
            

            
            row["part_no"] = part;
            row["item_name"] = name;
            row["to_fol"] = fol;
            row["rate"] = rate;
            row["item_demanded"] = demand;
            row["item_issued"] = issued;
            row["unit_id"] = unit;
            row["total"] = total;
         
            issueObjects[index] = row;
        });

        // full array
        //console.log(issueObjects);

        var invoice = $('#header-table td#iv_no').find('input[name="iv_no"]').val()
        var issued_by = $('#header-table td#issued_by').find('input[name="issued_by"]').val()
        var mission = $('#header-table td#mission').find('input[name="mission"]').val()
        var unit_name = $('#header-table td#unit_name').find('input[name="unit_name"]').val()

        var inObj = {
            'form' : issueObjects,
            'invoice' : invoice,
            'issued_by' :  issued_by,
            'mission' : mission,
            'unit_name' : unit_name
        };


        var formData = {
            'issue_form_submit' : inObj  };
       
        //console.log(formData);
       
        if(inObj['form'].length > 0){           
            // process the form           
            $.ajax({
                type        : 'POST',
                url         : 'ajax-items.php',
                data        : formData,
                encode      : true
            })
            .done(function(data) {                   
                

                console.log("return Data", data);
                // data = data[0];
                setTimeout(function() {
               window.location.reload();
          },0);

                
                

                
            })
        }

 

    });

    $('#item-recieve-form').submit(function(e){
        e.preventDefault();

        var recieveObjects = [];
        var trArray = $(this).find('#items-recieve-table tbody tr');

        trArray.each(function (index, value){
            var row = {};
            
            var part_no = $(value).find('input[name="part_no"]').val()
            var item_name = $(value).find('input[name="item_name"]').val()
            var unit_id = $(value).find('input[name="unit_id"]').val()
            var quantity = $(value).find('input[name="quantity"]').val()
            var alp_no = $(value).find('input[name="alp_no"]').val()
            var categorie = $(value).find('input[name="categorie"]').val()
            var item_issued = $(value).find('input[name="item_issued"]').val()
            var rate = $(value).find('input[name="rate"]').val()
            var po_no = $(value).find('input[name="po_no"]').val()
            var drs_no = $(value).find('input[name="drs_no"]').val()
            var crv_no = $(value).find('input[name="crv_no"]').val()
            var firm = $(value).find('input[name="firm"]').val()
            var remarks = $(value).find('input[name="remarks"]').val()
            

            
            row["part_no"] = part_no;
            row["item_name"] = item_name;
            row["unit_id"] =unit_id;
            row["quantity"] = quantity;
            row["alp_no"] = alp_no;
            row["categorie"] = categorie;
            row["item_issued"] = item_issued;
            row["rate"] = rate;
            row["po_no"] = po_no;
             row["drs_no"] = drs_no;
            row["crv_no"] = crv_no;
            row["firm"] = firm;
            row["remarks"] = remarks;

            //console.log(index, value);
            recieveObjects[index] = row;
        });

        // full array
        //console.log(issueObjects);

       
        var recieved_by = $('#header-table td#recieved_by').find('input[name="recieved_by"]').val()

        var inObj = {
            'form' : recieveObjects,
            'recieved_by' :  recieved_by  };


        var formData = {
            'recieve_form_submit' : inObj  };
       
        //console.log(formData);
       
        if(inObj['form'].length > 0){           
            // process the form           
            $.ajax({
                type        : 'POST',
                url         : 'ajax-items.php',
                data        : formData,
                //dataType    : 'json',
                encode      : true
            })
            .done(function(data) {                   
                

                console.log("return Data", data);
                // data = data[0];
               setTimeout(function() {
               window.location.reload();
          },0);

                
            })
        }

 

    });

});








