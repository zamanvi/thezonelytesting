@extends('frontend.layouts._app')
@section('title', 'Privacy Policy')
@section('content')
    <header aria-labelledby="page-title">
        <div class="wrap">
            <h1 id="page-title">Privacy Policy</h1>
            <p>Zonely - Build Your Brand. Grow Your Sales.</p>
        </div>
    </header>
    <main class="wrap" id="content">
        <p class="updated" aria-live="polite">Last updated: <time datetime="2025-09-05">September 5, 2025</time></p>
        <section class="card" aria-labelledby="intro-heading">
            <h2 id="intro-heading">Introduction</h2>
            <p>At <strong>Zonely</strong> ("we," "our," "us"), we value your privacy and are committed to protecting
                your
                personal information. This Privacy Policy explains how we collect, use, and safeguard your data when
                you use
                our website, services, and applications.</p>
        </section>

        <section class="card" aria-labelledby="collect-heading">
            <h2 id="collect-heading">1. Information We Collect</h2>
            <ul>
                <li><strong>Personal Information:</strong> Name, email address, phone number, business details, and
                    payment
                    information (if applicable).</li>
                <li><strong>Account Data:</strong> Login credentials, profile details, and service preferences.</li>
                <li><strong>Usage Data:</strong> IP address, browser type, device information, and activity logs.
                </li>
                <li><strong>Customer Interaction Data:</strong> Messages, bookings, and calls made through Zonely’s
                    platform.</li>
            </ul>
        </section>

        <section class="card" aria-labelledby="use-heading">
            <h2 id="use-heading">2. How We Use Your Information</h2>
            <ol>
                <li>Provide, operate, and improve our SaaS platform.</li>
                <li>Enable booking, messaging, and lead-tracking features.</li>
                <li>Communicate with you regarding your account, updates, and support.</li>
                <li>Process payments and subscriptions securely.</li>
                <li>Analyze usage patterns to enhance performance and user experience.</li>
                <li>Comply with legal requirements and prevent fraudulent activities.</li>
            </ol>
        </section>

        <section class="card" aria-labelledby="sharing-heading">
            <h2 id="sharing-heading">3. Sharing of Information</h2>
            <p>We do not sell or rent your personal information. However, we may share data with:</p>
            <ul>
                <li><strong>Service Providers:</strong> Payment processors, hosting providers, and analytics tools.
                </li>
                <li><strong>Legal Authorities:</strong> When required by law or to protect our rights.</li>
                <li><strong>Business Transfers:</strong> In case of mergers, acquisitions, or company restructuring.
                </li>
            </ul>
        </section>

        <section class="card" aria-labelledby="security-heading">
            <h2 id="security-heading">4. Data Security</h2>
            <p>We implement industry-standard security measures (encryption, secure servers, access controls) to
                protect
                your data. While no method is 100% secure, we strive to safeguard all personal and business
                information.</p>
        </section>

        <section class="card" aria-labelledby="rights-heading">
            <h2 id="rights-heading">5. Your Rights</h2>
            <p>Depending on your location, you may have the right to:</p>
            <ul>
                <li>Access, update, or delete your personal information.</li>
                <li>Request a copy of your data.</li>
                <li>Withdraw consent for data processing.</li>
                <li>Opt out of marketing communications.</li>
            </ul>
            <p>To exercise your rights, contact us at <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a>.
            </p>
        </section>

        <section class="card" aria-labelledby="cookies-heading">
            <h2 id="cookies-heading">6. Cookies &amp; Tracking</h2>
            <p>We use cookies and similar technologies to improve your browsing experience, analyze traffic, and
                personalize
                content. You can control cookies through your browser settings.</p>
        </section>

        <section class="card" aria-labelledby="third-heading">
            <h2 id="third-heading">7. Third-Party Links</h2>
            <p>Our platform may contain links to third-party websites or services. Zonely is not responsible for the
                privacy
                practices or content of those external sites.</p>
        </section>

        <section class="card" aria-labelledby="children-heading">
            <h2 id="children-heading">8. Children’s Privacy</h2>
            <p>Zonely is not directed to individuals under the age of 13. We do not knowingly collect personal
                information
                from children.</p>
        </section>

        <section class="card" aria-labelledby="updates-heading">
            <h2 id="updates-heading">9. Updates to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with the
                updated
                date. Continued use of Zonely after updates means you accept the revised policy.</p>
        </section>

        <section class="card" aria-labelledby="contact-heading">
            <h2 id="contact-heading">10. Contact Us</h2>
            <address>
                <p><strong>Zonely</strong><br />Dhaka, Bangladesh</p>
                <p>Email: <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a><br />
                    WhatsApp: <a href="https://wa.me/8801826192179" rel="noopener">+8801826192179</a></p>
            </address>
        </section>

        <section class="card" aria-labelledby="compliance-heading">
            <h2 id="compliance-heading">Jurisdiction & Compliance Note</h2>
            <p>This is a general-purpose policy. If you serve customers in the EU, UK, or California, you may need
                additional disclosures to comply with GDPR/UK GDPR and CCPA/CPRA (e.g., lawful bases, data retention
                periods, data subject request workflows, and Do Not Sell or Share links). We can expand this section
                on
                request.</p>
        </section>
    </main>
@endsection
@section('css')
    <style>
        :root {
            --mx: max(16px, 3.5vw);
            --fg: #0f172a;
            --muted: #475569;
            --bg: #ffffff;
            --card: #f8fafc;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--bg);
            color: var(--fg);
            font: 16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, Noto Sans, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
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

        nav.breadcrumb a {
            color: inherit;
            text-decoration: none;
        }

        .updated {
            font-size: .95rem;
            color: var(--muted);
        }

        .card {
            background: var(--card);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1rem;
            margin-bottom: 10px;
        }

        ul.toc {
            list-style: none;
            padding-left: 0;
        }

        ul.toc li {
            margin: .35rem 0;
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
            "name": "Privacy Policy",
            "url": "https://thezonely.com/privacy-policy",
            "dateModified": "2025-09-05",
            "about": {
            "@type": "Organization",
            "name": "Zonely",
            "email": "norozzaman996@gmail.com",
            "telephone": "+8801826192179",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Dhaka",
                "addressCountry": "BD"
            },
            "contactPoint": [{
                "@type": "ContactPoint",
                "contactType": "customer support",
                "email": "norozzaman996@gmail.com",
                "telephone": "+8801826192179",
                "areaServed": "BD, US"
            }]
            }
        }
  </script>
@endsection
