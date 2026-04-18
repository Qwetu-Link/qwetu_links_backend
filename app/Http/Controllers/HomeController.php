<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $seo = [
            'title' => 'Qwetu Link Rental - Smart Rental Management for Modern Businesses',
            'description' => 'Qwetu Link Rental helps businesses manage rentals, inventory, bookings, customers, and reports with ease. Streamline your rental operations and grow faster with an all-in-one solution.',
            'keywords' => 'rental management system, equipment rental software, inventory tracking, booking system, rental business, Qwetu Link Rental',
            'og_title' => 'Qwetu Link Rental - Simplify Rental & Inventory Management',
            'og_description' => 'Power your rental business with Qwetu Link Rental. Manage bookings, track inventory, and gain real-time insights effortlessly.',
        ];

        return view('welcome', compact('seo'));
    }
}
