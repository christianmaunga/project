$(document).ready(function(){

$('.add_item_btn').click(function(e){
e.preventDefault();

        $('#show_item').append(` <div class="row">

        <div class="col-md-4 mb-3">
          <label for="">Intitulé</label>
          <input type="text" name="charge_intutilé[]" class="form-control"  required> 

        </div>

        <div class="col-md-2 mb-3">
          <label for="">Montant</label>
          <input type="number" name="montant[]"  min="100" class="form-control"  required> 

        </div>

        <div class="col-md-4 mb-3">
          <label for="">Details</label>
          <textarea id=""  rows="3" class="form-control" name="details[]" required></textarea> 

        </div>

        <div class="col-md-2 mb-2 ">

          <button class="btn btn-danger remove_item_btn">Supprimer</button>

        </div> `);

        $(document).on('click','.remove_item_btn', function(e){
          e.preventDefault();
          let row_item=$(this).parent().parent();
          $(row_item).remove();
    })

    //ajax  request to insert all data

    // $('#add_form').submit(function(e){
    //   e.preventDefault();
    //   $('#add_btn').val('Adding...');
    //   $.ajax({
    //     url:'{{Route("poulailler.insertcharges")}}',
    //     method:'post',
    //     data:$(this).serialize(),
    //     success:function(response){
    //       console.log(response);
    //     }
    //   });
    // });

});
});