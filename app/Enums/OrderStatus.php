<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CART = 'CARRINHO';
    case WAITING_PAYMENT = 'AGUARDANDO_PAGAMENTO';
    case CANCELED = 'CANCELADO';
    case PAID = 'PAGAMENTO_REALIZADO';
    case DELIVERED = 'ENTREGUE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
