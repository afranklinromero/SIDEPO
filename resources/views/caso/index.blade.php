@extends('layouts.app')

@section('template_title')
    Caso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Caso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('casos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        
                                        
										<th>Caso</th>
									
										<th>Placa</th>
										
										<th>Apaterno</th>
									
										<th>Estado</th>
										
										<th>Designado</th>
										<th>Regional</th>
										
										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($casos as $caso)
                                        <tr>
                                            
                                            
											<td>{{ $caso->caso }}</td>
											
											<td>{{ $caso->placa }}</td>
											
											
											
											
											
											
											
											
											<td>{{ $caso->apaterno }}</td>
											
											<td>{{ $caso->estado }}</td>
											
											<td>{{ $caso->designado }}</td>
											<td>{{ $caso->regional }}</td>
											
											
											
										
											

                                            <td>
                                                <form action="{{ route('casos.destroy',$caso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('casos.show',$caso->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('casos.edit',$caso->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $casos->links() !!}
            </div>
        </div>
    </div>
@endsection
