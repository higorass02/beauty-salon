<!-- resources/views/homepage.blade.php -->
@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <h1>Welcome to Beauty Salon</h1>
            <p>Where Beauty Meets Elegance</p>
            <a href="{{ route('services') }}" class="btn btn-primary">View Our Services</a>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2>About Us</h2>
            <p>
                We are a premier beauty salon that offers a wide range of services
                to enhance your natural beauty. Our team of skilled professionals
                is dedicated to providing exceptional care and personalized attention.
            </p>
            <a href="{{ route('about') }}" class="btn btn-secondary">Learn More</a>
        </div>
    </section>

    <section class="services-section">
        <div class="container">
            <h2>Our Services</h2>
            <ul>
                <li>Hairstyling</li>
                <li>Manicure & Pedicure</li>
                <li>Facials & Skin Care</li>
                <li>Makeup & Bridal Packages</li>
                <li>Waxing & Hair Removal</li>
            </ul>
            <a href="{{ route('services') }}" class="btn btn-primary">View All Services</a>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>
                Address: 123 Beauty Street, City, Country
                <br>
                Phone: (123) 456-7890
                <br>
                Email: info@beautysalon.com
            </p>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Get in Touch</a>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Add custom styles for the homepage */
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    .hero-section {
        background-image: url('https://example.com/hero-image.jpg'); /* Replace with your hero image URL */
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 200px 0;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .hero-content p {
        font-size: 20px;
        margin-bottom: 30px;
    }

    .btn {
        display: inline-block;
        padding: 12px 24px;
        font-size: 16px;
        border-radius: 4px;
        text-decoration: none;
        color: #fff;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #ff6347;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background-color: #ff4c2e;
    }

    .btn-secondary {
        background-color: #777;
    }

    .btn-secondary:hover {
        background-color: #555;
    }

    .about-section,
    .services-section,
    .contact-section {
        padding: 80px 0;
        text-align: center;
        background-color: #f8f8f8;
    }

    .about-section h2,
    .services-section h2,
    .contact-section h2 {
        font-size: 36px;
        margin-bottom: 20px;
    }

    .about-section p,
    .services-section ul,
    .contact-section p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .services-section ul {
        list-style: none;
        padding: 0;
    }

    .services-section li {
        margin-bottom: 10px;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 0 20px;
    }
</style>
@endpush
