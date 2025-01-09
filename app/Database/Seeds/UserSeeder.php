<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'            => 'Admin',
                'username'        => 'admin',
                'password'        => password_hash('password', PASSWORD_BCRYPT),
                'role'            => 'admin',
                'company_name'    => 'PT. Bhinneka Sangkuriang Transport',
                'company_address' => 'Jl. Admin Raya No. 1',
                'company_city'    => 'Cirebon',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'name'            => 'Aris Apriyanto',
                'username'        => 'aris',
                'password'        => password_hash('password', PASSWORD_BCRYPT),
                'role'            => 'purchasing',
                'company_name'    => 'PT. Purchasing Sejahtera',
                'company_address' => 'Jl. Purchasing Indah No. 2',
                'company_city'    => 'Bandung',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($users);
    }
}
