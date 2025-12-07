<template>
    <body class="text-slate-300 h-screen overflow-hidden selection:bg-amber-500 selection:text-black">
        <div id="app" class="flex h-full w-full">
            
            <!-- SIDEBAR (Placeholder) -->
            <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-20 shrink-0 hidden md:flex">
                <div class="h-16 flex items-center gap-3 px-6 border-b border-slate-800 bg-slate-950/50">
                    <div class="w-8 h-8 rounded bg-amber-500 text-black flex items-center justify-center font-bold text-lg">D</div>
                    <span class="font-bold text-white tracking-wider text-sm">DRAREKSTANIE</span>
                </div>
                <nav class="p-4 space-y-1">
                    <a href="/ops" class="block px-4 py-2 text-sm text-slate-400 hover:text-white"><i class="fa-solid fa-chart-line w-5"></i> Dashboard</a>
                    <a href="/ops/territory" class="block px-4 py-2 text-sm text-white bg-slate-800 rounded"><i class="fa-solid fa-map-location-dot w-5 text-amber-500"></i> Territoire</a>
                </nav>
            </aside>

            <main class="flex-1 flex flex-col relative overflow-hidden bg-slate-950">
                <header class="h-16 border-b border-slate-800 bg-slate-900/80 backdrop-blur flex items-center justify-between px-6 shrink-0">
                    <div class="flex items-center gap-4">
                        <h1 class="text-lg font-bold text-white tracking-tight flex items-center gap-2">
                            <i class="fa-solid fa-earth-europe text-amber-500"></i> Gestion du Territoire
                        </h1>
                        <div class="h-6 w-px bg-slate-700"></div>
                        <div class="flex text-xs text-slate-500 gap-2">
                            <span>Administration Fédérale</span>
                            <i class="fa-solid fa-chevron-right text-[10px] mt-0.5"></i>
                            <span class="text-slate-300">Vue Globale</span>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded text-xs text-white transition flex items-center gap-2">
                            <i class="fa-solid fa-download"></i> Exporter
                        </button>
                        <!-- BOUTON CONTEXTUEL -->
                        <button @click="openDrawer" class="px-3 py-1.5 bg-amber-600 hover:bg-amber-500 text-white rounded text-xs font-bold transition flex items-center gap-2 shadow-lg shadow-amber-900/20">
                            <i class="fa-solid fa-plus"></i> 
                            {{ currentTab === 'states' ? 'Nouvel État' : 'Nouvelle Ville' }}
                        </button>
                    </div>
                </header>

                <!-- TOOLBAR & FILTERS -->
                <div class="flex flex-col border-b border-slate-800 bg-slate-900/30">
                    <div class="p-6 pb-0 flex flex-col md:flex-row justify-between items-end md:items-center gap-4">
                        
                        <!-- Tabs -->
                        <div class="flex gap-6 w-full md:w-auto">
                            <button @click="currentTab = 'states'; showFilters = false" 
                                    class="pb-3 text-sm font-medium transition flex items-center gap-2"
                                    :class="currentTab === 'states' ? 'tab-active' : 'tab-inactive'">
                                <i class="fa-solid fa-flag"></i> États Fédéraux <span class="bg-slate-800 text-slate-400 px-1.5 py-0.5 rounded text-[10px] ml-1">{{ states.length }}</span>
                            </button>
                            <button @click="currentTab = 'cities'; showFilters = false" 
                                    class="pb-3 text-sm font-medium transition flex items-center gap-2"
                                    :class="currentTab === 'cities' ? 'tab-active' : 'tab-inactive'">
                                <i class="fa-solid fa-city"></i> Villes <span class="bg-slate-800 text-slate-400 px-1.5 py-0.5 rounded text-[10px] ml-1">{{ cities.length }}</span>
                            </button>
                        </div>

                        <!-- Search & Filter Toggle -->
                        <div class="flex gap-3 w-full md:w-auto pb-2">
                            <div class="relative w-full md:w-64">
                                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                                <input type="text" v-model="searchQuery" placeholder="Rechercher..." 
                                    class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-lg py-2 pl-9 pr-4 focus:ring-1 focus:ring-amber-500 focus:border-amber-500 outline-none transition">
                            </div>
                            <button @click="showFilters = !showFilters" 
                                    class="px-3 py-2 bg-slate-800 border border-slate-700 rounded-lg text-slate-400 hover:text-white transition"
                                    :class="{'bg-slate-700 text-white border-amber-500': showFilters}">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                        </div>
                    </div>

                    <!-- PANNEAU FILTRES AVANCÉS (Toggle) -->
                    <div v-if="showFilters" class="p-4 bg-slate-900/80 border-t border-slate-800 grid grid-cols-1 md:grid-cols-4 gap-4 animate-in fade-in slide-in-from-top-2 duration-200">
                        
                        <!-- Filtres États -->
                        <template v-if="currentTab === 'states'">
                            <div>
                                <label class="text-[10px] uppercase text-slate-500 font-bold mb-1 block">Statut Politique</label>
                                <select class="w-full bg-slate-800 border border-slate-700 rounded px-2 py-1.5 text-xs text-white">
                                    <option value="">Tous</option>
                                    <option value="stable">Stable</option>
                                    <option value="warning">Sous Tension</option>
                                    <option value="critical">État d'Urgence</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] uppercase text-slate-500 font-bold mb-1 block">Tendance Budgétaire</label>
                                <select class="w-full bg-slate-800 border border-slate-700 rounded px-2 py-1.5 text-xs text-white">
                                    <option value="">Toutes</option>
                                    <option value="positive">Excédentaire (+)</option>
                                    <option value="negative">Déficitaire (-)</option>
                                </select>
                            </div>
                        </template>

                        <!-- Filtres Villes -->
                        <template v-if="currentTab === 'cities'">
                            <div>
                                <label class="text-[10px] uppercase text-slate-500 font-bold mb-1 block">Niveau de Sécurité</label>
                                <select class="w-full bg-slate-800 border border-slate-700 rounded px-2 py-1.5 text-xs text-white">
                                    <option value="">Tous les niveaux</option>
                                    <option value="1">Calme</option>
                                    <option value="3">Émeutes</option>
                                    <option value="4">Critique</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-[10px] uppercase text-slate-500 font-bold mb-1 block">Population Min.</label>
                                <input type="number" placeholder="Ex: 100000" class="w-full bg-slate-800 border border-slate-700 rounded px-2 py-1.5 text-xs text-white">
                            </div>
                        </template>
                        
                        <div class="flex items-end">
                            <button class="text-xs text-amber-500 hover:text-amber-400 font-medium underline">Réinitialiser les filtres</button>
                        </div>
                    </div>
                </div>

                <!-- CONTENT AREA -->
                <div class="flex-1 overflow-y-auto p-6">

                    <!-- VUE ÉTATS -->
                    <transition name="fade" mode="out-in">
                        <div v-if="currentTab === 'states'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <div v-for="state in filteredStates" :key="state.id" @click="accessState(state.id)" class="state-card bg-slate-900 rounded-xl p-5 relative overflow-hidden group cursor-pointer">
                                <!-- Background Flag Effect -->
                                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-slate-800 to-transparent rounded-bl-full opacity-20 group-hover:opacity-40 transition"></div>
                                
                                <!-- Header (Modifié: Suppression logo) -->
                                <div class="flex justify-between items-start mb-4 relative z-10">
                                    <h3 class="text-lg font-bold text-white group-hover:text-amber-500 transition">{{ state.name }}</h3>
                                    <div class="text-right">
                                        <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-500">Budget</span>
                                        <span class="text-sm font-mono" :class="state.budgetStatus === 'positive' ? 'text-green-400' : 'text-red-400'">
                                            {{ state.budgetStatus === 'positive' ? '+' : '-' }}{{ state.budgetTrend }}%
                                        </span>
                                    </div>
                                </div>

                                <p class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                                    <i class="fa-solid fa-landmark text-[10px]"></i> Capitale: <span class="text-slate-300">{{ state.capital }}</span>
                                </p>

                                <!-- Mini Stats Grid -->
                                <div class="grid grid-cols-2 gap-2 mb-4">
                                    <div class="bg-slate-800/50 p-2 rounded border border-slate-700/50">
                                        <span class="block text-[10px] text-slate-500">Population</span>
                                        <span class="block text-xs font-mono font-bold text-white">{{ formatNumber(state.population) }}</span>
                                    </div>
                                    <div class="bg-slate-800/50 p-2 rounded border border-slate-700/50">
                                        <span class="block text-[10px] text-slate-500">PIB/Hab</span>
                                        <span class="block text-xs font-mono font-bold text-amber-500">{{ state.gdp }} ₯</span>
                                    </div>
                                </div>

                                <!-- Governor & Status -->
                                <div class="flex justify-between items-center pt-3 border-t border-slate-800">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-700 overflow-hidden flex items-center justify-center">
                                            <span class="text-[10px] font-bold text-slate-400">{{ getInitials(state.governor) }}</span>
                                        </div>
                                        <div class="text-xs">
                                            <p class="text-slate-300 font-medium">{{ state.governor }}</p>
                                            <p class="text-[9px] text-slate-500">Gouverneur</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold border" :class="getStatusClass(state.status)">
                                        {{ state.statusText }}
                                    </span>
                                </div>
                            </div>

                            <!-- Add State Card (Ghost - Ouvre le Drawer) -->
                            <div @click="openDrawer" class="border-2 border-dashed border-slate-700 hover:border-amber-500/50 rounded-xl p-5 flex flex-col items-center justify-center text-slate-500 hover:text-amber-500 hover:bg-slate-800/20 transition cursor-pointer group h-full min-h-[200px]">
                                <div class="w-12 h-12 rounded-full bg-slate-800 group-hover:bg-amber-500/10 flex items-center justify-center mb-3 transition">
                                    <i class="fa-solid fa-plus text-xl"></i>
                                </div>
                                <span class="text-sm font-bold">Ajouter un État</span>
                            </div>

                        </div>
                    </transition>

                    <!-- VUE VILLES -->
                    <transition name="fade" mode="out-in">
                        <div v-if="currentTab === 'cities'" class="glass-panel rounded-xl overflow-hidden flex flex-col h-full">
                            
                            <!-- Table -->
                            <div class="overflow-auto flex-grow">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-slate-800/80 text-xs uppercase text-slate-400 sticky top-0 z-10 backdrop-blur">
                                        <tr>
                                            <th class="p-4 font-semibold border-b border-slate-700">Ville</th>
                                            <th class="p-4 font-semibold border-b border-slate-700">État Fédéral</th>
                                            <th class="p-4 font-semibold border-b border-slate-700 text-right">Population</th>
                                            <th class="p-4 font-semibold border-b border-slate-700">Maire</th>
                                            <th class="p-4 font-semibold border-b border-slate-700 text-center">Sécurité</th>
                                            <th class="p-4 font-semibold border-b border-slate-700 text-right">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm divide-y divide-slate-800">
                                        <tr v-for="city in paginatedCities" :key="city.id" class="table-row group transition cursor-pointer">
                                            <td class="p-4">
                                                <div class="font-bold text-white">{{ city.name }}</div>
                                                <div class="text-[10px] text-slate-500" v-if="city.isCapital"><i class="fa-solid fa-star text-amber-500 mr-1"></i>Capitale d'État</div>
                                            </td>
                                            <td class="p-4 text-slate-300">
                                                <span class="px-2 py-1 rounded bg-slate-800 border border-slate-700 text-xs">{{ city.stateName }}</span>
                                            </td>
                                            <td class="p-4 text-right font-mono text-slate-300">{{ formatNumber(city.population) }}</td>
                                            <td class="p-4 text-slate-400">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-5 h-5 rounded-full bg-slate-700 flex-shrink-0 flex items-center justify-center text-[9px] font-bold text-slate-400">
                                                        {{ getInitials(city.mayor) }}
                                                    </div>
                                                    {{ city.mayor }}
                                                </div>
                                            </td>
                                            <td class="p-4 text-center">
                                                <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-[10px] font-bold border" :class="getSecurityClass(city.securityLevel)">
                                                    <span class="w-1.5 h-1.5 rounded-full" :class="getSecurityDot(city.securityLevel)"></span>
                                                    {{ city.securityText }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-right">
                                                <a :href="'/ops/territory/city/'+city.id" class="text-slate-500 hover:text-blue-500 transition px-2"><i class="fa-solid fa-pen"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- PAGINATION FOOTER -->
                            <div class="p-3 bg-slate-900/50 border-t border-slate-700 flex justify-between items-center text-xs">
                                <span class="text-slate-500">Affichage de <span class="text-white">{{ paginatedCities.length }}</span> sur {{ filteredCities.length }} résultats</span>
                                <div class="flex gap-2">
                                    <button @click="prevPage" :disabled="currentPage === 1" class="px-3 py-1 bg-slate-800 hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed rounded text-slate-300 transition">
                                        <i class="fa-solid fa-chevron-left mr-1"></i> Précédent
                                    </button>
                                    <span class="flex items-center px-2 text-slate-400">Page {{ currentPage }} / {{ totalPages }}</span>
                                    <button @click="nextPage" :disabled="currentPage === totalPages" class="px-3 py-1 bg-slate-800 hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed rounded text-slate-300 transition">
                                        Suivant <i class="fa-solid fa-chevron-right ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </transition>

                </div>

                <!-- DRAWER / PANEL LATÉRAL (Ajout/Edition) -->
                <transition name="fade">
                    <div v-if="isDrawerOpen" class="absolute inset-0 z-40 bg-slate-950/50 backdrop-blur-sm" @click="closeDrawer"></div>
                </transition>
                <transition name="slide">
                    <div v-if="isDrawerOpen" class="absolute inset-y-0 right-0 z-50 w-full max-w-md bg-slate-900 border-l border-slate-800 shadow-2xl flex flex-col">
                        <div class="p-6 border-b border-slate-800 flex justify-between items-center bg-slate-900">
                            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                                <i class="fa-solid fa-plus-circle text-amber-500"></i>
                                {{ currentTab === 'states' ? 'Créer un État Fédéral' : 'Ajouter une Ville' }}
                            </h2>
                            <button @click="closeDrawer" class="text-slate-500 hover:text-white transition"><i class="fa-solid fa-times text-lg"></i></button>
                        </div>
                        
                        <div class="flex-1 overflow-y-auto p-6 space-y-6">
                            <!-- Formulaire Simulation -->
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nom officiel</label>
                                    <input type="text" class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                </div>
                                
                                <div v-if="currentTab === 'states'">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Capitale</label>
                                    <input type="text" class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                </div>
                                
                                <div v-if="currentTab === 'cities'">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Rattachement (État)</label>
                                    <select class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                        <option v-for="state in states" :key="state.id">{{ state.name }}</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Population (Est.)</label>
                                        <input type="number" class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Budget Initial</label>
                                        <input type="text" class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Responsable (Gouverneur/Maire)</label>
                                    <div class="flex gap-2">
                                        <input type="text" placeholder="Rechercher un citoyen..." class="w-full bg-slate-800 border border-slate-700 rounded p-2 text-sm text-white focus:border-amber-500 outline-none">
                                        <button class="px-3 bg-slate-700 hover:bg-slate-600 rounded text-white"><i class="fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-slate-800 bg-slate-900 flex justify-end gap-3">
                            <button @click="closeDrawer" class="px-4 py-2 text-sm font-medium text-slate-400 hover:text-white transition">Annuler</button>
                            <button class="px-4 py-2 text-sm font-bold bg-amber-600 hover:bg-amber-500 text-white rounded shadow-lg shadow-amber-900/20 transition">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </transition>
            </main>
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return {
            currentTab: 'states',
            searchQuery: '',
            showFilters: false,
            isDrawerOpen: false,
            
            // Pagination
            currentPage: 1,
            itemsPerPage: 8,

            // MOCK DATA (Idem précédent)
            states: [
                { id: 1, name: 'Northumbria', capital: 'Nordgard', population: 45200000, gdp: '42,500', budgetTrend: 2.4, budgetStatus: 'positive', governor: 'Elena Vostok', status: 'stable', statusText: 'Stable' },
                { id: 2, name: 'Valdor', capital: 'Ironhold', population: 89000000, gdp: '51,200', budgetTrend: 0.8, budgetStatus: 'positive', governor: 'Marcus Thorne', status: 'warning', statusText: 'Tension Sociale' },
                { id: 3, name: 'Solara Archipelago', capital: 'Sunhaven', population: 12500000, gdp: '68,000', budgetTrend: 5.1, budgetStatus: 'positive', governor: 'Cpt. Aria Vance', status: 'stable', statusText: 'Prospère' },
                { id: 4, name: 'Neo-Veridia', capital: 'Gardenia', population: 67000000, gdp: '38,900', budgetTrend: 1.2, budgetStatus: 'negative', governor: 'Dr. Sylas Green', status: 'stable', statusText: 'Stable' },
                { id: 5, name: 'Crimson Wastes', capital: 'Dustbowl', population: 8400000, gdp: '22,100', budgetTrend: 3.5, budgetStatus: 'negative', governor: 'General Kael', status: 'critical', statusText: 'État d\'Urgence' },
                { id: 6, name: 'Aether Heights', capital: 'Cloudspire', population: 32000000, gdp: '55,400', budgetTrend: 1.8, budgetStatus: 'positive', governor: 'Lady Zephyr', status: 'stable', statusText: 'Stable' },
            ],
            cities: [
                { id: 101, name: 'Nordgard', stateName: 'Northumbria', isCapital: true, population: 4200000, mayor: 'Bjorn Ironside', securityLevel: 1, securityText: 'Calme' },
                { id: 102, name: 'Ironhold', stateName: 'Valdor', isCapital: true, population: 12500000, mayor: 'Sarah Connor', securityLevel: 2, securityText: 'Vigilance' },
                { id: 103, name: 'Steelworks', stateName: 'Valdor', isCapital: false, population: 3800000, mayor: 'John Doe', securityLevel: 3, securityText: 'Émeutes' },
                { id: 104, name: 'Sunhaven', stateName: 'Solara Archipelago', isCapital: true, population: 890000, mayor: 'Luffy M.', securityLevel: 1, securityText: 'Calme' },
                { id: 105, name: 'Dustbowl', stateName: 'Crimson Wastes', isCapital: true, population: 450000, mayor: 'Mad Max', securityLevel: 4, securityText: 'Critique' },
                { id: 106, name: 'Oasis 7', stateName: 'Crimson Wastes', isCapital: false, population: 12000, mayor: 'Furiosa', securityLevel: 2, securityText: 'Vigilance' },
                { id: 107, name: 'Cloudspire', stateName: 'Aether Heights', isCapital: true, population: 2100000, mayor: 'Sky Walker', securityLevel: 1, securityText: 'Calme' },
                { id: 108, name: 'Gardenia', stateName: 'Neo-Veridia', isCapital: true, population: 5600000, mayor: 'Poison Ivy', securityLevel: 1, securityText: 'Calme' },
                { id: 109, name: 'Sector 4', stateName: 'Valdor', isCapital: false, population: 850000, mayor: 'Unknown', securityLevel: 2, securityText: 'Vigilance' },
                { id: 110, name: 'Frostbite', stateName: 'Northumbria', isCapital: false, population: 320000, mayor: 'Jon Snow', securityLevel: 1, securityText: 'Calme' },
                { id: 111, name: 'New Eden', stateName: 'Neo-Veridia', isCapital: false, population: 120000, mayor: 'Adam E.', securityLevel: 1, securityText: 'Calme' },
            ]
        }
    },
    computed: {
        filteredStates() {
            if(!this.searchQuery) return this.states;
            const query = this.searchQuery.toLowerCase();
            return this.states.filter(s => s.name.toLowerCase().includes(query));
        },
        filteredCities() {
            let result = this.cities;
            if(this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(c => c.name.toLowerCase().includes(query));
            }
            return result;
        },
        // Pagination Logic
        totalPages() {
            return Math.ceil(this.filteredCities.length / this.itemsPerPage);
        },
        paginatedCities() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredCities.slice(start, end);
        }
    },
    methods: {
        accessState: function (state_id) {
            window.location.href = '/ops/territory/state/'+state_id
        },
        formatNumber(num) { return new Intl.NumberFormat('fr-FR').format(num); },
        getInitials(name) { return name ? name.split(' ').map(n => n[0]).join('').substring(0,2).toUpperCase() : '??'; },
        getStatusClass(status) {
            switch(status) {
                case 'stable': return 'bg-green-500/10 text-green-400 border-green-500/20';
                case 'warning': return 'bg-amber-500/10 text-amber-400 border-amber-500/20';
                case 'critical': return 'bg-red-500/10 text-red-400 border-red-500/20 animate-pulse';
                default: return 'bg-slate-700 text-slate-400';
            }
        },
        getSecurityClass(level) {
            switch(level) {
                case 1: return 'bg-green-900/30 text-green-400 border-green-500/30';
                case 2: return 'bg-yellow-900/30 text-yellow-400 border-yellow-500/30';
                case 3: return 'bg-orange-900/30 text-orange-400 border-orange-500/30';
                case 4: return 'bg-red-900/30 text-red-400 border-red-500/30';
                default: return '';
            }
        },
        getSecurityDot(level) {
            switch(level) {
                case 1: return 'bg-green-500';
                case 2: return 'bg-yellow-500';
                case 3: return 'bg-orange-500';
                case 4: return 'bg-red-500 animate-ping';
                default: return 'bg-slate-500';
            }
        },
        openDrawer() { this.isDrawerOpen = true; },
        closeDrawer() { this.isDrawerOpen = false; },
        prevPage() { if(this.currentPage > 1) this.currentPage--; },
        nextPage() { if(this.currentPage < this.totalPages) this.currentPage++; }
    }
}
</script>

<style scoped>
.glass-panel {
    background: rgba(15, 23, 42, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(51, 65, 85, 0.5);
}

/* Tabs styling */
.tab-active {
    border-bottom: 2px solid #fbbf24; /* Amber-400 */
    color: white;
}
.tab-inactive {
    border-bottom: 2px solid transparent;
    color: #94a3b8; /* Slate-400 */
}
.tab-inactive:hover { color: #cbd5e1; }

/* Card Hover Effects */
.state-card { transition: all 0.3s ease; border: 1px solid rgba(51, 65, 85, 0.5); }
.state-card:hover { 
    transform: translateY(-4px); 
    border-color: #fbbf24; /* Amber */
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
}

/* Drawer Transition */
.slide-enter-active, .slide-leave-active { transition: transform 0.3s ease-in-out; }
.slide-enter-from, .slide-leave-to { transform: translateX(100%); }

/* Fade Transition for Overlay */
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>