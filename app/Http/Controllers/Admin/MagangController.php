<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiMagang;
use App\Models\Prodi;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MagangController extends Controller
{
    public function index(Request $request)
    {
        $query = InformasiMagang::with('prodis')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = mb_substr($request->string('search')->toString(), 0, 100);
            $query->where(function ($q) use ($search) {
                $q->where('nama_perusahaan', 'like', '%' . $search . '%')
                    ->orWhere('posisi_magang', 'like', '%' . $search . '%')
                    ->orWhere('lokasi', 'like', '%' . $search . '%');
            });
        }

        $magangs = $query->paginate(10)->withQueryString();
        $list_prodi = Prodi::orderBy('nama_prodi', 'asc')->get();

        return view('admin.magang.index', compact('magangs', 'list_prodi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->magangRules());

        $data = $this->extractMagangData($validated);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $magang = InformasiMagang::create($data);
        $magang->prodis()->sync($this->normalizeProdiIds($validated['prodi_ids']));

        return redirect()->back()->with('swal_success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, int $id)
    {
        $magang = InformasiMagang::findOrFail($id);

        $validated = $request->validate($this->magangRules($magang));

        $data = $this->extractMagangData($validated);

        if ($request->hasFile('logo')) {
            if ($magang->logo) {
                Storage::disk('public')->delete($magang->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $magang->update($data);
        $magang->prodis()->sync($this->normalizeProdiIds($validated['prodi_ids']));

        return redirect()->back()->with('swal_success', 'Data berhasil diperbarui!');
    }

    public function edit(int $id)
    {
        $magang = InformasiMagang::with('prodis')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $magang->only([
                'id',
                'logo',
                'nama_perusahaan',
                'posisi_magang',
                'lokasi',
                'durasi_magang',
                'deskripsi',
                'kualifikasi',
                'status_mitra',
                'link_pendaftaran',
                'tenggat_pendaftaran',
            ]),
            'prodis' => $magang->prodis->pluck('id'),
        ]);
    }

    public function destroy(int $id)
    {
        $magang = InformasiMagang::findOrFail($id);

        if ($magang->logo) {
            Storage::disk('public')->delete($magang->logo);
        }

        $magang->prodis()->detach();
        $magang->delete();

        return redirect()->back()->with('swal_success', 'Data berhasil dihapus!');
    }

    /**
     * @return array<string, mixed>
     */
    private function magangRules(?InformasiMagang $magang = null): array
    {
        return [
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'posisi_magang' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'durasi_magang' => ['required', 'integer', 'min:1', 'max:24'],
            'status_mitra' => ['required', Rule::in(['mitra', 'non-mitra'])],
            'deskripsi' => ['required', 'string', 'max:5000'],
            'kualifikasi' => ['required', 'string', 'max:5000'],
            'link_pendaftaran' => ['nullable', 'url', 'max:500'],
            'tenggat_pendaftaran' => [
                'nullable',
                'date',
                $this->tenggatPendaftaranRule($magang),
            ],
            'prodi_ids' => ['required', 'array', 'min:1'],
            'prodi_ids.*' => ['integer', 'distinct', Rule::exists('prodi', 'id')],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    private function tenggatPendaftaranRule(?InformasiMagang $magang): Closure
    {
        return function (string $attribute, mixed $value, Closure $fail) use ($magang): void {
            if (! $value) {
                return;
            }

            $date = Carbon::parse($value)->startOfDay();
            $existingDate = $magang?->tenggat_pendaftaran?->format('Y-m-d');

            if ($date->lt(today()) && $date->format('Y-m-d') !== $existingDate) {
                $fail('Tenggat pendaftaran tidak boleh tanggal lampau.');
            }
        };
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function extractMagangData(array $validated): array
    {
        return collect($validated)
            ->only([
                'nama_perusahaan',
                'posisi_magang',
                'lokasi',
                'durasi_magang',
                'status_mitra',
                'deskripsi',
                'kualifikasi',
                'link_pendaftaran',
                'tenggat_pendaftaran',
            ])
            ->toArray();
    }

    /**
     * @param  array<int, mixed>  $prodiIds
     * @return array<int, int>
     */
    private function normalizeProdiIds(array $prodiIds): array
    {
        return array_values(array_unique(array_map('intval', $prodiIds)));
    }
}
