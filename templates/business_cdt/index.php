import os

files = {
    # PÁGINA ÚNICA (Conteúdo Direto - Sem animação de entrada)
    "index.html": r"""<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Risco | BusinessCDT</title>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-88DNCX606P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-88DNCX606P');
    </script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Fontes -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-deep: #050505;
            --bg-card: #0f0f0f;
            --border-color: #262626;
            --titan-gold: #FFD700;
            --text-main: #e5e5e5;
            --text-dim: #9ca3af;
            --neon-green: #00ff88;
            --neon-red: #ff3b3b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-deep);
            color: var(--text-main);
            line-height: 1.8;
            margin: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, .font-titan { font-family: 'Orbitron', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Links no texto */
        .text-link { color: var(--titan-gold); text-decoration: none; border-bottom: 1px solid rgba(255, 215, 0, 0.3); transition: all 0.3s; }
        .text-link:hover { background-color: rgba(255, 215, 0, 0.1); border-bottom-color: var(--titan-gold); }

        /* Cartões */
        .card-titan { background: var(--bg-card); border: 1px solid var(--border-color); transition: all 0.3s ease; }
        .card-titan:hover { border-color: var(--titan-gold); transform: translateY(-2px); box-shadow: 0 0 20px rgba(255, 215, 0, 0.05); }

        /* Barra de Progresso */
        #progress-bar { width: 0%; height: 3px; background: var(--titan-gold); position: fixed; top: 0; left: 0; z-index: 200; box-shadow: 0 0 10px var(--titan-gold); }
        
        blockquote { border-left: 3px solid var(--titan-gold); padding-left: 1.5rem; margin: 2rem 0; font-style: italic; color: var(--text-dim); background: linear-gradient(90deg, rgba(255,215,0,0.05) 0%, transparent 100%); }

        /* Modal +18 */
        #ageModal { backdrop-filter: blur(15px); background-color: rgba(0,0,0,0.9); }
        
        /* Ticker Animation */
        @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
        .ticker-animate { display: flex; width: fit-content; animation: ticker 60s linear infinite; }
        
        .loading-dot {
            height: 4px; width: 4px; background-color: var(--titan-gold); border-radius: 50%; display: inline-block; animation: pulse 1s infinite;
        }
        @keyframes pulse { 0% { opacity: 0.3; } 50% { opacity: 1; } 100% { opacity: 0.3; } }
    </style>
</head>
<body class="antialiased overflow-hidden" id="mainBody">

    <!-- MODAL 18+ (Pop-up de Segurança) -->
    <div id="ageModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4">
        <div class="bg-[#0f0f0f] border-2 border-red-900 p-8 rounded-lg max-w-sm w-full text-center shadow-2xl shadow-red-900/20">
            <div class="w-16 h-16 bg-red-900/20 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-900">
                <span class="text-2xl font-black text-red-500 font-titan">18+</span>
            </div>
            <h2 class="text-xl font-bold text-white mb-2 font-titan uppercase">Acesso Restrito</h2>
            <p class="text-sm text-zinc-400 mb-6 font-mono text-[10px]">CONTEÚDO SENSÍVEL SOBRE RISCOS FINANCEIROS.</p>
            <div class="flex gap-3">
                <button onclick="window.location.href='https://google.com'" class="flex-1 py-3 rounded border border-zinc-700 text-zinc-500 hover:text-white hover:border-white transition text-xs font-bold uppercase">Sair</button>
                <button onclick="enterSite()" class="flex-1 py-3 rounded bg-red-700 hover:bg-red-600 text-white transition text-xs font-bold uppercase shadow-lg shadow-red-900/20">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- BARRA DE PROGRESSO DE LEITURA -->
    <div id="progress-bar"></div>

    <!-- TICKER BAR LIVE (Topo) -->
    <div id="ticker-bar" class="bg-black py-2 border-b border-zinc-900 overflow-hidden sticky top-0 z-[100]">
        <div class="ticker-animate uppercase font-bold tracking-tighter" id="ticker-content">
            <div class="px-6 flex items-center gap-2">
                <span class="text-[10px] text-zinc-500 italic">INICIALIZANDO TERMINAL...</span>
                <span class="loading-dot"></span>
            </div>
        </div>
    </div>

    <!-- HEADER MINIMALISTA (Só Logo) -->
    <nav class="h-20 border-b border-[#222] bg-[#050505]/95 backdrop-blur-md sticky top-[37px] z-[90]">
        <div class="container mx-auto px-6 h-full flex items-center justify-center">
            <div class="flex items-center gap-2 text-2xl font-black tracking-tighter text-white font-titan">
                <i class="fa-solid fa-shield-halved text-[var(--titan-gold)]"></i>
                BUSINESS<span class="text-[var(--titan-gold)]">CDT</span>
            </div>
        </div>
    </nav>

    <!-- CONTEÚDO PRINCIPAL (Centralizado) -->
    <main class="container mx-auto px-4 py-12 max-w-7xl">
        
        <!-- HERO SECTION: OFERTA DIRETA -->
        <section class="relative rounded border border-zinc-800 mb-16 overflow-hidden bg-zinc-900/20">
            <div class="p-8 lg:p-16 max-w-4xl relative z-10 flex flex-col justify-center">
                <span class="text-[var(--titan-gold)] text-[10px] font-black uppercase tracking-[0.4em] mb-4 block">Relatório de Mercado 2026</span>
                <h1 class="text-3xl lg:text-6xl font-black text-white leading-tight mb-6 font-titan uppercase">
                    Matemática <br>
                    <span class="text-zinc-600">vence a sorte.</span>
                </h1>
                <p class="text-zinc-400 text-base lg:text-lg mb-8 max-w-2xl border-l-2 border-[var(--titan-gold)] pl-4">
                    Pare de jogar contra a casa. Utilize hardware de ponta para garantir que suas operações sejam executadas sem latência.
                </p>
                
                <!-- CARD HERO (Samsung S24) -->
                <div class="bg-[#111] p-4 rounded border border-[#333] inline-flex items-center gap-4 hover:border-[var(--titan-gold)] transition cursor-pointer group w-fit">
                    <div class="h-12 w-12 bg-black rounded flex items-center justify-center border border-[#222]">
                        <i class="fa-solid fa-mobile-screen-button text-2xl text-zinc-600 group-hover:text-white transition"></i>
                    </div>
                    <div>
                        <span class="text-[8px] font-bold text-[var(--titan-gold)] uppercase block">Ferramenta Pro</span>
                        <h3 class="text-white font-bold text-sm">Samsung Galaxy S24 Ultra</h3>
                    </div>
                    <a href="SEU_LINK_AMAZON_S24" target="_blank" class="ml-4 bg-white text-black font-black px-4 py-2 text-[10px] uppercase hover:bg-[var(--titan-gold)] transition rounded whitespace-nowrap">
                        Ver Oferta
                    </a>
                </div>
            </div>
        </section>

        <!-- LAYOUT DE COLUNAS -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- ARTIGO (Esquerda) -->
            <article class="col-span-1 lg:col-span-8">
                
                <header class="mb-10 pb-8 border-b border-[#222]">
                    <div class="flex items-center gap-3 text-[10px] font-bold text-[var(--titan-gold)] uppercase tracking-[0.2em] mb-4">
                        <span>Relatório de Risco</span>
                        <span class="text-zinc-600">|</span>
                        <span>Segurança Digital</span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-white leading-tight mb-6 font-titan uppercase">
                        A Anatomia do Golpe: <br>
                        <span class="text-zinc-600">O Mito do "Coach de Tigrinho"</span>
                    </h1>
                </header>

                <div class="text-zinc-300 text-lg space-y-8 leading-relaxed">
                    
                    <p class="first-letter:text-5xl first-letter:font-bold first-letter:text-[var(--titan-gold)] first-letter:float-left first-letter:mr-3 first-letter:mt-[-10px]">
                        Falar sobre "coach de tigrinho" é entrar em um terreno onde o marketing agressivo se mistura com promessas perigosas. No cenário atual, essa figura se tornou um símbolo das polêmicas envolvendo cassinos online.
                    </p>

                    <h2 class="text-2xl font-bold text-white font-titan mt-12 mb-4">1. O Que Eles Prometem?</h2>
                    <ul class="list-none space-y-4 pl-4 border-l border-[#333]">
                        <li class="flex items-start gap-3"><i class="fas fa-times-circle text-[var(--neon-red)] mt-1.5 text-xs"></i><span><strong class="text-white">Minutos Pagantes:</strong> A ilusão de horários mágicos.</span></li>
                        <li class="flex items-start gap-3"><i class="fas fa-times-circle text-[var(--neon-red)] mt-1.5 text-xs"></i><span><strong class="text-white">Hack de Sinais:</strong> Grupos falsos.</span></li>
                        <li class="flex items-start gap-3"><i class="fas fa-times-circle text-[var(--neon-red)] mt-1.5 text-xs"></i><span><strong class="text-white">Alavancagem:</strong> Promessas irreais de lucro.</span></li>
                    </ul>

                    <!-- ANÚNCIO 1: MOCHILA -->
                    <div class="card-titan p-6 my-10 border-l-4 border-l-[var(--titan-gold)] bg-[#0a0a0a]">
                        <div class="flex flex-col sm:flex-row gap-6 items-center">
                            <div class="w-full sm:w-1/3 aspect-video bg-[#151515] flex items-center justify-center border border-[#222]"><i class="fas fa-shield-alt text-5xl text-zinc-700"></i></div>
                            <div class="w-full sm:w-2/3">
                                <span class="text-[9px] font-bold text-[var(--titan-gold)] uppercase tracking-widest block mb-1">Proteção de Capital</span>
                                <h3 class="text-lg font-bold text-white font-titan mb-2">Não Aposte Sua Segurança</h3>
                                <p class="text-sm text-zinc-400 mb-4">Se você opera com dinheiro real, proteja seu hardware.</p>
                                <a href="SEU_LINK_AMAZON_MOCHILA" target="_blank" class="inline-block bg-white text-black text-[10px] font-black px-6 py-3 uppercase hover:bg-[var(--titan-gold)] transition-all rounded">Ver Mochila</a>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-white font-titan mt-12 mb-4">2. Realidade Técnica (RNG)</h2>
                    <p>Jogos como o Fortune Tiger são baseados em <span class="text-[var(--titan-gold)] font-mono font-bold">RNG (Random Number Generator)</span>. Cada giro é independente.</p>
                    <blockquote>"Não existe análise gráfica que mude a vantagem matemática da casa. O sistema sempre vence."</blockquote>

                    <!-- ANÚNCIO 2: MANUAL DE GESTÃO -->
                    <div class="bg-[#111] p-4 border border-dashed border-[#333] rounded text-center my-8">
                        <p class="text-sm text-zinc-300 font-mono uppercase">
                            <i class="fas fa-terminal text-[var(--titan-gold)] mr-2"></i>
                            Quer entender a matemática? Baixe o <span class="text-[var(--titan-gold)] font-bold cursor-not-allowed" title="Em breve">Manual de Gestão 2026</span>.
                        </p>
                    </div>

                    <h2 class="text-2xl font-bold text-white font-titan mt-12 mb-4">3. Conclusão</h2>
                    <p>O cerco fechou. Operações policiais recentes bloquearam bens de influenciadores. Se alguém tenta ensinar uma "profissão" de apertar botão, o produto é você.</p>

                </div>
            </article>

            <!-- SIDEBAR (Direita) -->
            <aside class="col-span-12 lg:col-span-4 space-y-8">
                <div class="card-titan p-6 sticky top-32">
                    <div class="flex justify-between items-start mb-4"><span class="text-[var(--titan-gold)] text-[9px] font-black uppercase tracking-[0.2em]">Conforto</span><span class="bg-[#222] text-white text-[8px] px-2 py-1 rounded font-bold">TOP PICK</span></div>
                    <div class="aspect-square bg-[#151515] rounded mb-4 flex items-center justify-center border border-[#333] group overflow-hidden"><i class="fas fa-chair text-6xl text-zinc-700 group-hover:text-white transition duration-500 group-hover:scale-110"></i></div>
                    <h3 class="text-lg font-bold text-white font-titan mb-2">Cadeira ThunderX3</h3>
                    <a href="SEU_LINK_AMAZON_CADEIRA" target="_blank" class="block w-full bg-[var(--titan-gold)] text-black text-center font-black py-3 text-[10px] uppercase hover:bg-white transition-all rounded shadow-lg">Ver Oferta na Amazon</a>
                </div>
            </aside>

        </div>
    </main>

    <footer class="border-t border-[#222] bg-[#020202] py-12 mt-12 text-center">
        <p class="text-zinc-600 text-[9px] uppercase tracking-widest mb-2 font-bold">Aviso Legal</p>
        <p class="text-zinc-700 text-[9px] max-w-xl mx-auto leading-relaxed px-4">
            Conteúdo educacional. Jogue com responsabilidade. 18+
        </p>
    </footer>

    <script>
        function enterSite() { 
            const modal = document.getElementById('ageModal'); 
            const body = document.getElementById('mainBody'); 
            modal.style.transition = "opacity 0.5s ease"; 
            modal.style.opacity = "0"; 
            setTimeout(() => { modal.classList.add('hidden'); body.classList.remove('overflow-hidden'); }, 500); 
        }
        window.onscroll = function() { 
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop; 
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight; 
            var scrolled = (winScroll / height) * 100; 
            document.getElementById("progress-bar").style.width = scrolled + "%"; 
        };

        async function updateTerminalData() {
            try {
                const financeRes = await fetch('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,XAU-BRL');
                const financeData = await financeRes.json();
                
                const locRes = await fetch('http://ip-api.com/json/');
                const locData = await locRes.json();
                
                const weatherRes = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${locData.lat}&longitude=${locData.lon}&current_weather=true`);
                const weatherData = await weatherRes.json();

                const usd = parseFloat(financeData.USDBRL.bid).toFixed(2);
                const eur = parseFloat(financeData.EURBRL.bid).toFixed(2);
                const gold = parseFloat(financeData.XAUBRL.bid).toFixed(2);
                const temp = weatherData.current_weather.temperature;
                const city = locData.city.toUpperCase();

                const tickerItems = `
                    <div class="px-6 border-r border-[#333] flex items-center gap-2"><span class="text-[10px] text-zinc-500">DÓLAR:</span><span class="text-[11px] mono text-[#00ff88]">R$ ${usd}</span></div>
                    <div class="px-6 border-r border-[#333] flex items-center gap-2"><span class="text-[10px] text-zinc-500">EURO:</span><span class="text-[11px] mono text-[#00ff88]">R$ ${eur}</span></div>
                    <div class="px-6 border-r border-[#333] flex items-center gap-2"><span class="text-[10px] text-zinc-500">OURO:</span><span class="text-[11px] mono text-[var(--titan-gold)]">R$ ${gold}</span></div>
                    <div class="px-6 border-r border-[#333] flex items-center gap-2"><span class="text-[10px] text-zinc-500">LOCAL:</span><span class="text-[11px] mono text-white">${city}</span></div>
                    <div class="px-6 border-r border-[#333] flex items-center gap-2"><span class="text-[10px] text-zinc-500">CLIMA:</span><span class="text-[11px] mono text-blue-400">${temp}°C</span></div>
                `;

                document.getElementById('ticker-content').innerHTML = tickerItems + tickerItems;

            } catch (error) { console.error("Erro API", error); }
        }
        window.onload = updateTerminalData;
    </script>
</body>
</html>"""
}

def create_project(files, base_path="coach-tigrinho"):
    if not os.path.exists(base_path): os.makedirs(base_path)
    for filename, content in files.items():
        # Assegura que subdiretórios existam (se houver)
        os.makedirs(os.path.dirname(os.path.join(base_path, filename)), exist_ok=True)
        with open(os.path.join(base_path, filename), "w", encoding="utf-8") as f: f.write(content)
    print("✅ Projeto FINALIZADO com sucesso! (Index Unificado)")

if __name__ == "__main__": create_project(files)
```
```