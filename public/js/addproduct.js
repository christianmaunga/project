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

    $("input[type='number']").on("change", function () {
        var prix = $("input[id='prix']").val();
        var number = $("input[id='nombre']").val();

        $("#prixtotal").val(prix * number).required;
    });

    // $("input[type='number']").each(function(){

    //   var prix=$('#prix').val();
    //   var number=$('#nombre').val();

    //   $(this).on('change',function(){

    //     $('#prixtotal').val(prix*number);

    //   })
    // })

    // $("input[type='number']").on('change', function(){

    //   var prix=$('#prix').val();
    //    var number=$('#nombre').val();

    //     $('#prixtotal').val(prix*number);

    //  });

    //  $("").on('change', function(){

    //   var q=$('#prix').val();
    //    var b=$('#nombre').val();
    //    $('#prixtotal').val(q*b);

    //  });
});

// $(document).ready(function(e){

//   // document.addEventListener('DOMContentLoaded', function(){

//   //   document.getElementById("number").onchange= totalPrice;
//   //   document.getElementById("prix").onchange = totalPrice;

//   //   //document.getElementById('total')= totalPrice;

//   // });
//   // var priceInput=addEventListener('change',totalPrice);
//   // var numberInput=addEventListener('change',totalPrice);

//   // function  totalPrice(e){
//   //   var number=$('prix').val();
//   //  console.log(number);
//   //   //  var priceInput=parsefloat(document.getElementById('prix').value)||0;
//   //   //  alert(priceInput);
//   //   // var produitPieces=parsefloat(document.getElementById('number').value)||0;
//   //   //var totalPrice=parsefloat(document.getElementById('total').value)||0;
//   //   // console.log(prixunitaire);
//   //   //var finalprice= prixunitaire* produitPieces ;
//   //   //document.getElementById('total').value=finalprice;
//   //   //return finalprice;
//   //   //console.log(finalprice);

//   // }
//   $(function () {
//     var date = new Date();
//     var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
//     $('#date_picker').datetimepicker({
//        minDate: today
//     });
//  });

//   $("input[type='number']").on('change', function(){

//    var q=$('#prix').val();
//    var b=$('#nomnbre').val();
//     $('#total').val(q*b);

//   })

// $('#add').click(function(e){
//   e.preventDefault();
//     var nom=$('#nom').val();
//     var fabricant=$('#fabricant').val();
//     var prix=$('#prix').val();
//     var nomnbre=$('#nomnbre').val();
//     var total=$('#total').val();
//     var date=$('#date').val();
//     var mesure=$('#mesure').val();
//     var quantity=$('#quantity').val();
//     var comment=$('#comment').val();

//     var text=$('table tr').val();

//     if(!$('#nom').val() || !$('#fabricant').val() || !$('#prix').val() || !$('#nomnbre').val() ||!$('#total').val() || !$('#date').val() || !$('#mesure').val() || !$('#quantity').val() || !$('#comment').val()){

//       alert('completer toutes les données')

//     }else

//       {

//     $('#mytable tbody').append(
//       "<tr><td name='nom[]'>"+nom+
//       "</td><td name='fabricant[]'>"+fabricant+
//       "</td><td name='[]'>"+prix+
//       "</td><td name='nomnbre[]'>"+nomnbre+
//       "</td><td name='total[]'>"+total+
//       "</td><td name='date[]'>"+date+
//       "</td><td name='mesure[]'>"+mesure+
//       "</td><td name='quantity[]'>"+quantity+
//       "</td><td name='comment[]'>"+comment+
//       "</td><td>"+"<button class='btn btn-danger'id='remove_item_btn'  type='button' name='button'>supprimé</button>"
//       +"</td></tr>")

//       $('#nom').val('');
//       $('#fabricant').val('');
//       $('#prix').val('');
//       $('#nomnbre').val('');
//       $('#total').val('');
//       $('#date').val('');
//       $('#mesure').val('');
//       $('#quantity').val('');
//       $('#comment').val('');

//     }

//     var seen = {};
// $('table tr').each(function() {
//   var txt = $(this).text();
//   if (seen[txt])
//     $(this).remove();
//   else
//     seen[txt] = true;
// });

// });

// $(document).on('click','#remove_item_btn', function(e){
//   e.preventDefault();
//   let row_item=$(this).parent().parent();
//   $(row_item).remove();
// })

// });
