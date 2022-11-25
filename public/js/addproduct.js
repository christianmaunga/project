$(document).ready(function () {
    // $("#add").click(function (e) {
    //     e.preventDefault();

    //     $("#show_item").append(
    //         `<div class="added_items">
    //           <div class="row">
    //             <div class="col-md-2 mb-3">
    //               <label for="">Nom</label>
    //               <input type="text" name="nom[]" id="nom" class="form-control"  required> 
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Fabricant</label>
    //               <input type="text" name="fabricant[]" id="fabricant" class="form-control"  required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Prix</label>
    //               <input type="number" name="prix[]" value="0" id="prix"  min="1"  class="form-control"  required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">number</label>
    //               <input type="number" name="nombre[]" id="nombre" value="0" min="1"  class="form-control"  required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Prix Total</label>
    //               <input type="number" name="prixtotal[]" id="prixtotal" value="0" jAutoCal="{prix}*{nombre}" min="1" class="form-control"  required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for=""> Expire le </label>
    //               <input type="date" name="dateExpiration[]" id="date" class="form-control" required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Unité de mesure</label>
    //               <input type="text" name="mesure[]" id="mesure" class="form-control" required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Quantité</label>
    //               <input type="text" name="quantity[]" id="quantity" class="form-control" required>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <label for="">Comment</label>
    //               <textarea name="comment[]" class="form-control"  id="comment"  rows="3"></textarea>
    //             </div>
    //             <div class="col-md-2 mb-3">
    //               <button class="btn btn-danger" id="delete">Supprimer</button>
    //             </div>
    //           </div>
    //         <div>
    //       </div>
    //     </div>
    //   </div>`
    //     );

    //     $(document).on("click", "#delete", function (e) {
    //         e.preventDefault();
    //         let row_item = $(this).parent().parent();
    //         $(row_item).remove();
    //     });
    // });

    $("input[type='number']").keyup("change", function () {
        var prix = $("input[id='prix']").val();
        var number = $("input[id='nombre']").val();

        $("#prixtotal").val(prix * number).required;
    });

    // $('#date').datepicker({
    //     changeYear:true,
	// 	changeMonth:true,
    //     maxDate:new Date(2026,8,25),
	// 	minDate:'today'
    // })
    



    $.ajax({

        type:'GET',

        url:'/stock/searchProductName/',

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

                     $('input#name').autocomplete({
                        data :dataProd,
                        //callback for when autocomplete shows
                    onAutocomplete:function(reqdata){
                            console.log(reqdata)
                            
                            $('#fabricant').val(dataProd2[reqdata]["manufacturer_name"]);
                           
  
  
                        //      var price=$('#price').val(dataProd2[reqdata]["price"]);
                        //    var converted =parseInt(price)
                        //      console.log( isNaN(price))
                        //     console.log( price)
                        // var sum 
                            // console.log($('#price').val()*3);
                           
                        
                    }
  
                });

        }


        })
               
})