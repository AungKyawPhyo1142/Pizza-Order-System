@extends('user.layouts.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <thead class="thead-dark">
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </thead>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $item)
                            <tr>
                                <td class="align-middle">{{$item->created_at->format('j-F-Y')}}</td>
                                <td class="align-middle">{{$item->order_code}}</td>
                                <td class="align-middle">{{$item->total_price}} Kyats</td>
                                <td class="align-middle">
                                    @if ($item->status==0)
                                        <span class="btn btn-warning border rounded shadow-sm"><i class="fa-solid fa-clock-rotate-left me-2"></i>Pending...</button>
                                    @elseif ($item->status==1)
                                        <span class="btn btn-success p-2 border rounded shadow-sm"><i class="fa-solid fa-check me-2"></i>Success</button>
                                    @else
                                        <span class="btn btn-danger p-2 border rounded shadow-sm"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>
                    {{$order->links()}}
                </span>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection
