# PLAN D'ARCHITECTURE : PORTAIL NUMÉRIQUE UNIFIÉ (PNU)

Ce document liste l'intégralité des fonctionnalités prévues pour le PNU. Il sert de référence pour le développement via Claude Code, en respectant l'architecture Domain-Driven Design (DDD) définie dans CLAUDE.md.

1. Principes Fondamentaux & Architecture

- Philosophie : "Once Only" (L'état ne demande jamais une info qu'il possède déjà).
- Sécurité : Tout accès est loggué (Audit Trail immuable inspiré de X-Road).
- Architecture Technique :
    - Backend : Laravel 12 (Domain Driven Design).
    - Frontend : Vue 3 (Options API) + Inertia.
    - Data : MongoDB + Redis (Cache).

2. Cartographie des Domaines (app/Domains/)

La structure est désormais organisée par Acteurs (Contextes), avec des sous-domaines spécifiques.

##### A. Domaine : Guest (Accès Public)

La porte d'entrée du système. Tout ce qui se passe avant d'être identifié.

**Namespace : App\Domains\Guest**

Fonctionnalités :
- Portail d'Accueil : Landing page institutionnelle (Actualités, Météo du monde fictif).
- Smart Authentication :
    - Login via NUI (Numéro Unique).
    - Simulation de lecture de "Carte à Puce" (Smart Card) ou Biométrie.
    - MFA (Multi-Factor Authentication).
- Kiosque Public : Consultation de données publiques ne nécessitant pas de compte (ex: vérifier la validité d'un K-BIS ou d'un diplôme via un QR Code).

##### B. Domaine : Citizen (Espace Citoyen)

Le tableau de bord personnel de l'habitant.

**Namespace : App\Domains\Citizen**

Sous-Fonctionnalités :
- Identity :
    - Profil & Sécurité.
    - Audit Logs (The Watcher) : "Qui a regardé mes données ?".
    - Gestion des mandats (donner accès à sa femme/son mari/son tuteur).
- Family (Gestion du Foyer) :
    - Généalogie Administrative : Visualisation de l'arbre familial (parents, enfants, conjoints) basé sur les liens d'État Civil.
    - Cercle de Confiance : Gestion des procurations familiales.
    - Espace Scolaire (Parent View) :
        - Vue des notes et bulletins des enfants.
        - Signature électronique des absences/retards.
        - Inscription cantine/activités.
- CivilDocuments :
    - Téléchargement d'actes de naissance/mariage signés.
    - Demandes de changement d'état civil.
- Assets :
    - Véhicules : Voir ses cartes grises, vendre un véhicule.
    - Immobilier : Voir ses propriétés (cadastre).
- Health (Patient View) :
    - Accès au DMP (Dossier Médical Partagé).
    - Gestion des consentements d'accès (qui peut voir quoi).
- Taxes :
    - Validation de la déclaration de revenus pré-remplie.
    - Paiement des amendes/impôts.

##### C. Domaine : Company (Espace Entreprise)

Le guichet unique pour les personnes morales.

**Namespace : App\Domains\Company**

Sous-Domaines :
- Administration :
    - Création "1-click" : Obtention immédiate du K-BIS.
    - Gestion des mandataires sociaux.
- HrManagement (Ressources Humaines) :
    - DPAE Unifiée : Déclaration d'embauche connectée (Urssaf/Retraite).
    - Gestion des arrêts maladie (lien avec Ops/Health).
- Accounting (Comptabilité/Fiscalité) :
    - TVA Temps Réel : Déclaration automatisée des flux.
    - Bilan annuel et IS (Impôt sur les Sociétés).
    - Paiement des cotisations.

##### D. Domaine : Ops (Espace Opérations / État)

L'interface des fonctionnaires et professionnels agréés. Interface dense (DataGrids).

**Namespace : App\Domains\Ops**

Sous-Domaines :
- Territory (Gestion du Territoire) :
    - Registry : Gestion du Cadastre et des adresses officielles.
    - Urbanism : Validation des permis de construire.
    - Cities : Gestion des découpages administratifs (Villes, Cantons).
- CivilRegistry (Mairie/État Civil) :
    - Validation des naissances, mariages, décès.
    - Instruction des changements d'identité.
- Education (Écoles & Universités) :
    - SchoolAdmin : Gestion des inscriptions, affectation des classes.
    - TeacherDesk : Saisie des notes, appel (présence), signalement comportement.
    - Diplomas : Certification des diplômes (Blockchain/Signature unique).
- Security (Intérieur & Justice) :
    - Ministère de la défense :
        - Gestion armée et forces de sécurité intérieure (Police, douanes, administration pénitentiaire)
        - Base de données inter-services :
            - Recherche d'individus, vérification véhicules (volés/assurés).
            - Vue en Knowledge Graph pour recouper/relier des données
    - Justice : Accès aux casiers judiciaires.
- Health (Professionnels de Santé) :
    - DoctorDesk : Création de prescriptions, rédaction de rapports médicaux.
    - Pharmacy : Délivrance de médicaments (consommation e-Prescription).
- Politic (Gouvernance) :
    - Organisation des élections.
    - Publication des lois/décrets.

3. Structure des Dossiers (Exemple Concret)

Voici comment cela se traduit physiquement dans le projet Laravel :

app/Domains/
├── Citizen/
│   ├── Family/
│   │   ├── Controllers/ (ex: ShowChildrenGradesController)
│   │   └── Data/
│   ├── CitizenProvider.php
│   └── ...
├── Company/
│   ├── CompanyProvider.php
│   └── ...
├── Guest/
│   ├── GuestProvider.php
│   └── ...
└── Ops/
    ├── Education/
    │   ├── Models/ (ex: StudentRecord, Grade)
    │   └── Controllers/
    ├── OpsProvider.php
    └── ...


4. Structure Frontend (Adaptée)

Layouts :
- GuestLayout.vue : Beau, aéré, institutionnel.
- CitizenLayout.vue : Ergonomique, focus sur "Mes Tâches".
- CompanyLayout.vue : Professionnel, Dashboard analytique.
- OpsLayout.vue : Haute densité, Hotkeys, Mode sombre par défaut ?
- Routing Vue (Inertia) :
    - Pages stockées dans : resources/js/Pages/{Domain}/{SubDomain}/...

5. Exemple de Workflow : "Prescription Médicale"

Ce workflow traverse plusieurs domaines, montrant l'intérêt de la séparation.

- Ops/Health : Le Médecin (Ops) crée une Prescription pour le patient (via son NUI).
- Action : App\Domains\Ops\Health\Controllers\CreatePrescriptionController
- Citizen : Le patient reçoit une notification et voit l'ordonnance dans son Wallet.
- Vue : App\Domains\Citizen\Controllers\ShowHealthRecordController
- Ops/Health : Le Pharmacien scanne le QR code du patient, voit l'ordonnance, délivre les produits.
- Action : App\Domains\Ops\Health\Controllers\DeliverPrescriptionController