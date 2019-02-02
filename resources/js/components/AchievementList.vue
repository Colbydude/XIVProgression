<template>
    <div class="achievements">
        <div v-if="status.Achievements.State == 2">
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
        </div>
    </div>
</template>

<script>
    import Achievements from './../achievement-data';
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

            ...mapState(['achievements', 'status'])
        }
    };
</script>
