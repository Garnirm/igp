<template>
    <body class="font-sans antialiased bg-slate-50 text-slate-600">
        <header class="header-gradient text-white shadow-lg">
            <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 bg-white/10 rounded flex items-center justify-center border border-white/20 group-hover:bg-white/20 transition">
                        <i class="fa-solid fa-landmark text-white text-sm"></i>
                    </div>
                    <div>
                        <span class="block font-bold text-sm tracking-wide uppercase">Drarekstanie</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-6 text-sm font-medium text-indigo-100">
                    <a href="#" class="text-white font-semibold">Catalogue des Services</a>
                    <a href="#" class="hover:text-white transition">Mes Dossiers</a>
                    <div class="h-4 w-px bg-indigo-400/50"></div>
                    <a href="#" class="flex items-center gap-2 hover:text-white transition">
                        <i class="fa-solid fa-user-circle"></i> Connexion
                    </a>
                </div>
            </nav>

            <div class="max-w-3xl mx-auto px-6 py-12 text-center">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">De quoi avez-vous besoin ?</h1>
                <p class="text-indigo-200 text-sm mb-6">Accédez à plus de 150 démarches administratives en ligne.</p>
                
                <div class="relative max-w-xl mx-auto">
                    <input type="text" placeholder="Rechercher une démarche (ex: Passeport, Impôts, Permis...)" 
                        class="w-full pl-12 pr-4 py-4 rounded-full shadow-xl border-none outline-none text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-400">
                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-indigo-500 text-lg">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
            </div>
        </header>

        <div class="border-b border-gray-200 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-3">
                <nav class="flex text-xs text-slate-500" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/" class="hover:text-indigo-600"><i class="fa-solid fa-house mr-2"></i>Accueil</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fa-solid fa-chevron-right text-slate-300 mx-2"></i>
                                <span class="font-medium text-slate-900">Catalogue des Services</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <main class="max-w-7xl mx-auto px-6 py-12 flex-grow">
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">Vie Citoyenne & Famille</h2>
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-bold uppercase rounded">Particuliers</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                                <i class="fa-solid fa-address-card text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-blue-600 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Identité & État Civil</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-blue-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Renouvellement Passeport / CNI</li>
                            <li class="hover:text-blue-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Acte de naissance / Décès</li>
                            <li class="hover:text-blue-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Recensement citoyen</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition">
                                <i class="fa-solid fa-heart-pulse text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-red-600 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Santé & Social</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-red-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Mon Dossier Médical Partagé</li>
                            <li class="hover:text-red-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Carte de Vaccination</li>
                            <li class="hover:text-red-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Annuaire des Hôpitaux</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                                <i class="fa-solid fa-coins text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-emerald-600 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Impôts & Finances</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-emerald-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Déclarer ses revenus</li>
                            <li class="hover:text-emerald-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Taxe d'habitation / Foncière</li>
                            <li class="hover:text-emerald-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Payer une amende</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center group-hover:bg-slate-600 group-hover:text-white transition">
                                <i class="fa-solid fa-car text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-slate-600 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Transports & Mobilité</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-slate-700 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Permis de conduire (Points)</li>
                            <li class="hover:text-slate-700 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Certificat d'immatriculation</li>
                            <li class="hover:text-slate-700 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Info Trafic National</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition">
                                <i class="fa-solid fa-graduation-cap text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-amber-600 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Éducation & Jeunesse</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-amber-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Inscription scolaire</li>
                            <li class="hover:text-amber-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Résultats examens nationaux</li>
                            <li class="hover:text-amber-600 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Demande de bourse</li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-gray-200 service-card cursor-pointer group">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-900 flex items-center justify-center group-hover:bg-indigo-900 group-hover:text-white transition">
                                <i class="fa-solid fa-scale-balanced text-lg"></i>
                            </div>
                            <i class="fa-solid fa-arrow-right text-gray-300 group-hover:text-indigo-900 transition -rotate-45 group-hover:rotate-0"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Justice & Droits</h3>
                        <ul class="text-sm text-slate-500 space-y-2">
                            <li class="hover:text-indigo-900 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Extrait de Casier Judiciaire</li>
                            <li class="hover:text-indigo-900 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Pré-plainte en ligne</li>
                            <li class="hover:text-indigo-900 flex items-center gap-2"><i class="fa-solid fa-caret-right text-xs"></i> Aide Juridictionnelle</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <div class="flex items-center gap-3 mb-8">
                    <h2 class="text-2xl font-bold text-slate-900">Espace Entreprises</h2>
                    <span class="px-2 py-1 bg-slate-800 text-yellow-500 text-[10px] font-bold uppercase rounded border border-yellow-500/30">Professionnels</span>
                </div>

                <div class="bg-slate-900 rounded-2xl p-8 shadow-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-slate-800 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 opacity-50"></div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative z-10">
                        <div class="md:col-span-1">
                            <h3 class="text-xl font-bold text-white mb-2">Le Guichet Unique</h3>
                            <p class="text-slate-400 text-sm mb-4">Centralisez toutes vos démarches administratives, fiscales et sociales pour votre entreprise.</p>
                            <a href="#" class="inline-flex items-center text-sm font-semibold text-yellow-500 hover:text-yellow-400 transition">
                                Accéder au portail Pro <i class="fa-solid fa-external-link-alt ml-2"></i>
                            </a>
                        </div>

                        <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="bg-slate-800/50 p-4 rounded-lg border border-slate-700 hover:border-yellow-500/50 transition cursor-pointer">
                                <i class="fa-solid fa-building text-yellow-500 mb-3 text-xl"></i>
                                <h4 class="font-bold text-sm mb-1">Création & Cession</h4>
                                <p class="text-xs text-slate-400">Immatriculation, KBIS, modification de statuts.</p>
                            </div>

                            <div class="bg-slate-800/50 p-4 rounded-lg border border-slate-700 hover:border-yellow-500/50 transition cursor-pointer">
                                <i class="fa-solid fa-briefcase text-yellow-500 mb-3 text-xl"></i>
                                <h4 class="font-bold text-sm mb-1">Emploi & Charges</h4>
                                <p class="text-xs text-slate-400">Déclarations sociales, recrutement, apprentissage.</p>
                            </div>

                            <div class="bg-slate-800/50 p-4 rounded-lg border border-slate-700 hover:border-yellow-500/50 transition cursor-pointer">
                                <i class="fa-solid fa-globe text-yellow-500 mb-3 text-xl"></i>
                                <h4 class="font-bold text-sm mb-1">Import / Export</h4>
                                <p class="text-xs text-slate-400">Douanes, TVA intracommunautaire, normes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-map text-indigo-600"></i> Territoire & Cadastre
                    </h3>
                    <div class="bg-slate-100 rounded-lg h-48 flex items-center justify-center mb-4 relative overflow-hidden group">
                        <!-- Placeholder Map -->
                        <div class="absolute inset-0 bg-[url('https://img.freepik.com/free-vector/grey-world-map_1053-431.jpg?w=1060')] bg-cover bg-center opacity-40 grayscale group-hover:grayscale-0 transition duration-500"></div>
                        <button class="relative bg-white px-4 py-2 rounded shadow text-sm font-semibold text-indigo-600 hover:bg-indigo-50 transition">
                            Consulter la carte
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <a href="#" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded text-slate-600 transition">Liste des États</a>
                        <a href="#" class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded text-slate-600 transition">Liste des Villes</a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl border border-gray-200">
                    <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-landmark-flag text-indigo-600"></i> Institutions
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center justify-between p-3 rounded bg-slate-50 hover:bg-indigo-50 group transition">
                            <span class="text-sm font-medium text-slate-700 group-hover:text-indigo-700">Gouvernement Fédéral</span>
                            <i class="fa-solid fa-chevron-right text-xs text-slate-300 group-hover:text-indigo-500"></i>
                        </a>
                        <a href="#" class="flex items-center justify-between p-3 rounded bg-slate-50 hover:bg-indigo-50 group transition">
                            <span class="text-sm font-medium text-slate-700 group-hover:text-indigo-700">Assemblée & Sénat</span>
                            <i class="fa-solid fa-chevron-right text-xs text-slate-300 group-hover:text-indigo-500"></i>
                        </a>
                        <a href="#" class="flex items-center justify-between p-3 rounded bg-slate-50 hover:bg-indigo-50 group transition">
                            <span class="text-sm font-medium text-slate-700 group-hover:text-indigo-700">Ambassades & Consulats</span>
                            <i class="fa-solid fa-chevron-right text-xs text-slate-300 group-hover:text-indigo-500"></i>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white border-t border-gray-200 py-8">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-xs text-gray-500">
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center gap-2 mb-4 text-indigo-900 font-bold">
                        <i class="fa-solid fa-flag"></i> République de Drarekstanie
                    </div>
                    <p>© 2025 Tous droits réservés.</p>
                </div>

                <div class="flex flex-col gap-2">
                    <h4 class="font-semibold text-gray-900 mb-1">Services</h4>
                    <a href="#" class="hover:text-indigo-600 transition">Mentions Légales</a>
                    <a href="#" class="hover:text-indigo-600 transition">Données Personnelles</a>
                    <a href="#" class="hover:text-indigo-600 transition">Accessibilité</a>
                </div>

                <div class="flex flex-col gap-2">
                    <h4 class="font-semibold text-gray-900 mb-1">Aide</h4>
                    <a href="#" class="hover:text-indigo-600 transition">Contact & Support</a>
                    <a href="#" class="hover:text-indigo-600 transition">Plan du site</a>
                    <a href="#" class="hover:text-indigo-600 transition">FAQ</a>
                </div>

                <!-- SECTION ACCES RÉSERVÉS (Le God Mode est ici) -->
                <div class="flex flex-col gap-2 p-3 bg-gray-50 rounded border border-gray-100">
                    <h4 class="font-semibold text-gray-900 mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-lock text-xs text-gray-400"></i> Accès Réservés
                    </h4>
                    <a href="#" class="hover:text-indigo-600 transition flex items-center gap-1">
                        Portail Agents Publics
                    </a>
                    <a href="#" class="hover:text-indigo-600 transition flex items-center gap-1">
                        Intranet Ministériel
                    </a>
                </div>
            </div>
        </footer>
    </body>
</template>

<style scoped>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
    color: #1e293b;
}

.header-gradient {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
}

.service-card {
    transition: all 0.2s ease-in-out;
}

.service-card:hover {
    transform: translateY(-2px);
    border-color: #6366f1;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
</style>