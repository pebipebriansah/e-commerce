<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    public static function configure()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Xp8iWFicCUusYLDEEeUPzd4G';
        \Midtrans\Config::$isProduction = false; // Ubah ke true untuk production
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }
}
