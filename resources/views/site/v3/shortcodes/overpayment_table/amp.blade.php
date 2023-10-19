<table class="table overpayment-table">
    <thead>
    <tr>
        <td class="text-left">Сумма займа, рублей</td>
        <td class="text-left">Переплата за 30 дней, рублей</td>
    </tr>
    </thead>
    <tbody>
    @for($i=$min_sum; $i<=$max_sum; $i = $i + 500)
        @php
            $overpayment = $i * 30 * $percent / 100;
        @endphp
        <tr>
            <td>{{  number_format($i, 0, '.', ' ') }}</td>
            <td>{{ number_format($overpayment, 0, '.', ' ') }}</td>
        </tr>
    @endfor
    </tbody>
</table>