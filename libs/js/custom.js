$(document).ready(function() {

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

});












function addIssueRowItem(){

        

}





