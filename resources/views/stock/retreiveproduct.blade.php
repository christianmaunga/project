@extends('layouts.app')

@section('content')
<div class="container">
  <form action="">
          <div class="row">

          <div class="form-group">
              <button class="btn btn-danger" style="float: right;">Enregistrer sortie</button>
            </div>

              <div class="form-group  " >
                
              

                <label for="">Nom du produit</label>         
                <input type="text" class="form-control " name="nom"  min="100" id="ProductName" name="name" style="width: 50%;" required><br>

              </div>      

            <div class="form-group  " >  

                <label for="">Prix</label>         
                <input type="numbre" class="form-control " name=""  min="100" id="ProductPrice" name="ProductPrice" style="width: 50%;" readonly required><br>

            </div>

            <div class="form-group  " >  

              <label for="">Produits restants</label>         
              <input type="number" class="form-control " name=""  min="100" id="RemaingProduck" name="RemaingProduck" style="width: 50%;" readonly required><br>

            </div>

            <div class="form-group " >  

              <label for="">Produit rétiré</label>         
              <input type="text" class="form-control " name=""  min="100" id="TakenProducts" name="TakenProducts" style="width: 50%;" required><br>

            </div>

            <div class="form-group " >  

              <label for="">Valeur des produits pris</label>         
              <input type="text" class="form-control " name=""  min="100" id="total_price_of_takenProducts" name="total_price_of_takenProducts" style="width: 50%;" readonly required><br>

            </div>

            <div class="form-group " >  
              <label for="">Destination</label>
              <select name="" id="" class="form-control " style="width: 50%;">
                <option >---</option>
                <option value="">Pharmacie</option>
                <option value="">Autre</option>
              </select><br> 
            </div>


            <div class="form-group col-md-4">
              <label for="">comment</label>
              <textarea name="" id=""class="form-control " clo rows="5"></textarea><br>
            </div>


            

          </div>
 </form>
</div>

@endsection