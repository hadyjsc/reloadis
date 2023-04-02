@extends('layouts.app-stisla')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Detail Transfer {{ $transfer->uuid }}</h1>
        {{-- {{ Breadcrumbs::render('roles.show', $role) }} --}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="row">
                        <table class="table table-striped">
                            <tr>
                                <th width="15%">Nama Bank</th>
                                <td>: {{ $transfer->bank->name }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Nomor Rekening</th>
                                <td>: {{ $transfer->bank_account }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Penerima</th>
                                <td>: {{ $transfer->receiver }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Pengirim</th>
                                <td>: {{ $transfer->sender }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Jumlah Uang</th>
                                <td>: {{ 'Rp. '.number_format($transfer->amount, 0, ',', '.'); }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Catatan</th>
                                <td>: {{ $transfer->note ? $transfer->note : '-' }}</td>
                            </tr>
                            <tr>
                                <th width="15%">Status</th>
                                <td>:
                                    @if ( Str::lower($transfer->status) == "sent" )
                                        <span class="badge badge-info"> {{ $transfer->status }}</span>
                                    @elseif (Str::lower($transfer->status) == "in progress" )
                                        <span class="badge badge-warning"> {{ $transfer->status }}</span>
                                    @elseif (Str::lower($transfer->status) == "transfered" )
                                        <span class="badge badge-success"> {{ $transfer->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <form method="post" action="{{ route('transfers.status', $transfer->uuid) }}">
                            @csrf
                            @method('PUT')
                            <a href="{{route('transactions.selling')}}" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</a>
                            @if (Str::lower($transfer->status) != "transfered" && Auth::user()->id == $transfer->updated_by)
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Sudah di Transfer</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
