@extends('frontend.layouts._app')
@section('title', 'About Us')
@section('content')
    <div class="container py-5" style="min-height: 80vh;">
        <section id="about-us" class="container">
            <h1>About Zonely</h1>
            <p><strong>Zonely</strong> is the premier platform to <em>discover, compare, and hire trusted local
                    experts</em>—starting with lawyers, and expanding to finance, health, and real estate professionals in
                your area.</p>

            <h2>We Understand Your Needs</h2>
            <p>Looking for expert legal help near you shouldn’t be hard or expensive. Local professionals struggle with high
                ad costs and limited online visibility. Meanwhile, clients often can’t compare verified local providers in
                one place. That’s where we come in.</p>

            <h2>Our Mission & Values</h2>
            <ul>
                <li><strong>Transparency:</strong> No upfront fees for service providers—only later through ads or lead
                    partnerships.</li>
                <li><strong>Trust:</strong> Verified credentials, real client reviews, and transparent profiles.</li>
                <li><strong>Local-first:</strong> Hyperlocal search and powerful matchmaking ensure you connect with nearby
                    experts.</li>
                <li><strong>Empathy:</strong> We make legal services approachable, understandable, and client-centered.</li>
            </ul>

            <h2>Our Story</h2>
            <p>Founded to solve a growing problem: thousands searching “lawyer near me” didn’t have an easy way to compare
                trusted professionals without paying hefty ad fees or browsing general directories. Zonely started with a
                powerful vision—to help clients find confident solutions, and local lawyers to get quality leads affordably.
            </p>

            <h2>Our Solution</h2>
            <p>Zonely is a free, intuitive local marketplace where:</p>
            <ol>
                <li><strong>Providers</strong> create profiles—sharing credentials, reviews, and services, all without
                    upfront cost.</li>
                <li><strong>Clients</strong> search and compare nearby experts—based on verified information and client
                    feedback.</li>
                <li><strong>We</strong> generate revenue through ads, featured listings, and lead partnerships—so experts
                    can grow with no risk.</li>
            </ol>

            <h2>Meet Our Team</h2>
            <div class="team">
                <div class="member">
                    <img src="path/to/photo.jpg" alt="Co‑Founder & CEO">
                    <h3>Jane Doe</h3>
                    <p>Co‑Founder & CEO — legaltech expert who believes in local access to justice.</p>
                </div>
            </div>

            <h2>Why Now?</h2>
            <p>“Near me” local searches are skyrocketing. High-intent fields like law are underserved by current platforms.
                With AI-driven matching and strategic expansion, Zonely is poised to meet this demand—first in Houston, then
                nationwide and beyond.</p>

            <h2>Our Vision</h2>
            <p>To become the <strong>world’s leading platform</strong> for discovering, comparing, and booking high-value
                “near me” service providers—starting with legal services and scaling across other high-intent niches.</p>

            <h2>Get in Touch</h2>
            <p>For questions or partnership inquiries, reach out to:</p>
            <ul>
                <li>Email: <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a></li>
                <li>WhatsApp: <a href="https://wa.me/8801826192179" target="_blank">+88018-2619-2179</a></li>
            </ul>

            <h2>Ready to Get Started?</h2>
            <p>If you’re a client, search your city’s lawyers now.
                If you’re a provider, <a href="/signup">create your free profile today</a>.
                Questions? Use the contacts above or <a href="/contact">Send us a message</a>.</p>
        </section>
    </div>
@endsection
@section('css')
    <style>
        a {
            font-size: 25px;
        }
    </style>
@endsection
