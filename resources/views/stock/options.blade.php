@extends('layouts.app')

@section('content')


<div class="container">
@if(session()->has('message'))

<div class="alert alert-success">
    {{ session()->get('message') }}
</div>

@endif
<a href=" {{Route('stock.transfertSpecific',['date'=>$date])}}" class="btn btn-secondary" style="font-size: 20px;" >Retour</a>
<a href="{{Route('stock.dashboard')}}" class="btn btn-secondary" style="float: right; font-size: 20px;"> Accueil</a>

<form action="{{Route('stock.updateTransfer',['id'=>$id])}}" method="POST">
 @csrf
        <div class="row">
   
        
        <div class="col-sm">
        <span style="color: red;">
                  @error('productNumbers')
                  {{$message}}
                  @enderror
                </span>
                <div class="col-sm left" style="margin-top: 10%;">
                        <?php
                
                        
                              foreach($query as $row){
                                if($row->destination>0){
                                echo  ' <h2>'. date('d,M,Y à H:i',strtotime($row->created_at))."<br>". $row->product_name .'</h2>';
                                
                                echo "<h3><label> Transferré(s):  $row->productNumbers</label></h3><br>";

                                // echo" <h4><p>Changer la quantité (Ne peut éxcedé la quantinté en stoque)</p></h4>";
                                // echo "<div class='col-md-3'>";
                                // echo "<input type='number' class='form-control ' name='productNumbers' > <br><br>";
                                // echo "</div>";

                                echo "<h4><label:>Detail</label></h4>";
                                echo "<div>$row->comment</div><br>";
                                echo" <h4><p>Changer la details</p><h4>";
                                
                                echo "<div class='col-md-7'>";
                                echo "<textarea type='text' class='form-control' rows='5' cols='30' name='comment' ></textarea><br><br>";
                                echo "</div>";

                                echo "<h3><p>   Déstination actuelle: $row->name  </p></h3>";
                                echo "<p>Changer la déstination </p>";
                              }
                            }
                        ?>

                        <?php
                          
                          $autre=0;
                              foreach($queryAutre as $row2)

                              if($row2->destination==0){
                                $autre=$row2->destination;
                                echo  ' <h2>'. date('d,M,Y à H:i',strtotime($row2->created_at))."<br>". $row2->product_name .'</h2>';

                                echo "<h3><label> Transferré(s):  $row2->productNumbers</label></h3><br>";

                                // echo" <p>Changer la quantité (Ne peut éxedé la quantinté en stoque)</p>";
                                // echo "<div class='col-md-3'>";
                                // echo "<h4><input type='number' class='form-control ' name='productNumbers' ></h4> <br><br>";
                                // echo "</div>";

                                echo "<h4><label:>Detail</label></h4>";
                                echo " <div>$row2->comment</div> ";
                                echo"<h4> <p>Changer la details</p></h4>";
                                
                                echo "<div class='col-md-7'>";
                                echo "<textarea type='text' class='form-control' rows='5' cols='30' name='comment' ></textarea><br><br>";
                                echo "</div>";
                                echo "<p>Changer la déstination </p>";
                                echo "<h3><p>Déstination actuelle: Autre</p></h3>";
                            }

                        ?>
            
                
                

                        <select class='form-control ' name="destination" id="">
                          <option value="">---</option>
                              @foreach($destination as $row1)
                                  <option value="{{$row1->id}}">{{$row1->name}}</option>
                              @endforeach
                               
                                  echo "<option value='0'>--Autre--</option>";
                             
                              ?>
                          

                        </select><br><br>


                  <button class="btn btn-primary">Changer</button>
                  <input type="hidden" value="{{$date}}" name="date">

          </div>

        </div>

      </form> 

      
    

      <div class="col-sm">
        
              <div class="col-sm right" >

                    <div class="cancel"  style="float:right;  margin-top:20%; ">

                       <h3> <b><a href="{{Route('stock.cancelTransfer',['id'=>$id])}}" style="color:red;margin-bottom:auto;">Annuler le transfert</a></b></h3>
                        
                    </div>
                
              </div>
        </div>

  </div>

 
</div>


@endsection