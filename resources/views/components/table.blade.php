@props(['data', 'tableTitle', 'tableHeader'])

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{$tableTitle}}</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="max-height: 800px;">
          <table class="table table-hover table-head-fixed text-nowrap">
            <thead>
              <tr>
                {!! $tableHeader !!}
              </tr>
            </thead>
            <tbody>
            @if (isset($data))
                @if ($tableTitle == 'Dosen')
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->nip}}</td>
                        <td>
                            @foreach ($item->matakuliah as $matkul)
                                @if (! $loop->last)
                                    {{$matkul->nama}} ,
                                @else
                                    {{$matkul->nama}}
                                @endif
                            @endforeach
                        </td>                                    
                    </tr>
                    @endforeach
                @endif
            @else
                <tr>No Data</tr>
            @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>