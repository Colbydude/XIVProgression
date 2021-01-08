<template>
    <div class="panel panel-default character-pane" id="character-data" v-if="status.Character.State !== -1">
        <div class="panel-body" v-if="character !== null && status.Character.State == 2">
            <div class="row">
                <div class="col-md-4">
                    <p><img class="img-responsive hidden-xs" :src="character.Portrait" :alt="character.Name + '-' + character.Server" width="640" height="873"></p>
                    <a class="btn btn-info btn-block" :href="lodestoneUrl" target="_blank">View Lodestone Profile</a>
                </div>
                <div class="col-md-8">
                    <h1>
                        {{ character.Name }}<br>
                        <small>{{ character.Title.Name }}</small>
                    </h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/tank.png" alt="Tank Icon" width="32" height="32"> Tank</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs[0]" />   <!-- PLD -->
                                <job-list-item :class-job="character.ClassJobs[1]" />   <!-- WAR -->
                                <job-list-item :class-job="character.ClassJobs[2]" />   <!-- DRK -->
                                <job-list-item :class-job="character.ClassJobs[3]" />   <!-- GNB -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/healer.png" alt="Healer Icon" width="32" height="32"> Healer</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs[8]" />   <!-- WHM -->
                                <job-list-item :class-job="character.ClassJobs[9]" />   <!-- SCH -->
                                <job-list-item :class-job="character.ClassJobs[10]" />  <!-- AST -->
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/melee-dps.png" alt="Melee DPS Icon" width="32" height="32"> Melee DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs[4]" />   <!-- MNK -->
                                <job-list-item :class-job="character.ClassJobs[5]" />   <!-- DRG -->
                                <job-list-item :class-job="character.ClassJobs[6]" />   <!-- NIN -->
                                <job-list-item :class-job="character.ClassJobs[7]" />   <!-- SAM -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/physical-ranged-dps.png" alt="Physical Ranged DPS Icon" width="32" height="32"> Physical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs[11]" />  <!-- BRD -->
                                <job-list-item :class-job="character.ClassJobs[12]" />  <!-- MCH -->
                                <job-list-item :class-job="character.ClassJobs[13]" />  <!-- DNC -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/magical-ranged-dps.png" alt="Magical Ranged DPS Icon" width="32" height="32"> Magical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs[14]" />  <!-- BLM -->
                                <job-list-item :class-job="character.ClassJobs[15]" />  <!-- SMN -->
                                <job-list-item :class-job="character.ClassJobs[16]" />  <!-- RDM -->
                                <job-list-item :class-job="character.ClassJobs[17]" />  <!-- BLU -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body text-center" v-else-if="status.Character.State === 7">
            <h2>Fetching character data...</h2>
            <div class="form-group preloader-wrapper">
                <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="panel-body text-center" v-else>
            <p class="lead" style="margin-bottom: 0;">{{ stateMessage }}</p>
        </div>
    </div>
</template>

<script>
import JobListItem from './JobListItem.vue';
import { stateMessages } from './../data/messages';
import { mapState } from 'vuex';

export default {
    name: 'CharacterPane',

    components: {
        JobListItem,
    },

    computed: {
        /**
         * Gets the character's (NA) Lodestone URL.
         *
         * @return {String}
         */
        lodestoneUrl() {
            return `https://na.finalfantasyxiv.com/lodestone/character/${this.character.ID}`;
        },

        /**
         * Message to display on different response states.
         *
         * @return {String}
         */
        stateMessage() {
            return stateMessages[this.status.Character.State];
        },

        ...mapState(['character', 'status'])
    }
};
</script>
