
@extends('backLayout.app')
@section('title')
Admin dashboard
@stop

@section('style')

@stop
@section('content')
<div class="row">
  <form action="/sort-date" method="POST">
  <div class="col-md-9">
      <input name="date" type="date"  class="form-control">
      {{ csrf_field() }}
  </div>
  <div class="col-md-3">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  </form>
</div>
<div class="row">
    <br>
    @if (isset($date))
    <h3> {{ $date }} </h3>
   @endif
    @if (count($ppl_arr) > 0)
    
    <table class="table">
        <tr>
          <th>Name</th>
          <th>Sign in</th>
          <th>Sign out</th>
        </tr>
        @foreach ($ppl_arr as $emp)
            <tr>
              <td> {{ $emp->user->first_name }} {{ $emp->user->last_name }} </td>
                <td> {{ $emp->created_at->format('H:i:s')}}</td>
                 {{-- @foreach ($ppl_dept as $empd)
                      <td>{{ $empd->created_at->format('H:i:s') }}</td>
                    @endforeach --}}
                  <td>
                    @if ($emp->user->departures->first()['created_at'] != null)
                         {{ ((object)($emp->user->departures->first()['created_at']))->format('H:i:s') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    @else
        <h2 style="text-align:center">No employee signed this day</h2>
    @endif
</div>
  


@endsection

@section('scripts')


@endsection