<?php declare(strict_types=1);

use App\Enums\DeliveryStatus;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;

return [
    OrderStatus::class => [
        OrderStatus::Pending => 'Chờ duyệt',
        OrderStatus::Approved => 'Đã duyệt',
        OrderStatus::Delivered => 'Hoàn tất',
        OrderStatus::Cancelled => 'Đã hủy',
    ],
    PaymentStatus::class => [
        PaymentStatus::Unpaid => 'Chưa thanh toán',
        PaymentStatus::Paid => 'Đã thanh toán',
        PaymentStatus::Cancelled => 'Đã hủy',
    ],
    DeliveryStatus::class => [
        DeliveryStatus::NotShipped => 'Chưa giao hàng',
        DeliveryStatus::Shipped => 'Đang giao hàng',
        DeliveryStatus::Delivered => 'Đã giao hàng',
        DeliveryStatus::Cancelled => 'Đã hủy',
    ],
];
