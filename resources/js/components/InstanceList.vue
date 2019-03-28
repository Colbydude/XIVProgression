<template>
    <div class="instances" v-if="status.Achievements.State !== -1">
        <template v-if="achievements != null && status.Achievements.State == 2">
            <filters />

            <h2 class="text-light">8-Man Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in instances['8-man']" :key="card.name">
                    <instance-card :card="card"></instance-card>
                </div>
            </div>

            <h2 class="text-light">24-Man Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in instances['24-man']" :key="card.name">
                    <instance-card :card="card"></instance-card>
                </div>
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in instances['trials']" :key="card.name">
                    <instance-card :card="card"></instance-card>
                </div>
            </div>
        </template>

        <div class="panel panel-default" v-else-if="status.Achievements.State === 7">
            <div class="panel-body text-center">
                <h2>Fetching achievement data...</h2>
                <div class="form-group preloader-wrapper">
                    <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div class="panel panel-default" v-else-if="status.Achievements.State === 5">
            <div class="panel-body text-center">
                <p class="lead" style="margin-bottom: 0;">{{ stateMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Instances from './../data/instances';
    import { stateMessages } from './../data/messages';
    import { mapState } from 'vuex';

    export default {
        name: 'InstanceList',

        computed: {
            /**
             * List of all instance data.
             *
             * @return {Object}
             */
            instances () {
                return Instances;
            },

            /**
             * Message to display on different response states.
             *
             * @return {String}
             */
            stateMessage() {
                return stateMessages[this.status.Achievements.State];
            },

            ...mapState(['achievements', 'status'])
        }
    };
</script>
