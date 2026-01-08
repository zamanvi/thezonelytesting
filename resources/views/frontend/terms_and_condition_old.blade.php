@extends('frontend.layouts._app')
@section('title', 'Terms and Conditions')
@section('content')
    <header aria-labelledby="page-title" style="margin-bottom: 2rem;">
        <div class="wrap">
            <h1 id="page-title">Terms &amp; Conditions</h1>
            <p>Zonely — Build Your Brand. Grow Your Sales.</p>
        </div>
    </header>

    <main class="wrap" id="content">
        <section class="card">
            <p class="updated">Last updated: <time datetime="2025-09-05">September 5, 2025</time></p>
            <h2>1. Introduction</h2>
            <p>Welcome to Zonely ("we", "us", "our"). These Terms &amp; Conditions ("Terms") govern your access to and use
                of our website, services, and software-as-a-service platform (together, the "Service"). By accessing or
                using the Service, you agree to be bound by these Terms.</p>
        </section>

        <section class="card">
            <h2>2. Eligibility</h2>
            <p>You must be at least 18 years old and have the legal capacity to enter into contracts to use the Service. By
                using Zonely, you represent and warrant that you meet these eligibility requirements.</p>
        </section>

        <section class="card">
            <h2>3. Accounts &amp; Registration</h2>
            <p>To access certain features, you must create an account. You agree to provide accurate, current, and complete
                information and to maintain and promptly update your account information. You are responsible for
                safeguarding your account credentials and for any activity that occurs under your account.</p>
        </section>

        <section class="card">
            <h2>4. Service Description</h2>
            <p>Zonely provides tools for service-based small and medium-sized businesses to create online profiles, manage
                bookings, messaging, and lead tracking. We may update, modify, or discontinue features at our discretion,
                with or without notice.</p>
        </section>

        <section class="card">
            <h2>5. Fees, Billing &amp; Subscriptions</h2>
            <p>We offer subscription plans and usage-based pricing. By subscribing, you authorize Zonely to charge your
                chosen payment method for all fees incurred. Subscription details, pricing, and renewal terms will be
                provided at the point of purchase.</p>
            <p><strong>Billing &amp; Refunds:</strong> All fees are non-refundable unless otherwise stated. We may offer
                trial periods; upon trial expiration, charges begin automatically unless cancelled. To request a refund,
                contact support; refunds are handled at our sole discretion.</p>
        </section>

        <section class="card">
            <h2>6. Acceptable Use</h2>
            <p>You agree not to use the Service for any unlawful purpose or to transmit harmful content. Prohibited
                activities include, but are not limited to:</p>
            <ul>
                <li>Violating laws or infringing intellectual property rights.</li>
                <li>Uploading malware, spam, or unsolicited commercial messages.</li>
                <li>Attempting to gain unauthorized access to Zonely systems.</li>
            </ul>
            <p>We reserve the right to suspend or terminate accounts that breach these rules.</p>
        </section>

        <section class="card">
            <h2>7. Intellectual Property</h2>
            <p>Zonely retains all rights, title, and interest in and to the Service, including software, content, and
                trademarks. Users retain ownership of content they upload ("User Content"). By uploading User Content, you
                grant Zonely a worldwide, royalty-free license to host, reproduce, modify, and display such content as
                necessary to provide the Service.</p>
        </section>

        <section class="card">
            <h2>8. User Content &amp; License</h2>
            <p>You are solely responsible for User Content and must ensure it does not violate laws or third-party rights.
                Zonely may remove User Content that violates these Terms or is otherwise objectionable.</p>
        </section>

        <section class="card">
            <h2>9. Third-Party Services</h2>
            <p>The Service may integrate with third-party tools (payment processors, analytics, messaging). Use of such
                third-party services is subject to their terms and privacy policies. Zonely is not responsible for
                third-party actions or content.</p>
        </section>

        <section class="card">
            <h2>10. Disclaimers</h2>
            <p>The Service is provided "as is" and "as available" without warranties of any kind, whether express or
                implied. Zonely disclaims all warranties, including merchantability, fitness for a particular purpose, and
                non-infringement.</p>
        </section>

        <section class="card">
            <h2>11. Limitation of Liability</h2>
            <p>To the maximum extent permitted by law, Zonely and its affiliates will not be liable for indirect,
                incidental, special, consequential, or punitive damages arising from your use of the Service. Our aggregate
                liability is limited to the amount you paid Zonely in the 12 months preceding the claim.</p>
        </section>

        <section class="card">
            <h2>12. Indemnification</h2>
            <p>You agree to indemnify and hold Zonely harmless from any claims, losses, liabilities, and expenses arising
                from your use of the Service, violation of these Terms, or infringement of third-party rights.</p>
        </section>

        <section class="card">
            <h2>13. Termination</h2>
            <p>Either party may terminate the account in accordance with the account settings and payment terms. Zonely may
                suspend or terminate access for violations or when required by law. Upon termination, certain data may be
                retained to the extent necessary for legal or administrative purposes.</p>
        </section>

        <section class="card">
            <h2>14. Governing Law &amp; Dispute Resolution</h2>
            <p>These Terms are governed by the laws of Bangladesh. If you are using Zonely from another jurisdiction, local
                laws may apply. Any disputes arising out of or relating to these Terms will be resolved in the competent
                courts located in Dhaka, Bangladesh, unless otherwise required by mandatory local law.</p>
        </section>

        <section class="card">
            <h2>15. Changes to Terms</h2>
            <p>We may modify these Terms from time to time. Material changes will be communicated via email or through the
                Service. Continued use after notice constitutes acceptance of the updated Terms.</p>
        </section>

        <section class="card">
            <h2>16. Contact</h2>
            <p>If you have questions about these Terms, contact us:</p>
            <address>
                <p><strong>Zonely</strong><br />Dhaka, Bangladesh</p>
                <p>Email: <a href="mailto:norozzaman996@gmail.com">norozzaman996@gmail.com</a><br />
                    WhatsApp: <a href="https://wa.me/8801826192179" rel="noopener">+8801826192179</a></p>
            </address>
        </section>

        <section class="card">
            <h2>17. Miscellaneous</h2>
            <p>If any provision of these Terms is held invalid, the remaining provisions will continue in full force. These
                Terms constitute the entire agreement between you and Zonely regarding the Service.</p>
        </section>

    </main>
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

        .card {
            background: var(--card);
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1rem;
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
    "name": "Terms and Conditions",
    "url": "https://thezonely.com/terms-and-condition",
    "dateModified": "2025-09-05",
    "about": { "@type": "Organization", "name": "Zonely" }
  }
  </script>
@endsection
