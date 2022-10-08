$(document).ready(function(){
    var stockId=$('#stockid').val();
    
   var array=['banana','patato','mango','avocado']
    

    $.ajax({

        type:'GET',

        url:"/stock/dataloading/"+stockId,

         encode  : true,

        success:function(response){
             
                console.log(response)
               
                     //material css

                     //convert array to object

                     //store the object in ProdArray
                     var ProdArray=response;

                     //initialize the object
                     var dataProd={};
                     var dataProd2={};
                     for(var i=0; i<ProdArray.length;i++){

                        
                        dataProd[ProdArray[i].product_name]=null;
                        dataProd2[ProdArray[i].product_name]=ProdArray[i];
                     }
                     console.log("object")
                     console.log(dataProd)
                     console.log("object2")
                     console.log(dataProd2)

                       
                    $('input#ProductName').autocomplete({
                        data :dataProd,
                        //callback for when autocomplete shows
                    onAutocomplete:function(reqdata){
                        console.log(reqdata)
                        $('#price').val(dataProd2[reqdata]["price"]);
                        $('#remaing_products').val(dataProd2[reqdata]["remaining"]);


                    //      var price=$('#price').val(dataProd2[reqdata]["price"]);
                    //    var converted =parseInt(price)
                    //      console.log( isNaN(price))
                    //     console.log( price)
                    // var sum 
                        // console.log($('#price').val()*3);
                        $('#retreived_product').keyup(function(){
                            var retreive=$('#retreived_product').val()
                            var totalPrice=retreive*$('#price').val()
                            $('#total_price').val(totalPrice)
                             
                        })
                        
                    }

                });
                
                    //end

                   
                 
        }
        
    });
    
    
});