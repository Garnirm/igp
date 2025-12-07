<template>
    <body class="text-slate-300 h-screen overflow-hidden selection:bg-amber-500 selection:text-black">
        <div id="app" class="flex h-full w-full">
            <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-20 shrink-0">
                <!-- Logo Area -->
                <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-800 bg-slate-950/50">
                    <div class="w-8 h-8 rounded bg-amber-600 text-white flex items-center justify-center font-bold text-sm shadow-lg">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div>
                        <span class="block font-bold text-white tracking-wider text-sm">DÉFENSE</span>
                        <span class="block text-[10px] text-amber-500 font-mono tracking-widest">OPS CENTER</span>
                    </div>
                </div>

                <!-- Nav Items -->
                <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-1">
                    <div class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2">Pilotage</div>
                    
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white bg-slate-800 border border-slate-700/50 shadow-sm transition">
                        <i class="fa-solid fa-chart-pie w-5 text-center text-amber-500"></i>
                        Vue Globale
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-sitemap w-5 text-center"></i>
                        Structure & OOB
                    </a>

                    <div class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2 mt-6">Gestion</div>

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-users-rectangle w-5 text-center"></i>
                        Ressources Humaines
                    </a>
                    
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-boxes-stacked w-5 text-center"></i>
                        Logistique & Stocks
                    </a>
                    
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-map-location-dot w-5 text-center"></i>
                        Opérations & Missions
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-user-doctor w-5 text-center"></i>
                        Santé Militaire
                    </a>

                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <i class="fa-solid fa-building-shield w-5 text-center"></i>
                        Infrastructures
                    </a>

                </nav>
                
                <!-- User Profile Bottom -->
                <div class="p-4 border-t border-slate-800 bg-slate-900/50">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full overflow-hidden border border-slate-700 bg-slate-800">
                            <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="Profile" class="w-full h-full object-cover opacity-80 hover:opacity-100 transition">
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate">Général Arkwright</p>
                            <p class="text-[10px] text-slate-500 truncate">Chef d'État-Major</p>
                        </div>
                        <button class="ml-auto text-slate-500 hover:text-white"><i class="fa-solid fa-gear"></i></button>
                    </div>
                </div>
            </aside>

            <!-- MAIN CONTENT (Vue Globale) -->
            <main class="flex-1 flex flex-col relative bg-slate-950 overflow-hidden">
                
                <!-- TOP BAR -->
                <header class="h-14 border-b border-slate-800 bg-slate-900/80 backdrop-blur flex items-center justify-between px-6 shrink-0">
                    <div class="flex items-center gap-4">
                        <h1 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                            Vue d'Ensemble des Forces
                        </h1>
                        <div class="h-5 w-px bg-slate-700"></div>
                        <span class="text-xs text-slate-400">État-Major des Armées (EMA)</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Status DEFCON -->
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-800 border border-slate-700 rounded text-amber-500">
                            <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                            <span class="text-xs font-bold font-mono">VIGIPIRATE : RENFORCÉ</span>
                        </div>
                        <span class="font-mono text-slate-400 text-sm">{{ currentTime }}</span>
                    </div>
                </header>

                <!-- CONTENT SCROLLABLE -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6">
                    
                    <!-- KPI GRID (Style Admin) -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Readiness -->
                        <div class="glass-panel p-4 rounded-xl flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full border-4 border-green-500/20 border-t-green-500 flex items-center justify-center">
                                <span class="text-xs font-bold text-green-500">92%</span>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-500 uppercase font-bold">Disponibilité OPS</p>
                                <p class="text-sm font-medium text-white">Nominale</p>
                            </div>
                        </div>
                        
                        <!-- RH Global (Total) -->
                        <div class="glass-panel p-4 rounded-xl">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold">Effectifs Totaux</p>
                                    <p class="text-xl font-bold text-white font-mono">215,400</p>
                                </div>
                                <i class="fa-solid fa-person-rifle text-slate-600"></i>
                            </div>
                            <div class="w-full bg-slate-800 h-1 rounded-full"><div class="bg-blue-500 h-1 rounded-full" style="width: 98%"></div></div>
                            <p class="text-[9px] text-slate-500 mt-1">Personnel Actif</p>
                        </div>

                        <!-- Budget -->
                        <div class="glass-panel p-4 rounded-xl">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <p class="text-[10px] text-slate-500 uppercase font-bold">Budget Défense</p>
                                    <p class="text-xl font-bold text-white font-mono">12.4 Mds</p>
                                </div>
                                <i class="fa-solid fa-coins text-slate-600"></i>
                            </div>
                            <p class="text-[10px] text-green-400 flex items-center gap-1"><i class="fa-solid fa-check"></i> Exécution conforme</p>
                        </div>

                        <!-- Alertes -->
                        <div class="glass-panel p-4 rounded-xl border-l-2 border-amber-500 bg-amber-500/5">
                            <div class="flex justify-between items-start mb-1">
                                <div>
                                    <p class="text-[10px] text-amber-500 uppercase font-bold">Points d'Attention</p>
                                    <p class="text-lg font-bold text-white">3 Critiques</p>
                                </div>
                                <i class="fa-solid fa-bell text-amber-500"></i>
                            </div>
                            <p class="text-[10px] text-slate-400">Logistique (2), Cyber (1)</p>
                        </div>
                    </div>

                    <!-- MAIN SECTION : CARTE & OPÉRATIONS -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-96">
                        
                        <!-- Carte Administrative -->
                        <div class="lg:col-span-2 glass-panel rounded-xl flex flex-col overflow-hidden relative">
                            <div class="absolute top-4 left-4 z-10 flex gap-2">
                                <div class="px-3 py-1 bg-slate-900/90 backdrop-blur rounded border border-slate-700 text-xs text-white shadow-lg">
                                    <i class="fa-solid fa-layer-group text-amber-500 mr-2"></i> Déploiements Actuels
                                </div>
                            </div>
                            
                            <!-- Map Placeholder -->
                            <div class="flex-1 bg-slate-900 relative">
                                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                                    class="w-full h-full object-cover opacity-30 grayscale invert">
                                
                                <!-- Unit Markers -->
                                <div class="absolute top-1/4 left-1/3 flex flex-col items-center group cursor-pointer">
                                    <div class="w-3 h-3 bg-green-500 rounded-full border-2 border-slate-900 shadow-lg"></div>
                                    <div class="mt-1 px-2 py-1 bg-slate-900 text-[10px] text-white rounded border border-slate-700 hidden group-hover:block whitespace-nowrap z-20">
                                        <strong>2e Div. Blindée</strong><br>Base Nord - Entrainement
                                    </div>
                                </div>

                                <div class="absolute bottom-1/3 right-1/4 flex flex-col items-center group cursor-pointer">
                                    <div class="w-3 h-3 bg-amber-500 rounded-full border-2 border-slate-900 shadow-lg animate-pulse"></div>
                                    <div class="mt-1 px-2 py-1 bg-slate-900 text-[10px] text-white rounded border border-slate-700 z-20">
                                        <strong>OPEX: Sentinelle</strong><br>Déploiement en cours
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Liste des Opérations -->
                        <div class="glass-panel rounded-xl flex flex-col">
                            <div class="p-4 border-b border-slate-800 flex justify-between items-center">
                                <h3 class="text-sm font-bold text-white">Opérations & Missions</h3>
                                <button class="text-xs text-blue-400 hover:text-blue-300">Voir Planning</button>
                            </div>
                            <div class="flex-1 overflow-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-900 text-[10px] uppercase text-slate-500 font-bold sticky top-0">
                                        <tr>
                                            <th class="px-4 py-2">Nom</th>
                                            <th class="px-4 py-2 text-center">Type</th>
                                            <th class="px-4 py-2 text-right">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-xs divide-y divide-slate-800">
                                        <tr class="hover:bg-slate-800/50 transition">
                                            <td class="px-4 py-3 font-medium text-white">Sécurisation Frontière</td>
                                            <td class="px-4 py-3 text-center text-slate-400">Défense</td>
                                            <td class="px-4 py-3 text-right"><span class="badge-status bg-green-500/10 text-green-400 border border-green-500/20">En cours</span></td>
                                        </tr>
                                        <tr class="hover:bg-slate-800/50 transition">
                                            <td class="px-4 py-3 font-medium text-white">Exercice Tonnerre</td>
                                            <td class="px-4 py-3 text-center text-slate-400">Entrainement</td>
                                            <td class="px-4 py-3 text-right"><span class="badge-status bg-blue-500/10 text-blue-400 border border-blue-500/20">Planifié</span></td>
                                        </tr>
                                        <tr class="hover:bg-slate-800/50 transition">
                                            <td class="px-4 py-3 font-medium text-white">Vigie Cyber</td>
                                            <td class="px-4 py-3 text-center text-slate-400">Renseignement</td>
                                            <td class="px-4 py-3 text-right"><span class="badge-status bg-purple-500/10 text-purple-400 border border-purple-500/20">Permanent</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- BOTTOM ROW: LOGISTIQUE & RH -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        
                        <!-- Alertes Logistiques -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-warehouse text-slate-500"></i> État des Stocks Critiques
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-slate-300">Munitions (Standard 5.56)</span>
                                        <span class="text-red-400 font-bold">BAS (15%)</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-red-500 h-full w-[15%]"></div>
                                    </div>
                                    <p class="text-[9px] text-slate-500 mt-1">Commande en cours (Livraison J+5)</p>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-slate-300">Carburant Aviation (JP-8)</span>
                                        <span class="text-amber-500 font-bold">MOYEN (45%)</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-amber-500 h-full w-[45%]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Synthèse RH (Catégorisée) -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-users text-slate-500"></i> Répartition des Effectifs
                            </h3>
                            <div class="grid grid-cols-2 gap-4">
                                <apexchart type="donut" height="140" class="h-32" :options="options" :series="series"></apexchart>

                                <div class="space-y-2 flex flex-col justify-center">
                                    <div class="flex justify-between items-center text-xs p-2 bg-slate-800/50 rounded border border-slate-800 border-l-4 border-l-green-500">
                                        <span class="text-slate-300">Militaires</span>
                                        <span class="text-white font-mono font-bold">142,050</span>
                                    </div>
                                    <div class="flex justify-between items-center text-xs p-2 bg-slate-800/50 rounded border border-slate-800 border-l-4 border-l-blue-500">
                                        <span class="text-slate-300">Police / Gend.</span>
                                        <span class="text-white font-mono font-bold">54,120</span>
                                    </div>
                                    <div class="flex justify-between items-center text-xs p-2 bg-slate-800/50 rounded border border-slate-800 border-l-4 border-l-slate-500">
                                        <span class="text-slate-300">Civils Défense</span>
                                        <span class="text-white font-mono font-bold">19,230</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return {
            currentTime: '',
            timer: null,

            options: {},
            series: [],
        }
    },
    methods: {
        updateTime() {
            const now = new Date();
            this.currentTime = now.toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});
        },
        initCharts() {
            this.series = [66, 25, 9]

            this.options = {
                labels: ['Militaires', 'Police', 'Civils'],
                chart: { type: 'donut', height: 140, background: 'transparent' },
                colors: ['#10b981', '#3b82f6', '#64748b'], // Green, Blue, Slate
                legend: { show: false },
                stroke: { show: false },
                dataLabels: { enabled: false },
                theme: { mode: 'dark' },
                plotOptions: { pie: { donut: { size: '65%' } } }
            }
        }
    },
    created() {
        this.updateTime();
        this.timer = setInterval(this.updateTime, 1000);
        this.initCharts();
    }
}
</script>

<style scoped>
.glass-panel {
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(51, 65, 85, 0.5);
}

/* Badges Statut */
.badge-status {
    padding: 2px 6px;
    border-radius: 999px;
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}
</style>