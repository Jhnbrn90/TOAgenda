<div class="grid-item">
    <div class="weekday-title">

        <div>
            <h3 class="daytitle">{{ $weekday->name }}</h3>
            <span class="daydate">{{ $weekday->day_month }}</span>
        </div>

        @for($i = 1; $i <= 7; $i++)
            @include('appointment.period')
        @endfor

    </div>

</div>