<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Hidup - {{ $biodata['nama'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen py-10" x-data="{
    modalBio: false,
    modalEdu: false,
    modalOrg: false,
    modalKerja: false,
    modalSkill: false,
    openAddModal: false,
    editData: null
}">

    <div class="max-w-3xl mx-auto bg-white p-8 sm:p-12 shadow-md rounded-sm border border-gray-200 relative overflow-hidden">

        <h1 class="text-3xl font-extrabold text-gray-800 tracking-wide mb-8 border-b-2 border-gray-100 pb-2">
            RIWAYAT HIDUP
        </h1>

        @if(session('success'))
            <div class="mb-6 p-3 bg-green-100 border border-green-300 text-green-700 rounded text-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- 1. DATA PRIBADI -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 group">
            <div class="md:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user-circle text-xl text-gray-800"></i>
                        <h2 class="text-xl font-bold text-gray-800 tracking-wide">DATA PRIBADI</h2>
                    </div>
                    <button @click="modalBio = true" class="text-xs text-blue-600 hover:underline font-semibold">[Edit]</button>
                </div>
                <table class="w-full text-sm text-gray-700 leading-relaxed">
                    <tr><td class="py-1 font-semibold w-40">Nama</td><td class="w-4">:</td><td>{{ $biodata['nama'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Tempat, Tanggal Lahir</td><td>:</td><td>{{ $biodata['ttl'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Jenis Kelamin</td><td>:</td><td>{{ $biodata['gender'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Agama</td><td>:</td><td>{{ $biodata['agama'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Alamat</td><td>:</td><td>{{ $biodata['alamat'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Nomor Telepon</td><td>:</td><td>{{ $biodata['telepon'] }}</td></tr>
                    <tr><td class="py-1 font-semibold">Email</td><td>:</td><td>{{ $biodata['email'] }}</td></tr>
                </table>
            </div>

            <div class="flex justify-center md:justify-end items-start">
                <div class="w-40 h-48 bg-gray-200 rounded-lg overflow-hidden shadow-sm border border-gray-300">
                    <img src="{{ asset('images/profile.jpg') }}" alt="Foto Profil" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/160x200?text=Foto+Profil'">
                </div>
            </div>
        </div>

        <!-- 2. RIWAYAT PENDIDIKAN -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-xl text-gray-800"></i>
                    <h2 class="text-xl font-bold text-gray-800 tracking-wide">RIWAYAT PENDIDIKAN</h2>
                </div>
                <button @click="modalEdu = true" class="text-xs text-blue-600 hover:underline font-semibold">[Edit]</button>
            </div>
            <div class="space-y-2 text-sm">
                @foreach($pendidikan as $item)
                    <div class="flex justify-between"><span class="font-medium">{{ $item['sekolah'] }}</span><span class="text-gray-600">{{ $item['tahun'] }}</span></div>
                @endforeach
            </div>
        </div>

        <!-- 3. PENGALAMAN ORGANISASI -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-users text-xl text-gray-800"></i>
                    <h2 class="text-xl font-bold text-gray-800 tracking-wide">PENGALAMAN ORGANISASI</h2>
                </div>
                <button @click="modalOrg = true" class="text-xs text-blue-600 hover:underline font-semibold">[Edit]</button>
            </div>
            <div class="space-y-2 text-sm">
                @foreach($organisasi as $item)
                    <div class="grid grid-cols-3">
                        <span class="font-medium">{{ $item['jabatan'] }}</span>
                        <span class="text-gray-600">{{ $item['tempat'] }}</span>
                        <span class="text-right text-gray-600">{{ $item['tahun'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 4. PENGALAMAN KERJA -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-briefcase text-xl text-gray-800"></i>
                    <h2 class="text-xl font-bold text-gray-800 tracking-wide">PENGALAMAN KERJA</h2>
                </div>
                <button @click="modalKerja = true" class="text-xs text-blue-600 hover:underline font-semibold">[Edit]</button>
            </div>
            <div class="space-y-2 text-sm">
                @foreach($kerja as $item)
                    <div class="grid grid-cols-3">
                        <span class="font-medium">{{ $item['posisi'] }}</span>
                        <span class="text-gray-600">{{ $item['perusahaan'] }}</span>
                        <span class="text-right text-gray-600">{{ $item['tahun'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 5. PORTOFOLIO (Database: portofolio_1136) -->
        <div class="mb-8 border-t pt-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-folder-open text-xl text-gray-800"></i>
                    <h2 class="text-xl font-bold text-gray-800 tracking-wide">PORTOFOLIO (portofolio_1136)</h2>
                </div>
                <button @click="openAddModal = true" class="px-3 py-1.5 bg-gray-800 hover:bg-gray-700 text-white text-xs font-semibold rounded shadow">
                    + Tambah Project
                </button>
            </div>
            <div class="grid grid-cols-1 gap-4">
                @forelse($portofolios as $item)
                    <div class="p-4 border border-gray-200 rounded bg-gray-50 flex justify-between items-start">
                        <div>
                            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-0.5 rounded font-medium">{{ $item->kategori }}</span>
                            <h3 class="font-bold text-gray-800 text-base mt-1">{{ $item->judul }}</h3>
                            <p class="text-gray-600 text-xs mt-1">{{ $item->deskripsi }}</p>
                            @if($item->link_project)
                                <a href="{{ $item->link_project }}" target="_blank" class="text-blue-600 hover:underline text-xs mt-2 inline-block">Lihat Project &rarr;</a>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <button @click="editData = {{ json_encode($item) }}" class="text-xs text-amber-600 hover:underline">Edit</button>
                            <form action="{{ route('portofolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 italic">Belum ada portofolio yang ditambahkan.</p>
                @endforelse
            </div>
        </div>

        <!-- 6. KEMAMPUAN -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-gear text-xl text-gray-800"></i>
                    <h2 class="text-xl font-bold text-gray-800 tracking-wide">KEMAMPUAN</h2>
                </div>
                <button @click="modalSkill = true" class="text-xs text-blue-600 hover:underline font-semibold">[Edit]</button>
            </div>
            <div class="grid grid-cols-2 text-sm gap-y-2">
                @foreach($kemampuan as $item)
                    <div>{{ $item['skill'] }}</div>
                    <div class="text-right text-gray-600">{{ $item['tingkat'] }}</div>
                @endforeach
            </div>
        </div>

        <!-- MODAL EDIT DATA PRIBADI -->
        <div x-show="modalBio" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Data Pribadi</h3>
                <form action="{{ route('cv.updateBiodata') }}" method="POST" class="space-y-3">
                    @csrf
                    <div><label class="block text-xs font-semibold mb-1">Nama</label><input type="text" name="nama" value="{{ $biodata['nama'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Tempat, Tanggal Lahir</label><input type="text" name="ttl" value="{{ $biodata['ttl'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Jenis Kelamin</label><input type="text" name="gender" value="{{ $biodata['gender'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Agama</label><input type="text" name="agama" value="{{ $biodata['agama'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Alamat</label><input type="text" name="alamat" value="{{ $biodata['alamat'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Nomor Telepon</label><input type="text" name="telepon" value="{{ $biodata['telepon'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Email</label><input type="email" name="email" value="{{ $biodata['email'] }}" class="w-full border rounded p-2 text-sm"></div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="modalBio = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT PENDIDIKAN -->
        <div x-show="modalEdu" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-lg w-full p-6 shadow-xl max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Riwayat Pendidikan</h3>
                <form action="{{ route('cv.updatePendidikan') }}" method="POST" class="space-y-3">
                    @csrf
                    @foreach($pendidikan as $i => $item)
                        <div class="grid grid-cols-2 gap-2 border-b pb-2">
                            <input type="text" name="sekolah[]" value="{{ $item['sekolah'] }}" placeholder="Nama Instansi/Sekolah" class="border rounded p-2 text-sm">
                            <input type="text" name="tahun[]" value="{{ $item['tahun'] }}" placeholder="Tahun (e.g. 2017-2021)" class="border rounded p-2 text-sm">
                        </div>
                    @endforeach
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="modalEdu = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT ORGANISASI -->
        <div x-show="modalOrg" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-lg w-full p-6 shadow-xl max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Pengalaman Organisasi</h3>
                <form action="{{ route('cv.updateOrganisasi') }}" method="POST" class="space-y-3">
                    @csrf
                    @foreach($organisasi as $i => $item)
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <input type="text" name="jabatan[]" value="{{ $item['jabatan'] }}" placeholder="Jabatan" class="border rounded p-2 text-sm">
                            <input type="text" name="tempat[]" value="{{ $item['tempat'] }}" placeholder="Organisasi" class="border rounded p-2 text-sm">
                            <input type="text" name="tahun[]" value="{{ $item['tahun'] }}" placeholder="Tahun" class="border rounded p-2 text-sm">
                        </div>
                    @endforeach
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="modalOrg = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT KERJA -->
        <div x-show="modalKerja" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-lg w-full p-6 shadow-xl max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Pengalaman Kerja</h3>
                <form action="{{ route('cv.updateKerja') }}" method="POST" class="space-y-3">
                    @csrf
                    @foreach($kerja as $i => $item)
                        <div class="grid grid-cols-3 gap-2 border-b pb-2">
                            <input type="text" name="posisi[]" value="{{ $item['posisi'] }}" placeholder="Posisi" class="border rounded p-2 text-sm">
                            <input type="text" name="perusahaan[]" value="{{ $item['perusahaan'] }}" placeholder="Perusahaan" class="border rounded p-2 text-sm">
                            <input type="text" name="tahun[]" value="{{ $item['tahun'] }}" placeholder="Tahun" class="border rounded p-2 text-sm">
                        </div>
                    @endforeach
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="modalKerja = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EDIT KEMAMPUAN -->
        <div x-show="modalSkill" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl max-h-[80vh] overflow-y-auto">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Kemampuan</h3>
                <form action="{{ route('cv.updateKemampuan') }}" method="POST" class="space-y-3">
                    @csrf
                    @foreach($kemampuan as $i => $item)
                        <div class="grid grid-cols-2 gap-2 border-b pb-2">
                            <input type="text" name="skill[]" value="{{ $item['skill'] }}" placeholder="Kemampuan" class="border rounded p-2 text-sm">
                            <input type="text" name="tingkat[]" value="{{ $item['tingkat'] }}" placeholder="Bahasa / Keterangan" class="border rounded p-2 text-sm">
                        </div>
                    @endforeach
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="modalSkill = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL PORTOFOLIO ADD & EDIT -->
        <div x-show="openAddModal" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Tambah Project Portofolio</h3>
                <form action="{{ route('portofolio.store') }}" method="POST" class="space-y-3">
                    @csrf
                    <div><label class="block text-xs font-semibold mb-1">Judul Project</label><input type="text" name="judul" required class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Kategori</label><input type="text" name="kategori" required class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" required class="w-full border rounded p-2 text-sm"></textarea></div>
                    <div><label class="block text-xs font-semibold mb-1">Link Project (Opsional)</label><input type="url" name="link_project" class="w-full border rounded p-2 text-sm"></div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="openAddModal = false" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="editData !== null" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg max-w-md w-full p-6 shadow-xl">
                <h3 class="text-lg font-bold mb-4 border-b pb-2">Edit Project Portofolio</h3>
                <form :action="'/portofolio/' + (editData ? editData.id : '')" method="POST" class="space-y-3">
                    @csrf @method('PUT')
                    <div><label class="block text-xs font-semibold mb-1">Judul Project</label><input type="text" name="judul" :value="editData?.judul" required class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Kategori</label><input type="text" name="kategori" :value="editData?.kategori" required class="w-full border rounded p-2 text-sm"></div>
                    <div><label class="block text-xs font-semibold mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" required class="w-full border rounded p-2 text-sm" x-text="editData?.deskripsi"></textarea></div>
                    <div><label class="block text-xs font-semibold mb-1">Link Project (Opsional)</label><input type="url" name="link_project" :value="editData?.link_project" class="w-full border rounded p-2 text-sm"></div>
                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="editData = null" class="px-3 py-1.5 bg-gray-200 text-xs rounded">Batal</button>
                        <button type="submit" class="px-3 py-1.5 bg-gray-800 text-white text-xs rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
