<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    private $alternatives = [];
    private $criteria = [];

    public function __construct()
    {
        // Inisialisasi alternatif dan kriteria dengan data kosong
        $this->alternatives = session()->get('alternatives', []);
        $this->criteria = session()->get('criteria', []);
    }

    public function index()
    {
        // Cari skor tertinggi dan terendah untuk setiap kriteria jika ada alternatif
        $maxScores = [];
        $minScores = [];
        if (!empty($this->alternatives)) {
            foreach ($this->criteria as $index => $criterion) {
                $scores = array_column($this->alternatives, 'scores');
                $scores = array_column($scores, $index);
                $maxScores[$index] = max($scores);
                $minScores[$index] = min($scores);
            }

            // Hitung nilai utilitas untuk setiap alternatif
            foreach ($this->alternatives as &$alternative) {
                $utility = 0;
                foreach ($alternative['scores'] as $index => $score) {
                    $weight = $this->criteria[$index]['weight'] ?? 0;
                    // Normalisasi skor
                    $normalizedScore = $score / $maxScores[$index];
                    // Menghitung nilai utilitas menggunakan formula yang diberikan
                    $utility += $normalizedScore * (($maxScores[$index] - $minScores[$index]) / $weight);
                }
                // Membulatkan nilai utilitas ke 3 angka di belakang koma
                $alternative['utility'] = round($utility, 3);
            }

            // Urutkan alternatif berdasarkan nilai utilitas secara menurun dan tambahkan rangking
            usort($this->alternatives, function ($a, $b) {
                return $b['utility'] <=> $a['utility'];
            });

            foreach ($this->alternatives as $index => &$alternative) {
                $alternative['rank'] = $index + 1;
            }
        }

        return view('alternatives.index', ['alternatives' => $this->alternatives, 'criteria' => $this->criteria]);
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        // Simpan alternatif
        $alternative = [
            'name' => $request->input('name'),
            'scores' => array_map('floatval', $request->input('scores'))
        ];

        // Tambahkan alternatif baru ke session
        $this->alternatives[] = $alternative;
        session()->put('alternatives', $this->alternatives);

        return redirect()->route('alternatives.index');
    }
}
