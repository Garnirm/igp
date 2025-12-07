<template>
    <body class="text-slate-300 h-screen overflow-hidden selection:bg-amber-500 selection:text-black">
        <div id="app" class="flex h-full w-full">
            <!-- SIDEBAR (Placeholder) -->
            <aside class="w-16 md:w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-20 shrink-0">
                <div class="h-16 flex items-center justify-center md:justify-start md:px-6 gap-3 border-b border-slate-800 bg-slate-950/50">
                    <div class="w-8 h-8 rounded bg-amber-500 text-black flex items-center justify-center font-bold text-lg">D</div>
                    <span class="font-bold text-white tracking-wider text-sm hidden md:block">DRAREKSTANIE</span>
                </div>
                <nav class="p-2 md:p-4 space-y-2">
                    <a href="/ops/territory" class="flex items-center justify-center md:justify-start gap-3 px-2 md:px-4 py-2 text-sm text-slate-400 hover:text-white rounded hover:bg-slate-800 transition">
                        <i class="fa-solid fa-arrow-left"></i> <span class="hidden md:inline">Retour Liste</span>
                    </a>
                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="flex-1 flex flex-col relative overflow-hidden bg-slate-950">
                
                <!-- HEADER : Identité Ville -->
                <header class="h-auto border-b border-slate-800 bg-slate-900/80 backdrop-blur shrink-0 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    
                    <div class="flex items-center gap-6">
                        <!-- City Icon/Type -->
                        <div class="w-16 h-16 bg-slate-800 rounded-lg border border-slate-700 flex items-center justify-center text-3xl shadow-lg">
                            <i class="fa-solid fa-city text-slate-400"></i>
                        </div>
                        
                        <div>
                            <div class="flex items-center gap-3">
                                <h1 class="text-2xl font-bold text-white tracking-tight">{{ city.name }}</h1>
                                <span v-if="city.isCapital" class="text-amber-500" title="Capitale d'État"><i class="fa-solid fa-star"></i></span>
                            </div>
                            <p class="text-sm text-slate-500 flex items-center gap-2 mt-1">
                                <span class="px-2 py-0.5 bg-slate-800 rounded text-xs font-medium text-slate-300">{{ city.stateName }}</span>
                                <span>•</span>
                                <span class="font-mono text-xs">CP: {{ city.zipCode }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Security Status Widget -->
                    <div class="flex items-center gap-4 px-4 py-2 bg-slate-900 border border-slate-800 rounded-lg">
                        <div class="text-right">
                            <p class="text-[10px] font-bold text-slate-500 uppercase">Niveau Sécurité</p>
                            <p class="text-sm font-bold" :class="getSecurityColor(city.securityLevel)">{{ city.securityText }}</p>
                        </div>
                        <div class="w-3 h-3 rounded-full animate-pulse" :class="getSecurityDot(city.securityLevel)"></div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-3">
                        <span v-if="hasUnsavedChanges" class="text-xs text-amber-500 animate-pulse mr-2">Modifications non enregistrées</span>
                        <button @click="saveChanges" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white rounded text-sm font-bold transition shadow-lg shadow-amber-900/20 flex items-center gap-2" :disabled="!hasUnsavedChanges && false">
                            <i class="fa-solid fa-save"></i> Enregistrer
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
                        
                        <!-- Colonne Gauche -->
                        <div class="lg:col-span-2 space-y-6">
                            
                            <!-- General Info -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-info-circle text-slate-500"></i> Administration Locale
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="form-label">Nom de la Commune</label>
                                        <input type="text" v-model="city.name" class="form-input">
                                    </div>
                                    <div>
                                        <label class="form-label">Maire Actuel</label>
                                        <div class="relative">
                                            <i class="fa-solid fa-user-tie absolute left-3 top-2.5 text-slate-500 text-xs"></i>
                                            <input type="text" v-model="city.mayor" class="form-input pl-8">
                                        </div>
                                    </div>
                                    
                                    <!-- Population Recensée (READ-ONLY) -->
                                    <div>
                                        <label class="form-label">Population (Automatique)</label>
                                        <div class="form-input form-input-readonly flex items-center justify-between">
                                            <span class="font-mono">{{ formatNumber(city.population) }}</span>
                                            <i class="fa-solid fa-calculator text-slate-600 text-xs" title="Calculée via l'état civil"></i>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label class="form-label">Budget Annuel (Alloué)</label>
                                        <div class="relative">
                                            <span class="absolute right-3 top-2.5 text-slate-500 text-xs">₯</span>
                                            <input type="text" v-model="city.budget" class="form-input">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4">Répartition Urbaine (Zonage)</h3>
                                <div class="flex flex-col md:flex-row gap-6 items-center">
                                    <apexchart height="200" type="donut" class="w-full md:w-1/2 h-48" :options="optionsZonage" :series="seriesZonage"></apexchart>

                                    <div class="w-full md:w-1/2 space-y-3">
                                        <div class="flex justify-between text-xs">
                                            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Résidentiel</span>
                                            <span class="text-white font-mono">45%</span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Commercial</span>
                                            <span class="text-white font-mono">30%</span>
                                        </div>
                                        <div class="flex justify-between text-xs">
                                            <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Industriel</span>
                                            <span class="text-white font-mono">25%</span>
                                        </div>
                                        <div class="pt-2 border-t border-slate-700">
                                            <p class="text-[10px] text-slate-400">Note: Forte densité commerciale au centre-ville.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Chômage Local</span>
                                    <span class="block text-lg font-mono text-blue-400 mt-1">{{ city.unemployment }}%</span>
                                </div>
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Pollution (AQI)</span>
                                    <span class="block text-lg font-mono mt-1" :class="city.pollution > 50 ? 'text-amber-500' : 'text-green-400'">{{ city.pollution }}</span>
                                </div>
                            </div>

                            <!-- État des Services Rapides -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4">État des Réseaux</h3>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-400 flex items-center gap-2"><i class="fa-solid fa-faucet-drip"></i> Eau Potable</span>
                                            <span class="text-green-400 font-bold">Stable</span>
                                        </div>
                                        <div class="w-full bg-slate-800 h-1.5 rounded-full"><div class="bg-green-500 h-1.5 rounded-full" style="width: 100%"></div></div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-400 flex items-center gap-2"><i class="fa-solid fa-bolt"></i> Électricité</span>
                                            <span class="text-amber-500 font-bold">Instable (Pic)</span>
                                        </div>
                                        <div class="w-full bg-slate-800 h-1.5 rounded-full"><div class="bg-amber-500 h-1.5 rounded-full" style="width: 92%"></div></div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-xs mb-1">
                                            <span class="text-slate-400 flex items-center gap-2"><i class="fa-solid fa-wifi"></i> Fibre Optique</span>
                                            <span class="text-blue-400 font-bold">Opérationnel</span>
                                        </div>
                                        <div class="w-full bg-slate-800 h-1.5 rounded-full"><div class="bg-blue-500 h-1.5 rounded-full" style="width: 98%"></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="currentTab === 'services'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-in fade-in">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-white">Établissements Publics</h3>
                                <button class="px-3 py-1.5 bg-slate-800 border border-slate-700 rounded text-xs text-white hover:bg-slate-700 transition">
                                    <i class="fa-solid fa-plus mr-1"></i> Ajouter
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="service in city.services" :key="service.id" class="glass-panel p-4 rounded-xl flex items-start gap-4 hover:border-slate-600 transition group cursor-pointer">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center text-lg shrink-0" :class="getServiceIconBg(service.type)">
                                        <i :class="service.icon"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <h4 class="text-sm font-bold text-white group-hover:text-amber-500 transition">{{ service.name }}</h4>
                                            <span class="text-[10px] px-1.5 py-0.5 rounded border" :class="getServiceStatusClass(service.status)">{{ service.status }}</span>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">{{ service.type }} • Effectif: {{ service.staff }}</p>
                                        <div class="mt-3 w-full bg-slate-800 h-1 rounded-full overflow-hidden">
                                            <div class="h-full bg-slate-600" :style="{ width: service.capacity + '%' }" :class="service.capacity > 90 ? 'bg-red-500' : 'bg-green-500'"></div>
                                        </div>
                                        <p class="text-[9px] text-slate-600 mt-1 text-right">Capacité: {{ service.capacity }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne Droite (Planning) -->
                        <div class="lg:col-span-1 space-y-6">
                            <!-- Planning Mairie -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4 flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-days text-slate-500"></i> Horaires Mairie
                                </h3>
                                <div class="space-y-4">
                                    <div v-for="schedule in city.schedules" :key="schedule.name" class="p-3 bg-slate-800/50 rounded border border-slate-700/50">
                                        <div class="flex justify-between items-center mb-2">
                                            <h4 class="text-xs font-bold text-white">{{ schedule.name }}</h4>
                                            <span class="text-[10px] font-bold" :class="schedule.isOpen ? 'text-green-400' : 'text-slate-500'">
                                                {{ schedule.isOpen ? 'OUVERT' : 'FERMÉ' }}
                                            </span>
                                        </div>
                                        <div class="space-y-1">
                                            <div class="flex justify-between text-[10px] text-slate-400">
                                                <span>Lun - Ven</span>
                                                <span>{{ schedule.weekHours }}</span>
                                            </div>
                                            <div class="flex justify-between text-[10px] text-slate-400">
                                                <span>Samedi</span>
                                                <span>{{ schedule.weekendHours }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-slate-700">
                                    <h4 class="text-xs font-bold text-slate-300 mb-2">Prochaines Permanences</h4>
                                    <div class="flex items-center gap-3 p-2 hover:bg-slate-800 rounded transition cursor-pointer">
                                        <div class="text-center w-8 bg-slate-700 rounded p-1">
                                            <span class="block text-[8px] text-slate-400 uppercase">DEC</span>
                                            <span class="block text-xs font-bold text-white">12</span>
                                        </div>
                                        <div>
                                            <p class="text-xs text-white font-medium">Permanence du Maire</p>
                                            <p class="text-[10px] text-slate-500">14h00 - 17h00 • Salle A</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 3: SÉCURITÉ -->
                    <div v-if="currentTab === 'security'" class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-in fade-in">
                        
                        <!-- Stats Sécurité -->
                        <div class="lg:col-span-1 space-y-6">
                            <div class="glass-panel p-5 rounded-xl text-center">
                                <h3 class="text-xs font-bold text-slate-500 uppercase mb-2">Indice Criminalité</h3>
                                <div class="relative inline-block">
                                    <svg class="w-32 h-32 transform -rotate-90">
                                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-800" />
                                        <circle cx="64" cy="64" r="56" stroke="currentColor" stroke-width="8" fill="transparent" class="text-amber-500" stroke-dasharray="351.86" :stroke-dashoffset="351.86 * (1 - city.crimeIndex / 100)" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center flex-col">
                                        <span class="text-2xl font-bold text-white">{{ city.crimeIndex }}</span>
                                        <span class="text-[9px] text-slate-400">/ 100</span>
                                    </div>
                                </div>
                                <p class="text-xs text-amber-500 mt-2 font-medium">Niveau Modéré</p>
                            </div>

                            <div class="glass-panel p-5 rounded-xl">
                                <h3 class="text-sm font-bold text-white mb-4">Forces de l'Ordre</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-slate-400">Unités Actives</span>
                                        <span class="text-white font-mono">12 Patrouilles</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-slate-400">Commissariats</span>
                                        <span class="text-white font-mono">2</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-slate-400">Temps Réponse Moyen</span>
                                        <span class="text-green-400 font-mono">8 min</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Journal des Incidents -->
                        <div class="lg:col-span-2 glass-panel rounded-xl p-5 flex flex-col">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-sm font-bold text-white">Incidents Récents</h3>
                                <button class="text-xs text-blue-400 hover:text-white">Voir tout</button>
                            </div>
                            <div class="overflow-auto max-h-[400px]">
                                <table class="w-full text-left">
                                    <thead class="text-[10px] uppercase text-slate-500 border-b border-slate-700">
                                        <tr>
                                            <th class="pb-2">Type</th>
                                            <th class="pb-2">Lieu</th>
                                            <th class="pb-2 text-right">Heure</th>
                                            <th class="pb-2 text-right">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-xs divide-y divide-slate-800">
                                        <tr v-for="incident in city.incidents" :key="incident.id" class="group hover:bg-slate-800/30">
                                            <td class="py-3 font-medium text-white">
                                                <span class="inline-block w-2 h-2 rounded-full mr-2" :class="getIncidentColor(incident.type)"></span>
                                                {{ incident.type }}
                                            </td>
                                            <td class="py-3 text-slate-400">{{ incident.location }}</td>
                                            <td class="py-3 text-right font-mono text-slate-500">{{ incident.time }}</td>
                                            <td class="py-3 text-right">
                                                <span class="px-1.5 py-0.5 rounded border text-[9px]" :class="getIncidentStatusClass(incident.status)">{{ incident.status }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div v-if="currentTab === 'economy'" class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate-in fade-in">
                        <div class="space-y-6">
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Revenu Médian</span>
                                    <span class="block text-xl font-mono text-white mt-1">2,450 ₯</span>
                                    <span class="text-[10px] text-green-400">/Mois</span>
                                </div>
                                <div class="glass-panel p-4 rounded-xl text-center">
                                    <span class="block text-[10px] text-slate-500 uppercase font-bold">Taux Pauvreté</span>
                                    <span class="block text-xl font-mono text-amber-500 mt-1">12.4%</span>
                                </div>
                            </div>

                            <!-- Secteurs Chart -->
                            <div class="glass-panel rounded-xl p-5">
                                <h3 class="text-sm font-bold text-white mb-4">Répartition Emploi (Secteurs)</h3>
                                <apexchart height="200" type="pie" class="w-full h-48" :options="optionsSectors" :series="seriesSectors"></apexchart>
                            </div>
                        </div>

                        <!-- Top Employeurs -->
                        <div class="glass-panel rounded-xl p-5 flex flex-col h-full">
                            <h3 class="text-sm font-bold text-white mb-4">Gros Employeurs Locaux</h3>
                            <div class="space-y-0 flex-1 overflow-auto">
                                <div v-for="company in city.companies" :key="company.id" class="flex items-center gap-4 p-3 border-b border-slate-800 hover:bg-slate-800/30 transition last:border-0">
                                    <div class="w-10 h-10 rounded bg-slate-800 flex items-center justify-center font-bold text-slate-500 border border-slate-700">
                                        {{ company.name[0] }}
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-xs font-bold text-white">{{ company.name }}</h4>
                                        <p class="text-[10px] text-slate-400">{{ company.sector }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="block text-xs font-mono font-bold text-white">{{ company.employees }}</span>
                                        <span class="block text-[9px] text-slate-500">Salariés</span>
                                    </div>
                                </div>
                            </div>
                            <button class="mt-4 w-full py-2 bg-slate-800 hover:bg-slate-700 text-xs text-slate-300 rounded border border-slate-700 transition">
                                Voir registre entreprises
                            </button>
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

            optionsZonage: {},
            seriesZonage: [],

            optionsSectors: {},
            seriesSectors: [],
            
            tabs: [
                { id: 'overview', label: 'Vue d\'ensemble', icon: 'fa-solid fa-chart-pie' },
                { id: 'services', label: 'Services Publics', icon: 'fa-solid fa-building-columns' },
                { id: 'security', label: 'Sécurité & Police', icon: 'fa-solid fa-shield-halved' },
                { id: 'economy', label: 'Économie & Emploi', icon: 'fa-solid fa-briefcase' },
            ],

            // MOCK DATA
            city: {
                name: 'Ironhold',
                stateName: 'Valdor',
                zipCode: 'VAL-88000',
                isCapital: true,
                population: 12500000,
                budget: '4.2 Mds',
                mayor: 'Sarah Connor',
                unemployment: 5.2,
                pollution: 65, // AQI
                securityLevel: 2, // 1: Green, 2: Yellow, 3: Orange, 4: Red
                securityText: 'Vigilance',
                crimeIndex: 42,
                
                schedules: [
                    { name: 'Hôtel de Ville (Central)', weekHours: '08:30 - 17:30', weekendHours: '09:00 - 12:00', isOpen: true },
                    { name: 'Annexe Quartier Nord', weekHours: '09:00 - 16:30', weekendHours: 'Fermé', isOpen: false },
                    { name: 'Service État Civil', weekHours: '08:30 - 16:00', weekendHours: '09:00 - 12:00', isOpen: true },
                ],

                services: [
                    { id: 1, name: 'Hôpital Général St. Marc', type: 'Santé', status: 'Opérationnel', staff: 450, capacity: 85, icon: 'fa-solid fa-hospital' },
                    { id: 2, name: 'Commissariat Central', type: 'Police', status: 'Opérationnel', staff: 120, capacity: 40, icon: 'fa-solid fa-shield-cat' },
                    { id: 3, name: 'Lycée Technique Ironhold', type: 'Éducation', status: 'En Grève', staff: 80, capacity: 100, icon: 'fa-solid fa-graduation-cap' },
                    { id: 4, name: 'Caserne Pompiers Nord', type: 'Secours', status: 'Opérationnel', staff: 60, capacity: 10, icon: 'fa-solid fa-fire-extinguisher' },
                    { id: 5, name: 'Tribunal d\'Instance', type: 'Justice', status: 'Saturé', staff: 45, capacity: 98, icon: 'fa-solid fa-scale-balanced' },
                ],

                incidents: [
                    { id: 1, type: 'Cambriolage', location: 'Quartier Résidentiel Sud', time: '14:30', status: 'En cours' },
                    { id: 2, type: 'Accident Route', location: 'Av. de la Libération', time: '12:15', status: 'Traité' },
                    { id: 3, type: 'Tapage Nocturne', location: 'Centre-ville', time: 'Hier', status: 'Clôturé' },
                    { id: 4, type: 'Dégradation', location: 'Parc Central', time: 'Hier', status: 'En attente' },
                ],

                companies: [
                    { id: 1, name: 'Valdor Steelworks', sector: 'Industrie lourde', employees: 12500 },
                    { id: 2, name: 'Drarek TechCenter', sector: 'Technologie', employees: 3400 },
                    { id: 3, name: 'LogiTrans Hub', sector: 'Logistique', employees: 2100 },
                    { id: 4, name: 'Centre Hospitalier', sector: 'Santé (Public)', employees: 1800 },
                    { id: 5, name: 'SuperMart Distribution', sector: 'Commerce', employees: 950 },
                ]
            }
        }
    },
    watch: {
        city: {
            handler() { this.hasUnsavedChanges = true; },
            deep: true
        }
    },
    methods: {
        formatNumber(num) {
            return new Intl.NumberFormat('fr-FR').format(num);
        },
        saveChanges() {
            alert("Simulation: Données ville enregistrées.");
            this.hasUnsavedChanges = false;
        },
        getSecurityColor(level) {
            switch(level) {
                case 1: return 'text-green-400';
                case 2: return 'text-amber-500';
                case 3: return 'text-orange-500';
                case 4: return 'text-red-500';
                default: return 'text-slate-400';
            }
        },
        getSecurityDot(level) {
            switch(level) {
                case 1: return 'bg-green-500';
                case 2: return 'bg-amber-500';
                case 3: return 'bg-orange-500';
                case 4: return 'bg-red-500';
                default: return 'bg-slate-500';
            }
        },
        getServiceIconBg(type) {
            switch(type) {
                case 'Santé': return 'bg-red-500/10 text-red-400';
                case 'Police': return 'bg-blue-500/10 text-blue-400';
                case 'Éducation': return 'bg-amber-500/10 text-amber-400';
                default: return 'bg-slate-700 text-slate-300';
            }
        },
        getServiceStatusClass(status) {
            if (status === 'Opérationnel') return 'border-green-500/30 text-green-400 bg-green-500/10';
            if (status === 'Saturé') return 'border-red-500/30 text-red-400 bg-red-500/10';
            if (status === 'En Grève') return 'border-amber-500/30 text-amber-400 bg-amber-500/10';
            return 'border-slate-600 text-slate-400';
        },
        getIncidentColor(type) {
            if(type.includes('Accident')) return 'bg-orange-500';
            if(type.includes('Cambriolage')) return 'bg-red-500';
            return 'bg-blue-500';
        },
        getIncidentStatusClass(status) {
            if(status === 'En cours') return 'bg-amber-500/20 text-amber-500 border-amber-500/30';
            if(status === 'Traité') return 'bg-green-500/20 text-green-500 border-green-500/30';
            return 'bg-slate-700 text-slate-400 border-slate-600';
        },
        initCharts() {
            this.seriesZonage = [45, 30, 25]
            this.seriesSectors = [15, 45, 40]

            this.optionsZonage = {
                labels: ['Résidentiel', 'Commercial', 'Industriel'],
                chart: { type: 'donut', height: 200, background: 'transparent' },
                colors: ['#3b82f6', '#f59e0b', '#a855f7'],
                legend: { show: false },
                stroke: { show: false },
                theme: { mode: 'dark' },
                plotOptions: { pie: { donut: { size: '65%' } } }
            }

            this.optionsSectors = {
                labels: ['Primaire (Agri/Mines)', 'Secondaire (Indus)', 'Tertiaire (Services)'],
                chart: { type: 'pie', height: 200, background: 'transparent' },
                colors: ['#10b981', '#f97316', '#3b82f6'],
                legend: { position: 'right', labels: { colors: '#94a3b8' }, fontSize: '10px' },
                stroke: { show: false },
                theme: { mode: 'dark' }
            }
        }
    },
    created() {
        setTimeout(() => { this.hasUnsavedChanges = false; }, 100)

        this.initCharts();
    },
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
    color: #64748b;
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
    border-color: #f59e0b;
    outline: none;
    box-shadow: 0 0 0 1px rgba(245, 158, 11, 0.2);
}

/* Readonly Input Style */
.form-input-readonly {
    background-color: rgba(15, 23, 42, 0.3);
    border-color: rgba(51, 65, 85, 0.3);
    color: #94a3b8;
    cursor: not-allowed;
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

/* Status Badge Pulse */
.status-dot {
    height: 8px; width: 8px; border-radius: 50%; display: inline-block; margin-right: 6px;
}
</style>