<div style="font-family: monospace; font-size: 13px; width: 260px;">

    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold tracking-wide"><i class="fa-solid fa-file-zipper"></i> Factura #{{str_pad($sale_id, 8, '0', STR_PAD_LEFT) }}</h1>
        <h2 class="text-lg font-semibold mt-1">{{session('companyName')}}</h2>
        <p class="text-sm text-gray-400">NIT: {{session('companyNit')}}</p>
         <p class="text-sm text-gray-400">{{date('d/m/Y h:i A')}}</p>
    </div>
    <hr>

    @foreach ($items as $item)
        <div>
            <strong>{{ $item['name'] }}</strong> <br>

            {{ $item['unit_type'] == 'kl' ? $item['weight'] : $item['quantity'] }}
            × ${{ number_format($item['price']) }}

            <span style="float:right;">
                ${{ number_format($item['subtotal']) }}
            </span>
        </div>
    @endforeach

    <hr>
    <strong>Total: ${{ number_format($total) }}</strong><br>
    <strong>Método: {{ $payment_method }}</strong>

    <hr>
    <p style="text-align:center;">¡Gracias por su compra!</p>
</div>
