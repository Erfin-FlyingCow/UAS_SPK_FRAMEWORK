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
        // Cari skor tertinggi dan terendah untuk setiap kriteria
        $maxScores = [];
        $minScores = [];
        foreach ($this->criteria as $index => $criterion) {
            $scores = array_column($this->alternatives, 'scores')[$index];
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
            $alternative['utility'] = $utility;
        }

        return view('alternatives.index', ['alternatives' => $this->alternatives]);
    }

    public function create()
    {
        return view('alternatives.create');
    }

    public function store(Request $request)
    {
        // Simpan kriteria dan bobot
        $this->criteria = [];
        foreach ($request->input('weights') as $index => $weight) {
            $this->criteria[] = ['weight' => $weight];
        }
        session()->put('criteria', $this->criteria);

        // Simpan alternatif
        $alternative = [
            'name' => $request->input('name'),
            'scores' => $request->input('scores')
        ];

        // Tambahkan alternatif baru ke session
        $this->alternatives[] = $alternative;
        session()->put('alternatives', $this->alternatives);

        return redirect()->route('alternatives.index');
    }
}
