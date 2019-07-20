
@extends('backLayout.app')
@section('title')
Admin dashboard
@stop

@section('style')

@stop
@section('content')
<div class="row">
        <div class="col-md-3">
            <h4>Search for a user</h4>       
        </div>

  <div class="col-md-7">
      <form action="/user-search" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <input list="employees" class="form-control" id="answerInput">

            <datalist id="employees" name="employee">
                @foreach($users as $user)
                    <option data-value={{$user->id}}>{{ $user->first_name }} {{ $user->last_name }}</option>
                @endforeach
                
            </datalist>
            <input type="hidden" name="answer" id="answerInput-hidden">
        </div>
    </div>
    <div class="co-md-2">
        <input type="submit" class="btn btn-primary" value="search" />
    </div>
      </form>
      <script>
        document.querySelector('input[list]').addEventListener('input', function(e) {
    var input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        hiddenInput = document.getElementById(input.getAttribute('id') + '-hidden'),
        inputValue = input.value;

    hiddenInput.value = inputValue;

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        if(option.innerText === inputValue) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }
    }
});
      </script>
      {{-- <input type="date" value="{{ Carbon::now() }}" class="form-control"> --}}
 

  
</div>
<div class="row">
    <br>  
    @if (isset($details))
        @if (count($details) > 0)
        <h3> {{ $details->first()->user->first_name }} {{ $details->first()->user->last_name }}</h3>
        <table class="table">
            <tr>
                <td>Date</td>
                <td>Signed in</td>
                <td>Signed out</td>
            </tr>
            @foreach ($details as $item)
                <td> {{ ((object)$details->first()['created_at'])->format('Y-m-d')}} </td>
                <td>
                    @if($details->first()['created_at'] != null)
                      {{ ((object)$details->first()['created_at'])->format('H:i:s')}}
                    @else
                        -
                    @endif
                </td>
                <td>
                   @if ($details->first()->user->departures->first()['created_at'] != null)
                        {{ ((object)($details->first()->user->departures->first()['created_at']))->format('H:i:s') }}
                   @else
                       -
                   @endif
                </td>
            @endforeach
        </table>
        @else
            <h3> No records for this user </h3>
        @endif
  
    @endif
</div>
  


@endsection

@section('scripts')


@endsection