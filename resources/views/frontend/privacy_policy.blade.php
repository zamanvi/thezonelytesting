@extends('frontend.layouts._app')
@section('title', 'Privacy Policy')
@section('content')
    {{-- Hero --}}
    <section class="max-w-3xl mx-auto px-4 sm:px-6 pt-28 pb-8 text-center">
        <span class="text-teal-700 text-[11px] font-black uppercase tracking-widest mb-3 block">Legal</span>
        <h1 class="font-serif text-4xl sm:text-5xl text-slate-900 leading-tight mb-3">
            Privacy <em class="text-teal-700 font-normal italic">Policy</em>
        </h1>
        <p class="text-slate-500 text-sm">Zonely – Discover &amp; Hire Local Experts Near Me.</p>
        <p class="text-slate-400 text-xs mt-1">Last updated: <time datetime="2026-03-30">March 30, 2026</time></p>
    </section>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 pb-16 space-y-4">

        <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8">
            <h2 class="text-lg font-bold text-slate-900 mb-3">1. Introduction</h2>
            <p class="text-slate-600 leading-relaxed">
                At Zonely ("we," "our," "us"), we are committed to protecting the privacy of both our Service Sellers (SMEs,
                professionals, and businesses) and Service Buyers (customers looking for services). This Privacy Policy
                explains how we collect, use, and safeguard your data across our SaaS platform, landing pages, and messaging
                tools.
            </p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">2. Information We Collect</h2>

            <ul class="list-disc pl-5 text-slate-600 leading-relaxed space-y-2">
                <li><strong>For Service Sellers:</strong> Business name, owner name, professional certifications, business
                    address, phone number, and payment/billing details.</li>
                <li><strong>For Service Buyers:</strong> Name, contact information, location data (to find "near me"
                    services), and specific service requirements.</li>
                <li><strong>Shared Data:</strong> Messaging history, booking timestamps, call logs, and IP addresses used to
                    access the platform.</li>
            </ul>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">3. How We Use Your Information</h2>

            <ul class="list-disc pl-5 text-slate-600 leading-relaxed space-y-2">
                <li><strong>Connecting Users:</strong> We use data to facilitate the "Search → Discover → Hire" workflow
                    between buyers and sellers.</li>
                <li><strong>Lead Verification:</strong> To track and verify leads for our Pay-Per-Lead and Commission
                    models.</li>
                <li><strong>Platform Integrity:</strong> To monitor "Live 3-Way Calls" and messaging to ensure high-quality
                    service and prevent fraud.</li>
                <li><strong>Analytics:</strong> To help Sellers see their "Premium Dashboard" stats (visitor counts and
                    inquiry rates).</li>
            </ul>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">4. Sharing of Information</h2>
            <p class="text-slate-600 leading-relaxed">We do not sell your data. We share information only to make the
                service work:</p>
            <ul class="list-disc pl-5 text-slate-600 leading-relaxed space-y-2">
                <li><strong>Between Users:</strong> We share Buyer contact info with the chosen Seller to complete a
                    booking.</li>
                <li><strong>Service Providers:</strong> Data is shared with secure hosting (Cloud), payment processors
                    (Stripe/PayPal), and VoIP providers for call tracking.</li>
                <li><strong>Legal Compliance:</strong> We share data if required by law or to protect the safety of our
                    community.</li>
            </ul>
        </section>

        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">5. Data Security</h2>
            <p class="text-slate-600 leading-relaxed">
                Zonely employs industry-standard encryption (SSL/TLS) and secure server protocols. We use Lead Verification
                technology to ensure that Sellers only receive legitimate inquiries and that Buyers’ private contact details
                are handled according to strict access controls.</p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">6. Your Rights</h2>
            <p class="text-slate-600 leading-relaxed">Depending on your location, you may have the right to:</p>
            <ul class="list-disc pl-5 text-slate-600 leading-relaxed space-y-2">
                Regardless of whether you are a Seller or a Buyer, you have the right to:
                <li><strong>Access & Rectify:</strong> Update your profile or business details anytime.</li>
                <li><strong>Erasure:</strong> Request the deletion of your account and historical data.</li>
                <li><strong>Portability:</strong> Request a copy of your data in a machine-readable format.</li>
                <li><strong>Withdraw Consent:</strong> Opt-out of lead tracking or marketing at any time.</li>
            </ul>
            <p class="text-slate-600 leading-relaxed">To exercise your rights, contact us at <a
                    href="mailto:contact@zonelyleads.com">contact@zonelyleads.com</a>.
            </p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">7. Cookies &amp; Tracking</h2>
            <p class="text-slate-600 leading-relaxed">We use cookies to remember your "Near Me" location preferences and to
                track the performance of Seller landing pages. This helps us calculate ROI for Sellers and provides a faster
                booking experience for Buyers. You can manage these via your browser settings.</p>
        </section>
        <section class="mb-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">8. Third-Party Links</h2>
            <p class="text-slate-600 leading-relaxed">Zonely landing pages may link to a Seller’s social media or external
                tools. We are not responsible for the privacy practices of these external sites. We recommend reviewing the
                policies of any third-party service you interact with through our platform.</p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">9. Children’s Privacy</h2>
            <p class="text-slate-600 leading-relaxed">Zonely is a professional service marketplace intended for adults
                (18+). We do not knowingly collect information from individuals under the age of 13. If we discover such
                data has been collected, it will be deleted immediately.</p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">10. Updates to This Policy</h2>
            <p class="text-slate-600 leading-relaxed">As Zonely evolves (such as our 2027 shift to a Commission Model), we
                may update this policy. We will notify active users via email or a dashboard notification. Continued use of
                the platform constitutes acceptance of the updated terms.</p>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">11. Contact Us</h2>
            For any privacy-related inquiries or to exercise your data rights, please contact our support team:
            <address class="text-slate-600 leading-relaxed mt-3 not-italic">
                <p>Support Email: <a href="mailto:contact@zonelyleads.com" class="text-teal-700 hover:underline">contact@zonelyleads.com</a></p>
            </address>
        </section>
        <section class="mt-2 bg-white rounded-[2rem] p-10 border border-slate-100 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-3">12. Jurisdiction & Compliance Note</h2>
            <p class="text-slate-600 leading-relaxed">Zonely operates globally. While our headquarters are in Dhaka, we comply with international standards for our users in the USA, Canada, and Singapore.</p>
            <ul class="list-disc pl-5 text-slate-600 leading-relaxed space-y-2">
                <li><strong>US/Canada:</strong> We follow "No-Call" list regulations for our call-tracking features.</li>
                <li><strong>EU/UK:</strong> We treat all user data with GDPR-level care, utilizing "Standard Contractual Clauses" for data transfers.</li>
                <li><strong>Transparency:</strong> We explicitly state that we only use publicly available info from Google Business Listings to create initial demo pages.</li>
            </ul>
        </section>
    </main>
@endsection
