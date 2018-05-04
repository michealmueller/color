@extends('charts.chart_master')

@section('chart')
    @if (isset($monthlyUsers['labels']) && isset($monthlyUsers['amounts']))

        {!!
        Charts::multi('areaspline', 'highcharts')
            ->template('blue-material')
            ->title('Monthly Users')
            ->colors(['#ff0000', ''])
            ->labels($monthlyUsers['labels'])
            ->dataset('Registration Income', $monthlyUsers['amounts'])
            ->elementLabel('Users')
            ->legend(true)
            ->render()
         !!}
    @else
        Sorry, There is no data to display....
    @endif
@endsection