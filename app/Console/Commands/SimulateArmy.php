<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SimulateArmy extends Command
{
    private array $materiels = [];
    private array $roles = [];

    private int $nb_militaires = 0;
    private int $nb_police = 0;
    private int $nb_civils = 0;

    protected $signature = 'simulate:army';

    public function handle(): int
    {
        $templates = [
            'Station militaire de surveillance spatiale' => [ 'path' => 'ArmeeAir/CentreSpatial/StationSurveillanceSpatiale.json', 'number' => 3 ],
            'Unité mobile de surveillance spatiale' => [ 'path' => 'ArmeeAir/CentreSpatial/UniteMobileSurveillanceSpatiale.json', 'number' => 2 ],
            'Radar aérien' => [ 'path' => 'ArmeeAir/DefenseControleAerien/RadarAerien.json', 'number' => 50 ],
            'Sémaphore' => [ 'path' => 'ArmeeAir/DefenseControleAerien/Semaphore.json', 'number' => 79 ],
            'Escadron de sûreté aérienne' => [ 'path' => 'ArmeeAir/DefenseControleAerien/SureteAerienne.json', 'number' => 51 ],
            'Escadron d\'excellence en manoeuvres aériennes' => [ 'path' => 'ArmeeAir/ForcesAeriennesCombat/ExcellenceManoeuvresAeriennes.json', 'number' => 4 ],
            'Escadron d\'hélicoptères de combat' => [ 'path' => 'ArmeeAir/ForcesAeriennesCombat/HelicopteresCombat.json', 'number' => 47 ],
            'Escadron de soutien aérien' => [ 'path' => 'ArmeeAir/ForcesAeriennesCombat/SoutienAerien.json', 'number' => 36 ],
            'Fusiliers de l\'air' => [ 'path' => 'ArmeeAir/ForcesProtectionAppui/FusiliersAir.json', 'number' => 258 ],
            'Pompiers de l\'air' => [ 'path' => 'ArmeeAir/ForcesProtectionAppui/PompiersAir.json', 'number' => 258 ],
            'Escadron d\'hélicoptères' => [ 'path' => 'ArmeeAir/MobiliteAerienne/Helicopteres.json', 'number' => 64 ],
            'Escadron de ravitaillement aérien' => [ 'path' => 'ArmeeAir/MobiliteAerienne/RavitaillementAerien.json', 'number' => 29 ],
            'Escadron de transport aérien' => [ 'path' => 'ArmeeAir/MobiliteAerienne/TransportAerien.json', 'number' => 52 ],
            'Escadron de transport aérien des commandements' => [ 'path' => 'ArmeeAir/MobiliteAerienne/TransportAerienCommandements.json', 'number' => 1 ],
            'Escadron de transport aérien gouvernemental' => [ 'path' => 'ArmeeAir/MobiliteAerienne/TransportAerienGouvernemental.json', 'number' => 1 ],
            'Régiment d\'artillerie' => [ 'path' => 'ArmeeTerre/ForcesAppui/Artillerie.json', 'number' => 49 ],
            'Régiment d\'artillerie de montagne' => [ 'path' => 'ArmeeTerre/ForcesAppui/ArtillerieMontagne.json', 'number' => 7 ],
            'Régiment d\'aviation légère' => [ 'path' => 'ArmeeTerre/ForcesAppui/AviationLegere.json', 'number' => 30 ],
            'Régiment cynophile' => [ 'path' => 'ArmeeTerre/ForcesAppui/Cynophile.json', 'number' => 6 ],
            'Régiment du génie' => [ 'path' => 'ArmeeTerre/ForcesAppui/Genie.json', 'number' => 51 ],
            'Régiment du génie de montagne' => [ 'path' => 'ArmeeTerre/ForcesAppui/GenieMontagne.json', 'number' => 4 ],
            'Régiment de cavalerie blindée' => [ 'path' => 'ArmeeTerre/ForcesMelee/CavalerieBlindee.json', 'number' => 58 ],
            'Régiment de chars' => [ 'path' => 'ArmeeTerre/ForcesMelee/Chars.json', 'number' => 52 ],
            'Régiment de chasseurs' => [ 'path' => 'ArmeeTerre/ForcesMelee/Chasseurs.json', 'number' => 62 ],
            'Régiment de chasseurs alpins' => [ 'path' => 'ArmeeTerre/ForcesMelee/ChasseursAlpins.json', 'number' => 33 ],
            'Régiment d\'infanterie' => [ 'path' => 'ArmeeTerre/ForcesMelee/Infanterie.json', 'number' => 88 ],
            'Régiment de marines' => [ 'path' => 'ArmeeTerre/ForcesMelee/Marines.json', 'number' => 40 ],
            'Régiment de projection rapide' => [ 'path' => 'ArmeeTerre/ForcesMelee/ProjectionRapide.json', 'number' => 56 ],
            'Régiment de distribution des essences' => [ 'path' => 'ArmeeTerre/ForcesSoutien/DistributionEssences.json', 'number' => 68 ],
            'Régiment de logistique' => [ 'path' => 'ArmeeTerre/ForcesSoutien/Logistique.json', 'number' => 56 ],
            'Régiment de soutien à l\'homme' => [ 'path' => 'ArmeeTerre/ForcesSoutien/SoutienHomme.json', 'number' => 47 ],
            'Régiment du train parachutiste' => [ 'path' => 'ArmeeTerre/ForcesSoutien/TrainParachutiste.json', 'number' => 52 ],
            'Régiment de transmissions' => [ 'path' => 'ArmeeTerre/ForcesSoutien/Transmissions.json', 'number' => 25 ],
            'Atelier de maintenance et de pliage de parachutes' => [ 'path' => 'CGA/MaintenanceParachutes/AtelierMaintenancePliage.json', 'number' => 83 ],
            'Centre de stockage militaire' => [ 'path' => 'CGA/SSMD/CentreStockage.json', 'number' => 6 ],
            'Station ferroviaire de la défense' => [ 'path' => 'CGA/ServiceFerroviaire/StationFerroviaireDefense.json', 'number' => 16 ],
            'Datacenter de la défense' => [ 'path' => 'CMSD/DGSIC/Datacenter.json', 'number' => 2 ],
            'Bataillon Darnia' => [ 'path' => 'CMSD/ForcesSpeciales/Darnia.json', 'number' => 22 ],
            'Bataillon Génie de l\'air' => [ 'path' => 'CMSD/ForcesSpeciales/GenieAir.json', 'number' => 12 ],
            'Bataillon RLD' => [ 'path' => 'CMSD/ForcesSpeciales/RenseignementLongueDuree.json', 'number' => 8 ],
            'Groupement d\'artillerie parachutiste' => [ 'path' => 'CMSD/GroupPara/GroupArtillPara.json', 'number' => 56 ],
            'Groupement de chasseurs parachutistes' => [ 'path' => 'CMSD/GroupPara/GroupChassPara.json', 'number' => 62 ],
            'Groupement commando montagne' => [ 'path' => 'CMSD/GroupPara/GroupComdoMont.json', 'number' => 33 ],
            'Groupement génie parachutiste' => [ 'path' => 'CMSD/GroupPara/GroupGeniePara.json', 'number' => 55 ],
            'Groupement d\'infanterie parachutiste' => [ 'path' => 'CMSD/GroupPara/GroupInfanteriePara.json', 'number' => 88 ],
            'Groupement spécial des Marines' => [ 'path' => 'CMSD/GroupPara/GroupSpecialMarines.json', 'number' => 40 ],
            'Groupe de protection de l\'hôpital militaire' => [ 'path' => 'CMSD/ProtectionHopitaux/GroupeProtection.json', 'number' => 55 ],
            'Antenne fédérale de la sécurité intérieure' => [ 'path' => 'CMSD/SecuriteInterieure/Antenne.json', 'number' => 51 ],
            'Champ de lancement de missiles nucléaires' => [ 'path' => 'CMSD/ServiceSpecialNucleaire/ChampLancementMissilesNucleaires.json', 'number' => 2 ],
            'Escadron de dépôts spéciaux' => [ 'path' => 'CMSD/ServiceSpecialNucleaire/EscadronDepotSpecial.json', 'number' => 0 ],
            'Black site' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/RenseignementHumain/BlackSite.json', 'number' => 2 ],
            'Station d\'ambassade' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsAmbassade/Station.json', 'number' => 0 ],
            'Station conjointe de renseignement' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsConjointesRenseignement/Station.json', 'number' => 0 ],
            'Sous-direction fédérale des actions défensives électroniques' => [ 'path' => 'CMSD/ServicesSecrets/Technique/GuerreElectronique/SousdirDefense.json', 'number' => 25 ],
            'Frégate de renseignement' => [ 'path' => 'CMSD/ServicesSecrets/Technique/RenseignementTechnique/FregateRenseignement.json', 'number' => 7 ],
            'Groupe mobile de renseignement électronique' => [ 'path' => 'CMSD/ServicesSecrets/Technique/RenseignementTechnique/GroupeMobileRensElectro.json', 'number' => 5 ],
            'Groupe de gestion des infrastructures aériennes' => [ 'path' => 'EMIA/GestionBases/InfrasAeriennes.json', 'number' => 258 ],
            'Groupe de gestion des infrastructures navales' => [ 'path' => 'EMIA/GestionBases/InfrasNavales.json', 'number' => 80 ],
            'Groupe de gestion des infrastructures radars' => [ 'path' => 'EMIA/GestionBases/InfrasRadars.json', 'number' => 128 ],
            'Groupe de gestion des infrastructures terrestres' => [ 'path' => 'EMIA/GestionBases/InfrasTerrestres.json', 'number' => 519 ],
            'Groupe de gestion des infrastructures policières' => [ 'path' => 'EMIA/GestionBases/InfrasPolicieres.json', 'number' => 51 ],
            'Centre de triage de la poste militaire' => [ 'path' => 'EMIA/PosteInterArmees/CentreTriage.json', 'number' => 2 ],
            'Ecole de l\'appui aérien' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/AppuiAerien.json', 'number' => 1 ],
            'Ecole d\'aviation de chasse' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/AviationChasse.json', 'number' => 1 ],
            'Ecole d\'aviation militaire' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/AviationMilitaire.json', 'number' => 1 ],
            'Centre inter-armées de formation à l\'appui-feu' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/FormationAppuiFeu.json', 'number' => 0 ],
            'Centre d\'instruction des équipages' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/InstructionEquipages.json', 'number' => 0 ],
            'Centre d\'instruction au parachutisme' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/InstructionParachutisme.json', 'number' => 1 ],
            'Ecole des métiers d\'essais en vol' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/MetiersEssaisVol.json', 'number' => 1 ],
            'Ecole de pilotage d\'hélicoptères' => [ 'path' => 'Ecole/Ecoles/FormationAeronautique/PilotageHelicoptere.json', 'number' => 2 ],
            'Ecole d\'artillerie' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/Artillerie.json', 'number' => 0 ],
            'Ecole de cavalerie' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/Cavalerie.json', 'number' => 1 ],
            'Ecole de combat en montagne' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/CombatMontagne.json', 'number' => 1 ],
            'Ecole de combat urbain' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/CombatUrbain.json', 'number' => 1 ],
            'Ecole de formation initiale' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/FormationInitiale.json', 'number' => 2 ],
            'Ecole du génie' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/Genie.json', 'number' => 0 ],
            'Ecole d\'infanterie' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/Infanterie.json', 'number' => 1 ],
            'Centre d\'instruction au ski militaire' => [ 'path' => 'Ecole/Ecoles/FormationCombatTerrestre/InstructionSkiMilitaire.json', 'number' => 1 ],
            'Ecole d\'officiers' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/FormationOfficiers.json', 'number' => 1 ],
            'Ecole de sous-officiers' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/FormationSousofficiers.json', 'number' => 2 ],
            'Ecole d\'image et de journalisme' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/ImageJournalisme.json', 'number' => 1 ],
            'Ecole d\'interprétation de l\'imagerie' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/InterpretationImagerie.json', 'number' => 0 ],
            'Ecole d\'enseignement du commandement' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/EnseignementCommandement.json', 'number' => 1 ],
            'Ecole navale' => [ 'path' => 'Ecole/Ecoles/FormationNavale/FormationNavale.json', 'number' => 2 ],
            'Ecole navale de garde-côtière' => [ 'path' => 'Ecole/Ecoles/FormationNavale/GardeCotiere.json', 'number' => 0 ],
            'Ecole navale de sous-mariniers' => [ 'path' => 'Ecole/Ecoles/FormationNavale/SousMariniers.json', 'number' => 0 ],
            'Ecole de la garde nationale' => [ 'path' => 'Ecole/Ecoles/FormationSecuriteInterieure/GardeNationale.json', 'number' => 1 ],
            'Ecole des forces de sécurité drarekstanes' => [ 'path' => 'Ecole/Ecoles/FormationSecuriteInterieure/Police.json', 'number' => 1 ],
            'Ecole policière de motocyclisme' => [ 'path' => 'Ecole/Ecoles/FormationSecuriteInterieure/PoliceMoto.json', 'number' => 1 ],
            'Centre d\'instruction cynophile' => [ 'path' => 'Ecole/Ecoles/FormationSoutienLogistique/InstructionCynophile.json', 'number' => 0 ],
            'Ecole de santé des armées' => [ 'path' => 'Ecole/Ecoles/FormationSoutienLogistique/Sante.json', 'number' => 1 ],
            'Centre d\'instruction au secourisme en milieu hostile' => [ 'path' => 'Ecole/Ecoles/FormationSoutienLogistique/SecourismeMilieuHostile.json', 'number' => 1 ],
            'Lycée militaire' => [ 'path' => 'Ecole/EtablissementsScolaires/LyceeMilitaire.json', 'number' => 5 ],
            'Centre d\'entraînement et d\'aguerrissement militaire' => [ 'path' => 'Entrainement/CEAM.json', 'number' => 16 ],
            'Centre d\'entraînement' => [ 'path' => 'Entrainement/CentreEntrainement.json', 'number' => 9 ],
            'Centre d\'entrainement au combat urbain' => [ 'path' => 'Entrainement/CentreEntrainementCombatUrbain.json', 'number' => 0 ],
            'Site d\'essais AMM' => [ 'path' => 'CCPM/SiteEssaisAMM.json', 'number' => 2 ],
            'Site d\'essais UMM' => [ 'path' => 'CCPM/SiteEssaisUMM.json', 'number' => 1 ],
            'Antenne d\'escortes de détenus' => [ 'path' => 'FSD/AdministrationPenitentiaire/AntenneEscorteDetenu.json', 'number' => 51 ],
            'Centre de rétention administrative' => [ 'path' => 'FSD/AdministrationPenitentiaire/CentreRetentionAdmin.json', 'number' => 2 ],
            'Prison de basse sécurité' => [ 'path' => 'FSD/AdministrationPenitentiaire/PrisonBasseSecurite.json', 'number' => 2 ],
            'Prison de haute sécurité' => [ 'path' => 'FSD/AdministrationPenitentiaire/PrisonHauteSecurite.json', 'number' => 2 ],
            'Prison militaire' => [ 'path' => 'FSD/AdministrationPenitentiaire/PrisonMilitaire.json', 'number' => 0 ],
            'Prison pour mineurs' => [ 'path' => 'FSD/AdministrationPenitentiaire/PrisonMineur.json', 'number' => 2 ],
            'Prison de moyenne sécurité' => [ 'path' => 'FSD/AdministrationPenitentiaire/PrisonMoyenneSecurite.json', 'number' => 2 ],
            'Antenne fédérale du BNS' => [ 'path' => 'FSD/BureauNationalSecurite/Antenne.json', 'number' => 51 ],
            'Poste de douanes' => [ 'path' => 'FSD/Douanes/Douanes.json', 'number' => 0 ],
            'Douanes aéroportuaires' => [ 'path' => 'FSD/Douanes/DouanesAeroportuaires.json', 'number' => 5 ],
            'Douanes maritimes' => [ 'path' => 'FSD/Douanes/DouanesMaritimes.json', 'number' => 4 ],
            'Police militaire' => [ 'path' => 'FSD/PoliceMilitaire/Unite.json', 'number' => 519 ],
            'Direction fédérale anti-criminalité' => [ 'path' => 'FSD/PoliceNationale/AntiCriminalite/DirectionFederale.json', 'number' => 51 ],
            'Groupe anti-criminalité' => [ 'path' => 'FSD/PoliceNationale/AntiCriminalite/Groupe.json', 'number' => 520 ],
            'Direction fédérale anti-stupéfiants' => [ 'path' => 'FSD/PoliceNationale/AntiStupefiants/DirectionFederale.json', 'number' => 51 ],
            'Groupe anti-stupéfiants' => [ 'path' => 'FSD/PoliceNationale/AntiStupefiants/Groupe.json', 'number' => 520 ],
            'Direction fédérale des appels de secours' => [ 'path' => 'FSD/PoliceNationale/CentreReceptionAppelSecours/DirectionFederale.json', 'number' => 51 ],
            'Centre de réception des appels de secours' => [ 'path' => 'FSD/PoliceNationale/CentreReceptionAppelSecours/CentreReceptionAppelSecours.json', 'number' => 520 ],
            'Direction fédérale de la vidéo-surveillance' => [ 'path' => 'FSD/PoliceNationale/CentreVideoSurveillance/DirectionFederale.json', 'number' => 51 ],
            'Centre de vidéo-surveillance' => [ 'path' => 'FSD/PoliceNationale/CentreVideoSurveillance/CentreVideoSurveillance.json', 'number' => 520 ],
            'Pôle fédéral de la criminalité financière' => [ 'path' => 'FSD/PoliceNationale/CriminaliteFinanciere.json', 'number' => 51 ],
            'Direction fédérale de la police cynophile' => [ 'path' => 'FSD/PoliceNationale/Cynophile/DirectionFederale.json', 'number' => 51 ],
            'Groupe cynophile' => [ 'path' => 'FSD/PoliceNationale/Cynophile/Groupe.json', 'number' => 520 ],
            'Direction fédérale du déminage' => [ 'path' => 'FSD/PoliceNationale/Deminage/DirectionFederale.json', 'number' => 51 ],
            'Groupement de déminage' => [ 'path' => 'FSD/PoliceNationale/Deminage/Groupement.json', 'number' => 520 ],
            'Pôle fédéral pour les disparitions' => [ 'path' => 'FSD/PoliceNationale/Disparitions.json', 'number' => 51 ],
            'Pôle fédéral contre la cybercriminalité' => [ 'path' => 'FSD/PoliceNationale/GroupeLutteCyber.json', 'number' => 51 ],
            'Direction fédérale des interventions risquées' => [ 'path' => 'FSD/PoliceNationale/GroupesIntervention/DirectionFederale.json', 'number' => 51 ],
            'Groupe d\'intervention des forces de sécurité' => [ 'path' => 'FSD/PoliceNationale/GroupesIntervention/GroupeIntervention.json', 'number' => 520 ],
            'Direction fédérale du maintien de l\'ordre' => [ 'path' => 'FSD/PoliceNationale/MaintienOrdre/DirectionFederale.json', 'number' => 51 ],
            'Groupe anti-émeutes' => [ 'path' => 'FSD/PoliceNationale/MaintienOrdre/GroupeAntiEmeute.json', 'number' => 525 ],
            'Direction fédérale de la police de l\'air' => [ 'path' => 'FSD/PoliceNationale/PoliceAir/DirectionFederale.json', 'number' => 5 ],
            'Police de l\'air' => [ 'path' => 'FSD/PoliceNationale/PoliceAir/PoliceAir.json', 'number' => 5 ],
            'Police alpine' => [ 'path' => 'FSD/PoliceNationale/PoliceAlpine.json', 'number' => 44 ],
            'Police fluviale' => [ 'path' => 'FSD/PoliceNationale/PoliceFluviale.json', 'number' => 4 ],
            'Direction fédérale de la police judiciaire' => [ 'path' => 'FSD/PoliceNationale/PoliceJudiciaire/DirectionFederale.json', 'number' => 51 ],
            'Groupement de police judiciaire' => [ 'path' => 'FSD/PoliceNationale/PoliceJudiciaire/Groupement.json', 'number' => 520 ],
            'Police maritime' => [ 'path' => 'FSD/PoliceNationale/PoliceMaritime.json', 'number' => 5 ],
            'Direction fédérale motocycliste' => [ 'path' => 'FSD/PoliceNationale/PoliceMotocycliste/DirectionFederale.json', 'number' => 51 ],
            'Caserne motocycliste' => [ 'path' => 'FSD/PoliceNationale/PoliceMotocycliste/Caserne.json', 'number' => 520 ],
            'Direction fédérale de la police de proximité' => [ 'path' => 'FSD/PoliceNationale/PoliceProximite/DirectionFederale.json', 'number' => 51 ],
            'Groupement de police de proximité' => [ 'path' => 'FSD/PoliceNationale/PoliceProximite/Groupement.json', 'number' => 520 ],
            'Direction fédérale de la police scientifique' => [ 'path' => 'FSD/PoliceNationale/PoliceScientifique/DirectionFederale.json', 'number' => 51 ],
            'Groupement de police scientifique' => [ 'path' => 'FSD/PoliceNationale/PoliceScientifique/Groupement.json', 'number' => 520 ],
            'Direction fédérale police-secours' => [ 'path' => 'FSD/PoliceNationale/PoliceSecours/DirectionFederale.json', 'number' => 51 ],
            'Groupe police-secours' => [ 'path' => 'FSD/PoliceNationale/PoliceSecours/Groupe.json', 'number' => 520 ],
            'Police universitaire' => [ 'path' => 'FSD/PoliceNationale/PoliceUniversitaire.json', 'number' => 1 ],
            'Direction fédérale de la protection de la famille et de l\'enfance' => [ 'path' => 'FSD/PoliceNationale/ProtectionFamilleEnfance/DirectionFederale.json', 'number' => 51 ],
            'Groupe de protection de la famille et de l\'enfance' => [ 'path' => 'FSD/PoliceNationale/ProtectionFamilleEnfance/Groupe.json', 'number' => 520 ],
            'Direction fédérale de la protection des personnes' => [ 'path' => 'FSD/PoliceNationale/ProtectionPersonnes/DirectionFederale.json', 'number' => 51 ],
            'Groupement de protection des personnes' => [ 'path' => 'FSD/PoliceNationale/ProtectionPersonnes/ProtectionPersonnes.json', 'number' => 520 ],
            'Direction fédérale de la sécurisation des transports' => [ 'path' => 'FSD/PoliceNationale/SecurisationTransports/DirectionFederale.json', 'number' => 51 ],
            'Groupe de sécurisation des transports' => [ 'path' => 'FSD/PoliceNationale/SecurisationTransports/SecurisationTransports.json', 'number' => 520 ],
            'Direction fédérale de la sécurité routière' => [ 'path' => 'FSD/PoliceNationale/SecuriteRoutiere/DirectionFederale.json', 'number' => 51 ],
            'Groupement de sécurité routière' => [ 'path' => 'FSD/PoliceNationale/SecuriteRoutiere/Groupement.json', 'number' => 520 ],
            'Escadron de la garde nationale' => [ 'path' => 'GardeNationale/Escadron.json', 'number' => 41 ],
            'Régiment de la garde nationale' => [ 'path' => 'GardeNationale/Regiment.json', 'number' => 54 ],
            'Flotte de combat maritime' => [ 'path' => 'MarineNationale/ForceActionNavale/CombatMaritime.json', 'number' => 40 ],
            'Frégate furtive' => [ 'path' => 'MarineNationale/ForceActionNavale/FregateFurtive.json', 'number' => 12 ],
            'Flottille de reconnaissance embarquée' => [ 'path' => 'MarineNationale/ForceNavaleStrategique/FlottilleReconnaissanceEmbarquee.json', 'number' => 15 ],
            'Flottille de chasse embarquée' => [ 'path' => 'MarineNationale/ForceNavaleStrategique/FlottilleChasseEmbarquee.json', 'number' => 15 ],
            'Groupe aéronaval' => [ 'path' => 'MarineNationale/ForceNavaleStrategique/MoyensAeronavales.json', 'number' => 15 ],
            'Groupe amphibie' => [ 'path' => 'MarineNationale/ForceNavaleStrategique/MoyensAmphibies.json', 'number' => 21 ],
            'Bâtiment d\'essais et de mesures' => [ 'path' => 'MarineNationale/ForceSoutienNaval/BatimentEssaisMesures.json', 'number' => 3 ],
            'Bâtiment océano-hydrographique' => [ 'path' => 'MarineNationale/ForceSoutienNaval/BatimentOceanoHydro.json', 'number' => 4 ],
            'Navire-hôpital' => [ 'path' => 'MarineNationale/ForceSoutienNaval/NavireHopital.json', 'number' => 6 ],
            'Ravitailleur maritime' => [ 'path' => 'MarineNationale/ForceSoutienNaval/RavitailleurMaritime.json', 'number' => 53 ],
            'Groupement fédéral de soutien à la flotte' => [ 'path' => 'MarineNationale/ForceSoutienNaval/SoutienFlotte.json', 'number' => 21 ],
            'Transporteur autonome léger' => [ 'path' => 'MarineNationale/ForceSoutienNaval/TransporteurAutonomeLeger.json', 'number' => 0 ],
            'Bâtiment ravitailleur de sous-marin' => [ 'path' => 'MarineNationale/ForceStrategiqueSousMarine/BatimentRavitailleurSousmarin.json', 'number' => 0 ],
            'Sous-marin nucléaire d\'attaque' => [ 'path' => 'MarineNationale/ForceStrategiqueSousMarine/SousmarinNucleaireAttaque.json', 'number' => 15 ],
            'Sous-marin nucléaire lanceur d\'engins' => [ 'path' => 'MarineNationale/ForceStrategiqueSousMarine/SousmarinNucleaireLanceurEngins.json', 'number' => 3 ],
            'Fusiliers marins' => [ 'path' => 'MarineNationale/SecuriteNavale/FusilMarin.json', 'number' => 80 ],
            'Base de la garde-côtière' => [ 'path' => 'MarineNationale/SecuriteNavale/GardeCotiere.json', 'number' => 46 ],
            'Marins-pompier' => [ 'path' => 'MarineNationale/SecuriteNavale/MarinPompier.json', 'number' => 80 ],
            'Groupement fédéral de plongeurs-démineurs' => [ 'path' => 'MarineNationale/SecuriteNavale/PlongeurDemineur.json', 'number' => 34 ],
            'Flotte de protection côtière' => [ 'path' => 'MarineNationale/SecuriteNavale/ProtectionCotiere.json', 'number' => 26 ],
            'Hôpital militaire' => [ 'path' => 'Medical/HopitalMilitaire.json', 'number' => 55 ],
            'Régiment médical' => [ 'path' => 'Medical/RegimentMedical.json', 'number' => 8 ],
            'Poste de santé régimentaire' => [ 'path' => 'Medical/SanteRegiment/SanteRegiment.json', 'number' => 519 ],
            'Centre de récupération physique et physiologique' => [ 'path' => 'Projection/CentreRecupPP.json', 'number' => 4 ],
            'Groupe de gestion fédéral des infrastructures policières' => [ 'path' => 'EMIA/GestionBases/InfrasPolicieres.json', 'number' => 51 ],
            'Centre d\'expertise en combat urbain' => [ 'path' => 'CCPM/CentreExpertiseCombatUrbain.json', 'number' => 1 ],
            'Centre de l\'expérimentation des stratégies' => [ 'path' => 'CCPM/CentreExperimentationStrategies.json', 'number' => 1 ],
            'Laboratoire des matériaux furtifs' => [ 'path' => 'CCPM/NBIC/LaboratoireMateriauxFurtifs.json', 'number' => 1 ],
            'Laboratoire des nanostructures pour l\'armement' => [ 'path' => 'CCPM/NBIC/LaboratoireNanostructuresArmement.json', 'number' => 1 ],
            'Laboratoire de l\'ingénierie biologique' => [ 'path' => 'CCPM/NBIC/LaboratoireIngenierieBiologique.json', 'number' => 1 ],
            'Laboratoire des interfaces homme-machine' => [ 'path' => 'CCPM/NBIC/LaboratoireInterfacesHommeMachine.json', 'number' => 1 ],
            'Centre inter-armées d\'intelligence artificielle' => [ 'path' => 'CCPM/NBIC/CentreInterArmeesIntelligenceArtificielle.json', 'number' => 1 ],
            'Laboratoire de la détonique et des ondes de choc' => [ 'path' => 'CCPM/EtudesExplosifs/LaboratoireDetoniqueOndesChoc.json', 'number' => 1 ],
            'Laboratoire de la formulation des nouveaux explosifs' => [ 'path' => 'CCPM/EtudesExplosifs/LaboratoireFormulationExplosifs.json', 'number' => 1 ],
            'Agence anti-corruption' => [ 'path' => 'FSD/PoliceNationale/AgenceAntiCorruption.json', 'number' => 1 ],
            'Patrouille de démonstration aérienne' => [ 'path' => 'ArmeeAir/PatrouilleDemonstrationAerienne.json', 'number' => 1 ],
            'ArmeeAir/EtatMajor' => [ 'path' => 'ArmeeAir/EtatMajor.json', 'number' => 1 ],
            'ArmeeTerre/EtatMajor' => [ 'path' => 'ArmeeTerre/EtatMajor.json', 'number' => 1 ],
            'CCPM/EtatMajor' => [ 'path' => 'CCPM/EtatMajor.json', 'number' => 1 ],
            'CCPM/InstallationPAT' => [ 'path' => 'CCPM/InstallationPAT.json', 'number' => 1 ],
            'CGA/AcheminementMateriel' => [ 'path' => 'CGA/AcheminementMateriel.json', 'number' => 1 ],
            'CGA/EtatMajor' => [ 'path' => 'CGA/EtatMajor.json', 'number' => 1 ],
            'CGA/GestionMunitions' => [ 'path' => 'CGA/GestionMunitions.json', 'number' => 1 ],
            'CGA/ReceptionNouveauMateriel' => [ 'path' => 'CGA/ReceptionNouveauMateriel.json', 'number' => 1 ],
            'CGA/RessourcesMaterielles' => [ 'path' => 'CGA/RessourcesMaterielles.json', 'number' => 1 ],
            'CMSD/EtatMajor' => [ 'path' => 'CMSD/EtatMajor.json', 'number' => 1 ],
            'CMSD/GardeRapprochCommandements' => [ 'path' => 'CMSD/GardeRapprochCommandements.json', 'number' => 1 ],
            'CMSD/GardeRapprochGouvernement' => [ 'path' => 'CMSD/GardeRapprochGouvernement.json', 'number' => 1 ],
            'CMSD/LutteNRBC' => [ 'path' => 'CMSD/LutteNRBC.json', 'number' => 1 ],
            'CMSD/ProtectionCentreSpatial' => [ 'path' => 'CMSD/ProtectionCentreSpatial.json', 'number' => 1 ],
            'CMSD/ProtectionMinistereDefense' => [ 'path' => 'CMSD/ProtectionMinistereDefense.json', 'number' => 1 ],
            'CMSD/SPIDHI' => [ 'path' => 'CMSD/SPIDHI.json', 'number' => 1 ],
            'CMSD/ServiceAntiDrogue' => [ 'path' => 'CMSD/ServiceAntiDrogue.json', 'number' => 1 ],
            'CSHCM/EtatMajor' => [ 'path' => 'CSHCM/EtatMajor.json', 'number' => 1 ],
            'Communication/EtatMajor' => [ 'path' => 'Communication/EtatMajor.json', 'number' => 1 ],
            'DURHA/EtatMajor' => [ 'path' => 'DURHA/EtatMajor.json', 'number' => 1 ],
            'DirEconomique/EtatMajor' => [ 'path' => 'DirEconomique/EtatMajor.json', 'number' => 1 ],
            'EMIA/EtatMajor' => [ 'path' => 'EMIA/EtatMajor.json', 'number' => 1 ],
            'Ecole/EtatMajor' => [ 'path' => 'Ecole/EtatMajor.json', 'number' => 1 ],
            'Entrainement/EtatMajor' => [ 'path' => 'Entrainement/EtatMajor.json', 'number' => 1 ],
            'FSD/EtatMajor' => [ 'path' => 'FSD/EtatMajor.json', 'number' => 1 ],
            'GardeNationale/EtatMajor' => [ 'path' => 'GardeNationale/EtatMajor.json', 'number' => 1 ],
            'Inspection/BureauAccidentAir' => [ 'path' => 'Inspection/BureauAccidentAir.json', 'number' => 1 ],
            'Inspection/BureauAccidentMer' => [ 'path' => 'Inspection/BureauAccidentMer.json', 'number' => 1 ],
            'Inspection/BureauAccidentTerre' => [ 'path' => 'Inspection/BureauAccidentTerre.json', 'number' => 1 ],
            'Inspection/EquipementsNucleaires' => [ 'path' => 'Inspection/EquipementsNucleaires.json', 'number' => 1 ],
            'Inspection/EtatMajor' => [ 'path' => 'Inspection/EtatMajor.json', 'number' => 1 ],
            'Inspection/InspectionGeneraleArmees' => [ 'path' => 'Inspection/InspectionGeneraleArmees.json', 'number' => 1 ],
            'Juridique/EtatMajor' => [ 'path' => 'Juridique/EtatMajor.json', 'number' => 1 ],
            'MarineNationale/CommandementZoneNavale' => [ 'path' => 'MarineNationale/CommandementZoneNavale.json', 'number' => 1 ],
            'MarineNationale/EtatMajor' => [ 'path' => 'MarineNationale/EtatMajor.json', 'number' => 1 ],
            'Medical/EtatMajor' => [ 'path' => 'Medical/EtatMajor.json', 'number' => 1 ],
            'Medical/PharmacieDefense' => [ 'path' => 'Medical/PharmacieDefense.json', 'number' => 1 ],
            'Patrimoine/EtatMajor' => [ 'path' => 'Patrimoine/EtatMajor.json', 'number' => 1 ],
            'Projection/CETactiqueNavale' => [ 'path' => 'Projection/CETactiqueNavale.json', 'number' => 1 ],
            'Projection/CETactiqueUrbaine' => [ 'path' => 'Projection/CETactiqueUrbaine.json', 'number' => 1 ],
            'Projection/EtatMajor' => [ 'path' => 'Projection/EtatMajor.json', 'number' => 1 ],
            'Reserve/EtatMajor' => [ 'path' => 'Reserve/EtatMajor.json', 'number' => 1 ],
            'ServicesMinistere/EtatMajor' => [ 'path' => 'ServicesMinistere/EtatMajor.json', 'number' => 1 ],
            'ZonesInterArmees/Commandement' => [ 'path' => 'ZonesInterArmees/Commandement.json', 'number' => 1 ],
            'ZonesInterArmees/EtatMajor' => [ 'path' => 'ZonesInterArmees/EtatMajor.json', 'number' => 1 ],
            'ArmeeAir/CentreSpatial/DirSurvObjetsSpatiaux' => [ 'path' => 'ArmeeAir/CentreSpatial/DirSurvObjetsSpatiaux.json', 'number' => 1 ],
            'ArmeeAir/CentreSpatial/Direction' => [ 'path' => 'ArmeeAir/CentreSpatial/Direction.json', 'number' => 1 ],
            'ArmeeAir/DefenseControleAerien/CentreCoordination3D' => [ 'path' => 'ArmeeAir/DefenseControleAerien/CentreCoordination3D.json', 'number' => 1 ],
            'ArmeeAir/DefenseControleAerien/Commandement' => [ 'path' => 'ArmeeAir/DefenseControleAerien/Commandement.json', 'number' => 1 ],
            'ArmeeAir/ForcesAeriennesCombat/Commandement' => [ 'path' => 'ArmeeAir/ForcesAeriennesCombat/Commandement.json', 'number' => 1 ],
            'ArmeeAir/ForcesProtectionAppui/Commandement' => [ 'path' => 'ArmeeAir/ForcesProtectionAppui/Commandement.json', 'number' => 1 ],
            'ArmeeAir/MobiliteAerienne/Commandement' => [ 'path' => 'ArmeeAir/MobiliteAerienne/Commandement.json', 'number' => 1 ],
            'ArmeeTerre/ForcesAppui/Commandement' => [ 'path' => 'ArmeeTerre/ForcesAppui/Commandement.json', 'number' => 1 ],
            'ArmeeTerre/ForcesMelee/Commandement' => [ 'path' => 'ArmeeTerre/ForcesMelee/Commandement.json', 'number' => 1 ],
            'ArmeeTerre/ForcesSoutien/Commandement' => [ 'path' => 'ArmeeTerre/ForcesSoutien/Commandement.json', 'number' => 1 ],
            'CGA/MaintenanceParachutes/Commandement' => [ 'path' => 'CGA/MaintenanceParachutes/Commandement.json', 'number' => 1 ],
            'CGA/SSMD/Commandement' => [ 'path' => 'CGA/SSMD/Commandement.json', 'number' => 1 ],
            'CGA/ServiceFerroviaire/Commandement' => [ 'path' => 'CGA/ServiceFerroviaire/Commandement.json', 'number' => 1 ],
            'CMSD/DGSIC/DGSIC' => [ 'path' => 'CMSD/DGSIC/DGSIC.json', 'number' => 1 ],
            'CMSD/ForcesSpeciales/Direction' => [ 'path' => 'CMSD/ForcesSpeciales/Direction.json', 'number' => 1 ],
            'CMSD/GroupPara/Direction' => [ 'path' => 'CMSD/GroupPara/Direction.json', 'number' => 1 ],
            'CMSD/ProtectionHopitaux/Direction' => [ 'path' => 'CMSD/ProtectionHopitaux/Direction.json', 'number' => 1 ],
            'CMSD/SecuriteAmbassades/Direction' => [ 'path' => 'CMSD/SecuriteAmbassades/Direction.json', 'number' => 1 ],
            'CMSD/SecuriteInterieure/Direction' => [ 'path' => 'CMSD/SecuriteInterieure/Direction.json', 'number' => 1 ],
            'CMSD/ServiceSpecialNucleaire/Direction' => [ 'path' => 'CMSD/ServiceSpecialNucleaire/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/AcademieRenseignement' => [ 'path' => 'CMSD/ServicesSecrets/AcademieRenseignement.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/Direction' => [ 'path' => 'CMSD/ServicesSecrets/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ServiceSoutien' => [ 'path' => 'CMSD/ServicesSecrets/ServiceSoutien.json', 'number' => 1 ],
            'EMIA/GestionBases/Direction' => [ 'path' => 'EMIA/GestionBases/Direction.json', 'number' => 1 ],
            'EMIA/PosteInterArmees/Direction' => [ 'path' => 'EMIA/PosteInterArmees/Direction.json', 'number' => 1 ],
            'EMIA/SystemesAutonomes/CentreExperimentationTactique' => [ 'path' => 'EMIA/SystemesAutonomes/CentreExperimentationTactique.json', 'number' => 1 ],
            'Ecole/CentreRecrutement/CentreRecrutement' => [ 'path' => 'Ecole/CentreRecrutement/CentreRecrutement.json', 'number' => 0 ],
            'Ecole/CentreRecrutement/Direction' => [ 'path' => 'Ecole/CentreRecrutement/Direction.json', 'number' => 1 ],
            'Ecole/Ecoles/Direction' => [ 'path' => 'Ecole/Ecoles/Direction.json', 'number' => 1 ],
            'Ecole/EtablissementsScolaires/Direction' => [ 'path' => 'Ecole/EtablissementsScolaires/Direction.json', 'number' => 1 ],
            'FSD/AdministrationPenitentiaire/Direction' => [ 'path' => 'FSD/AdministrationPenitentiaire/Direction.json', 'number' => 1 ],
            'FSD/BureauNationalSecurite/Direction' => [ 'path' => 'FSD/BureauNationalSecurite/Direction.json', 'number' => 1 ],
            'FSD/BureauNationalSecurite/LaboratoireScientifiqueForensique' => [ 'path' => 'FSD/BureauNationalSecurite/LaboratoireScientifiqueForensique.json', 'number' => 1 ],
            'FSD/Douanes/Direction' => [ 'path' => 'FSD/Douanes/Direction.json', 'number' => 1 ],
            'FSD/PoliceMilitaire/Direction' => [ 'path' => 'FSD/PoliceMilitaire/Direction.json', 'number' => 1 ],
            'FSD/PoliceNationale/Direction' => [ 'path' => 'FSD/PoliceNationale/Direction.json', 'number' => 1 ],
            'FSD/PoliceNationale/IRCFS' => [ 'path' => 'FSD/PoliceNationale/IRCFS.json', 'number' => 1 ],
            'MarineNationale/ForceActionNavale/Commandement' => [ 'path' => 'MarineNationale/ForceActionNavale/Commandement.json', 'number' => 1 ],
            'MarineNationale/ForceNavaleStrategique/Commandement' => [ 'path' => 'MarineNationale/ForceNavaleStrategique/Commandement.json', 'number' => 1 ],
            'MarineNationale/ForceSoutienNaval/Commandement' => [ 'path' => 'MarineNationale/ForceSoutienNaval/Commandement.json', 'number' => 1 ],
            'MarineNationale/ForceStrategiqueSousMarine/Commandement' => [ 'path' => 'MarineNationale/ForceStrategiqueSousMarine/Commandement.json', 'number' => 1 ],
            'MarineNationale/ForceStrategiqueSousMarine/ServiceTransmissionSousMarin' => [ 'path' => 'MarineNationale/ForceStrategiqueSousMarine/ServiceTransmissionSousMarin.json', 'number' => 1 ],
            'MarineNationale/SecuriteNavale/Commandement' => [ 'path' => 'MarineNationale/SecuriteNavale/Commandement.json', 'number' => 1 ],
            'Medical/Instituts/Epidemiologie' => [ 'path' => 'Medical/Instituts/Epidemiologie.json', 'number' => 1 ],
            'Medical/Instituts/MedecineAerospatiale' => [ 'path' => 'Medical/Instituts/MedecineAerospatiale.json', 'number' => 1 ],
            'Medical/Instituts/MedecineNavale' => [ 'path' => 'Medical/Instituts/MedecineNavale.json', 'number' => 1 ],
            'Medical/Instituts/MedecineTropicale' => [ 'path' => 'Medical/Instituts/MedecineTropicale.json', 'number' => 1 ],
            'Medical/Instituts/RecherchesBiomedicales' => [ 'path' => 'Medical/Instituts/RecherchesBiomedicales.json', 'number' => 1 ],
            'Medical/Instituts/StressPostTraumatique' => [ 'path' => 'Medical/Instituts/StressPostTraumatique.json', 'number' => 1 ],
            'Medical/Instituts/TransfusionSanguine' => [ 'path' => 'Medical/Instituts/TransfusionSanguine.json', 'number' => 1 ],
            'Medical/SanteRegiment/Direction' => [ 'path' => 'Medical/SanteRegiment/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ContreEspionnageSecuriteDefense/ContreEspionnage' => [ 'path' => 'CMSD/ServicesSecrets/ContreEspionnageSecuriteDefense/ContreEspionnage.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ContreEspionnageSecuriteDefense/SecuriteDefense' => [ 'path' => 'CMSD/ServicesSecrets/ContreEspionnageSecuriteDefense/SecuriteDefense.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/OperationsClandestines/OperationsClandestines' => [ 'path' => 'CMSD/ServicesSecrets/OperationsClandestines/OperationsClandestines.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/OperationsClandestines/OperationsPsychologiques' => [ 'path' => 'CMSD/ServicesSecrets/OperationsClandestines/OperationsPsychologiques.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/OperationsClandestines/ServiceAction' => [ 'path' => 'CMSD/ServicesSecrets/OperationsClandestines/ServiceAction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ProtectionTerritoireNational/AntiTerrorisme' => [ 'path' => 'CMSD/ServicesSecrets/ProtectionTerritoireNational/AntiTerrorisme.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ProtectionTerritoireNational/ControleImmigration' => [ 'path' => 'CMSD/ServicesSecrets/ProtectionTerritoireNational/ControleImmigration.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/ProtectionTerritoireNational/RenseignementPenitentiaire' => [ 'path' => 'CMSD/ServicesSecrets/ProtectionTerritoireNational/RenseignementPenitentiaire.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/Infiltrations' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/Infiltrations.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/IntelligenceEconomique' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/IntelligenceEconomique.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/RenseignementMilitaire' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/RenseignementMilitaire.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/Technique/TransmissionsSpeciales' => [ 'path' => 'CMSD/ServicesSecrets/Technique/TransmissionsSpeciales.json', 'number' => 1 ],
            'Ecole/Ecoles/FormationCommandementRenseignement/EnseignementCommandement' => [ 'path' => 'Ecole/Ecoles/FormationCommandementRenseignement/EnseignementCommandement.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/RenseignementHumain/Direction' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/RenseignementHumain/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsAmbassade/Direction' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsAmbassade/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsConjointesRenseignement/Direction' => [ 'path' => 'CMSD/ServicesSecrets/RechercheRenseignementEtranger/StationsConjointesRenseignement/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/Technique/GuerreElectronique/Direction' => [ 'path' => 'CMSD/ServicesSecrets/Technique/GuerreElectronique/Direction.json', 'number' => 1 ],
            'CMSD/ServicesSecrets/Technique/RenseignementTechnique/Direction' => [ 'path' => 'CMSD/ServicesSecrets/Technique/RenseignementTechnique/Direction.json', 'number' => 1 ],
        ];

        foreach ($templates as $template) {
            $template_data = json_decode(File::get(storage_path().'/igp/generation/'.$template['path']), true);

            $this->analyseUnit($template_data, $template['number']);
        }

        dump($this->materiels);
        dump($this->roles);

        dump($this->nb_militaires);
        dump($this->nb_police);
        dump($this->nb_civils);

        return Command::SUCCESS;
    }

    private function analyseEfectifs(array $effectifs = [], int $master_number): void
    {
        foreach ($effectifs as $category => $roles) {
            if (!isset($this->roles[ $category ])) {
                $this->roles[ $category ] = [];
            }

            foreach ($roles as $role => $amount) {
                if (!isset($this->roles[ $category ][ $role ])) {
                    $this->roles[ $category ][ $role ] = 0;
                }

                $this->roles[ $category ][ $role ] += $amount * $master_number;
                $this->{ 'nb_'.$category } += $amount * $master_number;
            }
        }
    }

    private function analyseMateriels(array $materiels = [], int $master_number): void
    {
        foreach ($materiels as $category => $materiels_list) {
            if (!isset($this->materiels[ $category ])) {
                $this->materiels[ $category ] = [];
            }

            foreach ($materiels_list as $materiel => $amount) {
                if (!isset($this->materiels[ $category ][ $materiel ])) {
                    $this->materiels[ $category ][ $materiel ] = 0;
                }

                $this->materiels[ $category ][ $materiel ] += $amount * $master_number;
            }
        }
    }

    private function analyseUnit(array $units = [], int $master_number)
    {
        try {
            if (!empty($units['effectifs'])) {
                $this->analyseEfectifs($units['effectifs'], $master_number);
            }
        } catch (\Throwable $e) {
            dd($units);
        }

        if (!empty($units['materiels'])) {
            $this->analyseMateriels($units['materiels'], $master_number);
        }

        unset($units['effectifs']);
        unset($units['materiels']);

        foreach ($units as $sub_units) {
            try {
                $this->analyseUnit($sub_units, $master_number);
            } catch (\Throwable $e) {
                dd($units);
            }
        }
    }
}
