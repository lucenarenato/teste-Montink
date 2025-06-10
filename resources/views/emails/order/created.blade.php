@component('mail::message')
# Pedido Recebido

Obrigado por comprar conosco!

**Pedido ID:** {{ $order->id }}
**Total:** R$ {{ number_format($order->total, 2, ',', '.') }}

Acompanhe o status em nosso site.

@endcomponent
