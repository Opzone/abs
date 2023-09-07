<div>

    @if ($holiday)
    <div class="alert alert-success">
        <small class="fw-bold">Hari ini adalah hari libur.</small>
    </div>
    @else

    {{-- jika tidak menggunakan qrcode (button) dan karyawan saat ini tidak menekan tombol izin --}}
    @if (!$attendance->data->is_using_qrcode && !$data['is_there_permission'])

    {{-- jika belum absen dan absen masuk sudah dimulai --}}
    @if ($attendance->data->is_start && !$data['is_has_enter_today'])
    <button class="btn btn-warning px-3 py-2 btn-sm fw-bold d-block w-100 mb-2" wire:click="sendEnterPresence"
        wire:loading.attr="disabled" wire:target="sendEnterPresence"><strong>ABSEN MASUK >> KLIK DISINI</strong></button>
    <!--a href="{ route('home.permission', $attendance->id) }"
        class="btn btn-info px-3 py-2 btn-sm fw-bold d-block w-100">Izin</!--a-->
    @endif

    @if ($data['is_has_enter_today'])
    <div class="alert alert-success">
        <small class="d-block fw-bold text-success">Syukran atas partisipasinya, anda sudah berhasil mengirim absensi masuk. <div><br></div> <a href="http://ypwi.or.id" target="blank" class="btn btn-primary"  role="button"><strong><marquee>KLIK DISINI UNTUK MASUK LINK ZOOM</marquee></strong></a>          
        </small>
    </div>
    @endif

    {{-- jika absen pulang sudah dimulai, dan karyawan sudah absen masuk dan belum absen pulang --}}
    @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'])
    <button class="btn btn-danger px-3 py-2 btn-sm fw-bold d-block w-100" wire:click="sendOutPresence"
        wire:loading.attr="disabled" wire:target="sendOutPresence"><strong>ABSEN KELUAR >> KLIK DISINI</strong></button>
    @endif

    {{-- sudah absen masuk dan absen pulang --}}
    @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
    <div class="alert alert-success">
        <small class="d-block fw-bold text-success">Anda sudah melakukan absen masuk dan absen keluar.</small>
    </div>
    @endif

    {{-- jika sudah absen masuk dan belum saatnya absen pulang --}}
    @if ($data['is_has_enter_today'] && !$attendance->data->is_end)
    <div class="alert alert-danger">
        <small class="fw-bold">Belum saatnya melakukan absensi keluar. Mohon refresh/login ulang jika tombol absen keluar belum tampil/ berubah</small>
    </div>
    @endif
    @endif

    @if($data['is_there_permission'] && !$data['is_permission_accepted'])
    <div class="alert alert-info">
        <small class="fw-bold">Permintaan izin sedang diproses (atau masih belum di terima).</small>
    </div>
    @endif

    @if($data['is_there_permission'] && $data['is_permission_accepted'])
    <div class="alert alert-success">
        <small class="fw-bold">Permintaan izin sudah diterima.</small>
    </div>
    @endif

    @endif

</div>