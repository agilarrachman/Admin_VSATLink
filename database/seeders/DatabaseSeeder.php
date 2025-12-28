<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('sales')->insert([
            [
                'profile_picture' => 'profile_pictures/1.png',
                'username' => 'superadmin',
                'name' => 'Super Administrator',
                'email' => 'superadmin@vsatlink.co.id',
                'password' => Hash::make('password123'),
                'phone' => '081111111111',
                'gender' => 'Pria',
                'role' => 'Super Admin',
                'division' => 'Management',
                'position' => 'System Owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_picture' => 'profile_pictures/3.png',
                'username' => 'salesadmin',
                'name' => 'Dewi Lestari',
                'email' => 'sales@vsatlink.co.id',
                'password' => Hash::make('password123'),
                'phone' => '081222222222',
                'gender' => 'Wanita',
                'role' => 'Sales Admin',
                'division' => 'Sales & Marketing',
                'position' => 'Sales Executive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_picture' => 'profile_pictures/2.png',
                'username' => 'logisticadmin',
                'name' => 'Andi Pratama',
                'email' => 'logistic@vsatlink.co.id',
                'password' => Hash::make('password123'),
                'phone' => '081333333333',
                'gender' => 'Pria',
                'role' => 'Logistic Admin',
                'division' => 'Logistic',
                'position' => 'Logistic Officer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'profile_picture' => 'profile_pictures/4.png',
                'username' => 'serviceactivationadmin',
                'name' => 'Rina Kurnia',
                'email' => 'service.activation@vsatlink.co.id',
                'password' => Hash::make('password123'),
                'phone' => '081444444444',
                'gender' => 'Wanita',
                'role' => 'Service Activation Admin',
                'division' => 'Technical Service Activation',
                'position' => 'Service Activation Officer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('customers')->insert([
            [
                'username' => 'agilarrachman',
                'name' => 'Agil ArRachman',
                'company_representative_name' => null,
                'customer_type' => 'Perorangan',
                'email' => 'perorangan@example.com',
                'password' => Hash::make('password123'),
                'phone' => '081234567890',
                'npwp' => '00.000.000.0-000.000',
                'source_information' => 'Web',
                'sales_id' => 2,

                'province_code' => '32',
                'city_code' => '3273',
                'district_code' => '327310',
                'village_code' => '3273101003',
                'rt' => '001',
                'rw' => '002',
                'postal_code' => '40115',
                'latitude' => '-6.914744',
                'longitude' => '107.609810',
                'full_address' => 'Jl. Contoh No. 1, Bandung',

                'contact_name' => 'Agil Arrachman',
                'contact_email' => 'perorangan@example.com',
                'contact_phone' => '081234567890',
                'contact_position' => 'Pemilik',

                'npwp_document_url' => 'docs/npwp_perorangan.pdf',
                'nib_document_url' => null,
                'sk_document_url' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'username' => 'pt_mitra_digital',
                'name' => 'PT Mitra Digital Nusantara',
                'company_representative_name' => 'Budi Santoso',
                'customer_type' => 'PT.',
                'email' => 'admin@mitradigital.co.id',
                'password' => Hash::make('password123'),
                'phone' => '02188889999',
                'npwp' => '01.234.567.8-901.000',
                'source_information' => 'Sales',
                'sales_id' => 2,

                'province_code' => '31',
                'city_code' => '3171',
                'district_code' => '317105',
                'village_code' => '3171051001',
                'rt' => '003',
                'rw' => '004',
                'postal_code' => '10220',
                'latitude' => '-6.200000',
                'longitude' => '106.816666',
                'full_address' => 'Jl. Gatot Subroto No. 88, Jakarta',

                'contact_name' => 'Budi Santoso',
                'contact_email' => 'budi@mitradigital.co.id',
                'contact_phone' => '081299998888',
                'contact_position' => 'IT Manager',

                'npwp_document_url' => 'docs/npwp_pt.pdf',
                'nib_document_url' => 'docs/nib_pt.pdf',
                'sk_document_url' => 'docs/sk_pt.pdf',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('products')->insert([
            [
                'image_url' => 'products/aurora.png',
                'name' => 'VSATLink Aurora',
                'slug' => 'aurora',
                'description' => 'Paket premium berteknologi High Throughput Satellite (HTS) Ku-Band untuk kebutuhan koneksi tinggi dan stabil hingga 50 Mbps dengan dukungan teknis 24 jam.',
                'otc_cost' => 11500000,
                'mrc_cost' => 700000,
                'monthly_quota' => 120,
                'subscription_duration' => 36,
                'speed' => 'Up to 50/5 Mbps',
                'segmentation' => 'Korporasi, kantor cabang, pendidikan, pemerintahan',
                'free_airtime' => '20/2 Mbps setelah kuota habis',
                'is_promo' => true,

                'antena' => 'Antena Parabola Ku-Band Ø 0.74 m',
                'lnb' => 'LNB PLL Ku-Band',
                'buc' => 'BUC 3W Ku-Band',
                'modem' => 'Modem Hughes 2300 Series',
                'access_point' => 'Access Point Wi-Fi',

                'performance_benefit_title' => 'Performa Premium',
                'performance_benefit_description' => 'Teknologi HTS Ku-Band memberikan kecepatan hingga 50 Mbps dengan stabilitas tinggi.',

                'connectivity_benefit_title' => 'Koneksi Stabil',
                'connectivity_benefit_description' => 'Kualitas koneksi terjaga untuk kebutuhan bisnis dan sistem cloud.',

                'segmentation_benefit_title' => 'Untuk Korporasi',
                'segmentation_benefit_description' => 'Cocok untuk kantor cabang, instansi pemerintah, dan lembaga pendidikan.',

                'added_value_benefit_title' => 'Value Premium',
                'added_value_benefit_description' => 'Performa kelas premium dengan biaya bulanan yang kompetitif.',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'image_url' => 'products/nova.png',
                'name' => 'VSATLink Nova',
                'slug' => 'nova',
                'description' => 'Solusi internet satelit hemat dan tangguh untuk UMKM, sekolah, dan wilayah rural tanpa jaringan kabel.',
                'otc_cost' => 10000000,
                'mrc_cost' => 700000,
                'monthly_quota' => 30,
                'subscription_duration' => 36,
                'speed' => 'Up to 50/5 Mbps',
                'segmentation' => 'UMKM, kantor desa, sekolah, rural',
                'free_airtime' => '20/2 Mbps setelah kuota habis',
                'is_promo' => true,

                'antena' => 'Antena Parabola Ku-Band Ø 0.74 m',
                'lnb' => 'LNB PLL Ku-Band',
                'buc' => 'BUC 3W Ku-Band',
                'modem' => 'Modem Hughes 2300 Series',
                'access_point' => null,

                'performance_benefit_title' => 'Internet Hemat',
                'performance_benefit_description' => 'Solusi konektivitas terjangkau untuk kebutuhan dasar internet.',

                'connectivity_benefit_title' => 'Koneksi Aktif',
                'connectivity_benefit_description' => 'Tetap online 24 jam dengan free airtime otomatis.',

                'segmentation_benefit_title' => 'Untuk UMKM',
                'segmentation_benefit_description' => 'Dirancang untuk UMKM, sekolah, dan kantor desa.',

                'added_value_benefit_title' => 'Biaya Efisien',
                'added_value_benefit_description' => 'Alternatif internet satelit ekonomis dan andal.',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'image_url' => 'products/miner.png',
                'name' => 'VSATLink Miner',
                'slug' => 'miner',
                'description' => 'Solusi konektivitas satelit berdaya tinggi untuk pertambangan, logging camp, dan proyek energi.',
                'otc_cost' => 14500000,
                'mrc_cost' => 2500000,
                'monthly_quota' => 360,
                'subscription_duration' => 36,
                'speed' => 'Up to 50/5 Mbps',
                'segmentation' => 'Pertambangan, logging camp, proyek energi',
                'free_airtime' => '-',
                'is_promo' => false,

                'antena' => 'Antena Ku-Band Ø 1.2 m (Heavy Duty)',
                'lnb' => 'LNB PLL Ku-Band',
                'buc' => 'BUC 6W Ku-Band',
                'modem' => 'Modem Hughes 2010 Series',
                'access_point' => 'Access Point Industrial-grade',

                'performance_benefit_title' => 'Performa Industri',
                'performance_benefit_description' => 'Konektivitas berdaya tinggi untuk operasional berat.',

                'connectivity_benefit_title' => 'Koneksi Andal',
                'connectivity_benefit_description' => 'Stabil 24 jam untuk area remote.',

                'segmentation_benefit_title' => 'Untuk Tambang',
                'segmentation_benefit_description' => 'Ideal untuk pertambangan dan basecamp industri.',

                'added_value_benefit_title' => 'SLA Tinggi',
                'added_value_benefit_description' => 'Mendukung CCTV & SCADA dengan uptime hingga 98%.',

                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'image_url' => 'products/frontier.png',
                'name' => 'VSATLink Frontier',
                'slug' => 'frontier',
                'description' => 'Konektivitas satelit andal untuk daerah pedalaman dan fasilitas publik terpencil.',
                'otc_cost' => 12000000,
                'mrc_cost' => 850000,
                'monthly_quota' => 120,
                'subscription_duration' => 36,
                'speed' => 'Up to 50/5 Mbps',
                'segmentation' => 'Daerah terpencil, fasilitas publik, pos pengawasan',
                'free_airtime' => '20/2 Mbps',
                'is_promo' => false,

                'antena' => 'Antena Ku-Band Ø 0.9 m',
                'lnb' => 'LNB PLL Ku-Band',
                'buc' => 'BUC 3W Ku-Band',
                'modem' => 'Modem Hughes 2300 Series',
                'access_point' => 'Access Point Wi-Fi',

                'performance_benefit_title' => 'Area Terpencil',
                'performance_benefit_description' => 'Solusi internet untuk lokasi tanpa jaringan darat.',

                'connectivity_benefit_title' => 'Koneksi Stabil',
                'connectivity_benefit_description' => 'Tetap konsisten di kondisi geografis ekstrem.',

                'segmentation_benefit_title' => 'Untuk Publik',
                'segmentation_benefit_description' => 'Cocok untuk sekolah, fasilitas kesehatan, dan pos pengawasan.',

                'added_value_benefit_title' => 'Cakupan Nasional',
                'added_value_benefit_description' => 'Menjangkau seluruh wilayah Indonesia.',

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('order_statuses')->insert([
            [
                'name' => 'Pesanan Dibuat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesanan Dikonfirmasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesanan Dibayar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesanan Dikirim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesanan Siap Diambil',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pesanan Diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dibatalkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
