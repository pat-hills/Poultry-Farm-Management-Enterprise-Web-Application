@extends('users/layouts.drugsmaster')
@section('drugs')



<article class="content forms-page">
            <div class="title-block"> 
                <h3 class="title">Farm Drugs List</h3>

                <p class="title-description"> 

          

             </p> 
            </div>

            <section class="section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-block">
                                <section class="example">
                                    <div class="table-responsive">
                                        <table  id="dataTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Date Recorded</th>
                                                    <th>Name</th>
                                                 
                                                    <th>Price </th>
                                                    <th>Description</th>
                                                  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    @foreach($farmdrugs as $drugs)
                                                    <tr id="{{$drugs->id}}">
                                                        <td>{{\Carbon\Carbon::parse($drugs->created_at)->format('jS \o\f F, Y')}}</td> 
                                                        <td>{{$drugs->item_name}}</td>
                                                        <td>{{$drugs->price}}</td>
                                                     
                                                        <td>{{$drugs->description}}</td>
                                                        
            
                                                       
            
            
                                                    </tr>
                                                    @endforeach
                                                   
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
</article>
 

@endsection