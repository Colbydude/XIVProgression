<template>
    <div class="achievements">
        <div v-if="!achievementsLoading">
            <div v-if="areAchievementsPublic === 1">
                <h2 class="text-light">8-Man Raids</h2>
                <div class="row multi-columns-row">
                    <div class="col-md-6 col-lg-4" v-for="card in achievementCards['8-man']" :key="card.name">
                        <achievement-card :card="card"></achievement-card>
                    </div>
                </div>

                <h2 class="text-light">24-Man Raids</h2>
                <div class="row multi-columns-row">
                    <div class="col-md-6 col-lg-4" v-for="card in achievementCards['24-man']" :key="card.name">
                        <achievement-card :card="card"></achievement-card>
                    </div>
                </div>

                <h2 class="text-light">Trials</h2>
                <div class="row multi-columns-row">
                    <div class="col-md-6 col-lg-4" v-for="card in achievementCards['trials']" :key="card.name">
                        <achievement-card :card="card"></achievement-card>
                    </div>
                </div>
            </div>
            <div v-else-if="areAchievementsPublic === 0">
                <h2 class="text-center text-light">
                    This character does not have public achievement viewing enabled.<br>
                    <small style="font-weight: 100;">This can be enabled from the Lodestone.</small>
                </h2>
            </div>
        </div>
        <div class="text-center" v-else>
            <h2 class="text-light">Fetching achievement data...</h2>
            <div class="form-group preloader-wrapper text-light">
                <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            areAchievementsPublic () {
                if (this.character == null) {
                    return -1;
                }

                return this.character.achievements_public;
            },

            ...mapState(['achievementCards', 'achievements', 'achievementsLoading', 'character'])
        }
    }
</script>
