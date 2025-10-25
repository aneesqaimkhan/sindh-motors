<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UpdateShowroomQrCodes extends Seeder
{
    public function run()
    {
        $showroomModel = new \App\Models\ShowroomModel();
        $showrooms = $showroomModel->findAll();
        
        $baseUrl = rtrim(base_url(), '/');
        
        foreach ($showrooms as $showroom) {
            $showroomId = $showroom['id'];
            $qrCodeUrl = $baseUrl . '/showrooms/members/' . $showroomId;
            
            // Update the showroom with the new QR code URL using query builder
            $showroomModel->builder()->where('id', $showroomId)->update(['qr_code' => $qrCodeUrl]);
            
            echo "Updated showroom ID {$showroomId} with QR code URL: {$qrCodeUrl}\n";
        }
        
        echo "Successfully updated " . count($showrooms) . " showrooms.\n";
    }
}

