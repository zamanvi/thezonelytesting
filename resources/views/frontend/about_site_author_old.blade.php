@extends('frontend.layouts._app')
@php
    $site_author = 'Meet the man Behind the Tow Now';
@endphp
@section('title', 'About Site Author')
@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-start">About the Site Author</h1>
            <img src="{{ asset('frontend/img/site-author.jpg') }}" alt="Md. Norozzaman" class="img-fluid rounded-circle" style="width: 150px;">
        </div>

        <p><strong>Md. Norozzaman</strong>, Founder and CEO of <strong>Tansai Consultancy & Language Center</strong>, is a distinguished serial entrepreneur and digital marketing strategist. A graduate of <strong>HEZHOU University, China</strong>, with a Bachelor’s degree in Media, he seamlessly integrates creativity and strategic foresight to establish and scale innovative business ventures.</p>

        <p>With expertise in e-commerce and SEO, Md. Norozzaman drives <strong>Tansai Consultancy & Language Center</strong> (<a href="https://www.tensaiconsultancy.com/" target="_blank">www.tensaiconsultancy.com</a>) toward unparalleled success.</p>

        <h4 class="mt-4">Entrepreneurial Ventures</h4>
        <p>In addition to leading <strong>Tansai</strong>, Md. Norozzaman is the visionary behind two flourishing startups in Bangladesh:</p>
        <ul>
            <li><a href="https://www.redrosebd.com/" target="_blank">Red Rose BD</a></li>
            <li><a href="https://www.masterenglishbook.com/" target="_blank">Master English Book</a></li>
        </ul>

        <h4 class="mt-4">Blogging and Knowledge Sharing</h4>
        <p>In his leisure time, he shares his insights through blogging at <a href="https://gelboore.com/home/" target="_blank">gelboore.com</a>, further showcasing his passion for knowledge-sharing and community engagement.</p>

        <h4 class="mt-4">Incubator Projects</h4>
        <p>Md. Norozzaman also spearheads forward-thinking incubator projects, including:</p>
        <ul>
            <li><a href="https://www.selfservecarwashnearme.com/" target="_blank">Self-Serve Car Wash Near Me</a></li>
            <li><a href="https://www.towtrucknearmenow.com/" target="_blank">Tow Truck Near Me Now</a></li>
        </ul>

        <p>With an unwavering commitment to innovation and excellence, Md. Norozzaman continues to lead <strong>Tansai</strong> and his diverse ventures, setting benchmarks for success in the global business landscape.</p>
    </div>
@endsection
@section('css')
    <style>
        a{
            font-size: 25px;
        }
    </style>
@endsection