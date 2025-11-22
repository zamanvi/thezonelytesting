@extends('frontend.layouts._app')
@section('title', 'NYC Car Insurance Calculator')
@php
    $meta_title = $meta_title;
    $meta_description = $meta_description;
    $meta_keywords = $meta_keywords;
@endphp
@section('content')
    <div class="card">
        <div>
            <header>
                <!-- developer-provided screenshot used as header image -->
                <img class="logo" alt="screenshot" src="{{ asset('frontend/img/favicon.png') }}">
                <div>
                    <h1>Free Car Insurance Calculator for NYC, USA</h1>
                    <p class="lead">Use our Free Car Insurance Calculator for NYC, USA to instantly estimate your monthly and yearly auto insurance costs. Compare rates, save money, and get accurate results fast. meta description.</p>
                </div>
            </header>

            <form id="calcForm" onsubmit="event.preventDefault();runCalc();">
                <label for="age">Age</label>
                <input id="age" type="number" min="16" placeholder="Enter your age" required>

                <label for="carValue">Car Value (USD)</label>
                <input id="carValue" type="number" min="0" step="100" placeholder="Example: 20000" required>

                <label for="record">Driving Record</label>
                <select id="record">
                    <option value="clean">Clean Record</option>
                    <option value="1 accident">1 Accident</option>
                    <option value="multiple accidents">Multiple Accidents</option>
                </select>

                <label for="coverage">Coverage Type</label>
                <select id="coverage">
                    <option value="full">Full Coverage</option>
                    <option value="liability">Liability Only</option>
                </select>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Calculate Insurance</button>
                    <button class="btn btn-ghost" type="button" onclick="resetForm()">Reset</button>
                </div>
            </form>
        </div>

        <div class="right">
            <div id="resultCard" class="result-box result-hidden">
                <div>
                    <div class="result-row">
                        <div class="muted">Yearly Premium</div>
                        <div id="yearlyVal" class="big">—</div>
                    </div>
                    <div class="result-row">
                        <div class="muted">Monthly Premium</div>
                        <div id="monthlyVal" class="big">—</div>
                    </div>
                    <div class="result-row">
                        <div class="muted">Breakdown</div>
                        <div id="breakdown" class="muted">—</div>
                    </div>
                </div>

                <div style="margin-top:10px;display:flex;flex-direction:column;gap:8px">
                    <div style="display:flex;gap:8px">
                        <button class="small btn-primary" onclick="savePDF()">Save as PDF</button>
                        <a class="small btn-ghost" href="{{ route('frontend.home') }}">Get Real Insurance Offers</a>
                    </div>
                    <div style="font-size:13px;color:var(--muted);margin-top:10px">This is approximate value only, Not
                        accurate for real quotes.</div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('css')
    <style>
        :root {
            --accent: #007bff;
            --card: #fff;
            --bg: #f4f6f8;
            --muted: #6b7280
        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: Inter, system-ui, -apple-system, Arial, sans-serif;
            background: var(--bg);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh
        }

        .container {
            width: 100%;
        }

        .card {
            background: var(--card);
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 6px 24px rgba(16, 24, 40, 0.08);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 24px;
            align-items: start
        }

        /* responsive */
        @media (max-width:920px) {
            .card {
                grid-template-columns: 1fr;
                padding: 18px
            }

            .right {
                order: 2
            }
        }

        header {
            display: flex;
            gap: 14px;
            align-items: center
        }

        header img.logo {
            width: 84px;
            height: 84px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 6px 18px rgba(12, 18, 36, 0.06)
        }

        h1 {
            font-size: 20px;
            margin: 0
        }

        p.lead {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 13px
        }

        form label {
            display: block;
            font-weight: 600;
            margin-top: 14px;
            font-size: 13px;
            color: #111827
        }

        input,
        select {
            width: 100%;
            padding: 11px 12px;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #e6e9ee;
            font-size: 14px
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px
        }

        .btn {
            flex: 1;
            padding: 11px 14px;
            border-radius: 10px;
            border: none;
            font-weight: 600;
            cursor: pointer
        }

        .btn-primary {
            background: var(--accent);
            color: white;
            box-shadow: 0 6px 18px rgba(0, 123, 255, 0.12);
            transition: transform .12s ease
        }

        .btn-primary:active {
            transform: translateY(1px)
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid #e6e9ee;
            color: #111827
        }

        /* result panel */
        .right {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.8), #fff);
            border-radius: 10px;
            padding: 20px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between
        }

        .result-box {
            border-radius: 8px;
            padding: 14px;
            border: 1px solid #eef2f7;
            background: linear-gradient(180deg, #fbfeff, #fff);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
            transition: transform .18s cubic-bezier(.2, .9, .3, 1), opacity .18s
        }

        .result-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0
        }

        .big {
            font-size: 22px;
            font-weight: 700
        }

        .muted {
            color: var(--muted);
            font-size: 13px
        }

        .save-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px
        }

        .small {
            font-size: 12px;
            padding: 8px 10px;
            border-radius: 8px
        }

        /* subtle animation */
        .result-hidden {
            opacity: 0;
            transform: translateY(8px)
        }

        .result-shown {
            opacity: 1;
            transform: translateY(0)
        }

        footer.note {
            margin-top: 12px;
            color: var(--muted);
            font-size: 12px
        }
    </style>
@endsection
@section('scripts')
    <script>
        // local formula (same as earlier): editable
        function calculateLocal(data) {
            const age = Number(data.age);
            const car_value = Number(data.car_value);
            const driving_record = data.driving_record;
            const coverage = data.coverage;

            let base_rate = 1800;
            let age_factor = 0;
            if (age < 25) age_factor = 700;
            else if (age <= 40) age_factor = 300;
            else age_factor = 200;
            let car_factor = car_value * 0.02;
            let record_factor = 0;
            if (driving_record === '1 accident') record_factor = 500;
            if (driving_record === 'multiple accidents') record_factor = 1200;
            let coverage_factor = coverage === 'full' ? 900 : 300;

            const total = base_rate + age_factor + car_factor + record_factor + coverage_factor;
            const monthly = total / 12;

            return {
                yearly_premium: Math.round(total),
                monthly_premium: Math.round(monthly),
                breakdown: {
                    base_rate,
                    age_factor,
                    car_factor: Math.round(car_factor),
                    record_factor,
                    coverage_factor
                }
            };
        }

        // UI helpers
        function showResult(obj) {
            document.getElementById('yearlyVal').textContent = '$' + obj.yearly_premium;
            document.getElementById('monthlyVal').textContent = '$' + obj.monthly_premium;
            const b = obj.breakdown;
            document.getElementById('breakdown').textContent =
                `base:${b.base_rate} | age:${b.age_factor} | car:${b.car_factor} | rec:${b.record_factor} | cov:${b.coverage_factor}`;

            const card = document.getElementById('resultCard');
            card.classList.remove('result-hidden');
            card.classList.add('result-shown');
        }

        function runCalc() {
            const data = {
                age: document.getElementById('age').value || 0,
                car_value: document.getElementById('carValue').value || 0,
                driving_record: document.getElementById('record').value,
                coverage: document.getElementById('coverage').value
            };

            const result = calculateLocal(data);
            // show local estimate instantly
            showResult(result);

            // store last result for other actions
            window.__LAST_QUOTE = {
                input: data,
                result
            };
        }

        function resetForm() {
            document.getElementById('calcForm').reset();
            const card = document.getElementById('resultCard');
            card.classList.remove('result-shown');
            card.classList.add('result-hidden');
            window.__LAST_QUOTE = null;
        }

        // Save as PDF (simple print preview)
        function savePDF() {
            window.print();
        }

        // Email quote using mailto (prefills client mail)
        function emailQuote() {
            const last = window.__LAST_QUOTE;
            if (!last) {
                alert('Please calculate a quote first.');
                return
            }
            const subject = encodeURIComponent('NYC Car Insurance Quote');
            const bodyLines = [];
            bodyLines.push('Here is my NYC insurance quote:');
            bodyLines.push('');
            bodyLines.push('Inputs:');
            bodyLines.push(JSON.stringify(last.input, null, 2));
            bodyLines.push('');
            bodyLines.push('Estimate:');
            bodyLines.push(JSON.stringify(last.result, null, 2));
            bodyLines.push('');
            bodyLines.push('Screenshot: /mnt/data/b4c09eb1-d52d-4024-a2d2-024b732f0f55.png');
            const body = encodeURIComponent(bodyLines.join('\n'));
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
        }

        // Download JSON file
        function downloadJSON() {
            const last = window.__LAST_QUOTE;
            if (!last) {
                alert('Please calculate a quote first.');
                return
            }
            const blob = new Blob([JSON.stringify(last, null, 2)], {
                type: 'application/json'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'nyc-insurance-quote.json';
            document.body.appendChild(a);
            a.click();
            a.remove();
            URL.revokeObjectURL(url);
        }

        function copyToClipboard() {
            const last = window.__LAST_QUOTE;
            if (!last) {
                alert('Please calculate a quote first.');
                return
            }
            navigator.clipboard.writeText(JSON.stringify(last, null, 2)).then(() => alert('Quote copied to clipboard'));
        }

        // Example: connect to your backend calculate endpoint
        async function getOffers() {
            const last = window.__LAST_QUOTE;
            if (!last) {
                alert('Please calculate a quote first.');
                return
            }

            // Replace this URL with your real backend endpoint (Node.js / Express / FastAPI etc.)
            const endpoint = '/calculate';

            try {
                // show a quick loading state
                const btn = event && event.target;
                if (btn) btn.textContent = 'Loading...';
                const resp = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(last.input)
                });

                if (!resp.ok) throw new Error('Bad response from server');
                const offers = await resp.json();

                // Example: if backend returns an array of offers, show the best one in UI (this is flexible)
                if (Array.isArray(offers) && offers.length) {
                    const best = offers[0];
                    alert('Received offers from backend. First offer yearly: $' + (best.yearly_premium || best.price ||
                        'N/A'));
                } else {
                    alert('Backend returned: ' + JSON.stringify(offers));
                }
            } catch (err) {
                console.error(err);
                alert('Failed to fetch offers. Make sure your backend is running and the endpoint is correct.');
            } finally {
                if (event && event.target) event.target.textContent = 'Get Real Insurance Offers';
            }
        }

        // On-load: small animation for card
        window.addEventListener('load', () => {
            setTimeout(() => {
                const c = document.querySelector('.card');
                c.style.transform = 'translateY(-4px)';
                c.style.transition = 'transform .28s ease';
            }, 80);
        });
    </script>
@endsection
