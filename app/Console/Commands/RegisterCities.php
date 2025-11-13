<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\FederalState;
use Illuminate\Console\Command;

class RegisterCities extends Command
{
    protected $signature = 'register:cities';

    public function handle(): int
    {
        $states = json_decode('{
    "Canvane": [ "Gata sur mer", "Mavende", "Lasas", "Marube", "Jazet", "Laodez", "Wétisi", "Aléja", "Céria", "Malonron", "Ifléodi", "Eldroti", "Nupora", "Saphardane" ],
    "Rafalte": [ "Cieg sur mer", "Queerwar" ],
    "Nardilg": [ "Korda", "Chadarli", "Tasob", "Gilnibe", "Pékako", "Nésili", "Dogia", "Zijol", "Quésasset", "Zéphirne", "Soelkel" ],
    "Paxton": [ "Venfresza", "Pypard", "Poriagar", "Carcinizo", "Nalaryn" ],
    "Raphte": [ "Kellar", "Quégnasque" ],
    "Goa": [ "Quachale", "Vagorse" ],
    "Fabergaux": [ "Aldal", "Umiria", "Péliel", "Milios", "Béféo", "Ypéra", "Héchana", "Nagrex", "Lamont", "Fiéchan", "Uradra", "Ingasist" ],
    "Xijéni": [ "Hamalca", "Widir", "Radani", "Vékélor", "Nulbinie", "Friabe", "Elveine", "Tégnac", "Quésaylor", "Lertun", "Cénori", "Himaze", "Brais", "Etale" ],
    "Gades": [ "Montgarade", "Ernyas", "Kotros", "Juétus", "Foloir", "Liréro", "Merche", "Licarce", "Fanèche", "Pedap", "Exete", "Dracep", "Elarte" ],
    "Faligadrie": [ "Klesnep", "Préhilde", "Quélame", "Béliri", "Lagor", "Ysolden", "Sammira", "Hédalziel" ],
    "Kalos": [ "Iloni", "Abanior", "Owiel", "Vaulont", "Iavéri", "Ineum", "Sénol", "Gomac", "Leec sur mer" ],
    "Macia": [ "Pérasi", "Faola", "Kisha", "Lécéaz", "Voadi", "Réhadi", "Mabitis", "Garonsézai", "Zonisipe", "Ogargues" ],
    "Léréli": [ "Zysax", "Aeifur", "Natalaz", "Jarmaleb", "Varseun", "Kafisa", "Rafalas", "Mulinali", "Corane", "Srifti" ],
    "Discra": [
        "Emdarust", "Filivane", "Lysas", "Auner", "Kalexi", "Uibni", "La Ferrière", "Mibargue", "Hostala", "Drioloc", "Stuipe",
        "Argot", "Colino", "Lulis", "Gnézarto", "Epilio", "Létèse", "Usnace", "Nodrivel"
    ],
    "Istolil": [ "Haroirte", "Zabex", "Tolite", "Isopre", "Aodane", "Uviduse", "Lojida", "Ranim", "Nécan", "Adwarly", "Gonlafte" ],
    "Tinara": [
        "Grand Val", "Sicax", "Linion", "Hautmoulin", "Alsoco", "Fitade", "Josce", "Borgan", "Cliladre", "Plaingre", "Férikef", "Nyreg", "Abosza", "Nagad", "Asiéha",
        "Tonnerre", "Gacliféni", "Rafnir", "Mévérenz", "Edivixa", "Soun Raphael", "Féana", "Quéhati", "Akindilowe"
    ],
    "Skalmir": [
        "Ipéri", "Dénita", "Rénosse", "Padrin", "Winebri", "Ipevois", "Gylac", "Fuama", "Spaniv", "Nosixi", "Evénis", "Trycer", "Nodype",
        "Diman", "Gruse", "Tifévélo", "Hixilec", "Montreuil", "Radsbork"
    ],
    "Belterdra": [ "Narifla", "Busec", "Publes", "Iabrak", "Oparit", "Wumard", "Delbiza", "Ferrière", "Vaubanches", "Tarvorgade", "Onalskelk" ],
    "Dragaf": [ "Tigéra", "Barfett", "Naline", "Baxtonel", "Vitry", "Léone", "Ioélig", "Nogent", "Ivéva", "Fymaco" ],
    "Mitcold": [ "Masagur", "Jaylas", "Véraos", "Forura", "Otry", "Lorion", "Clarond", "Doname", "Egreun", "Nakou", "Farunane", "Némarma", "Unajez", "Aranir", "Rosière", "Mesnil", "Oritric", "Algaran" ],
    "Agikael": [ "Yanek", "Gétef", "Xékir", "Beslace", "Flouelm", "Ererga", "Tairéa", "Optis", "Locis", "Karmecher", "Kényne", "Zivanir" ],
    "Malane": [ "Ocuine", "Uliare", "Soun Denis", "Orgraga", "Quirithe", "Villers", "Daretia", "Ravosébi" ],
    "Osésol": [ "Iséar", "Daoute", "Acroda", "Héséni", "Idorida", "Liocalo", "Urtéaro", "Blois", "Pablica", "Ilévin", "Nyzacax", "Dulanlmeux", "Orokal", "Hosgobnat", "Mernynqua" ],
    "Pérague": [ "Demuel", "Carpole", "Ranuvi", "Vérink", "Diortine", "Sanboric", "Mernanches", "Nivragne", "Quorétrec" ],
    "Pensencala": [ "Papias", "Marvais", "Gaun", "Hagnatio", "Nétilo", "Hélorinia", "Loraniel" ],
    "Marimar": [ "Dahuze", "Cavan", "Célénu", "Falanor", "Harvénos", "Udone", "Soun Quentin" ],
    "Warstia": [ "Odola", "Bénory", "Méaderzone", "Adkineka", "Malajicale" ],
    "Nacorlis": [ "Mazes", "Weymax", "Talmagne", "Cangnail", "Nadénor", "Vantala", "Actéaug", "Hascuan", "Lanragne", "Halérona" ],
    "Darsia": [ "Nestus", "Uyentale", "Xabaca", "Fazoli", "Rirune", "Bikim", "Jipiwa", "Hévine" ],
    "Soun Michel": [ "Vyvinde", "Prabério", "Boissière", "Slyris" ],
    "Ossiella": [ "Shéria", "Longy", "Soun Bruno", "Kynud", "Fontreux", "Irineronis", "Andonel", "Abognord", "Tropanne", "Wocca" ],
    "Ousour": [ "Tacrine", "Zaïta", "Lynlei", "Dytilofa", "Soun Pascal", "Darried" ],
    "Maxazaren": [ "Jéluxo", "Ganstre", "Lathiel", "Kicin", "Adallos", "Xyrid", "Scarotry" ],
    "Féliofa": [ "Jéluj sous forêt", "Disoca", "Niterli", "Geasse", "Gata", "Cirdec", "Jonyer", "Warrad", "Aztubvonn", "Iselfe", "Lamenc", "Biwowi", "Jédudétu", "Eret sous forêt" ],
    "Fjalloki": [ "Fodaac", "Totafe", "Ywitéro", "Brycéna", "Evonar", "Omarni", "Béron", "Wyrov", "Xokifa", "Quaskatauriac" ],
    "Parza": [ "Aptis", "Jamissoret", "Wadir", "Maguallo", "Bolupa", "Hiectin" ],
    "Lésiknei": [ "Esillargues", "Joceltazig", "Silurexu", "Quaguerris", "Wilarol", "Biboja", "Jénanecola", "Quoraovon" ],
    "Dynris": [ "Markoonas", "Uréogur", "Réobrisagne", "Vobet", "Cilicel", "Dertnéro" ],
    "Hartnui": [ "Peipuignosque", "Jypoliashu", "Rudge", "Moggenna", "Jaceïvar" ],
    "Neikandrène": [ "Pélangane", "Uifalle", "Bardane", "Marzina", "Sacaral", "Ankined", "Garskélis" ],
    "Adaptra": [ "Yatves", "Dalroha", "Rédynqua", "Lérasora" ],
    "Xaéméda": [ "Hénotna", "Adynusame", "Lefwendyla", "Lyzabe", "Rausban" ],
    "Aeskinoran": [ "Soroursa", "Kasofoxo", "Bacarnosque", "Paylénoéla", "Zembrada", "Zodénez", "Orrane", "Sigvald" ],
    "Ubcej": [ "Xéjawima", "Macholimes", "Sifinetone", "Tynéli", "Arvanial", "Erditio", "Kachelja" ],
    "Magusaoz": [ "Quabanqua", "Tudalwolde", "Mydimini", "Rocydifa", "Quervode", "Kalran", "Baltan", "Nykuipe" ],
    "Assiria": [ "Kuxif", "Acanpail", "Rakagéga", "Latuald", "Jurik", "Zitiloge", "Sowono", "Xyol", "Sabriani", "Querodagne", "Frasgre" ],
    "Kabona": [ "Plutgurst", "Ademnorunt", "Mascabja", "Abnovia", "Jazactic" ],
    "Tiaeldir": [ "Moustanpe", "Sameltine", "Yairkine", "Quospésis", "Kévuce", "Zorrenzei", "Soun Loïc" ],
    "Eyvarade": [ "Swadéca", "Najota", "Quosémizzo", "Ablécénaé", "Peyguerone", "Victoaja", "Puches", "Duhirgis" ],
    "Janeres": [ "Zarinis", "Aiglewen", "Adrinda", "Insézaf", "Ualdasas", "Arnenc" ],
    "Eyjolde": [ "Msakol", "Shianpia", "Jaïpos", "Féréta", "Evésétana", "Tourcer", "Duvenezaic", "Oatieun", "Ralshpli", "Waceerda", "Majove", "Zavara" ]
}', true);

        foreach ($states as $state => $cities) {
            $state_model = FederalState::query()->where('name', 'LIKE', '%'.$state.'%')->firstOrFail();
            //$city_model = City::query()->where('name', $state)->firstOrFail();

            //$state_model->capital_city_id = $city_model->id;
            //$state_model->save();

            /*$city_model = new City();
            $city_model->name = $state;
            $city_model->federal_state_id = $state_model->id;
            $city_model->save();

            foreach ($cities as $city) {
                $city_model = new City();
                $city_model->name = $city;
                $city_model->federal_state_id = $state_model->id;
                $city_model->save();
            }*/
        }

        return Command::SUCCESS;
    }
}
