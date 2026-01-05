<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MemoEqcrRecommendationTemplate;

class MemoEqcrRecommendationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [ 
                'risk_level' => 'very_high',
                'score_result' => 5,
                'template_text' => 'Berdasarkan penilaian EQCR Internal, engagement ini memiliki RISIKO SANGAT TINGGI dengan total skor {total_score}. Disarankan untuk melakukan review mendalam terhadap semua aspek engagement sebelum melanjutkan. Tim harus mempertimbangkan penambahan prosedur audit yang lebih ketat, konsultasi dengan partner senior, dan evaluasi kembali strategi audit. Perhatian khusus diperlukan pada area dengan skor tinggi.',
                'status' => 'active' 
            ],
            [
                'risk_level' => 'high',
                'score_result' => 4,
                'template_text' => 'Berdasarkan penilaian EQCR Internal, engagement ini memiliki RISIKO TINGGI dengan total skor {total_score}. Diperlukan review tambahan dan pengawasan yang ketat selama pelaksanaan audit. Tim harus melakukan prosedur audit tambahan pada area berisiko tinggi dan memastikan dokumentasi yang memadai. Konsultasi dengan supervisor senior sangat direkomendasikan.',
                'status' => 'active'
            ],
            [
                'risk_level' => 'medium',
                'score_result' => 3,
                'template_text' => 'Berdasarkan penilaian EQCR Internal, engagement ini memiliki RISIKO SEDANG dengan total skor {total_score}. Pelaksanaan audit dapat dilanjutkan dengan prosedur standar, namun tetap perlu monitoring pada area-area yang mendapat skor tinggi. Tim harus memastikan prosedur audit telah dilaksanakan sesuai standar dan dokumentasi lengkap.',
                'status' => 'active'
            ],
            [
                'risk_level' => 'low_medium',
                'score_result' => 2,
                'template_text' => 'Berdasarkan penilaian EQCR Internal, engagement ini memiliki RISIKO RENDAH-SEDANG dengan total skor {total_score}. Engagement dapat dilaksanakan dengan prosedur audit standar. Tim tetap harus memastikan kualitas pelaksanaan audit dan kelengkapan dokumentasi sesuai dengan standar yang berlaku.',
                'status' => 'active'
            ],
            [
                'risk_level' => 'low',
                'score_result' => 1,
                'template_text' => 'Berdasarkan penilaian EQCR Internal, engagement ini memiliki RISIKO RENDAH dengan total skor {total_score}. Engagement dapat dilaksanakan dengan prosedur audit standar dengan tingkat pengawasan normal. Tim harus tetap menjaga kualitas pelaksanaan audit sesuai dengan standar profesional yang berlaku.',
                'status' => 'active'
            ],
             [
                'risk_level' => 'none',
                'score_result' => 0,
                'template_text' => 'score "0", Please add score into system.',
                'status' => 'active'
            ]
        ];

        foreach ($templates as $template) {
            MemoEqcrRecommendationTemplate::create($template);
        }
    }
}