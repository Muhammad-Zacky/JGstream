<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JG-Stream | JGRP Radio</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gta: {
                            dark: '#050505',
                            panel: '#111111',
                            green: '#2E8B57', // SeaGreen
                            lightgreen: '#3CB371',
                            gold: '#FEAB0F',
                        }
                    },
                    fontFamily: {
                        'gta': ['Pricedown', 'Impact', 'sans-serif'],
                        'sans': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'spin-slow': 'spin 3s linear infinite',
                        'bounce-slight': 'bounce 2s infinite',
                    }
                }
            }
        }
    </script>

    <style>
        @font-face {
            font-family: 'Pricedown';
            src: url('https://db.onlinewebfonts.com/t/056353a27c582f322f5f4b68abd07b83.woff2') format('woff2');
            font-display: swap;
        }

        body {
            background-color: #050505;
            background-image: 
                linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.95)),
                url('https://images.unsplash.com/photo-1605218427306-0296d27fe8b7?q=80&w=2000&auto=format&fit=crop'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #e2e8f0;
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #2E8B57; border-radius: 3px; }

        .text-gta-shadow {
            text-shadow: 3px 3px 0px #000;
            -webkit-text-stroke: 1px black;
        }

        .gta-panel {
            background: rgba(17, 17, 17, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid #333;
            border-left: 4px solid #2E8B57;
        }
        
        .input-gta:focus {
            outline: none;
            border-color: #2E8B57;
            box-shadow: 0 0 10px rgba(46, 139, 87, 0.3);
        }

        /* Modal Animation */
        .modal-enter { opacity: 0; transform: scale(0.9); }
        .modal-enter-active { opacity: 1; transform: scale(1); transition: all 0.2s ease-out; }
        .modal-exit { opacity: 1; transform: scale(1); }
        .modal-exit-active { opacity: 0; transform: scale(0.9); transition: all 0.2s ease-in; }
    </style>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col relative">

    <div id="toast-container" class="fixed top-5 right-5 z-[100] flex flex-col gap-2 pointer-events-none px-4 w-full md:w-auto"></div>

    <nav class="w-full z-40 py-4 px-4 md:px-8 border-b border-white/10 bg-black/60 backdrop-blur-md sticky top-0">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gta-green rounded flex items-center justify-center border-2 border-white/20 shadow-[0_0_15px_rgba(46,139,87,0.5)]">
                    <i class="fas fa-compact-disc text-black text-xl animate-spin-slow"></i>
                </div>
                <div>
                    <h1 class="font-gta text-3xl text-gta-green tracking-wide leading-none text-gta-shadow">JG-STREAM</h1>
                    <p class="text-[10px] text-gray-400 font-bold tracking-widest uppercase -mt-1">Radio System</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <button onclick="toggleModal()" class="hidden md:flex items-center gap-2 bg-white/5 hover:bg-gta-green/20 border border-white/10 hover:border-gta-green text-gray-300 hover:text-white px-4 py-2 rounded transition text-xs font-bold uppercase tracking-wider">
                    <i class="fas fa-question-circle"></i> HELP / PANDUAN
                </button>

                <a href="https://jogjagamers.org/profile/102311-uk/" target="_blank" class="hidden md:flex items-center gap-2 text-xs font-bold text-gray-400 hover:text-white transition">
                    <i class="fas fa-external-link-alt"></i> FORUM
                </a>
            </div>
        </div>
    </nav>

    <button onclick="toggleModal()" class="md:hidden fixed bottom-6 right-6 z-40 w-12 h-12 bg-gta-green text-white rounded-full shadow-lg flex items-center justify-center border-2 border-black animate-bounce-slight">
        <i class="fas fa-question text-xl"></i>
    </button>

    <main class="flex-grow container mx-auto px-4 py-8 md:py-12 max-w-6xl">

        <div class="text-center mb-10">
            <span class="bg-gta-green/10 text-gta-green border border-gta-green/30 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-[0_0_10px_rgba(46,139,87,0.2)]">
                San Andreas Multiplayer Audio
            </span>
            <h2 class="font-gta text-5xl md:text-7xl text-white mt-4 mb-2 text-gta-shadow">
                MISSION PASSED
            </h2>
            <p class="text-gray-400 text-sm md:text-base max-w-lg mx-auto">
                Paste link <span class="text-gta-green font-bold">YouTube</span> atau <span class="text-indigo-400 font-bold">Discord</span>. Dapatkan link radio buat Boombox kamu.
            </p>
        </div>

        <div class="gta-panel rounded-xl p-6 md:p-8 shadow-2xl mb-12 relative overflow-hidden group">
            
            @if(session('success'))
                <div class="mb-6 bg-green-900/30 border-l-4 border-green-500 text-green-400 px-4 py-3 flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span class="font-bold text-sm font-mono uppercase">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-900/30 border-l-4 border-red-500 text-red-400 px-4 py-3 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                    <span class="font-bold text-sm font-mono uppercase">{{ session('error') }}</span>
                </div>
            @endif

            <form action="/check" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                @csrf
                
                <div class="md:col-span-4">
                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1 block pl-1">Custom Title (Opsional)</label>
                    <input type="text" name="title" 
                        class="w-full bg-black/60 border border-white/10 text-white p-3 rounded input-gta transition text-sm font-medium placeholder-gray-700"
                        placeholder="Judul Lagu...">
                </div>

                <div class="md:col-span-6">
                    <label class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1 block pl-1">Link Source</label>
                    <input type="url" name="url" required 
                        class="w-full bg-black/60 border border-white/10 text-white p-3 rounded input-gta transition text-sm font-mono placeholder-gray-700"
                        placeholder="https://youtube.com/watch?v=...">
                </div>

                <div class="md:col-span-2 flex items-end">
                    <button type="submit" class="w-full bg-gta-green hover:bg-green-600 text-white font-gta text-2xl py-2 rounded shadow-lg transform active:scale-95 transition border-b-4 border-green-800 hover:border-green-700 flex items-center justify-center gap-2">
                        <span>GENERATE</span>
                    </button>
                </div>
            </form>
            
            <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-4 text-[10px] text-gray-600 font-mono uppercase tracking-tight">
                <span class="flex items-center gap-1"><i class="fab fa-youtube text-red-800"></i> YouTube Support</span>
                <span class="flex items-center gap-1"><i class="fab fa-discord text-indigo-800"></i> Discord Support</span>
                <span class="flex items-center gap-1"><i class="fas fa-bolt text-yellow-700"></i> Instant Process</span>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-end gap-4 mb-4 border-b border-white/10 pb-2">
            <div>
                <h3 class="font-gta text-3xl text-white tracking-wide text-gta-shadow">RADIO STATION</h3>
            </div>
            <div class="relative w-full md:w-64">
                <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search track..." class="w-full bg-black/50 border border-white/10 text-sm rounded px-3 py-2 pl-8 focus:outline-none focus:border-gta-green text-gray-300 transition placeholder-gray-700 font-mono">
                <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-600 text-xs"></i>
            </div>
        </div>

        <div class="bg-black/40 border border-white/5 rounded-lg overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap" id="musicTable">
                    <thead>
                        <tr class="bg-white/5 text-gray-500 text-[10px] uppercase tracking-wider font-mono">
                            <th class="p-4 w-16 text-center">SRC</th>
                            <th class="p-4">Track Name</th>
                            <th class="p-4 w-24 text-center">Preview</th>
                            <th class="p-4 w-32 text-right">Link</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-sm text-gray-300 font-mono">
                        @forelse($links as $link)
                        <tr class="hover:bg-white/5 transition group">
                            <td class="p-4 text-center">
                                @if($link->is_youtube)
                                    <i class="fab fa-youtube text-red-600 text-lg"></i>
                                @else
                                    <i class="fab fa-discord text-indigo-500 text-lg"></i>
                                @endif
                            </td>

                            <td class="p-4">
                                <div class="font-bold text-white group-hover:text-gta-green transition truncate max-w-[150px] md:max-w-md font-sans">
                                    {{ $link->title }}
                                </div>
                                <div class="text-[10px] text-gray-600 mt-1">
                                    {{ $link->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <td class="p-4 text-center">
                                <audio id="audio-{{ $link->id }}" src="{{ $link->url }}" preload="none"></audio>
                                <button onclick="playAudio('audio-{{ $link->id }}', this)" 
                                    class="w-8 h-8 rounded-full bg-gray-800 hover:bg-gta-green text-gray-500 hover:text-white transition flex items-center justify-center border border-white/10 mx-auto">
                                    <i class="fas fa-play text-[10px]"></i>
                                </button>
                            </td>

                            <td class="p-4 text-right">
                                <button onclick="copyLink('{{ $link->url }}')" 
                                    class="bg-gta-green/10 hover:bg-gta-green text-gta-green hover:text-white border border-gta-green/30 hover:border-gta-green text-[10px] font-bold px-3 py-1.5 rounded transition uppercase tracking-wide">
                                    COPY
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-600">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-ghost text-4xl mb-2 opacity-20"></i>
                                    <p class="text-xs uppercase tracking-widest">No tracks found</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-4 py-3 bg-black/50 border-t border-white/5 text-xs font-mono">
                {{ $links->links('pagination::tailwind') }}
            </div>
        </div>
    </main>

    <footer class="text-center py-8 border-t border-white/5 text-[10px] text-gray-600 uppercase tracking-widest bg-black/80">
        &copy; {{ date('Y') }} JG-Stream System • <span class="text-gta-green">JGRP Community</span>
    </footer>

    <div id="helpModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop" onclick="toggleModal()"></div>
        
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] max-w-md transform transition-all scale-95 opacity-0" id="modalContent">
            <div class="gta-panel bg-black border border-gta-green/50 shadow-[0_0_50px_rgba(0,0,0,0.8)] relative">
                
                <div class="bg-gta-green/10 p-4 border-b border-gta-green/20 flex justify-between items-center">
                    <h3 class="font-gta text-2xl text-white tracking-wider text-gta-shadow">INSTRUCTIONS</h3>
                    <button onclick="toggleModal()" class="text-gray-500 hover:text-white transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <div class="flex gap-4 items-start">
                        <div class="w-8 h-8 rounded bg-red-900/50 border border-red-500/50 text-red-500 flex items-center justify-center font-bold font-gta text-xl flex-shrink-0">1</div>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wide">Copy Source</h4>
                            <p class="text-gray-400 text-xs mt-1 leading-relaxed">
                                Salin link video dari <span class="text-red-400">YouTube</span> atau file .mp3 dari <span class="text-indigo-400">Discord</span>.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-8 h-8 rounded bg-gta-green/20 border border-gta-green/50 text-gta-green flex items-center justify-center font-bold font-gta text-xl flex-shrink-0">2</div>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wide">Paste & Generate</h4>
                            <p class="text-gray-400 text-xs mt-1 leading-relaxed">
                                Tempel link di kolom input website ini, lalu klik tombol <b class="text-gta-green">GENERATE</b>.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="w-8 h-8 rounded bg-yellow-900/50 border border-yellow-500/50 text-yellow-500 flex items-center justify-center font-bold font-gta text-xl flex-shrink-0">3</div>
                        <div>
                            <h4 class="text-white font-bold text-sm uppercase tracking-wide">Copy Result</h4>
                            <p class="text-gray-400 text-xs mt-1 leading-relaxed">
                                Klik tombol <b class="text-white bg-gray-800 px-1 rounded">COPY</b> pada tabel. Paste di Boombox / Radio GTA kamu.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4 border-t border-white/10 bg-black/50 text-center">
                    <button onclick="toggleModal()" class="w-full bg-white/5 hover:bg-gta-green hover:text-white text-gray-400 font-bold py-2 rounded text-xs uppercase tracking-widest transition border border-white/5">
                        OK, I Understand
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- Modal Logic ---
        function toggleModal() {
            const modal = document.getElementById('helpModal');
            const backdrop = document.getElementById('modalBackdrop');
            const content = document.getElementById('modalContent');

            if (modal.classList.contains('hidden')) {
                // Open
                modal.classList.remove('hidden');
                setTimeout(() => {
                    backdrop.classList.remove('opacity-0');
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);
            } else {
                // Close
                backdrop.classList.add('opacity-0');
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // --- Copy Logic ---
        function copyLink(text) {
            navigator.clipboard.writeText(text).then(() => {
                showToast("URL COPIED! PASTE DI GAME.", "success");
            }).catch(() => {
                showToast("ERROR COPYING URL", "error");
            });
        }

        function showToast(msg, type) {
            const container = document.getElementById('toast-container');
            const el = document.createElement('div');
            const color = type === 'success' ? 'border-gta-green text-gta-green' : 'border-red-500 text-red-500';
            
            el.className = `bg-black/95 border-l-4 ${color} px-4 py-3 shadow-[0_0_15px_rgba(0,0,0,0.5)] flex items-center gap-3 transform transition-all duration-300 translate-y-[-10px] opacity-0 pointer-events-auto min-w-[200px] max-w-xs`;
            el.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check' : 'fa-times'}"></i><span class="font-bold text-xs font-mono tracking-widest uppercase">${msg}</span>`;
            
            container.appendChild(el);
            
            requestAnimationFrame(() => { el.classList.remove('translate-y-[-10px]', 'opacity-0'); });
            setTimeout(() => {
                el.classList.add('opacity-0', 'translate-x-[50px]');
                setTimeout(() => el.remove(), 300);
            }, 3000);
        }

        // --- Audio Logic ---
        let currentAudio = null;
        let currentBtn = null;

        function playAudio(id, btn) {
            let audio = document.getElementById(id);
            let icon = btn.querySelector('i');

            if (currentAudio && currentAudio !== audio) {
                currentAudio.pause();
                currentAudio.currentTime = 0;
                let prevIcon = currentBtn.querySelector('i');
                prevIcon.className = 'fas fa-play text-[10px]';
                currentBtn.classList.remove('bg-gta-green', 'text-white');
                currentBtn.classList.add('bg-gray-800', 'text-gray-500');
            }

            if (audio.paused) {
                audio.play();
                icon.className = 'fas fa-stop text-[10px]';
                btn.classList.remove('bg-gray-800', 'text-gray-500');
                btn.classList.add('bg-gta-green', 'text-white');
                currentAudio = audio;
                currentBtn = btn;
            } else {
                audio.pause();
                audio.currentTime = 0;
                icon.className = 'fas fa-play text-[10px]';
                btn.classList.remove('bg-gta-green', 'text-white');
                btn.classList.add('bg-gray-800', 'text-gray-500');
                currentAudio = null;
            }
            
            audio.onended = function() {
                icon.className = 'fas fa-play text-[10px]';
                btn.classList.remove('bg-gta-green', 'text-white');
                btn.classList.add('bg-gray-800', 'text-gray-500');
                currentAudio = null;
            };
        }

        function filterTable() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var tr = document.getElementById("musicTable").getElementsByTagName("tr");

            for (var i = 1; i < tr.length; i++) {
                var td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    var txt = td.textContent || td.innerText;
                    tr[i].style.display = txt.toUpperCase().indexOf(filter) > -1 ? "" : "none";
                }       
            }
        }
    </script>
</body>
</html>
