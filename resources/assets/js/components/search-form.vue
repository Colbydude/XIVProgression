<template>
    <form id="search-form" @submit="fetch">
        <div class="form-group">
            <label for="name">Character Name</label>
            <input type="text" id="name" name="name" class="form-control" v-model="name" required>
        </div>
        <div class="form-group">
            <label for="server">Server</label>
            <select id="server" name="server" class="form-control" v-model="server" required>
                <option value="" disabled selected>Choose your realm</option>
                <option v-for="srvr in servers" :value="srvr">{{ srvr }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Check</button>
    </form>
</template>
<script>
    import { mapActions, mapMutations, mapState } from 'vuex';

    export default {
        props: ['characterName', 'characterServer'],

        mounted() {
            if (this.characterName !== undefined) {
                this.name = this.characterName;
            }

            if (this.characterServer !== undefined) {
                this.server = this.characterServer;
            }

            // Fetch initial data if provided from the URL.
            if (this.name !== '' && this.server !== '') {
                this.fetch(event);
            }
        },

        data () {
            return {
                name: '',           // Currently input character name.
                server: '',         // Currently selected server.
                servers: [          // List of available servers.
                    'Adamantoise',
                    'Aegis',
                    'Alexander',
                    'Anima',
                    'Asura',
                    'Atomos',
                    'Bahamut',
                    'Balmung',
                    'Behemoth',
                    'Belias',
                    'Brynhildr',
                    'Cactuar',
                    'Carbuncle',
                    'Cerberus',
                    'Chocobo',
                    'Diabolos',
                    'Durandal',
                    'Excalibur',
                    'Exodus',
                    'Faerie',
                    'Famfrit',
                    'Fenrir',
                    'Garuda',
                    'Gilgamesh',
                    'Goblin',
                    'Gungnir',
                    'Hades',
                    'Hyperion',
                    'Ifrit',
                    'Ixion',
                    'Jenova',
                    'Kujata',
                    'Lamia',
                    'Leviathan',
                    'Lich',
                    'Louisoix',
                    'Malboro',
                    'Mandragora',
                    'Mateus',
                    'Masamune',
                    'Midgardsormr',
                    'Moogle',
                    'Odin',
                    'Omega',
                    'Pandaemonium',
                    'Phoenix',
                    'Ramuh',
                    'Ragnarok',
                    'Ridill',
                    'Sargatanas',
                    'Siren',
                    'Shinryu',
                    'Shiva',
                    'Tiamat',
                    'Titan',
                    'Tonberry',
                    'Typhon',
                    'Ultima',
                    'Ultros',
                    'Unicorn',
                    'Valefor',
                    'Yojimbo',
                    'Zalera',
                    'Zeromus',
                    'Zodiark'
                ]
            };
        },

        computed: mapState(['achievementsLoading', 'characterLoading']),

        methods: {
            /**
             * Fetch character information from DB. If character is not in DB, fetch it from the Lodestone.
             */
            fetch (event) {
                this.setCharacterLoading(true);
                this.setAchievementsLoading(true);

                history.pushState({}, '', '?name=' + this.name + '&server=' + this.server);

                axios.get('/api/fetch', { params: {
                    name: this.name,
                    server: this.server
                }})
                .then(response => {
                    this.fetchCharacterFromXIVDB(response.data.lodestone_id);
                    this.fetchAchievementsFromXIVDB(response.data.lodestone_id);
                })
                .catch(error => {
                    console.log(error);
                });

                // NOTE: Return false so the form doesn't actually submit.
                return false;
            },

            ...mapActions(['fetchAchievementsFromXIVDB', 'fetchCharacterFromXIVDB']),
            ...mapMutations(['setAchievementsLoading', 'setCharacterLoading'])
        }
    }
</script>
