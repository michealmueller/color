@extends('charts.chart_master')

@section('chart')
    @if (isset($monthlyIncome['labels']) && isset($monthlyIncome['amounts']) && isset($monthlyEventIncome['amounts']))

    {!!
    Charts::multi('areaspline', 'highcharts')
        ->template('blue-material')
        ->title('Monthly Income')
        ->colors(['#ff0000', '#000000'])
        ->labels($monthlyIncome['labels'])
        ->dataset('Registration Income', $monthlyIncome['amounts'])
        ->dataset('Event Income', $monthlyEventIncome['amounts'])
        ->elementLabel('Dollars')
        ->legend(true)
        ->render()
     !!}
        @else
        Sorry, There is no data to display....
    @endif
@endsection