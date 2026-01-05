<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RolePermission;
use App\Services\RouteCollectorService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed role permissions first
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Clear route cache and update with latest routes
        RouteCollectorService::clearRouteCache();
        
        // Get all available routes for admin (full access)
        $allRoutes = array_keys(RouteCollectorService::getCachedRoutes());
        
        // Get routes from RolePermissions for each user, fallback to basic routes if not exist
        $adminRoutes = RolePermission::getRoutesForRole('admin') ?: $allRoutes;
        $partnerRoutes = RolePermission::getRoutesForRole('partner') ?: ['/', '/profile', '/dashboard'];
        $managerRoutes = RolePermission::getRoutesForRole('manager') ?: ['/', '/profile', '/dashboard'];
        $spvRoutes = RolePermission::getRoutesForRole('spv') ?: ['/', '/profile', '/dashboard'];
        $auditorRoutes = RolePermission::getRoutesForRole('auditor') ?: ['/', '/profile', '/dashboard'];
        $clientRoutes = RolePermission::getRoutesForRole('client') ?: ['/', '/profile', '/dashboard'];

        // Create users dengan role-based permissions dari database
        // Skip jika ada error dengan constraint, kita fokus pada role permission system
        try {
            // Create admin user with all permissions
            User::factory()->create([
                'name' => 'Admin System',
                'email' => 'admin@example.com',
                'role' => 'admin',  
                'jabatan_id' => 1,
                'access_urls' => $adminRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);

            // Create partner user
            User::factory()->create([
                'name' => 'Partner KAP',
                'email' => 'partner@example.com',
                'role' => 'partner',  
                'jabatan_id' => 2,
                'access_urls' => $partnerRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);

            // Create manager user
            User::factory()->create([
                'name' => 'Manager Audit',
                'email' => 'manager@example.com',
                'role' => 'manager',  
                'jabatan_id' => 3,
                'access_urls' => $managerRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);

            // Create supervisor user
            User::factory()->create([
                'name' => 'Supervisor Tim',
                'email' => 'spv@example.com',
                'role' => 'spv',  
                'jabatan_id' => 4,
                'access_urls' => $spvRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);

            // Create auditor user
            User::factory()->create([
                'name' => 'Auditor Staff',
                'email' => 'auditor@example.com',
                'role' => 'auditor',  
                'jabatan_id' => 5,
                'access_urls' => $auditorRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);

            // Create client user
            User::factory()->create([
                'name' => 'Client User',
                'email' => 'client@example.com',
                'role' => 'client',  
                'jabatan_id' => 6,
                'access_urls' => $clientRoutes,
                'status' => 'active',
                'glosarium_industri_ids' => json_encode([]),
            ]);
            
            $this->command->info('✅ Users created successfully with role-based permissions!');
        } catch (\Exception $e) {
            $this->command->warn('⚠️  Could not create users due to database constraints: ' . $e->getMessage());
            $this->command->info('💡 You can create users manually or fix the database constraints.');
        }

        // Call other seeders
        $this->call([
            GlosariumStandarAkuntansiSeeder::class,
            CourseSeeder::class,
            UserPointsSeeder::class,
        ]);

        $this->command->info('✅ DatabaseSeeder completed with role-based permissions!');
        $this->command->info('🔑 Admin: admin@example.com (All permissions)');
        $this->command->info('👥 Reviewer: aryo@example.com (Review permissions)');
        $this->command->info('📝 Preparer: ardhi@example.com (Prepare permissions)');
        $this->command->info('🔍 Auditor: auditor@example.com (Audit permissions)');
        $this->command->info('💡 Run "php artisan routes:update-permissions" to sync latest routes!');
    }
}
