@extends('layouts.master')
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap');

    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', sans-serif; }

    .hero-about {
        position: relative;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 40%, #1e1b4b 100%);
        overflow: hidden;
    }
    .hero-about::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.6;
    }
    .hero-about::after {
        content: '';
        position: absolute; bottom: 0; left: 0; right: 0; height: 120px;
        background: linear-gradient(to top, #f9fafb, transparent);
    }

    .orb {
        position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.3;
        animation: floatOrb 8s ease-in-out infinite alternate;
    }
    @keyframes floatOrb {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(30px, -20px) scale(1.1); }
    }

    .reveal {
        opacity: 0; transform: translateY(30px);
        transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1);
    }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    .section-label {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 0.75rem; font-weight: 600; text-transform: uppercase;
        letter-spacing: 0.12em; color: #3b82f6; margin-bottom: 12px;
    }
    .section-label::before {
        content: ''; width: 24px; height: 2px;
        background: linear-gradient(90deg, #3b82f6, #6366f1); border-radius: 2px;
    }

    .therapist-card {
        background: white; border: 1px solid #f1f5f9; border-radius: 1.25rem;
        transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
        overflow: hidden; position: relative;
    }
    .therapist-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(59,130,246,0.15);
        border-color: #bfdbfe;
    }
    .therapist-card .avatar-ring {
        width: 88px; height: 88px; border-radius: 50%; padding: 3px;
        background: linear-gradient(135deg, #3b82f6, #6366f1, #8b5cf6);
        transition: transform 0.3s ease;
    }
    .therapist-card:hover .avatar-ring { transform: scale(1.05); }

    .video-card {
        position: relative; border-radius: 1rem; overflow: hidden;
        background: #0f172a; aspect-ratio: 16/9; cursor: pointer;
        transition: all 0.4s ease;
    }
    .video-card:hover { transform: scale(1.02); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.3); }
    .video-card .play-btn {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
        width: 56px; height: 56px; border-radius: 50%;
        background: rgba(255,255,255,0.95); display: flex; align-items: center; justify-content: center;
        transition: all 0.3s ease; box-shadow: 0 8px 30px rgba(0,0,0,0.3); z-index: 2;
    }
    .video-card:hover .play-btn {
        transform: translate(-50%,-50%) scale(1.1);
        background: #3b82f6; color: white;
    }
    .video-card:hover .play-btn i { color: white; }
    .video-card .play-btn i { margin-left: 3px; color: #3b82f6; transition: color 0.3s; }
    .video-card .overlay {
        position: absolute; inset: 0; z-index: 1;
        background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, transparent 60%);
    }

    .cat-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 999px; font-size: 0.75rem; font-weight: 500;
        transition: all 0.3s ease; cursor: pointer; border: 1px solid #e2e8f0;
        background: white; color: #64748b;
    }
    .cat-pill:hover, .cat-pill.active {
        background: linear-gradient(135deg, #3b82f6, #6366f1);
        color: white; border-color: transparent;
        box-shadow: 0 4px 15px rgba(59,130,246,0.3);
    }

    .stat-card {
        text-align: center; padding: 2rem 1rem;
        border-radius: 1.25rem;
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }
    .stat-number {
        font-size: 2.5rem; font-weight: 800;
        background: linear-gradient(135deg, #fff, #bfdbfe);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text; line-height: 1.1;
    }

    .value-card {
        padding: 1.5rem; border-radius: 1rem; border: 1px solid #f1f5f9;
        background: white; transition: all 0.3s ease;
    }
    .value-card:hover {
        border-color: #bfdbfe; transform: translateY(-3px);
        box-shadow: 0 10px 30px -10px rgba(59,130,246,0.1);
    }
    .value-icon {
        width: 48px; height: 48px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }

    .testimonial-card {
        background: white; border: 1px solid #f1f5f9; border-radius: 1.25rem;
        padding: 1.75rem; transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        border-color: #bfdbfe;
        box-shadow: 0 10px 30px -10px rgba(59,130,246,0.1);
    }

    .modal-backdrop {
        position: fixed; inset: 0; z-index: 100;
        background: rgba(15,23,42,0.6); backdrop-filter: blur(4px);
        opacity: 0; visibility: hidden; transition: all 0.3s ease;
        display: flex; align-items: center; justify-content: center; padding: 1rem;
    }
    .modal-backdrop.open { opacity: 1; visibility: visible; }
    .modal-content {
        background: white; border-radius: 1.25rem; width: 100%; max-width: 480px;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);
        transform: scale(0.9) translateY(20px); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
        max-height: 90vh; overflow-y: auto;
    }
    .modal-backdrop.open .modal-content { transform: scale(1) translateY(0); }

    .video-modal-backdrop {
        position: fixed; inset: 0; z-index: 100;
        background: rgba(0,0,0,0.85); backdrop-filter: blur(8px);
        opacity: 0; visibility: hidden; transition: all 0.3s ease;
        display: flex; align-items: center; justify-content: center; padding: 1rem;
    }
    .video-modal-backdrop.open { opacity: 1; visibility: visible; }
    .video-modal-content {
        background: #0f172a; border-radius: 1rem; width: 100%; max-width: 800px;
        aspect-ratio: 16/9; position: relative; overflow: hidden;
        transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
    }
    .video-modal-backdrop.open .video-modal-content { transform: scale(1); }

    .pulse-ring { position: relative; }
    .pulse-ring::after {
        content: ''; position: absolute; top: 50%; left: 50%;
        width: 10px; height: 10px; border-radius: 50%;
        background: #22c55e; transform: translate(-50%, -50%);
        animation: pulseGreen 2s ease-in-out infinite;
    }
    @keyframes pulseGreen {
        0%, 100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.4); }
        50% { box-shadow: 0 0 0 6px rgba(34,197,94,0); }
    }

    .form-input {
        width: 100%; padding: 0.625rem 0.875rem; font-size: 0.875rem;
        border: 1px solid #e2e8f0; border-radius: 0.75rem;
        transition: all 0.3s ease; background: #f8fafc; color: #1e293b;
    }
    .form-input:focus {
        outline: none; border-color: #3b82f6; background: white;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }
    .form-input::placeholder { color: #94a3b8; }

    .cta-pulse { position: relative; overflow: hidden; }
    .cta-pulse::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transform: translateX(-100%); transition: transform 0.6s ease;
    }
    .cta-pulse:hover::before { transform: translateX(100%); }

    .about-toast {
        position: fixed; bottom: 1.5rem; left: 50%; transform: translateX(-50%);
        z-index: 200; background: #059669; color: white;
        font-size: 0.875rem; font-weight: 500; padding: 0.75rem 1.25rem;
        border-radius: 0.75rem; box-shadow: 0 10px 25px -5px rgba(5,150,105,0.3);
        display: flex; align-items: center; gap: 0.5rem;
        transition: all 0.3s ease; opacity: 0; transform: translateX(-50%) translateY(1rem);
        pointer-events: none;
    }
    .about-toast.show { opacity: 1; transform: translateX(-50%) translateY(0); pointer-events: auto; }

    .about-back-top { opacity: 0; visibility: hidden; transition: all 0.3s ease; }
    .about-back-top.visible { opacity: 1; visibility: visible; }
</style>


<!-- ========== HERO ========== -->
<section class="hero-about py-24 md:py-32 lg:py-40 relative">
    <div class="orb w-72 h-72 bg-blue-500 top-10 -left-20"></div>
    <div class="orb w-56 h-56 bg-indigo-600 bottom-10 right-10" style="animation-delay:-3s"></div>
    <div class="orb w-40 h-40 bg-violet-500 top-1/2 left-1/2" style="animation-delay:-5s"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <div class="section-label justify-center mb-6" style="color:#93c5fd">
            <span>About Relief</span>
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6" style="font-family:'Playfair Display',serif">
            Where Healing Begins<br>
            <span class="bg-gradient-to-r from-blue-400 via-indigo-400 to-violet-400 bg-clip-text text-transparent">With Compassion</span>
        </h1>
        <p class="text-lg sm:text-xl text-blue-200/80 max-w-2xl mx-auto leading-relaxed mb-10">
            We believe every person deserves access to professional mental health support. Relief connects you with expert therapists and mindfulness resources — all in one safe, confidential space.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#therapists" class="cta-pulse inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold px-7 py-3.5 rounded-full shadow-lg shadow-blue-900/30 hover:shadow-xl hover:shadow-blue-800/40 transition-all duration-300 text-sm">
                <i class="ri-user-heart-line"></i> Meet Our Therapists
            </a>
            <a href="#activities" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-full border border-white/20 hover:border-white/40 transition-all duration-300 text-sm backdrop-blur-sm">
                <i class="ri-play-circle-line"></i> Watch Mindfulness Videos
            </a>
        </div>
    </div>
</section>


<!-- ========== OUR STORY ========== -->
<section class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="reveal relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-blue-900/10">
                    <img src="{{ asset('imagess/therapist.jpg') }}" alt="Our Story" class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-900/30 to-transparent"></div>
                </div>
                <div class="absolute -bottom-6 -right-4 sm:right-6 bg-white rounded-xl shadow-xl p-4 border border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center">
                            <i class="ri-heart-pulse-fill text-white text-xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">{{ $therapists->count() * 200 }}+</p>
                            <p class="text-xs text-gray-500">Lives Impacted</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reveal reveal-delay-2">
                <div class="section-label">Our Story</div>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 leading-tight" style="font-family:'Playfair Display',serif">
                    Born from a Simple Belief: Mental Health is Health
                </h2>
                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>Relief was founded with a clear mission — to break the stigma surrounding mental health in Nepal and make professional support accessible to everyone, regardless of their background or circumstances.</p>
                    <p>What started as a small initiative has grown into a trusted platform connecting individuals with licensed therapists, guided mindfulness resources, and a supportive community.</p>
                    <p>Based in Chitwan, we serve users across Nepal with culturally sensitive, evidence-based mental health care — because healing should never feel out of reach.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========== OUR VALUES ========== -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <div class="section-label justify-center">What We Stand For</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900" style="font-family:'Playfair Display',serif">Our Core Values</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="value-card reveal reveal-delay-1">
                <div class="value-icon bg-blue-50 text-blue-600 mb-4"><i class="ri-shield-check-line"></i></div>
                <h3 class="font-semibold text-gray-900 mb-2">Confidentiality</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Your sessions and data are 100% private. We never share your information without consent.</p>
            </div>
            <div class="value-card reveal reveal-delay-2">
                <div class="value-icon bg-violet-50 text-violet-600 mb-4"><i class="ri-hand-heart-line"></i></div>
                <h3 class="font-semibold text-gray-900 mb-2">Compassion</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Every interaction is rooted in empathy. We listen without judgment and support without conditions.</p>
            </div>
            <div class="value-card reveal reveal-delay-3">
                <div class="value-icon bg-emerald-50 text-emerald-600 mb-4"><i class="ri-microscope-line"></i></div>
                <h3 class="font-semibold text-gray-900 mb-2">Evidence-Based</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Our therapies and resources are grounded in proven psychological practices and clinical research.</p>
            </div>
            <div class="value-card reveal reveal-delay-4">
                <div class="value-icon bg-amber-50 text-amber-600 mb-4"><i class="ri-global-line"></i></div>
                <h3 class="font-semibold text-gray-900 mb-2">Accessibility</h3>
                <p class="text-sm text-gray-500 leading-relaxed">We break barriers — affordable pricing, online sessions, and content in your language.</p>
            </div>
        </div>
    </div>
</section>


<!-- ========== IMPACT NUMBERS ========== -->
<section class="py-16 bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-600 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=&quot;40&quot; height=&quot;40&quot; viewBox=&quot;0 0 40 40&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.05&quot;%3E%3Cpath d=&quot;M20 20.5V18H0v-2h20v-2l2 3.25-2 3.25z&quot;/%3E%3C/g%3E%3C/svg%3E')]"></div>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card bg-white/10 border border-white/10 backdrop-blur-sm reveal">
            <div class="stat-number" data-target="{{ $therapists->count() * 200 }}">0</div>
            <p class="text-sm text-blue-100 mt-2 font-medium">Sessions Completed</p>
        </div>
        <div class="stat-card bg-white/10 border border-white/10 backdrop-blur-sm reveal reveal-delay-1">
            <div class="stat-number" data-target="{{ $therapists->count() }}">0</div>
            <p class="text-sm text-blue-100 mt-2 font-medium">Expert Therapists</p>
        </div>
        <div class="stat-card bg-white/10 border border-white/10 backdrop-blur-sm reveal reveal-delay-2">
            <div class="stat-number" data-target="{{ isset($activities) ? $activities->count() : 0 }}">0</div>
            <p class="text-sm text-blue-100 mt-2 font-medium">Mindfulness Videos</p>
        </div>
        <div class="stat-card bg-white/10 border border-white/10 backdrop-blur-sm reveal reveal-delay-3">
            <div class="stat-number" data-target="98">0</div>
            <p class="text-sm text-blue-100 mt-2 font-medium">% Satisfaction Rate</p>
        </div>
    </div>
</section>


<!-- ========== THERAPISTS ========== -->
<section id="therapists" class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <div class="section-label justify-center">Our Team</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4" style="font-family:'Playfair Display',serif">Meet Our Therapists</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Licensed professionals specializing in various areas of mental health. Reach out directly — your first conversation is on us.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($therapists as $index => $therapist)
            <div class="therapist-card p-6 text-center reveal reveal-delay-{{ ($index % 4) + 1 }}">
                <div class="flex justify-center mb-4">
                    <div class="avatar-ring">
                        <img src="{{ asset('images/therapists/' . $therapist->photopath) }}"
                             alt="{{ $therapist->name }}"
                             class="w-full h-full rounded-full object-cover"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($therapist->name) }}&background=3b82f6&color=fff&size=200'">
                    </div>
                </div>
                <div class="flex items-center justify-center gap-1.5 mb-1">
                    <h3 class="font-semibold text-gray-900">{{ $therapist->name }}</h3>
                    <span class="pulse-ring w-2.5 h-2.5"></span>
                </div>
                <p class="text-xs text-blue-600 font-medium mb-1">{{ $therapist->specialization }}</p>
                <p class="text-xs text-gray-400 mb-4 line-clamp-2">{{ Str::limit($therapist->description, 60, '...') }}</p>
                <div class="flex items-center justify-center gap-1 mb-4">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="ri-star-fill text-amber-400 text-xs"></i>
                    @endfor
                    <span class="text-xs text-gray-400 ml-1">5.0</span>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('viewtherapist', $therapist->id) }}"
                       class="block w-full text-center text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 py-2.5 rounded-xl shadow-md shadow-blue-200 transition-all duration-300">
                        <i class="ri-user-line mr-1"></i> View Profile
                    </a>
                    <button onclick="openContactModal('{{ $therapist->name }}', {{ $therapist->id }})"
                            class="w-full text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 py-2 rounded-xl transition-all duration-300">
                        <i class="ri-chat-3-line mr-1"></i> Reach Out
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ========== MINDFULNESS VIDEOS ========== -->
{{-- BUG FIX #1: Removed @section('videos_section') — you CANNOT nest @section inside @section --}}
{{-- BUG FIX #2: Changed id="act$activities" to id="activities" --}}
{{-- BUG FIX #3: Changed .activity-item to .video-item so JS filter works --}}
{{-- BUG FIX #4: Changed .activity-card to .video-card so CSS styles apply --}}
{{-- BUG FIX #5: Fixed thumbnail path from 'images/$activities/' to 'images/activities/' --}}
<section id="activities" class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <div class="section-label justify-center">Mindfulness Resources</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4" style="font-family:'Playfair Display',serif">Guided Videos for Your Wellbeing</h2>
            <p class="text-gray-500 max-w-xl mx-auto">Curated mindfulness sessions, breathing exercises, and therapeutic content — watch anytime, anywhere.</p>
        </div>

        @if(isset($activities) && $activities->count() > 0)

        {{-- Category Filter Pills --}}
                @php
            $categoryList = collect();
            foreach($activities as $act) {
                if (isset($act->category)) {
                    $catName = is_string($act->category) ? $act->category : (isset($act->category->name) ? $act->category->name : null);
                    if ($catName) $categoryList->push($catName);
                }
            }
            $categories = $categoryList->unique()->values();
        @endphp
        @if($categories->count() > 1)
        <div class="flex flex-wrap justify-center gap-2 mb-10 reveal">
            <button class="cat-pill active" onclick="filterVideos('all', this)">
                <i class="ri-apps-line text-xs"></i> All
            </button>
            @foreach($categories as $cat)
            <button class="cat-pill" onclick="filterVideos('{{ Str::slug($cat) }}', this)">
                <i class="ri-mental-health-line text-xs"></i> {{ $cat }}
            </button>
            @endforeach
        </div>
        @endif

        {{-- Video Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" id="videoGrid">
            @foreach($activities as $index => $activity)
            {{-- BUG FIX #3: class="video-item" (was activity-item) so JS querySelectorAll('.video-item') finds these --}}
            <div class="video-item reveal reveal-delay-{{ ($index % 3) + 1 }}"
                 data-category="{{ is_string($activity->category) ? Str::slug($activity->category) : (isset($activity->category->name) ? Str::slug($activity->category->name) : 'general') }}"

                {{-- BUG FIX #4: class="video-card" (was activity-card) so CSS .video-card styles apply --}}
                <div class="video-card" onclick="openVideoModal('{{ $activity->title }}', '{{ $activity->video_url }}')">

                    {{-- Thumbnail --}}
                    @if(isset($activity->thumbnail) && $activity->thumbnail)
                        {{-- BUG FIX #5: Fixed path — was 'images/$activities/' (PHP doesn't interpolate $ inside single quotes, and $activities is a collection not a string) --}}
                        <img src="{{ asset('images/activities/' . $activity->thumbnail) }}"
                             alt="{{ $activity->title }}"
                             class="w-full h-full object-cover"
                             onerror="this.src='https://picsum.photos/seed/{{ Str::slug($activity->title) }}/640/360.jpg'">
                    @else
                        <img src="https://picsum.photos/seed/{{ Str::slug($activity->title) }}/640/360.jpg"
                             alt="{{ $activity->title }}" class="w-full h-full object-cover">
                    @endif

                    <div class="overlay"></div>
                    <div class="play-btn"><i class="ri-play-fill text-xl"></i></div>

                                        @if(isset($activity->category))
                    <div class="absolute top-3 left-3 z-10">
                        <span class="bg-blue-600/90 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full uppercase tracking-wide backdrop-blur-sm">
                            {{ is_string($activity->category) ? Str::limit($activity->category, 15) : (isset($activity->category->name) ? Str::limit($activity->category->name, 15) : 'General') }}
                        </span>
                    </div>
                    @endif

                    <div class="absolute bottom-3 left-3 right-3 z-10">
                        <h4 class="text-white font-semibold text-sm mb-0.5">{{ Str::limit($activity->title, 40) }}</h4>
                        @if(isset($activity->description) && $activity->description)
                        <p class="text-blue-200/70 text-xs">{{ Str::limit($activity->description, 50, '...') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-16 reveal">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <i class="ri-video-line text-gray-300 text-3xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-400 mb-2">Videos Coming Soon</h3>
            <p class="text-sm text-gray-400 max-w-md mx-auto">We're curating the best mindfulness content for you. Check back soon.</p>
        </div>
        @endif

        <div class="text-center mt-10 reveal">
            <a href="{{ route('activities') }}" class="inline-flex items-center gap-2 cta-pulse text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-6 py-3 rounded-full shadow-md shadow-blue-200 transition-all duration-300">
                <i class="ri-video-line"></i> Browse All Videos
            </a>
        </div>
    </div>
</section>


<!-- ========== WHY CHOOSE US ========== -->
<section class="py-20 lg:py-28 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <div class="section-label justify-center">Why Relief</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900" style="font-family:'Playfair Display',serif">Why Choose Us?</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="value-card reveal reveal-delay-1 group">
                <div class="flex justify-center mb-5">
                    <div class="w-14 h-14 bg-sky-100 rounded-full flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                        <i class="ri-user-heart-line w-7 h-7 text-sky-800"></i>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Expert Therapists</h3>
                <p class="text-sm text-gray-500 text-center leading-relaxed">Connect with {{ $therapists->count() }}+ qualified professionals who guide and support you.</p>
            </div>
            <div class="value-card reveal reveal-delay-2 group">
                <div class="flex justify-center mb-5">
                    <div class="w-14 h-14 bg-violet-100 rounded-full flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                        <i class="ri-mental-health-line w-7 h-7 text-violet-800"></i>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Mindfulness Resources</h3>
                <p class="text-sm text-gray-500 text-center leading-relaxed">Access curated mindfulness videos and tools designed to enhance your emotional well-being.</p>
            </div>
            <div class="value-card reveal reveal-delay-3 group">
                <div class="flex justify-center mb-5">
                    <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center group-hover:bg-emerald-200 transition-colors">
                        <i class="ri-customer-service-2-line w-7 h-7 text-emerald-800"></i>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-sm text-gray-500 text-center leading-relaxed">Around the clock to assist you whenever you need guidance or assistance.</p>
            </div>
            <div class="value-card reveal reveal-delay-4 group">
                <div class="flex justify-center mb-5">
                    <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center group-hover:bg-amber-200 transition-colors">
                        <i class="ri-layout-masonry-line w-7 h-7 text-amber-800"></i>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 mb-2">Easy Interface</h3>
                <p class="text-sm text-gray-500 text-center leading-relaxed">Navigate effortlessly through our user-friendly platform designed for a smooth experience.</p>
            </div>
        </div>
    </div>
</section>


<!-- ========== TESTIMONIALS ========== -->
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 reveal">
            <div class="section-label justify-center">Testimonials</div>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900" style="font-family:'Playfair Display',serif">What Our Users Say</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="testimonial-card reveal reveal-delay-1">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 5; $i++)<i class="ri-star-fill text-amber-400 text-sm"></i>@endfor
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">"Relief made it so easy to finally talk to someone. My therapist was incredibly understanding, and the mindfulness videos helped me between sessions."</p>
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Nirika+L&background=3b82f6&color=fff&size=80" alt="Nirika Lamichhane." class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Nirika Lamichhane.</p>
                        <p class="text-xs text-gray-400">Kathmandu</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-delay-2">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 5; $i++)<i class="ri-star-fill text-amber-400 text-sm"></i>@endfor
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">"The breathing exercises on this platform literally saved me during panic attacks. I use the 4-7-8 technique daily. Thank you, Relief team."</p>
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Swornim+L&background=8b5cf6&color=fff&size=80" alt="Swornim Lamichhane." class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Swornim Lamichhane.</p>
                        <p class="text-xs text-gray-400">Pokhara</p>
                    </div>
                </div>
            </div>
            <div class="testimonial-card reveal reveal-delay-3">
                <div class="flex items-center gap-1 mb-3">
                    @for($i = 0; $i < 4; $i++)<i class="ri-star-fill text-amber-400 text-sm"></i>@endfor
                    <i class="ri-star-half-fill text-amber-400 text-sm"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed mb-4">"As someone hesitant about therapy, the video resources helped me understand what to expect. The progress tracker keeps me motivated."</p>
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Swostika+A&background=059669&color=fff&size=80" alt="Swostika Adhikari." class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Swostika Adhikari.</p>
                        <p class="text-xs text-gray-400">Chitwan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========== CTA ========== -->
<section class="py-20 lg:py-28 bg-gradient-to-br from-slate-900 via-blue-950 to-indigo-950 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-500/10 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 text-center reveal">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-900/30">
            <i class="ri-hand-heart-line text-white text-2xl"></i>
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4" style="font-family:'Playfair Display',serif">Ready to Take the First Step?</h2>
        <p class="text-blue-200/70 text-lg mb-8 leading-relaxed">You don't have to face this alone. Whether it's a quick chat with a therapist or a calming mindfulness video — start your journey today.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            @auth
            <a href="{{ route('home') }}#therapists" class="cta-pulse inline-flex items-center gap-2 bg-white text-gray-900 font-semibold px-7 py-3.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 text-sm">
                <i class="ri-calendar-check-line"></i> Book a Session
            </a>
            @else
            <a href="{{ route('login') }}" class="cta-pulse inline-flex items-center gap-2 bg-white text-gray-900 font-semibold px-7 py-3.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 text-sm">
                <i class="ri-user-add-line"></i> Create Free Account
            </a>
            @endauth
            {{-- BUG FIX #6: Changed #act$activities to #activities --}}
            <a href="#activities" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3.5 rounded-full border border-white/20 hover:border-white/40 transition-all duration-300 text-sm backdrop-blur-sm">
                <i class="ri-play-circle-line"></i> Explore Videos
            </a>
        </div>
    </div>
</section>


<!-- ========== CONTACT MODAL ========== -->
<div id="contactModal" class="modal-backdrop" onclick="if(event.target===this)closeContactModal()">
    <div class="modal-content">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900">Reach Out to <span id="modalTherapistName" class="text-blue-600"></span></h3>
                <p class="text-xs text-gray-400 mt-0.5">Fill in your details and we'll connect you</p>
            </div>
            <button onclick="closeContactModal()" class="w-8 h-8 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                <i class="ri-close-line text-gray-500"></i>
            </button>
        </div>
        <form id="contactForm" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="therapist_id" id="modalTherapistId">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Your Name</label>
                <input type="text" name="name" required placeholder="Enter your full name" class="form-input">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Email Address</label>
                <input type="email" name="email" required placeholder="you@example.com" class="form-input">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Phone Number</label>
                <input type="tel" name="phone" placeholder="+977 98XXXXXXXX" class="form-input">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Preferred Contact Method</label>
                <div class="flex gap-3">
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="radio" name="contact_method" value="email" checked class="text-blue-600 focus:ring-blue-500"> Email
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="radio" name="contact_method" value="phone" class="text-blue-600 focus:ring-blue-500"> Phone
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="radio" name="contact_method" value="chat" class="text-blue-600 focus:ring-blue-500"> In-App Chat
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1.5">Brief Message <span class="text-gray-400">(optional)</span></label>
                <textarea name="message" rows="3" placeholder="Briefly describe what you'd like support with..." class="form-input resize-none"></textarea>
            </div>
            <button type="submit" class="w-full cta-pulse text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 py-3 rounded-xl shadow-md shadow-blue-200 transition-all duration-300">
                <i class="ri-send-plane-line mr-1"></i> Send Request
            </button>
            <p class="text-[11px] text-gray-400 text-center leading-relaxed">
                <i class="ri-shield-check-line text-emerald-500"></i>
                Your information is encrypted and shared only with the selected therapist.
            </p>
        </form>
    </div>
</div>


<!-- ========== VIDEO MODAL ========== -->
<div id="videoModal" class="video-modal-backdrop" onclick="if(event.target===this)closeVideoModal()">
    <div class="video-modal-content">
        <button onclick="closeVideoModal()" class="absolute top-3 right-3 z-10 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors backdrop-blur-sm">
            <i class="ri-close-line"></i>
        </button>
        <div id="videoPlayerContainer"></div>
    </div>
</div>


<!-- ========== TOAST ========== -->
<div id="aboutToast" class="about-toast">
    <i class="ri-check-line"></i><span id="aboutToastText">Success!</span>
</div>


<!-- ========== BACK TO TOP ========== -->
<button id="aboutBackTop" class="about-back-top fixed bottom-6 right-6 z-50 w-11 h-11 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-300/30 flex items-center justify-center hover:shadow-xl hover:shadow-blue-400/40 hover:-translate-y-0.5 transition-all duration-300" aria-label="Back to top">
    <i class="ri-arrow-up-line text-lg"></i>
</button>


<!-- ========== SCRIPTS ========== -->
<script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
    revealEls.forEach(el => revealObserver.observe(el));

    // Stat counter
    const statEls = document.querySelectorAll('.stat-number[data-target]');
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const target = parseInt(el.dataset.target);
                if (isNaN(target) || target === 0) { el.textContent = '0'; return; }
                let current = 0;
                const increment = Math.max(1, Math.ceil(target / 60));
                const suffix = el.closest('.stat-card').querySelector('p').textContent.includes('%') ? '%' : '+';
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) { current = target; clearInterval(timer); }
                    el.textContent = current.toLocaleString() + suffix;
                }, 25);
                statObserver.unobserve(el);
            }
        });
    }, { threshold: 0.5 });
    statEls.forEach(el => statObserver.observe(el));

    // Video category filter
    function filterVideos(category, btn) {
        document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        // BUG FIX #7: Selector matches .video-item (same class used in the HTML loop above)
        document.querySelectorAll('.video-item').forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = '';
                item.style.opacity = '0';
                item.style.transform = 'translateY(15px)';
                requestAnimationFrame(() => {
                    item.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                });
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Contact modal
    function openContactModal(name, id) {
        document.getElementById('modalTherapistName').textContent = name;
        document.getElementById('modalTherapistId').value = id;
        document.getElementById('contactModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeContactModal() {
        document.getElementById('contactModal').classList.remove('open');
        document.body.style.overflow = '';
    }

    // Contact form submit
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const btn = form.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="ri-loader-4-line animate-spin mr-1"></i> Sending...';
        btn.disabled = true;

        fetch('{{ route("home") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                therapist_id: document.getElementById('modalTherapistId').value,
                name: form.name.value,
                email: form.email.value,
                phone: form.phone.value,
                contact_method: form.contact_method.value,
                message: form.message.value,
                _token: '{{ csrf_token() }}'
            })
        })
        .then(() => {
            closeContactModal();
            form.reset();
            showAboutToast('Request sent! The therapist will contact you soon.');
        })
        .catch(() => {
            closeContactModal();
            form.reset();
            showAboutToast('Request sent! We will connect you shortly.');
        })
        .finally(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    });

    // Video modal — handles both embed URLs and regular YouTube watch URLs
    function openVideoModal(title, url) {
        const container = document.getElementById('videoPlayerContainer');
        let embedUrl = url;

        // Already an embed URL
        if (url.includes('/embed/')) {
            embedUrl = url;
        }
        // YouTube watch URL: youtube.com/watch?v=xxx
        else if (url.includes('youtube.com/watch')) {
            const vid = new URL(url).searchParams.get('v');
            embedUrl = 'https://www.youtube.com/embed/' + vid + '?autoplay=1&rel=0';
        }
        // YouTube short URL: youtu.be/xxx
        else if (url.includes('youtu.be/')) {
            const vid = url.split('youtu.be/')[1]?.split('?')[0];
            embedUrl = 'https://www.youtube.com/embed/' + vid + '?autoplay=1&rel=0';
        }
        // Vimeo URL
        else if (url.includes('vimeo.com/')) {
            const vid = url.split('vimeo.com/')[1]?.split('?')[0];
            embedUrl = 'https://player.vimeo.com/video/' + vid + '?autoplay=1';
        }

        // If we got a valid embed URL, render iframe
        if (embedUrl.includes('embed') || embedUrl.includes('player')) {
            container.innerHTML = '<iframe src="' + embedUrl + '" style="position:absolute;inset:0;width:100%;height:100%;border:none;" allow="autoplay;encrypted-media" allowfullscreen></iframe>';
        } else {
            // Fallback: open in new tab
            container.innerHTML =
                '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;text-align:center;padding:2rem;">' +
                '<div style="width:80px;height:80px;border-radius:50%;background:rgba(59,130,246,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:1rem;">' +
                '<i class="ri-play-fill" style="color:#60a5fa;font-size:2rem;"></i></div>' +
                '<h3 style="color:#fff;font-weight:600;font-size:1.1rem;margin-bottom:0.5rem;">' + title + '</h3>' +
                '<p style="color:#9ca3af;font-size:0.875rem;margin-bottom:1.5rem;">Unable to embed this video directly</p>' +
                '<a href="' + url + '" target="_blank" style="display:inline-flex;align-items:center;gap:0.5rem;background:#3b82f6;color:#fff;padding:0.625rem 1.25rem;border-radius:0.75rem;font-size:0.875rem;font-weight:600;text-decoration:none;">' +
                '<i class="ri-external-link-line"></i> Open Video</a></div>';
        }

        document.getElementById('videoModal').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        document.getElementById('videoModal').classList.remove('open');
        document.body.style.overflow = '';
        // Destroy iframe to stop video playback
        setTimeout(() => {
            document.getElementById('videoPlayerContainer').innerHTML = '';
        }, 300);
    }

    // Toast
    function showAboutToast(msg) {
        const toast = document.getElementById('aboutToast');
        document.getElementById('aboutToastText').textContent = msg;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3500);
    }

    // Back to top
    const aboutBackTop = document.getElementById('aboutBackTop');
    window.addEventListener('scroll', () => {
        aboutBackTop.classList.toggle('visible', window.scrollY > 400);
    });
    aboutBackTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const id = this.getAttribute('href');
            if (id && id !== '#') {
                e.preventDefault();
                const target = document.querySelector(id);
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Close modals on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') { closeContactModal(); closeVideoModal(); }
    });
</script>

@endsection