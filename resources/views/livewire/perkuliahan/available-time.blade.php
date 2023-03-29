<div>
    <div class="row">
        <div class="card col-12">
            <div class="card-header">
                <div class="card-title">
                    Data perkuliahan
                </div>
                <div class="card-tools ">
                    <input type="search" name="" id="" class="form-control" >
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered table-head-fixed">
                    <thead>
                        <th>
                            Hari
                        </th>
                        <th>
                            Jam
                        </th>
                        @foreach ($listRuangan as $ruangan)
                            <th>
                                {{$ruangan->lokasi == 'kampus_sukajadi' ? 'SKJD' : ''}}
                                {{$ruangan->kode}}
                            </th>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($timeSlots as $time => $key)
                             <tr>  
                                <td>A</td>
                                <td>{{$time}}</td>
                                    
                            </tr>
                            @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
