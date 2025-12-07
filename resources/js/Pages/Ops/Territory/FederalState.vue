<template>
    <body class="text-slate-300 h-screen overflow-hidden selection:bg-amber-500 selection:text-black">
        <div id="app" class="flex h-full w-full">
            <!-- SIDEBAR (Placeholder) -->
            <aside class="w-16 md:w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-20 shrink-0">
                <div class="h-16 flex items-center justify-center md:justify-start md:px-6 gap-3 border-b border-slate-800 bg-slate-950/50">
                    <div class="w-8 h-8 rounded bg-amber-500 text-black flex items-center justify-center font-bold text-lg">D</div>
                    <span class="font-bold text-white tracking-wider text-sm md:block">DRAREKSTANIE</span>
                </div>
                <nav class="p-2 md:p-4 space-y-2">
                    <a href="/ops/territory" class="flex items-center justify-center md:justify-start gap-3 px-2 md:px-4 py-2 text-sm text-slate-400 hover:text-white rounded hover:bg-slate-800 transition">
                        <i class="fa-solid fa-arrow-left"></i> <span class="md:inline">Retour Liste</span>
                    </a>
                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="flex-1 flex flex-col relative overflow-hidden bg-slate-950">
                <!-- HEADER : Identité de l'État -->
                <header class="h-auto border-b border-slate-800 bg-slate-900/80 backdrop-blur shrink-0 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="flex items-center gap-6">
                        <!-- Fake Flag Upload -->
                        <div class="relative group cursor-pointer w-20 h-14 bg-gradient-to-br from-red-900 to-slate-900 rounded border border-slate-700 shadow-lg flex items-center justify-center overflow-hidden">
                            <span class="text-2xl">⚒️</span>
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-solid fa-camera text-white"></i>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl font-bold text-white tracking-tight">{{ state.name }}</h1>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold border uppercase" :class="getStatusClass(state.status)">
                                    {{ state.statusText }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                                <span class="font-mono text-xs bg-slate-800 px-1 rounded text-slate-400">ID: {{ state.id }}</span>
                                <span>•</span>
                                <i class="fa-solid fa-landmark text-xs"></i> Capitale: <span class="text-slate-300 font-medium">{{ state.capital }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3">
                        <span v-if="hasUnsavedChanges" class="text-xs text-amber-500 animate-pulse mr-2">Modifications non enregistrées</span>
                        <button class="px-4 py-2 bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded text-sm text-slate-300 transition">
                            <i class="fa-solid fa-print mr-2"></i> Rapport
                        </button>
                        <button @click="saveChanges" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white rounded text-sm font-bold transition shadow-lg shadow-amber-900/20 flex items-center gap-2" :disabled="!hasUnsavedChanges && false">
                            <i class="fa-solid fa-save"></i> Enregistrer
                        </button>
                        <button class="w-9 h-9 flex items-center justify-center bg-slate-800 hover:bg-red-900/30 border border-slate-700 hover:border-red-800 rounded text-slate-400 hover:text-red-500 transition">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                </header>

                <!-- TABS NAVIGATION -->
                <div class="border-b border-slate-800 bg-slate-900/50 px-6 flex overflow-x-auto">
                    <button v-for="tab in tabs" :key="tab.id" 
                            @click="currentTab = tab.id"
                            class="nav-tab whitespace-nowrap" 
                            :class="{ 'active': currentTab === tab.id }">
                        <i :class="tab.icon" class="mr-2 text-xs"></i> {{ tab.label }}
                    </button>
                </div>

                <!-- SCROLLABLE CONTENT -->
                <div class="flex-1 overflow-y-auto p-6">
                    
                    <!-- TAB 1: VUE D'ENSEMBLE -->
                    <div v-if="currentTab === 'overview'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-in fade-in">
                        
                        <!-- Colonne Gauche : Infos Générales -->
                        <div class="lg:col-span-2 space-y-6">
                            
                            <!-- Block: Identité -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-info-circle text-slate-500"></i> Informations Générales
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">Nom Officiel</label>
                                        <input type="text" v-model="state.officialName" class="form-input">
                                    </div>
                                    <div>
                                        <label class="form-label">Capitale Administrative</label>
                                        <div class="relative">
                                            <i class="fa-solid fa-city absolute left-3 top-2.5 text-slate-500 text-xs"></i>
                                            <input type="text" v-model="state.capital" class="form-input pl-8">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="form-label">Description / Histoire</label>
                                        <textarea v-model="state.description" class="form-input form-textarea" placeholder="Brève description de l'état..."></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Block: Indicateurs Clés -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Population</span>
                                    <span class="block text-xl font-mono text-white mt-1">{{ formatNumber(state.population) }}</span>
                                    <span class="text-[10px] text-green-400"><i class="fa-solid fa-arrow-up"></i> +1.2%</span>
                                </div>
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">PIB (GDP)</span>
                                    <span class="block text-xl font-mono text-amber-500 mt-1">{{ state.gdp }} Mds ₯</span>
                                </div>
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Chômage</span>
                                    <span class="block text-xl font-mono text-blue-400 mt-1">{{ state.unemployment }}%</span>
                                </div>
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Criminalité</span>
                                    <span class="block text-xl font-mono text-red-400 mt-1">{{ state.crimeRate }}/1000</span>
                                </div>
                            </div>

                        </div>

                        <!-- Colonne Droite : Gouvernance & Carte -->
                        <div class="space-y-6">
                            
                            <!-- Map Widget (Placeholder) -->
                            <div class="glass-panel rounded-xl overflow-hidden relative h-48 group">
                                <img src="https://images.unsplash.com/photo-1577086663218-0915774d8276?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-50 grayscale group-hover:grayscale-0 transition duration-700">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <button class="px-3 py-1 bg-slate-900/80 backdrop-blur border border-slate-700 rounded text-xs hover:bg-amber-600 hover:text-white transition">
                                        <i class="fa-solid fa-map-location-dot mr-1"></i> Ouvrir Cadastre
                                    </button>
                                </div>
                                <div class="absolute bottom-2 right-2 px-2 py-0.5 bg-black/60 rounded text-[10px] text-white">
                                    Superficie: {{ formatNumber(state.area) }} km²
                                </div>
                            </div>

                            <!-- Governor Widget -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4 flex items-center justify-between">
                                    <span><i class="fa-solid fa-user-tie text-slate-500 mr-2"></i> Gouverneur</span>
                                    <button class="text-xs text-blue-400 hover:underline">Modifier</button>
                                </h3>
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-16 h-16 rounded-full bg-slate-700 overflow-hidden border-2 border-slate-600">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Governor" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-bold text-white">{{ state.governor.name }}</h4>
                                        <p class="text-xs text-amber-500 font-medium">{{ state.governor.party }}</p>
                                        <p class="text-[10px] text-slate-500 mt-1">En poste depuis 2022</p>
                                    </div>
                                </div>
                                <div class="space-y-2 text-xs">
                                    <div class="flex justify-between border-b border-slate-700/50 pb-1">
                                        <span class="text-slate-500">Prochaine Élection</span>
                                        <span class="text-white">Novembre 2027</span>
                                    </div>
                                    <div class="flex justify-between border-b border-slate-700/50 pb-1">
                                        <span class="text-slate-500">Mandats</span>
                                        <span class="text-white">1er Mandat</span>
                                    </div>
                                    <div class="flex justify-between pb-1">
                                        <span class="text-slate-500">Taux d'approbation</span>
                                        <span class="text-green-400 font-bold">68%</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 2: POLITIQUE (Avec Graphique) -->
                    <div v-if="currentTab === 'politics'" class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-in fade-in">
                        
                        <!-- Parlement Local -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4">Assemblée Locale (Répartition des Sièges)</h3>
                            <div id="parliamentChart" class="w-full h-64 flex items-center justify-center"></div>
                            <div class="mt-4 grid grid-cols-3 gap-2 text-center text-xs">
                                <div class="p-2 bg-slate-800 rounded border-l-2 border-blue-500">
                                    <span class="block text-slate-400">Parti Unifié</span>
                                    <span class="block font-bold text-white">45 Sièges</span>
                                </div>
                                <div class="p-2 bg-slate-800 rounded border-l-2 border-red-500">
                                    <span class="block text-slate-400">Opposition</span>
                                    <span class="block font-bold text-white">22 Sièges</span>
                                </div>
                                <div class="p-2 bg-slate-800 rounded border-l-2 border-gray-500">
                                    <span class="block text-slate-400">Indépendants</span>
                                    <span class="block font-bold text-white">8 Sièges</span>
                                </div>
                            </div>
                        </div>

                        <!-- Constitution & Lois -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4">Cadre Législatif</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="form-label">Statut Constitutionnel</label>
                                    <select class="form-input">
                                        <option>Conforme à la Constitution Fédérale</option>
                                        <option>Sous Tutelle Fédérale</option>
                                        <option>Autonomie Renforcée</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Spécificités Légales</label>
                                    <div class="flex items-center gap-2 mb-2">
                                        <input type="checkbox" checked class="rounded bg-slate-800 border-slate-600 text-amber-500">
                                        <span class="text-sm text-slate-300">Peine de Mort (Niveau Local)</span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <input type="checkbox" class="rounded bg-slate-800 border-slate-600 text-amber-500">
                                        <span class="text-sm text-slate-300">Légalisation Cannabis</span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <input type="checkbox" checked class="rounded bg-slate-800 border-slate-600 text-amber-500">
                                        <span class="text-sm text-slate-300">Zone Franche Fiscale</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 3: ÉCONOMIE -->
                    <div v-if="currentTab === 'economy'" class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-in fade-in">
                        <!-- Formulaire Budget -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4">Indicateurs Économiques</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">TVA Locale (%)</label>
                                    <input type="number" v-model="state.economy.vat" class="form-input" step="0.1">
                                </div>
                                <div>
                                    <label class="form-label">Impôt Sociétés (%)</label>
                                    <input type="number" v-model="state.economy.corporateTax" class="form-input" step="0.1">
                                </div>
                                <div class="col-span-2">
                                    <label class="form-label">Industries Majeures</label>
                                    <input type="text" v-model="state.economy.industries" class="form-input" placeholder="Ex: Minier, Technologie, Agriculture...">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Chart Budget -->
                        <div class="glass-panel rounded-xl p-5">
                            <h3 class="text-sm font-bold text-white mb-4">Répartition Budgétaire</h3>
                            <div id="budgetChart" class="w-full h-64"></div>
                        </div>
                    </div>

                    <!-- TAB 4: DÉMOGRAPHIE -->
                    <div v-if="currentTab === 'demographics'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-in fade-in">
                        
                        <!-- Colonne Gauche : Liste Villes -->
                        <div class="lg:col-span-2 glass-panel rounded-xl p-5 flex flex-col">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-bold text-white">Villes & Répartition</h3>
                                <button class="text-xs bg-slate-800 hover:bg-slate-700 px-3 py-1 rounded text-white border border-slate-700">
                                    <i class="fa-solid fa-plus mr-1"></i> Ajouter
                                </button>
                            </div>
                            <div class="overflow-auto max-h-[400px]">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-slate-800/80 text-[10px] uppercase text-slate-400 sticky top-0 z-10 backdrop-blur">
                                        <tr>
                                            <th class="p-3 font-semibold border-b border-slate-700">Nom</th>
                                            <th class="p-3 font-semibold border-b border-slate-700 text-right">Population</th>
                                            <th class="p-3 font-semibold border-b border-slate-700">Maire</th>
                                            <th class="p-3 font-semibold border-b border-slate-700 text-center">Statut</th>
                                            <th class="p-3 font-semibold border-b border-slate-700 text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-xs divide-y divide-slate-800">
                                        <tr v-for="city in state.cities" :key="city.id" class="group hover:bg-slate-800/50 transition">
                                            <td class="p-3 text-slate-200 font-medium">
                                                {{ city.name }} 
                                                <i v-if="city.isCapital" class="fa-solid fa-star text-amber-500 text-[9px] ml-1" title="Capitale"></i>
                                            </td>
                                            <td class="p-3 text-right font-mono text-slate-400">{{ formatNumber(city.pop) }}</td>
                                            <td class="p-3 text-slate-400">{{ city.mayor }}</td>
                                            <td class="p-3 text-center">
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold" :class="city.security === 'calme' ? 'bg-green-900/30 text-green-400' : 'bg-red-900/30 text-red-400'">
                                                    {{ city.security === 'calme' ? 'Stable' : 'Critique' }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-right">
                                                <button class="text-slate-500 hover:text-white transition"><i class="fa-solid fa-pen"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Colonne Droite : Indicateurs & Pyramide -->
                        <div class="space-y-6">
                            
                            <!-- Mini Stats -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4">Indicateurs Démographiques</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-slate-400">Croissance Annuelle</span>
                                        <span class="text-green-400 font-mono font-bold">+1.2%</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-1.5 rounded-full"><div class="bg-green-500 h-1.5 rounded-full" style="width: 65%"></div></div>
                                    
                                    <div class="flex justify-between items-center text-xs pt-2">
                                        <span class="text-slate-400">Taux d'Urbanisation</span>
                                        <span class="text-blue-400 font-mono font-bold">78%</span>
                                    </div>
                                    <div class="w-full bg-slate-800 h-1.5 rounded-full"><div class="bg-blue-500 h-1.5 rounded-full" style="width: 78%"></div></div>
                                    
                                    <div class="flex justify-between items-center text-xs pt-2">
                                        <span class="text-slate-400">Espérance de Vie</span>
                                        <span class="text-purple-400 font-mono font-bold">82 Ans</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Age Pyramid Chart -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-2">Pyramide des Âges</h3>
                                <div id="ageChart" class="w-full h-48"></div>
                            </div>

                        </div>
                    </div>

                    <!-- TAB 5: INFRASTRUCTURES -->
                    <div v-if="currentTab === 'infrastructure'" class="space-y-6 animate-in fade-in">
                        
                        <!-- KPI Row -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="glass-panel p-4 rounded-xl flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">Réseau Électrique</p>
                                    <p class="text-sm font-bold text-green-400 mt-1">Opérationnel 99.8%</p>
                                </div>
                                <div class="w-8 h-8 rounded bg-green-500/10 flex items-center justify-center text-green-500"><i class="fa-solid fa-bolt"></i></div>
                            </div>
                            <div class="glass-panel p-4 rounded-xl flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">État des Routes</p>
                                    <p class="text-sm font-bold text-amber-500 mt-1">Dégradé (Nord)</p>
                                </div>
                                <div class="w-8 h-8 rounded bg-amber-500/10 flex items-center justify-center text-amber-500"><i class="fa-solid fa-road"></i></div>
                            </div>
                            <div class="glass-panel p-4 rounded-xl flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">Couverture 5G</p>
                                    <p class="text-sm font-bold text-blue-400 mt-1">85% du Territoire</p>
                                </div>
                                <div class="w-8 h-8 rounded bg-blue-500/10 flex items-center justify-center text-blue-500"><i class="fa-solid fa-wifi"></i></div>
                            </div>
                        </div>

                        <!-- Liste Infrastructures -->
                        <div class="glass-panel rounded-xl p-5">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-bold text-white">Infrastructures Critiques</h3>
                                <div class="flex gap-2">
                                    <button class="text-xs px-2 py-1 bg-slate-800 rounded text-slate-400 hover:text-white transition">Tout</button>
                                    <button class="text-xs px-2 py-1 bg-slate-800 rounded text-slate-400 hover:text-white transition">Énergie</button>
                                    <button class="text-xs px-2 py-1 bg-slate-800 rounded text-slate-400 hover:text-white transition">Transport</button>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                <div v-for="infra in state.infrastructure" :key="infra.id" class="p-3 bg-slate-800/50 rounded border border-slate-700/50 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded bg-slate-700 flex items-center justify-center text-slate-300">
                                        <i :class="infra.icon"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-white">{{ infra.name }}</h4>
                                        <p class="text-[10px] text-slate-400">{{ infra.type }} • <span :class="infra.status === 'OK' ? 'text-green-400' : 'text-red-400'">{{ infra.status }}</span></p>
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
            currentTab: 'overview',
            hasUnsavedChanges: false,
            
            // Structure Navigation
            tabs: [
                { id: 'overview', label: 'Vue d\'ensemble', icon: 'fa-solid fa-chart-pie' },
                { id: 'politics', label: 'Politique & Lois', icon: 'fa-solid fa-gavel' },
                { id: 'economy', label: 'Budget & Économie', icon: 'fa-solid fa-coins' },
                { id: 'demographics', label: 'Démographie & Villes', icon: 'fa-solid fa-users' },
                { id: 'infrastructure', label: 'Infrastructures', icon: 'fa-solid fa-industry' },
            ],

            // MOCK DATA STATE
            state: {
                id: 2,
                name: 'Valdor',
                officialName: 'République Fédérée de Valdor',
                status: 'warning',
                statusText: 'Tension Sociale',
                capital: 'Ironhold',
                population: 89000000,
                area: 125400,
                gdp: 512,
                unemployment: 8.4,
                crimeRate: 12.5,
                description: 'État industriel majeur situé au nord-est. Centre névralgique de la production sidérurgique et militaire de la Drarekstanie. Connaît actuellement des tensions syndicales importantes dans le secteur minier.',
                governor: {
                    name: 'Marcus Thorne',
                    party: 'Front Industriel',
                },
                economy: {
                    vat: 20.0,
                    corporateTax: 15.5,
                    industries: 'Sidérurgie, Armement, Mines'
                },
                cities: [
                    { id: 1, name: 'Ironhold', pop: 12500000, mayor: 'Sarah Connor', isCapital: true, security: 'calme' },
                    { id: 2, name: 'Steelworks', pop: 3800000, mayor: 'John Doe', isCapital: false, security: 'critique' },
                    { id: 3, name: 'Sector 4', pop: 850000, mayor: 'Unknown', isCapital: false, security: 'calme' },
                    { id: 4, name: 'Black Mesa', pop: 120000, mayor: 'G. Freeman', isCapital: false, security: 'calme' },
                ],
                infrastructure: [
                    { id: 1, name: 'Centrale Nucléaire Valdor-1', type: 'Énergie', status: 'OK', icon: 'fa-solid fa-radiation' },
                    { id: 2, name: 'Aéroport Int. Ironhold', type: 'Transport', status: 'OK', icon: 'fa-solid fa-plane' },
                    { id: 3, name: 'Barrage du Nord', type: 'Hydro', status: 'Maintenance', icon: 'fa-solid fa-water' },
                    { id: 4, name: 'Gare Centrale', type: 'Transport', status: 'OK', icon: 'fa-solid fa-train' },
                    { id: 5, name: 'Hôpital Militaire', type: 'Santé', status: 'Saturé', icon: 'fa-solid fa-hospital' },
                ]
            }
        }
    },
    watch: {
        state: {
            handler(newVal) {
                this.hasUnsavedChanges = true;
            },
            deep: true
        }
    },
    methods: {
        formatNumber(num) {
            return new Intl.NumberFormat('fr-FR').format(num);
        },
        getStatusClass(status) {
            switch(status) {
                case 'stable': return 'bg-green-500/10 text-green-400 border-green-500/20';
                case 'warning': return 'bg-amber-500/10 text-amber-400 border-amber-500/20';
                case 'critical': return 'bg-red-500/10 text-red-400 border-red-500/20';
                default: return 'bg-slate-700 text-slate-400';
            }
        },
        saveChanges() {
            alert("Simulation: Données enregistrées en base MongoDB.");
            this.hasUnsavedChanges = false;
        },
        initCharts() {
            // Chart Politique (Donut)
            if(document.querySelector("#parliamentChart")) {
                const optionsP = {
                    series: [45, 22, 8],
                    labels: ['Parti Unifié', 'Opposition', 'Indépendants'],
                    chart: { type: 'donut', height: 250, background: 'transparent' },
                    colors: ['#3b82f6', '#ef4444', '#94a3b8'],
                    legend: { show: false },
                    stroke: { show: false },
                    theme: { mode: 'dark' },
                    plotOptions: { pie: { donut: { size: '70%' } } }
                };
                new ApexCharts(document.querySelector("#parliamentChart"), optionsP).render();
            }

            // Chart Budget (Pie)
            if(document.querySelector("#budgetChart")) {
                const optionsB = {
                    series: [40, 25, 15, 20],
                    labels: ['Infrastructures', 'Santé', 'Éducation', 'Sécurité'],
                    chart: { type: 'pie', height: 250, background: 'transparent' },
                    colors: ['#f59e0b', '#10b981', '#3b82f6', '#ef4444'],
                    theme: { mode: 'dark' },
                    stroke: { show: false },
                    legend: { position: 'bottom' }
                };
                new ApexCharts(document.querySelector("#budgetChart"), optionsB).render();
            }

            // Chart Age Pyramid (Bar) - NEW
            if(document.querySelector("#ageChart")) {
                const optionsA = {
                    series: [
                        { name: 'Hommes', data: [4, 5, 6, 8, 9, 8, 7, 5, 3] },
                        { name: 'Femmes', data: [-4, -5, -6, -8, -9, -8, -7, -5, -4] }
                    ],
                    chart: { type: 'bar', height: 200, stacked: true, background: 'transparent', toolbar: { show: false } },
                    colors: ['#3b82f6', '#ec4899'],
                    plotOptions: { bar: { horizontal: true, barHeight: '80%' } },
                    dataLabels: { enabled: false },
                    stroke: { width: 1, colors: ["#fff"] },
                    grid: { xaxis: { lines: { show: false } } },
                    yaxis: { min: -10, max: 10, labels: { show: false } }, // Simplified
                    tooltip: { shared: false, x: { formatter: function (val) { return val } }, y: { formatter: function (val) { return Math.abs(val) + "%" } } },
                    xaxis: { 
                        categories: ['0-9', '10-19', '20-29', '30-39', '40-49', '50-59', '60-69', '70-79', '80+'],
                        labels: { formatter: function (val) { return Math.abs(val) + "%" } }
                    },
                    theme: { mode: 'dark' }
                };
                new ApexCharts(document.querySelector("#ageChart"), optionsA).render();
            }
        }
    },
    updated() {
        // Re-init charts when tab changes
        this.$nextTick(() => {
            this.initCharts();
        });
    },
    mounted() {
        // Hack pour éviter le "watch" trigger au chargement initial
        setTimeout(() => { this.hasUnsavedChanges = false; }, 100);
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

/* Inputs Formulaire "Pro" */
.form-label {
    display: block;
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #64748b; /* Slate-500 */
    margin-bottom: 0.25rem;
    font-weight: 700;
}
.form-input {
    width: 100%;
    background-color: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.4);
    border-radius: 0.375rem;
    padding: 0.5rem 0.75rem;
    color: #e2e8f0;
    font-size: 0.875rem;
    transition: all 0.2s;
}
.form-input:focus {
    background-color: rgba(30, 41, 59, 0.8);
    border-color: #f59e0b; /* Amber-500 */
    outline: none;
    box-shadow: 0 0 0 1px rgba(245, 158, 11, 0.2);
}
.form-textarea {
    resize: vertical;
    min-height: 80px;
}

/* Tabs Styles */
.nav-tab {
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #94a3b8;
    border-bottom: 2px solid transparent;
    transition: all 0.2s;
}
.nav-tab:hover { color: #cbd5e1; }
.nav-tab.active {
    color: white;
    border-bottom-color: #f59e0b;
}
</style>