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
    import servers from './../data/servers';
    import { mapActions, mapMutations, mapState } from 'vuex';

    export default {
        name: 'SearchForm',

        props: {
            characterName: {
                type: String,
                default: ''
            },
            characterServer: {
                type: String,
                default: ''
            }
        },

        data () {
            return {
                name: this.characterName,       // Currently input character name.
                server: this.characterServer,   // Currently selected server.
                servers: servers                // List of available servers.
            };
        },

        mounted() {
            // Fetch initial data if provided from the URL.
            if (this.name !== '' && this.server !== '') {
                this.submit();
            }
        },

        methods: {
            /**
             * Submit the form to fetch character information from DB.
             * If character is not in DB, it'll search the Lodestone for the character.
             *
             * @return {Void}
             */
            async submit () {
                this.setStatus({
                    Achievements: { State: 7 },
                    Character: { State: 7 }
                });

                history.pushState({}, '', '?name=' + this.name + '&server=' + this.server);

                try {
                    let response = await API.search(this.name, this.server);

                    this.getCharacterData(response.data.lodestone_id);
                } catch (e) {
                    this.setStatus({
                        Achievements: { State: 8 },
                        Character: { State: 8 }
                    });
                }
            },

            ...mapActions(['getCharacterData']),
            ...mapMutations(['setStatus'])
        }
    };
</script>
