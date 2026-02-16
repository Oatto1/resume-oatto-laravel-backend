<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $aboutMe->localized('name') ?? 'Portfolio' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Fallback if Vite is not running/built -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ["{{ app()->getLocale() === 'th' ? 'Prompt' : 'Figtree' }}", 'sans-serif'],
                        },
                        colors: {
                            'brand-purple': '#6b4c9a',
                            'brand-blue': '#4c6b9a',
                        }
                    }
                }
            }
        </script>
    @endif
    
    <style>
        /* Force list styles for RichEditor content */
        .prose ul {
            list-style-type: disc !important;
            padding-left: 1.5em !important;
            margin-top: 1em !important;
            margin-bottom: 1em !important;
        }
        .prose ol {
            list-style-type: decimal !important;
            padding-left: 1.5em !important;
            margin-top: 1em !important;
            margin-bottom: 1em !important;
        }
        .prose li {
            margin-top: 0.5em !important;
            margin-bottom: 0.5em !important;
        }

        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s;
        }
        .fade-enter, .fade-leave-to {
            opacity: 0;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 font-sans" style="font-family: {{ app()->getLocale() === 'th' ? "'Prompt', sans-serif" : "'Figtree', sans-serif" }};">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md shadow-sm transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-600">
                        {{ $aboutMe->localized('name') ?? 'Oatto' }}
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#about" class="text-gray-600 hover:text-purple-600 transition-colors px-3 py-2 text-sm font-medium">{{ __('About') }}</a>
                    <a href="#skills" class="text-gray-600 hover:text-purple-600 transition-colors px-3 py-2 text-sm font-medium">{{ __('Skills') }}</a>
                    <a href="#experience" class="text-gray-600 hover:text-purple-600 transition-colors px-3 py-2 text-sm font-medium">{{ __('Experience') }}</a>
                    <a href="#education" class="text-gray-600 hover:text-purple-600 transition-colors px-3 py-2 text-sm font-medium">{{ __('Education') }}</a>
                    <a href="#portfolio" class="text-gray-600 hover:text-purple-600 transition-colors px-3 py-2 text-sm font-medium">{{ __('Portfolio') }}</a>

                    <!-- Language Switcher -->
                    <div class="flex items-center border-l border-gray-200 pl-6 ml-2 space-x-2">
                        <a href="{{ route('lang.switch', 'en') }}"
                           class="px-2 py-1 rounded text-sm font-medium transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-purple-600 text-white shadow-sm' : 'text-gray-500 hover:text-purple-600 hover:bg-purple-50' }}">
                            EN
                        </a>
                        <a href="{{ route('lang.switch', 'th') }}"
                           class="px-2 py-1 rounded text-sm font-medium transition-all duration-200 {{ app()->getLocale() === 'th' ? 'bg-purple-600 text-white shadow-sm' : 'text-gray-500 hover:text-purple-600 hover:bg-purple-50' }}">
                            TH
                        </a>
                    </div>
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex md:hidden">
                    <button type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" aria-controls="mobile-menu" aria-expanded="false" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:hidden bg-white border-t border-gray-100" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">{{ __('About') }}</a>
                <a href="#skills" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">{{ __('Skills') }}</a>
                <a href="#experience" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">{{ __('Experience') }}</a>
                <a href="#education" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">{{ __('Education') }}</a>
                <a href="#portfolio" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-purple-600 hover:bg-gray-50">{{ __('Portfolio') }}</a>
                <!-- Mobile Language Switcher -->
                <div class="flex items-center space-x-2 px-3 py-2 border-t border-gray-100 mt-2 pt-3">
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-3 py-1.5 rounded text-sm font-medium transition-all {{ app()->getLocale() === 'en' ? 'bg-purple-600 text-white' : 'text-gray-500 hover:text-purple-600 bg-gray-100' }}">
                        EN
                    </a>
                    <a href="{{ route('lang.switch', 'th') }}"
                       class="px-3 py-1.5 rounded text-sm font-medium transition-all {{ app()->getLocale() === 'th' ? 'bg-purple-600 text-white' : 'text-gray-500 hover:text-purple-600 bg-gray-100' }}">
                        TH
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero / About Section -->
    <section id="about" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-gradient-to-br from-purple-50 via-white to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="lg:col-span-6 text-center lg:text-left mb-12 lg:mb-0">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                        <span class="block">{{ __('hi_intro') }} {{ $aboutMe->localized('name') ?? 'Oatto' }}</span>
                        <span class="mt-6 block text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-blue-600">{{ $aboutMe->localized('position') ?? 'Developer' }}</span>
                    </h1>
                    <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        <!-- {{ __('hero_description') }} -->
                    </p>
                    <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                        @if(isset($aboutMe->email))
                        <div class="rounded-md shadow">
                            <a href="mailto:{{ $aboutMe->email }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 md:py-4 md:text-lg transition-transform transform hover:scale-105">
                                {{ __('Contact Me') }}
                            </a>
                        </div>
                        @endif
                        @if(isset($aboutMe->github_link))
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <a href="{{ $aboutMe->github_link }}" target="_blank" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 md:py-4 md:text-lg transition-transform transform hover:scale-105">
                                GitHub
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-6 flex justify-center lg:justify-end relative">
                    <!-- Blob Decoration -->
                    <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                    <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500 border-4 border-white max-w-sm">
                        <img src="{{ isset($aboutMe->main_image) ? asset('storage/' . $aboutMe->main_image) : 'https://placehold.co/400x500/6b4c9a/ffffff?text=Mascot' }}" alt="{{ $aboutMe->localized('name') ?? 'Mascot' }}" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Me Section -->
    @if($aboutMe && $aboutMe->localized('description'))
    <section id="about-detail" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">{{ __('About Me') }}</h2>
                <!-- <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ __('About Me') }}</p> -->
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-8 md:p-12 shadow-sm border border-purple-100/50">
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! $aboutMe->localized('description') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Skills Section -->
    <section id="skills" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">{{ __('Tech Stack') }}</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ __('My Toolkit') }}</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                @if(count($skills) > 0)
                    @foreach($skills as $skill)
                    <div class="flex flex-col items-center p-6 bg-gray-50 rounded-xl hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
                        <div class="h-16 w-16 mb-4 flex items-center justify-center bg-white rounded-full shadow-sm p-3">
                            @if($skill->image)
                                <img src="{{ asset('storage/' . $skill->image) }}" alt="{{ $skill->localized('title') }}" class="h-10 w-10 object-contain">
                            @else
                                <span class="text-2xl font-bold text-purple-600">{{ substr($skill->localized('title'), 0, 1) }}</span>
                            @endif
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $skill->localized('title') }}</h3>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500">{{ __('No skills found.') }}</div>
                @endif
            </div>
        </div>
    </section>

    <!-- Experience & Education Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">{{ __('Career Path') }} & {{ __('Learning') }}</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ __('Experience') }} & {{ __('Education') }}</p>
            </div>

            <div class="grid grid-cols-1 gap-12">
                <!-- Experience Column -->
                <div id="experience" class="space-y-8">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-3 bg-purple-100 rounded-lg text-purple-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ __('Work Experience') }}</h3>
                    </div>

                    @if(count($experiences) > 0)
                        @foreach($experiences as $experience)
                        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110 duration-500"></div>
                            
                                <!-- 3-Column Layout: Image - Content - Year -->
                                <div class="flex flex-col md:flex-row gap-4 md:gap-6 w-full">
                                    <!-- 1. Image Column (Left) -->
                                    <div class="flex-shrink-0">
                                        @if($experience->image)
                                            <img src="{{ asset('storage/' . $experience->image) }}" alt="{{ $experience->localized('company') }}" class="h-16 w-16 rounded-xl object-contain shadow-sm bg-white p-1 border border-gray-100">
                                        @else
                                            <div class="h-16 w-16 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- 2. Content Column (Middle - Grows) -->
                                    <div class="flex-grow min-w-0">
                                        <h4 class="text-xl font-bold text-gray-900 break-words">{{ $experience->localized('position') }}</h4>
                                        <p class="text-lg font-medium text-purple-600 break-words mb-2">{{ $experience->localized('company') }}</p>
                                        <p class="text-gray-600 leading-relaxed">{{ $experience->localized('description') }}</p>
                                    </div>

                                    <!-- 3. Year Column (Right - Pushed to End) -->
                                    <div class="flex-shrink-0 self-start md:ml-auto">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-50 text-purple-700 whitespace-nowrap border border-purple-100">
                                            {{ $experience->start_year }} - {{ $experience->end_year ?? __('Present') }}
                                        </span>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-gray-500 italic">{{ __('No experience listed.') }}</div>
                    @endif
                </div>

                <!-- Education Column -->
                <div id="education" class="space-y-8">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-3 bg-blue-100 rounded-lg text-blue-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ __('Education') }}</h3>
                    </div>

                    @if(count($educations) > 0)
                        @foreach($educations as $education)
                        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110 duration-500"></div>
                            
                            <div class="relative z-10">
                                <div class="flex gap-4 mb-4">
                                    <div class="flex-shrink-0">
                                        @if($education->image)
                                            <img src="{{ asset('storage/' . $education->image) }}" alt="{{ $education->localized('school') }}" class="h-16 w-16 rounded-xl object-cover shadow-sm">
                                        @else
                                            <div class="h-16 w-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ $education->localized('school') }}</h4>
                                        <p class="text-lg font-medium text-blue-600">{{ $education->localized('degree') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-500 mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $education->start_year }} - {{ $education->end_year }}
                                    </div>
                                    @if($education->gpa)
                                    <div class="font-medium bg-blue-50 text-blue-700 px-2 py-1 rounded">GPA: {{ $education->gpa }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-gray-500 italic">{{ __('No education listed.') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-20 bg-gradient-to-t from-purple-50 via-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">{{ __('Showcase') }}</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ __('Recent Projects') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(count($portfolios) > 0)
                    @foreach($portfolios as $portfolio)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="relative h-48 w-full overflow-hidden">
                            <img src="{{ isset($portfolio->image) ? asset('storage/' . $portfolio->image) : 'https://placehold.co/600x400/purple/white?text=Project' }}" alt="{{ $portfolio->localized('title') }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <span class="text-white font-medium">{{ $portfolio->type ?? 'Web App' }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">{{ $portfolio->localized('title') }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $portfolio->localized('description') }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if(isset($portfolio->tech_stack))
                                    @php
                                        $techStack = $portfolio->tech_stack;
                                        if (is_string($techStack)) {
                                            $techStack = explode(',', $techStack);
                                        }
                                    @endphp
                                    @if(is_array($techStack))
                                        @foreach($techStack as $tech)
                                            <span class="px-2 py-1 bg-purple-50 text-purple-700 text-xs rounded-md font-medium">{{ trim($tech) }}</span> 
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            @if($portfolio->link)
                            <a href="{{ $portfolio->link }}" target="_blank" class="inline-flex items-center text-sm font-semibold text-purple-600 hover:text-purple-800 transition-colors">
                                {{ __('View Project') }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center text-gray-500">{{ __('Coming soon.') }}</div>
                @endif
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-blue-600">{{ $aboutMe->localized('name') ?? 'Oatto' }}</span>
                    <p class="mt-4 text-gray-500 max-w-sm">
                        {{ __('footer_description') }}
                    </p>
                </div>
                <div class="flex flex-col md:items-end justify-center">
                     @if(isset($aboutMe->email))
                    <a href="mailto:{{ $aboutMe->email }}" class="text-gray-600 hover:text-purple-600 transition-colors mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        {{ $aboutMe->email }}
                    </a>
                    @endif
                    @if(isset($aboutMe->phone))
                    <span class="text-gray-600 mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ $aboutMe->phone }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} {{ $aboutMe->localized('name') ?? 'Oatto' }}. {{ __('All rights reserved.') }}
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <!-- Social Icons could go here -->
                </div>
            </div>
        </div>
    </footer>
    
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>
</html>