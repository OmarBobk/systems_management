<div>

    <div class="container mt-24">
        <div>
            {!! $chart->container() !!}
        </div>
    </div>

    {!! $chart->script() !!}

    <div class="container grid grid-cols-3 mt-24">
    @foreach($all_charts as $ch)

            <div>
                {!! $ch[0]->container() !!}
            </div>

        {!! $ch[0]->script() !!}
    @endforeach
    </div>

</div>
