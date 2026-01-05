<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompleteArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        $this->command->info('Clearing existing article data...');
        
        \App\Models\ArtikelSakReviewerComment::query()->delete();
        \App\Models\ArtikelFindingsReviewerComment::query()->delete();
        \App\Models\ArtikelProcedureReviewerComments::query()->delete();
        \App\Models\ArtikelRegulationReviewerComment::query()->delete();
        \App\Models\SakLibReviewerComment::query()->delete();
        
        \App\Models\ArtikelSak::query()->delete();
        \App\Models\ArtikelFindings::query()->delete();
        \App\Models\ArtikelProcedures::query()->delete();
        \App\Models\ArtikelRegulations::query()->delete();
        \App\Models\SakLib::query()->delete();

        // Create articles with proper categories
        $this->command->info('Creating SAK articles...');
        \App\Models\ArtikelSak::factory()->count(15)->create();

        $this->command->info('Creating Findings articles...');
        \App\Models\ArtikelFindings::factory()->count(15)->create();

        $this->command->info('Creating Procedures articles...');
        \App\Models\ArtikelProcedures::factory()->count(15)->create();

        $this->command->info('Creating Regulations articles...');
        \App\Models\ArtikelRegulations::factory()->count(15)->create();

        $this->command->info('Creating SAK Library articles...');
        \App\Models\SakLib::factory()->count(15)->create();

        // Create reviewer comments
        $this->command->info('Creating reviewer comments...');
        
        // Get some articles to add comments to (only published ones)
        $sakArticles = \App\Models\ArtikelSak::where('status', 'published')->limit(8)->pluck('id');
        $findingsArticles = \App\Models\ArtikelFindings::where('status', 'published')->limit(8)->pluck('id');
        $proceduresArticles = \App\Models\ArtikelProcedures::where('status', 'published')->limit(8)->pluck('id');
        $regulationsArticles = \App\Models\ArtikelRegulations::where('status', 'published')->limit(8)->pluck('id');
        $sakLibArticles = \App\Models\SakLib::where('status', 'published')->limit(8)->pluck('id');
        
        // Create reviewer comments for some articles
        foreach($sakArticles as $articleId) {
            \App\Models\ArtikelSakReviewerComment::factory()->create([
                'artikel_sak_id' => $articleId,
            ]);
        }
        
        foreach($findingsArticles as $articleId) {
            \App\Models\ArtikelFindingsReviewerComment::factory()->create([
                'artikel_findings_id' => $articleId,
            ]);
        }
        
        foreach($proceduresArticles as $articleId) {
            \App\Models\ArtikelProcedureReviewerComments::factory()->create([
                'artikel_procedure_id' => $articleId,
            ]);
        }

        foreach($regulationsArticles as $articleId) {
            \App\Models\ArtikelRegulationReviewerComment::factory()->create([
                'artikel_regulation_id' => $articleId,
            ]);
        }

        foreach($sakLibArticles as $articleId) {
            \App\Models\SakLibReviewerComment::factory()->create([
                'sak_lib_id' => $articleId,
            ]);
        }

        $this->command->info('✅ Complete article seeding finished!');
        $this->command->info('📊 Summary:');
        $this->command->info('- SAK Articles: ' . \App\Models\ArtikelSak::count());
        $this->command->info('- Findings Articles: ' . \App\Models\ArtikelFindings::count());
        $this->command->info('- Procedures Articles: ' . \App\Models\ArtikelProcedures::count());
        $this->command->info('- Regulations Articles: ' . \App\Models\ArtikelRegulations::count());
        $this->command->info('- SAK Library Articles: ' . \App\Models\SakLib::count());
        $this->command->info('- SAK Reviewer Comments: ' . \App\Models\ArtikelSakReviewerComment::count());
        $this->command->info('- Findings Reviewer Comments: ' . \App\Models\ArtikelFindingsReviewerComment::count());
        $this->command->info('- Procedures Reviewer Comments: ' . \App\Models\ArtikelProcedureReviewerComments::count());
        $this->command->info('- Regulations Reviewer Comments: ' . \App\Models\ArtikelRegulationReviewerComment::count());
        $this->command->info('- SAK Library Reviewer Comments: ' . \App\Models\SakLibReviewerComment::count());
    }
}
