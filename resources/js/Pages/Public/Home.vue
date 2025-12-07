<template>
    <body class="font-sans antialiased bg-slate-50 text-slate-600">
        <section class="hero-gradient relative text-white pb-32 lg:pb-48">
            <nav class="relative z-50 max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center backdrop-blur-sm border border-white/20">
                        <i class="fa-solid fa-landmark text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="block font-bold text-lg tracking-tight uppercase">Drarekstanie</span>
                        <span class="block text-[10px] text-indigo-200 uppercase tracking-widest">Portail Numérique Unifié</span>
                    </div>
                </div>

                <div class="hidden md:flex items-center gap-8 text-sm font-medium text-indigo-100">
                    <a href="/services" class="hover:text-white transition">Services</a>
                    <a href="#" class="hover:text-white transition">Actualités</a>
                    <a href="#" class="hover:text-white transition">Aide</a>
                    <a href="#" class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-full border border-white/20 transition flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i> Vérifier un doc.
                    </a>
                </div>
            </nav>

            <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12 lg:mt-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/30 border border-indigo-400/30 text-indigo-100 text-xs font-semibold tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Systèmes Opérationnels
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        L'État simplifié,<br>pour tous.
                    </h1>

                    <p class="text-lg text-indigo-100/80 max-w-xl mx-auto lg:mx-0">
                        Une interface unique pour vos démarches citoyennes et professionnelles. Rapide, sécurisée, et accessible 24/7.
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start text-sm font-medium text-indigo-200 pt-4">
                        <span class="flex items-center gap-2"><i class="fa-solid fa-check-circle text-green-400"></i> DrarekConnect+</span>
                        <span class="flex items-center gap-2"><i class="fa-solid fa-lock text-green-400"></i> Données chiffrées</span>
                    </div>
                </div>

                <div class="flex flex-col gap-4 max-w-md mx-auto w-full">
                    <div class="bg-white rounded-2xl p-6 shadow-xl text-gray-800">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">Espace Citoyen</h3>
                                <p class="text-xs text-gray-500">Particuliers & Familles</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        </div>

                        <a href="/login/citizen" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg shadow-indigo-500/30 transition-all flex items-center justify-center gap-2">
                            Connexion ID-Num
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <div class="mt-4 flex gap-3 text-xs font-medium">
                            <button class="flex-1 py-2 rounded border border-gray-200 hover:bg-gray-50 text-gray-600 transition">
                                <i class="fa-solid fa-fingerprint mr-1"></i> Biométrique
                            </button>
                            <button class="flex-1 py-2 rounded border border-gray-200 hover:bg-gray-50 text-gray-600 transition">
                                Créer compte
                            </button>
                        </div>
                    </div>

                    <div class="bg-slate-900 rounded-2xl p-6 shadow-2xl border border-slate-700 text-white">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Espace Pro</h3>
                                <p class="text-xs text-slate-400">Entreprises & Administrations</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-white border border-slate-600">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <a href="/login/pro" class="w-full py-3 bg-white hover:bg-gray-100 text-slate-900 font-bold rounded-lg shadow transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-briefcase text-indigo-900"></i>
                                Gestion Entreprise
                            </a>

                            <a href="/login/ops" class="w-full py-3 bg-slate-800 hover:bg-slate-700 border border-slate-600 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2 group">
                                <i class="fa-solid fa-user-shield text-slate-400 group-hover:text-white transition-colors"></i>
                                Accès Agents Publics
                            </a>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-800 text-center">
                            <p class="text-[10px] text-slate-500 flex items-center justify-center gap-1">
                                <i class="fa-solid fa-lock text-[9px]"></i> Accès sécurisé (Carte Pro / FIDO2)
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="custom-shape-divider-bottom">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>
        </section>

        <section class="py-16 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-slate-900">Accès Rapide aux Services</h2>
                    <div class="w-16 h-1 bg-indigo-600 mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 card-hoverable cursor-pointer group">
                        <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-heart-pulse text-xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">Santé & Social</h3>
                        <p class="text-sm text-slate-500">Dossier médical, remboursements, vaccinations.</p>
                    </div>

                    <!-- Carte Service 2 -->
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 card-hoverable cursor-pointer group">
                        <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">Fiscalité</h3>
                        <p class="text-sm text-slate-500">Déclarations, paiements, taxes foncières.</p>
                    </div>

                    <!-- Carte Service 3 -->
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 card-hoverable cursor-pointer group">
                        <div class="w-12 h-12 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-id-card text-xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">État Civil</h3>
                        <p class="text-sm text-slate-500">Passeports, mariages, actes de naissance.</p>
                    </div>

                    <!-- Carte Service 4 -->
                    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 card-hoverable cursor-pointer group">
                        <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mb-4 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-1">Emploi</h3>
                        <p class="text-sm text-slate-500">Recherche d'emploi, droits chômage, formations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION ACTUALITÉS (Version Simplifiée) -->
        <section class="py-16 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900">Actualités Officielles</h2>
                        <p class="text-slate-500 mt-1 text-sm">Les dernières annonces du gouvernement.</p>
                    </div>
                    <a href="#" class="text-indigo-600 text-sm font-semibold hover:underline">Voir tout <i class="fa-solid fa-arrow-right ml-1"></i></a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- News 1 -->
                    <div class="group cursor-pointer">
                        <div class="h-48 rounded-xl bg-gray-200 overflow-hidden relative mb-4">
                            <!-- Placeholder Image -->
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center text-slate-600">
                                <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Cyber" class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition duration-500">
                            </div>
                            <span class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase">Numérique</span>
                        </div>
                        <span class="text-xs text-slate-400 block mb-1">12 Décembre 2025</span>
                        <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">Lancement de l'Identité Numérique 2.0</h3>
                        <p class="text-sm text-slate-500 mt-2 line-clamp-2">Votre carte d'identité est désormais disponible sur mobile avec une sécurité renforcée.</p>
                    </div>

                    <!-- News 2 -->
                    <div class="group cursor-pointer">
                        <div class="h-48 rounded-xl bg-gray-200 overflow-hidden relative mb-4">
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center text-slate-600">
                                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Finance" class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition duration-500">
                            </div>
                            <span class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-bold px-2 py-1 rounded uppercase">Économie</span>
                        </div>
                        <span class="text-xs text-slate-400 block mb-1">10 Décembre 2025</span>
                        <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">Réforme fiscale : Ce qui change en 2026</h3>
                        <p class="text-sm text-slate-500 mt-2 line-clamp-2">Le ministère annonce de nouvelles tranches pour l'impôt sur le revenu.</p>
                    </div>

                    <!-- News 3 -->
                    <div class="group cursor-pointer">
                        <div class="h-48 rounded-xl bg-gray-200 overflow-hidden relative mb-4">
                            <div class="w-full h-full bg-slate-800 flex items-center justify-center text-slate-600">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Santé" class="object-cover w-full h-full opacity-80 group-hover:scale-105 transition duration-500">
                            </div>
                            <span class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded uppercase">Santé</span>
                        </div>
                        <span class="text-xs text-slate-400 block mb-1">08 Décembre 2025</span>
                        <h3 class="font-bold text-slate-800 group-hover:text-indigo-600 transition">Campagne de vaccination hivernale</h3>
                        <p class="text-sm text-slate-500 mt-2 line-clamp-2">Ouverture des centres dans toutes les grandes villes de la république.</p>
                    </div>
                </div>
            </div>
        </section>

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

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: { Link },
    mounted() {
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.remove('bg-transparent', 'py-4');
                navbar.classList.add('bg-brand-950/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
            } else {
                navbar.classList.add('bg-transparent', 'py-4');
                navbar.classList.remove('bg-brand-950/90', 'backdrop-blur-md', 'shadow-md', 'py-2');
            }
        })
    },
}
</script>

<style scoped>
body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc; /* Fond clair général */
    color: #1e293b;
}

.hero-gradient {
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
}

/* Courbe de séparation (Wave) */
.custom-shape-divider-bottom {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-bottom svg {
    position: relative;
    display: block;
    width: calc(138% + 1.3px);
    height: 80px;
}

.custom-shape-divider-bottom .shape-fill {
    fill: #f8fafc;
}

.card-hoverable {
    transition: all 0.3s ease;
}

.card-hoverable:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
}
</style>