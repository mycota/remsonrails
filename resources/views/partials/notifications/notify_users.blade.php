{{--Has been moved to the vue component--}}
<a href="{{ route('quotations.quot_gen.generatequot', $notfi->data['order']['id']) }}">
    {{$notfi->data['user']['name']}} have created new <strong>Quotation</strong>
</a>
