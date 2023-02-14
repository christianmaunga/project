$(document).ready(function(){


 
  var pharmaId=$("#pharmaId").val();
  
$.ajax({
  type:'GET',
  url:'/pharma/searshProduct/'+pharmaId,
  encode  : true,

  success:function(response){
       
         // console.log(response)



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

                    //  console.log("object")
                    //  console.log(dataProd)
                    //  console.log("object2")
                    //  console.log(dataProd2)

              $('input#ProductName').autocomplete({
                      data :dataProd,
                      //callback for when autocomplete shows
                  onAutocomplete:function(reqdata){
                       //   console.log(reqdata)
                          
                          $('#instock').val(dataProd2[reqdata]["number"]);
                          $('#product_id').val(dataProd2[reqdata]["product_id"]);
                          $('#selling_price').val(dataProd2[reqdata]["selling_price"]);


                      //      var price=$('#price').val(dataProd2[reqdata]["price"]);
                      //    var converted =parseInt(price)
                      //      console.log( isNaN(price))
                      //     console.log( price)
                      // var sum 
                          // console.log($('#price').val()*3);
                          $('#boughtnumber').keyup(function(){
                              var retreive=$('#boughtnumber').val()

                              var totalPrice=retreive*$('#selling_price').val()
                              $('#total_price').val(totalPrice)
                           
                      })
                      
                  }

              });

        }
})


$(document).on('click','#add',function(e){
  e.preventDefault();
      var name=$("#ProductName").val();
      var number =$("#boughtnumber").val()
      var selling_price =$("#selling_price").val()
      var total_price =$("#total_price").val()
      var product_id =$("#product_id").val()

      if(name   == "" || number  =="" || selling_price == "" ||total_price ==""){
        alert('Ajouter des produits');
      }else{

        
        $('#result').append("<tr><td id='td_name'>"+name+"</td><td id='td_number'>"+number+"</td><td id='td_selling_price'>"+selling_price+"</td><td id='td_total_price'>"+total_price+"</td><td id='product_id' style='display:none;'>"+product_id+"</td></tr>")
        // var html="";
		
        //   html="<tr><td id='td_name'>"+name+"</td><td id='td_number'>"+number+"</td><td id='td_selling_price'>"+selling_price+"</td><td id='td_total_price'>"+total_price+"</td></tr>";
          
        //   document.getElementById('result').innerHTML+=html;


      $("#ProductName").val("");
      $("#boughtnumber").val("")
      $("#selling_price").val("")
      $("#total_price").val("")
      $("#instock").val("")

      }
      

    
      
})

$('#sell_product').click(function(){
  

  var data=[];

  $('#table tbody tr').each(function(){

      var td_names = $(this).find("td:first").text();
      var td_numbers = $(this).find("td:nth-child(2)").text();
      var td_selling_prices = $(this).find("td:nth-child(3)").text();
      var td_total_prices = $(this).find("td:nth-child(4)").text();
      var td_product_id=$(this).find("td:last").text();
      if (td_names && td_numbers && td_selling_prices && td_total_prices && td_product_id) {

      data.push({product_name: td_names, number: td_numbers, price : td_selling_prices, totalprice: td_total_prices, product_id: td_product_id});
      }
  })
  console.log(data);

    $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
          
        });

        $.ajax({
          url:'/pharma/submitselling',
          type:'post',
        
          data:{selling:data},
          success:function(data){
            console.log(data);
            if(!data.success){

              if (!data.success) {
                console.log(data.error?.message);
                // Display the error messages on the page
                var errors = data.error;
                for (var error in errors) {
                  console.log(errors[error][0]);
                  // e.g. $("#error-container").append("<p>" + errors[error] + "</p>");
                }
              } else {
                console.log('Validation succeeded');
                // Do something else if the validation succeeded
              }

            }
          }
        })  

        })

});

