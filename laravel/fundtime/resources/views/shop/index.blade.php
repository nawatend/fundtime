@extends('layout')


@section("title",'Shop')

@section('content')
<h2>Be The Contributor Of Better Future</h2>
<div class="row">
    @foreach($shop_items as $shop_item)
    <div class="col-sm-6 col-md-4 py-2">
        <form action="{{route('stripe.index')}}" method="get">
            @csrf
            <div class="card h-100 bg-{{$shop_item->type}}" style="width: 100%;">
                <div class="card-body">
                    <input type="hidden" name="total_f" value="{{ $shop_item->total_f }}" />
                    <h5 class="card-title">{{$shop_item->total_f}} F's</h5>
                    <p class="card-text">cost: {{$shop_item->real_cost_euro}} euro</p>
                    <button class="btn btn-light" type="submit">Buy
                        This</button>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection