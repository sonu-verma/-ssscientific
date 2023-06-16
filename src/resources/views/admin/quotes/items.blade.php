<?php
    $subPrice = 0;
    $totalPrice = 0;
?>
<table class="productSummaryTable table">
    <thead>
    <tr>
        <th style="width: 70px;"></th>
        <th>
            Product
        </th>
        <th class="text-left" style="width: 125px;">
            Sale Price
        </th>
        <th class="text-left" style="width: 75px">
            Qty
        </th>
        <th class="text-left" style="width: 125px;">
            Total
        </th>
        <th class="text-left" width="7%"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        @php
            $subPrice += $item->asset_value * $item->quantity;
            $totalPrice += $item->asset_value * $item->quantity;
        @endphp
        <tr class="strong-line">
            <td>IMage</td>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->asset_value }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{  $item->asset_value * $item->quantity }}</td>
            <td>
                @php
                    $buttons = [
                        'trash' => [
                            'label' => 'Delete',
                            'attributes' => [
                                'href' => route('item.remove', ['product' => $item->id]),
                            ]
                        ]
                    ];
                @endphp
                {!! table_buttons($buttons, false) !!}
            </td>
        </tr>
    @endforeach
    <tr class="table-summary">
        <td colspan="4" class="text-right">Sub Total</td>
        <td class="text-right">
            ${{ $subPrice }}<br>
        </td>
        <input type="hidden" name="old_order_sub_total" id="old_order_sub_total" value="0">
        <td></td>
    </tr>

    <tr class="table-summary">
        <td colspan="4" class="text-right">(+)Sales Tax(10.25%)
            <i class="icofont icofont-info-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Rental/Buy/Sale Furniture Subtotal : $0<br>Sales Tax (10.25%) on Rental/Buy/Sale Furniture : $0<br>Total : $0" data-html="true"></i></td>
        <td class="text-right">$0</td>
        <input type="hidden" name="old_order_sales_tax" id="old_order_sales_tax" value="0">
        <td></td>
    </tr>
    <tr class="table-summary">
        <td colspan="4" class="text-right"><strong>Total</strong>
            <br>
        </td>
        <td class="text-right">
            <strong>
                ${{ $totalPrice }}
                <input type="hidden" value="0" id="totalOrderAmount">
            </strong>
            <span class="affirm_price_span" style="display: none"><br><b>$0/mo</b><br>(for 3 months)</span>
        </td>
        <td></td>
    </tr>
    <tr class="table-summary">

    </tr>
    </tbody>
</table>
