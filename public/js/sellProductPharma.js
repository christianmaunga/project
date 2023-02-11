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

      if(name   == "" || number  =="" || selling_price == "" ||total_price ==""){
        alert('Ajouter des produits');
      }else{

        var html="";
		
          html="<tr><td>"+name+"</td><td>"+number+"</td><td>"+selling_price+"</td><td>"+total_price+"</td></tr>";
          
          document.getElementById('result').innerHTML+=html;


      $("#ProductName").val("");
      $("#boughtnumber").val("")
      $("#selling_price").val("")
      $("#total_price").val("")
      $("#instock").val("")

      }
      

    
      
})

});

