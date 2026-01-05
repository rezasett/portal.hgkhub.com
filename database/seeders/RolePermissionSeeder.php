<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use App\Services\RouteCollectorService;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔄 Seeding role permissions with categorized routes...');
        
        // Clear route cache to get fresh routes
        RouteCollectorService::clearRouteCache();
        
        // Get categorized routes dynamically
        $categorizedRoutes = RouteCollectorService::getCachedCategorizedRoutes();
        $allRoutes = [];
        
        // Flatten categorized routes for admin access
        foreach ($categorizedRoutes as $category => $routes) {
            $allRoutes = array_merge($allRoutes, array_keys($routes));
        }
        
        $this->command->info('📋 Found ' . count($allRoutes) . ' routes in ' . count($categorizedRoutes) . ' categories');
        
        // Display categories summary
        foreach ($categorizedRoutes as $category => $routes) {
            $this->command->info("   • {$category}: " . count($routes) . ' routes');
        }
        
        // Admin - full access to all routes
        RolePermission::updateOrCreate(
            ['role' => 'admin'],
            [
                'routes' => $allRoutes,
                'description' => 'Administrator - Full access to all features'
            ]
        );

        // Define role-based category access
        $roleCategories = [
            'partner' => [
                'Basic Pages', 'Authentication', 'Dashboard', 'Settings',
                'Pre Engagement', 'Risk Assessment', 'Risk Responses', 'Completing',
                'Client Management', 'Audit Planning', 'SAK (Financial Standards)',
                'Library SAK', 'Library SA', 'Other Library', 'Findings', 'Procedures',
                'Regulations', 'Learning Center', 'Glosarium', 'User Management',
                'System (Livewire)', 'File Storage'
            ],
            'manager' => [
                'Basic Pages', 'Authentication', 'Dashboard', 'Settings',
                'Pre Engagement', 'Risk Assessment', 'Risk Responses', 'Completing',
                'Client Management', 'Audit Planning', 'SAK (Financial Standards)',
                'Library SAK', 'Library SA', 'Other Library', 'Findings', 'Procedures',
                'Regulations', 'Learning Center', 'Glosarium', 'System (Livewire)', 'File Storage'
            ],
            'spv' => [
                'Basic Pages', 'Authentication', 'Dashboard', 'Settings',
                'Pre Engagement', 'Risk Assessment', 'Risk Responses', 'Completing',
                'Client Management', 'Audit Planning', 'SAK (Financial Standards)',
                'Library SAK', 'Library SA', 'Other Library', 'Findings', 'Procedures',
                'Regulations', 'Learning Center', 'Glosarium', 'System (Livewire)', 'File Storage'
            ],
            'auditor' => [
                'Basic Pages', 'Authentication', 'Dashboard', 'Settings',
                'Pre Engagement', 'Risk Assessment', 'Risk Responses', 'Completing',
                'Client Management', 'SAK (Financial Standards)', 'Library SAK', 'Library SA',
                'Findings', 'Procedures', 'Regulations', 'Learning Center',
                'Glosarium', 'System (Livewire)', 'File Storage'
            ],
            'client' => [
                'Basic Pages', 'Authentication', 'Dashboard',
                'Client Management', 'Library SAK', 'Library SA', 'Other Library',
                'Findings', 'Regulations', 'System (Livewire)', 'File Storage'
            ]
        ];

        // Generate routes for each role based on categories
        $partnerRoutes = $this->getRoutesByCategories($categorizedRoutes, $roleCategories['partner']);
        $managerRoutes = $this->getRoutesByCategories($categorizedRoutes, $roleCategories['manager']);
        $spvRoutes = $this->getRoutesByCategories($categorizedRoutes, $roleCategories['spv']);
        $auditorRoutes = $this->getRoutesByCategories($categorizedRoutes, $roleCategories['auditor']);
        $clientRoutes = $this->getRoutesByCategories($categorizedRoutes, $roleCategories['client']);
        
        // Partner
        RolePermission::updateOrCreate(
            ['role' => 'partner'],
            [
                'routes' => $partnerRoutes,
                'description' => 'Partner - Senior level access with user management'
            ]
        );

        // Manager
        RolePermission::updateOrCreate(
            ['role' => 'manager'],
            [
                'routes' => $managerRoutes,
                'description' => 'Manager - Management level access to audit features'
            ]
        );

        // Supervisor
        RolePermission::updateOrCreate(
            ['role' => 'spv'],
            [
                'routes' => $spvRoutes,
                'description' => 'Supervisor - Supervisory access to audit operations'
            ]
        );

        // Auditor
        RolePermission::updateOrCreate(
            ['role' => 'auditor'],
            [
                'routes' => $auditorRoutes,
                'description' => 'Auditor - Access to audit and review functions'
            ]
        );

        // Client
        RolePermission::updateOrCreate(
            ['role' => 'client'],
            [
                'routes' => $clientRoutes,
                'description' => 'Client - Limited access to view documents and findings'
            ]
        );
        
        $this->command->info('✅ Role permissions seeded successfully!');
        $this->command->info('   • Admin: ' . count($allRoutes) . ' routes');
        $this->command->info('   • Partner: ' . count($partnerRoutes) . ' routes');
        $this->command->info('   • Manager: ' . count($managerRoutes) . ' routes'); 
        $this->command->info('   • Supervisor: ' . count($spvRoutes) . ' routes');
        $this->command->info('   • Auditor: ' . count($auditorRoutes) . ' routes');
        $this->command->info('   • Client: ' . count($clientRoutes) . ' routes');
    }
    
    /**
     * Get routes by categories
     */
    private function getRoutesByCategories($categorizedRoutes, $allowedCategories)
    {
        $routes = [];
        foreach ($allowedCategories as $category) {
            if (isset($categorizedRoutes[$category])) {
                $routes = array_merge($routes, array_keys($categorizedRoutes[$category]));
            }
        }
        return array_unique($routes);
    }

    /**
     * Filter routes based on patterns (legacy method for compatibility)
     */
    private function filterRoutes($allRoutes, $patterns)
    {
        $filtered = [];
        foreach ($patterns as $pattern) {
            foreach ($allRoutes as $route) {
                if (str_starts_with($route, $pattern) || $route === $pattern) {
                    $filtered[] = $route;
                }
            }
        }
        return array_unique($filtered);
    }
}