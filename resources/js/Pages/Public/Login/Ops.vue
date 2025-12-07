<template>
    <body class="bg-slate-950 text-slate-200 h-screen overflow-hidden flex">
        <div class="hidden lg:flex w-7/12 relative bg-slate-900 overflow-hidden items-center justify-center">
            <div class="absolute inset-0 opacity-40">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" alt="Data Network" class="w-full h-full object-cover grayscale brightness-50 contrast-125">
            </div>

            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/50 to-slate-950"></div>
            <div class="scanline"></div>

            <div class="relative z-10 max-w-lg p-8 border-l-2 border-amber-500/50 bg-slate-950/60 backdrop-blur-sm">
                <div class="flex items-center gap-3 mb-4 text-amber-500">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                    <span class="font-bold tracking-widest uppercase text-sm">Réseau Gouvernemental Sécurisé</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Système Unifié de Gestion Opérationnelle</h1>
                <p class="text-slate-400 leading-relaxed text-sm">
                    Vous accédez à une infrastructure critique de l'État. 
                    Toutes les actions effectuées sur ce terminal sont journalisées, horodatées et rattachées à votre matricule.
                </p>

                <div class="mt-8 flex gap-4 text-xs font-mono text-slate-500">
                    <div>
                        <span class="block text-slate-600 uppercase">Statut Serveur</span>
                        <span class="text-green-500">● NOMINAL</span>
                    </div>
                    <div>
                        <span class="block text-slate-600 uppercase">Niveau Menace</span>
                        <span class="text-yellow-500">● VIGILANCE</span>
                    </div>
                    <div>
                        <span class="block text-slate-600 uppercase">Version</span>
                        <span>v4.2.0-secure</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-5/12 flex flex-col justify-center items-center p-8 bg-slate-950 relative border-l border-slate-800">
            <a href="/" class="absolute top-8 right-8 text-sm text-slate-500 hover:text-white transition flex items-center gap-2">
                Retour Portail Public <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>

            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-900 border border-slate-700 mb-6 shadow-lg shadow-amber-900/10">
                        <i class="fa-solid fa-fingerprint text-2xl text-amber-500"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white tracking-tight">Identification Agent</h2>
                    <p class="mt-2 text-sm text-slate-400">Insérez votre carte professionnelle ou saisissez vos identifiants.</p>
                </div>

                <form class="mt-8 space-y-6" method="post" action="/login/ops">
                    <input type="hidden" name="_token" :value="csrf_token">

                    <div class="space-y-4">
                        <div>
                            <label for="matricule" class="block text-xs font-mono font-medium text-amber-500/80 mb-1 uppercase">Matricule OPS / ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-id-badge text-slate-500"></i>
                                </div>
                                <input id="matricule" name="email" type="text" required class="input-terminal block w-full pl-10 pr-3 py-3 rounded text-sm placeholder-slate-600" placeholder="EX: AGT-8842-X">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-mono font-medium text-amber-500/80 mb-1 uppercase">Code de sécurité</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-key text-slate-500"></i>
                                </div>
                                <input id="password" name="password" type="password" required class="input-terminal block w-full pl-10 pr-3 py-3 rounded text-sm placeholder-slate-600" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-3 border border-slate-800 bg-slate-900/50 rounded cursor-pointer hover:border-slate-600 transition group">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-usb text-slate-400 group-hover:text-white"></i>
                                <div class="text-xs">
                                    <span class="block text-slate-300 font-medium">Clé de sécurité physique</span>
                                    <span class="text-slate-500">Non détectée</span>
                                </div>
                            </div>
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-slate-700 bg-slate-800 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900">
                            <label for="remember-me" class="ml-2 block text-xs text-slate-400">Maintenir session (4h)</label>
                        </div>

                        <div class="text-xs">
                            <a href="#" class="font-medium text-amber-500 hover:text-amber-400">Procédure de perte ?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded text-slate-900 bg-amber-500 hover:bg-amber-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-amber-500 transition-all">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fa-solid fa-unlock text-amber-800 group-hover:text-amber-900"></i>
                            </span>
                            INITIALISER LA CONNEXION
                        </button>
                    </div>
                </form>

                <div class="mt-6 border-t border-slate-800 pt-6">
                    <div class="flex items-start gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-red-500 mt-0.5 text-xs"></i>
                        <p class="text-[10px] text-slate-500 leading-tight text-justify">
                            <strong class="text-slate-400">AVERTISSEMENT LÉGAL :</strong> L'accès à ce système est strictement réservé au personnel autorisé par le Ministère de l'Intérieur ou la Direction des Services Numériques. Toute tentative d'intrusion, de contournement des mesures de sécurité ou d'usage frauduleux est passible de poursuites pénales (Article 323-1 du Code Pénal de Drarekstanie) et d'une radiation immédiate. Votre adresse IP <span class="font-mono text-slate-400">192.168.X.X</span> a été enregistrée.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>

<script>
export default {
    data: function () {
        return {
            csrf_token: null,
        }
    },
    created: function () {
        this.csrf_token = document.head.querySelector('meta[name="csrf-token"]').content
    },
}
</script>

<style scoped>
.scanline {
    width: 100%;
    height: 100px;
    z-index: 10;
    background: linear-gradient(0deg, rgba(0,0,0,0) 0%, rgba(245, 158, 11, 0.03) 50%, rgba(0,0,0,0) 100%);
    opacity: 0.1;
    position: absolute;
    bottom: 100%;
    animation: scanline 10s linear infinite;
    pointer-events: none;
}

@keyframes scanline {
    0% { bottom: 100%; }
    100% { bottom: -100px; }
}

/* Input style "Terminal" */
.input-terminal {
    background-color: rgba(30, 41, 59, 0.5);
    border: 1px solid rgba(71, 85, 105, 0.5);
    color: white;
    transition: all 0.3s ease;
}

.input-terminal:focus {
    background-color: rgba(30, 41, 59, 0.8);
    border-color: #f59e0b; /* Amber-500 */
    outline: none;
    box-shadow: 0 0 0 1px rgba(245, 158, 11, 0.2);
}
</style>