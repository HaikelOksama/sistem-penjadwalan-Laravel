<div>
    <div class="card card-primary">
        <div class="card-header">
            <h2>
                Data Perkuliahan {{Str::title($ajaran)}} {{$tahun}}
            </h2>
        </div>
        <div class="card-body p-0 table-responsive overflow-x-scroll" style="height: 700px;">
                    <table class="table table-striped table-bordered table-hover text-nowrap table-head-fixed">
                        <thead>
                            <th>Ruangan</th>
                            @foreach ($dataHari as $item)
                                <th colspan="2">{{$item}}</th>
                            @endforeach
                        </thead>
                        <tbody wire:poll.1000ms>
                            @foreach ($availability as $ruangan => $hari)
                                <tr>
                                    <td>
                                        {{$this->getNamaRuangan($ruangan)}}
                                    </td>
                                    @foreach ($hari as $hari => $timeSlots)
                                        <td class="small">
                                            @foreach ($timeSlots as $time => $available)
                                                <span title=" 
                                                {{$available['available'] ? '' : $available['dosen'].' = '.$available['matakuliah']->nama}}" 
                                                class="
                                                {{$available['available'] ? '' : 'text-success'}}
                                                ">
                                                {{$time}}
                                                </span><br>
                                            @endforeach
                                        </td>
                                        <td class="small">
                                            @foreach ($timeSlots as $time => $available)
                                                <span
                                                class="
                                                text-danger
                                                ">
                                                @if (!$available['available'])
                                                    {{$available['dosen']}} /
                                                    {{$available['semester']}} /
                                                    {{$available['matakuliah']->nama}}
                                                @endif
                                                </span><br>
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

        </div>

    </div>
</div>
