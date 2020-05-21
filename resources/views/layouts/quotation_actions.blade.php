@if($order->orderStatus == 'Pending')
    <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>
    @hasrole('Admin')<a href="{{ route('quotations.quot_gen.generatequot', $order->id)}}" class="card-link">Generate Quotation</a>@endhasrole

@elseif($order->orderStatus == 'Prepared')
    <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>
    <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>
    <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>
    @hasrole('Admin')<a style="color: #1E90FF" href="{{ route('quotations.quot_gen.confirm', $order->id) }}" class="card-link">Confirm</a>@endhasrole

@elseif($order->orderStatus == 'Confirmed')
    <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>
    <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>
    <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>
        @if (Auth::user()->hasAnyRoles(['Admin', 'Accounts']))
            <a style="color: #8B008B" href="{{ route('quotations.quot_gen.add_transporter', $order->id)}}" class="card-link">Add Transport</a>
        @endif

@elseif($order->orderStatus == 'Transported')
    <a style="" href="{{ route('quotations.quot_gen.rawquot', $order->id) }}" class="card-link">Raw Quotation</a>
    <a style="" href="{{ route('quotations.quot_gen.finalquotationpdf', $order->id) }}" class="card-link">View Quotation</a>
    <a href="{{ route('quotations.quot_gen.downloadpdf', $order->id)}}" class="card-link">Quotation PDF</a>
    <a style="color: chocolate" href="#" class="card-link">Bill/Receipt</a>
@endif
