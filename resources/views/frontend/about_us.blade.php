@extends('frontend.layouts._app')
@section('title', 'About Us')
@section('content')
    <header>
        <h1>About Us - Zonely</h1>
        <p><strong>Build Your Brand. Grow Your Sales.</strong></p>
    </header>

    <section style="margin-top: 1.5rem;">
        <p>
            At Zonely, we believe that every small and medium-sized business deserves the opportunity
            to shine online. In today’s world, customers search for everything “near me.” Yet, millions
            of service-based SMBs — from lawyers and doctors to salons, tutors, and plumbers — remain
            invisible because they lack a digital presence.
        </p>
        <p><strong>We’re here to change that.</strong></p>
    </section>

    <section>
        <h2>Our Mission</h2>
        <p>
            Our mission is simple: <strong>empower SMBs to go digital without complexity.</strong>
            Zonely helps businesses create branded online pages with booking, messaging,
            and lead tracking — all in just a few clicks. No coding. No expensive developers. Just results.
        </p>
    </section>

    <section>
        <h2>What We Offer</h2>
        <ul>
            <li><strong>Customizable Landing Pages</strong> – Build a professional online profile in minutes.</li>
            <li><strong>Booking & Messaging</strong> – Manage appointments and communicate with clients seamlessly.</li>
            <li><strong>Lead Tracking & Call Verification</strong> – Measure ROI and filter real leads that matter.</li>
            <li><strong>Affordable Plans</strong> – Accessible to businesses in both emerging and developed markets.
            </li>
        </ul>
    </section>

    <section>
        <h2>Why Choose Zonely?</h2>
        <ul>
            <li>Trusted by 50+ SMBs in Dhaka with a <strong>90%+ satisfaction rate</strong>.</li>
            <li>Designed for all service models: reputation-based (lawyers, tutors),
                appointment-based (salons, doctors), and on-demand (plumbers, electricians, tow trucks).</li>
            <li>Built for global scale — starting from Bangladesh, expanding to the U.S., and beyond.</li>
        </ul>
    </section>

    <section>
        <h2>Our Vision</h2>
        <p>
            We’re building the <strong>Shopify for service-based SMBs</strong> — a platform where local
            businesses can digitize, grow, and thrive globally. From reputation building to real-time leads,
            Zonely is the partner every small business needs to succeed in the digital era.
        </p>
    </section>

    <section>
        <h2>Meet Our Founder</h2>
        <p>
            👤 <strong>Norozzaman</strong> — Founder of Zonely, passionate about solving the digital divide
            for small businesses and helping them grow with simple, scalable tools.
        </p>
    </section>

    <section>
        <h2>Contact Us</h2>
        <p>
            📧 Email: <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a><br>
            📱 WhatsApp: <a href="https://wa.me/8801826192179" target="_blank">+8801826192179</a><br>
            📍 Location: Dhaka, Bangladesh
        </p>
    </section>
@endsection
@section('css')
    <style>
        :root {
            --mx: max(16px, 3.5vw);
            --fg: #0f172a;
            --muted: #475569;
            --bg: #fff;
            --card: #f8fafc;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--bg);
            color: var(--fg);
            font: 16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Helvetica, Arial;
        }

        .wrap {
            width: 100%;
            margin: 0 auto;
        }

        header {
            padding: 2rem var(--mx);
            background: var(--card);
            border-bottom: 1px solid #e2e8f0;
        }

        header h1 {
            margin: 0 0 .25rem;
            font-size: clamp(1.75rem, 3vw, 2.25rem);
        }

        header p {
            margin: 0;
            color: var(--muted);
        }

        nav.breadcrumb {
            font-size: .925rem;
            margin: 1rem 0 0;
            color: var(--muted);
        }

        main h2 {
            margin-top: 2.5rem;
            font-size: 1.35rem;
        }

        .card {
            background: var(--card);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.25rem;
            margin-bottom: 10px;
        }

        a {
            color: #0ea5e9;
        }
    </style>
@endsection
@section('scripts')
    <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "About Us - Zonely",
    "url": "https://thezonely.com/about-us",
    "dateModified": "2025-09-05",
    "about": { "@type": "Organization", "name": "Zonely" }
  }
  </script>
@endsection