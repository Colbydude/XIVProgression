<template>
    <form id="search-form" @submit.prevent="submit">
        <div class="form-group">
            <label for="name">Character Name</label>
            <input type="text" id="name" name="name" class="form-control" v-model="name" required>
        </div>
        <div class="form-group">
            <label for="server">Server</label>
            <select id="server" name="server" class="form-control" v-model="server" required>
                <option value="" disabled selected>Choose your realm</option>
                <option v-for="server in servers" :value="server">{{ server }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Check</button>
    </form>
</template>
<script>
    import API from './../api';
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
                this.submit();
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

        methods: {
            /**
             * Submit the form to fetch character information from DB.
             * If character is not in DB, fetch it from the Lodestone.
             *
             * @return {Void}
             */
            async submit () {
                this.setStatus('loading');

                history.pushState({}, '', '?name=' + this.name + '&server=' + this.server);

                try {
                    let response = await API.search(this.name, this.server);

                    this.getCharacterData(response.data.lodestone_id);
                } catch (e) {
                    console.log(e);
                }
            },

            ...mapActions(['getCharacterData']),
            ...mapMutations(['setStatus'])
        }
    }
</script>
