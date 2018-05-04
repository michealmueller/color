@extends('charts.chart_master')

@section('chart')
    @if (isset($yearlyIncome['labels']) && isset($yearlyIncome['amounts']) && isset($yearlyEventIncome['amounts']))
    {!!
    Charts::multi('areaspline', 'highcharts')
        ->template('blue-material')
        ->title('Yearly Income')
        ->colors(['#ff0000', '#000000'])
        ->labels($yearlyIncome['labels'])
        ->dataset('Registration Income', $yearlyIncome['amounts'])
        ->dataset('Event Income', $yearlyEventIncome['amounts'])
        ->elementLabel('Dollars')
        ->legend(true)
        ->render()
     !!}
    @else
        Sorry, There is no data to display....
    @endif
@endsection