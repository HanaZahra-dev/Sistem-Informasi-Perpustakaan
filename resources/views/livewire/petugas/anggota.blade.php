<div class="row">
    <div class="col-12">

    @include('admin-lte/flash')

    <div class="btn-group mb-3">
        <button wire:click="format" class="btn btn-sm bg-teal mr-2">Semua</button>
        <button wire:click="siswa" class="btn btn-sm bg-indigo mr-2">Siswa</button>
        <button wire:click="guru" class="btn btn-sm bg-olive mr-2">Guru</button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 200px;">
                    <input wire:model="search" type="search" class="form-control float-right" placeholder="Cari nama / NIS/NIP...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if ($anggota->isNotEmpty())
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode Anggota</th>
                        <th>Nama</th>
                        <th>NIS/NIP</th>
                        <th>Jenis</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggota as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-secondary">{{ $item->kode_anggota }}</span></td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nis_nip }}</td>
                        <td>
                            @if ($item->jenis_anggota == 'siswa')
                                <span class="badge bg-indigo">Siswa</span>
                            @else
                                <span class="badge bg-olive">Guru</span>
                            @endif
                        </td>
                        <td>{{ $item->kelas ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="row justify-content-center">
        {{ $anggota->links() }}
    </div>

    @if ($anggota->isEmpty())
        <div class="card">
            <div class="card-body">
                <div class="alert alert-warning">
                    Anda tidak memiliki data
                </div>
            </div>
        </div>
    @endif

    </div>
</div>