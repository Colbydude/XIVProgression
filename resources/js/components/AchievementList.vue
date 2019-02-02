<template>
    <div class="achievements" v-if="status.Achievements.State !== -1">
        <template v-if="achievements != null && status.Achievements.State == 2">
            <h2 class="text-light">8-Man Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in achievementData['8-man']" :key="card.name">
                    <achievement-card :card="card"></achievement-card>
                </div>
            </div>

            <h2 class="text-light">24-Man Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in achievementData['24-man']" :key="card.name">
                    <achievement-card :card="card"></achievement-card>
                </div>
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row">
                <div class="col-md-6 col-lg-4" v-for="card in achievementData['trials']" :key="card.name">
                    <achievement-card :card="card"></achievement-card>
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

        <div class="panel panel-default" v-else>
            <div class="panel-body text-center">
                <p class="lead" style="margin-bottom: 0;">{{ stateMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import Achievements from './../data/achievements';
    import { stateMessages } from './../data/messages';
    import { mapState } from 'vuex';

    export default {
        name: 'AchievementList',

        computed: {
            /**
             * List of all achievement data.
             *
             * @return {Object}
             */
            achievementData () {
                return Achievements;
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
