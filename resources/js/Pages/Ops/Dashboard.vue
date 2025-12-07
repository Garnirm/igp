<template>
    <body class="text-slate-300 h-screen overflow-hidden selection:bg-amber-500 selection:text-black">
        <div id="app" class="flex h-full w-full">
            
            <!-- SIDEBAR -->
            <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-20 shrink-0">
                <!-- Logo -->
                <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-800 bg-slate-950/50">
                    <div class="w-8 h-8 rounded bg-amber-500 text-black flex items-center justify-center font-bold text-lg shadow-[0_0_15px_rgba(245,158,11,0.4)]">D</div>
                    <div>
                        <span class="block font-bold text-white tracking-wider text-sm">DRAREKSTANIE</span>
                        <span class="block text-[10px] text-amber-500 font-mono tracking-widest">GOD_MODE</span>
                    </div>
                </div>

                <!-- Menu Dynamique -->
                <nav class="flex-1 overflow-y-auto py-4 space-y-1">
                    <template v-for="(section, index) in menuStructure" :key="index">
                        <div class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-2" :class="{ 'mt-6': index > 0, 'mt-2': index === 0 }">
                            {{ section.title }}
                        </div>
                        <a v-for="item in section.items" :key="item.label" :href="item.url" 
                            class="sidebar-item flex items-center gap-3 px-6 py-2 text-sm"
                            :class="item.active ? 'active font-medium text-white' : 'text-slate-400'"
                        >
                            <i :class="item.icon + ' w-4 text-center'"></i> {{ item.label }}
                        </a>
                    </template>
                </nav>

                <!-- Admin Profile / Settings Trigger -->
                <div class="relative p-4 border-t border-slate-800 bg-slate-900/50">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded bg-slate-700 flex items-center justify-center">
                            <i class="fa-solid fa-user-tie text-white text-xs"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate">Administrateur</p>
                            <p class="text-[10px] text-amber-500 truncate">Niveau 10 - Suprême</p>
                        </div>
                        <button @click.stop="toggleSettings" class="ml-auto text-slate-400 hover:text-white transition rotate-hover">
                            <i class="fa-solid fa-gear"></i>
                        </button>
                    </div>

                    <!-- Settings Popover Menu -->
                    <transition name="fade">
                        <div v-if="isSettingsOpen" class="absolute bottom-full left-4 right-4 mb-2 bg-slate-800 border border-slate-700 rounded-lg shadow-2xl overflow-hidden z-50">
                            <div class="p-3 border-b border-slate-700 bg-slate-800/50">
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Système</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-xs text-slate-300 hover:bg-slate-700 hover:text-white flex items-center gap-2">
                                <i class="fa-solid fa-palette w-4"></i> Préférences Interface
                            </a>
                            <a href="#" class="block px-4 py-2 text-xs text-slate-300 hover:bg-slate-700 hover:text-white flex items-center gap-2">
                                <i class="fa-solid fa-key w-4"></i> Clés API & Sécurité
                            </a>
                            <div class="border-t border-slate-700 mt-1">
                                <a href="#" class="block px-4 py-3 text-xs text-red-400 hover:bg-red-900/20 hover:text-red-300 flex items-center gap-2">
                                    <i class="fa-solid fa-power-off w-4"></i> Déconnexion
                                </a>
                            </div>
                        </div>
                    </transition>
                </div>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="flex-1 flex flex-col relative overflow-hidden bg-slate-950">
                
                <!-- HEADER -->
                <header class="h-16 border-b border-slate-800 bg-slate-900/80 backdrop-blur flex items-center justify-between px-6 z-10">
                    <!-- Search Trigger -->
                    <button @click="toggleSearch" class="flex items-center gap-3 w-1/3 text-left group">
                        <div class="relative w-full">
                            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs group-hover:text-amber-500 transition"></i>
                            <div class="w-full bg-slate-800 border border-slate-700 text-slate-400 text-xs rounded-full py-2 pl-9 pr-4 group-hover:border-amber-500/50 transition cursor-text flex justify-between items-center">
                                <span>Rechercher (Citoyen, Dossier, Loi...)</span>
                                <span class="text-[10px] border border-slate-600 rounded px-1.5 py-0.5 font-mono">CTRL+K</span>
                            </div>
                        </div>
                    </button>

                    <!-- Status -->
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2 px-3 py-1 bg-green-900/20 border border-green-500/30 rounded text-green-500">
                            <i class="fa-solid fa-shield-heart text-xs animate-pulse"></i>
                            <span class="text-xs font-bold font-mono">DEFCON 5</span>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-400 font-medium">{{ currentDate }}</p>
                            <p class="text-sm font-mono text-white font-bold">{{ currentTime }}</p>
                        </div>
                    </div>
                </header>

                <!-- DASHBOARD BODY -->
                <div class="flex-1 overflow-y-auto p-6 space-y-6">

                    <!-- KPI Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div v-for="kpi in kpis" :key="kpi.title" class="kpi-card p-4 rounded-xl relative overflow-hidden group">
                            <div class="flex justify-between items-start z-10 relative">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-semibold">{{ kpi.title }}</p>
                                    <h3 class="text-2xl font-bold mt-1" :class="kpi.colorClass || 'text-white'">{{ kpi.value }}</h3>
                                    <p class="text-xs mt-1 flex items-center gap-1" :class="kpi.trendClass">
                                        <i :class="kpi.trendIcon"></i> {{ kpi.trend }}
                                    </p>
                                </div>
                                <div class="w-8 h-8 rounded flex items-center justify-center border" 
                                    :class="[kpi.iconBg, kpi.iconColor, kpi.iconBorder]">
                                    <i :class="kpi.icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CHART & MAP ROW -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-96">
                        <!-- Main Chart -->
                        <div class="lg:col-span-2 glass-panel rounded-xl p-5 flex flex-col">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                    <i class="fa-solid fa-chart-area text-slate-500"></i> Balance Commerciale & Fiscale
                                </h3>
                            </div>
                            <div class="flex-1 w-full">
                                <apexchart height="300" type="area" :options="options" :series="series"></apexchart>
                            </div>
                        </div>

                        <!-- MAP -->
                        <div class="glass-panel rounded-xl p-0 overflow-hidden relative flex flex-col">
                            <div class="absolute top-4 left-4 z-10 bg-slate-900/80 backdrop-blur px-3 py-1 rounded border border-slate-700">
                                <span class="text-[10px] font-bold text-slate-300 uppercase"><i class="fa-solid fa-satellite-dish mr-1 text-green-500"></i> Live SAT-3</span>
                            </div>
                            <div class="flex-1 bg-slate-900 relative">
                                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-40 grayscale invert brightness-50">
                                <!-- Heatmap effect -->
                                <div class="absolute top-1/3 left-1/4 w-24 h-24 bg-red-500/30 rounded-full blur-xl animate-pulse"></div>
                                <div class="absolute top-1/3 left-1/4 w-2 h-2 bg-red-500 rounded-full border border-white shadow-[0_0_10px_red]"></div>

                                <div class="absolute bottom-0 left-0 right-0 bg-slate-900/90 p-4 border-t border-slate-800">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-[10px] text-slate-400 uppercase tracking-widest">Alerte Prioritaire</p>
                                            <p class="text-xs font-bold text-white">Mouvements sociaux majeurs - Région Capitale</p>
                                        </div>
                                        <span class="px-2 py-1 bg-red-500/20 text-red-400 text-[10px] font-bold rounded border border-red-500/30">NIV 3</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FEED & INFRA -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        
                        <!-- Feed -->
                        <div class="lg:col-span-2 glass-panel rounded-xl p-5">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                                    <i class="fa-solid fa-list-ul text-slate-500"></i> Fil Stratégique National
                                </h3>
                                <span class="px-2 py-1 bg-slate-800 rounded text-[10px] text-slate-400 border border-slate-700">Filtre : <span class="text-amber-500">Critique</span></span>
                            </div>
                            <div class="space-y-0">
                                <div v-for="(item, i) in feedItems" :key="i" class="flex gap-4 p-3 border-b border-slate-800 hover:bg-slate-800/30 transition last:border-0">
                                    <span class="text-[10px] font-mono text-slate-500 mt-1">{{ item.time }}</span>
                                    <div class="flex-1">
                                        <p class="text-xs text-slate-200">
                                            <span class="font-bold" :class="item.tagClass">[{{ item.tag }}]</span> {{ item.text }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Infra Status -->
                        <div class="glass-panel rounded-xl p-5 flex flex-col justify-between">
                            <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-server text-slate-500"></i> Infrastructures Vitales
                            </h3>
                            <div class="space-y-5">
                                <div v-for="infra in infraStats" :key="infra.label">
                                    <div class="flex justify-between text-xs mb-1">
                                        <span class="text-slate-400">{{ infra.label }}</span>
                                        <span class="font-mono font-bold" :class="infra.textClass">{{ infra.value }}</span>
                                    </div>
                                    <div class="w-full bg-slate-800 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full" :class="infra.barClass" :style="{ width: infra.percent }"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-800 text-[10px] text-slate-500 flex items-center gap-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                                Mise à jour temps réel activée
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <!-- COMMAND PALETTE MODAL -->
            <transition name="fade">
                <div v-if="isSearchOpen" @click="toggleSearch" class="fixed inset-0 z-50 cmd-palette-overlay flex items-start justify-center pt-24 px-4">
                    <div class="bg-slate-900 w-full max-w-2xl rounded-xl shadow-2xl border border-slate-700 overflow-hidden" @click.stop>
                        <!-- Input -->
                        <div class="flex items-center gap-4 px-4 py-4 border-b border-slate-700">
                            <i class="fa-solid fa-search text-slate-400 text-lg"></i>
                            <input type="text" placeholder="Tapez une commande ou recherchez..." class="bg-transparent border-none outline-none text-white text-lg w-full placeholder-slate-500" autofocus ref="searchInput">
                            <button @click="toggleSearch" class="text-xs bg-slate-800 text-slate-400 px-2 py-1 rounded">ESC</button>
                        </div>
                        <!-- Results (Simulated) -->
                        <div class="p-2">
                            <div class="text-[10px] font-bold text-slate-500 uppercase px-3 py-2">Suggestions</div>
                            <a href="#" class="flex items-center justify-between px-3 py-3 hover:bg-slate-800 rounded group cursor-pointer">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded bg-blue-500/20 text-blue-400 flex items-center justify-center"><i class="fa-solid fa-user"></i></div>
                                    <span class="text-sm text-slate-300 group-hover:text-white">Rechercher un Citoyen (NIR)</span>
                                </div>
                                <span class="text-xs text-slate-600">Base Nationale</span>
                            </a>
                            <div class="text-[10px] font-bold text-slate-500 uppercase px-3 py-2 mt-2">Actions Système</div>
                            <a href="#" class="flex items-center gap-3 px-3 py-3 hover:bg-slate-800 rounded group cursor-pointer text-slate-300">
                                <i class="fa-solid fa-gear text-slate-500 w-6 text-center"></i>
                                <span class="text-sm group-hover:text-white">Configuration du Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </body>
</template>

<script>
export default {
    data: function () {
        return {
            currentTime: '',
            currentDate: '',
            timer: null,
            isSettingsOpen: false,
            isSearchOpen: false,
            chart: null,

            options: [],
            series: [],

            menuStructure: [
                {
                    title: 'Vue Globale',
                    items: [
                        { label: 'Dashboard', icon: 'fa-solid fa-chart-line', active: true, url: '/ops' }
                    ]
                },
                {
                    title: 'Régalien',
                    items: [
                        { label: 'Armée & Police', icon: 'fa-solid fa-person-military-rifle', active: false },
                        { label: 'Justice', icon: 'fa-solid fa-scale-balanced', active: false },
                        { label: 'Diplomatie', icon: 'fa-solid fa-handshake', active: false },
                        { label: 'Législatif', icon: 'fa-solid fa-gavel', active: false },
                        { label: 'Politique', icon: 'fa-solid fa-landmark-dome', active: false },
                        { label: 'Infrastructures', icon: 'fa-solid fa-bridge-water', active: false },
                        { label: 'Environnement', icon: 'fa-solid fa-leaf', active: false },
                    ]
                },
                {
                    title: 'Civil & Éco',
                    items: [
                        { label: 'Finances', icon: 'fa-solid fa-coins', active: false },
                        { label: 'Population', icon: 'fa-solid fa-users', active: false },
                        { label: 'Territoire', icon: 'fa-solid fa-map-location-dot', active: false, url: '/ops/territory' },
                        { label: 'Santé', icon: 'fa-solid fa-heart-pulse', active: false },
                        { label: 'Entreprises', icon: 'fa-solid fa-industry', active: false },
                    ]
                }
            ],
            kpis: [
                { 
                    title: 'Population', value: '1.24 Md', trend: '+0.4%', 
                    trendClass: 'text-green-400', trendIcon: 'fa-solid fa-arrow-trend-up',
                    icon: 'fa-solid fa-users', iconBg: 'bg-blue-500/10', iconColor: 'text-blue-400', iconBorder: 'border-blue-500/20'
                },
                { 
                    title: 'Trésor Public', value: '45.2 Mds ₯', trend: '-1.2%', 
                    trendClass: 'text-red-400', trendIcon: 'fa-solid fa-arrow-trend-down',
                    icon: 'fa-solid fa-sack-dollar', iconBg: 'bg-emerald-500/10', iconColor: 'text-emerald-400', iconBorder: 'border-emerald-500/20'
                },
                { 
                    title: 'Alertes Stratégiques', value: '2', trend: 'Niveau Fédéral', 
                    trendClass: 'text-slate-400', trendIcon: '', colorClass: 'text-amber-500',
                    icon: 'fa-solid fa-triangle-exclamation', iconBg: 'bg-amber-500/10', iconColor: 'text-amber-400', iconBorder: 'border-amber-500/20'
                },
                { 
                    title: 'Approbation', value: '62.4%', trend: 'Stable', 
                    trendClass: 'text-green-400', trendIcon: '',
                    icon: 'fa-solid fa-chart-pie', iconBg: 'bg-purple-500/10', iconColor: 'text-purple-400', iconBorder: 'border-purple-500/20'
                },
            ],
            feedItems: [
                { time: '21:42', tag: 'CYBER', tagClass: 'text-red-400', text: 'Tentative d\'intrusion détectée sur le réseau Énergie (DDoS - 400 Gbps). Mitigée.' },
                { time: '21:30', tag: 'DIPLOMATIE', tagClass: 'text-purple-400', text: 'Ratification du traité commercial "Nord-Alliance" par le Sénat.' },
                { time: '21:15', tag: 'ÉCO', tagClass: 'text-emerald-400', text: 'Rapport Trimestriel : Excédent budgétaire confirmé (+0.2%).' }
            ],
            infraStats: [
                { label: 'Charge Réseau Électrique', value: '82%', percent: '82%', textClass: 'text-amber-500', barClass: 'bg-amber-500' },
                { label: 'Taux de Chômage', value: '5.4%', percent: '15%', textClass: 'text-blue-400', barClass: 'bg-blue-400' },
                { label: 'Occupation Lits Hôpitaux', value: '45%', percent: '45%', textClass: 'text-green-500', barClass: 'bg-green-500' },
                { label: 'Bande Passante Nat.', value: '98 Tbps', percent: '60%', textClass: 'text-purple-400', barClass: 'bg-purple-400' },
            ],
        }
    },
    mounted: function () {
        this.updateClock();
        this.timer = setInterval(this.updateClock, 1000);

        this.initChart();

        document.addEventListener('keydown', this.closeAll);

        document.addEventListener('click', (e) => {
            if (this.isSettingsOpen) this.isSettingsOpen = false;
        })
    },
    methods: {
        updateClock() {
            const now = new Date();
            this.currentTime = now.toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit', second:'2-digit'});
            this.currentDate = now.toLocaleDateString('fr-FR', {day: 'numeric', month: 'long', year: 'numeric'});
        },
        toggleSettings() {
            this.isSettingsOpen = !this.isSettingsOpen;
            if(this.isSettingsOpen) this.isSearchOpen = false;
        },
        toggleSearch() {
            this.isSearchOpen = !this.isSearchOpen;
            if(this.isSearchOpen) {
                this.isSettingsOpen = false;

                this.$nextTick(() => {
                    if(this.$refs.searchInput) this.$refs.searchInput.focus();
                });
            }
        },
        closeAll(e) {
            if (e.key === 'Escape') {
                this.isSearchOpen = false;
                this.isSettingsOpen = false;
            }

            if (e.ctrlKey && e.key === 'k') {
                e.preventDefault();
                this.toggleSearch();
            }
        },
        initChart() {
            this.options = {
                chart: { type: 'area', toolbar: { show: false }, background: 'transparent', fontFamily: 'Inter, sans-serif' },
                colors: ['#10b981', '#ef4444'],
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.3, opacityTo: 0.05, stops: [0, 90, 100] } },
                xaxis: { categories: ['J-6', 'J-5', 'J-4', 'J-3', 'J-2', 'Hier', 'Auj'], labels: { style: { colors: '#64748b' } }, axisBorder: { show: false }, axisTicks: { show: false } },
                yaxis: { labels: { style: { colors: '#64748b' } } },
                grid: { borderColor: '#1e293b', strokeDashArray: 4 },
                theme: { mode: 'dark' },
                legend: { labels: { colors: '#94a3b8' } }
            }

            this.series = [{ name: 'Revenus', data: [31, 40, 28, 51, 42, 109, 100] }, { name: 'Dépenses', data: [11, 32, 45, 32, 34, 52, 41] }]
        },
    },
}
</script>

<style scoped>
.glass-panel {
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(51, 65, 85, 0.5);
}

.sidebar-item {
    position: relative;
    transition: all 0.2s;
}

.sidebar-item:hover, .sidebar-item.active {
    background: rgba(255, 255, 255, 0.05);
    color: #fbbf24;
}

.sidebar-item.active::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: #fbbf24;
    box-shadow: 0 0 10px #fbbf24;
}

.kpi-card {
    background: linear-gradient(180deg, rgba(30, 41, 59, 0.4) 0%, rgba(15, 23, 42, 0.4) 100%);
    border: 1px solid rgba(255,255,255,0.05);
}

.cmd-palette-overlay {
    background: rgba(2, 6, 23, 0.8);
    backdrop-filter: blur(4px);
}

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>