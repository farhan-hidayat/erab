<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak RAB</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">
</head>

<body>
    <h1 class="text-center">Cetak RAB</h1>
    <h4 class="text-center">Tiket : {{ $rab->ticket }}</h4>
    <h4 class="text-center">Fakultas : {{ $rab->user->faculty->name }}</h4>
    <h4 class="text-center">Total : Rp. {{ number_format($rab->price) }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Deskripsi</th>
                <th width="12%">Volume</th>
                <th width="15%">Satuan</th>
                <th width="18%">Harga</th>
                <th width="20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            $totalKeseluruhan = 0;
            $currentSubComponent = null;
            $currentType = null;
            @endphp
            @foreach ($rab_details->where('rab_id', $rab->id) as $rab_detail)
            @if ($currentSubComponent !== $rab_detail->sub_component->id)
            <tr>
                <th colspan="6">
                    {{ $rab_detail->sub_component->code }}-{{ $rab_detail->sub_component->name }}
                </th>
                @php
                $currentSubComponent = $rab_detail->sub_component->id;
                $currentType = null; // Reset currentType when sub_component changes
                $no = 1; // Reset $no when sub_component changes
                @endphp
            </tr>
            @endif
            @if ($currentType !== $rab_detail->type->id)
            <tr>
                <th colspan="6">
                    {{ $rab_detail->type->code }}-{{ $rab_detail->type->name }}
                </th>
                @php
                $currentType = $rab_detail->type->id;
                $no = 1; // Reset $no when type changes
                @endphp
            </tr>
            @endif
            <tr>
                <th>{{ $no++ }}</th>
                <td>
                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" style="border: none;"
                        disabled>{{ $rab_detail->description }}</textarea>
                </td>
                <td>{{ $rab_detail->volume }}</td>
                <td>{{ $rab_detail->unit }}</td>
                <td>Rp. {{ number_format($rab_detail->price) }}</td>
                <td>Rp. {{ number_format($rab_detail->total) }}</td>
            </tr>
            @php
            $totalKeseluruhan += $rab_detail->total;
            @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">Total Keseluruhan</th>
                <th colspan="1">Rp. {{ number_format($totalKeseluruhan) }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>