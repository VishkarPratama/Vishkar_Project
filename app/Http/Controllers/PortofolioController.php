<?php
namespace App\Http\Controllers;

use App\Models\Portofolio1136;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    private function getCvData()
    {
        return session('cv_data', [
            'biodata' => [
                'nama' => 'Muhammad Patel',
                'ttl' => 'Anywhere, 16 Mei 1998',
                'gender' => 'Laki-laki',
                'agama' => 'Islam',
                'alamat' => 'Anywhere 123 ST., Any City',
                'telepon' => '123-456-7890',
                'email' => 'hello@reallygreatsite.com'
            ],
            'pendidikan' => [
                ['sekolah' => 'Universitas Negeri Rimberio', 'tahun' => '2017-2021'],
                ['sekolah' => 'SMA Negeri Liceria', 'tahun' => '2014-2017'],
                ['sekolah' => 'SMP Negeri Fauget', 'tahun' => '2011-2014'],
                ['sekolah' => 'SD Negeri Borcelle', 'tahun' => '2005-2011'],
            ],
            'organisasi' => [
                ['jabatan' => 'Ketua Himpunan Mahasiswa', 'tempat' => 'Universitas Negeri Rimberio', 'tahun' => '2017-2021'],
                ['jabatan' => 'Ketua OSIS', 'tempat' => 'SMA Negeri Liceria', 'tahun' => '2014-2017'],
            ],
            'kerja' => [
                ['posisi' => 'Karyawan Magang', 'perusahaan' => 'Perusahaan Liceria', 'tahun' => '2021-2022'],
                ['posisi' => 'Pekerja Lepas', 'perusahaan' => 'Wardiere Inc.', 'tahun' => '2020-2021'],
            ],
            'kemampuan' => [
                ['skill' => 'Mampu mengoperasikan perangkat lunak', 'tingkat' => 'Indonesia'],
                ['skill' => 'Mampu berkomunikasi dengan baik', 'tingkat' => 'Inggris Pasif'],
                ['skill' => 'Mampu bekerja sama dengan tim', 'tingkat' => '-'],
            ]
        ]);
    }

    public function index()
    {
        $cv = $this->getCvData();
        $portofolios = Portofolio1136::latest()->get();

        return view('cv', array_merge($cv, compact('portofolios')));
    }

    // Update Data Pribadi
    public function updateBiodata(Request $request)
    {
        $cv = $this->getCvData();
        $cv['biodata'] = $request->except('_token');
        session(['cv_data' => $cv]);

        return redirect()->back()->with('success', 'Data Pribadi berhasil diperbarui!');
    }

    // Update Riwayat Pendidikan
    public function updatePendidikan(Request $request)
    {
        $cv = $this->getCvData();
        $pendidikan = [];
        if ($request->sekolah) {
            foreach ($request->sekolah as $i => $sek) {
                $pendidikan[] = [
                    'sekolah' => $sek,
                    'tahun' => $request->tahun[$i] ?? ''
                ];
            }
        }
        $cv['pendidikan'] = $pendidikan;
        session(['cv_data' => $cv]);

        return redirect()->back()->with('success', 'Riwayat Pendidikan berhasil diperbarui!');
    }

    // Update Pengalaman Organisasi
    public function updateOrganisasi(Request $request)
    {
        $cv = $this->getCvData();
        $organisasi = [];
        if ($request->jabatan) {
            foreach ($request->jabatan as $i => $jab) {
                $organisasi[] = [
                    'jabatan' => $jab,
                    'tempat' => $request->tempat[$i] ?? '',
                    'tahun' => $request->tahun[$i] ?? ''
                ];
            }
        }
        $cv['organisasi'] = $organisasi;
        session(['cv_data' => $cv]);

        return redirect()->back()->with('success', 'Pengalaman Organisasi berhasil diperbarui!');
    }

    // Update Pengalaman Kerja
    public function updateKerja(Request $request)
    {
        $cv = $this->getCvData();
        $kerja = [];
        if ($request->posisi) {
            foreach ($request->posisi as $i => $pos) {
                $kerja[] = [
                    'posisi' => $pos,
                    'perusahaan' => $request->perusahaan[$i] ?? '',
                    'tahun' => $request->tahun[$i] ?? ''
                ];
            }
        }
        $cv['kerja'] = $kerja;
        session(['cv_data' => $cv]);

        return redirect()->back()->with('success', 'Pengalaman Kerja berhasil diperbarui!');
    }

    // Update Kemampuan
    public function updateKemampuan(Request $request)
    {
        $cv = $this->getCvData();
        $kemampuan = [];
        if ($request->skill) {
            foreach ($request->skill as $i => $sk) {
                $kemampuan[] = [
                    'skill' => $sk,
                    'tingkat' => $request->tingkat[$i] ?? ''
                ];
            }
        }
        $cv['kemampuan'] = $kemampuan;
        session(['cv_data' => $cv]);

        return redirect()->back()->with('success', 'Kemampuan berhasil diperbarui!');
    }

    // CRUD Portofolio
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'link_project' => 'nullable|url',
        ]);

        Portofolio1136::create($request->all());
        return redirect()->route('cv.index')->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'link_project' => 'nullable|url',
        ]);

        $portofolio = Portofolio1136::findOrFail($id);
        $portofolio->update($request->all());
        return redirect()->route('cv.index')->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $portofolio = Portofolio1136::findOrFail($id);
        $portofolio->delete();
        return redirect()->route('cv.index')->with('success', 'Portofolio berhasil dihapus!');
    }
}
