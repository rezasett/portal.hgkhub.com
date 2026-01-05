<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RolePermission;
use App\Services\RouteCollectorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolePermissionDemoSeeder extends Seeder
{
    /**
     * Seed the application's database with role permission demo users.
     */
    public function run(): void
    {
        $this->command->info('🚀 Starting Role Permission Demo Seeder...');
        
        // Seed role permissions first
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Clear route cache and update with latest routes
        RouteCollectorService::clearRouteCache();
        
        // Get routes from RolePermissions for each user
        $adminRoutes = RolePermission::getRoutesForRole('admin');
        $reviewerRoutes = RolePermission::getRoutesForRole('reviewer');
        $preparerRoutes = RolePermission::getRoutesForRole('preparer');
        $auditorRoutes = RolePermission::getRoutesForRole('auditor');

        $this->command->info('📋 Admin routes: ' . count($adminRoutes));
        $this->command->info('📋 Reviewer routes: ' . count($reviewerRoutes));
        $this->command->info('📋 Preparer routes: ' . count($preparerRoutes));
        $this->command->info('📋 Auditor routes: ' . count($auditorRoutes));

        // Create users dengan data minimal yang diperlukan
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'access_urls' => $adminRoutes,
                'status' => 'active'
            ],
            [
                'name' => 'Aryo Wibisono',
                'email' => 'aryo@example.com',
                'password' => Hash::make('password'),
                'role' => 'reviewer',
                'access_urls' => $reviewerRoutes,
                'status' => 'active'
            ],
            [
                'name' => 'Ardhi Senatama',
                'email' => 'ardhi@example.com',
                'password' => Hash::make('password'),
                'role' => 'preparer',
                'access_urls' => $preparerRoutes,
                'status' => 'active'
            ],
            [
                'name' => 'Sarah Auditor',
                'email' => 'auditor@example.com',
                'password' => Hash::make('password'),
                'role' => 'auditor',
                'access_urls' => $auditorRoutes,
                'status' => 'active'
            ]
        ];

        foreach ($users as $userData) {
            try {
                $user = User::updateOrCreate(
                    ['email' => $userData['email']],
                    $userData
                );
                $this->command->info("✅ Created/Updated user: {$user->name} ({$user->role})");
            } catch (\Exception $e) {
                $this->command->warn("⚠️ Could not create user {$userData['name']}: " . $e->getMessage());
            }
        }

        $this->command->info('');
        $this->command->info('🎉 Role Permission Demo Seeder completed!');
        $this->command->info('🔑 Login credentials:');
        $this->command->info('   • admin@example.com / password (All permissions)');
        $this->command->info('   • aryo@example.com / password (Reviewer permissions)');
        $this->command->info('   • ardhi@example.com / password (Preparer permissions)');
        $this->command->info('   • auditor@example.com / password (Auditor permissions)');
        $this->command->info('');
        $this->command->info('🌐 Visit /settings/role-permissions to manage permissions!');
        $this->command->info('⚡ Run "php artisan routes:update-permissions" to sync latest routes!');
    }
}